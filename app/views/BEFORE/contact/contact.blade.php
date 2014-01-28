@extends('template.theme')

{{-- Web site Title --}}
@section('title')
@parent
Contact
@stop
{{-- Header CSS --}}

{{-- Content --}}
@section('content')
    <section>
        <div class="row features">
            <div class="col-lg-2 offset4 well data-bar">
                <h3>Contact</h3>



                    <p>Cette fonctionnalité ne fonctionne pas. Merci de ne pas contacter l'admin.</p>
                {{ Form::open(array()) }}
                        <div class="controls">
                            <div class="formulaire">
                        		{{Form::text('nom','',array('placeholder'=>'Nom','class' => 'form-control username-field', 'id'=>"nom", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"Votre nom"))}}
                        		{{Form::text('email','',array('placeholder'=>'Adresse email','class' => 'form-control email-field', 'id'=>"mail", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"Votre adresse email que vous avez indiqué lors de votre inscription"))}}
                        		{{Form::textarea('text','',array('id'=>"text",'rows'=>"7", 'class'=>"form-control mceEditor","data-textarea"=>"activer"))}}
                            </div>
                        </div>
                        <div class="nav pull-right">
                            <button type="submit" class="button btn btn-warning btn-large">Envoyer</button>
                        </div>
                {{ Form::close() }}

            </div>
        </div>
    </section>
@stop
