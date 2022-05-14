<?php

namespace App\Http\Controllers;

use App\Models\AbouteUs;
use App\Http\Requests\StoreAbouteUsRequest;
use App\Http\Requests\UpdateAbouteUsRequest;

class AbouteUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AbouteUs.aboute',
        [
            'body' => AbouteUs::find(1)->body,
            'links' =>AbouteUs::find(1)->links
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAbouteUsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbouteUsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbouteUs  $abouteUs
     * @return \Illuminate\Http\Response
     */
    public function show(AbouteUs $abouteUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbouteUs  $abouteUs
     * @return \Illuminate\Http\Response
     */
    public function edit(AbouteUs $abouteUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAbouteUsRequest  $request
     * @param  \App\Models\AbouteUs  $abouteUs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbouteUsRequest $request, AbouteUs $abouteUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbouteUs  $abouteUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbouteUs $abouteUs)
    {
        //
    }
}
