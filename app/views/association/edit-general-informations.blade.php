@extends('template.theme')


@set_true $large_centred 
@section('large-content')
    <section>
        <div>
            <ul class="breadcrumb">
              <li><a href="#">Association</a> <span class="divider">/</span></li>
              <li><a href="/1-qsdf">Faites de la musique</a> <span class="divider">/</span></li>
              <li><a href="/1/edit">Edition</a> <span class="divider">/</span></li>
              <li class="active">Informations Generales</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/general-informations.edit_association')}}</h3>
            <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>

            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Nom de l'association sous lequel le public vous identifie</td>
                  <td>{{{$association->name}}}</td>
                  <td><a href="#" data-modal-form="display_name"><i class="icon-chevron-down"></i> Editer </a></td>
                </tr>
                <tr>
                  <td>Nom de l'association déposé en préfecture</td>
                  <td>{{{$association->legal_name}}}</td>
                  <td><a href="#" data-modal-form="legal_name"><i class="icon-chevron-down"></i> Editer </a><br> <a href="#"><i class="icon-remove"></i> Supprimer </a></td>
                </tr>
                <tr>
                  <td>Accronyme</td>
                  <td>{{{$association->acronym}}}</td>
                  <td><a href="#" data-modal-form="acronym_name"><i class="icon-plus"></i> Ajouter </a></td>
                </tr>
                <tr>
                  <td>But</td>
                  <td>{{{$association->goal}}}</td>
                  <td><a href="#" data-modal-form="goal"><i class="icon-chevron-down"></i> Editer </a><br> <a href="#"><i class="icon-remove"></i> Supprimer </a></td>
                </tr>
                <tr>
                  <td>Date de création</td>
                  <td>{{$association->official_date_creation}}</td>
                  <td><a href="#" data-modal-form="official_date_creation"><i class="icon-chevron-down"></i> Modifier </a></td>
                </tr>
                <tr>
                  <td>Site web </td>
                  <td>{{{$association->website_url}}}</td>
                  <td><a href="#" data-modal-form="website_url"><i class="icon-chevron-down"></i> Editer </a><br> <a href="#"><i class="icon-remove"></i> Supprimer </a></td>
                </tr>
                <tr>
                  <td>Siege</td>
                  <td>{{{$association->headquater}}}</td>
                  <td><a href="#" data-modal-form="headquater"><i class="icon-chevron-down"></i> Editer </a><br> <a href="#"><i class="icon-remove"></i>Supprimer </a></td>
                </tr>
                <tr>
                  <td>Association reconnue d'utilité publique </td>
                  <td>

                  {{{$association->admitted_public_utility_display()}}}</td>
                  <td><a href="#" data-modal-form="admitted_public_utility"><i class="icon-chevron-down"></i> Modifier </a></td>
                </tr>
              </tbody>
            </table>

            <p>En 2012 :</p>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>L'équipe</td>
                  <td>7 postes déclarés</td>
                  <td><a href="#"><i class="icon-chevron-down"></i> Modifier </a></td>
                </tr>
                <tr>
                  <td>Nombre de membre :</td>
                  <td>237</td>
                  <td><a href="#"><i class="icon-chevron-down"></i> Modifier </a></td>
                </tr>
                <tr>
                  <td>Nombre d'employés :</td>
                  <td>16000</td>
                  <td><a href="#"><i class="icon-chevron-down"></i> Modifier </a></td>
                </tr>
              </tbody>
            </table>
            <p class="text-right"><a href="#"><i class="icon-plus"></i> Ajouter </a> les statistiques d'une autre année</p>

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
        e.stopPropagation();
    })
    /*Modal form bind PART END*/
</script>
@stop
