<?php
/*
    =================================
     Remove Generator Version Number
    =================================

*/
function weightloss_remove_wp_version_strings($src) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'weightloss_remove_wp_version_strings');
add_filter('style_loader_src', 'weightloss_remove_wp_version_strings');

function weightloss_remove_meta_version() {
    return '';
}
add_filter('the_generator', 'weightloss_remove_meta_version');