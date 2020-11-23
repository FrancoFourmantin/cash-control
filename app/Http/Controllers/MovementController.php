<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Rfc4122\UuidV4;

class MovementController extends Controller
{
	public function index()
	{
		return Movement::all();
	}

	public function create(Request $request)
	{
		$validator = $this->getValidator($request->all());


		if($validator->fails()){
			return response($validator->getMessageBag(), 400);
		}

		try{

			$movement = new Movement();

			$movement->fill([
				'id' => UuidV4::uuid4()->toString(),
				'user_category_id' => $request->user_category_id,
				'user_id' => $request->user_id,
				'quantity' => $request->quantity,
				'isIncome' => $request->isIncome, 
			])->save();


			return response(json_encode($movement->all()->toArray()), 200);

		}catch (Exception $e){

			return response(json_encode($e) , 500);
		}
	}

	public function show($id)
	{
		return Movement::findOrFail($id);
	}

	public function update(Request $request , $id)
	{
		$validator = $this->getValidator($request->all());

		if($validator->fails()){
			return response($validator->getMessageBag() , 400);
		}

		$movement = Movement::find($id);

		if( ! $movement){
			return response(json_encode("User doesn't exists" , 400));
		}

		try{

			$movement->update($request->all());
			$movement->save;

		} catch(Exception $e) {
			return response(json_encode($e) , 500);
		}
	}

	public function destroy( $id)
	{
		return Movement::destroy($id);
	}

	public function updateMany(array $ids)
	{
		//TODO: Develop updateMany  
	}

	public function deleteMany(array $ids)
	{
		//TODO: deleteMany
	}

	// Function for return a Validator instance
	private function getValidator($data)
	{
		//Magic method to get the name of the method that invokes this function
		$method = debug_backtrace()[1]['function'];

		switch ($method){
		case "create":
			$rules = [
				'user_id' => ['required','uuid'],
				'user_category_id' => ['required','uuid'],
				'quantity' => ['required','uuid' , 'email' ,'max:255'],
				'isIncome' => ['bool']
			];
			break;
		case "update":
			$rules = [
				'user_id' => ['uuid'],
				'user_category_id' => ['uuid'],
				'quantity' => ['uuid' , 'email' ,'max:255'],
				'isIncome' => ['bool']
			];
			break;
		}


		return Validator::make($data , $rules);
	}

	//TODO Develop a function to get the errors msg
	public function getErrorMsg()
	{
		return json_encode('error');
	}
}
