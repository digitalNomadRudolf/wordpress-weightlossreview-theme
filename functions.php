<?php

function site_setup() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Catamaran|Josefin+Sans');
    /* wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'); */
    wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'), array(), microtime());
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css');
    wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), array('jquery'), microtime(), true);
    wp_enqueue_script('submenu', get_theme_file_uri('/js/submenu.js'), array('jquery'), microtime(), true);
    wp_enqueue_script('hover-drop', get_theme_file_uri('js/hover-drop.js'), array('jquery'), microtime(), true);
    wp_enqueue_script('menu-toggle', get_theme_file_uri('js/menu-toggle.js'), array('jquery'), microtime(), true);
    wp_enqueue_script('search-toggle', get_theme_file_uri('/js/search-toggle.js'), array('jquery'), microtime(), true);
    wp_enqueue_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', NULL, microtime(), true);
    wp_enqueue_script('bootstrap', get_theme_file_uri('js/bootstrap.min.js'), array('jquery'), microtime(), true);
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array('jquery'), microtime(), true);

}

add_action('wp_enqueue_scripts', 'site_setup');

// adding theme support 

function site_init() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'
    ));
    register_nav_menus( array(
        'header' => 'Header menu',
        'footer' => 'Footer menu',
        'primary-menu' => __('Primary Menu', 'topmenu'),
        'secondary-menu' => __('Secondary Menu', 'secondmenu')
    ));
}

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Sidebar',
    'id' => 'sidebar-1',
    'class' => 'custom',
    'description' => 'Standard Sidebar',
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

register_sidebar(array(
    'name' => 'Footer Area 1',
    'id' => 'footer-left',
    'class' => 'custom',
    'description' => 'The footer area',
    'before_widget' => '<div class="col-sm-4 footcol">',
    'after_widget' => '</div>',
    'before_title' => '<div class="col-title"><h3>',
    'after_title' => '</h3></div>',
  )
);

register_sidebar(array(
    'name' => 'Footer Area 2',
    'id' => 'footer-middle',
    'class' => 'custom',
    'description' => 'The footer area',
    'before_widget' => '<div class="col-sm-4 footcol">',
    'after_widget' => '</div>',
    'before_title' => '<div class="col-title"><h3>',
    'after_title' => '</h3></div>',
  )
);

register_sidebar(array(
    'name' => 'Footer Area 3',
    'id' => 'footer-right',
    'class' => 'custom',
    'description' => 'The footer area',
    'before_widget' => '<div class="col-sm-4 footcol">',
    'after_widget' => '</div>',
    'before_title' => '<div class="col-title"><h3>',
    'after_title' => '</h3></div>',
  )
);


add_action('after_setup_theme', 'site_init');

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-formats', array(
    'aside', 'image', 'video'
));

add_filter( 'wp_image_editors', 'change_graphic_lib' );

function change_graphic_lib($array) {
  return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}


// products post type 
function site_custom_post_type() {
    register_post_type('product', 
    array(
        'rewrite' => array('slug' => 'products'),
        'labels' => array('name' => 'Products',
        'singular_name' => 'Product',
        'add_new_product' => 'Add New Product',
        'edit_item' => 'Edit Product'
    ),
        'menu-icon' => 'dashicons-plus',
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'supports' => array(
            'title', 'thumbnail', 'editor', 'excerpt', 'comments'
        ),
        'taxonomies' => array(
            'category'
        )
    )
);
}

add_action('init', 'site_custom_post_type');

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'product'); // don't forget nav_menu_item to allow menus to work!
    $query->set('post_type',$post_type);
    return $query;
    }
}


// console log function

function prefix_console_log_message( $message ) {

    $message = htmlspecialchars( stripslashes( $message ) );
    //Replacing Quotes, so that it does not mess up the script
    $message = str_replace( '"', "-", $message );
    $message = str_replace( "'", "-", $message );

    return "<script>console.log('{$message}')</script>";
}

// replace strings 

function replace_text($text) {
	$text = str_replace('look-for-this-string', 'replace-with-this-string', $text);
	$text = str_replace('look-for-that-string', 'replace-with-that-string', $text);
	return $text;
}
add_filter('the_content', 'replace_text');




/*
    =====================
     Include Walker file
    =====================

*/
require get_template_directory() . '/inc/otherwalker.php';

/*
    =====================
     Include Cleanup file
    =====================

*/
require get_template_directory() . '/inc/cleanup.php'; 

/*
    ===============
     Head function
    ===============
*/

// remove the wordpress version from the head for better security
function remove_blog_version() {
    return '';
}
add_filter('the_generator', 'remove_blog_version');


/*
    ===================
     Custom Post Types
    ===================
        Product Reviews (for product reviews)
        Program Reviews (for program reviews)
        Buying Guides 
*/
add_theme_support('post-thumbnails');
function weightloss_custom_post_type() {
    $labels = array(
       'name'          => 'Product Reviews',
       'singular_name' => 'Product Review',
       'add_new'       => 'Create New Review',
       'all_items'     => 'All Items',
       'add_new_item'  => 'Add Item',
       'edit_item'     => 'Edit Item',
       'new_item'      => 'New Item',
       'view_item'     => 'View Item',
       'search_item'   => 'Search Reviews',
       'not_found'     => 'No items found',
       'not_found_in_trash' => 'No items found in trash',
       'parent_item_colon'  => 'Parent Item'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        // this is the value that grabs the default settings of a premade custom post type
        'capability_type' => 'post',
        'hierarchical' => false,
        'show_in_rest' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ),
        'taxonomies' => array(
            'category',
            'post_tag'
        ),
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    register_post_type('product reviews', $args);
}

// now we create a hook to call the function of the custom post type
add_action('init', 'weightloss_custom_post_type');

function weightloss_custom_taxonomies() {

    // add new taxonomy hierarchical
    $labels = array(
        'name' => 'Fields',
        'singular' => 'field',
        'search_items' => 'Search Fields',
        'all_items' => 'All Fields',
        'parent_item' => 'Parent field',
        'parent_item_colon' => 'Parent field:',
        'edit_item' => 'Edit field',
        'update_item' => 'Update field',
        'add_new_item' => 'Add New field',
        'new_item_name' => 'New field Name',
        'menu_name' => 'Fields'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        // rewrite is always better for SEO
        'rewrite' => array('slug' => 'field')
    );

    // this taxonomy is going to be applied ONLY to the 'product reviews' custom post type
    register_taxonomy('field', array('productreviews'), $args);
    
    // add new taxonomy NOT hierarchical

    register_taxonomy('supplements', 'productreviews', array(
        'label' => 'Supplements',
        'rewrite' => array('slug' => 'supplements'),
        'hierarchical' => false
    ));

}

add_action('init', 'weightloss_custom_taxonomies');


// Megamenu custom fields section


// Create fields

function fields_list() {
    return array(
        'mm-mega-menu' => 'Activate MegaMenu',
        'mm-column-divider' => 'Column Divider',
        'mm-submenu' => 'Sub Menu',
        'mm-featured-image' => 'Featured Image',
        'mm-description' => 'Description',
    );
}


// Setup fields 
function megamenu_fields($id, $item, $depth, $args) {

    $fields = fields_list();
    // for every field lets store the key that i defined in fields_list in the $_key, and the label(for example 'Activate MegaMenu') in the $label
    foreach( $fields as $_key => $label) :

        // %s for passing the token(s)
        $key = sprintf('menu-item-%s', $_key);
        $id = sprintf('edit-%s-%s', $key, $item->ID);
        $name = sprintf('%s[%s]', $key, $item->ID);
        $value = get_post_meta($item->ID, $key, true);
        $class = sprintf('field-%s', $_key);

        ?>

        <p class="description description-wide <?php echo esc_attr($class) ?>">
            <label for="<?php echo esc_attr($id) ?>"><input type="checkbox" id="<?php echo esc_attr($id) ?>" 
            name="<?php echo esc_attr($name) ?>" value="1" <?php echo ($value == 1) ? 'checked="checked"' :
            ''; ?>><?php echo esc_attr($label) ?></label>
        </p>

        <?php

    endforeach;

}

// pass 4 fields to this custom function
add_action('wp_nav_menu_item_custom_fields', 'megamenu_fields', 10, 4);

// Show columns
function megamenu_columns($columns) {
    $fields = fields_list();

    $columns = array_merge($columns, $fields);

    return $columns;
}
// In order to call this megamenu_columns method we hook it to a filter
add_filter('manage_nav-menus_columns', 'megamenu_columns', 99);
// Save/Update fields
function megamenu_save($menu_id, $menu_item_db_id, $menu_item_args) {
    if(defined('DOING_AJAX') && DOING_AJAX ) {
        return;
    }

    check_admin_referer('update-nav_menu', 'update-nav-menu-nonce');

    $fields = fields_list();

    foreach($fields as $_key => $label) {
        $key = sprintf('menu-item-%s', $_key);

        // Sanitize
        if(!empty($_POST[$key][$menu_item_db_id])) {
            $value = $_POST[$key][$menu_item_db_id];
        } else {
            $value = null;
        }

        // Save or Update
        if(! is_null($value)) {
            update_post_meta($menu_item_db_id, $key, $value);
        } else {
            delete_post_meta($menu_item_db_id, $key);
        }
    }
}

add_action('wp_update_nav_menu_item', 'megamenu_save', 10, 3);

// Update the Walker Nav Class
// The walker variable carries the default walker nav class that generates the menu displayed in the admin menu panel
function megamenu_walkernav($walker) {
    $walker = 'MegaMenu_Walker_Edit';
    if(!class_exists($walker)) {
        require_once dirname( __FILE__  ) . '/inc/walker-nav-menu-edit.php';
    }

    return $walker;
}

add_filter('wp_edit_nav_menu_walker', 'megamenu_walkernav', 99);


/*
    =======================
     Custom Term Function
    =======================

*/
function weightloss_get_terms($postID, $term) {

    $terms_list = wp_get_post_terms($postID, $term);
    $output = '';

    $i = 0;
    foreach($terms_list as $term) { $i++;
        if($i > 1) {
            $output .= ', ';
        }
      $output .= '<a href="' . get_term_link($term) . '">'. $term->name .'</a>';
    }

    return $output;
}


add_filter('wp_nav_menu_objects', function( $items, $args ) {
	
	// loop
	foreach( $items as &$navitem ) {
		
		// vars
		$navtitle = get_field('custom_nav_title', $navitem);
		
		
		// append title
		if( $navtitle ) {
			
			$navitem .= "<h4 class=\"mega-title\">" . $navtitle . "</h4>\n";
			
		}
		
	}
	// return
	return $items;
	
}, 10, 2);

// only show 4 search results
function change_wp_search_size($query) {
    if ( $query->is_search ) // Make sure it is a search page
        $query->query_vars['posts_per_page'] = 4;

    return $query; // Return our modified query variables
}
add_filter('pre_get_posts', 'change_wp_search_size'); // Hook our custom function onto the request filter



function weightloss_my_load_more_scripts() {
    global $wp_query;
    wp_enqueue_script('jquery');

    wp_register_script('weightlossloadmore', get_stylesheet_directory_uri() . '/js/weightlossloadmore.js', array('jquery'));


    // pass parameters to weightlossloadmore.js which can be passed only in PHP 
    wp_localize_script('weightlossloadmore', 'weightloss_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        'posts' => json_encode($wp_query->query_vars),
        'current_page' => (get_query_var('paged') ? get_query_var('paged') : 1),
        'max_page' => $wp_query->max_num_pages
    ));

    wp_enqueue_script('weightlossloadmore');
}
add_action('wp_enqueue_scripts', 'weightloss_my_load_more_scripts');


function weightloss_loadmore_ajax_handler() {
    // prepare args for the query
   /*  $args = json_decode(stripslashes($_POST['query']), true); */
    $args=array();
		global $wpdb;
    /* $args['paged'] = $_POST['p_id']; */ // we need the next page to be loaded 
    $args['post_status'] = 'publish';
    $args['posts_per_page'] = 4;
/*     if(!empty($_POST['search_string'])){
       $args['s'] = trim($_POST['search_string']);
    } */
	$limit = 4;
	$paged = $_POST['p_id'];
	 $offset = ($paged - 1)*$limit;
/* 	$all_post_types=array('
	
	')
	$args['s'] ='tea'; */
	
	$sql= "SELECT * FROM $wpdb->posts  WHERE 1=1";
	
	$sql.= " AND ((( $wpdb->posts.post_title LIKE '%".trim($_POST['search_string'])."%')";
	
	$sql.= " OR ( $wpdb->posts.post_excerpt LIKE '%".trim($_POST['search_string'])."%')";
	
	$sql.= " OR ( $wpdb->posts.post_content LIKE '%".trim($_POST['search_string'])."%')))";
	
    /* $sql.= " AND wp_posts.post_type IN ('post', 'page', 'attachment', 'product', 'productreviews') "; */
    $sql.= " AND wp_posts.post_type IN ('post', 'attachment', 'product', 'productreviews') ";
	
	$sql.= " AND ((wp_posts.post_status = 'publish')) ";
	
	$sql.= " ORDER BY wp_posts.post_title LIKE '%".trim($_POST['search_string'])."%' DESC, wp_posts.post_date DESC ";
	
	$sqlgetwhole=$sql;
    $sql.= " LIMIT $offset, $limit ";

/* 	
  echo $sql;  */
	$getWholeNumber= $wpdb->get_results($sqlgetwhole);
	$searchData= $wpdb->get_results($sql);
	
	/* print_r($searchData); */
	$current_rows= count($searchData);

	$html='';
	if($searchData){
		  ob_start();
			include( get_template_directory() .'/content-custom-search.php' );
		  $html=ob_get_contents();
		  ob_get_clean();
		// 	
	}else{
		 $html= "<div> No posts found...</div>";
	}
  echo  json_encode(array('html'=>$html,'num_rows'=>$current_rows,'found_posts'=>count($getWholeNumber),'limit'=> $limit));
    die();
    exit;
}
// loadmore is the same name as the action in the loadmore script
add_action('wp_ajax_loadmore', 'weightloss_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'weightloss_loadmore_ajax_handler');


// the comment section navigation
function weightloss_get_post_navigation() {
    // if( get_comment_pages_count() > 1 && get_option('page_comments') ):

        require(get_template_directory() . '/inc/templates/weightloss-comment-nav.php');

    // endif;
}


/*
    =======================
     Format Comments
    =======================

*/
function format_comment($comment, $args, $depth) {
    
    $GLOBALS['comment'] = $comment; ?>

    <li class="single-comment" id="li-comment-<?php comment_ID() ?>">

    <div class="comment">
        <div class="comment-avatar">
            <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="avatar image" class="img-responsive avatar-img">
        </div>

        <div class="comment-main">
            <span class="name"><?php printf(__('%s'), get_comment_author_link()) ?></span>
            <span class="date"><?php printf(__('%1$s'), get_comment_date(), get_comment_time()) ?></span>
            <a href="#comments" class="comment-reply-link" rel="nofollow"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a>
            <?php echo apply_filters('the_content', $comment->comment_content); ?>
        </div>
    </div>

<?php

} ?><?php

/*
    ====================================================================================
     Wrapping row containing the 3 col-md-4 divs with the name, email and submit fields
    ====================================================================================

*/

function wrap_before_comment_fields() {
    echo '<div class="row width-800">';
}
add_action('comment_form_before_fields', 'wrap_before_comment_fields');

function wrap_after_comment_fields() {
    echo '</div>';
}
add_action('comment_form_after_fields', 'wrap_after_comment_fields');


/*
    =========================================
     Return unordered list from Custom Field
    =========================================

*/
function ul_from_custom_field($cust_field, $postID) {
    // this function returns a ul out of the custom field input
    // the false params in the get_field acf method below takes away the p tags that acf auto generates
    $list_items = get_field($cust_field, $postID, false, false);

    $class_one = $cust_field === 'pro_list' ? 'pros-list' : 'cons-list';
    $class_two = $cust_field === 'pro_list' ? 'icon check' : 'icon times';
    /* print_r($class_one); */

    if($list_items){
        // PHP_EOL is set as the delimiter for a new line
        $new_list_items = explode(PHP_EOL, $list_items);
            echo '<ul class="' . $class_one . '">';
                foreach($new_list_items as $list_item) {
            echo '<li><span class="' . $class_two . '"></span>' . $list_item . '</li>';
        }
        echo '</ul>';
    }
    return $new_list_items;
}



/*
    =========================================
     Load more Product Posts with Ajax
    =========================================

*/

function add_archive_scripts() {
    global $wp_query;
    wp_register_script('custom-posts', get_template_directory_uri() . "/js/custom-posts.js", array('jquery'));

    wp_localize_script('custom-posts', 'get_ajax_posts', array(
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
));

    wp_enqueue_script( 'custom-posts');
}
add_action('wp_enqueue_scripts', 'add_archive_scripts');
add_action( 'admin_enqueue_scripts', 'add_archive_scripts' );


function get_ajax_posts(){
    
    
    $args = array(
        'post_type' => array('product'),
        'post_status' => array('publish'),
        'posts_per_page' => $_POST["posts_per_page"],
        'paged' => get_query_var('paged', $_POST["paged"]),
    );
    
    $ajaxposts = new WP_Query($args);
    $response = '';

    if ( $ajaxposts->have_posts() ) {
        while ( $ajaxposts->have_posts() ) {
            $ajaxposts->the_post();
            $response .= get_template_part('content-custom-products');
        }
        wp_reset_query();
    } else {
        $response .= null;
    }
    
    echo $response;

    exit; 

    
}

add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');


/*
    ===========================================
     Load more Product Review Posts with Ajax
    ===========================================

*/
function add_prodreview_scripts() {
    global $wp_query;
    wp_register_script('more-productreviews', get_template_directory_uri() . "/js/more-productreviews.js", array('jquery'));

    wp_localize_script('more-productreviews', 'ajax_productreview_posts', array(
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
));

    wp_enqueue_script( 'more-productreviews');
}
add_action('wp_enqueue_scripts', 'add_prodreview_scripts');
add_action( 'admin_enqueue_scripts', 'add_prodreview_scripts' );


function ajax_productreview_posts(){
    
    
    $args = array(
        'post_type' => array('productreviews'),
        'post_status' => array('publish'),
        'posts_per_page' => $_POST["posts_per_page"],
        'paged' => get_query_var('paged', $_POST["paged"]),
    );
   
    
    $ajaxreviews = new WP_Query($args);

    $response = '';

    if ( $ajaxreviews->have_posts() ) {
        while ( $ajaxreviews->have_posts() ) {
            $ajaxreviews->the_post();
            $response .= get_template_part('content-custom-products');
        }
        wp_reset_query();
    } else {
        $response .= null;
    }
    
    echo $response;

    exit; 
}

add_action('wp_ajax_ajax_productreview_posts', 'ajax_productreview_posts');
add_action('wp_ajax_nopriv_ajax_productreview_posts', 'ajax_productreview_posts');

function change_search_url() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }   
}
add_action( 'template_redirect', 'change_search_url' );


// exclude page post type from the search
add_action( 'pre_get_posts', 'my_search_exclude_filter' );
function my_search_exclude_filter( $query ) {
	if ( ! $query->is_admin && $query->is_search && $query->is_main_query() ) {
		$searchable_post_types = get_post_types( array( 'exclude_from_search' => false ) );
		$post_type_to_remove = 'page';
		if( is_array( $searchable_post_types ) && in_array( $post_type_to_remove, $searchable_post_types ) ) {
			unset( $searchable_post_types[ $post_type_to_remove ] );
			$query->set( 'post_type', $searchable_post_types );
		}
	}
}

// Change Image editor library used by WP
/* function wpb_image_editor_default_to_gd( $editors ) {
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff( $editors, array( $gd_editor ) );
    array_unshift( $editors, $gd_editor );
    return $editors;
}
add_filter( 'wp_image_editors', 'wpb_image_editor_default_to_gd' ); */