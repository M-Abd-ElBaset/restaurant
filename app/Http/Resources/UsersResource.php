<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'attributes'=>[
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>$this->password,
                'birth_date'=>$this->birth_date,
                'phone_number'=>$this->phone_number,
                'created_at'=>$this->created_at,
                'updated_at'=>$this->updated_at,
            ]
        ];
    }
}
