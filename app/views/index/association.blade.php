@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
	
    <section>
	    <div>
			<h3 class="head">Fonctionnalités</h3>
	    	<table class="table table-striped">
              <thead>
                <tr>
                  <th>Groupes</th>
                  <th>Fonctionnalités</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Gestion des droits</td>
                  <td>
                  	<i class="fa fa-check-square-o"></i> Création d'association avec/sans administrateur<br>
                  	<i class="fa fa-check-square-o"></i> Gestion des administrateurs<br>
                  	<i class="fa fa-check-square-o"></i> Permettre à n'importe quel membre de faire des propositions d'édition<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des utilisateurs</td>
                  <td>
                  	  <i class="fa fa-check-square-o"></i> Se connecter<br>
                      <i class="fa fa-check-square-o"></i> S'enregistrer<br>
                  	  <i class="fa fa-square-o"></i> Connexion depuis un réseau social<br>
                  	  <i class="fa fa-square-o"></i> Edition du profil<br>
                  	  <i class="fa fa-check-square-o"></i> Envoie des mails<br>
                  	  <i class="fa fa-square-o"></i> Affichage de notifications en temps réel<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des sites associations</td>
                  <td>
                  	<i class="fa fa-check-square-o"></i> Edition du profil adapté aux associations<br>
  	                <i class="fa fa-check-square-o"></i> Gestion des conversations<br>
  	                <i class="fa fa-check-square-o"></i> Gestion du mur d'actualité<br>
                  	<i class="fa fa-square-o"></i> Gestion de pages statiques<br>
                  	<i class="fa fa-square-o"></i> Moteur de recherche d'associations<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des évènements</td>
                  <td>
                  	<i class="fa fa-square-o"></i> Ajout d'évènement<br>
                  	<i class="fa fa-square-o"></i> Permettre aux membres de proposer des évènements<br>
                  	<i class="fa fa-square-o"></i> Ajouter un moteurs de recherche d'évènements<br>
                  	</td>
                </tr>
                <tr>
                  <td>Gestion du bénévolat</td>
                  <td>
                  	  <i class="fa fa-square-o"></i> Ajouter une annonce de recherche de bénévole<br>
                  	  <i class="fa fa-square-o"></i> Ajouter un moteur de recherche de bénévolat<br>
                  	  </td>
                </tr>
                <tr>
                  <td>Gestion des fichiers</td>
                  <td>
                      <i class="fa fa-check-square-o"></i> Gérer l'envoi de fichiers de tous types<br>
                  	  <i class="fa fa-check-square-o"></i> Gérer la découpe d'image<br>
                  	  <i class="fa fa-square-o"></i> Gérer un porte document<br>
                  	  <i class="fa fa-square-o"></i> Gérer des albums de photos<br>
                  	  </td>
                </tr>
                <tr>
                  <td>Connectivité avec les réseaux sociaux</td>
                  <td>
                  	<i class="fa fa-square-o"></i> Synchroniser notre plateforme avec le contenu disponible des autres réseaux sociaux<br>
                  	<i class="fa fa-square-o"></i> Envoie de publication automatiquement sur les réseaux sociaux
                  	</td>
                </tr>
                <tr>
                  <td>Gestion de la sécurité</td>
                  <td>
                  	<i class="fa fa-check-square-o"></i> Attaque XSS <br>
                  	<i class="fa fa-square-o"></i> Utilisation du CSRF<br>
                  	<i class="fa fa-check-square-o"></i> Vérification complète des droits avant d'appliquer les taches d'administrateur<br>
                  	<i class="fa fa-check-square-o"></i> La totalité des autres failles à notre connaissance<br>
                  	</td>
                </tr>
                <tr>
                  <td>Vie Associative</td>
                  <td>
                    <i class="fa fa-check-square-o"></i> Changer le WYSIWYG <br>
                    <i class="fa fa-check-square-o"></i> Ajouter un datepicker - dateperiod<br>
                    <i class="fa fa-square-o"></i> Devrions nous utiliser AngularJS ?<br>
                    </td>
                </tr>
              </tbody>
            </table>
        </div>
    </section>

@stop