$(function() {
    $('.dropdown-toggle-test').dropdown();

    $( "#ville" ).autocomplete({
        source: "/search/ville",
        minLength: 2,
        select: function( event, ui ) {
            $('.dropdown-toggle-test').dropdown.prototype.keydown;
            $('#ville').val(ui.item.label);
            $('#myhidden').val(ui.item.id);
            event.preventDefault();
            $('#ville').one('keypress',function(){
                $('#myhidden').val("0");
            })
        },
        error: function(xhr, status, error) {
            $( "#ville" ).autocomplete("destroy");
            console.log('Unbindé ?')
            $( "#ville" ).autocomplete({
                source:  "/search/ville",
                minLength: 2,
                select: function( event, ui ) {
                    $('.dropdown-toggle-test').dropdown.prototype.keydown;
                    $('#ville').val(ui.item.label);
                    $('#myhidden').val(ui.item.id);
                    event.preventDefault();
                    $('#ville').one('keypress',function(){
                        $('#myhidden').val("0");
                    })
                }
            })
        }
    });
    $(function() {
        $( "#slider-km" ).slider({
            range: "min",
            value: 15,
            min: 0,
            max: 250,
            step: 5,
            slide: function( event, ui ) {
                $("#km").val(ui.value);
                $( ".km-affiche" ).html(ui.value);
            }
        });
        $( "#km" ).val(+ $( "#slider-km" ).slider( "value" ));
    });


    $(function(){
        $(".index-site .btn-subscribe").on('click', function(event){
            if($('#myhidden').val()!=0){
                $(this).html("En cours... ");
            }else{
                $(".errors-recherche").html('Il y a une erreur dans le champs de la ville : veuillez recommercer sa saisie');
                $('#ville').one('keypress',function(){
                        $(".errors-recherche").fadeOut("slow");
                })
                event.preventDefault();
            }
        })
    });

});
function dirname(path) {
    return path.replace(/\/[^\/]*$/,'');
}
