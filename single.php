<?php get_header(); ?>

                   <!-- full width bar at the top with introductory paragraph and title -->
                   <section class="top-bar">
                        <div class="container">
                       <div class="top-bar__introduction--single">
                         <h1 class="title"><?php the_title(); ?></h1>
                            <img class="img-responsive single-img" src="<?php the_post_thumbnail_url(); ?>" alt="product image">
                       </div>
                    </div>
                   </section>


                   <?php 

                        while(have_posts()) {
                        the_post();
                    ?>

                    <!--  main section that contains the article content, main image and perhaps comment section(arrange this in WP), references and links to related articles -->
                   <section class="sub-main-single">
                       <div class="container ">
                              
                            <span class="author">Made by <?php the_author(); ?></span> |
                            <span class="date">On <?php the_time('F wS Y'); ?></span>
                            <span class="updated">Hide this line if article is not updated yet.</span>

                            <p class="single-intro"><?php the_field('main_intro'); ?></p>

                            <p class="single-intro small"><?php the_field('secondary_intro'); ?></p>

                            <h1 class="single-main-title"><?php the_title(); ?></h1>
                            <div class="single-main-content">
                              <?php the_field('main_content'); ?>
                            </div>

                            <?php the_content(); ?>

                            <!--pro's and cons-->
                            <!-- 2 columns left column has 2 kind of icons: green ok check and red error cross. these are on the left of the bullet points. 
                            left column is pro's and right cons. heading bar has main purple color and white text. below is centered a cta button that 
                            goes to the "purchase / amazon" page. table has to be dynamic when connected to WP -->

                            <div class="container extra-pad">
                              <div class="row full-border">
                                <div class="pros-cons">
                                <div class="heading">
                                  <h2>Pro's and Con's</h2>
                                </div>

                                    <div class="col-md-6 left">
                                        <?php ul_from_custom_field('pro_list', get_the_ID()); ?>
                                    </div>

                                    <div class="col-md-6 right">
                                        <?php ul_from_custom_field('con_list', get_the_ID()); ?>
                                    </div>
                                
                              </div>
                            </div>
                          </div>

                            <!-- this image will span the full width of the page -->
                            <div class="image-full-width">
                            <img src="<?php the_field('full_width_image'); ?>" alt="large image" class="img-responsive content-img-lg">
                            </div>
                            <h1 class="content-title"><?php the_field('second_content_section_title'); ?></h1>
                            <div class="summary-section">
                              <p class="single-txt"><?php the_field('second_content_section'); ?></p>
                            </div>
                        

                            <div class="avatar">
                              <!-- author avatar and name -->
                              <div class="avatar-img-wrap">
                              <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" alt="avatar" class="img-responsive avt-image">
                              </div>
                              <div class="avatar-info">
                              <span class="avatar-name"><?php the_author(); ?></span>
                              <span class="avatar-descr"><?php the_author_meta('description'); ?></span>
                              </div>
                            </div>
                              
                       </div>
                   </section>

                   <!-- below the article and on the side will contain related articles in the form of image columns -->
                   <section class="related-section-bottom">

                          <?php 
                            // in order not to get an error you have to assign category(s) to the post
                            $terms = get_the_terms( get_the_ID(), 'category' );
                            $term_list = wp_list_pluck( $terms, 'slug' );
                            
                            $related_args = array(
                              'post_type' => 'any',
                              'posts_per_page' => 3,
                              'post_status' => 'publish',
	                            'post__not_in' => array( get_the_ID() ),
                              'orderby' => 'rand',
                              'tax_query' => array(
                                array(
                                  'taxonomy' => 'category',
                                  'fields' => 'slug',
                                  'terms' => $term_list
                                )
                              )
                            );
                            $related = new WP_Query($related_args);
                            ?>

                            <?php
                            $i = 0;

                          if($related->have_posts()) :
                          ?>

                     <div class="container">
                       <div class="row">
                         <h1 class="related-articles">
                           Related Articles
                         </h1>

                            <?php while($related->have_posts()): $related->the_post(); ?>
                         <div class="col-md-4 related-articles-col">
                           <div class="image-wrap">
                            <img class="img-responsive rel-art-img" src="<?php the_post_thumbnail_url(); ?>" alt="article image">
                          </div>
                          <div class="rel-art-img-caption">
                              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                          </div>
                         </div>

                         <?php $i++;
                          if(($i > 0) && ($i % 3 === 0)) { echo '</div><div class="row">'; }
                          endwhile;
                         ?>

                       </div>
                     </div>

                     <?php endif;
                     wp_reset_postdata();
                     ?>
                        
                   </section>
        
        <?php if(comments_open()) :
              comments_template();
        endif;
    }

?>

<?php get_footer(); ?>