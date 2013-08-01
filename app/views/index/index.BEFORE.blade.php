@extends('template.theme')

{{-- Web site Title --}}
@section('title')
@parent
Les évènements associatifs dans ta région !
@stop

{{-- Header CSS --}}
@section('header-css')
@parent
	<link href="{{ asset('/css/index.css') }}" rel="stylesheet">
@stop

{{-- Footer script --}}
@section('footer-js')
@parent
	<script src="{{ asset('/js/page/index.js') }}"></script>
	<script src="{{ asset('/js/page/index-twitter-widget.js') }}"></script>
	<script src="{{ asset('/js/social.js') }}"></script>
@stop

{{-- Content --}}
@section('content')
	<div class="row-fluid">
			<!-- Tabs Section End -->
			
			<!-- Tabs Section Start -->
			<div class="tab-section raw-fluid">
                
                <div class="span6">
                    <div class="tab-head">
                        <h1>trouver les évènements</h1>
                    </div>
                    <div class="tab_container">
                        <div class="tab_container_in">
                            <div class="features">
                                
                            </div>
                            <ul id="test"></ul>
                            <ul class="liste-ville span3">
                                <li>
                                    <div class="desc-in span8">
                                        <div class="span6">
                                            <span class="pointer">&nbsp;</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <h1 class="tab-head">ajouter les évènements</h1>
                    <div class="tab_container">
                        <div class="tab_container_in">
                            <p> <a href=""></a>a </p>
                        </div>
                    </div>
			    </div>
			</div>
			<!-- Tabs Section End -->
		</div>   
		<div class="column span3">
			
			<?php
			// <div class="box-small facebook_module">
		 //        <h1 class="head">Facebook</h1>
		 //        <div class="fb-like-box" data-href="https://www.facebook.com/vieassociativeofficiel" data-width="292" data-show-faces="true" data-stream="false" data-header="true"></div>
		 //    </div>
			?>
			@include('template.aside.facebook')
			@include('template.aside.add-your-event')
			@include('template.aside.twitter')
		</div>
	</div>
@stop