@extends('template.theme')



@set_true $main_and_aside 
@section('main-content')
<section>
    <div>
        <ul class="breadcrumb">
          <li><a href="/1-qsdf">Faites de la musique</a> </li>
          <li><a href="/1/edit">Edition</a> </li>
          <li><a href="/1/edit/evenement">Mes évènements</a> </li>
          <li class="active">Editer un évènement</li>
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
                <li><a data-toggle="tab" href="#lB">Type</a></li>
                <li><a data-toggle="tab" href="#lC">Lieu</a></li>
                <li><a data-toggle="tab" href="#lD">Date</a></li>
            </ul>
            <div class="tab-content">
                <div id="lA" class="tab-pane active">
                    <h5>Informations sur votre évènement :</h5>
                    {{ Form::token() }}
                    <div class="control-group @if($errors->get('nomEv','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
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

                    <div class="control-group @if($errors->get('text','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
                        <label class="control-label">Texte</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('text') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::textarea('text','',array('id'=>"text",'rows'=>"7", 'class'=>"form-control mceEditor","data-textarea"=>"activer"))}}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="lB" class="tab-pane">
                    <h5>Le type d'activité de votre évènement :</h5>
                    <div class="control-group @if($errors->get('choixActivite','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
                        <label class="control-label">Type d'activé</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('choixActivite') as $message)
                                    {{$message}}
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Sous-activité</label>
                        <div class="controls">
                            <div class="formulaire">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group @if($errors->get('propositionSousCategorie','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
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
                <div id="lC" class="tab-pane">
                    <h5>La localisation de votre évènement :</h5>
                    <p>Etape 1 : Renseigner le nom d'un lieu proche de votre position actuelle :</p>
                    <div class="control-group @if($errors->get('ville','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
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
                    <div class="control-group @if($errors->get('adresse_reelle','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
                        <p>#Etape 3 : Nommez ce lieu plus correctement, pour la meilleure compréhension de tous !</p>
                        <label class="control-label">Nom correct du lieu</label>
                        <div class="controls">
                            <div class="formulaire">
                                @foreach ($errors->get('adresse_reelle') as $message)
                                    {{$message}}
                                @endforeach
                                {{Form::text('adresse_reelle','',array('id'=>"adresse_reelle",'rows'=>"2", 'class'=>"form-control"))}}
                            </div>
                        </div>
                    </div>
                    {{Form::hidden('idVilleBDD','0',array('id'=>"idVilleBDD"))}}
                    {{Form::hidden('lat','0',array('id'=>"lat"))}}
                    {{Form::hidden('lng','0',array('id'=>"lng"))}}
                </div>
                <div id="lD" class="tab-pane">
                <h5>La date de votre évènement :</h5>
                    <small>Nous supportons deux types de répétitions d'évènements : les évènements non récurrent et les évènements récurrent. Un évènement récurrent est un évènement qui se répétera de façon très régulière sur une période spécifié. </small>
                    {{Form::hidden('selectionTypeEvenement','0',array('id'=>"selectionTypeEvenement"))}}
                    <div id="partie-repete">
                        <div class="control-group @if($errors->get('deb','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
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

                        <div class="control-group @if($errors->get('fin','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
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
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('lundi')); ?> Lundi </label><col-lg- id="lundiheure"> - Heure : <?php echo $this->formInput($form->get('lundid')); ?> à <?php echo $this->formInput($form->get('lundif')); ?></col-lg-><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('mardi')); ?> Mardi </label><col-lg- id="mardiheure"> - Heure : <?php echo $this->formInput($form->get('mardid')); ?> à <?php echo $this->formInput($form->get('mardif')); ?></col-lg-><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('mercredi')); ?> Mercredi </label><col-lg- id="mercrediheure"> - Heure : <?php echo $this->formInput($form->get('mercredid')); ?> à <?php echo $this->formInput($form->get('mercredif')); ?></col-lg-><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('jeudi')); ?> Jeudi </label><col-lg- id="jeudiheure"> - Heure : <?php echo $this->formInput($form->get('jeudid')); ?> à <?php echo $this->formInput($form->get('jeudif')); ?></col-lg-><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('vendredi')); ?> Vendredi </label><col-lg- id="vendrediheure"> - Heure : <?php echo $this->formInput($form->get('vendredid')); ?> à <?php echo $this->formInput($form->get('vendredif')); ?></col-lg-><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('samedi')); ?> Samedi </label><col-lg- id="samediheure"> - Heure : <?php echo $this->formInput($form->get('samedid')); ?> à <?php echo $this->formInput($form->get('samedif')); ?></col-lg-><br>
                                <label class="checkbox noretourligne"><?php echo $this->formInput($form->get('dimanche')); ?> Dimanche </label><col-lg- id="dimancheheure"> - Heure : <?php echo $this->formInput($form->get('dimanched')); ?> à <?php echo $this->formInput($form->get('dimanchef')); ?></col-lg->
                            </div>
                        </div>
                        */ ?>
                    </div>
                    <div id="partie-non-repete">
                        <div class="control-group @if($errors->get('ddd','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
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
                        <div class="control-group @if($errors->get('ddf','<col-lg- class="help-inline">:message</col-lg->'))error@endif">
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
        </div>
        <div class="tab-section">
            <div style="padding-left: 20px;" class="form-actions" id="action-container2">
                <div style="float:right">
                    <button name="next" class="btn button-next" type="button">Next <i class="fa fa-angle-right"></i></button>
                    <button name="last" class="btn button-last" type="button">Last <i class="fa fa-double-angle-right"></i></button>
                    <button name="finish" class="btn button-finish" type="button" style="display: none;">Finish <i class="fa fa-ok"></i></button>
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
    
    <script src="{{ asset('/js/vendor/datepicker.js') }}"></script>
    <script type="text/javascript">
        var lang = {
            monthNames:[
                "Janvier", "Février", "Mars", "Avril", "Mai", "Juin","Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"
            ],
            datepicker:{
                daysMin: ["D", "L", "M", "M", "J", "V", "S"],
                months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Jui", "Juil", "Aoû", "Sep", "Oct", "Nov", "Déc"]
            }
        }

        var from = new Date();
        var to = new Date();
        var textDate = from.getDate()+' '+lang.monthNames[from.getMonth()]+' '+from.getFullYear()+' - '+to.getDate()+' '+lang.monthNames[to.getMonth()]+' '+to.getFullYear();
        $('.date-container .date-range-field col-lg- :last').text(textDate);
                
        $('.datepicker-calendar:last').click(function(event){
            // stop the click propagation when clicking on the calendar element
            // so that we don't close it
            event.stopPropagation();
        }).DatePicker({
            inline: true,
            date: [from, to],
            calendars: 3,
            mode: 'range',
            locale: lang.datepicker,
            starts:1,
            current: new Date(to.getFullYear(), to.getMonth() - 1, 1),
            onChange: function(dates,el) {
                onChangeDatePicker(dates,$(this));
            }
        });
        $('.date-container .date-range-field:last').click(function(){
            $(this).parent().find('.datepicker-calendar').toggle();
            if($(this).parent().find('.date-range-field a').text().charCodeAt(0) == 9660) {
                // switch to up-arrow
                $(this).parent().find('.date-range-field a').html('&#9650;');
            } else {
                // switch to down-arrow
                $(this).parent().find('.date-range-field a').html('&#9660;');
            }
            return false;
        }); 
        $('.datepicker-from :last').val(intToString(from.getDate())+'/'+intToString(from.getMonth())+'/'+from.getFullYear())
                                    .bind('change',function(){changeValOfInput($(this))})
        $('.datepicker-to :last').val(intToString(to.getDate())+'/'+intToString(to.getMonth())+'/'+to.getFullYear())
                                    .bind('change',function(){changeValOfInput($(this))})
        $('html').click(function() {
            changePeriod();
        });
        
    </script>
@stop