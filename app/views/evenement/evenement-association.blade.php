@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
    <section>
        <div>
            <ul class="breadcrumb">
              <li><a href="#">Association</a> <span class="divider">/</span></li>
              <li><a href="/1-qsdf">Faites de la musique</a> <span class="divider">/</span></li>
              <li><a href="/1/edit">Edition</a> <span class="divider">/</span></li>
              <li class="active">Mes évènements</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/evenement.select_evenement')}} </h3>
            <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>
            <hr>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Titre évènement 1</td>
                  <td>16-18 juin 2013</td>
                  <td><a href="evenement/1/edit"> Editer</a></td>
                </tr>
                <tr>
                  <td>Titre évènement 2</td>
                  <td>16-18 juin 2013</td>
                  <td><a href="evenement/2/edit"> Editer</a></td>
                </tr>
                <tr>
                  <td>Titre évènement 3</td>
                  <td>13 avril 2014</td>
                  <td><a href="evenement/3/edit"> Editer</a></td>
                </tr>
                <tr>
                  <td>Titre évènement 4</td>
                  <td>16 mai 2014</td>
                  <td><a href="evenement/4/edit"> Editer</a></td>
                </tr>

              </tbody>
            </table>

            </div>
        </div>
    </section>
@stop
@section('footer-js')
<script type="text/javascript">
</script>
@stop
