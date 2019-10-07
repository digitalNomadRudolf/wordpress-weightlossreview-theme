var pid =1;
var limit=4;
var found_rows=0;
jQuery(function($){
	    $('body').on('click','.s-res-more',function(){
        pid = pid+1;
        var button = $(this),
        search_val=$("#s").val();
		var getDivData = $('.search-page-results .weightloss-posts-container').length;
		console.log('total row'+getDivData);
        $.ajax({
            /* url : './wp-admin/admin-ajax.php', */
            url : weightloss_loadmore_params.ajaxurl,
            data : {
				'action' : 'loadmore',
				'search_string' : search_val,
				'p_id' : pid,
				'post_type' : 'any',
				'exist_rows':getDivData+limit,
				'found_rows':found_rows
			},
            type : 'POST',
			dataType: "json",
            beforeSend : function(xhr){
                button.text('Loading...');
            },
            success : function(data){
                console.log(data.num_rows);

				
                if(parseInt(data.num_rows) > 0) {
                    button.text('More results').prev().before(data);
                    $('.search-page-results').append(data.html);
					console.log('result '+data.found_posts);
					console.log('result=> '+(getDivData+2));

                    if( parseInt(data.found_posts) <= (getDivData+limit)) {
                        console.log(data.found_posts);
                        $('.s-res-more').remove();
                        $('.search-page-results').append('<h3>No more results to display...</h3>');
                    } 
                     }else{
                        console.log(data.found_posts);
						found_rows = data.found_posts;
                        $('.s-res-more').remove();
						 /* $('.search-page-results').append('<button class="btn s-res-more">More</button>'); */
					
                }
                if(data.num_rows == 0) {
                    $('.s-res-more').remove();
                    $('.search-page-results').append('<h3>No more results to display...</h3>');
                }
            }
        });

    });
});