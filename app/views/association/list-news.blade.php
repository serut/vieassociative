@extends('template.theme')


@set_true $large_centred 
@section('large-content')
    <section>
        <div>
            <ul class="breadcrumb">
                <li><a href="/">Association</a> <col-lg- class="divider">/</col-lg-></li>
                <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <col-lg- class="divider">/</col-lg-></li>
                <li><a href="/{{$association->id}}/edit">Edition</a> <col-lg- class="divider">/</col-lg-></li>
                <li class="active">Mes publications</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/news.select_news')}} </h3>
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
                        @foreach($new['data'] as $partial)
                            @if($partial['type']=="PartialTitle")
                                <td>{{{$partial['title']}}}</td>
                                <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($new['updated_at']))->diffForHumans()}}</td>
                                <td><i class="fa fa-remove"></i></td>
                                <td><a href="news/{{$key}}/edit"> Editer</a></td>
                            @endif
                        @endforeach
                            </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="text-right">
                <a class="button button-green" href="news/0/edit">{{Lang::get('association/edit/news.create_news')}}</a>
            </div>

            </div>
        </div>
    </section>
@stop