@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        /* margin: 30px; */
        /* background-color: #a9a9b2ff; */
        /* min-height: 100vh; */
    }

    form {
        width: 500px;
        margin: 0 auto;
        border: 1px solid black;
        padding: 20px;
        background-color: #d8d8e3ff;
        /* display: flex; */
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        border: 1px solid #eee;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        background-color: #fff;
        transition: box-shadow 0.3s ease;
        margin-top: 30px;
    }

    h1 {
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 1.5rem;
    }

    label {
        display: block;
        margin-bottom: 2px;
        margin-top: 5px;
    }

    input[type="text"],
    select {
        width: 50%;
        padding: 5px;
        margin-bottom: 10px;

        border: 1px solid black;
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin-right: 5px;
    }

    button {
        text-decoration: none;
        color: black;
        border: 1px solid black;
        background: #f0f0f0;
        padding: 5px 10px;
        margin-top: 10px;
        display: inline-block;
    }

    button:hover,
    a:hover {
        background: #ddd;
    }

    /*  */
</style>

<form action="{{ route('address.update_addr', $address->add_id) }}" method="POST">
    @csrf
    @method('PUT')
    <h1>DELIVERY ADDRESS</h1>
    <br>
    <label>Name:</label>
    <input type="text" name="name" value="{{ old('name', $address->name) }}" required>
    <br>
    <label>Mobile Number (India +91):</label>
    <input
        type="tel"
        id="mobileNumber"
        name="mobile"
        placeholder="+91-XXXXXXXXXX"
        pattern="^\+91-\d{10}$"
        title="Please enter a valid Indian mobile number starting with +91- followed by 10 digits."
        value="{{ old('mobile', $address->mobile) }}"
        required />
    <br>
    <label for="pincode">Pincode:</label>
    <input type="text" id="pincode" name="pincode" maxlength="6" pattern="\d{6}" inputmode="numeric" title="Please enter a 6-digit pincode" value="{{ old('pincode', $address->pincode) }}" required>
    <br>
    <label>Address(Area and street):</label>
    <textarea name="address" required>{{ old('address', $address->address) }}</textarea>
    <br>
    <label>City/Town name:</label>
    <input type="text" name="city" value="{{ old('city', $address->city) }}" required>
    <br>
    <label>Landmark (optional):</label>
    <input type="text" name="landmark" placeholder="eg. near zzz hospital" value="{{ old('landmark', $address->landmark) }}">
    <br>
    <label>Alternate Phone Number (optional):</label>
    <input
        type="tel"
        id="mobileNumber"
        name="mobile_alternate"
        placeholder="+91-XXXXXXXXXX"
        pattern="^\+91-\d{10}$"
        title="Please enter a valid Indian mobile number starting with +91- followed by 10 digits."
        value="{{ old('mobile_alternate', $address->mobile_alternate) }}" />
    <br>
    <label for="state">State:</label>
    <select name="state" id="state" required>
        <option value="">Select State</option>

        <option value="Gujarat" @selected(old('state', $address->state) == 'Gujarat')>Gujarat</option>

        <option value="Himachal Pradesh" @selected(old('state', $address->state) == 'Himachal Pradesh')>Himachal Pradesh</option>

        <option value="Madhy Pradesh" @selected(old('state', $address->state) == 'Madhy Pradesh')>Madhy Pradesh</option>

        <option value="Patna" @selected(old('state', $address->state) == 'Patna')>Patna</option>

        <option value="UP" @selected(old('state', $address->state) == 'UP')>UP</option>

        <option value="Bihar" @selected(old('state', $address->state) == 'Bihar')>Bihar</option>
    </select>
    <br>

    <!-- <label>Address type:</label>
    <select name="" id="" required>
        <option type="radio" value="home"> Home</option>
        <option type="radio" value="office"> Office</option>
    </select> -->
    <label>Select Address Type:</label>

    <div>
        <input type="radio" name="add_type" id="home"
            value="{{ \App\Enums\AddType::home->value }}"
            @checked(old('add_type', $address->add_type->value ?? $address->add_type) == \App\Enums\AddType::home->value)
        required>
        <label for="home">Home</label>
    </div>

    <div>
        <input type="radio" name="add_type" id="office"
            value="{{ \App\Enums\AddType::office->value }}"
            @checked(old('add_type', $address->add_type->value ?? $address->add_type) == \App\Enums\AddType::office->value)>
        <label for="office">Office</label>
    </div>

    @error('add_type')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br>
    <button type="submit" name="submit" class="proceed-order">Update</button>
    <button><a href="{{ route('address.addr') }}">CANCEL</a></button>
</form>

@endsection