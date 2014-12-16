<?php

namespace Kolekti\UrlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UrlController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KolektiUrlBundle:Default:index.html.twig', array('name' => $name));
    }
}
