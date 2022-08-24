<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    private $inquiry;
    
    public function __construct(Inquiry $inquiry){
        $this->inquiry = $inquiry;
    }
    
    public function inquiry(){
        return view('user.inquiry');
    }

    // STORE Inquiry FROM DATA
    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,'. Auth::user()->id,
            'title' => 'required',
            'details' => 'required|min:1|max:280'
        ]);

        
        $this->inquiry->user_id = Auth::user()->id;
        $this->inquiry->name = $request->name;
        $this->inquiry->email = $request->email;
        $this->inquiry->title = $request->title;
        $this->inquiry->details = $request->details;

        $this->inquiry->save();

        return back()
            ->with('message', 'Inquiry Has Been Sent Successfully');
    }

    public function index(){
        return view('admin.checkInquiries',[
            'inquiries' => Inquiry::latest()->filter(request(['inquiry_search']))->Paginate(10)
        ]);
    }

    // SHOW SINGLE Inquiry
    public function show(Inquiry $inquiry){

        return view('admin.showInquiry',[
            'inquiry' => $inquiry
        ]);
    }

    public function respondInquiry(Inquiry $inquiry){

        return view('admin.respondInquiry', ['inquiry' => $inquiry]);
    }

    public function updateInquiry(Request $request, $inquiry_id){
        $request->validate([
            'details' => 'required|min:1|max:1080'
        ]);
        $inquiry = $this->inquiry->findOrFail($inquiry_id);
        $inquiry->details = $request->details;
        $inquiry->status = '1';
        $inquiry->responder = Auth::user()->name;

        $inquiry->save();

        return redirect()
            ->route('admin.index')
            ->with('message', 'Response Has Been Sent Successfully');        
    }
}
