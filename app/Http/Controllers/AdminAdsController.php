<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;

class AdminAdsController extends Controller
{
    //

    public function index()
    {

        $image=Ads::find(1)->image;
        $url=Ads::find(1)->url;
        
        return view('admin.ads',
            ['image' => $image,
             'url' => $url
            ]
        );
        // return view('admin.ads',
        //     ['image' => $image,
        //      'url' => null
        //     ]
        // );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required_without:url_image'],
            'url_image' => ['required_without:image'],
            'link' => 'required',
        ]);
        dd($validated);
    }
}
