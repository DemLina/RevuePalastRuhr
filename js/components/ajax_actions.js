import {Ajax} from "../classes/Ajax";
import { initArticleSlider } from "./article-slider";
import { initChangePosition } from "./change-position";
import { initProjectView } from "./project-view";
import { initTimer } from "./timer";

export function ajaxes() {
    const $ajaxSections = $('section[data-ajax-section]')
    let loading = false
    const url = new URL(window.location.href)

    $ajaxSections.each(function() {
        const $section = $(this)
        const $ajaxTarget = $section.find('[data-ajax-filter-target]')
        const $queryArgsField = $section.find('[name="queryArgs"]')

        const filterPosts = (page = 1) => {
            const data = {
                'action': 'filter_posts',
                'args': $queryArgsField.val(),
                'page': page
            }

            window.history.replaceState(null, '', url)

            new Ajax(data, 'json').sendRequest(
                (data) => {
                    $section.removeClass('loading')
                    setTimeout(() => {
                        initChangePosition()
                        $('.article-slider__grid').slick('unslick')
                        initArticleSlider()
                        initProjectView()
                    }, 10)

                    if(data.content){
                        if(page > 1){
                            $ajaxTarget.append(data.content)
                            $ajaxTarget.attr('data-cur-page', page)
                        } else {
                            $ajaxTarget.html(data.content)
                            $ajaxTarget.attr('data-cur-page', 1)
                            $section.data('loading', false)
                        }

                        $ajaxTarget.attr('data-total-pages', data.max_pages)
                        loading = false
                    }
                },
                () => {
                    if(page <= 1){
                        $section.addClass('loading')
                    }
                }
            )
        }

        $section.find('[data-year-filter]').on('change', function(){
            const curElVal = $(this).val()
            let queryArgs = JSON.parse($queryArgsField.val())

            if (curElVal && curElVal !== 'default') {
                queryArgs.meta_year_filter = curElVal
                url.searchParams.set('selected_year', curElVal)
            } else {
                delete queryArgs.meta_year_filter
                url.searchParams.delete('selected_year')
            }

            $queryArgsField.val(JSON.stringify(queryArgs))

            filterPosts()
        })

        $section.find('[data-date-order]').on('click', function(e){
            const curDateOrder = $(this).attr('data-date-order')
            $section.find('[data-date-order]').removeClass('active')
            $(this).addClass('active')

            let queryArgs = JSON.parse($queryArgsField.val())

            if(curDateOrder === 'upcoming'){
                queryArgs.order = 'ASC'
                queryArgs.meta_query[0].compare = '>='
                url.searchParams.delete('selected_date_order')
            } else {
                queryArgs.order = 'DESC'
                queryArgs.meta_query[0].compare = '<'
                url.searchParams.set('selected_date_order', curDateOrder)
            }

            $queryArgsField.val(JSON.stringify(queryArgs))

            filterPosts()
        })

        $section.find('[data-term-slug]').on('click', function(){
            const curTerm = $(this).attr('data-term-slug')
            const isMetaTerm = $(this).attr('data-meta-term')

            $section.find('[data-term-slug]').removeClass('active')
            $(this).addClass('active')

            let queryArgs = JSON.parse($queryArgsField.val())

            if (curTerm && curTerm !== 'all') {
                if(isMetaTerm){
                    queryArgs.meta_query = [{
                        key: 'post__content-type-new',
                        value: curTerm,
                        compare: 'IN'
                    }]
                } else {
                    queryArgs.tax_query = [{
                        taxonomy: queryArgs.post_type + '-cat',
                        field: 'slug',
                        terms: curTerm
                    }]
                }

                url.searchParams.set('selected_term', curTerm)
            } else {
                if(isMetaTerm){
                    delete queryArgs.meta_query
                } else {
                    delete queryArgs.tax_query
                }

                url.searchParams.delete('selected_term')
            }

            $queryArgsField.val(JSON.stringify(queryArgs))

            filterPosts()
        })

        $section.find('[data-load-more]').on('click', function (e) {
            e.preventDefault()
            const curEl = $(this)

            const curPage = parseInt(curEl.attr('data-cur-page')) + 1
            const totalPages = parseInt(curEl.attr('data-total-pages'))
            const args = $queryArgsField.val()

            const data = {
                'action': 'load_more',
                'args': args,
                'curPage': curPage
            }

            window.history.replaceState(null, '', url)

            new Ajax(data, 'json').sendRequest(
                (data) => {
                    curEl.text('LOAD MORE')
                    if(data){
                        $ajaxTarget.append(data.content)

                        curEl.attr('data-cur-page', curPage)

                        if(curPage === totalPages){
                            curEl.parent().hide()
                        }
                    }
                },
                () => {
                    curEl.text('LOADING')
                }
            )
        })
    })

    // Images load more
    $('[data-imgs-load-more]').on('click', function(e) {
        e.preventDefault()

        const $btn = $(this)
        $btn.addClass('loading')
        const postID = $btn.data('imgs-post-id')
        const postType = $btn.data('imgs-post-type')
        const curPage = parseInt($btn.attr('data-imgs-cur-page'), 10)
        const curLeft = parseInt($btn.find('span').text(), 10)

        const data = {
            'action': 'get_gallery_imgs',
            'post_id': postID,
            'post_type': postType,
            'gallery_page': curPage
        }

        new Ajax(data, 'json').sendRequest((data) => {
            $btn.removeClass('loading')
            if(data.content){
                $('[data-imgs-ajax-target]').append(data.content)

                const leftItems = curLeft - 9

                if(leftItems > 0){
                    $btn.find('span').text(leftItems)
                    $btn.attr('data-imgs-cur-page', curPage + 1)
                } else {
                    $btn.parent().hide()
                }

                new Masonry(
                    $('.project-inner__gallery-masonry').get(0),
                    {
                        itemSelector: '.project-inner__gallery-item',
                        percentPosition: true
                    }
                )
            }
        })
    })

}

