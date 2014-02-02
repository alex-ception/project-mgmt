<?php

namespace ProjectMgmt\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller extends BaseController
{
    public function render($view, array $parameters = array(), Response $response = null)
    {
        $books = $this
                    ->get('doctrine')
                    ->getRepository('ProjectMgmtBundle:Book')
                    ->menuFindAll();
        
        $formated_books = array();
        
        $global_parameters = array(
            'books' => $books,
        );
        return parent::render($view, array_merge($parameters, $global_parameters), $response);
    }
}
