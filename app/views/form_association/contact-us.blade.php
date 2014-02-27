@extends('form_association.general')

@section('head')
	Contactez-nous !
@stop

@section('form')
	<p>Nous vous invitons à nous faire parvenir vos premières impressions, afin que nous puissions améliorer notre site avec vos critiques !</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','action'=>"http://www.vieassociative.fr/proposition",'data-validate'=>'our-parsey', 'data-loading'=>'true')) }}
		@input = array(
	        'id'=>"from",
	        'form' => array(
	            'placeholder'=>"Votre nom",
	            'class' => 'form-control',
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
	    @input = array(
	        'id'=>"title",
	        'form' => array(
	            'placeholder'=>"Votre titre",
	            'class' => 'form-control',
	            'data-maxlength'=>"100",
	        )
	    )@
	    {{SiteHelpers::create_input($input)}}
		<textarea data-maxlength="1000" rows="3" cols="60" placeholder="Votre texte" name="text"></textarea>

    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
  		$("[data-rel=tooltip]").tooltip();
    </script>
@stop
