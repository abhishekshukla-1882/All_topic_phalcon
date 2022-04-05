<?php

use Phalcon\Mvc\Collection;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;


Class MainListner extends Injectable
{
    

    public function before(){
        echo "hello";
        die();
    }
    public function price($e){
        $varr = Settings::find();
        // $v = ;
        $e->price = $varr[0]->price;
        // $e->save();
        // echo "<pre>";
        // print_r($e);
        // die;
        return $e;
    }
    public function stock($e){
        $varr = Settings::find();
        // $v = ;
        $e->stock = $varr[0]->stock;
        // $e->save();
        // echo "<pre>";
        // print_r($e);
        // die;
        return $e;
    }
    public function zip($e){
        $varr = Settings::find();
        // $v = ;
        $e->zipcode = $varr[0]->zipcode;
        return $e;
    }
    public function tag($e,$data,$ec){
        $varr = Settings::findFirst();
        // echo "<pre>";
        // print_r($ec['name']);
        // die;
        if($varr->title == '1'){
            $ec['name'] = $ec['name']."".$ec['tags'];
    
            return $ec;
            
        }
        else{
            return $ec;
        }



    }
}