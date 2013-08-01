@extends('template.theme')

@section('before-body')
@parent
    <section></section>
@stop

{{-- Web site Title --}}
@section('title')
@parent
Maintenance
@stop

@if ($transparent = true) @endif
{{-- Content --}}
@section('content')
<div class="row">
    <div class="span18">
		<div id="rocket"></div>
		<aside class="span10">
			<div class="background hidden-tablet hidden-phone">
			    <h1 class="head">Toujours en développement</h1>
			    <div>
			        <p class="justify">Le temps que les associations passent pour communiquer, pour s'organiser, pour se réunir, et donc pour exister est colossal. Vie Associative est et sera conçu dans ce sens : simplifier au maximum les taches des associations pour qu'elles se concentrent sur les services qu'elles rendent et pas toute la com, la gestion, etc<br>
			        License CC-BY-NC-SA </p>
			        <p class="text-right"><a href="https://docs.google.com/document/d/1JnhtId2slrnP0_Gcq3NUSIYtfxhFxm02cacnhRBcP3E" class="button button-violet">En savoir plus</a></p>
			    </div>
			</div>
		</aside>
	</div>
</div>

	<style type="text/css">
	#rocket{
		background: url("/img/items/rocket.png") no-repeat scroll 0 0 transparent;
	    float: left;
	    height: 454px;
	    position: absolute;
	    width: 522px;
	    padding: 0px;
	    margin-top: 110px;
	    top: 0;
	    left:45%;
	}
	
	@media (max-width: 767px) {
		.span12{
			margin-top: 0px;
			margin-left: 3px;
		}
		.first{
			margin-left: 0px;
		}
		#rocket{
			background: url("http://www.romaincorraze.com/images/worldtour/we-need-you.png") no-repeat scroll 0 0 transparent;
	    	margin-top: 85px;
	    	margin-left: 0;
	    	left:34%;
		}
		.thrid{
	    	margin-top: 400px;
			margin-left: 0px;
		}
	}
	</style>
@stop
