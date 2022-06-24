<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderByDesc('id')->get();
        return view('admin.tags.index', compact('tags'));

    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|unique:tags'
        ]);
        $slug = Str::slug($request->name);
        $validated_data['slug'] = $slug;

        Tag::create($validated_data);
        return redirect()->back()->with('message', "Tag $slug aggiunto correttamente");
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validated_data = $request->validate([
            'name' => ['required', Rule::unique('tags')->ignore($tag)]
        ]);
        $slug = Str::slug($request->name);
        $validated_data['slug'] = $slug;
        $tag->update($validated_data);
        return redirect()->back()->with('message', "Tag $slug modificato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->back()->with('message', "Tag $tag->name eliminato correttamente");
    }
}
