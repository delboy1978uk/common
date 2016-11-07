<?php

namespace Del\Common\Criteria;


abstract class AbstractCriteria
{
    const ORDER_ASC = 'ASC';
    const ORDER_DESC = 'DESC';

    protected $limit;
    protected $offset;
    protected $order;
    protected $orderDirection;

    /**
     * @return bool
     */
    public function hasOffset()
    {
        return $this->offset !== null;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setOffset($code)
    {
        $this->offset = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return bool
     */
    public function hasLimit()
    {
        return $this->limit !== null;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setLimit($code)
    {
        $this->limit = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return bool
     */
    public function hasOrder()
    {
        return $this->order !== null;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getOrderDirection()
    {
        return $this->orderDirection;
    }

    /**
     * @param mixed $orderDirection
     * @return Criteria
     */
    public function setOrderDirection($orderDirection)
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasOrderDirection()
    {
        return $this->orderDirection !== null;
    }

    /**
     * @param $page
     * @param $limit
     */
    public function setPagination($page, $limit)
    {
        $offset = ($limit * $page) - $limit;
        $this->setLimit($limit);
        $this->setOffset($offset);
    }
}