@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.name')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}
		@input = array(
	        'id'=>"name",
	        'label'=>Lang::get('association/modal_form/general-informations.label_name'),
	        'value'=>$val,
	        'form' => array(
	            'placeholder'=>Lang::get('association/modal_form/general-informations.placeholder_name'),
	            'class' => 'form-control',
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
  		$("[data-rel=tooltip]").tooltip();
    </script>
@stop
