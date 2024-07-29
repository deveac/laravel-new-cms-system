<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
class PostController extends Controller
{
    //

    public function index()
    {
        // $posts = Post::all(); // shows all user
        // $posts = auth()->user()->posts; // shows active user
        $posts = auth()->user()->posts()->paginate(5); // pagination

        
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('blog-post', ['post' => $post]);
    }

    public function create() 
    {
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    public function store(Request $request) //Request $request
    {
        /* $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file', //can be specific like 'mimes:jpeg, png'
            'body' => 'required'
        ]);
        dd($inputs);
        if(request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        } 
        
        // dd($request->post_image->originalName);
        // dd(request()->all());
        // dd($inputs);
        
        */

        $this->authorize('create', Post::class);

        $inputs = $request->validate([
            'title' => ['required','min:8','max:255'],
            'post_image' => ['mimes:jpg,bmp,png'], //can be specific like 'mimes:jpeg, png'
            'body' => ['required']
        ]);

        if($request->post_image) {
            $inputs['post_image'] = $request->post_image->store('images');
        }
        
        auth()->user()->posts()->create($inputs);

        $request->session()->flash('post-created-message', 'Post was created');
        // return back();
        return redirect()->route('post.index');
    }

    public function destroy(Request $request, Post $post) { // study the session::flash
        
        $this->authorize('delete', $post); // creating policy

        $post->delete();

        $request->session()->flash('message', 'Post was deleted');
        // Session::flash('message', 'Post was deleted');
        
        return back();
    }

    public function edit(Post $post, Request $request) {

        // Creating policy
        $this->authorize('view', $post);
        /* if(auth()->user()->can('view', $post)) {

        } */

        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post, Request $request) {

        $this->authorize('update', $post);

        $inputs = $request->validate([
            'title' => ['required','min:8','max:255'],
            'post_image' => ['mimes:jpg,bmp,png'], //can be specific like 'mimes:jpeg, png'
            'body' => ['required']
        ]);

        if($request->post_image) {
            $inputs['post_image'] = $request->post_image->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->update();

        $request->session()->flash('post-updated-message', 'Post was updated');
        // return back();
        return redirect()->route('post.index');
    }
}
