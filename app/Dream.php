<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dream extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dream_date' => 'date',
    ];

    public function get_recording_filename($extension) {
    	return 'dream_'.$this->id.'.'.$extension;
    }
}
