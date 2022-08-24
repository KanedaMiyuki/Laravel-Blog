<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function adminPage(){
        return view('admin.home');
    }

    public function addAdmin(){
        return view('admin.addAdmin',[
            'users' => User::filter(request(['user_search']))->simplePaginate(20)
        ]);
    }

    public function changeUsertype1($user_id){

        $user_detail = $this->user->findOrFail($user_id);
        // dd($user_detail);
        $user_detail->usertype = '1';

        $user_detail->save();
        return redirect()->route('admin.addAdmin')
            ->with('message', 'Usertype Changed As Admin Successfully');
    }

    public function changeUsertype0($user_id){

        $user_detail = $this->user->findOrFail($user_id);
        // dd($user_detail);
        $user_detail->usertype = '0';

        $user_detail->save();
        return redirect()->route('admin.addAdmin')
            ->with('message', 'Usertype Changed As User Successfully');
    }

    public function accountAdministration(){
        return view('admin.accountAdministration',[
            'users' => User::filter(request(['user_search']))->simplePaginate(20)
        ]);
    }

    public function suspended($user_id){

        $user_detail = $this->user->findOrFail($user_id);
        // dd($user_detail);
        $user_detail->ban = '1';

        $user_detail->save();
        return redirect()->route('admin.account')
            ->with('message', 'Account :'. $user_detail->name. ' has been suspended.');
    }

    public function reversed($user_id){

        $user_detail = $this->user->findOrFail($user_id);
        // dd($user_detail);
        $user_detail->ban = '0';

        $user_detail->save();
        return redirect()->route('admin.account')
            ->with('message', 'Account :'. $user_detail->name. ' has been reversed.');
    }
}
