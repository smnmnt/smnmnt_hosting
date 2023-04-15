<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\New_;

class BandController extends Controller
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
        $bands = DB::table('bands')
            ->get();
        return view('bands.index', compact('bands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $band = new band();

        $band->band_name = $request->Input('band_name');
        $band->band_desc = $request->Input('band_desc');
        $band->band_img = $request->Input('band_img');


        if ($request->file('band_img')) {
            $nameWithoutSpaces = str_replace(' ', '', $request->Input('band_name'));
            $path = Storage::putFileAs('public/bands/'.$nameWithoutSpaces, $request->file('band_img'), $nameWithoutSpaces.'.webp');
            $url = Storage::url($path);
            $band->band_img = $url;
        }

        $band->save();

        return redirect()->route('bands.index')->with('success', 'Исполнитель успешно добавлен.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $band = DB::table('bands')
            ->where('band_id', '=', $id)
            ->get();

        $band_products = DB::table('bands')
            ->where('band_id', '=', $id)
            ->join('products', 'prod_band', '=', 'band_id')
            ->join('genres', 'prod_genre', '=', 'genre_id')
            ->get();

        $title = $band->first()->band_name;
        return view('bands.show', compact('title','band', 'band_products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $band = Band::where('band_id', '=', $id)
            ->get();
        return view('bands.edit', compact('band'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $band = Band::find($id);

        $bandOldImage = $band->band_img;
        $band->band_name = $request->Input('band_name');
        $band->band_desc = $request->Input('band_desc');
        $bandNewImage = $request->Input('band_img');
        if ($request->file('band_img')) {
            $band->band_img = $request->Input('band_img');
            if ($request->file('band_img')) {
                $nameWithoutSpaces = str_replace(' ', '', $request->Input('band_name'));
                $path = Storage::putFileAs('public/bands/'.$nameWithoutSpaces, $request->file('band_img'), $nameWithoutSpaces.'.webp');
                $url = Storage::url($path);
                $band->band_img = $url;
            }
        } else {
            $band->band_img = $bandOldImage;
        }





        $band->update();
        $id = $band->band_id;

        return redirect()->route('bands.show', compact('id'))->with('success', 'Исполнитель успешно отредактирован.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        config()->set('database.connections.mysql.strict', false);

        $productsByBand = DB::table('products')
            ->where('band_id', '=', $id)
            ->join('bands', 'prod_band', '=', 'band_id')
            ->groupBy('bands.band_id')
            ->delete();
        $band = DB::table('bands')
            ->where('band_id', '=', $id)
            ->delete();


        return redirect()->route('bands.index')->with('success', 'Исполнитель удален');
    }
}
