<?php

namespace FilePile\FilePileIntegration\Support\Version;

class ApplicationVersionChecker
{

    public static function get()
    {
        $tag = static::getGitTag();
        $commitHash = static::getGitCommitHash();
        $commitDate = static::getGitCommitDate();
        $output = $tag.' ['.$commitHash.'] ('.$commitDate->format('Y-m-d H:m:s').')';
        return $output;
    }

    private static function getGitTag(){
        return trim(exec('git describe --tags --abbrev=0'));
    }

    private static function getGitCommitHash(){
        return trim(exec('git log --pretty="%h" -n1 HEAD'));
    }

    private static function getGitCommitDate(){
        $commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        return $commitDate->setTimezone(new \DateTimeZone('UTC'));
    }

}