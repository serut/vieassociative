@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.goal')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
	<label>{{Lang::get('association/modal_form/general-informations.label_goal')}}</label>
	<textarea data-maxlength="1000" rows="3" class="col-lg-13" placeholder="{{Lang::get('association/modal_form/general-informations.placeholder_goal')}}" name="goal">{{$val}}</textarea>
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
