<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $perPage=10;

    protected $with=['author','idea','status'];

    public function author()
    {
        return $this->belongsTo(User::class,"user_id");
    }
    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
