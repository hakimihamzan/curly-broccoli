<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// this is the cmd
// php artisan make:resource CategoryResource
// is used to transform json resource into format we like

class CategoryResource extends JsonResource
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
            'name' => $this->name,
            // 'name_transformed' => "My name is " . $this->name,
        ];
    }
}
