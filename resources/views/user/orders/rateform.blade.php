@extends('layouts.app')

<style>
    body {
        background-color: #f2f2f7;
        font-family: Arial, sans-serif;
    }

    form {
        width: 600px;
        margin: 20px auto;
        border: 1px solid black;
        padding: 20px;
    }

    .title {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ffaa18ff;
        font-size: 22px;
    }

    label {
        font-weight: bold;
    }
</style>

@section('content')




<form action="{{ route('user.orders.rateform', ['p_id' => $p_id, 'order' => $order_id]) }}" method="POST">
    @csrf

    <div class="rating-container">
        <h1 class="title">SUBMIT RATE & REVIEW</h1>
        <br>
        <input type="hidden" name="order_id" value="{{ $order_id }}">
        <input type="hidden" name="p_id" value="{{ $p_id }}">
        <p>Product ID: {{ $p_id }}</p>
        <p>Order ID: {{ $order_id }}</p>
        <br>
        <label>Overall Rating: *</label>
        @php
        // Determine the current rating value to check against
        $currentRating = $ratings->rates ?? null;
        @endphp
        <br>
        <input type="radio" id="star5" name="rates" value="5" {{ $currentRating == 5 ? 'checked' : '' }} required /><label for="star5" title="4 stars">★★★★★</label>
        <br>
        <input type="radio" id="star4" name="rates" value="4" {{ $currentRating == 4 ? 'checked' : '' }} required /><label for="star4" title="4 stars">★★★★</label>
        <br>
        <input type="radio" id="star3" name="rates" value="3" {{ $currentRating == 3 ? 'checked' : '' }} required /><label for="star3" title="3 stars">★★★</label>
        <br>
        <input type="radio" id="star2" name="rates" value="2" {{ $currentRating == 2 ? 'checked' : '' }} required /><label for="star2" title="2 stars">★★</label>
        <br>
        <input type="radio" id="star1" name="rates" value="1" {{ $currentRating == 1 ? 'checked' : '' }} required /><label for="star1" title="1 star">★</label>
        <br>
    </div>
    <br>
    <label>Your Review:</label>
    <br>
    <textarea id="review" name="review" rows="4" placeholder="Share details of your experience...">{{ $ratings->review ?? ' ' }}</textarea>
    <br><br>
    <button type="submit" name="submit">Submit Review</button>
    <br>
</form>




@endsection