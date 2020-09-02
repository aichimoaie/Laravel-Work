<?php

use Illuminate\Database\Seeder;
use App\Quiz;

class QuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payload=array(
            // "quiz" => array(
            //     "Id" => 2,
            //     "name" => "C# and .Net Framework",
            //     "description" => "C# and .Net Quiz (contains C#, .Net Framework, Linq, etc.)"
            // ),
            // "config" => array(
            //     "shuffleQuestions" => true,
            //     "showPager" => false,
            //     "allowBack" => true,
            //     "autoMove" => true
            // ),
          array(
                "Id" => 1010,
                "Name" => "Which of the following assemblies can be stored in Global Assembly Cache?", 
                "QuestionTypeId" => 1,
                "Options" => array(
                    array( "Id" =>  1056, "QuestionId" => 1010, "Name" => "Private Assemblies", "IsAnswer"=> false ),
                    array( "Id" =>  1057, "QuestionId" => 1010, "Name" => "Private Assemblies", "IsAnswer"=> false ),
                    array( "Id" =>  1058, "QuestionId" => 1010, "Name" => "Private Assemblies", "IsAnswer"=> false ),
                    array( "Id" =>  1059, "QuestionId" => 1010, "Name" => "Private Assemblies", "IsAnswer"=> false )),
                "QuestionType" => array( "Id" => 1, "Name" => "Multiple Choice", "IsActive"=> true )
          ),
          array(
                "Id" => 1011,
                "Name" => "Which of the following assemblies can be stored in Global Assembly Cache?", 
                "QuestionTypeId" => 1,
                "Options" => array(
                    array( "Id" =>  1056, "QuestionId" => 1011, "Name" => "Private Assemblies", "IsAnswer"=> false ),
                    array( "Id" =>  1057, "QuestionId" => 1011, "Name" => "Private Assemblies", "IsAnswer"=> false ),
                    array( "Id" =>  1058, "QuestionId" => 1011, "Name" => "Private Assemblies", "IsAnswer"=> false ),
                    array( "Id" =>  1059, "QuestionId" => 1011, "Name" => "Private Assemblies", "IsAnswer"=> false )),
                "QuestionType" => array( "Id" => 1, "Name" => "Multiple Choice", "IsActive"=> true )
        ));

        // Quiz::create([
        //    'payLoad' =>json_encode($payload)
        // ]);

        $config=array(  "shuffleQuestions"=> true,
        "showPager"=> false,
        "allowBack"=> true,
        "autoMove"=> true);

        $quiz = new Quiz([
            'payLoad' => $payload,
            'name' => 'Invatam impreuna',
            'description' => 'Invatam impreuna sa descriem emotie',
            'config' => $config,
            //'user_id' => Auth->user('id')
        ]);
        
        $quiz->save();
    }
}
