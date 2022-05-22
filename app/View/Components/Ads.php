<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Ads as AdsModel;


class Ads extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $imageAds=AdsModel::latest()->first()?->image;
        $urlAds=AdsModel::latest()->first()?->url;
        return view('components.ads',[
            'imageAds' => $imageAds,
            'urlAds' => $urlAds
        ]);
    }
}
