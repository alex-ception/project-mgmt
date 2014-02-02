<?php

namespace ProjectMgmt\Bundle\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjectMgmtBundle:Default:index.html.twig');
    }
}
