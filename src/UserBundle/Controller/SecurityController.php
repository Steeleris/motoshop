<?php
namespace UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{
    public function loginPageAction()
    {
        if ($this->get('security.context')->isGranted('ROLE_USER'))
        {
            return $this->redirect($this->generateUrl('homepage'));
        }
        else
            return $this->render('UserBundle:Security:login.html.twig');
    }

    protected function renderLogin(array $data)
    {
        return $this->render('UserBundle:Security:login.html.twig', $data);
    }
}