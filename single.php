<?php
$post_type = get_post_type();

get_header();

get_template_part('template-parts/' . $post_type . '/single/single');

get_footer();
