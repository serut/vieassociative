@extends('template.theme')


@set_true $small_centred
@section('small-content')
    <section>
        <div>

            <ul class="breadcrumb">
              <li><a href="/">Liste des Associations</a> </li>
              <li class="active">Ajout d'une association</li>
            </ul>
            <h3 class="head">{{Lang::get('association/form_create.head_add_association')}}</h3>
            {{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}
                <ul class="error-laravel text-danger"></ul>
                @input = array(
                    'id'=>"link",
                    'label'=>Lang::get('association/form_create.label_choice_link'),
                    'name'=> 'choice',
                    'data-toggle'=> 'div-linked',
                    'elements' => array(
                        '1'=>array(
                            'value'=>'false',
                            'text'=>Lang::get('association/form_create.radio_no'),
                            'checked'=>true,
                        ),
                        '2'=>array(
                            'value'=>'true',
                            'text'=>Lang::get('association/form_create.radio_yes'),
                        ),
                    )
                )@

                {{SiteHelpers::create_radio($input)}}
                <div style="display:none;" id="div-linked">
                    <p>{{Lang::get('association/form_create.you_are')}} : 
                        <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_one')}}</a>
                        <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_two')}}</a>
                        <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_three')}}</a>
                    </p>
                    @input = array(
                        'id'=>"link",
                        'label'=>Lang::get('association/form_create.label_link'),
                        'form' => array(
                            'placeholder'=>Lang::get('association/form_create.placeholder_link'),
                            'class' => 'form-control',
                            'data-original-title'=>Lang::get('association/form_create.tooltip_link'),
                            'data-maxlength'=>"50",
                            'data-minlength'=>"2",
                        )
                    )@
                    {{SiteHelpers::create_input($input)}}
                </div>

                <hr>

                @input = array(
                    'id'=>"name",
                    'label'=>Lang::get('association/form_create.placeholder_name'),
                    'form' => array(
                        'placeholder'=>Lang::get('association/form_create.placeholder_name'),
                        'class' => 'form-control',
                        'data-original-title'=>Lang::get('association/form_create.tooltip_name'),
                        'required'=>"required",
                        'data-maxlength'=>"120",
                        'data-minlength'=>"4",
                    )
                )@
                {{ SiteHelpers::create_input($input) }}

                <hr>
                <div>
                    <label class="checkbox justify">
                        <input name="approuve" type="checkbox" required="required">{{Lang::get('association/form_create.notice_part_1')}}<a target="_blank" href="{{URLSubdomain::to('www','/info/condition')}}">{{Lang::get('association/form_create.notice_part_link')}}</a>{{Lang::get('association/form_create.notice_part_2')}}

                        {{Lang::get('association/form_create.notice_create_association')}}
                    </label>
                    
                </div>
                <div class="nav text-right">
                    <button type="submit" class="btn btn-primary">{{Lang::get('core/form.send')}}</button>
                </div>
            {{ Form::close() }}
        </div>
    </section>

@stop