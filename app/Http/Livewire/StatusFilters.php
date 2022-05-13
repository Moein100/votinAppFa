<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{

    public $status;
    public $statusCount;

    
   


    public function setStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->emit('queryStringUpdatedStatus',$newStatus);
        
        if( $this->getPreviousRouteName() == 'idea.show')
        {
            return redirect()->route('idea.index',['status'=>$this->status]);
        }
    }


    public function mount()
    {
        $this->status=request()->status ?? 'All';
        $this->statusCount = Status::getCount();
        // dd($this->statusCount);

        //check the model
        // ROW SQL OF CODE ABOVE(line 35):
        // select count(*) as all_statues,
        // count(case when status_id=1 then 1 end) as opne,
        // count(case when status_id=2 then 1 end) as considering,
        // count(case when status_id=3 then 1 end) as in_progress,
        // count(case when status_id=4 then 1 end) as implemented,
        // count(case when status_id=5 then 1 end) as closed
        // from 'ideas'

        if (Route::currentRouteName() == 'idea.show') 
        {
            $this->status = null;
            
        }
    }

    public function render()
    {
        return view('livewire.status-filters');
    }


    private function getPreviousRouteName()
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }
}
