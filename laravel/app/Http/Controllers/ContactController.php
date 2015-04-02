<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use DB;

class ContactController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // return KindBuyer::all();
        $contact = Contact::all();
        return view('pContact', ['contact' => $contact] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create(Request $request)
    {
        $model = new Contact;
        $model->name = $request->input('name');
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
        $model = Contact::find($id);
        $model->name = $request->input('name');
        $model->cell_1 = $request->input('cell_1');
        $model->cell_2 = $request->input('cell_2');
        $model->email = $request->input('email');
        $model->save();
        //return json_encode($model);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Contact::destroy($id);
	}

}