@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
    {{ Form::open(array('class'=> 'form-horizontal form-modal','id'=>'internal-regulation-form')) }}
    <div>
        <label>{{Lang::get('association/modal_form/general-informations.internal_regulation')}}</label>
        {{SiteHelpers::add_textarea('internal_regulation',$val, false, false)}}
    </div>
    {{ Form::close() }}
    <script type="text/javascript">
        $(".form-modal").attr('parsley',"true").parsley(confParsley);
        myWysiwyg($('#internal-regulation-form'));
    </script>
@stop
