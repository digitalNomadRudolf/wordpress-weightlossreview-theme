                                        <?php

$paged = $_POST['page'];
$get_products = new WP_Query(array( 
    'post_type'     => 'product', 
    'status'        => 'publish', 
    'posts_per_page'=> 4,
    'paged'         => $paged
));
                                        

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
                                                /* wp_reset_postdata(); */
                                              ?>
                                            <div class="rm-btn">
                                              <button class="read-more btn">Show More</button>
                                            </div>
                                            <?php
                                                print_r(get_site_url());
                                                if($get_products->post_count <= 4){
                                                  ?>
                                                  <div class="no-more">No more projects</div>
                                                  <?php
                                                } else {
                                            ?>
                                            <div class="rm-btn">
                                              <button class="read-more btn">Show More</button>
                                            </div>
                                          <?php
                                                }
                                            ?>