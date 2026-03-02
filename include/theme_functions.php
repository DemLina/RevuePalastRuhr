<?php
// Extracting src value from iframes
function extract_iframe_src($html) {
    if (preg_match('@<iframe[^>]+src="([^"]+)"@i', $html, $match)) {
        return $match[1];
    }
    return '';
}


// Count reading time in flexible content field
function reading_time($the_post_ID, $field_name){
    $total_word_count = 0; // Establish the total word count

    // Replace 'flexible_content' with your custom field
    $all_fields = get_field($field_name, $the_post_ID, false); // Get the flexible content meta field name

    foreach ($all_fields as $field) { // Loop the flexible content fields
        foreach ($field as $key => $value) { // Loop the fields by $key => $value
            if ($key === 'acf_fc_layout') {
                continue; // Skip layout identifier
            }

            if (is_string($value)) {
                // Count words if the field value is a string (text)
                $total_word_count += str_word_count(strip_tags($value));
            } elseif (is_array($value)) {
                // Handle repeater fields or nested fields
                $total_word_count += count_words_in_array($value);
            }
        }
    }



    $readingtime = ceil($total_word_count / 250);

    $timer = $readingtime <= 1 ? " " . __('minute', 'coachello-theme') : " " . __('minutes', 'coachello-theme');
    $totalreadingtime = $readingtime == 0 ? "1" . $timer : $readingtime . $timer;

    return $totalreadingtime;
}


// Generate pagination
function generatePagination($totalPages, $currentPage = 1, $mainUrl, $numAround = 2) {
    $pagination = '';

    if ($totalPages > 1) {
        if($currentPage == 1){
            $pagination .= '<li class="blog-archive__pagination-item blog-archive__pagination-item--active"><a href="'.$mainUrl.'/page/1/">1</a></li>';
        } else {
            $pagination .= '<li class="blog-archive__pagination-item"><a href="'.$mainUrl.'/page/1/">1</a></li>';
        }

        if ($currentPage > ($numAround + 2)) {
            $pagination .= '<li>...</li>';
        }

        // Pages around the current page
        for ($i = max(2, $currentPage - $numAround); $i <= min($totalPages - 1, $currentPage + $numAround); $i++) {
            if ($currentPage == $i) {
                $pagination .= '<li class="blog-archive__pagination-item blog-archive__pagination-item--active"><a href="'.$mainUrl.'/page/'.$i.'/">' . $i . '</a></li>';
            } else {
                $pagination .= '<li class="blog-archive__pagination-item"><a href="'.$mainUrl.'/page/'.$i.'/">' . $i . '</a></li>';
            }
        }

        // Last page
        if ($currentPage < ($totalPages - $numAround - 1)) {
            $pagination .= '<li>...</li>';
        }

        if($currentPage == $totalPages){
            $pagination .= '<li class="blog-archive__pagination-item blog-archive__pagination-item--active"><a href="'.$mainUrl.'/page/'.$totalPages.'/">' . $totalPages . '</a></li>';
        } else {
            $pagination .= '<li class="blog-archive__pagination-item"><a href="'.$mainUrl.'/page/'.$totalPages.'/">' . $totalPages . '</a></li>';
        }
    }

    return $pagination;
}




/**
 * Converts iframe src attribute → data-src (or any other replacement)
 * Works well with HTML fragments, YouTube/Vimeo embeds, etc.
 *
 * @param string $content     HTML content (fragment)
 * @param array  $replacements [ 'src' => 'data-src', 'another-attr' => 'data-something' ]
 * @return string
 */
function convert_iframe_src_to_data_src(string $content, array $replacements): string
{
    if (empty($content) || empty($replacements)) {
        return $content;
    }

    // Quick check - no iframe → no work
    if (stripos($content, '<iframe') === false) {
        return $content;
    }

    $dom = new DOMDocument();

    // Important flags for HTML5 fragments
    libxml_use_internal_errors(true);

    // We do NOT use htmlentities() anymore - that's the biggest bug
    $dom->loadHTML(
        '<?xml encoding="UTF-8">' . $content, // Helps with encoding
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOERROR | LIBXML_NOWARNING
    );

    libxml_clear_errors();

    $iframes = $dom->getElementsByTagName('iframe');

    if ($iframes->length === 0) {
        return $content;
    }

    $modified = false;

    /** @var DOMElement $iframe */
    foreach ($iframes as $iframe) {
        foreach ($replacements as $oldAttr => $newAttr) {
            if (!$iframe->hasAttribute($oldAttr)) {
                continue;
            }

            $value = $iframe->getAttribute($oldAttr);

            // Set new attribute
            $iframe->setAttribute($newAttr, $value);

            // Remove old one
            $iframe->removeAttribute($oldAttr);

            $modified = true;
        }
    }

    if (!$modified) {
        return $content;
    }

    $html = $dom->saveHTML();

    return trim($html);
}