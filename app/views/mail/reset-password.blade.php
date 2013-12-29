@extends('mail.template')
@section('content')


		<table width="600" cellspacing="0" cellpadding="0" class="wrap">
			<tbody><tr><td valign="top" height="45" align="center">&nbsp;</td></tr>
			<tr><td valign="top" align="center" class="line">&nbsp;</td></tr>
		</tbody></table>




<!-- 1/2 Image on the Left start ☺1_2_l☺ -->
	
		<table width="600" cellspacing="0" cellpadding="0" class="wrap">
		<tbody><tr>
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="0">
				<tbody><tr>
		<!-- CONTENT start -->
					<td valign="top" align="left">
						<div class="h"><div>Headline goes here</div></div>
						<div>
							Voici le lien pour changer votre mot de passe :
						</div>
						<div class="btn">
							<a href="http://www.vieassociative.fr/user/reset/{{$pass}}"><img width="94" height="30" border="0" style="background-color:#3E4344" title="read more" alt="read more" src="img/more.png"></a>
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
