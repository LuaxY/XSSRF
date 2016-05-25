<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faker extends Model
{
    public static $rules = [
        'name'        => 'required',
        'description' => 'required',
        'filename'    => 'required',
        'html'        => 'required|regex:(%EXPLOIT%)',
    ];
}
