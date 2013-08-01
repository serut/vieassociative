@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
	
    <section>
    	<a class="button button-blue" href="{{URLSubdomain::to('association','/add')}}">Ajouter Association</a>
	    <div>
			<h3 class="head">{{Lang::get('index/index.head_what_vieassociative')}}</h3>
	        <div><img src="/img/items/test-image-projet.png"></div>
	        <h3 class="head">{{Lang::get('index/index.head_one_goal')}}</h3>
            <p>{{Lang::get('index/index.one_goal')}}</p>
            <h3 class="head">{{Lang::get('index/index.head_innovant_project')}}</h3>
            <p>{{Lang::get('index/index.innovant_project')}}</p>
            <h3 class="head">{{Lang::get('index/index.head_need_a_place')}}</h3>
            <p>{{Lang::get('index/index.need_a_place')}}</p>
        </div>
        <div>
        	<div class="pure-g-r">
			    <div class="pure-u-1-2">
					<h3 class="head">{{Lang::get('index/index.head_found_evenement')}}</h3>
					{{ Form::open(array()) }}
	                    <p>{{Lang::get('index/index.found_evenement')}}</p>
	                    <span class="maxSubHead">Ville </span>
	                    {{Form::text('ville','',array('type' => 'text','id'=>"ville",'placeholder'=>"Tapez le nom d'une ville proche de votre position"))}}
	                    
	                    <span class="maxSubHead rayon">avec un rayon de <span class="km-affiche">&nbsp;15&nbsp;</span> km</span>
	                    <div id="slider-km"></div>
	                    <span id="actuel-selectionne" class="maxSubHead"></span>
	                    {{Form::hidden('idVilleBDD','',array('id'=>"idVilleBDD"))}}
	                    {{Form::hidden('km','15',array('id'=>"km"))}}
	                {{ Form::close() }}
			    </div>
			    <div class="pure-u-1-2">
					<h3 class="head">{{Lang::get('index/index.head_add_evenement')}}</h3>
					test
			    </div>
			</div>

			
        	
        </div>
    </section>

@stop