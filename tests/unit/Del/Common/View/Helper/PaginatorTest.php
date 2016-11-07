<?php

namespace DelTesting\Common\View\Helper;

use Del\Common\View\Helper\Paginator;

class PaginatorTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Paginator
     */
    protected $helper;

    protected function _before()
    {
        $this->helper = new Paginator();
    }

    protected function _after()
    {
        unset($this->helper);
    }


    public function testPaginator()
    {
        $this->helper->render();
    }

}
