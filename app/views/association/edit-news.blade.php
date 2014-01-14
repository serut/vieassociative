@extends('template.theme')




@set_true $large_centred 
@section('large-content')
<section>
    <div>
        <ul class="breadcrumb">
          <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <span class="divider">/</span></li>
          <li><a href="/{{$association->id}}/edit">Edition</a> <span class="divider">/</span></li>
          <li><a href="/{{$association->id}}/edit/news">Mes publications</a> <span class="divider">/</span></li>
          <li class="active">Editer une publication</li>
        </ul>
        <h3 class="head">{{Lang::get('association/edit/news.modify_news')}}</h3>
        {{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey')) }}

        <?php /*
            @input = array(
                'id'=>"publish_later",
                'name'=>"publish_later",
                'label'=>'Publier',
                'data-toggle'=> 'div-publish-later',
                'elements' => array(
                    '1'=>array(
                        'value'=>'false',
                        'text'=>"en ligne",
                        'checked'=>true,
                    ),
                    '2'=>array(
                        'value'=>'true',
                        'text'=>"hors ligne",
                    ),
                )
            )@
            {{SiteHelpers::create_radio($input)}}
            <div style="display:none;" id="div-publish-later">
                @input = array(
                    'id'=>"published_at",
                    'class'=>"input-append date",
                    'label'=>Lang::get('association/edit/news.label_published_at'),
                    'value'=>$post->published_at,
                    'type'=>'dateandtime',
                    'form' => array(
                        'class'=>'input-medium',
                    )
                )@
                {{SiteHelpers::create_input($input)}}
            </div>
            */
        ?>
            <div class="row">
                <div class="span2">
                    <img src="{{$association->getLogo()}}" class="img-circle">
                </div>
                <div class="span20">
                    @input = array(
                        'id'=>"title",
                        'value'=>$post->title,
                        'form' => array(
                            'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
                            'class' => 'input-xxlarge',
                            'tabindex'=>'1',
                            'data-minlength'=>'5',
                            'required'=>"required",
                        )
                    )@
                    {{SiteHelpers::simple_input($input)}}
                    <div>
                        {{SiteHelpers::add_textarea('text',$post->text, true, true)}}
                    </div>
                </div>
            </div>


        <br>
        @if(App::environment() != "prod")
        <h5>Personnalisez votre publication avec :</h5>
        <div class="row" style="margin-left:10px">
            <div class="thumbnail span4">
                <span class="text-center">Une grande image</span>
            </div>
            <div class="thumbnail span4">
                <span class="text-center">Plusieurs images</span>
            </div>
            <div class="thumbnail span4">
                <span class="text-center">Un lien</span>
            </div>
            <div class="thumbnail span4">
                <span class="text-center">Un évènement</span>
            </div>
            <div class="thumbnail span4">
                <span class="text-center">Une vidéo</span>
            </div>
        </div>
        @endif
        <div class="text-right">
            <button class="button button-green" type="submit">Valider</button>
        </div>
        {{ Form::close() }}
    </div>
</section>

@stop

{{-- Footer script --}}
@section('footer-js')
    <script type="text/javascript">
    $(function() {
      $('#published_at').parent().datetimepicker({
          language: 'pt-BR'
        });
        $('#published_at').datepicker();
      
      });
    </script>
@stop