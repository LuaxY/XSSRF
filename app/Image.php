<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function exploits()
    {
        return $this->belongsToMany(Exploit::class);
    }

    public function assignExploit($exploit)
    {
        return $this->exploits->save(
            Exploit::whereName($exploit)->firstOrFail();
        );
    }
}
