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
        <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>
        <hr>
        {{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey')) }}

        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#lA">{{Lang::get('association/edit/news.content')}}</a></li>
                <li><a data-toggle="tab" href="#lB">{{Lang::get('association/edit/news.advanced_options')}}</a></li>
            </ul>
            <div class="tab-content">
                <div id="lA" class="tab-pane active">
                    <h5>Informations sur votre évènement :</h5>
                    
                    @input = array(
                        'id'=>"title",
                        'label'=>Lang::get('association/edit/news.label_title'),
                        'value'=>$post->title,
                        'form' => array(
                            'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
                            'class' => 'input-xlarge',
                            'data-maxlength'=>"30",
                        )
                    )@
                    {{SiteHelpers::create_input($input)}}
                    <div>
                        <label for="inputPassword">{{Lang::get('association/edit/news.label_text')}}</label>
                        {{SiteHelpers::add_textarea('text',$post->content, true, true)}}
                    </div>
                </div>
                <div id="lB" class="tab-pane">
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
            </div>
        </div>
        <br>
        <div class="pull-right">
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
      });
    </script>
@stop