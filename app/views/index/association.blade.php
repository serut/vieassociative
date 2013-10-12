@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
	
    <section>
	    <div>
			<h3 class="head">{{Lang::get('index/index.head_what_vieassociative')}}</h3>
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
                  <td><i class="icon-ok"></i> Création d'association sans administrateur<br>
                  	<i class="icon-ok"></i> Gestion des administrateurs<br>
                  	<i class="icon-ok"></i> Possibilité à n'importe quel membre de faire des propositions d'édition<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des utilisateurs</td>
                  <td><i class="icon-ok"></i> Connexion<br>
                  	  <i class="icon-ok"></i> Enregistrement<br>
                  	  <i class="icon-remove"></i> Edition du profil<br>
                  	  <i class="icon-remove"></i> Envoi des mails<br>
                  	  <i class="icon-remove"></i> Notifications en temps réel<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des sites associations</td>
                  <td><i class="icon-ok"></i> Edition du profil adapté aux associations<br>
                  <i class="icon-ok"></i> Gestion des conversations<br>
                  <i class="icon-remove"></i> Gestion d'un mur d'actualité<br>
                  	<i class="icon-remove"></i> Gestion de pages statiques<br>
                  	<i class="icon-remove"></i> Moteur de recherche d'associations<br>
                  	<i class="icon-remove"></i> Gestion des sponsors<br>
                  </td>
                </tr>
                <tr>
                  <td>Gestion des évènements</td>
                  <td><i class="icon-remove"></i> Ajout d'évènement<br>
                  	<i class="icon-remove"></i> Permission de proposition d'évènement par les membres<br>
                  	<i class="icon-remove"></i> Ajout d'un moteurs de recherche d'évènements<br></td>
                </tr>
                <tr>
                  <td>Gestion du bénévolat</td>
                  <td><i class="icon-remove"></i> Ajout de demande de bénévolat<br>
                  	  <i class="icon-remove"></i> Ajout d'un moteur de recherche de bénévolat<br></td>
                </tr>
                <tr>
                  <td>Gestion des fichiers</td>
                  <td><i class="icon-remove"></i> Gérer l'envoi de fichiers de tous types<br>
                  	  <i class="icon-remove"></i> Gestion du porte document<br>
                  	  <i class="icon-remove"></i> Gérer des albums de photos<br>
                  	  <i class="icon-remove"></i> Permission de proposition de photos<br>
                  	  </td>
                </tr>
                <tr>
                  <td>Connectivité avec les réseaux sociaux</td>
                  <td>
                  	<i class="icon-remove"></i> Synchronisation de notre plateforme avec le contenu disponible sur les autres réseaux sociaux<br>
                  	<i class="icon-remove"></i> Envoie des posts de façon automatique à une heure préfixée sur les réseaux sociaux
                  	</td>
                </tr>
                <tr>
                  <td>Gestion de la sécurité</td>
                  <td><i class="icon-remove"></i> Attaque XSS <br>
                  	<i class="icon-remove"></i> Utilisation du CSRF<br>
                  	<i class="icon-remove"></i> Vérification complètes des droits avant d'appliquer les taches d'administrateur<br>
                  	<i class="icon-ok"></i> La totalité des autres failles à ma connaissance<br>
                  	</td>
                </tr>
              </tbody>
            </table>
        </div>
    </section>

@stop