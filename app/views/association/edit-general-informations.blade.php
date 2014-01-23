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

            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Nom de l'association sous lequel le public vous identifie</td>
                  <td>{{{$association->name}}}</td>
                  <td><a href="#" data-modal-form="name"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Nom de l'association déposé en préfecture</td>
                  <td>{{{$association->legal_name}}}</td>
                  <td><a href="#" data-modal-form="legal_name"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Acronyme</td>
                  <td>{{{$association->acronym}}}</td>
                  <td><a href="#" data-modal-form="acronym"><i class="fa fa-pencil"></i></td>
                </tr>
                <tr>
                  <td>But</td>
                  <td>{{{$association->goal}}}</td>
                  <td><a href="#" data-modal-form="goal"><i class="fa fa-pencil"></i></a><br></td>
                </tr>
                @if(App::environment() != "production")
                <tr>
                  <td>Date de création</td>
                  <td>{{$association->official_date_creation}}</td>
                  <td><a href="#" data-modal-form="official_date_creation"><i class="fa fa-pencil"></i></a></td>
                </tr>
                @endif
                <tr>
                  <td>Site web </td>
                  <td>{{{$association->website_url}}}</td>
                  <td><a href="#" data-modal-form="website_url"><i class="fa fa-pencil"></i></a></td>
                </tr>
                @if(App::environment() != "production")
                <tr>
                  <td>Siege</td>
                  <td>{{{$association->headquarter}}}</td>
                  <td><a href="#" data-modal-form="headquarter"><i class="fa fa-pencil"></i></a></td>
                </tr>
                @endif
                <tr>
                  <td>Association reconnue d'utilité publique </td>
                  <td>{{{$association->admitted_public_utility_display()}}}</td>
                  <td><a href="#" data-modal-form="admitted_public_utility"><i class="fa fa-pencil"></i></td>
                </tr>
                <tr>
                  <td>Image de couverture</td>
                  <td><img src="{{$association->getCover()}}" class="span4"></td>
                  <td><a href="/{{$association->id}}/edit/file/{{$association->id_folder}}/940x350-cover"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Logo</td>
                  <td><img src="{{$association->getLogo()}}" class="span4"></td>
                  <td><a href="/{{$association->id}}/edit/file/{{$association->id_folder}}/200x200-logo"><i class="fa fa-pencil"></i></a></td>
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
            modalForFormModification(data);
        }).fail(function() {
            alert("error");
        });
        e.preventDefault();
    })
    /*Modal form bind PART END*/
</script>
@stop
