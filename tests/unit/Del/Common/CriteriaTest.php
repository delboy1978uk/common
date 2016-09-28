<?php

namespace DelTesting\Common;

use Del\Common\Criteria;

class ConcreteCriteria extends Criteria{}

class CriteriaTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Criteria
     */
    protected $criteria;

    protected function _before()
    {
        $this->criteria = new ConcreteCriteria();
    }

    protected function _after()
    {
        unset($this->criteria);
    }


    public function testGetSetHasOffset()
    {
        $this->criteria->setOffset(5);
        $this->assertTrue($this->criteria->hasOffset());
        $this->assertEquals(5,$this->criteria->getOffset());
    }


    public function testGetSetHasLimit()
    {
        $this->criteria->setLimit(5);
        $this->assertTrue($this->criteria->hasLimit());
        $this->assertEquals(5,$this->criteria->getLimit());
    }


    public function testGetSetHasOrder()
    {
        $this->criteria->setOrder('likes');
        $this->assertTrue($this->criteria->hasOrder());
        $this->assertEquals('likes',$this->criteria->getOrder());
    }


    public function testGetSetHasOrderDirection()
    {
        $this->criteria->setOrderDirection('DESC');
        $this->assertTrue($this->criteria->hasOrderDirection());
        $this->assertEquals('DESC',$this->criteria->getOrderDirection());
    }


    public function testSetPagination()
    {
        $this->criteria->setPagination(5,10);
        $this->assertTrue($this->criteria->hasOffset());
        $this->assertTrue($this->criteria->hasLimit());
        $this->assertEquals(40,$this->criteria->getOffset());
        $this->assertEquals(10,$this->criteria->getLimit());
    }

}
