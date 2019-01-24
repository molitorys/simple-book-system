<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'added_at',
        'title'
    ];

    protected $dates = [
        'added_at'
    ];

    public $timestamps = false;

    /**
     * Book belongs to reader
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reader()
    {
        return $this->belongsTo(\App\Models\Reader::class);
    }
}
