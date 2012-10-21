<?php

/**
 * computer actions.
 * @package    wakeup
 * @subpackage computer
 * @author     Alexandru Bumbacea
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class computerActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->computers = Doctrine_Core::getTable('computer')
            ->createQuery('a')
            ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->computer);
        $this->logs = Doctrine_Core::getTable('log')
            ->createQuery('a')
            ->where('computerId = ?', $this->computer->getId())
            ->orderBy('created_at DESC')
            ->limit(10)
            ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new computerForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new computerForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id'))), sprintf('Object computer does not exist (%s).', $request->getParameter('id')));
        $this->form = new computerForm($computer);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id'))), sprintf('Object computer does not exist (%s).', $request->getParameter('id')));
        $this->form = new computerForm($computer);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id'))), sprintf('Object computer does not exist (%s).', $request->getParameter('id')));
        $computer->delete();

        $this->redirect('computer/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $computer = $form->save();

            $this->redirect('computer/edit?id=' . $computer->getId());
        }
    }

    public function executeWakeup(sfWebRequest $request)
    {
        /* @var $computer computer */
        $computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id')));

        $log = new log();
        $log->setComputer($computer);
        $log->setUsername($this->getUser()->getUsername());


        if ($computer->wakeUp()) {
            $this->getUser()->setFlash('info', 'Computer turn on signal was sent. Please wait about 3 minutes before trying to access it!');
        } else {
            $log->setSuccess(false);
            $this->getUser()->setFlash('error', 'There was an error while trying to start your computer.');
        }
        $log->save();
        $this->redirect('computer/show?id=' . $computer->getId());
    }

    /**
     * @param sfWebRequest $request
     */
    public function executeRemote(sfWebRequest $request)
    {
        /* @var $computer computer */
        $computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id')));
        if ($computer->verityStatus()) {
            $this->getUser()->setFlash('info', 'Computer is awake!');
        } else {
            $this->getUser()->setFlash('error', 'Computer is not available! The computer may be in sleep or off state.');
        }
        $this->redirect('computer/show?id=' . $computer->getId());
    }
}
