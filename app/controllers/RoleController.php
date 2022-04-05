<?php 

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;


class RoleController extends Controller
{
    public function IndexAction(){

    }
    public function dbroleAction(){
        $request = new Request();

        // $postdata = $_POST ?? array();
        // echo "<pre>";
        // print_r($postdata);
        // die;
        $data = new Roles();
        $role = $this->request->getpost('role');
        $data->assign(
            $this->request->getPost(),
                [
                    'role'
                ]
            );
        $data->save();
        // echo "<pre>";
        // print_r($role);
        // die;

    }
    public function componentAction(){
        $acll = APP_PATH . "/controllers/";
        $data = scandir($acll,1);
        // echo "<pre>";
        // print_r($data);
        // die;
        $this->view->contlr = $data;


    }
    public function dbcompAction(){
        // $postdata = $_POST ?? array();
        // echo "<pre>";
        // print_r($postdata);
        // die;
        echo "h";
        // die;
        $request = new Request();
        $data = new Components();
        $comp = $this->request->getpost('component');
        // echo $comp;
        // die;
        $data->assign(
            $this->request->getpost(),
            [
                'component'
            ]
        );
        $data->save();

        header('Location:http://localhost:8080/');
    }
    public function actionAction(){
        // $per = Permissions::find();
        // echo "<pre>";
        // print_r($per->role);
        // die();
        $acll = APP_PATH . "/controllers/";
        $data = scandir($acll,1);
        $role = Roles::find();
        // echo "<pre>";
        // print_r($role);
        // die;
        $this->view->contlr = $data;
        $this->view->role = $role;

    }
    public function pubactionAction(){
        $control = $this->request->getpost('component');
        $role = $this->request->getpost('role');
       
        // if($data){
        // echo "<pre>";
        // print_r($data);
        $len = strlen($control);
        $cont = substr($control,0,($len-4));
        // echo $cont;
        // die;
        $data = get_class_methods($cont);
        $this->view->contlr = $data;
        $this->view->controller = $control;
        $this->view->role = $role;
        // echo $role;
        // die;
        // if(isset($_POST['submit'])){
        //     echo "aya";
        //     die;
        }
    public function permisionAction(){
        // $postdata = $_POST ?? array();
        // echo "<pre>";
        // print_r($postdata);
        // die;
        $request = new Request();
        $role = $this->request->getpost('role');
        $controller = $this->request->getpost('controller');
        $action = $this->request->getpost('action');
        // echo $role;
        // die;
        $per = new Permissions();
        $per->assign(
            $this->request->getpost(),
            [
                'role',
                'controller',
                'action'
            ]
            );
        $per->save();
        echo "Saved";
        die;

    }
    }