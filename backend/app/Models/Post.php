<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'tags'];

    //Relationship To User
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    //Relationship with Comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters){
        //tags
        if($filters['tag'] ?? false){
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        //searchbar
        if($filters['search'] ?? false){
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }

        
    }
}
