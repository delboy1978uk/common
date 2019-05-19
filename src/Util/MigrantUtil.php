<?php

namespace Del\Common\Util;

/**
 * User: delboy1978uk
 * Date: 15/10/2016
 * Time: 16:18
 */
class MigrantUtil
{
    /**
     * @var array
     */
    private $mergedPackages;

    public function __construct()
    {
        $this->setMergedPackages([]);
    }

    /**
     * @return array
     */
    private function getMergedPackages()
    {
        return $this->mergedPackages;
    }

    /**
     * @param array $mergedPackages
     * @return MigrantUtil
     */
    private function setMergedPackages($mergedPackages)
    {
        $this->mergedPackages = $mergedPackages;
        return $this;
    }

    /**
     * @param array $packages
     * @return array
     */
    public function processDependencies(array $packages)
    {
        foreach($packages as $package) {
            $this->processPackage($package);
        }
        return $this->getMergedPackages();
    }

    /**
     * @param $package
     */
    private function processPackage($package)
    {
        $mergedPackages = $this->getMergedPackages();
        if(!in_array($package, $mergedPackages)) {
            $mergedPackages[] = $package;
            $this->setMergedPackages($mergedPackages);
            $packages = $this->getDependencies($package);
            if(count($packages) > 0) {
                $this->processDependencies($packages);
            }
        }
    }

    /**
     * @param $package
     * @return array
     */
    private function getDependencies($package)
    {
        $srcFolder = 'vendor'.DIRECTORY_SEPARATOR.$package.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR;
        if(file_exists($srcFolder.'../migrant-cfg.php')) {
            $depend = require($srcFolder.'../migrant-cfg.php');
            return isset($depend['packages']) ? $depend['packages'] : [];
        }
        return [];
    }
}