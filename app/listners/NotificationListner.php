<?php
namespace App\Listeners;
include(APP_PATH . '/vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Phalcon\Mvc\Collection;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Acl\Adapter\Memory;
use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;
use Phalcon\Security\JWT\Token\Parser;
use Phalcon\Security\JWT\Validator;

Class NotificationListner extends Injectable
{
    public function IndexAction(){

    }
    public function beforeHandleRequest(Event $event, \Phalcon\Mvc\Application $application){
        // echo "hii";
        // die;
        // $role = $application->request->get('role');
        // echo $role;
        // die;
        $aclFile = APP_PATH . '/security/acl.cathe';
        if (true === is_file($aclFile)) {
            $acl = unserialize(file_get_contents($aclFile));
            // $bearer = $application->request->get('bearer')??'invalidToken';
            $bearer = $this->session->get('token');
            $controller = $application->router->getControllerName() ?? 'index';
            $action = $application->router->getActionName() ?? 'index';
            // echo $bearer;
            // die;
            try {
                $key = "key";
                $decoded = JWT::decode($bearer, new Key($key, 'HS256'));
                // echo $decoded;
                // print_r($decoded);
                // die;
                $decoded_array = (array) $decoded;
                $role = $decoded_array['role'];

                // echo "<pre>";
                // print_r($decoded_array);
                // die;

                // $role = $parser->parse($bearer)->getClaims()->getPayload();
                // $r = $role['sub'];
                // echo "<pre>";
                // print_r($role);
                // echo $r,'<br>',$controller,'<br>',$action;
                // die;


            } catch (\Exception $e) {
                echo "Try valid token please !";
                die;
            }
            if (!$role || true !== $acl->isAllowed($role, $controller, $action)) {
                echo 'denied';
                die;
            }
        }
       
}
}