<?php

class NotificationController extends BaseController
{
    // This bullshit is not working
    public function getNotification()
    {
        // 1 utilisateur :
        //   -> a ses notifications dans sa table notification_user
        //   -> a les notifications des associations dans la table notification_assoc la ou il est administrateur
        // Trie par ordre decroissant d'ajout
    }

    static function addNotificationUser()
    {
        $pubnub = App::make('Pubnub');
        // send the notification to pubnub ( l'utilisateur le recoit en temps réel )
        // Et ajoute la notification dans la base de donnée
    }

    static function addNotificationAssociation()
    {
        $pubnub = App::make('Pubnub');
        // send the notification to pubnub ( l'utilisateur le recoit en temps réel )
        // Et ajoute la notification dans la base de donnée
    }
}