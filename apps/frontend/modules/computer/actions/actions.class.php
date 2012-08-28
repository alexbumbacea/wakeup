<?php

/**
 * computer actions.
 *
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
      ->where('computerId = ?',$this->computer->getId())
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
    if ($form->isValid())
    {
      $computer = $form->save();

      $this->redirect('computer/edit?id='.$computer->getId());
    }
  }
  public function executeWakeup(sfWebRequest $request) {
    $computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id')));
    $server = $request->getPathInfoArray();
    exec("/usr/bin/wakeonlan ".$computer->getMAC(),$arr);
    $log = new log();
    $log->setComputer($computer);
    $log->setUsername($server['REMOTE_USER']);
    if (strpos($arr[0],'Sending magic packet')!==false)
    {
      $this->getUser()->setFlash('info','Computer turn on signal was sent. Please wait about 3 minutes before trying to access it!');
    } else {
      $log->setSuccess(false);
      $this->getUser()->setFlash('error','There was an error while trying to start your computer.');
    }
    $log->save();
    $this->redirect('computer/show?id='.$computer->getId());
  }
  public function executeRemote(sfWebRequest $request) {
    $computer = Doctrine_Core::getTable('computer')->find(array($request->getParameter('id')));

    $server  = $computer->getIp();
    $port   = "3389";
    $timeout = "10";
    if ($server and $port and $timeout) {
      $verbinding =  @fsockopen("$server", $port, $errno, $errstr, $timeout);
    }
    if($verbinding) {
      $this->getUser()->setFlash('info','RDP is available!');
    }
    else {
      $this->getUser()->setFlash('error','RDP is unavailable! The computer may be in sleep or off state.');
    }
    $this->redirect('computer/show?id='.$computer->getId());
  }
}