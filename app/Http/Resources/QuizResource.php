<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
           'quiz'=>[
            'Id' => $this->id,
            'name' =>$this->name,
            'description'=>$this->description],
            'config'=>$this->config,
            'questions' => $this->payLoad
            
        ];

    }
}
