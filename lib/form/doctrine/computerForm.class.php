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
        $ipRegex = computer::IP_REGEX;
        $this->validatorSchema['ip'] = new sfValidatorRegex(array(
            'pattern' => "/^{$ipRegex}$/",
            'required' => true,
        ), array(
            'invalid' => 'Please provide a valid IP address!',
        ));
        $macRegex = computer::MAC_REGEX;
        $this->validatorSchema['mac'] = new sfValidatorRegex(array(
            'pattern' => "/^{$macRegex}$/",
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
