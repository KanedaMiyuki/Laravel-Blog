<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'title', 'details', 'status', 'responder'];

    //Relationship To User
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters){

        //searchbar for Inquiry
        if($filters['inquiry_search'] ?? false){
            $query->where('name', 'like', '%' . request('inquiry_search') . '%')
                ->orWhere('id', 'like', '%' . request('inquiry_search') . '%')
                ->orWhere('email', 'like', '%' . request('inquiry_search') . '%')
                ->orWhere('title', 'like', '%' . request('inquiry_search') . '%')
                ->orWhere('details', 'like', '%' . request('inquiry_search') . '%');
        }
    }

}
