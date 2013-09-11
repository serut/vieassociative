@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.statuts')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal')) }}
	<div>
        <label class="control-label" for="inputPassword">{{Lang::get('association/modal_form/general-informations.label_statuts')}}</label>
        <div class="controls controls-textarea">
            <textarea name="statuts" rows="8" id="statuts" class="input-xxlarge nicEditor-textarea" onclick="launchEditor($(this))">{{$val}}</textarea>
        </div>
    </div>
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
