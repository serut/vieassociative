@extends('form_association.general')

@section('head')
	{{Lang::get('association/modal_form/general-informations.head')}}
@stop

@section('form')
	<p>{{Lang::get('association/modal_form/general-informations.admitted_public_utility')}}</p>
	{{ Form::open(array('class'=> 'form-horizontal form-modal','data-validate'=>'our-parsey')) }}
		@input = array(
		    'id'=>"link",
		    'label'=>Lang::get('association/modal_form/general-informations.label_choice_admitted_public_utility'),
		    'name'=> 'choice',
		    'elements' => array(
		        '1'=>array(
		            'value'=>'true',
		            'text'=>Lang::get('association/modal_form/general-informations.radio_yes'),
		        ),
		        '2'=>array(
		            'value'=>'false',
		            'text'=>Lang::get('association/modal_form/general-informations.radio_no'),
		        ),
		    )
		)@
        {{SiteHelpers::create_radio($input)}}
    {{ Form::close() }}
    <script type="text/javascript">
  		$(".form-modal").attr('parsley',"true").parsley(confParsley);
    </script>
@stop
