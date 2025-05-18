<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function index()
    {


        $posts = DB::table('posts')->get();

        return view('read_post', compact('posts'));
    }
    public function createPost()
    {
        return view('create_post');
    }

    public function submitPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image_name = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $image_name);
        }

        $result = DB::table('posts')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image_name,
        ]);

        if ($result) {
            return redirect('/')->with('success', 'Post created successfully!');
        }

        return back()->with('error', 'Failed to create post.');
    }


    
    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = DB::table('posts')->where('id', $id)->first();

        $image_name = $post->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $image_name);

            if ($post->image && file_exists(public_path('uploads/' . $post->image))) {
                unlink(public_path('uploads/' . $post->image));
            }
        }

        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image_name,
        ]);

        return redirect('/')->with('success', 'Post updated successfully');
    }



    public function destroy($id)
    {
        DB::table('posts')->where('id', $id)->delete();
        return redirect('/')->with('success', 'Post deleted successfully.');
    }
}
