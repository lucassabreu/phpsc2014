<?php

namespace PHPSC\UltraBlog\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
    
    public function indexAction($name) {
        return $this->render('PHPSCUltraBlogBundle:Default:index.html.twig', array(
            'name' => $name
        ));
    }
}
