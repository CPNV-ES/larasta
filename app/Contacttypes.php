<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacttypes extends Model
{
    public $timestamps = false;

    const EMAIL = 1;
    const TEL_FIXE = 2;
    const TEL_PORTABLE = 3;
}
