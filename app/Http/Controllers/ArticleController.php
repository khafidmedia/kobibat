<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        // Login wajib untuk semua kecuali index, show, like
        $this->middleware('auth')->except(['index', 'show', 'like']);
    }

    public function index()
    {
        $articles = Article::latest()->get();

        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.articles.index', compact('articles'));
        }

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

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
        $this->authorizeAdmin();
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeAdmin();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:20480',
            'audio' => 'nullable|mimes:mp3,wav|max:20480'
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('photo')) {
            if ($article->photo) {
                Storage::delete('public/' . $article->photo);
            }
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('audio')) {
            if ($article->audio) {
                Storage::delete('public/' . $article->audio);
            }
            $data['audio'] = $request->file('audio')->store('audios', 'public');
        }

        $article->update($data);
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $this->authorizeAdmin();

        if ($article->photo) {
            Storage::delete('public/' . $article->photo);
        }
        if ($article->audio) {
            Storage::delete('public/' . $article->audio);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Artikel dihapus.');
    }

    public function show(Article $article)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            $articleKey = 'viewed_article_' . $article->id;
            $viewExpiration = now()->addHours(3);

            if (!session()->has($articleKey) || now()->gt(session($articleKey))) {
                $article->increment('views');
                session()->put($articleKey, $viewExpiration);
            }
        }

        // Admin melihat halaman show di admin layout
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.articles.show', compact('article'));
        }

        // User melihat halaman show di user layout
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

    private function authorizeAdmin()
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melakukan aksi ini.');
        }
    }
}
