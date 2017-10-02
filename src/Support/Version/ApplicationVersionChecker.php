<?php

namespace FilePile\FilePileIntegration\Support\Version;

class ApplicationVersionChecker
{

    public static function get()
    {
        $composerLockJSON = static::getComposerLockJSON();
        if(!$composerLockJSON){
            return null;
        }
        $package = static::getPackageFromComposerLockJSON($composerLockJSON,'filepile/filepile-integration-laravel');
        if(!$package){
            return null;
        }
        $output = $package->version.' ['.$package->source->reference.']';
        return $output;
    }

    private static function getComposerLockJSON(){
        $filePath = base_path('composer.lock');
        if(file_exists($filePath)){
            $content = file_get_contents($filePath);
            if(!empty($content)){
                return json_decode($content);
            }
        }
        return null;
    }

    private static function getPackageFromComposerLockJSON($composerLockJSON, $packageName){
        foreach($composerLockJSON->packages as $package){
            if($package->name == $packageName){
                return $package;
            }
        }
        return null;
    }

}