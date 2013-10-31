@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
    <section>
        <div>
            <ul class="breadcrumb">
              <li><a href="#">Association</a> <span class="divider">/</span></li>
              <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <span class="divider">/</span></li>
              <li><a href="/{{$association->id}}/edit">Edition</a> <span class="divider">/</span></li>
              <li class="active">Les administrateurs</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit/administrator.list_admin')}} </h3>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>{{Lang::get('association/edit/administrator.nickname')}}</td>
                        <td>{{Lang::get('association/edit/administrator.date_function_added')}}</td>
                        <td>{{Lang::get('association/edit/administrator.link')}}</td>
                        @if($is_admin)
                        <td>{{Lang::get('association/edit/administrator.remove')}}</td>
                        @endif
                    </tr>
                </thead>
                @foreach($admin as $k=>$v)
                <tbody>
                    <tr>
                        <td>{{$v->author->username}}</td>
                        <td>{{\Carbon\Carbon::createFromTimeStamp(strtotime($v->updated_at))->formatLocalized('%A %d %B %Y %H:%I')}}</td>
                        <td>{{$v->link}}</td>
                        @if($is_admin)
                        <td><a href="#"><i class="icon-remove"></i></a></td>
                        @endif
                    </tr>
                </tbody>
                @endforeach
            </table>
            @if($is_admin || !$admin->count())
            <hr>
            <div>
                <h3 class="head">{{Lang::get('association/edit/administrator.add_admin')}} </h3>
                {{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey', 'url'=>'/'.$association->id.'/form/administrator/add', 'data-loading'=>'true')) }}
                    @input = array(
                        'id'=>"who",
                        'name'=> 'who',
                        'data-toggle'=> 'div-user',
                        'elements' => array(
                            '1'=>array(
                                'value'=>'false',
                                'text'=>Lang::get('association/edit/administrator.add_me'),
                                'checked'=>true,
                            ),
                            '2'=>array(
                                'value'=>'true',
                                'text'=>Lang::get('association/edit/administrator.add_someone_else'),
                            ),
                        )
                    )@
                    @if($is_admin)
                        <div id="div-user">
                    @else
                        {{SiteHelpers::create_radio($input)}}
                        <div style="display:none;" id="div-user">
                    @endif
                        @input = array(
                            'id'=>"admin_mail",
                            'label'=>Lang::get('association/edit/administrator.label_admin_mail'),
                            'form' => array(
                                'placeholder'=>Lang::get('association/edit/administrator.placeholder_admin_mail'),
                                'class' => 'input-xlarge',
                                'data-original-title'=>Lang::get('association/edit/administrator.tooltip_admin_mail'),
                                'data-type'=>"email",
                            )
                        )@
                        {{SiteHelpers::create_input($input)}}
                    </div>

                    <div id="div-linked">
                        <p>{{Lang::get('association/edit/administrator.he_is')}} : 
                            <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_one')}}</a>
                            <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_two')}}</a>
                            <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_three')}}</a>
                            <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_four')}}</a>
                        </p>
                        @input = array(
                            'id'=>"link",
                            'label'=>Lang::get('association/form_create.label_link'),
                            'form' => array(
                                'placeholder'=>Lang::get('association/form_create.placeholder_link'),
                                'class' => 'input-xlarge',
                                'data-original-title'=>Lang::get('association/form_create.tooltip_link'),
                                'data-maxlength'=>"30",
                                'required'=>"required",
                            )
                        )@
                        {{SiteHelpers::create_input($input)}}
                    </div>
                    <p class="nav pull-right">
                        <button type="submit" class="button button-green">{{Lang::get('association/edit/administrator.add')}}</button>
                    </p>
                    <br>
                {{ Form::close() }}
                </div>
            </div>
            @endif
        </div>
    </section>
@stop