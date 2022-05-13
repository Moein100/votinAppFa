<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditIdea extends Component
{
    public $idea;

    public $title;

    public $category =1;

    public $description;

    protected function rules()
    {

    return   [
            'title' => ['required','min:4'],
            'category' => ['required','integer',Rule::exists('categories','id')],
            'description' => ['required','min:4'],
        ];

    }




    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->title=$idea->title;
        $this->category=$idea->category_id;
        $this->description=$idea->description;
    }


    public function updateIdea()
    {

        if (auth()->guest() || auth()->user()->cannot('update',$this->idea))
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();
        $this->idea->update(
            [
                "title" => $this->title,
                "category_id" => $this->category,
                "description" => $this->description,
            ]);


           $this->emit('IdeaWasUpdated');


    }

    public function render()
    {
        return view('livewire.edit-idea',
        [
            'categories' => Category::all(),
        ]);
    }
}
