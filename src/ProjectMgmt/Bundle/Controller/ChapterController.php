<?php

namespace ProjectMgmt\Bundle\Controller;

use ProjectMgmt\Bundle\Entity\Chapter;
use \ProjectMgmt\Bundle\Form\ChapterType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ChapterController extends Controller {

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
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

        $book = $this->getDoctrine()->getRepository('ProjectMgmtBundle:Book')->findOneById($idBook);

        return $this->render('ProjectMgmtBundle:Chapter:new.html.twig', array(
                    'form' => $form->createView(),
                    'book' => $book,
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
    public function jsonUpdateAction($id, $field)
    {
        $em         = $this->getDoctrine()->getManager();
        $chapter    = $em->getRepository('ProjectMgmtBundle:Chapter')->find($id);
        if (!$chapter)
            throw new NotFoundHttpException();
        
        if ($chapter->getAuthor()->getId() !== $this->getUser()->getId())
            throw new AccessDeniedHttpException();

        $formBuilder = $this
                    ->createFormBuilder($chapter)
                        ->setAction($this->generateUrl('ajax_chapter_update', array(
                            'id'    => $id,
                            'field'  => $field,
                        )))
                        ->setMethod('POST')
        ;
        
        switch ($field) {
            case 'name':
                $formBuilder->add('name', 'text', array(
                        'label' => false,
                        'attr'  => array(
                            'class' => 'input-lg'
                        ),
                ));
               break;
            case 'content':
                $formBuilder->add('content', 'afe_elastic_textarea', array(
                    'label' => false,
                ));
            default:
                break;
        }
        
        $form = $formBuilder->getForm();
        
        if ($this->getRequest()->isMethod('POST')) {
            $response = array();
            $form->bind($this->getRequest());

            if ($form->isValid()) {
                $serializer = $this->get('jms_serializer');
                $em->persist($chapter);
                $em->flush();
                $response['code'] = 0;
                $response['result'] = $serializer->serialize($chapter, 'json');
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
