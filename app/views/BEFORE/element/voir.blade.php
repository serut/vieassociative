@extends('layout.bootstrap')
<div class="col-lg-3">
	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Nom</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($elements as $e)
				<tr>
					<td>{{$e->id}}</td>
					<td>{{$e->nom}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div> <!-- /le col-lg- -->
<button class="btn btn-large btn-primary" type="button" id="creer">Creer cookie</button>
<button class="btn btn-large btn-primary" type="button" id="supprimer">Supprimer cookie</button>

