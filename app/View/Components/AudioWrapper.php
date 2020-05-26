<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AudioWrapper extends Component
{
    /**
     * The dream instance to play if it's a player audio wrapper
     *
     * @var string
     */
    public $dream;

    /**
     * The audio wrapper kind ("player", "recorder" or "recorder-preview")
     *
     * @var string
     */
    public $kind;

    /**
     * Is the player here the listen to the result of a recorder on the same page ?
     *
     * @var string
     */
    public $is_recorder_preview_player = false;

    /**
     * Do we have to start playing automatically ?
     *
     * @var string
     */
    public $autoplay;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($kind, $autoplay = false, $dream = null) {
        if( $kind == 'recorder-preview' ) {
            $this->kind = "player";
            $this->is_recorder_preview_player = true;
        } else {
            $this->kind = $kind;
        }

        $this->autoplay = $autoplay ? "1" : "0";
        $this->dream = $dream;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.audio-wrapper');
    }
}
