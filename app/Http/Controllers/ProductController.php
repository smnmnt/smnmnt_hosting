<?php

namespace App\Http\Controllers;


use App\Models\Band;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('main', 'index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function main()
    {
        config()->set('database.connections.mysql.strict', false);

        $genres = DB::table('genres')
            ->join('products', 'genre_id', '=', 'prod_genre')
            ->groupBy('genre_id')
            ->distinct()
            ->take(5)
            ->get();
        $genre_img = DB::table('products')
            ->join('genres', 'prod_genre','=', 'genre_id')
            ->get();
        $products = DB::table('products')
            ->join('bands', 'prod_band', '=', 'band_id')
            ->join('genres', 'prod_genre', '=', 'genre_id')
            ->orderByDesc( 'products.created_at')
            ->take(4)
            ->get();
        $collections = DB::table('collections')
            ->join('collection_linkers', 'collections.coll_id', '=', 'collection_linkers.coll_id')
            ->join('products', 'products.prod_id', '=', 'collection_linkers.prod_id')
            ->groupBy('collection_linkers.coll_id')
            ->get();

        $collection_img = DB::table('products')
            ->join('collection_linkers', 'products.prod_id', '=', 'collection_linkers.prod_id')
            ->get();

        return view('main', compact('products', 'genres', 'collections', 'collection_img', 'genre_img'));
    }
    public function index(Request $request)
    {
        if ($request->sortByPrice || $request->sortByDate) {
            switch ($request->get('sortByPrice')){
                case 'cheap':
                    $prod = DB::table('products')
                        ->join('bands', 'prod_band', '=', 'band_id')
                        ->join('genres', 'prod_genre', '=', 'genre_id')
                        ->orderBy('prod_price')
                        ->get();
                    break;
                case 'expensive' :
                    $prod = DB::table('products')
                        ->join('bands', 'prod_band', '=', 'band_id')
                        ->join('genres', 'prod_genre', '=', 'genre_id')
                        ->orderByDesc( 'prod_price')
                        ->get();
                    break;
                default :
                    $prod = DB::table('products')
                        ->join('bands', 'prod_band', '=', 'band_id')
                        ->join('genres', 'prod_genre', '=', 'genre_id')
                        ->get();
                    break;
            }
            switch ($request->get('sortByDate')){
                case 'newer':
                    $products = $prod->sortByDesc('prod_year');
                    break;
                case 'elder':
                    $products = $prod->sortBy('prod_year');
                    break;
                default :
                    $products = $prod;
                    break;
            }
        } else
        if ($request->search) {
            $products = DB::table('products')
                ->join('bands', 'prod_band', '=', 'band_id')
                ->join('genres', 'prod_genre', '=', 'genre_id')
                ->where('prod_name', 'like', '%'.$request->search.'%')
                ->orWhere('band_name', 'like', '%'.$request->search.'%')
                ->orWhere('genre_name', 'like', '%'.$request->search.'%')
                ->get();

            return view('products.index', compact('products'));
        } else
        $products = DB::table('products')
            ->join('bands', 'prod_band', '=', 'band_id')
            ->join('genres', 'prod_genre', '=', 'genre_id')
            ->orderBy( 'band_name')
            ->get();

        return view('products.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bands = Band::all();
        $genres = Genre::all();

        return view('products.create', compact('bands', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new product();

        $product->prod_name = $request->Input('prod_name');
        $product->prod_band = $request->Input('prod_band');
        $product->prod_genre = $request->Input('prod_genre');
        $product->prod_desc = $request->Input('prod_desc');
        $product->prod_year = $request->Input('prod_year');
        $product->prod_price = $request->Input('prod_price');
        $product->prod_sale = $request->Input('prod_sale');
        $product->prod_img = $request->Input('prod_img');



        if ($request->file('prod_img')) {
            $band = Band::where('bands.band_id', '=', $product->prod_band)
                ->first();
            $band_name = $band->band_name;
            $nameWithoutSpaces = str_replace(' ', '', $request->Input('prod_name'));
            $bandNameWithoutSpaces = str_replace(' ', '', $band_name);

            $path = Storage::putFileAs('public/products/'.$bandNameWithoutSpaces, $request->file('prod_img'), $nameWithoutSpaces.'.webp');
            $url = Storage::url($path);
            $product->prod_img = $url;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Пластинка успешно создана.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = DB::table('products')
            ->where('products.prod_id', '=', $id)
            ->join('bands', 'prod_band', '=', 'band_id')
            ->join('genres', 'prod_genre', '=', 'genre_id')
            ->get();

        $title = $product->first()->prod_name;

        return view('products.show', compact('title','product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $prod_old = DB::table('products')
            ->join('bands', 'prod_band', '=', 'band_id')
            ->join('genres', 'prod_genre', '=', 'genre_id')
            ->where('products.prod_id', '=', $id)
            ->get();
        $prod = Product::where('prod_id', '=', $id)
            ->get();

        $bands = Band::where('band_id', '!=', $prod_old->first()->prod_band)
            ->get();
        $genres = Genre::where('genre_id', '!=', $prod_old->first()->prod_genre)
            ->get();

        return view('products.edit', compact('prod', 'bands', 'genres', 'prod_old'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $productOldImage = $product->prod_img;
        $product->prod_name = $request->Input('prod_name');
        $product->prod_band = $request->Input('prod_band');
        $product->prod_genre = $request->Input('prod_genre');
        $product->prod_desc = $request->Input('prod_desc');
        $product->prod_year = $request->Input('prod_year');
        $product->prod_price = $request->Input('prod_price');
        $product->prod_sale = $request->Input('prod_sale');
        $product->prod_img = $request->Input('prod_img');
        if ($request->file('prod_img')) {
            $band = Band::where('bands.band_id', '=', $product->prod_band)
                ->first();
            $band_name = $band->band_name;
            $nameWithoutSpaces = str_replace(array(' ', '?', '!'), '', $request->Input('prod_name'));
            $bandNameWithoutSpaces = str_replace(array(' ', '?', '!'), '', $band_name);

            $path = Storage::putFileAs('public/products/'.$bandNameWithoutSpaces, $request->file('prod_img'), $nameWithoutSpaces.'.webp');
            $url = Storage::url($path);
            $product->prod_img = $url;
        } else {
            $product->prod_img = $productOldImage;
        }

        $product->update();
        $id = $product->prod_id;

        return redirect()->route('products.show', compact('id'))->with('success', 'Пластинка успешно отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = DB::table('products')
            ->where('prod_id', '=', $id)
            ->delete();
        return redirect()->route('products.index')->with('success', 'Пластинка удалена');
    }
}
