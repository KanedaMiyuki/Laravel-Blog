<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    private $post;
    private $user;
    private $comment;

    public function __construct(Post $post, User $user, Comment $comment){
        $this->post = $post;
        $this->user = $user;
        $this->comment = $comment;
    }

    public function index()
    {
            return view('user.home',[
                'posts' => Post::latest()->filter(request(['tag', 'search']))->simplePaginate(6)
        ]);
    }

    public function create(){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
            return view('posts.create');
        }
    }

    // SHOW SINGLE Post
    public function show($post_id){
        $post = $this->post->findOrFail($post_id);
        $comments = $this->post->latest()->findOrFail($post_id)->comments;
        $user = $this->user->findOrFail($post->user_id);
        // $commentUsers = $this->comment->latest()->findOrFail($post_id)->user;

        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
            return view('posts.show')
            ->with('post', $post)
            ->with('user', $user)
            ->with('comments', $comments);
            // ->with('commentUsers', $commentUsers);
        }
    }

    // STORE FROM DATA
    public function store(Request $request){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
        
            $request->validate([
                'title' => 'required|min:1|max:50',
                'body' => 'required|min:1|max:280',
                'tags' => 'required',
                'image' => 'mimes:jpg,png,jpeg,gif|max:1048'
            ]);
            $this->post->user_id = Auth::user()->id;
            $this->post->title = $request->title;
            $this->post->body = $request->body;
            $this->post->tags = $request->tags;

            if($request->image){
                $this->post->image = $this->saveImage($request);
            }  else{
                $this->post->image = null;
            }

            $this->post->save();

            return redirect('/')->with('message', 'Post Created Successfully');
        }
    }

    public function saveImage($request){
        $image_name = time(). ".". $request->image->extension();
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);
        return $image_name;
    }

    //Manage Posts
    public function myPosts(){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
        return view('posts.myPosts', ['posts' => auth()->user()->posts()->get()]);
        }
    }

    public function edit(Post $post){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{
        return view('posts.edit', ['post' => $post]);
        }
    }

    //UPDATE Post
    public function update(Request $request, $post_id){
        if(Auth::user()->ban == 1){
            return view('user.ban');
        } else{

            $request->validate([
                'title' => 'required|min:1|max:50',
                'body' => 'required|min:1|max:280',
                'tags' => 'required',
                'image' => 'mimes:jpg,png,jpeg,gif|max:1048'
            ]);
            $post = $this->post->findOrFail($post_id);

            $post->user_id = Auth::user()->id;
            $post->title = $request->title;
            $post->body = $request->body;
            $post->tags = $request->tags;

            if($request->image){
                $this->deleteImage($post->image);
                $post->image = $this->saveImage($request);
            }

            $post->save();

            return back()->with('message', 'Post Updated Successfully');
        }
    }

    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function destroy($post_id){
        $post = $this->post->findOrFail($post_id);
        $this->deleteImage($post->image);

        $this->post->destroy($post_id);
        return redirect()->route('posts.myPosts')->with('message', 'Post Deleted Successfully');
    }

}
