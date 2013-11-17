@extends('mail.template')

@section('main')
    
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