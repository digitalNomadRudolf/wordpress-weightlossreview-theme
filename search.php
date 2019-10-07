<?php get_header(); ?>

	 <!-- full width bar at the top with introductory paragraph and title -->
	 <section class="top-bar">
                        <div class="container">
                       		<div class="top-bar__introduction--search">
                         		<h1>Search results for <?php the_search_query(); ?></h1>
						 
						 <p class="top-bar__introduction--search-description">There <?php 
								/* global $wp_query; */
								$total_results = $wp_query->found_posts;
								$resultword = ($total_results < 2 && $total_results !== 0) ? ' result' : ' results';
								$charcount = ($total_results < 2 && $total_results !== 0) ? 'is ' : 'are ';
								echo $charcount;
								echo $total_results;
								echo $resultword;
						 ?> for your search.
                         </p>
						 
								
                       </div>
                    </div>
	</section>
	


	<!--  main section that contains the article content, main image and perhaps comment section(arrange this in WP), references and links to related articles -->
	<section class="sub-main">
		<div class="container">
    		<div class="xtraTopMarge">

        		<div class="row"> 
            		<!-- most popular products / products highest reviews -->
            		<!-- this page will list sections that each contain a title, image and some text previewing an article  -->
            		<!-- here i will make some static sections but later these will be dynamically fetched from the WP database -->
            		
					<div class="search-page-results">

						<?php  
						get_template_part('content', 'search');
						?>


						</div>
						
					</div>
				</div>
			</div>
</section>

<?php get_footer(); ?>