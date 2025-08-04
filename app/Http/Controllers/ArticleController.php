<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
            'audio' => 'nullable|mimes:mp3,wav|max:20480'
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('audio')) {
            $data['audio'] = $request->file('audio')->store('audios', 'public');
        }

        Article::create($data);
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
            'audio' => 'nullable|mimes:mp3,wav|max:20480'
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('photo')) {
            if ($article->photo)
                Storage::delete('public/' . $article->photo);
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('audio')) {
            if ($article->audio)
                Storage::delete('public/' . $article->audio);
            $data['audio'] = $request->file('audio')->store('audios', 'public');
        }

        $article->update($data);
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->photo)
            Storage::delete('public/' . $article->photo);
        if ($article->audio)
            Storage::delete('public/' . $article->audio);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Artikel dihapus.');
    }

    public function show(Article $article)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            $articleKey = 'viewed_article_' . $article->id;
            $viewExpiration = now()->addHours(3); // durasi delay view

            if (!session()->has($articleKey) || now()->gt(session($articleKey))) {
                $article->increment('views');
                session()->put($articleKey, $viewExpiration);
            }
        }

        return view('articles.show', compact('article'));
    }

    public function like(Article $article)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            $likeKey = 'liked_article_' . $article->id;
            $likeExpiration = now()->addHours(3);

            if (!session()->has($likeKey) || now()->gt(session($likeKey))) {
                $article->increment('likes');
                session()->put($likeKey, $likeExpiration);
                return back()->with('success', 'Kamu menyukai artikel ini.');
            } else {
                return back()->with('info', 'Kamu sudah menyukai artikel ini baru-baru ini. Coba lagi nanti.');
            }
        }

        return back()->with('info', 'Admin tidak dapat menyukai artikel.');
    }

}
