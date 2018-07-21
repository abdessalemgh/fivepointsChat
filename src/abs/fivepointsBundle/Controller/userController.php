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
 * @Route("user")
 */
class userController extends Controller
{
    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_registration", options={"expose"=true}, methods={"GET", "POST"})
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
            $user->setEnabled(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('showuser');
        }

        return $this->render('absfivepointsBundle:User:new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

}