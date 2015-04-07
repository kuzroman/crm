<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Buyer;
use App\Models\Place;

class OrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $orders = Order::getAll();
        $buyers = Buyer::all();
        $places = Place::all();
//        return $orders;
        return view('pOrder', ['orders' => $orders, 'buyers' => $buyers, 'places' => $places]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create(Request $request)
    {
        $model = new Order;

        $model->dateCreated = $request->input('dateCreated');
        $model->id_buyer = $request->input('id_buyer');
        $model->desc = $request->input('desc');
        $model->id_place = $request->input('id_place');
        $model->cash = $request->input('cash');
        $model->price = $request->input('price');
        $model->paid = $request->input('paid');
        $model->dateCompleted = $request->input('dateCompleted');
        $model->finished = $request->input('finished');

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
        return json_encode( Order::find($id) );
//        return json_encode( Order::all() );
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
        $model = Order::find($id);

        $model->dateCreated = $request->input('dateCreated');
        $model->id_buyer = $request->input('id_buyer');
        $model->desc = $request->input('desc');
        $model->id_place = $request->input('id_place');
        $model->cash = $request->input('cash');
        $model->price = $request->input('price');
        $model->paid = $request->input('paid');
        $model->dateCompleted = $request->input('dateCompleted');
        $model->finished = $request->input('finished');

        $model->save();

        return json_encode($model);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Order::destroy($id);
	}

}
