<?php /* Template Name: Front Page */ ?>
<?php get_header(); ?>

<!-- hero image header section -->
<section class="header">
                      <div class="page-header" style="background-image: url(<?php the_field('hero_image', 24); ?>)">

                      <!-- <pre>
                      <?php /* print_r(get_field('hero_image'));  */?>
                      </pre>; -->

                      

                        <div class="main-description"><h1><?php the_field('hero_title', 24) ?></h1>
                          <span class="sub__desc"><?php the_field('hero_subtitle', 24) ?></span>
                          <button class="btn sub__desc--btn"><a href="<?php the_field('hero_link') ?>">Go to Review</a></button>
                        </div>
                        
                      </div>
                    </section>

                    

                    <!-- best products section -->
                    <section class="best__products">

                    <?php 

                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 1
                        );

                        $blogposts = new WP_Query($args);

                        while($blogposts->have_posts()) {
                            $blogposts->the_post();
                        

                    ?>

                          <div class="row undo-row">
                            <div class="col-md-6 best__products--left-col">
                              <div class="best__products--left_col-info">
                                  <h1 class="smaller-h1"><?php the_title(); ?></h1>
                                  <span class="prod-info"><?php echo wp_trim_words(get_the_excerpt(), 30) ?></span>
                                  <p class="product-pars info-strong"><?php the_field('product_intro', 24); ?></p>
                              </div>
                            </div>

                            
                              <div class="best__products--right-col overlay greyish">
                                <div class="row undo-row">
                                  <div class="best__products--right-col_title col-md-6">
                                    <h1>Get it now</h1>
                                    <h3>Reviews and Complaints</h3>
                                    <p>Find out everything you need to know before buying this product. Always consult with your doctor before starting with new supplements.</p>
                                    <button class="right-col-btn"><a href="<?php the_permalink(); ?>"> Find out more...</a></button>
                                  </div>

                                </div>
                              </div>
                            
                              <!-- place in the footer -->
                              <!-- get rid of the display none on the fl-icon class -->
                              <div class="fl-icon">Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>

                          </div> 

                      <?php } 
                      
                      wp_reset_query(); ?>

                    </section>

                    <!-- top 3 products -->
                    <section class="top-three">

                      <div class="container">
                          <h1 class="top-three_title">Top 3 products</h1>

                        <div class="row">

                        <?php 

                        
                              $args = array(
                                'post_type' => 'product',
                                'category_name' => 'top-3',
                                'posts_per_page' => 3
                              );

                              $blogposts = new WP_Query($args);

                              while($blogposts->have_posts()) {
                                $blogposts->the_post();
                              
                          ?>

                          <div class="col-md-4 top-three_col">
                            <img class="img-responsive set-size" src="<?php the_post_thumbnail_url(); ?>" alt="product-image">
                            <h2><?php the_title(); ?></h2>
                            <a href="<?php the_permalink(); ?>" class="top-three_col--link"><span class="author"><?php the_author(); ?></span></a>
                          </div>  

                          <?php
                            }

                            wp_reset_query();
                        ?>

                        </div>
                      </div>
                    </section>
                    
                    <!-- latest reviewed -->
                    <!-- will be a 2col 50 50 layout. left is a link to article / review and right as well. one image contains the full col and has an element on right near to the top transparent with a cta (read the review) -->
                    <section class="latest">
                      <div class="row undo-row">

                            
                          <?php  

                              $args= array(
                                'post_type' => 'post',
                                'posts_per_page' => 2
                              );

                              $i = 0;

                              $blogposts = new WP_Query($args);

                              while($blogposts->have_posts()) {
                                $blogposts->the_post();
                              
                                $i++;
                          ?>

                          <a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php $i === 1 ? post_class('latest__col-left--link') : 
                                                                                                 $i === 2 ? post_class('latest__col-right--link') : '' ?>>
                          <div <?php $i === 1 ? post_class('col-md-6 latest__col-left') :
                                     $i === 2 ? post_class('col-md-6 latest__col-right') : '' ?> >
                            
                          <div <?php $i === 1 ? post_class('latest__col-left--labelleft') : 
                                     $i === 2 ? post_class('latest__col-right--labelright') : '' ?> >
                          <span class="title"><?php the_title(); ?></span> 
                            <div <?php $i === 1 ? post_class('label-left-text') :
                                       $i === 2 ? post_class('label-right-text') : '' ?>>
                            <p class="fadetxt"><?php echo prefix_console_log_message($i);
                            
                              $content = get_the_content();
                              $content = apply_filters('the_content', $content);
                              $content = str_replace('<div>', '<p>', $content);
                            
                                                  
                              echo $content 
                                                  
                                                  ?></p>
                             </div>
                          </div>
                          
                        </div>
                      </a>
                      

                      <?php  
                          }

                          wp_reset_query();
                      ?>

                      </div>
                    </section>

                    <!-- info section -->
                    <section class="info__section" style="background-image: linear-gradient(rgba(99, 85, 94, 0.6), rgba(99, 85, 94, 0.6)),
                                                          url(<?php the_field('guides_bg', 24); ?>)">
                      <div class="container">
                        <div class="info__section-content">
                          <h1><?php the_field('guides_title', 24); ?></h1>
                        <?php 
                        $guides = get_field('guides_title', 24);
                        echo prefix_console_log_message($guides); ?>
                        
                          <span class="sub-headline"><?php the_field('guides_secondary_title', 24) ?></span>
                          <p><?php the_field('guides_content', 24) ?></p>
                          <a href="<?php echo site_url('/listing') ?>" class="btn btn-primary">Go to guides</a>
                        </div>
                      </div>
                    </section>

<?php get_footer(); ?>