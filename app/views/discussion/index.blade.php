@extends('template.theme')


@set_true $small_centred 
@section('small-content')
    <div>
        <div id="answers">
        @if(!empty($posts))
            <section class="span24">
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
                        @if($p->level == 1)
                            <div class="span20">
                        @endif
                        @if($p->level == 2)
                            <div class="span17">
                        @endif
                        @if($p->level == 3)
                            <div class="span14">
                        @endif
                            <span class="author"><a href="#profil">Joel Sapin</a></span>
                            <span class="light">- 17 minutes</span><br>
                            <div>
                                {{$p->content}}
                            </div>

                                <div>
                                    {{($p->vote_up - $p->vote_down)}} <i class="icon-chevron-up"></i>
                                    | <i class="icon-chevron-down"></i>
                                    <a class="light answer" href="#">Répondre</a> 
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                        {{ Form::close() }}
                        
                    </div>
                </div>
            </div>
            </section>
        @else
            Il n'y a pas de commentaire pour le moment
        @endif

        </div>
    </div>
@stop

{{-- Footer script --}}
@section('footer-js')
    <script type="text/javascript">

        $(function() {
            $('#answers > section > div').each(function(){
                var id = $(this).attr('data-id');
                console.log($(this).find('.icon-chevron-up'))
                $(this).find('.icon-chevron-up').click(function(){
                    alert("up !");
                });
                $(this).find('.icon-chevron-down').click(function(){
                    alert("down !");
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