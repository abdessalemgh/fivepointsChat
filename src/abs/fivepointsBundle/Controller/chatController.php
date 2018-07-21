<?php

namespace abs\fivepointsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use abs\userBundle\Entity\User;
use abs\fivepointsBundle\Entity\message;
use abs\fivepointsBundle\Repository\messageRepository;
use abs\fivepointsBundle\Entity\conversation;
use abs\fivepointsBundle\Repository\conversationRepository;

/**
 * Bouquet controller.
 *
 * @Route("dashboard")
 */
class chatController extends Controller
{
    /**
     * @Route("/NewMessage/{id}", name="sendMessage", options={"expose"=true})
     */
    public function showusersAction(Request $request, User $receiver)
    {

        $em = $this->getDoctrine()->getManager();
        $receiver = $em->getRepository('absuserBundle:User')->find($receiver);
        $sender = $this->getUser();
        //query builder.to get thos profiles conversations
        $query = $em->getRepository('absfivepointsBundle:conversation')->createQueryBuilder('c')
            ->select('c.id')
            ->where('c.firstUser = :sender')
            ->andWhere('c.secondeUser= :receiver')
            ->setParameter('sender', $sender->getId())
            ->setParameter('receiver', $receiver->getId())
            ->getQuery();
        $conversationExist = $query->getArrayResult();
        if(sizeof($conversationExist) == 0){
            $query = $em->getRepository('absfivepointsBundle:conversation')->createQueryBuilder('c')
                ->select('c.id')
                ->where('c.firstUser = :sender')
                ->andWhere('c.secondeUser= :receiver')
                ->setParameter('sender', $receiver->getId())
                ->setParameter('receiver', $sender->getId())
                ->getQuery();
            $conversationExist = $query->getArrayResult();
        }

        //Create first conversation.
        if(!sizeof($conversationExist)){
            $conversation = new conversation();
            $conversation->setFirstUser($sender);
            $conversation->setSecondeUser($receiver);
            $em->persist($conversation);
            $em->flush();
        }
        else{
            $conversation = $em->getRepository('absfivepointsBundle:conversation')->find($conversationExist[0]["id"]);
        }
        //create this new message.
        $message = new message();
        $message->setSender($sender);

        $form = $this->createForm('abs\fivepointsBundle\Form\messageType', $message);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $message->setConversation($conversation);
            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('sendMessage',array('id' => $receiver->getId()));
        }

        return $this->render('absfivepointsBundle:Menu:sendmessage.html.twig',
            array('conversation'=>$conversation ,'form' => $form->createView()));
        //return $this->render('absfivepointsBundle:Menu:sendmessage.html.twig',array('users'=>$sender));
    }

}