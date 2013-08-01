@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.headquater')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"headquater",
	        'label'=>Lang::get('association/modal_form/general-informations.label_headquater'),
	        'form' => array(
	            'placeholder'=>Lang::get('association/modal_form/general-informations.placeholder_headquater'),
	            'class' => 'input-xlarge',
	            'data-original-title'=>Lang::get('association/modal_form/general-informations.tooltip_headquater'),
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
