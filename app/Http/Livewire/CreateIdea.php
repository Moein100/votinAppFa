<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateIdea extends Component
{
    use WithFileUploads,WithAuthRedirects;
    public $title;

    public $category =1;

    public $description;

    public $photo;

    protected function rules()
    {

    return   [
            'title' => ['required','min:4'],
            'category' => ['required','integer',Rule::exists('categories','id')],
            'description' => ['required','min:4'],
            'photo' => ['nullable','image','mimes:jpg,png,jpeg,gif','max:3072'],
            // 'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1024'
        ];

    }


    public function updatedPhoto()

    {

        $this->validate([

            'photo' => ['nullable','image','mimes:jpg,png,jpeg,gif','max:3072'],

        ]);

    }

    public function deletePhotoImage()
    {
        $this->photo = null;
        // $this->reset();
    }

    public function createIdea()
    {
        if (auth()->guest())
        {
            return redirect()->route('idea.index');
        }

        if (!auth()->user()->hasVerifiedEmail()) 
        {
            return redirect('verify-email');
        }

            $this->validate();
        
            $postImages=$this->photo ? $this->photo->store('photos') : null;

            $idea=  Idea::create(
                [
                    'user_id' => auth()->id(),
                    'category_id' => $this->category,
                    'status_id' => 1,
                    'title' => $this->title,
                    'image' => $postImages,
                    'description' => $this->description,
                    'slug' => str_replace(" ","-",$this->title),
                ]);



            // Vote::create(
            // [
            //     'idea_id' => $idea->id,
            //     'user_id' =>auth()->id(),
            // ]);


            $idea->vote(auth()->user());


            if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == "idea.index")
            {



                $this->emit('resetPage');

                $this->reset();
                $this->emit('ideaWasCreated');
            }else
            {
                 redirect('/')->with('success_message','ایده شما به اشتراک گذاشته شد');
            }





    }


    public function render()
    {
        return view('livewire.create-idea',
        [
            'categories' => Category::all(),
        ]);
    }
}
