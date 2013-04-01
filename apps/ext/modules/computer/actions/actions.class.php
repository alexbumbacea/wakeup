<?php

/**
 * computer actions.
 *
 * @package    wakeup
 * @subpackage computer
 * @author     Alexandru Bumbacea
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class computerActions extends extActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $computers = Doctrine_Core::getTable('computer')
            ->createQuery('a')
            ->execute();
        return $computers->toArray();
    }
}
