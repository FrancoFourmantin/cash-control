<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Rfc4122\UuidV4;

class UserController extends Controller
{
	public function index()
	{
		return User::all();
	}

	public function create(Request $request)
	{
		$validator = $this->getValidator($request->all());


		if($validator->fails()){
			return response($validator->getMessageBag(), 400);
		}

		try{

			$user = new User();

			$user->fill([
				'id' => UuidV4::uuid4()->toString(),
				'name' => $request->name,
				'surname' => $request->surname,
				'email' => $request->email,
				'password' => Hash::make($request->password),
			])->save();


			return response(json_encode($user->all()->toArray()), 200);

		}catch (Exception $e){

			return response(json_encode($e) , 500);
		}
	}

	public function show($id)
	{
		return User::findOrFail($id);
	}

	public function update(Request $request , $id)
	{
		$validator = $this->getValidator($request->all());

		if($validator->fails()){
			return response($validator->getMessageBag() , 400);
		}


		$user = User::find($id);

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
		return User::destroy($id);
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
				'name' => ['required','string','max:255'],
				'surname' => ['required','string','max:255'],
				'email' => ['required','unique:users' , 'email' ,'max:255'],
				'password' => ['required' , 'min:8' , 'max:16']
			];
			break;
		case "update":
			$rules = [
				'name' => ['string','max:255'],
				'surname' => ['string','max:255'],
				'email' => ['unique:users' , 'email' ,'max:255'],
				'password' => ['min:8' , 'max:16']
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
