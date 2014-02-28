<?php

/**
 * This is the controller for user pages
 *
 * @author  Mieulet Léo <l.mieulet@gmail.com>
 */
class UserController extends BaseController
{
    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        return View::make('user.edit')
            ->with('user', User::find($id));
    }

    /**
     * @param string item = the name of the input that the user wants to edit
     * @param int id = the user id
     * @see http://www.vieassociative.fr/user/{{user_id}}-{{slug_user}}
     * @return View A form for edit the $item of the user
     */
    public function getForm($id, $item)
    {
        $view_name = 'user.form.' . $item;
        switch ($item) {
            case 'email':
            case 'password':
            case 'firstname':
            case 'lastname':
            case 'avatar_img':
                $val = User::find($id)->$item;
                return View::make($view_name)->with('val', $val);
        }
        return Response::view('errors.404', array(), 404);
    }

    /**
     * @param string item = the name of the input that the user wants to edit
     * @param int id = the user id
     * @return Json The user sent data, we result the result of his query
     */
    public function postForm($id, $item)
    {
        $result = array('error' => 'no method found');
        switch ($item) {
            case 'email':
            case 'password':
            case 'firstname':
            case 'lastname':
            case 'avatar_img':
                $v = new validators_editUser;
                $result = $v->$item();
                if (isset($result['success']) && Auth::user()->id == $id) {
                    $update = array($item => $result['data'][$item]);
                    User::where('id', $id)->update($update);
                    $result['refresh'] = 'true';
                }
        }
        if (isset($result['success'])) {
            $result['data'] = null; //Remove data
        }
        return Response::json($result);
    }
}

