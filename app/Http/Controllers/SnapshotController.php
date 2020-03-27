<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Snapshot;
use Illuminate\Support\Facades\Storage;

class SnapshotController extends Controller
{
    public function showSnapshot()
    {
        $filesName = Snapshot::listSnapshots("../storage/app/snapshots", "sql");
        return view('admin/snapchot', compact('filesName'));
    }

    public function upload(Request $request)
    {
        if(!isset($request->newsnapshotfile))
                abort(500,"Please upload SQL file");

        $file = $request->newsnapshotfile;
        $fileName=$request->newsnapshotfile->getClientOriginalName();
        $extension = pathinfo($fileName, PATHINFO_EXTENSION );

        if($extension!="sql")
            abort(500,"Please upload SQL file");

        $file->storeAs("snapshots", Snapshot::generateName());
        return back()->withInput();
    }

    public function reload(Request $request)
    {
        if(!isset($request->snapshot))
            abort(500,"Please select a snapshot");

        $MYSQL_LOAD = "mysql --user=".env('DB_USERNAME')." --host=".env('DB_HOST')." --password=".env('DB_PASSWORD')." ".env('DB_DATABASE');
        $snapshotPath = str_replace("\\", "/", $request->snapshot);
        $cmd = "$MYSQL_LOAD < $snapshotPath";

        exec($cmd);
        return back()->withInput();
    }

    public function takeDbSnapshot()
    {
        $MYSQL_DUMP = "mysqldump --user=".env('DB_USERNAME')." --host=".env('DB_HOST')." --password=".env('DB_PASSWORD')." ".env('DB_DATABASE');
        // Take the snapshot
        $dumpname = Snapshot::generateName();
        exec("$MYSQL_DUMP > ../storage/app/snapshots/$dumpname");


        // Remove unwanted "definer" statements from file: they cause importation errors on the intranet
        $f_in = fopen("../storage/app/snapshots/$dumpname", "r");
        $f_out = fopen("../storage/app/snapshots/temp.sql", "w");
        if ($f_in)
        {
            while (($line = fgets($f_in)) !== false)
            {
                $p = strpos($line, "DEFINER");
                if ($p > 0)
                {
                    $s = strrpos(substr($line, 0, $p), "/*");
                    $e = strpos($line, "*/", $p);
                    $line = substr($line, 0, $s) . substr($line, $e + 3);
                }
                fwrite($f_out, $line);
            }
            fclose($f_in);
            fclose($f_out);
            unlink("../storage/app/snapshots/$dumpname");
            rename("../storage/app/snapshots/temp.sql", "../storage/app/snapshots/$dumpname");
        }

        return back()->withInput();
    }


}
