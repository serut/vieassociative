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
            {{getenv('PATH')}}
            <hr>
                <div class="pull-right">
                    <a class="button button-blue" href="file/upload">{{Lang::get('association/edit/news.create_news')}}</a>
                    <a class="button button-blue" href="file/crop">{{Lang::get('association/edit/news.create_news')}}</a>
                </div>
            </div>
        </div>
    </section>
@stop