<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingByReviewResource extends JsonResource
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
          'booking_id' => $this->id,
          'from' => $this->from,
          'to' => $this->to,
          'description' => $this->description,
          'bookable' => new BookingByReviewBookableShowResource($this->bookable),
        ];
    }
}
