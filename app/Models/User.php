<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->belongsToMany(Idea::class,'votes');
    }

    public function votedByThisUser()
    {
        return Vote::where('user_id',$this->id)->pluck('idea_id');
        
    }

    public function getAvatar()
    {
        if ($this->profileimg) 
        {
            return asset('/app/'.$this->profileimg);
        }


        $firstChar= $this->email[0];

        $intToUse= is_numeric($firstChar)
        ? ord(strtolower($firstChar)) - 21
        : ord(strtolower($firstChar)) - 96;

        return 'https://www.gravatar.com/avatar/'
        .md5($this->email)
        .'?s=200'
        .'&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'
        .$intToUse
        .'.png';
    }


    public function isAdmin()
    {
        return in_array($this->email,[
            'moein.kia.20@gmail.com'
        ]);
    }
}
