<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookingByReviewResource;

class BookingByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $reviewKey)
    {
      $booking = Booking::findByReviewKey($reviewKey);

      return $booking ? new BookingByReviewResource($booking) : abort(404);
    }
}
