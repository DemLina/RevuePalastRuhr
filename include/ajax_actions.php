<?php
// Filtering posts
function filter_posts(){
    $params = json_decode(stripslashes($_POST['args']), true);
    $page = (int) $_POST['page'];
    $post_ids = [];

    if($page > 1):
        $params['paged'] = $_POST['page'];
    endif;

    $wp_query = new WP_Query($params);
    if($wp_query->have_posts()){
        $post_ids = $wp_query->posts;
    }

    $max_pages = $wp_query->max_num_pages;

    ob_start();
    if(!empty($post_ids)):
        foreach($post_ids as $post_id):
            get_template_part('template-parts/items/' . $params['post_type'] . '-card', null, ['id' => $post_id]);
        endforeach;
    else:
        echo '<h2>'. __('No '. $params['post_type'] .' have been found') . '</h2>';
    endif;

    $content = ob_get_clean();

    echo json_encode([
        'content' => $content,
        'max_pages' => $max_pages
    ]);

    die;
}
add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');


// Load more button logic
function load_more() {
    $params = json_decode(stripslashes($_POST['args']), true);
    $page = (int) $_POST['page'];
    $post_ids = [];

    if($page > 1):
        $params['paged'] = $_POST['page'];
    endif;

    $wp_query = new WP_Query($params);
    if($wp_query->have_posts()){
        $post_ids = $wp_query->posts;
    }

    ob_start();

    if(!empty($post_ids)):
        foreach($post_ids as $post_id):
            get_template_part('template-parts/items/' . $params['post_type'] . '-card', null, ['id' => $post_id]);
        endforeach;
    else:
        echo '<h2>'. __('No '. $params['post_type'] .' have been found') . '</h2>';
    endif;

    $content = ob_get_clean();

    echo json_encode([
        'content' => $content,
    ]);

    wp_reset_postdata();

    die;
}
add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');


// Pagination generation
function generatePagination($totalPages, $currentPage, $numAround = 2) {
    $pagination = '';

    if ($totalPages > 1) {

        // First page
        if($currentPage == 1){
            $pagination .= '<li class="active"><a href="#">1</a></li>';
        } else {
            $pagination .= '<li><a href="#">1</a></li>';
        }

        if ($currentPage > ($numAround + 2)) {
            $pagination .= '<li>...</li>';
        }

        // Pages around the current page
        for ($i = max(2, $currentPage - $numAround); $i <= min($totalPages - 1, $currentPage + $numAround); $i++) {
            if ($currentPage == $i) {
                $pagination .= '<li class="active"><a href="#">' . $i . '</a></li>';
            } else {
                $pagination .= '<li><a href="#">' . $i . '</a></li>';
            }
        }

        // Last page
        if ($currentPage < ($totalPages - $numAround - 1)) {
            $pagination .= '<li>...</li>';
        }

        if($currentPage == $totalPages){
            $pagination .= '<li class="active"><a href="#">' . $totalPages . '</a></li>';
        } else {
            $pagination .= '<li><a href="#">' . $totalPages . '</a></li>';
        }
    }

    return $pagination;
}
