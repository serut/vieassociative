@extends('template.theme')



@set_true $main_and_aside 
@section('main-content')
<section>
    <div>
        <ul class="breadcrumb">
          <li><a href="/1-qsdf">Faites de la musique</a> <span class="divider">/</span></li>
          <li><a href="/1/edit">Edition</a> <span class="divider">/</span></li>
          <li><a href="/1/edit/news">Mes publications</a> <span class="divider">/</span></li>
          <li class="active">Editer une publication</li>
        </ul>
        <h3 class="head">{{Lang::get('association/edit.edit_association')}}</h3>
        <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>
        <hr>
    {{ Form::open(array('class' => 'form-horizontal')) }}
        <div class="progress active" id="bar">
            <div class="bar bar-success" style="width: 25%;"></div>
        </div>
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#lA">Contenu</a></li>
                <li><a data-toggle="tab" href="#lB">Lorem ipsum </a></li>
                <li><a data-toggle="tab" href="#lC">dolor sit amet</a></li>
            </ul>
            <div class="tab-content">
                <div id="lA" class="tab-pane active">
                    <h5>Informations sur votre évènement :</h5>
                    {{ Form::token() }}
                    <div class="control-group @if($errors->get('nomEv','<span class="help-inline">:message</span>'))error@endif">
                        <label class="control-label">Nom / titre / intitulé <br> de votre évènement</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('nomEv') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::text('nomEv','',array('id'=>"nomEv", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"Nom / titre / intitulé <br> de votre évènement",'placeholder'=>"A completer",'rele' =>'tooltip',))}}
                            </div>
                        </div>
                    </div>

                    <div class="control-group @if($errors->get('text','<span class="help-inline">:message</span>'))error@endif">
                        <label class="control-label">Texte</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('text') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::textarea('text','',array('id'=>"text",'rows'=>"7", 'class'=>"input-xlarge mceEditor","data-textarea"=>"activer"))}}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="lB" class="tab-pane">
                    <h5>Le type d'activité de votre évènement :</h5>
                    Lorem ipsum dolor sit amet, consecteula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                </div>
                <div id="lC" class="tab-pane">
                    <h5>La localisation de votre évènement :</h5>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenea massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                </div>
            </div>
        </div>
        <div class="tab-section">
            <div style="padding-left: 20px;" class="form-actions" id="action-container2">
                <div style="float:right">
                    <button name="next" class="btn button-next" type="button">Next <i class="icon-angle-right"></i></button>
                    <button name="last" class="btn button-last" type="button">Last <i class="icon-double-angle-right"></i></button>
                    <button name="finish" class="btn button-finish" type="button" style="display: none;">Finish <i class="icon-ok"></i></button>
                </div>
                <div class="form-actions">
                    <input class="btn btn-primary" id="bouton-envoie" type=button value="Continuer" onClick="submit();">
                </div>
            </div>
        </div>
    {{ Form::close() }}
    </div>
</section>
@stop

{{-- Footer script --}}
@section('footer-js')
@parent
    <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&v=3.exp"></script>
    <script src="{{ asset('/pluggin/googleMap/ajouterEve.js') }}"></script>
    <script src="{{ asset('/pluggin/tinyMCE/tiny.js') }}"></script>
    <script src="{{ asset('/pluggin/tinyMCE/tiny_mce/tiny_mce.js') }}"></script>
    <script src="{{ asset('/js/page/ajouterEve-timepicker.js') }}"></script>
    <script src="{{ asset('/js/page/ajouterEve.js') }}"></script>
@stop