@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/vieassociative-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/vieassociative-informations.acronym')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"acronym",
	        'label'=>Lang::get('association/modal_form/vieassociative-informations.label_acronym'),
	        'form' => array(
	            'placeholder'=>Lang::get('association/modal_form/vieassociative-informations.placeholder_acronym'),
	            'class' => 'form-control',
	            'data-original-title'=>Lang::get('association/modal_form/vieassociative-informations.tooltip_acronym'),
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
