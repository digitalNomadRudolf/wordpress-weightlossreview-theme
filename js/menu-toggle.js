jQuery(document).ready(function($){
    $("button.navbar-toggle.collapsed").toggle(
        function() { $('.navbar-collapse.collapse').css({ 'display' : 'block' });
        },
        function() { $('.navbar-collapse.collapse').css({'display' : 'none'});
    });
});