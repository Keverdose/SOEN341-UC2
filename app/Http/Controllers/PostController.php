<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
//use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of specified posts (solved/unsolved).
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status) {
        if ( $status == 'open') {
            return view('posts.list_posts', ['posts' => Post::all()->whereIn('solved', FALSE)]);
        }
        else {
            return view('posts.list_posts', ['posts' => Post::all()->whereIn('solved', TRUE)]);
        }
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $post = new Post($request->all());
        $post->solved=FALSE;
        Auth::user()->posts()->save($post);
        $request->session()->flash('success', 'Post creation was successful!');

        return redirect(route('post.show', ['post' => $post->id]));
    }

    /**
     * Display the specified post.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        return view ('posts.edit', ['post' => $post]);
    }

    /**
     * Reopens the specified post from solved to unsolved.
     * @param  \App\Post  $post
     */
    public function reopen(Post $post) {
        $post->solved = FALSE;
        $post->title = str_replace("[SOLVED]","",$post->title);
        $post->save();

        Comment::where('post_id', $post->id)
          ->where('best_answer', TRUE)
          ->update(['best_answer' => FALSE]);

        return redirect()->route('post.show',$post->id);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {
        $post->update($request->all());

        return redirect(route('post.show', ['post' => $post->id]));
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $post = Post::find($id);
        $comments = $post->comments;
        foreach ($comments as $comment) {
            $comment->delete();
        }        
        $post->delete();

        return view('posts.list_posts', ['posts' => Post::all()]);        
    }

    /**
     * Delete the specified post from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post) {
        return view ('posts.delete', ['post' => $post]);
    }
}
