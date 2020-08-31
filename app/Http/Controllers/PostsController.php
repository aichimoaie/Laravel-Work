<?php


namespace App\Http\Controllers;

use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{
    public function __construct()
    {
     //   $this->middleware('auth')->except(['index', 'show']);
//        $this->authorizeResource('post');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::published()->get();

        return response([ 'posts' => PostResource::collection($posts), 'message' => 'Retrived successfully'], 200);
        //return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $post = new Post;

        return view('posts.edit', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $this->validate($request, [
            'title'     => 'required',
            'body'      => 'required',
            'published' => 'boolean',
        ]);

        $post = Post::create([
            'title'     => $request->input('title'),
            'body'      => $request->input('body'),
            'published' => $request->input('published'),
            'user_id'   => auth()->user()->id,
        ]);

        
        return response([ 'post' => new PostResource($post), 'message' => 'Created successfully'], 200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        return response([ 'post' => new PostResource($post), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

       
        return response([ 'post' => new PostResource($post), 'message' => 'Updated successfully'], 200);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $this->validate($request, [
            'title'     => 'required',
            'body'      => 'required',
            'published' => 'boolean',
        ]);

        $post->title     = $request->input('title');
        $post->body      = $request->input('body');
        $post->published = (bool)$request->input('published');
        $post->save();

       
        return response([ 'post' => new PostResource($post), 'message' => 'Updated successfully'], 200);
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response(['message' => 'Deleted'], 204);
    }
}
