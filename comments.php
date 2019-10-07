<?php

if(post_password_required()){
    //block execution of the script if post is password protected 
    return;
}

?>

<section id="comments" class="comments comments-area">
    
    <?php 
        if(have_comments()) :
            //We have comments

    ?>
    <div class="container">
        <div class="row">
            <h1 class="comments-title">
                <?php printf(
                    esc_html( _nx('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title') ),
                        number_format_i18n( get_comments_number() ), 
                        '<span>' . get_the_title(). '</span>'
                    ); 
                
                ?>
            </h1>

                    <?php /* weightloss_get_post_navigation(); */ ?>

    <div class="col-md-12">
        <div class="comment-wrap">
            <ul class="comments-list">

            
        <?php 

        $args  = array(
            'walker'            => null,
            'max_depth'         => '',
            'style'             => 'ul',
            'callback'          => 'format_comment',
            'end-callback'      => null,
            'type'              => 'all',
            'reply_text'        => 'Reply',
            'page'              => '',
            'per_page'          => '',
            'avatar_size'       => 67,
            'reverse_top_level' => true,
            'reverse_children'  => '',
            'format'            => '',
            'short_ping'        => false,
            'echo'              => true
        );
        
        wp_list_comments($args); ?>

            </ul>
        </div> <!-- comment wrap -->
    </div> <!-- col-md-12 -->
    <?php /* weightloss_get_post_navigation(); */ ?>

    <?php
        if(!comments_open() && get_comments_number()):
            ?>

        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'weightlossreviews'); ?></p>

    <?php  
        endif;
    ?>

    <?php 
        endif;
    ?>

    <?php 

    $fields = array(

        'author' => 
            '<div class="col-sm-4 name-col">' .
            '<label for="author">' . __( 'Name', 'domainreference' ) .
            '</label><span class="required">*</span><input id="author" name="author" type="text" placeholder="your name here..." value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div>',   
        'email' =>
            '<div class="col-sm-4 email-col">' .
			'<label for="email">' . __( 'Email', 'domainreference' ) . '</label> <span class="required">*</span><input id="email" name="email" placeholder="your email address here..." type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" /></div>',	
        
    );

    $args = array(

        'class_submit' => 'submit',
        'id_form' => 'comment-form',
        /* 'comment_notes_before' => '<p class="comment-notes">' . __( '' ) . ( $req ? $required_text : '' ) . '</p>', */
        'title_reply_before' => '<h2 class="comments-form-title">',
        'title_reply' => __('Leave a Reply'),
        'title_reply_after' => '</h2>',
        'label_submit' => __('Submit Comment'),
        'comment_field' =>
        '<label for="comment" class="l-comment">' . _x( 'Comment:', 'noun' ) . '</label> <span class="required"></span><textarea id="comment" class="form-control" name="comment" rows="4" required="required" placeholder="type your comment"></textarea>',
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
			
    );
       ?> 

                </div><!-- .comments-area -->
            </div> <!-- row -->
        </div> <!-- container -->

        <div class="container">
            <div class="row">
                <div class="comments-form">
	<?php	comment_form( $args ); 
		
	?>
            </div> <!-- comments form -->
        </div> <!-- row -->
    </div> <!-- container -->
</section> <!-- comments area -->