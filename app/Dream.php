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


    /* Static Eloquent getters */
    static public function get_one_random() {
        return self::all()->random(1)[0];
    }

    /* Instances helpers */
    public function get_recording_filename($extension) {
    	return 'dream_'.$this->id.'.'.$extension;
    }

    public function get_recording_file_url($extension) {
        $filename = $this->get_recording_filename($extension);

        return '/storage/' . $filename;
    }
}
