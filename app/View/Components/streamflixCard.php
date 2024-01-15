<?php

namespace App\View\Components;

use Illuminate\View\Component;

class streamflixCard extends Component
{
    /** @var mixed */
    public $streamflix;

    /**
     * @param  mixed  $movie
     * @return void
     */
    public function __construct($movie)
    {
        $this->streamflix = $movie;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.streamflix-card');
    }
}
