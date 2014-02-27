@extends('form_association.general')

@section('head')
	Edition du profil
@stop

@section('form')
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
	        'id'=>"email",
	        'label'=>"Votre nouvelle adresse mail",
	        'value'=>$val,
	        'form' => array(
	            'placeholder'=>Lang::get('membre/form_connexion.placeholder_email'),
	            'class' => 'form-control',
        		'data-type'=>"email",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
