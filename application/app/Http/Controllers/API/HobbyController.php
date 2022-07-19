<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Hobby;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HobbyController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() {

        $user = User::where('id', auth()->user()->id)->first();
        $hobby = Hobby::where('user_id', auth()->user()->id)->get();

        return response()->json([
            "msg" => "success!",
            "data" => [
                "user" => $user,
                "hobby" => $hobby
                ]
        ]);
    }

    public function store(Request $request) {
        
        $model = new Hobby();

        foreach ($request->list_hobby as $key => $value) {

            $hobby = array(
            'user_id' => auth()->user()->id,
            'name'  => $value['name'],
            'description' => $value['description']
            );
            $hobbies = Hobby::create($hobby);

        }

        return response()->json(["msg" => "Data success created!"], 201);
    }

    public function update(Request $request, $id) {
        
        $model = Hobby::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        // $model::update([
        $model->name = $request->name;
        $model->description = $request->description;

        $model->save();

        return response()->json(["msg" => "Data successfully updated!"], 201);
    }
}
