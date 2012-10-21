<?php

/**
 * computer form.
 * @package    wakeup
 * @subpackage form
 * @author     Alexandru Bumbacea
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class computerForm extends BasecomputerForm
{
    public function configure()
    {
        unset($this['created_at'], $this['updated_at']);
        $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
            'choices' => $this->getObject()->getAvailableComputerTypes(),
        ));

        $this->validatorSchema['ip'] = new sfValidatorRegex(array(
            'pattern' => '/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/',
            'required' => true,
        ), array(
            'invalid' => 'Please provide a valid IP address!',
        ));
        $this->validatorSchema['mac'] = new sfValidatorRegex(array(
            'pattern' => '/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/',
            'required' => true,
        ), array(
            'invalid' => 'Please provide a valid MAC address!',
        ));
        $this->validatorSchema['name'] = new sfValidatorString(array(
            'required' => true,
        ), array(
           'required' => 'Please provide a valid computer name!',
        ));

  }
}
