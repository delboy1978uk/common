<?php

namespace DelTesting\Common\View\Helper;

use Del\Common\View\Helper\AlertBox;

class AlertBoxTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var AlertBox
     */
    protected $helper;

    protected function _before()
    {
        $this->helper = new AlertBox();
    }

    protected function _after()
    {
        unset($this->helper);
    }


    public function testAlertBox()
    {
        $html = $this->helper->alertBox(['This test must pass.','warning']);
        $this->assertStringContainsString('alert-warning',$html);
        $this->assertStringContainsString('This test must pass.',$html);
    }


    public function testDefaultAlertBox()
    {
        $html = $this->helper->alertBox(['This test must pass.']);
        $this->assertStringContainsString('alert-info',$html);
    }

}
