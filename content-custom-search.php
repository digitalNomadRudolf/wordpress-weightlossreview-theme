            <?php $colcount = 0; 
								
							?>
							<div class="row weightloss-posts-container">
							<?php
							if($searchData) {
									global $post;
							foreach($searchData as $post){ 
											// modify the $post variable with the post data you want. Note that this variable must have this name!
											 
											setup_postdata( $post );
											
							?>
								
							
                			<div class="col-md-6">
                    			<div class="single-result">
                    					<div class="s-res-img">
                        					<img src="<?php the_post_thumbnail_url(); ?>" alt="post thumbnail" class="img-responsive">
                    					</div>
                    				<div class="s-res-info">
                        				by <span class="s-res-auth"><?php the_author(); ?></span>
                            				<span class="s-res-date">on <?php the_time('F wS Y'); ?></span>
                            					<h2 class="s-res-title"> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
                            					<!-- list the categories that this post belongs to -->
                            			
										<div class="cats">

												<?php 
												$count = 0;
												$categories = get_the_category($post->ID);
												foreach($categories as $category) {
													$count++;
													$add = ($count % 2) ? 'cat cornflower' : 'cat purple';
													echo '<span class="' . $add . '"><a href="'
													. get_category_link($category->term_id) . '">' .
													$category->name . '</a></span>'; 
												}
												?>
                            					
                            					<!-- <span class="cat purple">30 day challenges</span> -->
                            			</div> <!-- end cats -->

                    				</div> <!-- end s-res-info -->

                    			</div> <!-- end single-result -->

							</div> <!-- end col-md-6 -->
						<?php
							$colcount++;
							if(($colcount > 0) && ($colcount % 2 === 0)) { echo '</div><div class="row weightloss-posts-container">'; }

						}

						    /* place here the conditional logic for deciding to load the loadmore button */
							// dont display the button if there are not enough results
					
						?>	
						<?php
							}
						?>
							
							