{{-- v1 --}}
@include('template.main_html_component.head')
@include('template.main_html_component.header')
@if(isset($sub_head) && $sub_head)
	@include('template.sub-head')
@endif
<div class="container">
@section ('content')

	@if(isset($small_centred) && $small_centred)
		@include('template.html_bricks.small-centred') 
	@endif

	@if(isset($two_part) && $two_part)
		@include('template.html_bricks.two-part') 
	@endif

	@if(isset($large_centred) && $large_centred)
		@include('template.html_bricks.large-centred') 
	@endif

	@if(isset($main_and_aside) && $main_and_aside)
		@include('template.html_bricks.main-and-aside') 
	@endif
@show
</div>

@section ('full-container')
@show
@include('template.main_html_component.footer')
@include('template.main_html_component.foot')