<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <?php wp_head(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">        


    </head>
    <body  <?php body_class(); ?>  >
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
                    <!-- Navbar -->

                    <nav class="main-navigation navbar navbar-default" id="site-navigation" role="navigation">

                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          
                        </div>
                        
                        <a class="navbar-brand" href="<?php echo home_url(); ?>">Weight Loss Reviews</a>

                      <div class="collapse navbar-collapse" id="navbar-collapse-1">
                      
                      
                          <?php wp_nav_menu(array(
                            'theme_location'    => 'primary-menu',
                            /* 'depth'             => 3, */
                            'container'         => false,
                            'menu_class'        => 'nav navbar-nav navbar-left',
                            'walker'            => new Walker_Optimized(),
                            /* 'walker' => new walkernav() */
                          )); ?>

                             
                      
                          <?php wp_nav_menu(array(
                            'theme_location' => 'secondary-menu',
                            'container' => false,
                            'menu_class' => 'nav navbar-nav navbar-right',
                            'walker' => new Walker_Optimized(),
                          ));?>
                    

                      

                      </div><!-- end navbar-collapse -->

                      <!-- add search function -->
                      <div class="search-form-container">

                          <!-- the search icon -->
                          <?php get_search_form(); ?>
                      </div>
                    </nav>