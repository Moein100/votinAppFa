<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Http\Response;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;



class DeleteIdea extends Component
{
    public $idea;


    public function mount(Idea $idea)
    {
        $this->idea=$idea;
    }

    public function deleteIdea()
    {
        if (auth()->guest() || auth()->user()->cannot('delete',$this->idea))
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        if ($this->idea->image) 
        {
            Storage::delete($this->idea->image);
        }

        Idea::destroy($this->idea->id);
        
        // Storage::delete($this->idea->image);
        return redirect()->route('idea.index')->with('success_message','ایده شما حذف شد');
    }



    public function render()
    {
        return view('livewire.delete-idea');
    }
}
