<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Rfc4122\UuidV4;

class CategoryController extends Controller
{
	public function index()
	{
		return Category::all();
	}

	public function create(Request $request)
	{
		$validator = $this->getValidator($request->all());


		if($validator->fails()){
			return response($validator->getMessageBag(), 400);
		}

		try{

			$category = new Category();

			$category->fill([
				'id' => UuidV4::uuid4()->toString(),
				'name' => $request->name,
				'description' => $request->surname,
			])->save();


			return response(json_encode($category->all()->toArray()), 200);

		}catch (Exception $e){

			return response(json_encode($e) , 500);
		}
	}

	public function show($id)
	{
		return Category::findOrFail($id);
	}

	public function update(Request $request , $id)
	{
		$validator = $this->getValidator($request->all());

		if($validator->fails()){
			return response($validator->getMessageBag() , 400);
		}

		$category = Category::find($id);

		if( ! $category){
			return response(json_encode("Category doesn't exists" , 400));
		}

		try{

			$category->update($request->all());
			$category->save;

		} catch(Exception $e) {
			return response(json_encode($e) , 500);
		}
	}

	public function destroy( $id)
	{
		return Category::destroy($id);
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
				'description' => ['required' , 'max:255' ]
			];
			break;
		case "update":
			$rules = [
				'name' => ['string','max:255'],
				'description' => ['max:255' ]
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
