<?php

class AssociationFormController  extends BaseController {

    /*
        @origin = the page name on the association control panel
        @item = the name of the input that the user wants to edit
        Controls the origin and the item before redering corresponding form
    */
    public function getForm($id,$origin,$item) {
        $view_name = 'form_association.'.$origin.'.'.$item;
        switch ($origin) {
            case 'general-informations':
                switch ($item) {
                    case 'display_name':
                    case 'legal_name':
                    case 'acronym_name':
                    case 'goal':
                    case 'official_date_creation':
                    case 'website_url':
                    case 'headquater':
                    case 'admitted_public_utility':
                        return View::make($view_name);
                }
                break;
            case 'vieassociative-informations':
                switch ($item) {
                    case 'association_protection':
                    case 'association_categories':
                    case 'activities':
                    case 'services_between_partners':
                    case 'module_photo':
                    case 'module_evenement':
                    case 'module_social':
                    case 'module_sponsor':
                    case 'module_price':
                    case 'main_mail':
                    case 'welcome_text':
                        return View::make($view_name);
                }
                break;
        }
        return Response::view('errors.404', array(), 404);
    }
}