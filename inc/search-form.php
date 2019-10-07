<?php

function sm_search_form($args) {
    // the Query
    // meta_query expects nested arrays even if you only have one query
    $sm_query = new WP_Query(array(
        'post_type' => 'accommodation',
        'posts_per_page' => '-1',
        'meta_query' => array(array(
            // (the underscore preceding the name represents a hidden custom field)
            'key' => '_sm_accommodation_city'
        ))
    ));

    // The loop
    if ($sm_query->have_posts()) {
        $cities = array();
        while($sm_query->have_posts()) {
            $sm_query->the_post();
            $city = get_post_meta(get_the_ID(), '_sm_accommodation_city', true);

            // populate an array of all occurrences (non duplicated)
            if (!in_array($city, $cities)) {
                $cities[] = $city;
            }
        }
    } else {
        echo 'No accommodations yet!';
        return;
    }

    wp_reset_postdata();

    if (count($cities) === 0) {
        return;
    }

    asort($cities);

    $select_city = '<select name="city" style="width: 100%">';
    $select_city .= '<option value="" selected="selected">' . __('Select city', 'smashing_plugin') . '</option>';
    foreach($cities as $city) {
        $select_city .= '<option value="' . $city . '">' . $city . '</option>';
    }
    $select_city .= '</select>' . "\n";

    reset($cities);


        $args = array(
            'hide_empty' => false
        );
        $typology_terms = get_terms('typology', $args);
        if(is_array($typology_terms)) {
            $select_typology = '<select name="typology" style="width: 100%">';
            $select_typology .= '<option value="" selected="selected">' . __('Select typology', 'smashing_plugin') . '</option>';
            foreach($typology_terms as $term) {
                $select_typology .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
            }
            $select_typology .= '</select>' . "\n";
        }


        $select_type = '<select name="type" style="width:100%;">';
        $select_type .= '<option value="" selected="selected">' . __('Select room type', 'smashing_plugin') . '</option>';
        $select_type .= '<option value="entire">' . __('Entire house', 'smashing_plugin') . '</option>';
        $select_type .= '<option value="private">' . __('Private room', 'smashing_plugin') . '</option>';
        $select_type .= '<option value="shared">' . __('Shared room', 'smashing_plugin') . '</option>';
        $select_type .= '</select>' . "\n";

        $output = '<form id="smform" action="' . esc_url(home_url()) . '" method="GET" role="search">';
        $output .= '<div class="smtextfield"><input type="text" name="s" placeholder="Search key..." value="' . get_search_query() . '" /></div>';
        $output .= '<div class="smselectbox">' . esc_html($select_city) . '</div>';
        $output .= '<div class="smselectbox">' . esc_html($select_typology) . '</div>';
        $output .= '<div class="smselectbox">' . esc_html($select_type) . '</div>';
        $output .= '<input type="hidden" name="post_type" value="accommodation" />';
        $output .= '<p><input type="submit" value="Go!" class="button" /></p></form>';
}

?>