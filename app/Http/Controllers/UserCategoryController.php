<?php

namespace App\Http\Controllers;

use App\Models\UserCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Rfc4122\UuidV4;

class UserCategoryController extends Controller
{
	public function index()
	{
		return UserCategory::all();
	}

	public function create(Request $request)
	{
		$validator = $this->getValidator($request->all());


		if($validator->fails()){
			return response($validator->getMessageBag(), 400);
		}

		try{

			$user_category = new UserCategory();

			$user_category->fill([
				'id' => UuidV4::uuid4()->toString(),
				'user_id' => $request->user,
				'category_id' => $request->category_id,
			])->save();


			return response(json_encode($user_category->all()->toArray()), 200);

		}catch (Exception $e){

			return response(json_encode($e) , 500);
		}
	}

	public function show($id)
	{
		return UserCategory::findOrFail($id);
	}

	public function update(Request $request , $id)
	{
		$validator = $this->getValidator($request->all());

		if($validator->fails()){
			return response($validator->getMessageBag() , 400);
		}

		$user = UserCategory::find($id);

		if( ! $user){
			return response(json_encode("User doesn't exists" , 400));
		}

		try{

			$user->update($request->all());
			$user->save;

		} catch(Exception $e) {
			return response(json_encode($e) , 500);
		}
	}

	public function destroy( $id)
	{
		return UserCategory::destroy($id);
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
	public function getValidator($data)
	{
		//Magic method to get the name of the method that invokes this function
		$method = debug_backtrace()[1]['function'];

		switch ($method){
		case "create":
			$rules = [
				'user_id' => ['required','uuid'],
				'category_id' => ['required','uuid'],
			];
			break;
		case "update":
			$rules = [
				'user_id' => ['uuid'],
				'category_id' => ['uuid'],
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
