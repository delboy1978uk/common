<?php

namespace Del\Common;


class Criteria
{
    protected $limit;
    protected $offset;
    protected $order;

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
    public function setOrder($code)
    {
        $this->order = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }
}