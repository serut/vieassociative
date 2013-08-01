@extends('template.theme')

{{-- Web site Title --}}
@section('title')
@parent
Ajouter un évènement
@stop

{{-- Header CSS --}}
@section('header-css')
@parent
    <link href="{{ asset('/css/googleMap.css') }}" rel="stylesheet">
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

{{-- Content --}}
@section('content')
<div class="column left span9">
    <!-- Tabs Section Start -->
        {{ Form::open(array('class' => 'form-horizontal')) }}
    <div class="tab-section">
        <div class="tab-head">
            <h1>Ajouter un évènement</h1>
            <div class="tab_menu_container">
                <ul id="myTab">  
                    <li class="active"><a data-toggle="tab" href="#tab1">Contenu</a></li>
                    <li><a data-toggle="tab" href="#tab2">Type</a></li>
                    <li><a data-toggle="tab" href="#tab3">Lieu</a></li>
                    <li><a data-toggle="tab" href="#tab4">Date</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <div class="tab-content offset1">
            <div class="progress active" id="bar">
                <div class="bar bar-success" style="width: 25%;"></div>
            </div>
                <div id="tab1" class="tab-pane active">
                    <small>Vous voulez ajouter un évènement à <b>{{Session::get('associationEnManagementNom')}}</b>. <a href="/association/gerer">Changer ?</a></small>
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
                <div id="tab2" class="tab-pane">
                    <h5>Le type d'activité de votre évènement :</h5>
                    <div class="control-group @if($errors->get('choixActivite','<span class="help-inline">:message</span>'))error@endif">
                        <label class="control-label">Type d'activé</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('choixActivite') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::select('choixActivite', $typeEvenement)}}
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Sous-activité</label>
                        <div class="controls">
                            <div class="formulaire">
                                {{Form::select('choixActivite', $typeEvenement)}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group @if($errors->get('propositionSousCategorie','<span class="help-inline">:message</span>'))error@endif">
                        <label class="control-label">Ou ajouter la si la sous-activité est abscente de ce menu déroulant</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('propositionSousCategorie') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::text('propositionSousCategorie','',array('type' => 'text', 'id'=>"propositionSousCategorie", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"lipsum df sdf sdf sd",'placeholder'=>"A completer",'rele' =>'tooltip',))}}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab-pane">
                    <h5>La localisation de votre évènement :</h5>
                    <p>Etape 1 : Renseigner le nom d'un lieu proche de votre position actuelle :</p>
                    <div class="control-group @if($errors->get('ville','<span class="help-inline">:message</span>'))error@endif">
                        <label class="control-label">Votre lieu proche</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('ville') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::text('ville','',array('type' => 'text','id'=>"ville", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"A completer : peut avoir des erreurs + explication fonctionnement",'placeholder'=>"Ville pour notre géolocalisation",'rele' =>'tooltip',))}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <p>#Etape 2 : Modifiez, en déplaçant le curseur, pour réellement concorder au point exact ou est situé votre évènement  :</p>
                        <div id="map_canvas"></div>
                    </div>
                    <div class="control-group @if($errors->get('adresse_reelle','<span class="help-inline">:message</span>'))error@endif">
                        <p>#Etape 3 : Nommez ce lieu plus correctement, pour la meilleure compréhension de tous !</p>
                        <label class="control-label">Nom correct du lieu</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('adresse_reelle') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::text('adresse_reelle','',array('id'=>"adresse_reelle",'rows'=>"2", 'class'=>"input-xxlarge"))}}
                            </div>
                        </div>
                    </div>
                    {{Form::hidden('idVilleBDD','0',array('id'=>"idVilleBDD"))}}
                    {{Form::hidden('lat','0',array('id'=>"lat"))}}
                    {{Form::hidden('lng','0',array('id'=>"lng"))}}
                </div>
                <div id="tab4" class="tab-pane">
                    <h5>La date de votre évènement :</h5>
                    <small>Nous supportons deux types de répétitions d'évènements : les évènements non récurrent et les évènements récurrent. Un évènement récurrent est un évènement qui se répétera de façon très régulière sur une période spécifié. </small>
                    {{Form::hidden('selectionTypeEvenement','0',array('id'=>"selectionTypeEvenement"))}}

                    {{-- EVENEMENT QUI SE REPETE --}}
                    <div id="partie-repete">
                        <div class="control-group @if($errors->get('deb','<span class="help-inline">:message</span>'))error@endif">
                            <label class="control-label">Date de début de l'activité</label>
                            <div class="controls">
                                <div class="formulaire">
                                    @foreach ($errors->get('deb') as $message)
                                        {{$message}}
                                    @endforeach
                                    {{Form::text('deb','',array('type' => 'text','class' => 'input-small', 'id'=>"deb", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"fgddsf ezf ",'placeholder'=>"",'rele' =>'tooltip',))}}
                                </div>
                            </div>
                        </div>

                        <div class="control-group @if($errors->get('fin','<span class="help-inline">:message</span>'))error@endif">
                            <label class="control-label">Date de fin de l'activité</label>
                            <div class="controls">
                                <div class="formulaire">
                                    @foreach ($errors->get('fin') as $message)
                                        {{$message}}
                                    @endforeach
                                    {{Form::text('fin','',array('type' => 'text','class' => 'input-small', 'id'=>"fin", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"fgddsf ezf ",'placeholder'=>"",'rele' =>'tooltip',))}}
                                </div>
                            </div>
                        </div>
                            <?php /*
                        <div class="control-group">
                            <label class="control-label">Type de répétition</label>
                            <div class="controls-allbox">
                                <label class="radio"><?php echo $this->formInput($form->get('repetition')) ?> Toutes les semaines ( Ex : tous les lundi, mardi et jeudi de toutes les semaines de la periode )</label>
                                <label class="radio"><?php echo $this->formInput($form->get('repetition')) ?> Toutes les 1 semaines sur 2 ( Ex : tous les lundi, mardi et jeudi de la periode 1 semaine sur 2 )</label>
                            </div>
                            <div class="controls-allbox">
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('lundi')); ?> Lundi </label><span id="lundiheure"> - Heure : <?php echo $this->formInput($form->get('lundid')); ?> à <?php echo $this->formInput($form->get('lundif')); ?></span><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('mardi')); ?> Mardi </label><span id="mardiheure"> - Heure : <?php echo $this->formInput($form->get('mardid')); ?> à <?php echo $this->formInput($form->get('mardif')); ?></span><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('mercredi')); ?> Mercredi </label><span id="mercrediheure"> - Heure : <?php echo $this->formInput($form->get('mercredid')); ?> à <?php echo $this->formInput($form->get('mercredif')); ?></span><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('jeudi')); ?> Jeudi </label><span id="jeudiheure"> - Heure : <?php echo $this->formInput($form->get('jeudid')); ?> à <?php echo $this->formInput($form->get('jeudif')); ?></span><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('vendredi')); ?> Vendredi </label><span id="vendrediheure"> - Heure : <?php echo $this->formInput($form->get('vendredid')); ?> à <?php echo $this->formInput($form->get('vendredif')); ?></span><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('samedi')); ?> Samedi </label><span id="samediheure"> - Heure : <?php echo $this->formInput($form->get('samedid')); ?> à <?php echo $this->formInput($form->get('samedif')); ?></span><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('dimanche')); ?> Dimanche </label><span id="dimancheheure"> - Heure : <?php echo $this->formInput($form->get('dimanched')); ?> à <?php echo $this->formInput($form->get('dimanchef')); ?></span>
                            </div>
                        </div>
                        */ ?>
                    </div>
                    <div id="partie-non-repete">
                        <div class="control-group @if($errors->get('ddd','<span class="help-inline">:message</span>'))error@endif">
                            <label class="control-label">Date du début de l'évènement</label>
                            <div class="controls">
                                <div class="formulaire">
                                    @foreach ($errors->get('ddd') as $message)
                                        {{$message}}
                                    @endforeach
                                    {{Form::text('ddd','',array('type' => 'text','id'=>"ddd", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"Bla bla bla bla bla sdqsd",'placeholder'=>"",'rele' =>'tooltip',))}}
                                </div>
                            </div>
                        </div>
                        <div class="control-group @if($errors->get('ddf','<span class="help-inline">:message</span>'))error@endif">
                            <label class="control-label">Date du fin de l'évènement</label>
                            <div class="controls">
                                <div class="formulaire">
                                    @foreach ($errors->get('ddf') as $message)
                                        {{$message}}
                                    @endforeach
                                    {{Form::text('ddf','',array('type' => 'text','id'=>"ddf", 'data-placement'=> 'right','data-rel'=> 'tooltip', 'data-trigger'=>"focus", 'data-original-title'=>"Bla bla bla bla bla sdqsd",'placeholder'=>"",'rele' =>'tooltip',))}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="repete" type="button">Evènement récurrent</button>
                    <button class="btn btn-primary" id="nonrepete" type="button">Evènement non récurrent</button>
                </div>
            </div>
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
</div>
@stop
