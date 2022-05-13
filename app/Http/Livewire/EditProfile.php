<?php

namespace App\Http\Livewire;

use Illuminate\Http\Response;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{

    use WithFileUploads;
    public $name;
    public $avatar;

    protected $listeners = ['editProfileWasClosed'];

    protected function rules()
    {

    return   [
            'name' => ['min:3'],
            'avatar' => ['nullable','image','mimes:jpg,png,jpeg,gif','max:3072'],
           
            ];

    }


    public function updatedAvatar()

    {

        $this->validate([

            'avatar' => ['nullable','image','mimes:jpg,png,jpeg,gif','max:3072'],

        ]);

    }


    public function mount()
    {
        $this->name=auth()->user()->name;
    }


    public function editProfileWasClosed()
    {
        $this->avatar=null;
    }


    public function updateProfile()
    {
        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }
        
        $img=$this->avatar ? $this->avatar->store('profile') : null;

        $this->validate();
        auth()->user()->name=$this->name;
        
        if ($img) 
        {
            auth()->user()->profileimg=$img;
        }
        auth()->user()->save();


           $this->emit('profileWasUpdated');
           $this->avatar = null;
    }

    public function deleteProfileImage()
    {
        $this->avatar = null;
        $this->reset();
    }



    public function deleteImgPhoto()
    {
        if (auth()->guest())
        {
            abort(Response::HTTP_FORBIDDEN);
        }
        if (auth()->user()->profileimg) {
            
            auth()->user()->profileimg=null;
            auth()->user()->save();
            $this->avatar = null;
            
            
        }

        $this->emit('profileWasUpdated');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
