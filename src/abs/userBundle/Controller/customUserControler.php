<?php

namespace abs\userBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use abs\userBundle\Entity\User;

class customUserControler extends Controller
{

    /**
     * Creates a new user entity.
     *
     * @Route("/user/new", name="user_new", options={"expose"=true}, methods={"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('abs\userBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('showuser');
        }

        return $this->render('absuserBundle:user:new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

}
