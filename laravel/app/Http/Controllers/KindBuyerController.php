<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KindBuyer;
use DB;

class KindBuyerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // return KindBuyer::all();
        $kindBuyer = KindBuyer::all();
        return view('pKindBuyer', ['kind_buyer' => $kindBuyer] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create(Request $request)
    {
        $model = new KindBuyer;
        $model->kind = $request->input('kind');

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
        $model = KindBuyer::find($id);
        $model->kind = $request->input('kind');
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
        // удалять только в случае если нет связанных данных с покупателями
        $found = DB::select("select id from buyers WHERE id_kind = $id LIMIT 1");
        if (!$found) {
            KindBuyer::destroy($id);
        }
        return $found;
	}

}
