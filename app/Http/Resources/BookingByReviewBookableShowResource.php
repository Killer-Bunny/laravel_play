<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingByReviewBookableShowResource extends JsonResource
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
          'bookable_id' => $this->id,
          'from' => $this->from,
          'to' => $this->to,
          'description' => $this->description,
          'title' => $this->title
        ];
    }
}
