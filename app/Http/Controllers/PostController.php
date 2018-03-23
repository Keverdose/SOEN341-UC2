<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Category;
use App\Tag;

//use App\User;

use App\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function create()
    {
        return view('posts.create',['categories' => Category::all(),'tags'=>Tag::All()]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $post = new Post($request->all());
        $post->category_id = $request->get('Category');
        $post->solved=FALSE;
        $tags = Tag::All()->pluck('name')->toArray();
        $tag_list = $request->get('tags');
        $newTagAdded = [];
        Auth::user()->posts()->save($post);
        if(count($tag_list) > 0) {
            foreach ($tag_list as $tag) {
                if (!(in_array($tag, $tags))) {
                    $newTag = new Tag();
                    $newTag->name = $tag;
                    $newTag->save();

                }
                array_push($newTagAdded, Tag::where('name', '=', $tag)->first()->id);

            }
        }
            
        $post->tags()->sync($newTagAdded,false);
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
        $id = $post->increment('view_count');
        $array = [
            "view_count" => $id,];

        $post->update($array);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Display the posts with the search query in the body text.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $request->get('search');
        $results = Post::where('body', 'like', '%' . $request->get('search') . '%')->get();

        return view('posts.posts_search', ['posts' => $results]);
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
        $post->tags()->detach();
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

    /**
     * Allows the user to vote on a post once.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    function vote(Post $post, $updown){

        $post->setVote(Auth::user(), $updown === 'up');

        return back();
    }

}
