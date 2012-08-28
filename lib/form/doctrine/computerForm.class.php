<?php

/**
 * computer form.
 *
 * @package    wakeup
 * @subpackage form
 * @author     Alexandru Bumbacea
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class computerForm extends BasecomputerForm
{
  public function configure()
  {
  		unset($this['created_at'],$this['updated_at']);
  }
}
