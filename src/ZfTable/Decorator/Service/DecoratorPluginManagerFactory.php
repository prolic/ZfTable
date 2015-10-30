<?php

/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License 
 */

namespace ZfTable\Decorator\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config as ConfigServiceMgr;
use ZfTable\Decorator\DecoratorPluginManager;

class DecoratorPluginManagerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config       = $serviceLocator->has('Config') ? $serviceLocator->get('Config') : array();
        $configSevice = new ConfigServiceMgr(isset($config['zftable_decorators']) ? $config['zftable_decorators'] : array());

        $plugins = new DecoratorPluginManager($configSevice);
        $plugins->setServiceLocator($serviceLocator);

        if (isset($config['di']) && $serviceLocator->has('Di')) {
            $plugins->addAbstractFactory($serviceLocator->get('DiAbstractServiceFactory'));
        }

        return $plugins;
    }

}
