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
    public function index(Request $request) {
        

            $select_status = $request->get('Status');
            $select_categ = $request->get('Category');
            
            if ($select_status == 'All' || $select_status == NULL) {
                if ($select_categ == 'All'|| $select_categ == NULL) {
                    return view('posts.list_posts', ['posts' => Post::orderBy('created_at','DESC')->get(),
                                                                        'categories' => Category::all()]);    
                }
                else {
                    return view('posts.list_posts', ['posts' => Post::orderBy('created_at','DESC')
                                                                        ->where('category_id', $select_categ)
                                                                        ->get(),
                                                                        'categories' => Category::all()]);
                }
            }
            if ($select_categ == 'All') {
                return view('posts.list_posts', ['posts' => Post::orderBy('created_at','DESC')
                                                                    ->where('solved', $select_status)
                                                                    ->get(),
                                                                    'categories' => Category::all()]);    
            }
            else {
                return view('posts.list_posts', ['posts' => Post::orderBy('created_at','DESC')
                                                                    ->where('solved', $select_status)
                                                                    ->where('category_id', $select_categ)
                                                                    ->get(),
                                                                    'categories' => Category::all()]);
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

        $initial_related = Post::all()->whereIn('category_id', $post->category_id)
                                        ->whereNotIn('id', $post->id);
        
        if (count($initial_related) != 0){
            /**
             * Count the number of matches per tag related to the showing post
             * against all posts in the same category
             */

            $matches = array();
            foreach($post->tags as $tag){
                foreach($initial_related as $querried_post){
                    $quer_tags = $querried_post->tags->pluck('id')->toArray();
                    if(in_array($tag->id, $quer_tags)){
                        array_push($matches, $querried_post->id);  
                    }
                }
            }
            
            /**
             * Create a 2-D array and sort it in terms
             * of which post had the most amount of common posts
             * as well as views/20
             */
            $two_d_relevance = array();
            
            foreach($initial_related as $related_post)
            {
                array_push($two_d_relevance, array($related_post->id,count(array_keys($matches, $related_post->id))
                                                                    +($related_post->view_count/20)));
            }
            
            usort($two_d_relevance, function($a, $b) {
                return $retval = $b[1] <=> $a[1];
            });

            /**
             * Transfer the 2-D array into 1-D array containing
             * the post id's in order of relevance
             */
            $ordered_post_ids = array();
            for ($x=0; $x<count($initial_related); $x++)
            {
                array_push($ordered_post_ids, $two_d_relevance[$x][0]);
            }

            $sorted_posts = Post::whereIn('id', $ordered_post_ids)
                            ->orderBy(DB::raw('FIELD(`id`, '.implode(',', $ordered_post_ids).')'))
                            ->get();

            return view('posts.show', ['post' => $post, 'related' => $sorted_posts]);
        }
        else return view('posts.show', ['post' => $post, 'related' => NULL]);
    }

    /**
     * Display the posts with the search query in the body text.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $request->get('search');
        $results = Post::orderBy('created_at','DESC')
                            ->where('body', 'like', '%' . $request->get('search') . '%')
                            ->get();

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
