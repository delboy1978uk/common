<?php

namespace Del\Common\Util;

use Exception;
use ReflectionClass;

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
    public function processDependencies(array $packages): array
    {
        foreach ($packages as $package) {
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
        if (!in_array($package, $mergedPackages)) {
            $mergedPackages[] = $package;
            $this->setMergedPackages($mergedPackages);
            $packages = $this->getDependencies($package);
            if (count($packages) > 0) {
                $this->processDependencies($packages);
            }
        }
    }

    /**
     * @param $package
     * @return array
     */
    private function getDependencies(string $package): array
    {
        $srcFolder = 'vendor' . DIRECTORY_SEPARATOR . $package . DIRECTORY_SEPARATOR;
die(var_dump(getcwd(), $srcFolder));
        if (file_exists($srcFolder . '.migrant')) {
            $depend = require($srcFolder . '.migrant');

            if (file_exists('.migrant_local')) {
                $depend = array_merge($depend, require_once '.migrant_local');
            }

            return isset($depend['packages']) ? $depend['packages'] : [];
        }

        try {
            if (class_exists($package)) {
                $mirror = new ReflectionClass($package);
                $location = $mirror->getFileName();

                if (false !== strpos($location, 'vendor') && preg_match('#(?<packagePath>.+)/src/.+\.php#', $location, $match)) {
                    $path = $match['packagePath'] . DIRECTORY_SEPARATOR . '.migrant';

                    if (file_exists($path)) {
                        $depend = require_once $path;

                        return isset($depend['packages']) ? $depend['packages'] : [];
                    }
                }
            }
        } catch (Exception $e) {

        }

        return [];
    }
}