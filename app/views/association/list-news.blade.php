@extends('template.theme')


@set_true $medium_centred 
@section('medium-content')
    <section>
        <div>
            <ul class="breadcrumb">
                <li><a href="/">Liste des Associations</a> </li>
                <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> </li>
                <li><a href="/{{$association->id}}/edit">Edition</a> </li>
                <li class="active">Mes publications</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/news.select_news')}} </h3>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{$id_wall_news}}/news/0/edit">{{Lang::get('association/edit/news.create_news')}}</a>
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
                    @foreach($news as $key => $new)
                            <tr>
                            <td>
                        @foreach($new['data'] as $partial)
                            @if($partial['type']=="PartialTitle")
                                {{{$partial['title']}}}
                            @endif
                        @endforeach
                            </td>
                            <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($new['updated_at']))->diffForHumans()}}</td>
                            <td><i class="fa fa-remove"></i></td>
                            <td><a href="{{$id_wall_news}}/news/{{$new['id_news']}}/edit"> Editer</a></td>
                            </tr>
                    @endforeach
                </tbody>

            </table>

            </div>
        </div>
    </section>
@stop