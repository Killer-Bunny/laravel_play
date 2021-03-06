<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Bookable extends Model
{
    public function bookings()
    {
      return $this->hasMany(Booking::class);
    }

    public function availableFor($from, $to) : bool
    {
      return 0 == $this->bookings()->betweenDates($from, $to)->count();
    }

    public function reviews()
    {
      return $this->hasOne(Review::class);
    }

    public function priceFor($from, $to): array {
      $days = (new Carbon($from))->diffInDays(new Carbon($to)) + 1;
      $price = $days * $this->price;

      return [
        'total' => $price,
        'breakdown' => [
          $this->price => $days
        ]
      ];
    }
}
