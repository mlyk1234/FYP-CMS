<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
    }

    public function count()
    {
        // take the total completed task for each chapter
        return Item::where('user_id', Auth::user()->id)->where('completed', 0)->count();
    }
    public function total()
    {
        // take the total tasks created for each chapter
        return Item::where('user_id', Auth::user()->id)->select('category_id')->selectRaw('count(category_id) AS counts,sum(completed) AS totalCompleted')->groupBy('category_id')->get();
    }

    public function totalpiechart()
    {
        // take the total tasks created for each chapter
        return Item::where('user_id', Auth::user()->id)->selectRaw('count(category_id) AS counts,sum(completed) AS totalCompleted')->groupBy('completed')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->user_id = Auth::user()->id;
        $newItem->name = $request->item;
        $newItem->category_id = $request->category_id;
        $newItem->description = $request->description;
        $newItem->save();

        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateForm(Request $request, $id)
    {
        $existingItem = Item::find( $id );

        if( $existingItem ){
            $existingItem->name = $request->name;
            $existingItem->description = $request->description;
            $existingItem->category_id = $request->category_id;
            $existingItem->save();
            return $existingItem;
        }

        return "Item not found.";
    }

    public function update(Request $request, $id)
    {
        $existingItem = Item::find( $id );

        if( $existingItem ){
            $existingItem->completed = $request->item['completed'] ? true : false;
            $existingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $existingItem->save();
            return $existingItem;
        }

        return "Item not found.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Item::find( $id );

        if( $existingItem ){
            $existingItem->delete();
            return "Item deleted";
        }
        return "Item no found";
    }
}
