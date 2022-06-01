<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class BulletinResource extends JsonResource
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
          'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'general_photo' => $this->general_photo,
            'photos' => BulletinPhotosResource::collection($this->photos),
            'created_at' => $this->created_at,
            'current_page'=> $this->current_page
        ];
    }
}
