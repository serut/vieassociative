@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
    <section>
        <div>
            <ul class="breadcrumb">
              <li><a href="#">Association</a> </li>
              <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> </li>
              <li><a href="/{{$association->id}}/edit">Edition</a> </li>
              <li class="active">L'historique</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/history.history')}} </h3>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Titre</td>
                        <td>Date de publication</td>
                        <td>Publié</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Titre news 2</td>
                        <td>03-10-2001 17:16:18</td>
                        <td><i class="fa fa-ok"></i></td>
                        <td><a href="news/1/edit"> Editer</a></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Titre news 2</td>
                        <td>17-09-2000 17:18:19</td>
                        <td><i class="fa fa-remove"></i></td>
                        <td><a href="news/1/edit"> Editer</a></td>
                    </tr>
                </tbody>

            </table>

            </div>
        </div>
    </section>
@stop