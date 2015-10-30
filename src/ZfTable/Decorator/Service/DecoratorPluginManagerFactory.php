<?php

/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License 
 */

namespace ZfTable\Decorator\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\Config as ConfigServiceMgr;

class DecoratorPluginManagerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configuration   = $serviceLocator->has('Config') ? $serviceLocator->get('Config') : array();
        $configSeviceMgr = new ConfigServiceMgr(isset($configuration['zftable_decorators'])? : array());

        $plugins = new ZfTable\Decorator\DecoratorPluginManager($configSeviceMgr);
        $plugins->setServiceLocator($serviceLocator);

        $configuration = $serviceLocator->get('Config');
        if (isset($configuration['di']) && $serviceLocator->has('Di')) {
            $plugins->addAbstractFactory($serviceLocator->get('DiAbstractServiceFactory'));
        }

        return $plugins;
    }

}
