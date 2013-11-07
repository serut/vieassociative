@extends('template.theme')


@set_true $large_centred 
@section('large-content')
    <section>
        <div>
            <ul class="breadcrumb">
              <li><a href="#">Association</a> <span class="divider">/</span></li>
              <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <span class="divider">/</span></li>
              <li><a href="/{{$association->id}}/edit">Edition</a> <span class="divider">/</span></li>
              <li class="active">Informations Generales</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/general-informations.edit_association')}}</h3>
            <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>

            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Nom de l'association sous lequel le public vous identifie</td>
                  <td>{{{$association->name}}}</td>
                  <td><a href="#" data-modal-form="name"><i class="icon-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Nom de l'association déposé en préfecture</td>
                  <td>{{{$association->legal_name}}}</td>
                  <td><a href="#" data-modal-form="legal_name"><i class="icon-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Acronyme</td>
                  <td>{{{$association->acronym}}}</td>
                  <td><a href="#" data-modal-form="acronym"><i class="icon-pencil"></i></td>
                </tr>
                <tr>
                  <td>But</td>
                  <td>{{{$association->goal}}}</td>
                  <td><a href="#" data-modal-form="goal"><i class="icon-pencil"></i></a><br></td>
                </tr>
                <tr>
                  <td>Date de création</td>
                  <td>{{$association->official_date_creation}}</td>
                  <td><a href="#" data-modal-form="official_date_creation"><i class="icon-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Site web </td>
                  <td>{{{$association->website_url}}}</td>
                  <td><a href="#" data-modal-form="website_url"><i class="icon-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Siege</td>
                  <td>{{{$association->headquater}}}</td>
                  <td><a href="#" data-modal-form="headquater"><i class="icon-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Association reconnue d'utilité publique </td>
                  <td>

                  {{{$association->admitted_public_utility_display()}}}</td>
                  <td><a href="#" data-modal-form="admitted_public_utility"><i class="icon-pencil"></i></td>
                </tr>
                <tr>
                  <td>Statuts de l'association </td>
                  <td>

                  </td>
                  <td><a href="#" data-modal-form="statuts"><i class="icon-pencil"></i></td>
                </tr>
                <tr>
                  <td>Réglement intérieur </td>
                  <td>

                  </td>
                  <td><a href="#" data-modal-form="internal_regulation"><i class="icon-pencil"></i></td>
                </tr>
                <tr>
                  <td>Adresse de contact </td>
                  <td>
                  {{{$association->contact_adress}}}</td>
                  <td><a href="#" data-modal-form="contact_adress"><i class="icon-pencil"></i></td>
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
        e.stopPropagation();
    })
    /*Modal form bind PART END*/
</script>
@stop
