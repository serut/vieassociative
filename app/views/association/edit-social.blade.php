@extends('template.theme')



@set_true $main_and_aside 
@section('main-content')
<section>
    <div>
        <ul class="breadcrumb">
          <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <span class="divider">/</span></li>
          <li><a href="/{{$association->id}}/edit">Edition</a> <span class="divider">/</span></li>
          <li class="active">Editer les pages sociales</li>
        </ul>
        <h3 class="head">{{Lang::get('association/edit.edit_association')}}</h3>
        <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>
        <hr>
    {{ Form::open(array('class' => 'form-horizontal')) }}
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#lA">Facebook</a></li>
                <li><a data-toggle="tab" href="#lB">Twitter</a></li>
                <li><a data-toggle="tab" href="#lC">Google +</a></li>
            </ul>
            <div class="tab-content">
                <div id="lA" class="tab-pane active">
                    <h5>Facebook</h5>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenea massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                </div>
                <div id="lB" class="tab-pane">
                    <h5>Twitter</h5>
                    Lorem ipsum dolor sit amet, consecteula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
                </div>
                <div id="lC" class="tab-pane">
                    <h5>Google Plus</h5>
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