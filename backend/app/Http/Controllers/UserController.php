<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;
    private $inquiry;
    public function __construct(User $user, Inquiry $inquiry){
        $this->user = $user;
        $this->inquiry = $inquiry;
    }
    
    public function show(){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
            $user_detail = $this->user->findOrFail(Auth::user()->id);

            return view('user.profile', ['inquiries' => auth()->user()->inquiries()->get()])
                ->with('user_detail', $user_detail);
        }
    }

    public function edit(){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
            $user_detail = $this->user->findOrFail(Auth::user()->id);

            return view('user.edit')
                ->with('user_detail', $user_detail);
        }
    }

    public function update(Request $request){
        
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,'. Auth::user()->id,
        ]);

        $user_detail = $this->user->findOrFail(Auth::user()->id);
        $user_detail->name = $request->name;
        $user_detail->email = $request->email;

        $user_detail->save();
        return redirect()->route('user.show')
            ->with('message', 'Profile Updated Successfully');
    }

    public function inquiry(){
        return view('user.inquiry');
    }
}
