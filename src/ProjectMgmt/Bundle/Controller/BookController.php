<?php

namespace ProjectMgmt\Bundle\Controller;

use ProjectMgmt\Bundle\Form\BookType;
use ProjectMgmt\Bundle\Entity\Book;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookController extends Controller {

    public function showAction($id) {
        $em = $this
                ->getDoctrine()
                ->getManager()
        ;

        $book = $em
                    ->getRepository('ProjectMgmtBundle:Book')
                    ->find($id)
        ;

        if (!$book)
        {
            $this->get('session')->getFlashBag()->add('danger', 'flash.book.error.undefined', array());
            return $this->redirect($this->generateUrl('project_mgmt_homepage'));
        }
        
        return $this->render('ProjectMgmtBundle:Book:show.html.twig', array(
            'book'  => $book,
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

    public function jsonUpdateAction($id)
    {
        $em         = $this->getDoctrine()->getManager();
        $book       = $em->getRepository('ProjectMgmtBundle:Book')->find($id);
        if (!$book)
            throw new NotFoundHttpException('undefined');

        $form       = $this
                        ->createFormBuilder($book)
                        ->setAction($this->generateUrl('ajax_book_update', array(
                            'id'    => $id,
                        )))
                        ->setMethod('POST')
                        ->add('name', 'text', array(
                            'label' => false,
                            'attr'  => array(
                                'class' => 'input-lg'
                            ),
                        ))
                        ->getForm()
        ;
        
        if ($this->getRequest()->isMethod('POST')) {
            $response = array();
            $form->bind($this->getRequest());

            if ($form->isValid()) {
                $serializer = $this->get('jms_serializer');
                $em->persist($book);
                $em->flush();
                $response['code'] = 0;
                $response['result'] = $serializer->serialize($book, 'json');
            } else {
                $response['code'] = -1;
                $response['message'] = $form->getErrorsAsString();
            }

            return new JsonResponse($response);
        }

        return $this->render('ProjectMgmtBundle:Book:edit_form.html.twig', array(
            'form'  => $form->createView(),
        ));
    }
}
