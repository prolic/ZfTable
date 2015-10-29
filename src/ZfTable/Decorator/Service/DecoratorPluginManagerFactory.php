<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License 
 */

namespace ZfTable\Decorator\Service;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

class DecoratorPluginManagerFactory  extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = 'ZfTable\Decorator\DecoratorPluginManager';
}
