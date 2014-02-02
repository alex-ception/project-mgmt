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

    public function editAction($id, Request $request) {
        $article = $this->getInstance();
        $em = $this->getDoctrine()->getEntityManager();
        $article = $em->getRepository('TripsToDoTripstodoBundle:' . $this->getRepository())->find($id);
        $editForm = $this->createForm($this->getForm(), $article);
        $editForm->handleRequest($request);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find this article.');
        }

        if ($editForm->isValid()) {
            if ($editForm->get('delete')->isClicked()) {
                $em->remove($article);
                $em->flush();
                return $this->render('TripsToDoTripstodoBundle:Default:index.html.twig');
            }
            $user = new User();
            $user = $this->getUser();
            if ($user != null) {
                return $this->render('TripsToDoUserBundle:User:login.html.twig');
            }
            $em = $this->getDoctrine()->getEntityManager();
            $article->setLastuser($user);
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl(strtolower($this->getRepository()) . '_show', array('id' => $article->getId())));
        }

        return $this->render('TripsToDoTripstodoBundle:' . $this->getRepository() . ':edit.html.twig', array(
                    'article' => $article,
                    'class' => 'class=""',
                    'form' => $editForm->createView(),
                    'class' => 'class=""',
        ));
    }

}
