<?php 

use Phalcon\Mvc\Controller;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Role;
use Phalcon\Acl\Component;
use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;
use Phalcon\Security\JWT\Token\Parser;
use Phalcon\Security\JWT\Validator;


class SecureController extends Controller
{
    public function createtokenAction(){

        // echo Phalcon\Version::get();
        // die;
        $signer  = new Hmac();

        // Builder object
        $builder = new Builder($signer);

        $now        = new DateTimeImmutable();
        $issued     = $now->getTimestamp();
        $notBefore  = $now->modify('-1 minute')->getTimestamp();
        $expires    = $now->modify('+1 day')->getTimestamp();
        $passphrase = 'QcMpZ&b&mo3TPsPk668J6QH8JA$&U&m2';

        // Setup
        $builder
            ->setAudience('https://target.phalcon.io')  // aud
            ->setContentType('application/json')        // cty - header
            ->setExpirationTime($expires)               // exp 
            ->setId('abcd123456789')                    // JTI id 
            ->setIssuedAt($issued)                      // iat 
            ->setIssuer('https://phalcon.io')           // iss 
            ->setNotBefore($notBefore)                  // nbf
            ->setSubject('my subject for this claim')   // sub
            ->setPassphrase($passphrase)                // password 
        ;

        // Phalcon\Security\JWT\Token\Token object
        $tokenObject = $builder->getToken();

        // The token
        echo $tokenObject->getToken();

    }


    public function buildAction(){
        $aclfile = APP_PATH . '/security/acl.cathe';
        // echo "gann";
        // die;
        if(true !== is_file($aclfile)){
            $acl = new Memory();
            // $acl->addRole('manager');
            $acl->addRole('admin');
            // $acl->addrole('accounting');
            // $acl->addrole('guest');
                $per = Permissions::find();
                foreach($per as $val){
                    $len = strlen($val->controller);
                    $cont = strtolower(substr($val->controller,0,($len-14)));

                    $len2 = strlen($val->action);
                    $action = strtolower(substr($val->action,0,($len2-6)));
                    // echo $action ."<br>";
                    // echo $val->role;
                    // die;
                    $acl->addComponent(
                        $cont,
                        [
                            $action
                        ]
                        );
                    $acl->addRole($val->role);
                    $acl->allow($val->role,$cont,$action);
                }
                $acl->allow('admin',"*","*");
                echo "$val->role    $cont / $action";
                echo "   fff";
                //die;
                // die;
                // echo "<pre>";
                // print_r($per->role);
                // die();
                // $acl->allow('manager','test','eventtest');
                // $acl->allow('admin','*','*');
                // $acl->deny('guest','*','*');
                file_put_contents(
                    $aclfile,
                    serialize($acl)

                );
        }
        else{
            $acl = unserialize(
                file_get_contents(
                    $aclfile
                ));
        }
        if(true === $acl->isAllowed('accounting','test','eventtest')){
            echo 'Access granted';
        }
        else{
            echo "Access Denied";
        }
    }
}