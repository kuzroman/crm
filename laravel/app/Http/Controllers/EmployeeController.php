<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Employee;

class EmployeeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $employees = Employee::all();
//        return $employees;
        return view('pEmployee', ['employees' => $employees]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
    public function create(Request $request)
    {
        $model = new Employee;
        $model->name = $request->input('name');
        $model->salary = $request->input('salary');
        $model->isWork = $request->input('isWork');
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
        $model = Employee::find($id);
        $model->name = $request->input('name');
        $model->salary = $request->input('salary');
        $model->isWork = $request->input('isWork');
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
        //        !!!!!! ДОПИСАТЬ ПРОВЕРИТЬ
        // удалять только в случае если нет связанных данных с другой таблицей
//        Employee::destroy($id);
        return Employee::destroy($id);
	}

}
