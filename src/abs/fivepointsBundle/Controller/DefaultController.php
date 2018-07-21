<?php

namespace abs\fivepointsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use abs\userBundle\Entity\User;

/**
 * Bouquet controller.
 *
 * @Route("dashboard")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="dashboard", options={"expose"=true})
     */
    public function indexAction()
    {
        return $this->render('absfivepointsBundle:Menu:index.html.twig');
    }

    /**
     * @Route("/users", name="showusers", options={"expose"=true})
     */
    public function showusersAction()
    {
        $users = $this->get('fos_user.user_manager');
        $users = $users->findUsers();
        return $this->render('absfivepointsBundle:Menu:showuser.html.twig',array('users'=>$users));
    }

}