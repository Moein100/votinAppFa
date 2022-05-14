<?php

namespace App\Http\Controllers;

use App\Models\AbouteUs;
use Illuminate\Http\Request;

class AbouteUsAdminController extends Controller
{
    public function index()
    {
        return view('admin.abouteUs',[
            'body' => AbouteUs::find(1)->body,
            'links' => AbouteUs::find(1)->links,
        ]);
    }

    public function update(Request $request,AbouteUs $AbouteUs)
    {
        
        $validated = $request->validate([
            'body' => 'required|min:10',
            'link' => 'nullable',
        ]);
        $AbouteUs->body=$validated['body'];
        $AbouteUs->links=$validated['link'];
        $AbouteUs->save();

        return redirect('/');
    }
}
