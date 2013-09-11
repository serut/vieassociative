<?php

class AssociationFormController  extends BaseController {

    
    public $allowedOrigin = array('general-informations',
                                    'vieassociative-informations',
                                );
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
                    case 'name':
                    case 'legal_name':
                    case 'acronym':
                    case 'goal':
                    case 'official_date_creation':
                    case 'website_url':
                    case 'headquater':
                    case 'admitted_public_utility':
                    case 'internal_regulation':
                    case 'statuts':
                    case 'contact_adress':
                    $val = elo_Association::find($id)->$item;
                    return View::make($view_name)->with('val',$val);
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
                        case 'name':
                            $result = $v->name();
                            $update=array('name' => $result['data']['name']);
                            break;
                        case 'legal_name':
                            $result = $v->legal_name();
                            $update= array('legal_name' => $result['data']['legal_name']);
                            break;
                        case 'acronym':
                            $result = $v->acronym();
                            $update = array('acronym' => $result['data']['acronym']);
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
                            $boolean = ($result['data']['admitted_public_utility'] == "true") ? 1 : 0; 
                            $update = array('admitted_public_utility' => $boolean);
                            break;
                        case 'internal_regulation':
                            $result = $v->internal_regulation();
                            $update = array('internal_regulation' => $result['data']['internal_regulation']);
                            break;
                        case 'statuts':
                            $result = $v->statuts();
                            $update = array('statuts' => $result['data']['statuts']);
                            break;
                        case 'contact_adress':
                            $result = $v->contact_adress();
                            $update = array('contact_adress' => $result['data']['contact_adress']);
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