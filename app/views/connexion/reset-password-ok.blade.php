@extends('template.theme')


@set_true $small_centred
@section('small-content') 
    <section>
    	<div>
	    	<h3 class="head">Retrouver son mot de passe</h3>
	    	<p>Vous revoila {{$username}}. Entrez votre nouveau mot de passe :</p>
	    	{{ Form::open(array('class'=> 'form','url' => 'user/form/password','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}
	            @input = array(
			            'type' => 'password',
			            'id'=>"password",
			            'full-width'=>true,
	            		'form' => array(
				            'placeholder'=>Lang::get('membre/form_connexion.placeholder_password'),
				            'class' => 'form-control password-field',
		            		'data-original-title'=>Lang::get('membre/form_connexion.tooltip_login_password'),
		            		'required'=>"required",
		            		'data-minlength'=>"6",
		            		'data-maxlength'=>"30",
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

