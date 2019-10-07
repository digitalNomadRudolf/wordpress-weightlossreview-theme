<?php get_header(); ?>

                <?php  

                    $args = array(
                        'post_type' => 'productreviews',
                        'post_status' => 'publish',
                        'posts_per_page' => '3'
                    );

                    $query = new WP_Query($args);
                    $post_type = get_post_type($post->ID);
                ?>

                 <!-- full width bar at the top with introductory paragraph and title -->
                 <section class="top-bar">
                        <div class="container">
                       <div class="top-bar__introduction top-list">
                         <h1>This is the <?php echo $post_type; ?> overview.</h1>
                         <p class="top-bar__introduction--list-description">
                          Here you will find an overview of all our <?php echo $post_type; ?>'s.
                          Feel free to browse around.
                         </p>
                       </div>
                    </div>
                   </section>


                    <!--  main section that contains the article content, main image and perhaps comment section(arrange this in WP), references and links to related articles -->
                   <section class="sub-main">
                           <div class="xtraTopMarge">
                               <div class="row">
                                   

                                    <!-- most popular products / products highest reviews -->
                            

                                    <!-- this page will list sections that each contain a title, image and some text previewing an article  -->
                                    <section class="listing-main">
                                      <div class="container">
                                        <div class="row">
                                          <h1 class="main-title">Main Products</h1>


                                          <?php
                                                $i = 0;
                                                if(have_posts()):
                                                while($query->have_posts()) : $query->the_post();
                                                $classname = (
                                                  ($i == 0) ? 'left' : 
                                                    (($i == 1) ? 'center' : 
                                                    (($i == 2) ? 'right' : '')));
                                                
                                                /* print_r($classname . $i); */
                                          ?>

                                          <div class="col-md-4 <?php echo $classname ?>-prod">
                                            <div class="prod-img">
                                              <img class="img-responsive" src="<?php the_post_thumbnail_url(); ?>" alt="product image">
                                            </div>
                                            <div class="prod-info">
                                              <h1 class="title"><?php the_title(); ?></h1>
                                              <p class="descr"><?php the_excerpt(); ?></p>
                                              <button class="cta btn btn-primary"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></button>
                                            </div>
                                          </div>
                                          
                                          <?php
                                          $i++;                                          
                                          
                                          endwhile;
                                          endif;
                                          wp_reset_postdata();
                                          ?>

                                        </div>
                                      </div>
                                    </section>
                                    <!-- here i will make some static sections but later these will be dynamically fetched from the WP database -->
                                    <!-- full-width section with featured / popular product or program -->

                                    <?php  

                                        $args = array(
                                            'post_type'      => 'product',
                                            'post_status'    => 'publish',
                                            'posts_per_page' =>  1,
                                            'category__in'    => array( 9 ),
                                        );

                                        $new_query = new WP_Query($args);
                                    ?>

                                      <!-- <small><?php /* the_category(); */ ?></small> -->
                                    <section class="popular-prod">
                                      <div class="container">
                                        <div class="row">

                                        <?php

                                            while($new_query->have_posts()) : $new_query->the_post();
                                            /* print_r($new_query); */
                                        ?>

                                          <div class="col-md-6 left-col-wrap">
                                            <div class="left__col">
                                            <h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                            <p class="descr"><?php the_excerpt(); ?></p>
                                            <p class="descr"><?php the_field('featured_product_ex', 86); ?></p>
                                            </div>
                                          </div>
                                          <div class="col-md-6 right__col" style="background-image: url(<?php the_field('featured_product_image', 86); ?>)">                                            
                                          </div>
                                          <?php  
                                              endwhile;
                                              wp_reset_postdata();
                                          ?>
                                        </div>
                                      </div>
                                    </section>


                                    <?php  

                                          /* $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; */
                                          $paged = get_query_var('paged', 1);
                                          $get_products = new WP_Query(array( 
	                                          'post_type'     => 'product', 
	                                          'status'        => 'published', 
	                                          'posts_per_page'=> 4,
	                                          'paged'         => $paged
                                          ));

                                    ?>
                                    <!-- after 4 or so articles comes a section with the blog articles / reviews in a column layout style 2 or 3 -->
                                    <section class="blog-articles">
                                      <div class="container">
                                        <div class="row">
                                          <div class="inner">
                                            <h1 class="title">More Products</h1>
                                            <?php
                                        

                                              $colcount = 0;

                                              if($get_products->have_posts()) : 
                                                while($get_products->have_posts()) : 
                                                  $get_products->the_post()

                                            ?>

                                            <div class="col-md-3 blog-col">
                                              <div class="front-part">
                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="article image" class="img-responsive">
                                              </div>
                                              <div class="back-part">
                                                <!-- this will be a purple square serving as a design element. on mouseover this element will grow to cover the whole bg -->
                                              </div>
                                              <h2 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            </div>
                                              <?php 
                                              $colcount++;
                                              if(($colcount > 0) && ($colcount % 4 === 0)) { echo ''; }

                                                endwhile;
                                                endif;
                                                wp_reset_postdata();
                                              ?>
                                              
                                            <?php
                                                /* print_r(get_site_url()); */
                                                if($get_products->post_count <= 4){
                                                  ?>
                                                  <!-- <div class="no-more">No more products</div> -->
                                                  <?php
                                                } else {
                                            ?>
                                            <div class="rm-btn">
                                              <button class="review-more btn">Show More</button>
                                            </div>
                                          <?php
                                                }
                                            ?>
                                          </div>
                                        </div>
                                      </div>
                                    </section>
                                    
                                    <div class="rm-btn">
                                        <button class="review-more btn">Show More</button>
                                    </div>
                                    

                               </div>
                           </div>
                   </section>


<?php get_footer(); ?>