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

    public function processDependencies(array $packages)
    {
        foreach($packages as $package) {
            $this->processPackage($package);
        }
        return $this->getMergedPackages();
    }

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

    private function getDependencies($package)
    {
        $srcFolder = 'vendor'.DIRECTORY_SEPARATOR.$package.DIRECTORY_SEPARATOR;
        if(file_exists($srcFolder.'migrant-cfg.php')) {
            $depend = require($srcFolder.'migrant-cfg.php');
            if (file_exists('migrant-cfg.local.php')) {
                $depend = array_merge($depend, require_once 'migrant-cfg.local.php');
            }
            return isset($depend['packages']) ? $depend['packages'] : [];
        }
        return null;
    }
}