@extends('layouts.app')

<style>
    .search-form {
        padding: 10px;
        font-size: medium;
    }

    .search {
        width: 300px;
        /* Adjust as needed */
        height: 10px;
        /* Adjust as needed */
        padding: 10px 10px 10px 10px;
        /* Increase padding for more space inside */
        font-size: 18px;
    }

    .search-icon {
        width: 50px;
        height: 35px;
        padding: 3px 3px 3px 3px;
        font-size: 18px;
    }

    .filterbycat {
        width: 300px;
        /* Adjust as needed */
        height: 32px;
        /* Adjust as needed */
        padding: 5px 5px 5px 5px;
        /* Increase padding for more space inside */
        font-size: 18px;
    }

    .reset-btn {
        width: 100px;
        height: 38px;
        padding: 10px 10px 10px 10px;
        font-size: 18px;
    }

    body {
        /* background-color: #a9a9b2ff; */
        min-height: 100vh;
    }

    .cart-container {
        /* display: flex; */
        flex-wrap: wrap;
        max-width: 950px;
        margin: 20px auto;
        gap: 2rem;
        padding: 0.2rem;
        padding-top: 0px;
    }

    .cart-items {
        flex: 2;
        /* Takes up more space */
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .product-in-cart {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.8rem;
        border: 1px solid #eee;
        border-radius: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        background-color: #fff;
        transition: box-shadow 0.3s ease;
    }

    .product-in-cart:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        width: 130px;
        height: 180px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 1rem;
    }

    .product-details {
        flex-grow: 1;
        margin-left: 25px;
    }

    .product-title {
        font-size: 24px;
        /* margin: 0 0.2rem 0.2rem 0; */
        color: #333;
    }

    .product-id {
        font-size: 15px;
        color: #777;
        margin: 0;
    }

    .product-description {
        font-size: 17px;
        color: #777;
        margin: 0;
    }

    .product-price {
        font-weight: bold;
        color: #000;
    }

    .quantity-select {
        width: 60px;
        padding: 0.4rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .item-total {
        font-weight: bold;
        margin-left: 2rem;
        margin-right: 3rem;
        color: #000;
        min-width: 70px;
        text-align: right;
    }

    .remove-item {
        background: none;
        border: 2px solid red;
        color: #e10000ff;
        cursor: pointer;
        font-size: 20px;
        margin-left: 3rem;
        margin-right: 2rem;
        padding-left: 5px;
        padding-right: 5px;
    }

    .remove-item:hover {
        color: #fff9f9ff;
        /* background-color: #000; */
        background-color: #e10000ff;
        ;
    }

    .detailtext {
        color: blue;
    }

    /* Cart Summary Styles */
    .cart-summary {
        flex: 1;
        /* Takes up remaining space */
        /* background-color: #f9f9f9ff; */
        padding: 1.5rem;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        height: fit-content;
    }

    .cart-summary h2 {
        margin-top: 0;
        /* color: #333; */
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
        font-size: 20px;
        font-weight: bold;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        margin-top: 0.5rem;
        font-size: 18px;
    }

    .total-row {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #ddd;
        font-size: 20px;
        font-weight: bold;
    }

    .grand-total-value {
        display: block;
        font-size: 30px;
        color: #000;
        background-color: #dedbdbff;
    }

    .checkout-button {
        width: 100%;
        padding: 0.8rem;
        background-color: #000;
        /* background-color: #ffed94; */
        color: #fff;
        /* color: #000; */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        margin-top: 1rem;
        transition: background-color 0.3s ease;
    }

    .checkout-button a {
        width: 100%;
        padding: 0.8rem;
        background-color: #000;
        /* background-color: #ffed94; */
        color: #fff;
        /* color: #000; */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        margin-top: 1rem;
        transition: background-color 0.3s ease;
    }

    .checkout-button:hover {
        background-color: #333;
    }

    .btn {
        background: linear-gradient(45deg, #18181B, #27272A);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 8px 15px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: .3s;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .1);
        margin-right: 5rem;
    }

    .btn:hover {
        background: linear-gradient(45deg, #27272A, #3F3F46);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, .15)
    }

    .btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .1), transparent);
        transition: .5s
    }

    .btn:hover:before {
        left: 100%
    }

    .icon {
        transition: transform .3s
    }

    .btn:hover .icon {
        transform: rotate(-10deg) scale(1.1)
    }

    .active .minus,
    .active .plus {
        background: #444;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;

    }

    .active .minus:hover,
    .active .plus:hover {
        background: #666;
    }

    /* ADDRESS SECTION – styled exactly like cart summary */
    /* WHOLE ADDRESS SECTION – one big white container */
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

    /*       for swipe*/
    .img-gallery {
        position: relative;
        width: 100%;
        max-width: 130px;
        /* Adjust based on your layout */
        /* margin: auto; */
        overflow: hidden;
    }

    .img-container {
        display: flex;
        transition: transform 0.3s ease-in-out;
    }

    .img-item {
        width: 100%;
        flex-shrink: 0;
        /* Prevent shrinking */
    }

    .img-item img {
        /* width: 100%; */
        height: 150px;
        width: 130px;
        /* Set a fixed height or use auto depending on your design */
        object-fit: cover;
    }

    .prev-btn,
    .next-btn {
        position: absolute;
        top: 35%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.2);
        color: white;
        font-size: 10px;
        border: none;
        padding: 3px;
        cursor: pointer;
        z-index: 10;
        margin: 5px;
        margin-top: 10px;
    }

    .prev-btn {
        left: 4px;
    }

    .next-btn {
        right: 4px;
    }

    /* Optional: Add hover effect on buttons */
    .prev-btn:hover,
    .next-btn:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .img-gallery {
        position: relative;
        overflow: hidden;
    }

    .img-container {
        display: flex;
        transition: transform 0.3s ease-in-out;
    }

    .img-item {
        min-width: 100%;
    }

    .prev-btn:disabled,
    .next-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
        pointer-events: none;
    }

    .badge-2 {
        color: #56b409ff;
        font-size: 15px;

    }

    .rate_avg {
        color: #ef4444;
        font-size: 14px;

    }

    .warning {
        color: #ef4444;
        display: block;
    }

    .addprodlink {
        color: blue;
    }

    .warnbox {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-top: 150px;
        font-size: 20px;
    }

    .warnbox h2 {
        font-size: 25px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .cart-container {
            flex-direction: column;
        }

        .product-in-cart {
            flex-wrap: wrap;
        }

        .product-details {
            margin-bottom: 0.5rem;
        }

        .quantity-control,
        .item-total,
        .remove-item {
            margin-top: 0.5rem;
        }

        .address-section {
            padding: 1rem;
        }
    }
</style>

@section('content')

@if($cart && $cart->products->count() > 0)
<div class="cart-container">
    @php
    $subtotal = 0;
    $shipping = 10;
    @endphp

    @foreach($cart->products as $product)

    @php
    $qtyInCart = $product->pivot->qty;
    $offer = round((($product->p_price - $product->p_offerprice) / $product->p_price) * 100,2);

    $item_total = $product->pivot->qty * $product->p_offerprice;
    $subtotal += $item_total;

    $grandTotal = $subtotal + $shipping;

    @endphp

    <div class='cart-items'>
        <div class='product-in-cart'>

            <!-- {{-- Wishlist toggle --}}
                <form action="{{ route('user.wishlist.toggle', ['p_id' => $product->p_id]) }}" method="post">
                    @csrf
                    <button type="submit">
                        <div class='badge-1 wishlist-toggle heart-icon'>
                            {{ in_array($product->p_id, $wishlist) ? '❤️' : '🤍' }}
                        </div>
                    </button>
                </form> -->

            {{-- Image gallery --}}
            <div class="img-gallery">
                <div class="img-container">
                    @foreach($product->images->take(5) as $image)
                    <div class="img-item">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->p_id }} class='product-immage'">
                    </div>
                    @endforeach
                </div>
                <button class="prev-btn">&#10094;</button>
                <button class="next-btn">&#10095;</button>
            </div>

            <div class='product-details'>
                <h4 class='product-title'>{{ $product->p_name }}</h4>
                <p class='product-id'>p_id: {{ $product->p_id }}</p>
                <!-- <p class='product-description'>{{ $product->p_desc }}</p> -->
                <div class="badge-2">Offer: {{ $offer }}% OFF</div>
                <span class='product-price'>Purchased Price: ₹{{ (int)$product->p_offerprice }}</span>
                <div class='rate_avg'><span></span></div>
                <button class='detailtext'>
                    <a href="{{ route('user.products.details', ['p_id' => $product->p_id, 'cat_id' => $product->cat_id]) }}">Details</a>
                </button>
            </div>

            <div class='bottom'>
                <div class='btn quantity add-to-cart active quantity-box'
                    data-qty="{{ $qtyInCart }}"
                    data-product="{{ $product->p_id }}"
                    data-price="{{ $product->p_offerprice }}">
                    <button class='minus'>−</button>
                    <span class='count'>{{ $qtyInCart }}</span>
                    <button class='plus'>+</button>
                </div>
            </div>

            <div class='meta'></div>
            <div class='item-total'>₹{{ (int)$product->p_offerprice }}</div>
            <button id='removefromcart' class='remove-item' data-p_id="{{ $product->p_id }}" data-price="{{ $product->p_offerprice }}">×</button>
        </div>

    </div>
    @endforeach

    <div class="address-section">

        <h2 class='address-summary'>Select Delivery Address:</h2>
        <a href="{{ route('user.cart.addressform') }}" class='address-summary'>
            <button class='add-address-btn'>✚ Add New Address</button>
        </a>


        @if(auth()->user()->addresses->count())
        @foreach(auth()->user()->addresses as $address)
        <div class="address-box">
            <input type="radio"
                name="selected_address"
                value="{{ $address->add_id }}"
                required>

            <label class="address-label">
                {{ $address->name }},
                {{ $address->address }},
                {{ $address->city }},
                {{ $address->state }} - {{ $address->pincode }}
            </label>
        </div>
        @endforeach
        @else
        <p class="warning">No Address found.</p>
        @endif


    </div>

    <div class='cart-container'>
        <div class='cart-summary'>
            <h2>Cart Totals</h2>
            <div class='summary-row'>
                <span>Subtotal</span>
                <span class='subtotal-value'> ₹{{ $subtotal }}</span>
            </div>
            <div class='summary-row'>
                <span>Shipping</span>
                <span>₹{{ $shipping }}</span>
            </div>
            <div class='summary-row total-row'>
                <span>Total</span>
                <span class='grand-total-value' data-grand_total="{{ $grandTotal }}">₹{{ $grandTotal }}</span>
            </div>
            <button class='checkout-button proceed-order'>Place Order</button>
            <button class='checkout-button'><a href="{{ route('user.products.products') }}">Back to Products</a></button>
        </div>
    </div>
</div>


@else
<div class="warnbox">
    <h2>No products in cart. </h2>
    <p>please click here to
        <a href="{{ route('user.products.products') }}" class="addprodlink">add products</a>
    </p>
</div>
@endif

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.img-gallery')
            .forEach(gallery => {

                const container = gallery.querySelector('.img-container');
                const images = gallery.querySelectorAll('.img-item');
                const prevBtn = gallery.querySelector('.prev-btn');
                const nextBtn = gallery.querySelector('.next-btn');

                let currentIndex = 0;
                const totalImages = images.length;

                function updatePosition() {
                    container.style.transform = `translateX(-${currentIndex * 100}%)`;
                    updateButtons();
                }

                function updateButtons() {
                    // Disable prev on first image
                    prevBtn.disabled = currentIndex === 0;
                    // Disable next on last image
                    nextBtn.disabled = currentIndex === totalImages - 1;
                }

                prevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updatePosition();
                    }
                });

                nextBtn.addEventListener('click', () => {
                    if (currentIndex < totalImages - 1) {
                        currentIndex++;
                        updatePosition();
                    }
                });


                updateButtons();
            });

    });
</script>

<script>
    $(document).on('click', '.plus, .minus', function(e) {
        e.stopPropagation();

        let box = $(this).closest('.quantity-box');
        let productId = box.data('product');
        let price = box.data('price');
        let countqty = box.find('.count');
        let qty = parseInt(countqty.text());

        if ($(this).hasClass('plus')) {
            qty++;
        } else {
            qty--;
        }

        if (qty <= 0) {
            window.location.reload();
            updateCart(productId, 0, price);
            box.removeClass('active quantity-box')
                .addClass('add-to-cart')
                .html('Add to cart');
            return;
        }

        countqty.text(qty);
        updateCart(productId, qty, price);
        updateTotals();

        function updateTotals() {
            let subtotal = 0;

            $(".product-in-cart").each(function() {
                let price = parseFloat($(this).find(".quantity-box").data("price"));
                let qty = parseInt($(this).find(".count").text());
                subtotal += price * qty;
            });

            let shipping = 10;
            let grandTotal = subtotal + shipping;

            $(".subtotal-value").text(subtotal + "/-");
            $(".grand-total-value").text(grandTotal + "/-");
        }
    });

    function updateCart(productId, qty, price) {

        $.ajax({
            url: "{{ route('user.cart.cart.update') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                p_id: productId,
                qty: qty,
                price_at_purchase: price
            },
            success: function(res) {
                console.log("Quantity updated in addtocart:", res);
            },
            error: function(xhr, status, error) {
                console.error(' AJAX Error:', error);
                console.log("inside error");
                console.log('Server response text:', xhr.responseText);
            }

        })

    }
</script>

<script>
    // remove item code for count = 0 
    $(document).on('click', '.remove-item', function() {
        //document.getElementById('removefromcart').onclick = function() {
        alert('are u sure to remove this item from cart???!');


        const cart = $(this);

        let productId = cart.data('p_id');
        let price = cart.data('price');
        console.log("after data price");
        // let countqty = cart.find('.count');
        // let qty = parseInt(countqty.text());
        let qty = 0;

        updateCart(productId, qty, price);

        function updateCart(productId, qty, price) {

            $.ajax({
                url: "{{ route('user.cart.cart.update') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    p_id: productId,
                    qty: 0,
                    price_at_purchase: price
                },
                success: function(res) {
                    console.log("Quantity removed from cart:", res);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(' AJAX Error:', error);
                    console.log("inside error");
                    console.log('Server response text:', xhr.responseText);
                }
            })
        }
    });
</script>

<script>
    $(document).on('click', '.proceed-order', function() {

        let address_id = $("input[name='selected_address']:checked").val();

        if (!address_id) {
            alert("Please select an address!");
            return;
        }

        let grand_total = $(".grand-total-value").text();
        if (grand_total <= 10) {
            alert("Please select atleastt one item to order!");
            return;
        }

        $.ajax({
            url: "{{ route('user.orders.orders.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                add_id: address_id,
                grand_total: grand_total
            },
            success: function(res) {
                console.log(res);
                alert("Order placed successfully!");

                setTimeout(function() {
                    window.location.href = "{{ route('user.orders.orders') }}";
                }, 500);
            },
            error: function(err) {
                console.log(err);
                alert("Error in placing order!");
            }
        });
    });
</script>