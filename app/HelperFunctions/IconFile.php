<?php

    use Illuminate\Support\Arr;
    function getFileIcon($mimetype)
    {

        $mappings = 
        [
            "/image\//" => "img.png",
            "/application\/zip/" => "zip.png",
            "/application\/pdf/" => "pdf.png",
            "/.*/" => "default.png"
        ];

        return "/images/".Arr::first($mappings, function($value,$key) use($mimetype) {
            if (preg_match($key, $mimetype)) return true;
        });
    }
