<?php get_header(); ?>

                <!-- full width bar at the top with introductory paragraph and title -->
                <section class="top-bar">
                        <div class="container">
                       <div class="top-bar__introduction">
                         <h1><?php the_title(); ?></h1>
                         <p class="top-bar__introduction--description">
                             <?php the_field('privacy_excerpt') ?>
                         </p>
                       </div>
                    </div>
                   </section>

                  <!--  main section that contains the article content, main image and perhaps comment section(arrange this in WP), references and links to related articles -->
                   <section class="sub-main">
                       <div class="container">
                           <div class="xtraTopMarge">
                               <div class="row">
                                   <div class="col-lg-12">
                                    <div class="sub-main__col--left">
                                            <!-- container for the main content -->
                                        <div class="sub-main__col--left-content">
                                            <!-- start off with the big image -->
                                            <img src="<?php  ?>" class="img-responsive" alt="">
                                            <h2><?php the_title(); ?></h2>
                                            
                                                <?php the_field('privacy_content'); ?>
                                        </div>
                                      </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </section>


<?php get_footer(); ?>