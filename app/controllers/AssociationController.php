<?php

/**
 * This is the controller for association pages
 *
 * @author  Mieulet Léo <l.mieulet@gmail.com>
 */
class AssociationController extends BaseController
{
    /**
     * @see http://association.vieassociative.fr/
     * @return View Search associations
     */
    public function getSearchIngine()
    {
        if (Input::has('all')) {
            $listAssociation = Association::all();
        } else {
            $listAssociation = Association::where('plan', '>', 1)->get();
        }
        return View::make('index.listing')
            ->with('association', $listAssociation);
    }


    /**
     * @see http://association.vieassociative.fr/add
     * @return View Users can add an other association on this page
     */
    public function getAdd()
    {
        return View::make('association.add');
    }

    /**
     * @see http://association.vieassociative.fr/{$idAssoc}/edit
     * @param int $idAssoc The ID of this association
     * @return View Users can view the admin association pannel from there
     */
    public function getEdit($idAssoc)
    {
        return View::make('association.edit')
            ->with('count_news', News::countNews($idAssoc))
            ->with('count_admin', Association::countAdmin($idAssoc))
            ->with('association', Association::find($idAssoc))
            ->with('proposition', Proposition::getPropositions($idAssoc));
    }

    /**
     * @see http://association.vieassociative.fr/{$idAssoc}-{$slug}
     * @param int $idAssoc The ID of this association
     * @param $slug
     * @return View The wall of the association
     */
    public function getProfile($idAssoc, $slug)
    {
        $association = Association::find($idAssoc);
        if ($association->plan == 1 && $slug != $association->slug) {
// It's a private association
            return App::abort(404);
        }
        return View::make('association.profile')
            ->with('association', $association)
            ->with('newsFeed', News::listNews($idAssoc));
    }

    /**
     * @see http://association.vieassociative.fr/{$idAssoc}/edit/general-informations
     * @param int $idAssoc The ID of this association
     * @internal param string $slug The slug corresponding of the name of the association
     * @return View Page where you can edit general information
     */
    public function getEditGeneralInformations($idAssoc)
    {
        return View::make('association.edit-general-informations')
            ->with('association', Association::find($idAssoc));
    }

    /**
     * @todo Page non fonctionnelle : edition de paramètre propre à notre site
     * @see http://association.vieassociative.fr/{$idAssoc}/edit/general-informations
     * @param int $idAssoc The ID of this association
     * @return View Page where you can edit vieassociative information
     */
    public function getEditVieAssociativeInformations($idAssoc)
    {
        return View::make('association.edit-vieassociative-informations')
            ->with('association', Association::find($idAssoc));
    }

    /**
     * @see http://association.vieassociative.fr/{$idAssoc}/edit/administrator
     * @param int $idAssoc The ID of this association
     * @return View Edit administrator for this association
     */
    public function getEditAdministrator($idAssoc)
    {
        return View::make('association.edit-administrator')
            ->with('association', Association::find($idAssoc))
            ->with('is_admin', User::isAdministrator($idAssoc))
            ->with('admin', UserAssociation::where('id_assoc', $idAssoc)->with('author')->get());
    }


    /**
     * API : Create a new association
     * @return JSON
     */
    public function postAdd()
    {
        $v = new validators_associationAdd;
        $result = $v->add();
        if (isset($result['success'])) {
            $id_assoc = Association::add($result['data']);
// if the association has been created by one of his authorised user
            if ($result['data']['choice'] == "true") {
                User::addAssoc(Auth::user()->id, $id_assoc, $result['data']['link']);
                $result['redirect_url'] = '/' . $id_assoc . '/edit/general-informations';
            } else {
                $result['redirect_url'] = '/' . $id_assoc . '-' . Str::slug($result['data']['name'], '-');;
            }
            $result['data'] = null; //Remove data
        }
        return Response::json($result);
    }

    /**
     * @param $idAssoc
     * @param $idGallery
     * @param string $typeCrop
     * @param string $action
     * @return \Illuminate\View\View
     */
    public function getUpload($idAssoc, $idGallery, $typeCrop = "", $action = "")
    {
        if (App::environment() == "production") {
            $prefix = 'a';
        } else {
            $prefix = 'deva';
        }
        return View::make('picture.upload')
            ->with('association', Association::find($idAssoc))
            ->with('gallery', Folder::getGallery($idAssoc))
            ->with('prefix', $prefix)
            ->with('typeCrop', $typeCrop)
            ->with('action', $action)
            ->with('hasNextStep', !empty($typeCrop));
    }

    /**
     * @param $idAssoc
     * @param $typeCrop
     * @param $action
     * @param $namePic
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function getCrop($idAssoc, $typeCrop, $action, $namePic)
    {
        if (App::environment() == "production") {
            $prefix = 'a';
        } else {
            $prefix = 'deva';
        }
        switch ($typeCrop) {
            case '400x400':
                $x = 400;
                $y = 400;
                break;
            case '120x120':
                $x = 120;
                $y = 120;
                break;
            case '1130x400':
                $x = 1130;
                $y = 400;
                break;
            case '200x200':
                $x = 200;
                $y = 200;
                break;

            default:
                return Response::view('errors.404', array(), 404);
                break;
        }
        return View::make('picture.crop')
            ->with('prefix', $prefix)
            ->with('name', $namePic)
            ->with('x', $x)
            ->with('y', $y)
            ->with('association', Association::find($idAssoc))
            ->with('type', Input::get('change'));
    }

    /**
     * @todo Page non fonctionnelle
     */
    public function getEditSocial($idAssoc)
    {
        return View::make('association.edit-social');
    }

    /**
     * @todo Page non fonctionnelle
     */
    public function getHistory($idAssoc)
    {
        return View::make('association.history');
    }
}