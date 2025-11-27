<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // ADD THIS LINE

class CrudController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->search) {
            $query->where('title','like',"%{$request->search}%");
        }

        $posts = $query->latest()->paginate(10);

        return view('crud.index', compact('posts'));
    }

    
    public function create()
    {
        return view('crud.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        
        $validated['slug'] = Str::slug($request->title);
        $validated['author'] = auth()->user()->name;

        Post::create($validated);

        return redirect()->route('crud.index')->with('success','Post created successfully!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('crud.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validated);

        return redirect()->route('crud.index')->with('success','Updated Successfully!');
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('crud.index')->with('success','Post deleted!');
    }
}