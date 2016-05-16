<?php

namespace MotoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

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

    function addToCartAction(Request $request)
    {
        $id = $request->request->get('id');

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM MotoBundle:Product p
            WHERE p.id = :id'
        )->setParameter('id', $id);

        $product = $query->getArrayResult();

        $session = new Session();
        $products = $session->get('products');

        if ($products) {
            array_push($products, $product[0]);
            $session->set('products', $products);
        } else {
            $session->set('products', array($product[0]));
        }

        return new Response();
    }

    function removeFromCartAction(Request $request)
    {
        $id = $request->request->get('id');

        $session = new Session();
        $products = $session->get('products');

        if ($products) {
            unset($products[$id]);
            $session->set('products', $products);
        }

        return new JsonResponse($products);
    }

    function getCartAction()
    {
        $session = new Session();
        $products = $session->get('products');

        return new JsonResponse($products);
    }

    public function purchaseEmailAction()
    {
        $session = new Session();
        $products = $session->get('products');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $message = \Swift_Message::newInstance()
            ->setSubject('Order in MotoShop')
            ->setFrom('info@motoshop.moto')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'Emails/purchase.txt.twig',
                    array('products' => $products)
                ),
                'text/plain'
            )
        ;

        $sent = $this->get('mailer')->send($message);

        return new Response($sent);
    }
}