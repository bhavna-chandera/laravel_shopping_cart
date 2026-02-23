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

<form action="{{ route('address.add_addr.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>DELIVERY ADDRESS</h1>
    <br>
    <label>Name:</label>
    <input type="text" name="name" required>
    <br>
    <label>Mobile Number (India +91):</label>
    <input
        type="tel"
        id="mobileNumber"
        name="mobile"
        placeholder="+91-XXXXXXXXXX"
        pattern="^\+91-\d{10}$"
        title="Please enter a valid Indian mobile number starting with +91- followed by 10 digits."
        required />
    <br>
    <label for="pincode">Pincode:</label>
    <input type="text" id="pincode" name="pincode" maxlength="6" pattern="\d{6}" inputmode="numeric" title="Please enter a 6-digit pincode" required>
    <br>
    <label>Address(Area and street):</label>
    <textarea name="address" required></textarea>
    <br>
    <label>City/Town name:</label>
    <input type="text" name="city" required>
    <br>
    <label>Landmark (optional):</label>
    <input type="text" name="landmark" placeholder="eg. near zzz hospital">
    <br>
    <label>Alternate Phone Number (optional):</label>
    <input
        type="tel"
        id="mobileNumber"
        name="mobile_alternate"
        placeholder="+91-XXXXXXXXXX"
        pattern="^\+91-\d{10}$"
        title="Please enter a valid Indian mobile number starting with +91- followed by 10 digits." />
    <br>
    <label>State:</label>
    <select name="state" required>
        <option value="">Select State</option>
        <option value="Gujarat">Gujarat</option>
        <option value="Himachal Pradesh">Himachal Pradesh</option>
        <option value="Madhy Pradesh">Madhya Pradesh</option>
        <option value="Patna">Patna</option>
        <option value="UP">UP</option>
        <option value="Bihar">Bihar</option>
    </select>
    <br>

    <!-- <label>Address type:</label>
    <select name="" id="" required>
        <option type="radio" value="home"> Home</option>
        <option type="radio" value="office"> Office</option>
    </select> -->
    <label>Select Address Type:</label>

    <div>
        <input type="radio" name="add_type" id="home" value="{{ \App\Enums\AddType::home->value }}" {{ (old('AddType') == \App\Enums\AddType::home->value) ? 'checked' : '' }} required>
        <label for="home">home</label>
    </div>

    <div>
        <input type="radio" name="add_type" id="office" value="{{ \App\Enums\AddType::office->value }}" {{ (old('AddType') == \App\Enums\AddType::office->value) ? 'checked' : '' }}>
        <label for="office">office</label>
    </div>

    @error('add_type')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br>
    <button type="submit" name="submit" class="proceed-order">Add address</button>
    <button><a href="{{ route('address.addr') }}">CANCEL</a></button>
</form>

@endsection