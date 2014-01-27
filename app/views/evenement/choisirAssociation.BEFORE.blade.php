@extends('template.theme')

{{-- Web site Title --}}
@section('title')
@parent
Modifier ses évènements
@stop

{{-- Content --}}
@section('content')
    <div class="row features">
        <div class="tab-section raw-fluid">
            <div class="span3">
                <div class="tab-head">
                    <h1>Ajouter une association</h1>
                </div>
                @include('forms.ajouterAssociation')
            </div>
            <div class="span3">
                <div class="tab-head">
                    <h1>Vos associations :</h1>
                </div>
                <div class="tab_container">
                    <div class="tab_container_in">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
