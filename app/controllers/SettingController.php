<?php 

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Escaper;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

class SettingController extends Controller
{
    public function IndexAction(){

    }
    public function defaultAction(){
        // $postdata = $_POST ?? array();
        // echo "<pre>";
        // print_r($postdata);

        $request = new Request();
        $product = new Settings();
        $escaper = new Escaper();
        // echo "<pre>";
        // print_r($product);
        // die;
        
        $inputdata = array(
            "title" => $escaper->escapeHtml($this->request->getPost('title'),),
            "zipcode" => $escaper->escapeHtml($this->request->getPost('zipcode'),),
            "price" => $escaper->escapeHtml($this->request->getPost('price'),),
            "stock" => $escaper->escapeHtml($this->request->getPost('stock'),)

        );
        // echo "<pre>";
        // print_r($inputdata);
        // die;
        $product->assign(
            $inputdata,
            [
                'title',
                'price',
                'stock',
                'zipcode'
            ]
        );
        // echo "<pre>";
        // print_r($product->title);
        // die;
        $sett = Settings::find();
        // print_r($sett[0]->title);
        // die;
        
  
        $sett[0]->title = $inputdata['title'];
        $sett[0]->price = $inputdata['price'];
        $sett[0]->stock = $inputdata['stock'];
        $sett[0]->zipcode = $inputdata['zipcode'];
        // $sett[0]->title = $inputdata['title'];
        $sett[0]->save();
        header('Location:http://localhost:8080/');
    }
}
// settings