<?php
namespace Del\Common;

use Pimple\Container as PimpleContainer;

class Container
{
    public static $definitionsPath = __DIR__;
    public static $definitionFileName = 'definitions.php';

    /**
     * @return PimpleContainer
     */
    public static function getContainer()
    {
        $path = self::$definitionsPath . DIRECTORY_SEPARATOR . self::$definitionFileName;
        return include $path;
    }

    /**
     * @param $path
     * @return PimpleContainer
     */
    public function addDefinitions($key, $value)
    {
        $c = Container::getContainer();
        $c[$key] = $value;
        return $c;
    }
}
