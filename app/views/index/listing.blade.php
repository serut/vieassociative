@extends('template.theme')


@set_true $small_centred
@section('small-content')
	
    <section>
	    <div>
			<h3 class="head">Fonctionnalités</h3>
      <p>Listing provisoire des associations</p>
	    	<table class="table table-striped">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Page Vie Associative</th>
                </tr>
              </thead>
              <tbody>
              @foreach($association as $a)
                <tr>
                  <td>{{$a->name}}</td>
                  <td>
                  	<a href="{{URLSubdomain::to('association','/')}}{{$a->id}}-{{$a->slug}}">
                      {{URLSubdomain::to('association','/')}}{{$a->id}}-{{$a->slug}}
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </section>

@stop