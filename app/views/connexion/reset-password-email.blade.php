@extends('template.theme')


@set_true $small_centred
@section('small-content') 
    <section>
    	<div>
	    	<h3 class="head">Retrouver son mot de passe</h3>
	    	{{ Form::open(array('class'=> 'form','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}

	            
	            @input = array(
			            'id'=>"mail",
			            'full-width'=>true,
	            		'form' => array(
				            'placeholder'=>Lang::get('membre/form_connexion.placeholder_email'),
				            'class' => 'form-control email-field',
		            		'data-original-title'=>Lang::get('membre/form_connexion.tooltip_register_email'),
		            		'required'=>"required",
		            		'data-type'=>"email",
	            		)
		            )
	            @
	            {{ SiteHelpers::create_input($input) }}
	            <div class="text-right">
			    	<button class="btn button-green" type="submit">Envoyer</a><br>
			    </div>
            {{ Form::close() }}
    	</div>
    </section>
@stop

