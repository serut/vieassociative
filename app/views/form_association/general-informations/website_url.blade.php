@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.website_url')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"website_url",
	        'label'=>Lang::get('association/modal_form/general-informations.label_website_url'),
	        'form' => array(
	            'placeholder'=>Lang::get('association/modal_form/general-informations.placeholder_website_url'),
	            'class' => 'input-xlarge',
	            'data-original-title'=>Lang::get('association/modal_form/general-informations.tooltip_website_url'),
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
