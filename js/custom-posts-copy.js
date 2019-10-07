jQuery(document).ready(function ($) {

    var page = 2;
    
    $('.read-more').click(function(e){
        e.preventDefault();
        
        
        $.ajax({
            type: 'POST',
            url: get_ajax_posts.ajaxurl,
            dataType: "html",
            max_page: get_ajax_posts.max_page,
            data: {
                action: 'get_ajax_posts',
                paged : page,
                'max_page': get_ajax_posts.max_page,
                posts_per_page : 4,
            },
            beforeSend: function(){
                $('.read-more').text('loading...')
            },
            success: function(response){
                $('.read-more').text('Show More');
            if(response != ''){
                $('.inner').append(response);
                page=page+1;
                /* page++; */
                /* $.each(response, function(key, value){
                    $('.inner').append([value]);
                    console.log(key); 
                }); */
                }
                if(response == 0) {
                    $('.read-more').hide();
                    $('.blog-articles .container').append('<h4>No more results...</h4>');
                }  
            }
        });
        
        });
        
    
    });
    