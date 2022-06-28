<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Mail\NewPostCreated;
use App\Mail\PostUpdatedAdminMessage;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderByDesc('id')->get();
        //dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $validated_data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated_data['slug'] = $slug;
        
        //add img file
        if($request->hasFile('img')) {
            $request->validate([
                'img' => 'nullable|image|max:250'
            ]);
            $path_img = Storage::put('post_images', $request->img);
            $validated_data['img'] = $path_img;
        }

        $new_post = Post::create($validated_data);
        $new_post->tags()->attach($request->tags);


        Mail::to($request->user())->send(new NewPostCreated($new_post));

        return redirect()->route('admin.posts.index')->with('message', 'Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //dd($post['category_id']);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $validated_data = $request->validated();
        //dd($validated_data);
        $slug = Str::slug($request->title, '-');
        $validated_data['slug'] = $slug;

        if($request->hasFile('img')) {
            $request->validate([
                'img' => 'nullable|image|max:250'
            ]);
            Storage::delete($post->img);
            $path_img = Storage::put('post_images', $request->img);
            $validated_data['img'] = $path_img;
        }



        $post->update($validated_data);
        $post->tags()->sync($request->tags);

        Mail::to('admin@example.com')->send(new PostUpdatedAdminMessage($post));

        return redirect()->route('admin.posts.index')->with('message', 'Post Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->img);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
