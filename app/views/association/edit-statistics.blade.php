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
