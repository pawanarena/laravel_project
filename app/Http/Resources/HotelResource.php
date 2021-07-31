<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
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
            'id' => $this->id,
            'county' => $this->county,
            'country' => $this->country,
            'town' => $this->town,
            'description' => $this->description,
            'displayable_address' => $this->displayable_address,
            'image' => asset('storage/images/' .$this->image),
            'thumbnail' => asset('storage/images/' .$this->thumbnail),
            'number_of_bedrooms' => $this->number_of_bedrooms,
            'number_of_bathrooms' => $this->number_of_bathrooms,
            'price' => $this->price,
            'property_type' => $this->property_type,
            'rent_or_sale' => $this->property_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
