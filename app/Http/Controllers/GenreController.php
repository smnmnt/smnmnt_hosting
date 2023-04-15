<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        config()->set('database.connections.mysql.strict', false);

        $genres = DB::table('genres')
            ->join('products', 'genre_id', '=', 'prod_genre')
            ->groupBy('genre_id')
            ->distinct()
            ->get();

        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genre = new Genre();

        $genre->genre_name = $request->Input('genre_name');
        $genre->genre_desc = $request->Input('genre_desc');

        $genre->save();

        return redirect()->route('genres.index')->with('success', 'Жанр успешно добавлен.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $genre = DB::table('genres')
            ->where('genre_id', '=', $id)
            ->join('products', 'prod_genre', '=', 'genre_id')
            ->join('bands', 'prod_band', '=', 'band_id')
            ->get();

        $title = $genre->first()->genre_name;
        return view('genres.show', compact('title','genre', 'genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genre = Genre::where('genre_id', '=', $id)
            ->get();
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        $genre->genre_name = $request->Input('genre_name');
        $genre->genre_desc = $request->Input('genre_desc');

        $genre->update();

        return redirect()->route('genres.show', compact('id'))->with('success', 'Жанр успешно отредактирован.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productsByBand = DB::table('products')
            ->where('genre_id', '=', $id)
            ->join('genres', 'prod_genre', '=', 'genre_id')
            ->groupBy('genres.genre_id')
            ->delete();
        $genre = Genre::where('genre_id', '=', $id)
            ->delete();
        return redirect()->route('genres.index')->with('success', 'Жанр удален');
    }
}
