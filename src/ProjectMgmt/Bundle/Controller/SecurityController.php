<?php

namespace ProjectMgmt\Bundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if ($request
                ->attributes
                ->has(SecurityContext::AUTHENTICATION_ERROR))
            $error = $request
                        ->attributes
                        ->get(SecurityContext::AUTHENTICATION_ERROR);
        else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);

            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        $parameters = array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
        
        return $this->render(
            'ProjectMgmtBundle:Security:login.html.twig',
            $parameters
        );
    }
}
