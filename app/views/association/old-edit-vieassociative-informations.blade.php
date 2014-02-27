@extends('template.theme')


@set_true $large_centred 
@section('large-content')
    <section>
        <div>
            <ul class="breadcrumb">
              <li><a href="#">Association</a> </li>
              <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> </li>
              <li><a href="/{{$association->id}}/edit">Edition</a> </li>
              <li class="active">Configuration VieAssociative</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/vieassociative-informations.edit_association')}}</h3>
            <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>

            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Niveau de protection du panel d'administration</td>
                  <td>N'importe qui peut proposer une modification.<br> Une validation de la modération est requis.</td>
                  <td><a href="#" data-modal-form="association_protection"><i class="fa fa-remove"></i> Désactiver </a></td>
                </tr>
                <tr>
                  <td>Categorie d'association</td>
                  <td>Musique - festivités</td>
                  <td><a href="#" data-modal-form="association_categories"><i class="fa fa-chevron-down"></i> Modifier </a></td>
                </tr>
                <tr>
                  <td>Secteur d'activité</td>
                  <td>Animations - Festivités - Culture - Restaurantions - Tournois <br>Musique : Electronique, Rock, Dub, Trance</td>
                  <td><a href="#" data-modal-form="activities"><i class="fa fa-chevron-down"></i> Modifier </a></td>
                </tr>
                <tr>
                  <td>Service proposés aux partenaires</td>
                  <td>Location de matériel de sonorisation</td>
                  <td><a href="#" data-modal-form="services_between_partners"><i class="fa fa-chevron-down"></i> Modifier </a></td>
                </tr>
                <tr>
                  <td>Module Galerie photo</td>
                  <td>Activé</td>
                  <td><a href="#" data-modal-form="module_photo"><i class="fa fa-remove"></i> Désactiver </a></td>
                </tr>
                <tr>
                  <td>Module Galerie évènements</td>
                  <td>Activé</td>
                  <td><a href="#" data-modal-form="module_evenement"><i class="fa fa-remove"></i> Désactiver </a></td>
                </tr>
                <tr>
                  <td>Module Flux des sites sociaux</td>
                  <td>Activé</td>
                  <td><a href="#" data-modal-form="module_social"><i class="fa fa-remove"></i> Désactiver </a></td>
                </tr>
                <tr>
                  <td>Module Galerie de sponsor</td>
                  <td>Activé</td>
                  <td><a href="#" data-modal-form="module_sponsor"><i class="fa fa-remove"></i> Désactiver </a></td>
                </tr>
                <tr>
                  <td>Module Présentation des prix</td>
                  <td>Activé</td>
                  <td><a href="#" data-modal-form="module_price"><i class="fa fa-remove"></i> Désactiver </a></td>
                </tr>
                <tr>
                  <td>Texte de la page d'acceuil</td>
                  <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo [..]</td>
                  <td><a href="#" data-modal-form="welcome_text"><i class="fa fa-chevron-down"></i> Editer </a><br> <a href="#"><i class="fa fa-remove"></i>Supprimer </a></td>
                </tr>
              </tbody>
            </table>


            </div>
        </div>
    </section>
@stop
@section('footer-js')
<script type="text/javascript">
    /*Modal form bind PART START*/
    var url = window.location.pathname.substr(1);
    var segments = url.split('/');
    var namePage = segments.pop();
    var id = segments[0];
    $('a[data-modal-form]').click(function(e){
        $.ajax({
            url: '/'+id+'/form/'+namePage+'/'+$(this).attr('data-modal-form'),
            dataType: "json",
        }).done(function ( data ) {
            modalForFormModification(data)
        }).fail(function() {
            alert("error");
        });
        e.preventDefault();
    })
    /*Modal form bind PART END*/
</script>
@stop
