<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

/**
 * @psalm-suppress UndefinedClass
 */
class SearchStreamflix extends Component
{
    public ?string $searchStreamflix = '';

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $searchStreamflixResults = [];

        // @phpstan-ignore-next-line
        if (strlen($this->searchStreamflix >= 3)) {
            $searchStreamflixResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie?query='.$this->searchStreamflix)
                ->json()['results'];
        }

        // dump($searchStreamflixResults);

        return view('livewire.search-streamflix', [
            // @phpstan-ignore-next-line
            'searchStreamflixResults' => collect($searchStreamflixResults)->take(7),
        ]);
    }
}
