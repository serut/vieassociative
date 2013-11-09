@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
    <section>
        <div>
            <ul class="breadcrumb">
                <li><a href="#">Association</a> <span class="divider">/</span></li>
                <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <span class="divider">/</span></li>
                <li><a href="/{{$association->id}}/edit">Edition</a> <span class="divider">/</span></li>
                <li class="active">Mes publications</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/news.select_news')}} </h3>
            <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>
            <hr>
                <div class="pull-right">
                    <a class="button button-blue" href="news/0/edit">{{Lang::get('association/edit/news.create_news')}}</a>
                </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Titre</td>
                        <td>Dernière modification</td>
                        <td>Publié</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $n)
                    <tr>
                        <td>{{{$n->title}}}</td>
                        <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($n->updated_at))->diffForHumans()}}</td>
                        <td><i class="icon-remove"></i></td>
                        <td><a href="news/{{$n->id}}/edit"> Editer</a></td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

            </div>
        </div>
    </section>
@stop