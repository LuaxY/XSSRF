<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public static $rules = [
        'upload' => [
            'files.*' => 'required|image'
        ]
    ];

    public function exploits()
    {
        return $this->belongsToMany(Exploit::class);
    }

    public function assignExploit($exploit)
    {
        return $this->exploits->save(
            Exploit::whereName($exploit)->firstOrFail()
        );
    }

    public function serialize()
    {
        $result = new \stdClass;
        $result->name = $this->realname;
        $result->url  = $this->filename;
        $result->size = $this->size;
        return $result;
    }
}
