$(document).ready(function(){

    // tooltip
    $("a[rel^='tooltip']").tooltip();
    $("img[rel^='tooltip']").tooltip();

	
    //prettyPhoto
    $('a[data-rel]').each(function() {
        $(this).attr('rel', $(this).data('rel'));
    });
    $("a[rel^='prettyPhoto']").prettyPhoto();
    

});
