<?php
namespace ZfTable\Source;

use Doctrine\ODM\MongoDB\Query\Builder;
use Zend\Paginator\Paginator;
use DoctrineMongoODMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;

class DoctrineODMMongoDBQueryBuilder extends AbstractSource
{
    /**
     *
     * @var Builder
     */
    protected $query;

    /**
     *
     * @var  \Zend\Paginator\Paginator
     */
    protected $paginator;

    /**
     *
     * @param Builder $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     *
     * @return \Zend\Paginator\Paginator
     */
    public function getPaginator()
    {
        if (!$this->paginator) {


            $this->order();

             $adapter = new DoctrineAdapter($this->getQuery()->getQuery()->execute());
             $this->paginator = new Paginator($adapter);
             $this->initPaginator();

        }
        return $this->paginator;
    }



    protected function order()
    {
        $column = $this->getParamAdapter()->getColumn();
        $order = $this->getParamAdapter()->getOrder();

        if (!$column) {
            return;
        }

        $header = $this->getTable()->getHeader($column);
        $tableAlias = ($header) ? $header->getTableAlias() : 'q';

        if (false === strpos($tableAlias, '.')) {
            $tableAlias = $tableAlias.'.'.$column;
        }

        $this->query->sort($tableAlias, $order);
    }


    public function getQuery()
    {
        return $this->query;
    }

    public function getSource()
    {
        return $this->query;
    }
}
