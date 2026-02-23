<style>
    .address-section {
        max-width: 1200px;
        margin: 20px auto;
        padding: 1.5rem;
        background-color: #ffffff;
        /* White background like a card */
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* Title */
    .address-section h2 {
        margin-top: 0;
        color: #333;
        font-size: 20px;
        font-weight: bold;
        border-bottom: 1px solid #eee;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }

    /* Add address button */
    .add-address-btn {
        display: inline-block;
        padding: 10px 18px;
        background-color: #000;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 15px;
        transition: 0.3s ease;
    }

    .add-address-btn:hover {
        background-color: #333;
    }

    /* Each address card */
    .address-box {
        display: flex;
        align-items: flex-start;
        background: #f9f9f9;
        border: 1px solid #e6e6e6;
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 12px;
        gap: 10px;
        transition: 0.2s ease;
    }

    .address-box:hover {
        background: #f2f2f2;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
    }

    /* Radio button */
    .address-box input[type="radio"] {
        transform: scale(1.2);
        cursor: pointer;
        margin-top: 4px;
    }

    /* Label */
    .address-label {
        cursor: pointer;
        line-height: 1.45;
        color: #333;
        font-size: 16px;
    }

    .action {
        margin-left: 500px;
        /* position: fixed; */
        color: blue;
        /* gap: 100px; */
        margin-bottom: -30px;

    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Addresses') }}
        </h2>
    </x-slot>

    <div class="address-section">

        <h2 class='address-summary'>Saved Addresses:</h2>
        <a href="{{ route('address.add_addr.create') }}" class='address-summary'>
            <button class='add-address-btn'>✚ Add New Address</button>
        </a>


        @if(auth()->user()->addresses->count())
        @foreach(auth()->user()->addresses as $address)
        <div class="address-box">
            <input type="hidden"
                name="selected_address"
                value="{{ $address->add_id }}"
                required>

            <label class="address-label">
                name: {{ $address->name }},
                <br>
                phone: {{ $address->mobile }},
                <br>
                type: {{ $address->add_type }},
                <br>
                address: {{ $address->address }},
                <br>
                city: {{ $address->city }},
                <br>
                state: {{ $address->state }} - pincode: {{ $address->pincode }}
            </label>
            <div class="action">
                <a href=" {{ route('address.edit_addr', ['add_id' => $address->add_id]) }}">Edit</a>
                <a>
                    <form action="{{ route('address.destroy', $address->add_id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this address?');" class="dlt">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </a>
            </div>
        </div>
        @endforeach
        @else
        <p class="warning">No Address found.</p>
        @endif


    </div>

</x-app-layout>