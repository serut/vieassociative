@extends('template.theme')


@set_true $small_centred 
@section('small-content')
    <div>
        <div id="answers">
            <section class="span7">
            <div>
                <ul class="breadcrumb">
                  <li><a href="#">Association</a> <span class="divider">/</span></li>
                  <li><a href="/{{$association->id}}-qsdf">{{{$association->name}}}</a> <span class="divider">/</span></li>
                  <li><a href="/{{$association->id}}/edit">Edition</a> <span class="divider">/</span></li>
                  <li class="active">{{$discussion->title}}</li>
                </ul>
            </div>
            
        @if(!empty($posts))
            @foreach($posts as $p)
                <div data-id="{{$p->id}}">
                    @if($p->level == 2)
                        <div class="span-comment-space-2 pull-left">
                        </div>
                    @endif
                    @if($p->level == 3)
                        <div class="span-comment-space-3 pull-left">
                        </div>
                    @endif
                    <div class="row">
                        <div class="span-image pull-left">
                            <img src="/img/items/user-thumb.jpg" alt="placeholder+image">
                        </div>
                            <div class="
                        @if($p->level == 1)
                            span5
                        @endif
                        @if($p->level == 2)
                            span17
                        @endif
                        @if($p->level == 3)
                            span7
                        @endif
                            ">
                            <span class="author"><a href="#profil">{{$p->author->username}}</a></span>
                            <span class="light">- {{\Carbon\Carbon::createFromTimeStamp(strtotime($p->created_at))->diffForHumans()}}</span><br>
                            <div>
                                {{$p->content}}
                            </div>
                                <div>
                                    <span class="count-vote">{{$p->vote}}</span>
                                     <i class="fa fa-chevron-up"></i>
                                    | <i class="fa fa-chevron-down"></i>
                                    @if($p->level != 3)
                                        <a class="light answer" href="#">Répondre</a> 
                                    @endif
                                    @if(!empty($p->proposition) && $is_admin)
                                        <a class="text-success validate" data-proposition="{{$p->proposition->id}}" href="#">Valider</a> 
                                        <a class="text-warning refuse" data-proposition="{{$p->proposition->id}}" href="#">Refuser</a> 
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            Il n'y a pas de commentaire pour le moment
        @endif
        @if (Auth::check())

            <div class="form-answer">
                <div class="row">
                    <div class="span-image pull-left">
                        <img src="/img/items/user-thumb.jpg" alt="placeholder+image">
                    </div>
                    <div>
                        {{ Form::open(array('class'=> 'form','url' => '/discussion/add', 'data-validate'=>'our-parsey-1')) }}

                        <textarea name="text" rows="4" id="text" class="input-xxlarge nicEditor-textarea" onclick="launchEditor($(this))"></textarea>
                        <br>
                        <div class="nav pull-right">
                            <button type="submit" class="button button-green">Envoyer</button>
                        </div>
                        {{Form::hidden('id_answer', '0',array('id'=>'id_answer'))}}
                        {{Form::hidden('id_discussion', $discussion->id)}}
                        {{ Form::close() }}
                        
                    </div>
                </div>
            </div>
        @endif
            </section>

        </div>
    </div>
@stop

{{-- Footer script --}}
@section('footer-js')
    <script type="text/javascript">

        $(function() {
            function ajaxVote(el,v){
                $.ajax({
                    type: "POST",
                    url: "/discussion/vote",
                    dataType: 'json',
                    data: {
                        id_answer: el.parent().parent().parent().parent().attr('data-id'),
                        value: v,
                    },
                }).done(function(data) {
                    $(el).parent().find('.count-vote').html(data['vote_value']);
                },el);
            }
            function ajaxValidate(el,v){
                $.ajax({
                    type: "POST",
                    url: "/discussion/validate",
                    dataType: 'json',
                    data: {
                        id_proposition: el.attr('data-proposition'),
                        value: v,
                    },
                }).done(function(data) {
                    document.location.reload(true);
                },el);
            }
            $('#answers > section > div').each(function(){
                var id = $(this).attr('data-id');
                $(this).find('.fa fa-chevron-up').click(function(e){
                    ajaxVote($(this),1);
                    e.preventDefault();
                });
                $(this).find('.fa fa-chevron-down').click(function(e){
                    ajaxVote($(this),0);
                    e.preventDefault();
                });
                $(this).find('.validate').click(function(){
                    ajaxValidate($(this),1);
                    e.preventDefault();
                });
                $(this).find('.refuse').click(function(){
                    ajaxValidate($(this),0);
                    e.preventDefault();
                });
                $(this).find('.signal').click(function(){
                    alert("Merci de nous contacter par mail - cette fonctionnalité n'est pas encore fonctionnelle");
                    e.preventDefault();
                });
                $(this).find('.answer').click(function(e){
                    $('#id_answer').val($(this).parent().parent().parent().parent().attr('data-id'))
                    e.preventDefault();
                });
            })
        });
    </script>
@stop