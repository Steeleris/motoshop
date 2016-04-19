<?php

namespace MotoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    function showAction()
    {
        $products = $this
            ->getDoctrine()
            ->getRepository('MotoBundle:Product')
            ->findAll(array('id' => 'desc'));

        return $this->render('MotoBundle:Product:index.html.twig',
            array(
                'products' => $products
            ));
    }
}