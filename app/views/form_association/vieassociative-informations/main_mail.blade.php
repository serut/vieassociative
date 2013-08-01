@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/vieassociative-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/vieassociative-informations.acronym_name')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"acronym_name",
	        'label'=>Lang::get('association/modal_form/vieassociative-informations.label_acronym_name'),
	        'form' => array(
	            'placeholder'=>Lang::get('association/modal_form/vieassociative-informations.placeholder_acronym_name'),
	            'class' => 'input-xlarge',
	            'data-original-title'=>Lang::get('association/modal_form/vieassociative-informations.tooltip_acronym_name'),
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
