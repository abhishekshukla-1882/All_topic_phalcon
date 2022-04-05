<?php
// session_start();
use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;

class UserController extends Controller
{
    public function indexAction()
    {
        // if ($this->cookies->has("login")) { 
        //     // Get the cookie 
        //     $loginCookie = $this->cookies->get("login"); 
            
        //     // Get the cookie's value 
        //     $value = $loginCookie->getValue(); 
        //     echo($value); 
        //  } 
    }
    public function dashboaredAction()
    {
        $coo = $this->cookies->has('username');
        // die();
        if($coo){
            $this->view->is_sess = $this->session;

            // header('Location:http://localhost:8080/user/dashboared');
        }else{
            header('Location:http://localhost:8080/login');

        }
        // echo $this->session->get('userdata');
        // die();
        // if ($this->cookies->has("login")) { 
        //     // echo "h";
        //     // die();
        //     // Get the cookie 
        //     $loginCookie = $this->cookies->get("login"); 
            
        //     // Get the cookie's value 
        //     $value = $loginCookie->getValue(); 
        //     // echo($value); 
        //     $this->view->tab = $value;
        // } 
    }
    public function logoutAction(){
        $uns = $this->cookies->get('username');
        $uns->delete('username');
        $this->session->remove('token');
        unset($this->session);
        header('Location:http://localhost:8080/login');
    }
    public function userAction(){
        $user = Users::find();
        $this->view->user = $user;
        echo "ya";
        // die;

    }
    public function editAction(){
        $request = new Request();

        $id = $request->get('id');
        // echo $id;
        $user = Users::find($id);
        $this->view->user = $user;
        // echo "<pre>";
        // print_r($user);
    
    }
    public function deleteAction(){
        $request = new Request();

        $id = $request->get('id');
        // echo $id;
        $user = Users::find($id);
       $user->delete();
        // echo "<pre>";
        // print_r($user);
    
    }
    public function submitAction(){
        $postdaa = $_POST ?? array();
        // print_r($postdaa);

        echo $postdaa['username'];
        $user =Users::findFirst($postdaa['id']);
        $user->username = $postdaa['username'];
        $user->password = $postdaa['password'];
        $user->status = $postdaa['status'];
        // $user->assign(
        //     $postdaa,
        //     [
        //         'id',
        //         'username',
        //         'password',
        //         ''

        // ])
        $user->save();
        header('Location:http://localhost:8080/user/edit/');

    }
}