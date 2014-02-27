function chargerPageListeEvenement(lat, lng){
	window.location.href = "/evenement/liste-evenement?lat="+lat+"+&lng="+lng+"+&rayon="+$("#km").val();
}
$(function() {
    $('.dropdown-toggle-test').dropdown();
    $('#myTab a:last').tab('show');
    $('#myTab a').click(function (e) {
    	e.preventDefault();
    	$(this).tab('show');
    	$('#myTab .current').removeClass("current");
    	$(this).addClass("current");
    })
    $( "#ville" ).autocomplete({
        source: "/search/ville",
        minLength: 2,
        search: function( event, ui ) {
        	resetVilleTrouve();
        },
        select: function( event, ui ) {
            $('.dropdown-toggle-test').dropdown.prototype.keydown;
            $('#ville').val(ui.item.label);
            $('#idVilleBDD').val(ui.item.id);
            event.preventDefault();
            $('#ville').one('keypress',function(){
                $('#idVilleBDD').val("0");
            });
            selected = true;
        }
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
    	$(".liste-ville").show();
        inner_html = '<div class="gig-opts"><span><a href="#changement-page" onclick="chargerPageListeEvenement('+item.latitude+','+item.longitude+')">VOIR</a></span><span>'+item.label+'</span></div>';
        return $('<div class="span6 ville_found"></div>')
            .append(inner_html)
            .appendTo(".liste-ville li");
    };

    
    function resetVilleTrouve(){
    	$(".ville_found").each(function(){
    		$(this).remove();
    	});
    }
    
    $( "#slider-km" ).slider({
        range: "min",
        value: 15,
        min: 0,
        max: 250,
        step: 5,
        slide: function( event, ui ) {
            $("#km").val(ui.value);
            if(ui.value < 100){
                $( ".km-affiche" ).html( '&nbsp;'+ui.value + '&nbsp;');
            }else{
                $( ".km-affiche" ).html(ui.value);
            }
        }
    });
    

});