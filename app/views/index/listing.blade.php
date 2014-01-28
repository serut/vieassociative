@extends('template.theme')
@set_true $small_centred
@section('small-content')
<section>
	<div>
		<h3 class="head">Fonctionnalités</h3>
		<p>Listing provisoire des associations</p>
		<div class="row">
			@foreach($association as $a)
			<div class="col-sm-6">
				<img src="{{$a->getCover()}}" class="img-responsive">
				<div class="row">
					<div class="col-sm-6">
						<img src="{{$a->getLogo()}}" class="img-responsive img-circle">
					</div>
					<div class="col-sm-6">
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
@stop