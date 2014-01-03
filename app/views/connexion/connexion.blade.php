@extends('template.theme')


{{--set_true $small_centred --}}
@section('small-content') 
    <section>
    	<div>
	    	<h3 class="head">La connexion en 1 clic, sécurisé et rapide !</h3>
	    	En développement
            <a href="/membre/connexion/facebook"><i class="connection-icon connection-fa fa-facebook"></i></a>
            <a href="/membre/connexion/google"><i class="connection-icon connection-fa fa-google"></i></a>
            <a href="/membre/connexion/orange"><i class="connection-icon connection-fa fa-orange"></i></a>
            <a href="/membre/connexion/hotmail"><i class="connection-icon connection-fa fa-hotmail"></i></a>
            <br>
            <span>En cliquant sur un lien ci dessus, je reconnais avoir pris connaissance des <a target="_blank" href="/info/condition">CGU</a></span>
    	</div>
    </section>
@stop


@set_true $two_part 
@section('left-content') 
    <section>
    	<div>
			<h3 class="head">{{Lang::get('membre/connexion.head_connect_account')}}</h3>
	        @if ( $connexTentative < 10 )
	            {{--// Le gars a le droit de voir le formulaire --}}
                <p>{{Lang::choice('membre/connexion.connect_account',10-$connexTentative,array('number' => 10-$connexTentative))}}</p>
	            {{ Form::open(array('class'=> 'form','url' => 'user/log/login', 'data-validate'=>'our-parsey-1', 'data-loading'=>'true')) }}

		            @input = array(
				            'id'=>"username",
				            'full-width'=>true,
		            		'form' => array(
					            'placeholder'=>Lang::get('membre/form_connexion.placeholder_pseudo'),
					            'class' => 'input-large username-field',
			            		'data-original-title'=>Lang::get('membre/form_connexion.tooltip_login_pseudo'),
			            		'required'=>"required",
			            		'data-minlength'=>"4",
		            		)
			            )
		            @
		            {{ SiteHelpers::create_input($input) }}

		            @input = array(
				            'type' => 'password',
				            'id'=>"password",
				            'full-width'=>true,
		            		'form' => array(
					            'placeholder'=>Lang::get('membre/form_connexion.placeholder_password'),
					            'class' => 'input-large password-field',
			            		'data-original-title'=>Lang::get('membre/form_connexion.tooltip_login_password'),
			            		'required'=>"required",
			            		'data-minlength'=>"6",
			            		'data-maxlength'=>"30",
		            		)
			            )
		            @
		            {{ SiteHelpers::create_input($input) }}

		            <div class="nav pull-right">
		                <button type="submit" class="button button-green">{{Lang::get('membre/connexion.connexion')}}</button>
		            </div>
		            <div class="formulaire">
		                <p><a href="/user/reset-password">{{Lang::get('membre/connexion.forget_password')}}</a></p>
		            </div>
	            {{ Form::close() }}
	       @else
	            {{Lang::get('membre/connexion.please_come_later')}}
	            <div class="formulaire">
	                <p><a target="_blank" href="/user/reset-password" class="btn-vie-assoc">Mot de passe oublié ?</a></p>
	            </div>
	        @endif
        </div>
    </section>
@stop
@section('right-content')
    <section>
	    <div>
	    	<h3 class="head">{{Lang::get('membre/connexion.head_create_account')}}</h3>
	        <p>{{Lang::get('membre/connexion.create_account')}}</p>
	        {{ Form::open(array('class'=> 'form','url' => 'user/log/register', 'data-validate'=>'our-parsey-2', 'data-loading'=>'true')) }}
	        	@input = array(
			            'id'=>"pseudo",
			            'full-width'=>true,
	            		'form' => array(
				            'placeholder'=>Lang::get('membre/form_connexion.placeholder_pseudo'),
				            'class' => 'input-large username-field',
		            		'data-original-title'=>Lang::get('membre/form_connexion.tooltip_register_pseudo'),
		            		'required'=>"required",
		            		'data-minlength'=>"4",
		            		'data-maxlength'=>"15",
	            		)
		            )
	            @
	            {{ SiteHelpers::create_input($input) }}

	            @input = array(
			            'id'=>"mail",
			            'full-width'=>true,
	            		'form' => array(
				            'placeholder'=>Lang::get('membre/form_connexion.placeholder_email'),
				            'class' => 'input-large email-field',
		            		'data-original-title'=>Lang::get('membre/form_connexion.tooltip_register_email'),
		            		'required'=>"required",
		            		'data-type'=>"email",
	            		)
		            )
	            @
	            {{ SiteHelpers::create_input($input) }}

	            @input = array(
			            'type' => 'password',
			            'id'=>"password",
			            'full-width'=>true,
	            		'form' => array(
				            'placeholder'=>Lang::get('membre/form_connexion.placeholder_password'),
				            'class' => 'input-large password-field',
		            		'data-original-title'=>Lang::get('membre/form_connexion.tooltip_register_password'),
		            		'required'=>"required",
		            		'data-minlength'=>"6",
		            		'data-maxlength'=>"30",
	            		)
		            )
	            @
	            {{ SiteHelpers::create_input($input) }}
		        <div class="nav pull-right">
		            <button type="submit" class="button button-green">{{Lang::get('membre/connexion.inscription')}}</button>
		        </div>
		        <div class="formulaire">
		            <p>{{Lang::get('membre/connexion.read_and_agree')}}<a target="_blank" href="/info/condition">{{Lang::get('membre/connexion.cgu')}}</a></p>
		        </div>
	        {{ Form::close() }}
        </div>
    </section>
@stop
@section('footer-js')
<script type="text/javascript">
  console.log(document.referrer);
</script>
@stop
