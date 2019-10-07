/* jQuery(document).ready(function ($) {
    $(document).ready(function() {

        var page = 1;
    $(".s-res-more").click(function(e) {
        e.preventDefault();

        var btn = $(".s-res-more");
        btn.text('loading...');
        var search_val=$("#s").val();
        


        $.ajax({
            type : "POST",
            url : "./wp-admin/admin-ajax.php",
            data : {
                action : 'weightloss_search',
                search_string : search_val,
                page : page
            },
            error: function(data) {
                console.log(data);
            },
            success: function(data) {
                page++;
                if(data) {
                    $('.search-page-results').append(data);
                
                console.log(search_val);
                console.log(page);
                }
                if(data != search_val) {
                    $('.search-page-results').append('<div class="text-center"><h3>You reached the end of the line!</h3><p>No more posts to load.</p></div>');
                    $('.s-res-more').hide();
                } else {
                   
                } 
              }
            });
        });
    });
});
 */