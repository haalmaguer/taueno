<?php

namespace Prodi\TauenoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;

class SecureController extends Controller {
   
    /**
     * @Route("/register", name="register")
     * @Template()
     */
    public function registerAction() {
        return array();
    }
    
    /**
     * @Route("/makeregistration", name="makeregistration")
     * @Template()
     */
    public function makeregistrationAction() {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $request = $this->getRequest();
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        
        $user = $dm->getRepository("TauenoBundle:Seller")->findOneByEmail($email);
        if($user){
            $result = array("code"=>'1',"success"=>false, "message"=>" El email $email ya existe, por favor use otra direccion de correo");
            return new \Symfony\Component\HttpFoundation\Response(json_encode($result));
        }
            
        $seller = new \Prodi\TauenoBundle\Document\Seller();
        $seller->setName($name)
        ->setEmail($email)
        ->setUsername($email)
        ->setPassword($password);
        
        try {
            $role = $dm->getRepository("TauenoBundle:Role")->findOneByName("ROLE_SELLER");
            $seller->addUserRole($role);            
            $role->addUser($seller);
            $dm->persist($role);
            $dm->persist($seller);
            
            $dm->flush();
            
            $result = array("success"=>true, "message"=>"Se ha registrado correctamente");
            
            return new \Symfony\Component\HttpFoundation\Response(json_encode($result));
        } catch (Exception $exc) {
            $result = array("code"=>'2', "success"=>false, "message"=>"Ha ocurrido un error");
            return new \Symfony\Component\HttpFoundation\Response(json_encode($result));
        }

        
    }
    
    /**
     * @Route("/edit_profile", name="edit_profile")
     * @Template()
     */
    public function editProfileAction() {
        $seller= $this->get("security.context")->getToken()->getUser();
        $request = $this->getRequest();
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        
        $seller->setName($name)
        ->setEmail($email)
        ->setUsername($email)
        ->setPassword($password);
        
    }
   
    
    /**
     * @Route("/ventas", name="ventas")
     * @Template()
     */
    public function ventasAction() {
        
        return array();
    }
   
    
 
    /**
     * @Route("/ventas/profile", name="profile")
     * @Template()
     */
    public function profileAction() {
        return array();
    }
    
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction() {
        $error = false;
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        //echo $error; die;
        return array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
        );
    }

    /**
     * @Route("/login_check", name="_security_check")
     */
    public function securityCheckAction() {
        echo "adasd"; die;
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_logout")
     */
    public function logoutAction() {
        // ...
    }
    

}
