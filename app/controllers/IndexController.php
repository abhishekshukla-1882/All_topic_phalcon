<?php
// session_start();
include(APP_PATH . '/vendor/autoload.php');

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class IndexController extends Controller
{
    public function indexAction()
    {
        // print_r($this->date);
        // die();
        $key = "key";
        $token = JWT::decode($this->session->get('token'), new Key($key, 'HS256'));
        // $token = $this->session->get('token');
        // $decoded = JWT::decode($bearer, new Key($key, 'HS256'));
                // echo $decoded;
                // die;
        $decoded_array = (array) $token;
        $role = $decoded_array['role'];
        // die($role);
        // echo "<pre>";
        // print_r($token);
        // die;

        $this->view->all_products=Products::find();
        // $request = new Request();
        // echo "<pre>";
        // print_r($product);
        // echo "</pre>";
        // die();


        
        // return '<h1>Hello World!</h1>';
    }
    public function listAction(){
        $this->view->all_products=Products::find();


    }
    public function taskAction(){
        // echo "aya";
        // die();
        $request = new Request();

        if(isset($_POST['submit'])){

            $val = $request->get('submit');
            $val_id = $request->get('id');
            // echo $val;
            // die();
            if($val == "edit"){
                $data=Products::find($val_id);
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                // die();

                $this->view->data = $data;


            }
            if($val == 'delete'){
                $this->view->data=Products::find($val_id);
                // echo "<pre>";
                // print_r($data);
                // echo "</pre>";
                // die();

                // $this->view->data = $data;
                $this->view->data->delete();
                header('Location:http://localhost:8080/');



            }
        }

    }
    public function editAction(){
        $request = new Request();
        $postdata = $_POST ?? array();
        // print_r($postdata);
       
        if($postdata){
            // $data=Products::find($val_id);
            $id = $request->get('idd');
            $name = $postdata['name'];
            $category = $postdata['category'];
            $discription = $postdata['discription'];
            // $data=Products::query()
            //     ->where("product_id = '$idd'")
            //     ->execute();
            $this->view->data = Products::find(

                [
                    'conditions' => 'product_id = ?1',
                    'bind'       => [
                        1 => $id,
                    ]
                ]
                    );
       
                $this->view->data[0]->name = $name;
                $this->view->data[0]->category = $category;
                $this->view->data[0]->discription = $discription;
                $this->view->data[0]->save();
                header('Location:http://localhost:8080/');






        }

        
    }
}