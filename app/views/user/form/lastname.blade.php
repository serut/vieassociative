@extends('form_association.general')

@section('head')
	Edition du profil
@stop

@section('form')
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"lastname",
	        'label'=>"Votre prénom",
	        'value'=>$val,
	        'form' => array(
	            'class' => 'input-xlarge',
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
