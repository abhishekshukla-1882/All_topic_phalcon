<?php
// session_start();

use Phalcon\Http\Request;
use Phalcon\Escaper;
use Phalcon\Mvc\Controller;



class ProductController extends Controller
{

    public function indexAction()
    {
        
    }
    public function productaddAction()
    {   $product = new Products();
        $request = new Request();
        if (true === $request->isPost('submit')) {
            $product_name = $request->get('product_name');
            $discription = $request->get('discription');
            $category = $request->get('category');
            // echo $product_name;
            // echo "aya";
            // die();
            $escaper = new Escaper();
            $add_product = array(
                "name" => $escaper->escapeHtml($product_name),
                "discription" => $escaper->escapeHtml($discription),
                "category" => $escaper->escapeHtml($category),
            );
            $product->assign(
                $add_product,
                [
                    'name',
                    'discription',
                    'category'
                ]
                );
                $product->save();


        }
    }



}