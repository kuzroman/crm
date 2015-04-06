<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Place;
use DB;

class PlaceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // return KindBuyer::all();
        $place = Place::all();
        return view('pPlace', ['place' => $place] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create(Request $request)
    {
        $model = new Place;
        $model->name = $request->input('name');

        $model->save();
        return json_encode($model);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(Request $request, $id)
    {
        $model = Place::find($id);
        $model->name = $request->input('name');
        $model->save();
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        // удалять только в случае если нет связанных данных с другой таблицей
        $found = DB::select("select id from orders WHERE id_place = $id LIMIT 1");
        if (!$found) {
            Place::destroy($id);
        }
        return $found;
	}

}