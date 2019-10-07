<?php
// if your file has just php and no HTML then leave it open dont close it.

// Custom Walker Nav Class for the Menu Editor in Admin
// Walker_Nav_Menu_Edit takes care of printing the menu of the admin panel
class MegaMenu_Walker_Edit extends Walker_Nav_Menu_Edit {
    
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_output = '';

        // check that the start element of the parent class 
        parent::start_el($item_output, $item, $depth, $args, $id);

        // regex replace to check if the fields that are inside the start element loop in the default walker nav edit class,
        // are matching our custom fields. If those are matching, that means we need to do something different. 
        $output .= preg_replace('/(?=<(fieldset|p)[^>]+class="[^"]*field-move)/', 
        $this->get_fields($item, $depth, $args), 
        $item_output);
    }

    protected function get_fields($item, $depth, $args = array(), $id = 0) {
        ob_start();

        do_action('wp_nav_menu_item_custom_fields', $item->ID, $item, $depth, $args, $id);

        return ob_get_clean();
    }

}
