<?php

namespace App\Http\Controllers\API\Quizzes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Quiz;
use App\Http\Resources\QuizResource;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        //aici trebuie pt fiecare user creator facut ceva
        //$this->authorize('view_quizz_content', User::class);
        $quizzes = Quiz::all();
        return response([ 'quizzes' => QuizResource::collection($quizzes), 'message' => 'Retrieved successfully'], 200);
   
    }

    public function store(Request $request){
        //$data = json_encode($request->get('payLoad'));
        
        
       // Quiz::create($request->get('payLoad'));

        $quiz = new Quiz([
            'payLoad' => $request->get('payLoad'),
            'name' => $request->get('Name'),
            'description' => $request->get('Description'),
            'config' => $request->get('Config'),
            //'user_id' => Auth->user('id')
        ]);
        
        $quiz->save();
        
        return response()->json([
            'message' => 'Successfully created quiz!'
        ], 201);
    }

    public function list()
    {
        $quizzes = Quiz::all('id');
        return response()->json([
            'quizzes' => $quizzes
        ], 201);
    }

}
