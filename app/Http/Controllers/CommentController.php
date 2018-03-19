<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
	/**
     * Create and store a comment with an association
	 *  to the post and author.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post) {
    	$this->validate($request,array(
    		'comment' => 'required'
		));


		$userName = DB::table('users')->where('id',Auth::user()->id)->first();
    
      
    	$id = Auth::user()->id;
    	$name = Auth::user()->first_name;
    	$comment = new Comment();
    	$comment->comment = $request->comment;
		$comment->name = $name;
		$comment->user_name = $userName->user_name;
		$comment->best_answer = FALSE;
    	$comment->post()->associate($post);
    	$comment->user()->associate($id);
		$comment->save();
		
    	return back();
	}
	
	/**
     * Display a an edit form for the comment specicified.
     *
     * @return \Illuminate\Http\Response
     */
	public function edit(Comment $comment) {


        return view ('comments.edit', ['comment' => $comment]);
	}

	/**
     * Delete the specified comment.
     *
     * @return \Illuminate\Http\Response
     */
	public function delete(Comment $comment) {
        return view ('comments.delete', ['comment' => $comment]);
	}

	/**
     * Destroy the specified comment.
     *
     * @return \Illuminate\Http\Response
     */
	public function destroy($id) {
		$comment = Comment::find($id);
		$post_id = $comment->post->id;
		$comment->delete();
		return redirect()->route('post.show',$post_id);
	}

	/**
     * Mark and save a comment as the best answer to a post.
	 * Mark the post as solved and update its status.
     *
     * @return \Illuminate\Http\Response
     */
	public function mark_answer($id) {
		$comment = Comment::find($id);
		$post_id = $comment->post->id;
		$post = Post::find($post_id);

		$comment->best_answer = TRUE;
		$comment->save();

		$post->solved = TRUE;
		$post->title = '[SOLVED]'.$post->title;
		$post->save();

		return redirect()->route('post.show',$post_id);
	}

	/**
     * Update the specified comment.
     *
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, Comment $comment) {
		$comment->update($request->all());

        return redirect(route('post.show', ['post' => $comment->post_id]));
    }
}