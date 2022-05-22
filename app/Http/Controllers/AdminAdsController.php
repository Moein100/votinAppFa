<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;

class AdminAdsController extends Controller
{
    //

    public function index()
    {

        $image=Ads::latest()->first()?->image;
        $url=Ads::latest()->first()?->url;
        
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
            'url' => 'required',
        ]);

        //before
    //     // dd(request()->file('image'));
    //    if(request()->file('image'))
    //    {
        
    //     $previousImage=Ads::find(1)->image;
    
    //    if(file_exists(public_path('/app/'.$previousImage)))
    //    {
    //         unlink(public_path('/app/'.$previousImage));
    //    }
    //    $validated['image']=request()->file('image')->storeAs('ads','adsimage.'.explode("/",request()->file('image')->getMimeType())[1]);
    //    }
    //    else
    //    {
    //     $validated['image']=$validated['url_image'];
    //    }
       
    //    $ads=Ads::find(1);
    //    $ads->image=$validated['image'];
    //    $ads->url=$validated['url'];
    //    $ads->save();
    //    return redirect('/');



    //after


    $previousAd=Ads::latest()->first();
    $previousAd?->delete();

    if(request()->file('image'))
       {
        
    //     $previousImage=Ads::find($previousAd->id)->image;
    
    //    if(file_exists(public_path('/app/'.$previousImage)))
    //    {
    //         unlink(public_path('/app/'.$previousImage));
    //    }
       $validated['image']=request()->file('image')->storeAs('ads','adsimage.'.explode("/",request()->file('image')->getMimeType())[1]);
       }
       else
       {
        $validated['image']=$validated['url_image'];
       }
       
       Ads::create($validated);
       return redirect('/');

    }


    public function destroy()
    {
    //     $targetAd=Ads::find(1);
    
    //    if(file_exists(public_path('/app/'.$targetAd->image)))
    //    {
    //         unlink(public_path('/app/'.$targetAd->image));
    //    }
        
    //    $targetAd->image=null;
    //    $targetAd->url=null;
    //    $targetAd->save();
    //    return redirect('/');

        $targetAd=Ads::latest()->first();
        if(file_exists(public_path('/app/'.$targetAd->image)))
        {
            unlink(public_path('/app/'.$targetAd->image));
        }
        $targetAd->delete();
           return redirect('/');
    }
}
