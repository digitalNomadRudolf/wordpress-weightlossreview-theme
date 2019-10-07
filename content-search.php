<?php $colcount = 0; 
								
							?>

							<div class="row weightloss-posts-container">
							<?php
							if($wp_query->have_posts()) {
							while($wp_query->have_posts()) {
								$wp_query->the_post(); ?>

							<div class="col-md-6 col-sm-12">
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
							if($colcount % 2 === 0) { echo '</div><div class="row weightloss-posts-container">'; }

						}

						    /* place here the conditional logic for deciding to load the loadmore button */
							// dont display the button if there are not enough results
							if($wp_query->max_num_pages > 1) :
						?>	
						<!-- <button class="btn s-res-more">More</button> -->
							<?php endif; ?>
						

		
						
						<?php
							} else {
								
								?>
									<h1 class="title">No Searches found!</h1>
                						<p class="search-text">Give it another try...</p>

										<div class="searchresult-form-wrap">
											<?php get_search_form(); ?>
										</div>
								<?php
							}

									 
										/* echo paginate_links(); */
									?>

								 
							</div>
							<button class="btn s-res-more">More</button>
							<?php
										/* $term = $_GET['s'];
										if(empty($term)){
   										$term = '';
										}
										 */
							?>
							
							