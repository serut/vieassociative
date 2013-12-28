@extends('mail.template')
@section('content')
<tbody><tr>
	<td align="center">




		<table width="600" cellspacing="0" cellpadding="0" class="wrap">
			<tbody><tr><td valign="top" height="45" align="center">&nbsp;</td></tr>
			<tr><td valign="top" align="center" class="line">&nbsp;</td></tr>
			<tr><td valign="top" height="45" align="center">&nbsp;</td></tr>
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


<!-- Footer start -->

		<table width="600" cellspacing="0" cellpadding="0" class="wrap">
			<tbody><tr><td valign="top" height="48" align="center">&nbsp;</td></tr>
		</tbody></table>
		<table width="100%" cellspacing="0" cellpadding="0" class="footer">
		<tbody><tr>
			<td valign="top" align="center">
				<table width="600" cellspacing="0" cellpadding="0" class="wrap">
					<tbody><tr height="24"><td colspan="5"></td></tr>
					<tr>
					<td valign="top" align="center" class="small social">
						<div>
							<a href="https://twitter.com/VieAssociative"><img width="32" height="32" border="0" style="max-width:32px;max-height:32px;" title="" alt="" src="/img/mail/twitter.png"></a>
							<a href="https://www.facebook.com/vieassociativeofficiel"><img width="32" height="32" border="0" style="max-width:32px;max-height:32px;" title="" alt="" src="/img/mail/facebook.png"></a>
							<a href="https://plus.google.com/u/0/b/111279553320723865802/111279553320723865802"><img width="32" height="32" border="0" style="max-width:32px;max-height:32px;" title="" alt="" src="/img/mail/googleplus.png"></a>
							<a href="http://www.youtube.com/channel/UCvth03etWqhE1t2cYu4fU2A"><img width="32" height="32" border="0" style="max-width:32px;max-height:32px;" title="" alt="" src="/img/mail/youtube.png"></a>
						</div>
					</td>
					</tr>
				</tbody></table>
				<table width="600" cellspacing="0" cellpadding="0" class="wrap" style="margin-bottom:24px;">
					<tbody><tr>
					<td valign="top" align="center" class="small m-b">
					<div>&copy; 2013 Vie Associative</div>
					</td>
					</tr>
					<tr class="m-0"><td height="48" colspan="5"></td></tr>
				</tbody></table>
			</td>
		</tr>
		</tbody></table>
<!-- Footer end -->

	</td>
</tr>
</tbody></table>
@stop
