@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
    <section>
        <div>
            <h3 class="head">{{Lang::get('user/edit.head_modification')}}</h3>
                
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Votre adresse mail</td>
                  <td>{{{$user->email}}}</td>
                  <td><a href="#" data-modal-form="email"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Votre mot de passe</td>
                  <td></td>
                  <td><a href="#" data-modal-form="password"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <tr>
                  <td>Votre prénom</td>
                  <td>{{{$user->firstname}}}</td>
                  <td><a href="#" data-modal-form="firstname"><i class="fa fa-pencil"></i></td>
                </tr>
                <tr>
                  <td>Votre nom de famille</td>
                  <td>{{{$user->lastname}}}</td>
                  <td><a href="#" data-modal-form="lastname"><i class="fa fa-pencil"></i></a><br></td>
                </tr>
                <tr>
                  <td>Votre avatar</td>
                  <td><img src="{{$user->getAvatar()}}"></td>
                  <td><a href="#"><i class="fa fa-pencil"></i></a></td>
                </tr>
              </tbody>
            </table>
        </div>
    </section>
@stop
@section('footer-js')
<script type="text/javascript">
    /*Modal form bind PART START*/
    var USERID = {{$user->id}};
    $('a[data-modal-form]').click(function(e){
        $.ajax({
            url: 'form/'+$(this).attr('data-modal-form'),
            dataType: "json",
        }).done(function ( data ) {
            modalForFormModification(data);
        }).fail(function() {
            alert("error");
        });
        e.preventDefault();
    })
    /*Modal form bind PART END*/
</script>
@stop

