@extends('template.theme')


@set_true $small_centred 
@section('small-content')
    <div>
        <div id="answers">
            <section class="col-lg-7">
        @if(!empty($posts))
            @foreach($posts as $p)
                <div data-id="{{$p->id}}">
                    @if($p->level == 2)
                        <div class="col-lg--comment-space-2 pull-left">
                        </div>
                    @endif
                    @if($p->level == 3)
                        <div class="col-lg--comment-space-3 pull-left">
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg--image pull-left">
                            <img src="/img/items/user-thumb.jpg" alt="placeholder+image">
                        </div>
                            <div class="
                        @if($p->level == 1)
                            col-lg-5
                        @endif
                        @if($p->level == 2)
                            col-lg-17
                        @endif
                        @if($p->level == 3)
                            col-lg-7
                        @endif
                            ">
                            <col-lg- class="author"><a href="#profil">{{$p->author->username}}</a></col-lg->
                            <col-lg- class="light">- {{\Carbon\Carbon::createFromTimeStamp(strtotime($p->created_at))->diffForHumans()}}</col-lg-><br>
                            <div>
                                {{$p->content}}
                            </div>

                                <div>
                                    <col-lg- class="count-vote">{{$p->vote}}</col-lg->
                                     <i class="fa fa-chevron-up"></i>
                                    | <i class="fa fa-chevron-down"></i>
                                    @if($p->level != 3)
                                        <a class="light answer" href="#">Répondre</a> 
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
                    <div class="col-lg--image pull-left">
                        <img src="/img/items/user-thumb.jpg" alt="placeholder+image">
                    </div>
                    <div>
                        {{ Form::open(array('class'=> 'form','url' => '/discussion/add', 'data-validate'=>'our-parsey-1')) }}

                        <textarea name="text" rows="4" id="text" class="form-control nicEditor-textarea" onclick="launchEditor($(this))"></textarea>
                        <br>
                        <div class="nav pull-right">
                            <button type="submit" class="button button-green">Envoyer</button>
                        </div>
                        {{Form::hidden('id_answer', '0',array('id'=>'id_answer'))}}
                        {{Form::hidden('id_discussion', $id_discussion)}}
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
            $('#answers > section > div').each(function(){
                var id = $(this).attr('data-id');
                $(this).find('.fa fa-chevron-up').click(function(){
                    ajaxVote($(this),1);
                });
                $(this).find('.fa fa-chevron-down').click(function(){
                    ajaxVote($(this),0);
                });
                $(this).find('.signal').click(function(){
                    alert("Merci de nous contacter par mail - cette fonctionnalité n'est pas encore fonctionnelle");
                });
                $(this).find('.answer').click(function(){
                    $('#id_answer').val($(this).parent().parent().parent().parent().attr('data-id'))
                    return false;
                });
            })
        });
    </script>
@stop