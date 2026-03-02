<?php
function acf_preview() {
    ?>
    <style type='text/css'>
        .imagePreview { position:absolute; right:100%; top:0px; z-index:999999; border:1px solid #f2f2f2; box-shadow:0px 0px 3px #b6b6b6; background-color:#fff; padding:20px;}
        .imagePreview img { width:300px; height:auto; display:block; }
        .acf-tooltip li:hover { background-color:#0074a9; }
        .title-thumbnail{display: inline-block; margin: 0 8px; border: 1px solid #a5b1be;}
        .title-thumbnail img{object-fit: contain;vertical-align:middle;}
        .acf-fc-layout-handle{display: flex !important;align-items: center;}
    </style>
    <script>
        jQuery(document).ready(function($) {
            $('[data-name="page-builder"] a[data-name=add-layout], [data-name="post-builder"] a[data-name=add-layout]').click(function(){
                waitForEl('.acf-tooltip li', function() {
                    $('.acf-tooltip li a').hover(function(){
                        const imageName = $(this).attr('data-layout');
                        const THEME_URL = '<?= THEME_URL; ?>';
                        $('.acf-tooltip').append(`<div class="imagePreview"><img src="${THEME_URL}/template-img/${imageName}.png" alt="Preview image"></div>`);
                    }, function(){
                        $('.imagePreview').remove();
                    });
                });
            })

            const waitForEl = function(selector, callback) {
                if (jQuery(selector).length) {
                    callback();
                } else {
                    setTimeout(function() {
                        waitForEl(selector, callback);
                    }, 100);
                }
            };
        })
    </script>
    <?php
}
add_action('acf/input/admin_head', 'acf_preview');

add_filter('acf/fields/flexible_content/layout_title/name=page-builder', 'acf_add_preview_image_to_title', 10, 4);
add_filter('acf/fields/flexible_content/layout_title/name=post-builder', 'acf_add_preview_image_to_title', 10, 4);
function acf_add_preview_image_to_title( $title, $field, $layout, $i ) {
    $imgUrl = THEME_URL . '/template-img/' . $layout['name'] . '.png';
    $imgHtml = '<div class="title-thumbnail"><img width="65" src="'.$imgUrl.'" alt="Preview image"></div>';
    $title = $imgHtml . $title;
    return $title;
}