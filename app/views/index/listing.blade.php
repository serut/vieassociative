@extends('template.theme')
@set_true $medium_centred
@section('medium-content')
<section>
	<div>
		<h3 class="head">Fonctionnalités</h3>
		
		<div class="row">
			<p class="col-sm-8">Listing provisoire des associations</p>
			<div class="col-sm-4 btn"><a href="{{URLSubdomain::to('association','/add')}}">Referencez votre association</a></div>
		</div>
		<hr>
		<div class="row">
			@foreach($association as $a)
			<div class="col-sm-6">
				<img src="{{$a->getCover()}}" class="img-responsive">
				<div class="row">
					<div class="col-sm-4 association-logo" style="">
						<img src="{{$a->getLogo()}}" class="img-responsive img-circle" alt="Logo de {{$a->name}}">
					</div>
					<div class="col-sm-8">
						<a href="{{URLSubdomain::to('association','/')}}{{$a->id}}-{{$a->slug}}">
							{{$a->name}}
						</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
<style type="text/css">
	
	.association-logo{
		margin-top:-12%;
		margin-bottom:3%;
	}
</style>
@stop