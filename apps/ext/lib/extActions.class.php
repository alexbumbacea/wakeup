<?php

class extActions extends sfActions  {
    /**
     * @param sfWebRequest $request
     * @return string|void
     */
    public function execute($request) {
        if ($request->isXmlHttpRequest()) {
            // dispatch action
            $actionToRun = 'execute'.ucfirst($this->getActionName());

            if ($actionToRun === 'execute')
            {
                // no action given
                throw new sfInitializationException(sprintf('sfAction initialization failed for module "%s". There was no action given.', $this->getModuleName()));
            }

            if (!is_callable(array($this, $actionToRun)))
            {
                // action not found
                throw new sfInitializationException(sprintf('sfAction initialization failed for module "%s", action "%s". You must create a "%s" method.', $this->getModuleName(), $this->getActionName(), $actionToRun));
            }

            if (sfConfig::get('sf_logging_enabled'))
            {
                $this->dispatcher->notify(new sfEvent($this, 'application.log', array(sprintf('Call "%s->%s()"', get_class($this), $actionToRun))));
            }

            return $this->renderText(json_encode(array(
                'success' => true,
                'data' => $this->$actionToRun($request),
                'controller' => get_called_class(),
                'action' => $actionToRun
            )));
        } else {
            return parent::execute($request);
        }
    }

}