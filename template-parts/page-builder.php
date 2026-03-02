<?php
$page_builder_blocks = get_field('page-builder');

foreach($page_builder_blocks as $block):
    $block_name = $block['acf_fc_layout'];

    get_template_part('template-parts/page-builder/' . $block_name, null, $block);
endforeach;

