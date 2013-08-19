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
    public function postForm($id,$origin,$item) {
        $result = array('error'=>'no method found');
        switch ($origin) {
            case 'general-informations':
                $v = new validators_associationGeneralInformation;
                switch ($item) {
                    case 'display_name':
                        $result = $v->display_name();
                        $update=array('name' => $result['data']['display_name']);
                        break;
                    case 'legal_name':
                        $result = $v->legal_name();
                        $update= array('legal_name' => $result['data']['legal_name']);
                        break;
                    case 'acronym_name':
                        $result = $v->acronym_name();
                        $update = array('acronym' => $result['data']['acronym_name']);
                        break;
                    case 'goal':
                        $result = $v->goal();
                        $update = array('goal' => $result['data']['goal']);
                        break;
                    case 'official_date_creation':
                        $result = $v->official_date_creation();
                        $update = array('official_date_creation' => $result['data']['official_date_creation']);
                        break;
                    case 'website_url':
                        $result = $v->website_url();
                        $update = array('website_url' => $result['data']['website_url']);
                        break;
                    case 'headquater':
                        $result = $v->headquater();
                        $update = array('headquater' => $result['data']['headquater']);
                        break;
                    case 'admitted_public_utility':
                        $result = $v->admitted_public_utility();
                        $update = array('admitted_public_utility' => $result['data']['admitted_public_utility']);
                        break;
                }
                if(isset($result['success'])){
                    elo_Association::where('id',$id)->update($update);
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
        if(isset($result['success'])){
            $result['redirect_url'] = '/'.$id.'/edit/general-informations';
            $result['data']=null; //Remove data
        }
        return Response::json($result);
    }
}