@extends('template.theme')


@set_true $large_centred 
@section('large-content')
		<section>
				<div>
						<ul class="breadcrumb">
							<li><a href="/">Association</a> <span class="divider">/</span></li>
							<li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <span class="divider">/</span></li>
							<li class="active">Edition</li>
						</ul>
						<h3 class="head">{{Lang::get('association/edit.edit_association')}}</h3>
						@if(!$proposition->isEmpty())
						<p>Modification en attente :</p>
						@foreach($proposition as $p)
						<div class="item">
								<div class="text">
										<span>{{$p->discussion->title}}</span>
										<div class="tweetbtn">
										<img width="13" height="13" alt="Favorite" src="/img/to sprite/retweet_mini.png">
										<a href="discussion/{{$p->discussion->id}}">Afficher</a>
										<i>{{\Carbon\Carbon::createFromTimeStamp(strtotime($p->updated_at))->diffForHumans()}}</i>
										</div>
								</div>
						</div>
						@endforeach
						<hr>
						@endif
						<table class="table table-striped">
							<tbody>
								<tr>
									<td>Information générale de l'association</td>
									<td></td>
									<td><a href="edit/general-informations"> Editer</a></td>
								</tr>
								<tr>
									<td>Administrateurs</td>
									<td>{{$count_admin}} administrateurs</td>
									<td><a href="edit/administrator"> Editer</a></td>
								</tr>
								<tr>
									<td>Les publications</td>
									<td>{{$count_news}} publications</td>
									<td><a href="edit/news"> Editer</a></td>
								</tr>
								<tr>
									<td>Les photos</td>
									<td>{{$association->nb_photos}} images</td>
									<td><a href="edit/file/{{$association->id_folder}}"> Editer</a></td>
								</tr>
								@if(App::environment() != "production")
								<tr>
									<td>La page Vie Associative</td>
									<td></td>
									<td><a href="edit/vieassociative-informations"> Editer</a></td>
								</tr>
								<tr>
									<td>Historique</td>
									<td>200 élements</td>
									<td><a href="history"> Afficher</a></td>
								</tr>
								<tr>
									<td>Les réseaux sociaux</td>
									<td>0 réseaux sociaux liés</td>
									<td><a href="edit/social"> Editer</a></td>
								</tr>
								<tr>
									<td>Les évenements</td>
									<td>2 évènements</td>
									<td><a href="edit/evenement"> Editer</a></td>
								</tr>
								@endif

							</tbody>
						</table>

						</div>
				</div>
		</section>
@stop
@section('footer-js')
<script src="/js/vendor/jquery.mousewheel.min.js" async="true"></script>
@stop
