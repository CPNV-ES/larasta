<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DirectoryIterator;


class Snapshot extends Model
{
    static function listSnapshots($pathDirectory, $fileExtension = "*")
    {
        if(!is_dir($pathDirectory)) return [];

        if($fileExtension[0] == ".") $fileExtension = substr($fileExtension, 1);

        $files = [];

        foreach (new DirectoryIterator($pathDirectory) as $file) {
            if($file->isDot()) continue;
            if($file->isFile()){
                if($file->getExtension() == $fileExtension){
                    array_push($files, $file->getPathName());
                }
            }
        }
        return $files;
    }

    static function generateName()
    {
        return "snapshot_" . Date("YmdHis") . ".sql";
    }

    static function timeFromSnapshot($snapshotName){
        $nameFile = explode("_", $snapshotName)[1];
        $nameFile = explode(".", $nameFile)[0];

        return Carbon::parse($nameFile);;
    }
}
