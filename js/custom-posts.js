jQuery(document).ready(function ($) {

var page = 2;

$('.read-more').click(function(e){
    e.preventDefault();
    
    
    $.ajax({
        type: 'POST',
        url: get_ajax_posts.ajaxurl,
        dataType: "html",
        data: {
            action: 'get_ajax_posts',
            paged : page,
            posts_per_page : 4,
        },
        beforeSend: function(){
            $('.read-more').text('loading...')
        },
        success: function(response){
            $('.read-more').text('Show More');
        if(response != ''){
            $('.inner').append(response).hide().fadeIn(300);
            /* $('.inner').append(response).hide().fadeIn(1000); */
            page=page+1;
            }
            if(response == 0) {
                $('.read-more').hide();
                $('.blog-articles .container').append('<h4>No more results...</h4>');
            }  
        }
    });
    
    });
    

});
