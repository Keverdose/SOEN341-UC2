<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
    	$this->validate($request,array(
    		'comment' => 'required'
    	));
    	$id = Auth::user()->id;
    	$name = Auth::user()->first_name;

    	$comment = new Comment();

    	$comment->comment = $request->comment;
		$comment->name = $name;
		$comment->best_answer = FALSE;
    	$comment->post()->associate($post);
    	$comment->user()->associate($id);
    	$comment->save();
    	return back();
	}
	
	public function edit(Comment $comment)
    {
        return view ('comments.edit', ['comment' => $comment]);
	}

	public function delete(Comment $comment)
    {
        return view ('comments.delete', ['comment' => $comment]);
	}

	public function destroy($id){
		$comment = Comment::find($id);
		$post_id = $comment->post->id;
		$comment->delete();
		return redirect()->route('post.show',$post_id);
	}

	public function mark_answer($id)
	{
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

	public function update(Request $request, Comment $comment)
    {
		$comment->update($request->all());

        return redirect(route('post.show', ['post' => $comment->post_id]));
    }
}

