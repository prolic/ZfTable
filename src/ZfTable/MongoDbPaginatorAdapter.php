<?php

namespace ZfTable;

use Doctrine\MongoDB\Cursor;
use Zend\Paginator\Adapter\AdapterInterface;

/**
 * Class MongoDbPaginatorAdapter
 * @package ZfTable
 */
final class MongoDbPaginatorAdapter implements AdapterInterface
{
    /**
     * @var Cursor
     */
    private $cursor;

    /**
     * @param Cursor $cursor
     */
    public function __construct(Cursor $cursor)
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
     * @return Cursor
     */
    public function getItems($offset, $itemCountPerPage)
    {
        $this->cursor->skip($offset);
        $this->cursor->limit($itemCountPerPage);
        return $this->cursor;
    }
}
