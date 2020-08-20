<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\QuoteCollection;

class Character extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'              => $this->name,
            'gang'              => $this->gang ? $this->gang->name : null,
            'gender'            => $this->gender,
            'age'               => $this->age,
            'status'            => $this->status,
            'cause_of_death'    => $this->cause_of_death,
            'date_of_birth'     => $this->date_of_birth,
            'nationality'       => $this->nationality,
            'voiced_by'         => $this->voiced_by,
            'image'             => $this->image,
            'artwork'           => $this->artwork,
            'quotes'            => new QuoteCollection($this->quotes)
        ];
    }
}
