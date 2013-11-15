@extends('mail.template2')

@section('main')
    


<!-- 1/2 Image Full start  --><table width="600" cellpadding="0" cellspacing="0" class="wrap" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#6F6E6E;font-family:Helvetica,Arial,sans-serif;font-size:14px"><tr style="padding:0">
<td valign="top" style="border-collapse:collapse;padding:0">
				<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#6F6E6E;font-family:Helvetica,Arial,sans-serif;font-size:14px"><tr style="padding:0">
<!-- CONTENT start --><td width="290" valign="top" align="left" class="m-1-2" style="border-collapse:collapse;padding:0">
						<img src="http://images.revaxarts-themes.com/290x200.jpg?gray" class="m-100" alt="" title="" width="290" height="200" border="0" style="max-width:290px;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;display:block">
</td>
					<td width="20" class="padd m-0" style="border-collapse:collapse;padding:0;width:20px">&nbsp;</td>
					<td width="290" valign="top" align="right" class="m-1-2" style="border-collapse:collapse;padding:0">
						<img src="http://images.revaxarts-themes.com/290x200.jpg?gray" class="m-100" alt="" title="" width="290" height="200" border="0" style="max-width:290px;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;display:block">
</td>
		<!-- CONTENT end -->
				</tr></table>
</td>
		</tr></table>
<!-- 1/2 Image Full end   --><!-- 1/2 Text start  --><table width="600" cellpadding="0" cellspacing="0" class="wrap" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#6F6E6E;font-family:Helvetica,Arial,sans-serif;font-size:14px"><tr style="padding:0">
<td valign="top" align="center" style="border-collapse:collapse;padding:0">
				<table width="100%" cellpadding="0" cellspacing="0" class="o-fix" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#6F6E6E;font-family:Helvetica,Arial,sans-serif;font-size:14px"><tr style="padding:0">
<!-- CONTENT start --><td valign="top" align="left" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;padding:0">
						<table width="290" cellpadding="0" cellspacing="0" class="m-b" align="left" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#6F6E6E;font-family:Helvetica,Arial,sans-serif;font-size:14px"><tr style="padding:0">
<td valign="top" align="left" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;padding:0">
							<div class="h" style="color:#6F6E6E;line-height:24px"><div style="color:#6F6E6E;line-height:48px;font-family:Helvetica,Arial,sans-serif;font-size:30px;font-weight:100;letter-spacing:-1px">Headline goes here</div></div>
							<div style="color:#6F6E6E;line-height:24px">
								 Li Europan lingu es es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam <a href="#" style="color:#00E08E;text-decoration:none">vocabular</a>. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.
							</div>
							<div class="btn" style="color:#6F6E6E;line-height:24px;margin-top:10px;display:block">
								<a href="#" style="color:#00E08E;background:#3E4344;text-decoration:none;display:inline-block;padding:0;line-height:0.5em"><img src="img/more.png" width="94" height="30" alt="read more" title="read more" style="background-color:#3E4344;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;display:inline;border:none;background:#3E4344;margin:0" border="0"></a>
							</div>
							</td>
						</tr></table>
<table width="290" cellpadding="0" cellspacing="0" class="m-b" align="right" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;color:#6F6E6E;font-family:Helvetica,Arial,sans-serif;font-size:14px"><tr style="padding:0">
<td valign="top" align="left" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;padding:0">
							<div class="h" style="color:#6F6E6E;line-height:24px"><div style="color:#6F6E6E;line-height:48px;font-family:Helvetica,Arial,sans-serif;font-size:30px;font-weight:100;letter-spacing:-1px">Headline goes here</div></div>
							<div style="color:#6F6E6E;line-height:24px">
								 Li Europan lingu es es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam <a href="#" style="color:#00E08E;text-decoration:none">vocabular</a>. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.
							</div>
							<div class="btn" style="color:#6F6E6E;line-height:24px;margin-top:10px;display:block">
								<a href="#" style="color:#00E08E;background:#3E4344;text-decoration:none;display:inline-block;padding:0;line-height:0.5em"><img src="img/more.png" width="94" height="30" alt="read more" title="read more" style="background-color:#3E4344;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;display:inline;border:none;background:#3E4344;margin:0" border="0"></a>
							</div>
							</td>
						</tr></table>
</td>
		<!-- CONTENT end -->
				</tr></table>
</td>
		</tr></table>
<!-- 1/2 Text end   -->

					<td>
						<h3>{{Lang::get('mail/base.hello')}}</h3>
						<p class="lead">{{Lang::get('mail/register.felicitation')}}</p>
						<p>{{Lang::get('mail/register.details')}}</p>
						</br>
						<p>{{Lang::get('mail/register.user')}}{{$name}}</p>
						<!-- Callout Panel -->
						<p class="callout">
							{{Lang::get('mail/register.link')}} <a href="#">VieAssociative &raquo;</a>
						</p><!-- /Callout Panel -->					
												
						<!-- social & contact -->
						<table class="social" width="100%">
							<tr>
								<td>
									
									<!-- column 1 -->
									<table align="left" class="column">
										<tr>
											<td>				
												
												<h5 class="">{{Lang::get('mail/base.follow')}}</h5>
												<p class=""><a href="#" class="soc-btn fb">Facebook</a> <a href="#" class="soc-btn tw">Twitter</a> <a href="#" class="soc-btn gp">Google+</a></p>
						
												
											</td>
										</tr>
									</table><!-- /column 1 -->	
									
									<!-- column 2 -->
									<table align="left" class="column">
										<tr>
											<td>				
																			
												<h5 class="">{{Lang::get('mail/base.contact')}}</h5>
                		Email: <strong><a href="emailto:reply@vieassociative.com">reply@vieassociative.com</a></strong></p>
                
											</td>
										</tr>
									</table><!-- /column 2 -->
									
									<span class="clear"></span>	
									
								</td>
							</tr>
						</table><!-- /social & contact -->
						
					</td>
@stop