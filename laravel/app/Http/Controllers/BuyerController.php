<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\KindBuyer;
use App\Models\Contact;


class BuyerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $kindBuyer = KindBuyer::all();
//        $contact = Contact::all();
        //return view('kindBuyer', ['kind_buyer' => $kindBuyer] );

//        $buyers = Buyer::all();
        $buyers = Buyer::getAll(); // используем свой метод с доп данными из таблицы kindBuyer
        //return $buyers;
        return view('pBuyer', ['buyers' => $buyers, 'kind_buyer' => $kindBuyer] );

        //return view('home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
        $model = new Buyer;

        $model->name = $request->input('name');
        $model->id_kind = $request->input('id_kind');
        $model->about = $request->input('about');
        $model->contact = $request->input('contact');
        $model->cell_1 = $request->input('cell_1');
        $model->cell_2 = $request->input('cell_2');
        $model->email = $request->input('email');

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
        $model = Buyer::find($id);

        $model->name = $request->input('name');
        $model->id_kind = $request->input('id_kind');
        $model->about = $request->input('about');
        $model->contact = $request->input('contact');
        $model->cell_1 = $request->input('cell_1');
        $model->cell_2 = $request->input('cell_2');
        $model->email = $request->input('email');

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
        Buyer::destroy($id);
	}

}
