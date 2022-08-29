<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment){
        $this->comment = $comment;
    }

    public function store(Request $request){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
            $request->validate([
                'comment' => 'required|min:1|max:280'
            ]);
            $this->comment->user_id = Auth::user()->id;
            $this->comment->name = $request->name;
            $this->comment->comment = $request->comment;
            $this->comment->post_id = $request->post_id;

            $this->comment->save();

            return redirect()
                ->back()
                ->with('message', 'Comment Added Successfully');
        }
    }

    public function destroy($comment_id){
        $comment = $this->comment->findOrFail($comment_id);
        $comment->delete($comment_id);
        return redirect()->route('posts.show', $comment->post_id)
            ->with('message', 'Comment Deleted Successfully');
    }
}
