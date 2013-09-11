@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.internal_regulation')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal')) }}
	<div>
        <label class="control-label" for="inputPassword">{{Lang::get('association/modal_form/general-informations.internal_regulation')}}</label>
        <div class="controls controls-textarea">
            <textarea name="internal_regulation" rows="8" id="internal_regulation" class="input-xxlarge nicEditor-textarea" onclick="launchEditor($(this))">{{$val}}</textarea>
        </div>
    </div>
    {{ Form::close() }}
    <script type="text/javascript">
        $(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
