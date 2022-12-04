<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            "posts" => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            "title" => "required|max:255",
            "slug" => "",
            "category_id" => "required",

            // untuk validasi file tulis |file|max/min/size (ukuran dalam KB)
            // file : artinya KB. Jika tidak ada file sebelum max maka dianggapnya karakter
            // max : maksimal ukuran
            // min : minimal ukuran
            // size : ukuran harus pas
            "images" => "image|file|max:1024",
            "body" => "required"
        ]);

        if ($request->file('images')) {
            $validateData['images'] = $request->file('images')->store('post-images');
        }

        $validateData['user_id'] = auth()->user()->id;

        // strip_tag untuk menghilangkan tag HTML pada format data di body
        // str::limit untuk membuat exceprt 
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 100, '...');


        Post::create($validateData);

        return redirect('dashboard/posts')->with('success', 'New pots has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            "post" => $post,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validateData = $request->validate([
            "title" => "required|max:255",
            "category_id" => "required",
            "images" => "image|file|max:1024",
            "body" => "required"
        ]);

        // jika ada image baru simpan images
        if ($request->file('images')) {
            // hapus image lama agar tidak memenuhi data
            if ($request->oldImages) {
                Storage::delete($request->oldImages);
            }

            // simpan image
            $validateData['images'] = $request->file('images')->store('post-images');
        }

        $validateData['user_id'] = auth()->user()->id;

        // strip_tag untuk menghilangkan tag HTML pada format data di body
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 100, '...');


        Post::where('id', $post->id)->update($validateData);

        return redirect('dashboard/posts')->with('success', 'New pots has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // hapus image lama agar tidak memenuhi data
        if ($post->images) {
            Storage::delete($post->images);
        }
        Post::destroy($post->id);

        return redirect('dashboard/posts')->with('success', 'Post has been deleted!');
    }

    // cek slug(untuk membuat slug dengan libaray eloquent slugable)
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
