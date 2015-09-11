<?php

namespace ZfTable;

use MongoCursor;
use Zend\Paginator\Adapter\AdapterInterface;

/**
 * Class MongoDbPaginatorAdapter
 * @package ZfTable
 */
final class MongoDbPaginatorAdapter implements AdapterInterface
{
    /**
     * @var MongoCursor
     */
    private $cursor;

    /**
     * @param MongoCursor $cursor
     */
    public function __construct(MongoCursor $cursor)
    {
        $this->cursor = $cursor;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->cursor->count();
    }

    /**
     * @param int $offset
     * @param int $itemCountPerPage
     * @return MongoCursor
     */
    public function getItems($offset, $itemCountPerPage)
    {
        $this->cursor->skip($offset);
        $this->cursor->limit($itemCountPerPage);
        return $this->cursor;
    }
}
