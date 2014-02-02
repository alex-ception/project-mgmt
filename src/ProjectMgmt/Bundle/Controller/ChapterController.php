<?php

namespace ProjectMgmt\Bundle\Controller;

use ProjectMgmt\Bundle\Entity\Chapter;
use \ProjectMgmt\Bundle\Form\ChapterType;

class ChapterController extends Controller {

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $chapter = $em->getRepository('ProjectMgmtBundle:Chapter')->find($id);
        $user = $this->getUser();
        if ($user->getId() == $chapter->getAuthor()->getId()) {
            $form = $this->createForm(new ChapterType(), $chapter);


            return $this->render('ProjectMgmtBundle:Chapter:edit.html.twig', array(
                        'form' => $form->createView(),
                        'id' => $id
            ));
        } else {
            return $this->render('ProjectMgmtBundle:Chapter:show.html.twig', array(
                        'chapter' => $chapter,
            ));
        }
    }

    public function newAction($idBook) {
        $form = $this->createForm(new ChapterType());


        return $this->render('ProjectMgmtBundle:Chapter:new.html.twig', array(
                    'form' => $form->createView(),
                    'idBook' => $idBook
        ));
    }

    public function createAction($idBook) {
        $user = $this->getUser();
        $book = $this->getDoctrine()->getRepository('ProjectMgmtBundle:Book')->find($idBook);
        $chapter = new Chapter();
        $form = $this->createForm(new ChapterType(), $chapter);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $chapter->setBook($book);
            $chapter->setAuthor($user);
            $em->persist($chapter);
            $em->flush();

            return $this->redirect($this->generateUrl('chapter_show', array('id' => $chapter->getId())));
        }
    }

    public function editAction($id) {
        
    }

    public function updateAction($id) {
        $chapter = $this->getDoctrine()->getRepository('ProjectMgmtBundle:Chapter')->find($id);
        $form = $this->createForm(new ChapterType(), $chapter);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chapter);
            $em->flush();

            return $this->redirect($this->generateUrl('chapter_show', array('id' => $chapter->getId())));
        }
    }

}
