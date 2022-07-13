<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Survey extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'title' => $this->title,
            'start_date' => $this->start_date->format('d/m/Y - H:i'),
            'end_date' => $this->end_date->format('d/m/Y - H:i'),
        ];
    }
}
