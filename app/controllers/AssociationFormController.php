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
                    if($this->isAdministrator()){
                        elo_Association::where('id',$id)->update($update);
                    }else{
                        $type = 1;
                        $where = array('id'=>$id);
                        $dataMessage = array('nickname'=>'Dupond');
                        Proposition::add($type,$update,$where,$dataMessage);
                    }
                    $result['redirect_url'] = '/'.$id.'/edit/general-informations';
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
            case 'administrator':
                $v = new validators_associationAdministrator;
                if(Input::has('who')){
                    // if we don't know if he register himself or somebody else
                    $result = $v->add_when_not_admin();
                    if(isset($result['success'])){
                        if($result['data']['who']=='false'){
                            Association::addAdmin(Auth::user()->id,$id,$result['data']['link']);
                        }else{
                            $user = User::where('email', $result['data']['admin_mail'])->firstOrFail();
                            Association::addAdmin($user->id,$id,$result['data']['link']);
                        }
                    }
                }else{
                    // he is already an admin, he is adding somebody else
                    $result = $v->add_when_already_admin();
                    if(isset($result['success'])){
                        $user = User::where('email', $result['data']['admin_mail'])->firstOrFail();
                        Association::addAdmin($user->id,$id,$result['data']['link']);
                    }
                }
                //SECURITY ??
                if(isset($result['success'])){
                    $result['redirect_url'] = '/'.$id.'/edit/administrator';
                }
        }
        if(isset($result['success'])){
            $result['data']=null; //Remove data
        }
        return Response::json($result);
    }

    public function isAdministrator(){
        return true;
    }
}