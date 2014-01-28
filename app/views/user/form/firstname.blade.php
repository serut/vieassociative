@extends('form_association.general')

@section('head')
	Edition du profil
@stop

@section('form')
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"firstname",
	        'label'=>"Votre nom de famille",
	        'value'=>$val,
	        'form' => array(
	            'class' => 'form-control',
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
