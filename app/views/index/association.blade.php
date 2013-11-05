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
                  	<i class="icon-ok"></i> Création d'association avec/sans administrateur<br>
                  	<i class="icon-ok"></i> Gestion des administrateurs<br>
                  	<i class="icon-ok"></i> Permettre à n'importe quel membre de faire des propositions d'édition<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des utilisateurs</td>
                  <td>
                  	  <i class="icon-ok"></i> Se connecter<br>
                      <i class="icon-ok"></i> S'enregistrer<br>
                  	  <i class="icon-ok"></i> Connexion depuis un réseau social<br>
                  	  <i class="icon-remove"></i> Edition du profil<br>
                  	  <i class="icon-ok"></i> Envoie des mails<br>
                  	  <i class="icon-remove"></i> Affichage de notifications en temps réel<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des sites associations</td>
                  <td>
                  	<i class="icon-ok"></i> Edition du profil adapté aux associations<br>
  	                <i class="icon-ok"></i> Gestion des conversations<br>
  	                <i class="icon-remove"></i> Gestion du mur d'actualité<br>
                  	<i class="icon-remove"></i> Gestion de pages statiques<br>
                  	<i class="icon-remove"></i> Moteur de recherche d'associations<br>
                  	<i class="icon-remove"></i> Gestion des sponsors<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des évènements</td>
                  <td>
                  	<i class="icon-remove"></i> Ajout d'évènement<br>
                  	<i class="icon-remove"></i> Permettre aux membres de proposer des évènements<br>
                  	<i class="icon-remove"></i> Ajouter un moteurs de recherche d'évènements<br>
                  	</td>
                </tr>
                <tr>
                  <td>Gestion du bénévolat</td>
                  <td>
                  	  <i class="icon-remove"></i> Ajouter une annonce de recherche de bénévole<br>
                  	  <i class="icon-remove"></i> Ajouter un moteur de recherche de bénévolat<br>
                  	  </td>
                </tr>
                <tr>
                  <td>Gestion des fichiers</td>
                  <td>
                  	  <i class="icon-ok"></i> Gérer l'envoi de fichiers de tous types<br>
                  	  <i class="icon-remove"></i> Gérer un porte document<br>
                  	  <i class="icon-remove"></i> Gérer des albums de photos<br>
                  	  </td>
                </tr>
                <tr>
                  <td>Connectivité avec les réseaux sociaux</td>
                  <td>
                  	<i class="icon-remove"></i> Synchroniser notre plateforme avec le contenu disponible des autres réseaux sociaux<br>
                  	<i class="icon-remove"></i> Envoie de publication automatiquement sur les réseaux sociaux
                  	</td>
                </tr>
                <tr>
                  <td>Gestion de la sécurité</td>
                  <td>
                  	<i class="icon-ok"></i> Attaque XSS <br>
                  	<i class="icon-remove"></i> Utilisation du CSRF<br>
                  	<i class="icon-ok"></i> Vérification complète des droits avant d'appliquer les taches d'administrateur<br>
                  	<i class="icon-ok"></i> La totalité des autres failles à notre connaissance<br>
                  	</td>
                </tr>
                <tr>
                  <td>Vie Associative</td>
                  <td>
                    <i class="icon-ok"></i> Changer le WYSIWYG <br>
                    <i class="icon-ok"></i> Ajouter un datepicker - dateperiod<br>
                    <i class="icon-remove"></i> Devrions nous utiliser AngularJS ?<br>
                    </td>
                </tr>
              </tbody>
            </table>
        </div>
    </section>

@stop