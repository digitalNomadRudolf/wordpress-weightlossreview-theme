jQuery(document).ready(function($) {

    var page = 2;
    
    $('.review-more').click(function(e){
        e.preventDefault();
        
        
        $.ajax({
            type: 'POST',
            url: ajax_productreview_posts.ajaxurl,
            dataType: "html",
            data: {
                action: 'ajax_productreview_posts',
                paged : page,
                posts_per_page : 4,
            },
            beforeSend: function(){
                $('.review-more').text('loading...')
            },
            success: function(response){
                $('.review-more').text('Show More');
            if(response != ''){
                $('.inner').append(response).hide().fadeIn(300);
                /* $('.inner').append(response).hide().fadeIn(1000); */
                page=page+1;
                }
                if(response == 0) {
                    $('.review-more').hide();
                    $('.blog-articles .container').append('<h4>No more results...</h4>');
                }  
            }
        });
        
        });
        
    
    });
    