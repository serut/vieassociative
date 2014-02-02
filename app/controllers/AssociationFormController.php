<?php

/**
    * This is the controller for form's of association pages
    *
    * @author  Mieulet Léo <l.mieulet@gmail.com>
*/
class AssociationFormController  extends BaseController {

    
    public $allowedOrigin = array('general-informations',
                                    'vieassociative-informations',
                                );
    /**
    *    @origin = the page name on the association control panel
    *    @item = the name of the input that the user wants to edit
    *    Controls the origin and the item before redering corresponding form
    *    @return View The form needed for edit the corresponding information
    */
    public function getForm($id_assoc,$origin,$item) {
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
                    case 'headquarter':
                    case 'admitted_public_utility':
                    case 'internal_regulation':
                    case 'statuts':
                    case 'contact_adress':
                    $val = Association::find($id_assoc)->$item;
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

    /**
    *    @origin = the page name on the association control panel
    *    @item = the name of the input that the user wants to edit
    *    Controls the origin and the item before redering corresponding form
    *    @return View The form needed for edit the corresponding information
    */
    public function postForm($id_assoc,$origin,$item) {
        $result = array('error'=>'no method found');
        switch ($origin) {
            case 'general-informations':
                $result = $this->modifyGeneralInformations($id_assoc,$item);
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
                switch ($item) {
                    case 'add':
                        $result = $this->addAdministrator($id_assoc,$item);
                        break;
                    case 'remove':
                        $result = $this->removeAdministrator($id_assoc);
                        break;
                }

            case 'news':
                switch ($item) {
                    case 'add':
                        $result = AssociationNewsController::addNews($id_assoc);
                        break;
                    case 'title':
                    case 'textarea':
                        $result = AssociationNewsController::editPartialNews($id_assoc,$origin,$item);
                        break;

                }
                
        }
        if(isset($result['success'])){
            $result['data']=null; //Remove data
        }
        return Response::json($result);
    }

    /**
    *   Try to add an administrator of $id_assoc association
    */
    private function addAdministrator($id_assoc, $item){
        $v = new validators_associationAdministrator;
        if(Input::has('who')){
            // if we don't know if he register himself or somebody else
            $result = $v->add_when_not_admin();
            if(isset($result['success'])){
                $nbAdmin = UserAssociation::where('id_assoc',$id_assoc)->count();
                if($nbAdmin==0 || User::isAdministrator($id_assoc)){
                    if($result['data']['who']=='false'){
                        User::addAdmin(Auth::user()->id,$id_assoc,$result['data']['link']);
                    }else{
                        $user = User::where('email', $result['data']['admin_mail'])->firstOrFail();
                        if(!User::isUserAdministrator($id_assoc,$user->id)){
                            User::addAdmin($user->id,$id_assoc,$result['data']['link']);
                        }
                    }
                }
            }
        }else{
            $result = $v->add_when_already_admin();
            // he is already an admin, he is adding somebody else
            if(isset($result['success']) && User::isAdministrator($id_assoc)){
                $user = User::where('email',"l.mieulet@gmail.com")->first();
                //$user = User::where('email',$result['data']['admin_mail'])->first();
                if(!User::isUserAdministrator($id_assoc,$user->id)){
                    User::addAdmin($user->id,$id_assoc,$result['data']['link']);
                }
            }
        }
        if(isset($result['success'])){
            $result['redirect_url'] = '/'.$id_assoc.'/edit/administrator';
        }
        return $result;
    }

    /**
    *   Try to remove an administrator of $id_assoc association
    */
    private function removeAdministrator($id_assoc){
        $v = new validators_associationAdministrator;
        $result = $v->remove($id_assoc);
        if(isset($result['success'])){
            UserAssociation::findOrFail(Input::get('id'))->delete();
        }
        $result['redirect_url'] = '/'.$id_assoc.'/edit/administrator';
        return $result;
    }

    /**
    *   Try to edit a value of the association ( proposition or admin modification )
    */
    private function modifyGeneralInformations($id_assoc,$item){
        $v = new validators_associationGeneralInformation;
        switch ($item) {
            case 'name':
            case 'legal_name':
            case 'acronym':
            case 'goal':
            case 'official_date_creation':
            case 'website_url':
            case 'headquarter':
            case 'internal_regulation':
            case 'statuts':
            case 'contact_adress':
                $result = $v->$item();
                if(isset($result['success'])){
                    $update=array($item => $result['data'][$item]);
                    $before = Association::find($id_assoc)->$item;
                    $proposition = $result['data'][$item];
                }
                break;
            case 'admitted_public_utility':
                $result = $v->$item();
                if(isset($result['success'])){
                    $boolean = ($result['data'][$item] == "true") ? 1 : 0; 
                    $update = array($item => $boolean);
                    $before = Association::find($id_assoc)->$item;
                    $proposition = $boolean;
                }
                break;
        }
        if(isset($result['success'])){
            if(User::isAdministrator($id_assoc)){
                //Apply the request right now
                Association::where('id',$id_assoc)->update($update);
            }else{
                //Create a proposition
                $data['id_assoc'] = $id_assoc;
                $data['type'] = $item;
                $data['update'] = $update;
                $data['where'] = array('id'=>$id_assoc);
                $data['message'] = array('before'=>$before,
                                        'after'=>$proposition,
                                        'explanation'=>Lang::get('association/proposition/type.'.$item),
                                        'title'=>Lang::get('association/proposition/title.'.$item),
                                        'type_answer'=>(empty($before)) ? 2 : 1
                                    );
                Proposition::add($data);
            }
            $result['redirect_url'] = '/'.$id_assoc.'/edit/general-informations';
        }
        return $result;
    }
    
}