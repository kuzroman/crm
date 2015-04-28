<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\KindCost;
use App\Models\MutualCalc;

class MutualCalcController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {
        $mutualCalc = MutualCalc::getAll();
        $buyers = Buyer::all();
        $employees = Employee::all();
        $kindCosts = KindCost::all();
        $orders = Order::getAll(); // Для оптимизации лучше сделать свой метод выводящий тольк то что нужно!

        // return $mutualCalc;
        return view('pMutualCalc', ['mutualCalc' => $mutualCalc, 'employees' => $employees,
            'buyers' => $buyers, 'orders' => $orders, 'kindCosts' => $kindCosts
        ]);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
        $model = MutualCalc::find($id);

        $model->date = $request->input('date');
        $model->id_order = $request->input('id_order');
        $model->id_buyer = $request->input('id_buyer');
        $model->id_employee = $request->input('id_employee');
        $model->id_kindcost = $request->input('id_kindcost');
        $model->sum = $request->input('sum');
        $model->desc = $request->input('desc');

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
		//
	}

}
