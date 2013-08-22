@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.acronym')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"acronym",
	        'label'=>Lang::get('association/modal_form/general-informations.label_acronym'),
	        'value'=>$val,
	        'form' => array(
	            'placeholder'=>Lang::get('association/modal_form/general-informations.placeholder_acronym'),
	            'class' => 'input-xlarge',
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
