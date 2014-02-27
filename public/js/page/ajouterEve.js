$(function() {
    
    $(document).ready(
        chargementSousCategorie()
    );
    $( "#deb" ).datepicker({
        showAnim: "blind",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],                 
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
    });
    $( "#fin" ).datepicker({
        showAnim: "blind",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],                 
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
    });
    function chargementSousCategorie(){
        $("select#sousCategorie").html('<option value="undefined">Chargement...</option>');
        $.ajax({
            url: "/search/sousCategorie",
            dataType: 'json',
            data: {id: $('#choixActivite').val()},
            success: function(j){
                var options = '';
                for (var i = 0; i < j.length; i++) {
                    options += '<option value="' + j[i].id + '">' + j[i].libelle + '</option>';
                }
                if(options==""){
                    options = '<option value="undefined">Aucun résultat</option>';
                }
                $("select#sousCategorie").html(options);
            }
        });
    };
    $('#choixActivite').one('focus',function(){
        chargementSousCategorie($(this).val());
    })
    $('#choixActivite').on('change',function(){
        chargementSousCategorie($(this).val());
    })


$('#ddd').datetimepicker({
    hourGrid: 4,
    minuteGrid: 10,
    showButtonPanel:1,
    timeOnlyTitle :'Choisisez l\'horaire',
    timeText :'Horaire',
    hourText :'Heure',
    minuteText: 'Minute',
    showAnim: "blind",
    dateFormat: "yy-mm-dd",
    closeText: "Valider",
    currentText: "Maintenant",
    dayNamesMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],                 
    monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"]   
});
$('#ddf').datetimepicker({
    hourGrid: 4,
    minuteGrid: 10,
    showButtonPanel:1,
    timeOnlyTitle :'Choisisez l\'horaire',
    timeText :'Horaire',
    hourText :'Heure',
    minuteText: 'Minute',
    showAnim: "blind",
    dateFormat: "yy-mm-dd",
    closeText: "Valider",
    currentText: "Maintenant",
    dayNamesMin: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],                 
    monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"]   
});



if($('#selectionTypeEvenement').val() == "repete"){
    $('#partie-non-repete').hide();
    $('#repete').hide();
}else{
    $('#partie-repete').hide();
    $('#nonrepete').hide();
    $('#selectionTypeEvenement').val("nonrepete");
}
$('#nonrepete').on('click',function(){
    $('#partie-non-repete').show();
    $('#partie-repete').hide();
    $('#selectionTypeEvenement').val('nonrepete');
    $('#repete').show();
    $('#nonrepete').hide();
})
$('#repete').on('click',function(){
    $('#partie-non-repete').hide();
    $('#partie-repete').show();
    $('#selectionTypeEvenement').val('repete');
    $('#repete').hide();
    $('#nonrepete').show();
})

var days = ["lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"];
$.each(days, function(){
    if(! $('#'+this).is(':checked')){
        $('#'+this+"heure").hide();
    }
    $('#'+this).on('change',function(){
        if(this.checked){
            $('#'+this.id+"heure").show();
        }else{
            $('#'+this.id+"heure").hide();
        }
    })
})
$('.heurePicker').each(function(){
    $(this).timepicker({
            hourGrid: 4,
            minuteGrid: 10,
            showButtonPanel:0,
            timeOnlyTitle :'Choisisez l\'horaire',
            timeText :'Horaire',
            hourText :'Heure',
            minuteText: 'Minute'
    });
});

$('#bouton-envoie').on('click',function(event){
    pb = false;
    if($('#nomEv').val().length < 5){
        pb = true;
        afficherErreur($('#nomEv'),'Le nom de votre évènement doit faire au minimun 5 caractères');
        console.log('nomEv trop court !');
    }
    
    if($('#sousCategorie').val() == "undefined" && $('#propositionSousCategorie').val().length == 0){
        pb = true;
        console.log('Pas de sous categorie !')
    }
    if($('#myhidden').val().length == 0){
        pb = true;
        afficherErreur($('#ville'),'Vous n\'avons pas correctement enregistré la ville');
        console.log('Pas de ville !')
    }
    if($('#adresse_reelle').val().length == 0){
        pb = true;
        afficherErreur($('#adresse_reelle'),'Vous devez renseigner ce champs, afin d\'aider les gens à retrouver votre évènement');
        console.log('Pas de precision sur le lieu !')
    }
    switch($('#selectionTypeEvenement').val()) {
        case "repete":
            if($('#deb').val().length == 0){
                pb = true;
                console.log('Pas de date de deb!')
            }
            if($('#fin').val().length == 0){
                pb = true;
                console.log('Pas de date de fin!')
            }
            if(! $('#semaine').is(':checked') && ! $('#2semaine').is(':checked')){
                pb = true;
                console.log('Pas de type de répétition!')
            }
            if(! $('#lundi').is(':checked') && ! $('#mardi').is(':checked') && ! $('#mercredi').is(':checked') && ! $('#jeudi').is(':checked') && ! $('#vendredi').is(':checked') && ! $('#samedi').is(':checked') && ! $('#dimanche').is(':checked')){
                pb = true;
                console.log('Pas de jour selectionné!')
            }
            $('.heurePicker:visible').each(function(index){
                if($(this).val().length == 0)
                    console.log('Heure visible non remplie selectionné!')
            })
        break;
        case "nonrepete":
            if($('#ddd').val().length == 0){
                pb = true;
                afficherErreur($('#ddd'),'Vous devez cliquez sur le champs et choisir la date');
                console.log('Pas de date !')
            }
        break;
    }
    if(pb)
        event.preventDefault();
})

});