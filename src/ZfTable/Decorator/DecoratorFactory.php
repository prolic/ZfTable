<?php
/**
 * ZfTable ( Module for Zend Framework 2)
 *
 * @copyright Copyright (c) 2013 Piotr Duda dudapiotrek@gmail.com
 * @license   MIT License 
 */

namespace ZfTable\Decorator;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DecoratorFactory implements ServiceLocatorAwareInterface
{
    CONST CELL_PREFIX = 'cell';
    CONST HEADER_PREFIX = 'header';
    CONST ROW_PREFIX = 'row';  
    
    /**
     * The decorator manger
     *
     * @var null|DecoratorPluginManager
     */
    protected $decoratorManager = null;
    
    /**
     * @var ServiceLocatorInterface 
     */
    protected $serviceLocator;
    
    /**
     * 
     * @param string $name
     * @param array $options
     * @return AbstractDecorator
     */
    public function factoryCell($name, $options)
    {
        $decorator = $this->getPluginManager()->get(self::CELL_PREFIX . $name, $options);
        return $decorator;
    }

    /**
     * 
     * @param string $name
     * @param array $options
     * @return AbstractDecorator
     */
    public function factoryRow($name, $options)
    {
        $decorator = $this->getPluginManager()->get(self::ROW_PREFIX . $name, $options);
        return $decorator;
    }

    /**
     * 
     * @param string $name
     * @param array $options
     * @return AbstractDecorator
     */
    public function factoryHeader($name, $options)
    {
        $decorator = $this->getPluginManager()->get(self::HEADER_PREFIX . $name, $options);
        return $decorator;
    }

    /**
     * Get the pattern plugin manager
     *  
     * @return DecoratorPluginManager
     */
    public function getPluginManager()
    {
        if ($this->decoratorManager === null) {
            if($this->getServiceLocator() && $this->getServiceLocator()->has('ZfTable\Decorator\DecoratorPluginManager')) {
                $this->decoratorManager = $this->getServiceLocator()->get('ZfTable\Decorator\DecoratorPluginManager');
            }
            else {
                $this->decoratorManager = new DecoratorPluginManager();
            }
        }
        return $this->decoratorManager;
    }

    public function setPluginManager(DecoratorPluginManager $decoratorManager)
    {
        $this->decoratorManager = $decoratorManager;
    }
    
    /**
     * @return ServiceLocatorInterface 
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
