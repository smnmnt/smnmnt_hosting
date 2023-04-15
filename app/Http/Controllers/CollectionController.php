<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Collection;
use App\Models\CollectionLinker;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
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

        $collections = DB::table('collections')
            ->join('collection_linkers', 'collections.coll_id', '=', 'collection_linkers.coll_id')
            ->join('products', 'products.prod_id', '=', 'collection_linkers.prod_id')
            ->groupBy('collection_linkers.coll_id')
            ->distinct()
            ->get();

        $collection_img = DB::table('products')
            ->join('collection_linkers', 'products.prod_id', '=', 'collection_linkers.prod_id')
            ->get();

        return view('collections.index', compact('collections', 'collection_img'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = DB::table('products')
            ->join('bands', 'bands.band_id', '=', 'products.prod_band')
            ->get();

        return view('collections.create', compact( 'products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $coll = new Collection();
        $collection_last = Collection::all()
            ->last();
        if (empty($collection_last))
            $coll_id = 1;
        else
            $coll_id = $collection_last->coll_id + 1;

        $coll->coll_name = $request->Input('coll_name');
        $coll->coll_desc = $request->Input('coll_desc');

        $coll->coll_old_price = 0;
        $coll->coll_new_price = 0;

        $coll->save();
        foreach ($_POST['prod_checkbox'] as $checkbox){
            $coll_link = new CollectionLinker();
            $collection = Collection::all()->last();
            $coll_link->coll_id = $collection->coll_id;
            $coll_link->prod_id = $checkbox;



            $prod = DB::table('products')
                ->where('prod_id', '=', $checkbox)
                ->first();

            $old_price_array[] = $prod->prod_price;
            $coll_link->save();
        }
        $old_price = array_sum($old_price_array);
        $collection->coll_old_price = $old_price;
        $sell_price = (int)($old_price / 2);
        $collection->coll_new_price = $old_price - $sell_price;
        $collection->update();


        return redirect()->route('collections.index')->with('success', 'Коллекция успешно создана.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $collection = DB::table('collections')
            ->where('collections.coll_id', '=', $id)
            ->join('collection_linkers', 'collections.coll_id', '=', 'collection_linkers.coll_id')
            ->join('products', 'products.prod_id', '=', 'collection_linkers.prod_id')
            ->join('bands', 'products.prod_band', '=', 'bands.band_id')
            ->get();
        if (empty($collection->first()))
            $title = 'Коллекция отсутствует';
        else
            $title = $collection->first()->coll_name;

        return view('collections.show', compact('title','collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $collection = Collection::where('coll_id', '=', $id)
            ->get();
        $products = DB::table('products')
            ->join('bands', 'bands.band_id', '=', 'products.prod_band')
            ->get();
        if (empty($collection->first()))
            $title = 'Коллекция отсутствует';
        else
            $title = $collection->first()->coll_name;
        return view('collections.edit', compact('collection', 'products', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $coll = Collection::find($id);

        $coll->coll_name = $request->Input('coll_name');
        $coll->coll_desc = $request->Input('coll_desc');

        $coll->update();
        $coll_link_dropper = DB::table('collection_linkers')
            ->where('collection_linkers.coll_id', '=', $coll->coll_id)
            ->delete();
        foreach ($_POST['prod_checkbox'] as $checkbox){

            $coll_link = new CollectionLinker();
            $coll_link->coll_id = $coll->coll_id;
            $coll_link->prod_id = $checkbox;

            $prod = DB::table('products')
                ->where('prod_id', '=', $checkbox)
                ->first();

            $old_price_array[] = $prod->prod_price;
            $coll_link->save();
        }
        $old_price = array_sum($old_price_array);
        $coll->coll_old_price = $old_price;
        $sell_price = (int)($old_price / 2);
        $coll->coll_new_price = $old_price - $sell_price;
        $coll->update();
        $id = $coll->coll_id;


        return redirect()->route('collections.show', compact('id'))->with('success', 'Коллекция успешно отредактирована.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        config()->set('database.connections.mysql.strict', false);

        $coll_linkers = DB::table('collection_linkers')
            ->where('collection_linkers.coll_id', '=', $id)
            ->join('collections', 'collections.coll_id', '=', 'collection_linkers.coll_id')
            ->groupBy('collection_linkers.coll_id')
            ->delete();
        $coll = DB::table('collections')
            ->where('coll_id', '=', $id)
            ->delete();


        return redirect()->route('collections.index')->with('success', 'Коллекция удалена');
    }
}
