<?php

namespace DelTesting\Common;

use Del\Common\Util\MigrantUtil;

class MigrantUtilTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var MigrantUtil
     */
    protected $util;

    /** @var string $originalWorkingDir */
    private $originalWorkingDir;

    protected function _before()
    {
        $this->originalWorkingDir = getcwd();
        $newDir = realpath(
            $this->originalWorkingDir.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'_data'.DIRECTORY_SEPARATOR.'migrantUtil'
        );
        die(var_dump($this->originalWorkingDir, $newDir));
        $this->util = new MigrantUtil();
        chdir($newDir);
    }

    protected function _after()
    {
        unset($this->util);
        chdir($this->originalWorkingDir);
    }


    public function testProcessDependencies()
    {
        $packageList = $this->util->processDependencies([
            'delboy1978uk/user',
            'delboy1978uk/address',
        ]);
        $this->assertTrue(is_array($packageList));
        $this->assertContains('delboy1978uk/user', $packageList);
        $this->assertContains('delboy1978uk/address', $packageList);
        $this->assertContains('delboy1978uk/person', $packageList);
    }


    public function testEmptyDependency()
    {
        $packageList = $this->util->processDependencies(['delboy1978uk/broken']);
        $this->assertTrue(is_array($packageList));
//        $this->assertContains('delboy1978uk/user', $packageList);
    }
}
