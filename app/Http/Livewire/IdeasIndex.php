<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;
class IdeasIndex extends Component
{
    use WithPagination,WithAuthRedirects;


    public $status="All";
    public $category;
    public $filter;
    public $search;


    protected $queryString=[
        'status' => ['except' => "All"],
        'category' =>['except' => "All Categories"],
        'filter' => ['except' => "No Filter"],
        'search' => ['except' => ""],
    ];

    protected $listeners=['queryStringUpdatedStatus','resetPage','profileWasUpdated'];


    // A common pattern when filtering a paginated result set is to reset the current page to "1" when filtering is applied.
    // For example, if a user visits page "4" of your data set, then types into a search field to narrow the results, it is usually desireable to reset the page to "1".
    // Livewire's WithPagination trait exposes a ->resetPage() method to accomplish this.
    // This method can be used in combination with the updating/updated lifecycle hooks to reset the page when certain component data is updated.
    //like this:

    // public function updatingStatus()
    // {
    //     $this->resetPage();
    // }

    // but as we use emit and listeners here this is not working because the emite and listeners also gonna change the status so...we gonna put $this->resetPage() in the listener that responsiple for this like this:
    //but we need that kinda method for categories and filter because there is no emit and listeners for them

    public function profileWasUpdated()
    {
        $this->resetPage();
    }


    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    //for "My Ideas" filter we have to check if the user logged in while it is updating, else we gonna redirect the user to login page;

    public function updatedFilter()
    {
        if ($this->filter == "My Ideas" || $this->filter == "My Votes")
        {
            if (auth()->guest())
            {
                // return redirect()->route('login');

                return $this->redirectToLogin();
            }
        }
    }

    



    public function mount()
    {
        $this->status=request()->status ?? 'All';
        $this->category=request()->category ?? 'All Categories';
    }

    public function queryStringUpdatedStatus($newStatus)
    {
        $this->resetPage();
        $this->status=$newStatus;
    }

    public function resetPage()
    {
        $this->reset();
    }




    public function render()
    {
        $statues=
            [
                'All' => 1,
                'good' => 2,
                'great' => 3,
                "warning" => 4,
                "delete" => 5
            ];
        $categories=Category::all();


        return view('livewire.ideas-index',
        [
            'ideas' => Idea::withCount('votes')
            ->when($this->status && $this->status != "All",function($query) use($statues)
            {
                
                
                if (array_key_exists($this->status,$statues)) {
                    return $query->where('status_id',$statues[$this->status]);
                }
                return $query->where('status_id',1);
            })
            ->when($this->category && $this->category != "All Categories",function($query) use($categories)
            {
                return $query->where('category_id',$categories->pluck('id','name')->get($this->category));
            })
            ->when($this->filter && $this->filter == "Top Voted",function($query)
            {
                return $query->orderByDesc('votes_count');
            })
            ->when($this->filter && $this->filter == "My Ideas",function($query)
            {
                return $query->where('user_id',auth()->id());
            })
            ->when($this->filter && $this->filter == "My Votes",function($query)
            {
                if (auth()->user()) {
                    
                    $ideas=[];
                    foreach (auth()->user()->votes as $key => $value) {
                        $ideas[$key]=$value->id;
                    }
                    
                    return $query->whereIn('id',$ideas);
                    
                    // return $query->whereIn('id',auth()->user()->votedByThisUser());
                }
                
                
            })
            ->when($this->filter && $this->filter == "Spam",function($query)
            {
                return $query->where('spam_reports','>',0)->orderByDesc('spam_reports');
            })
            ->when($this->filter && $this->filter == "Spam Comments",function($query)
            {
                    return $query->whereHas('comments', function ($query)
                    {
                        $query->where('spam_reports','>',0);
                    });
            })
            ->when(strlen($this->search) >= 3,function($query)
            {
                return $query->where('title','like',"%".$this->search."%");
            })
            ->withCount('comments')
            ->addSelect(['voted_by_user' => Vote::select('id')->where('user_id',auth()->id())->whereColumn('idea_id','ideas.id')])
            ->orderBy('id','desc')
            ->simplePaginate(10)
            ->withQueryString(),
            'categories' => $categories,
        ]);
    }
}
