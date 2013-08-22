@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.admitted_public_utility')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
		    'id'=>"admitted_public_utility",
		    'label'=>Lang::get('association/modal_form/general-informations.label_choice_admitted_public_utility'),
		    'name'=> 'admitted_public_utility',
		    'value'=> ($val == 1) ? "true" : "false",
		    'elements' => array(
		        '1'=>array(
		            'value'=>'true',
		            'text'=>Lang::get('form.radio_yes'),
		        ),
		        '2'=>array(
		            'value'=>'false',
		            'text'=>Lang::get('form.radio_no'),
		        ),
		    )
		)@
        {{SiteHelpers::create_radio($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
