<?php

namespace ProjectMgmt\Bundle\Controller;

use \ProjectMgmt\Bundle\Form\BookType;
use \ProjectMgmt\Bundle\Entity\Book;

class BookController extends Controller {

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $book = $em->getRepository('ProjectMgmtBundle:Book')->find($id);
        return $this->render('ProjectMgmtBundle:Book:show.html.twig', array(
                    'book' => $book,
        ));
    }

    public function newAction() {
        $form = $this->createForm(new BookType());


        return $this->render('ProjectMgmtBundle:Book:new.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function createAction() {
        $book = new Book();
        $form = $this->createForm(new BookType(),$book);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirect($this->generateUrl('book_show', array('id' => $book->getId())));
        }
    }

}
