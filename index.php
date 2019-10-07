<?php get_header(); ?>

<?php 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'paged' => $paged
);

echo $paged;
$blogposts = new WP_Query($args);
// here im running the have_posts() and the_post() methods on the $blogposts object
    while($blogposts->have_posts()) :
        $blogposts->the_post();
?>
    

        <a href="<?php the_permalink();  ?>">
        <h3><?php the_title(); ?></h3>
        </a>
        <?php the_excerpt(); ?>

        

<?php   
    endwhile;
    wp_reset_postdata();
?>

<div class="pagination">
    <?php 
        echo paginate_links( array(
            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
            'total'        => $blogposts->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
            'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
            'add_args'     => false,
            'add_fragment' => '',
        ) );
    ?>
</div>

<?php get_footer(); ?>