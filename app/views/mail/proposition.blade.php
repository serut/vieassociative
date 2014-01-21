@extends('mail.template')
@section('content')





<!-- 1/2 Image on the Left start ☺1_2_l☺ -->
	
		<table width="600" cellspacing="0" cellpadding="0" class="wrap">
		<tbody><tr>
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="0">
				<tbody><tr>
		<!-- CONTENT start -->
					<td valign="top" align="left">
						<div class="h"><h3>{{{$titre}}}</h3> par {{{$from}}}</div>
						<div>
							{{{$texte}}}
						</div>
					</td>
		<!-- CONTENT end -->
				</tr>
				</tbody></table>
			</td>
		</tr>
		</tbody></table>
	
<!-- 1/2 Image on the Left end ☺1_2_l☺ -->



@stop
