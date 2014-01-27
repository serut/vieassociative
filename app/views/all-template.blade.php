@extends('template.theme')
@section('main-content')
<div>
    <h3 class="head">Les boutons</h3>
    <p>
		<a href="#" class="button button-blue">press me bro</a>
		<a href="#" class="button button-green">press me</a>
		<a href="#" class="button button-orange">press me</a>
		<a href="#" class="button button-red">press me</a>
		<a href="#" class="button button-violet"> press me</a>
	</p>
</div>
<div>
    <h3 class="head">Formulaire de contenu</h3>
    {{ Form::open(array('class'=> 'form-horizontal', 'data-validate'=>'our-parsey')) }}
    {{ Form::token() }} {{--Protect against XSS attack --}}
	    <div>
		    <label class="control-label" for="inputEmail">Specific</label>
		    <div class="controls">
                {{Form::text('pseudo','',array(
                	'placeholder'=>'Placeholder',
                	'class' => 'input-xlarge username-field',
                	'id'=>"pseudo",
                	'data-placement'=> 'right',
                	'data-rel'=> 'tooltip',
                	'data-trigger'=>"change",
                	'data-original-title'=>"Votre pseudo doit comporter au minimun 4 caractères alphanumerique, sans espace. Vous devez creer votre compte personnel en premier lieu, et ce n'est qu'ensuite que vous pourrez rajouter l'association que vous voulez representer"
            	))}}
		    	@foreach ($errors->get('pseudo','<col-lg- class="help-inline">:message</col-lg->') as $message)
                    {{$message}}
                @endforeach
                <col-lg- class="text-error">Voici une erreur</col-lg->
		    </div>
	    </div>
	    <div>
		    <label class="control-label" for="inputPassword">Password</label>
		    <div class="controls">
		    	<input type="password" id="inputPassword" placeholder="Placeholder" data-minwords="6" data-trigger="change">
                <col-lg- class="text-error"></col-lg->
		    </div>
	    </div>
	    <div>
		    <label class="control-label" for="inputPassword">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</label>
		    <div class="controls">
			    <label class="checkbox">
					<input type="radio" name="choice" value="choice-1" /> Choice 1
				</label>
			    <label class="checkbox">
					<input type="radio" name="choice" value="choice-2" /> Choice 2
				</label>
		    </div>
	    </div>
	    <div>
		    <label class="control-label" for="inputPassword">Password</label>
		    <div class="controls">
		    	<select name="select-choice" id="select-choice">
        			<option value="Choice 1">Choice 1</option>
        			<option value="Choice 2">Choice 2</option>
        			<option value="Choice 3">Choice 3</option>
        		</select>
		    </div>
	    </div>
	    <div>
		    <label class="control-label" for="inputPassword">Password</label>
		    <div class="controls controls-textarea">
		    	<textarea rows="8" id="text" class="input-xxlarge" onclick="launchEditor($(this))">gsdfg</textarea>
		    </div>
	    </div>
	    <div>
		    <div class="controls">
			    <label class="checkbox">
			    	<input type="checkbox" name="remember"> Remember me
			    </label>
        		<input type="submit" value="Envoyer" class="button button-green" />
		    </div>
	    </div>
    {{ Form::close() }}
</div>
<div>
    <h3 class="head">Formulaire de modification</h3>
    {{ Form::open(array('class'=> 'form-horizontal')) }}
    {{ Form::token() }}
	    <div class="control-group">
		    <label class="control-label">The element <br>
		    	<a href="#myModal" class="button button-blue button-tiny" data-toggle="modal" onclick="modalForFormModification()">Modifier</a>
		    </label>
		    <div class="controls">
		    	My text
		    </div>
	    </div>
	    <div class="control-group">
		    <label class="control-label">The element <br>
		    	<a href="#myModal" class="button button-blue button-tiny" data-toggle="modal" onclick="modalForFormModification()">Modifier</a>
		    </label>
		    <div class="controls">
		    	My text
		    </div>
	    </div>
	    <div class="control-group">
		    <label class="control-label">The element <br>
		    	<a href="#myModal" class="button button-blue button-tiny" data-toggle="modal" onclick="modalForFormModification()">Modifier</a>
		    </label>
		    <div class="controls">
		    	My text
		    </div>
	    </div>
    {{ Form::close() }}
</div>
@stop