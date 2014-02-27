@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	{{ Form::open(array('class'=> 'form-horizontal form-modal','id'=>'statuts-form')) }}
	<div>
        <label>{{Lang::get('association/modal_form/general-informations.label_statuts')}}</label>
        {{SiteHelpers::add_textarea('statuts',$val, false, false)}}
    </div>
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
        myWysiwyg($('#statuts-form'));
    </script>
@stop
