<?php

/**
 * index actions.
 *
 * @package    wakeup
 * @subpackage index
 * @author     Alexandru Bumbacea
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indexActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        //$this->forward('default', 'module');
    }

    public function executeIsloggedin(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('application/json');
        $data = array(
            'success' => true,
            'data' => true
        );
        if ($request->isXmlHttpRequest()) {
            if ($this->getUser()->isAuthenticated())
                return $this->renderText(json_encode($data));
            else {
                $data['data'] = false;
                return $this->renderText(json_encode($data));
            }
        }
        $this->forward404();
    }

    public function executeLogin(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('application/json');
        $data = array(
            'success' => true,
            'data' => true
        );

        $form = new sfGuardFormSignin();

        if ($request->isXmlHttpRequest()) {
            if ($request->isMethod(sfWebRequest::POST)) {
                $form->bind($request->getPostParameters());
                if ($form->isValid()) {
                    $this->getUser()->signin($form->getValue('user'), false);
                    $data['data'] = $this->getUser();
                } else {
                    $data['success'] = false;
                    $data['errors'] = array_merge($form->getGlobalErrors(), $form->getErrorSchema()->getErrors());
                }
            } else {
                $data['data'] = array(
                    $form->getCSRFFieldName() => $form->getCSRFToken(),
                );
            }
            return $this->renderText(json_encode($data));
        }
        $this->forward404();
    }
    public function executeSignout(sfWebRequest $request) {
        $this->getResponse()->setContentType('application/json');
        $data = array(
            'success' => true,
            'data' => true
        );
        $this->getUser()->signOut();
        return $this->renderText(json_encode($data));
    }

}
