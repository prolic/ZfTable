<?php

namespace ZfTable\Source;

use ZfTable\MongoDbPaginatorAdapter;
use Doctrine\MongoDB\Query\Builder;
use Zend\Paginator\Paginator;

class DoctrineMongoDBQueryBuilder extends AbstractSource
{
    /**
     * @var Builder
     */
    protected $queryBuilder;

    /**
     * @var
     */
    protected $paginator;

    /**
     *
     * @param Builder $query
     */
    public function __construct(Builder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    protected function order()
    {
        $column = $this->getParamAdapter()->getColumn();
        $order = $this->getParamAdapter()->getOrder();

        if (!$column) {
            return;
        }
        $header = $this->getTable()->getHeader($column);

        if (!$header) {
            return;
        }

        if ($header->getTableAlias()) {
            $tableAlias = $header->getTableAlias();
        } else {
            $tableAlias = $header->getName();
        }

        $this->queryBuilder->sort($tableAlias, $order);
    }

    public function getPaginator()
    {
        if (!$this->paginator) {
            $this->order();
            $adapter = new MongoDbPaginatorAdapter($this->queryBuilder->getQuery()->execute()->getMongoCursor());
            $this->paginator = new Paginator($adapter);
            $this->initPaginator();

        }

        return $this->paginator;
    }

    /**
     * @return Builder
     */
    public function getSource()
    {
        return $this->queryBuilder;
    }
}
