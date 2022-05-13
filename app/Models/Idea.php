<?php

namespace App\Models;

// use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    // use HasFactory , Sluggable;
    use HasFactory ;

    protected $guarded =['id'];

//    protected $with=['user','category','status','votes','comments'];
    protected $with=['user','category','status','votes'];

        /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderByDesc('created_at');
    }

    public function votes()
    {
        return $this->belongsToMany(User::class,'votes');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }


    public function isVotedByUser(?User $user)
    {
        if (!$user) {
            return null;
        }

        return Vote::where('user_id',$user->id)->where('idea_id',$this->id)->exists();


    }


    

    public function vote(User $user)
    {
        Vote::create([
            'idea_id' => $this->id,
            'user_id' => $user->id,
        ]);
    }

    public function removeVote(User $user)
    {
        Vote::where('idea_id', $this->id)->where('user_id', $user->id)->first()->delete();
    }

    // public function getStatusClasses()
    // {
    //     $allStatuses=
    //     [
    //         'Open' => 'bg-gray-200',
    //         'Considering' => 'bg-purple-500 text-white',
    //         'In Progress' =>'bg-yellow-500 text-white',
    //         'Implemented' =>'bg-green-500 text-white',
    //         'Closed' =>'bg-red-500 text-white',

    //     ];

    //     return $allStatuses[$this->status->name];

    //     // if ($this->status->name == "Open")
    //     // {
    //     //     return 'bg-gray-200';
    //     // }elseif($this->status->name == "Considering")
    //     // {
    //     //     return 'bg-purple-500 text-white';
    //     // }elseif($this->status->name == "In Progress")
    //     // {
    //     //     return 'bg-yellow-500 text-white';
    //     // }elseif($this->status->name == "Implemented")
    //     // {
    //     //     return 'bg-green-500 text-white';
    //     // }elseif($this->status->name == "Closed")
    //     // {
    //     //     return 'bg-red-500 text-white';
    //     // }

    //     // return 'bg-gray-200';
    // }
}
