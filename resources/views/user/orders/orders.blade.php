@extends('layouts.app')


<style>
    body {
        background-color: #f2f2f7;
        font-family: Arial, sans-serif;
    }

    .filter_container {
        /* margin-left: 190px; */
        padding: 0px 8px;
        padding-top: 16px;
        max-width: 1200px;
        margin: 20px auto;
        padding: 10px;
    }

    .main_container {
        max-width: 1200px;
        /* margin: 30px auto; */
        padding: 10px;
        margin-top: 80px;
        margin-left: 100px;
        margin-right: 100px;
    }

    .order-box {
        background: white;
        border-radius: 10px;
        padding: 18px 20px;
        margin-bottom: 25px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid #9f9c9cff;
        font-size: 20px;
        font-weight: bold;
        /* width: 1000px; */
    }

    .order-header {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        /* padding-bottom: 15px; */
        border-bottom: 1px solid #ddd;
        margin-bottom: 18px;
        gap: 30px;
        font-size: 20px;
        font-weight: bold;
        /* background-color: #d6d4d4ff; */
        background-color: #d6dae2ff;
        /* background-color: #f2f2f7; */
        padding-top: 15px;
        padding-left: 15px;
        /* width: 1000px; */
    }

    .order-header div {
        font-size: 14px;
        border: #333;
        border-radius: 2px solid black;
    }

    .order-header label {
        font-weight: 600;
        color: #333;
        font-size: 18px;
        border: #333;
        border-radius: 2px solid black;
    }

    .product-row {
        display: flex;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        margin-left: 35px;
    }

    .product-row:last-child {
        border-bottom: none;
    }

    .product-row img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .product-info {
        flex: 1;
    }

    .product-info .p-name {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .product-info .p-desc {
        font-size: 13px;
        color: #878383ff;
    }

    .product-info .p-price {
        font-size: 13px;
        padding-top: 18px;
    }

    .product-info .p-qty {
        font-size: 13px;
    }

    .value {
        color: red;
        background-color: #d6dae2ff;
        font-size: 18px;
    }

    .rate-review-button {
        /* background-color: #f3df44ff; */
        background-color: #ffe100ff;
        /* Blue background */
        color: black;
        /* White text */
        padding: 10px 20px;
        /* Padding inside the button */
        border: none;
        /* No border */
        border-radius: 5px;
        /* Rounded corners */
        font-size: 16px;
        /* Font size */
        cursor: pointer;
        /* Pointer cursor on hover */
        transition: background-color 0.3s ease;
        /* Smooth transition for background color */
    }

    .rate-review-button:hover {
        background-color: #ffaa18ff;
        color: red;
    }

    .rate-review-button:active {
        background-color: #ffaa18ff;
        color: red;
        /* Even darker blue when clicked */
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

    .addprodlink {
        color: blue;
    }

    .detailtext {
        color: blue;
        font-size: 15px;
        margin-top: 30px;
        font-weight: 400;
    }

    .date-form {
        margin-top: 15px;
        margin-bottom: -80px;
        display: block;
        padding: 0.5em 1em;
        /* border: 5px solid #999999; */
        border: 0.05px solid #999999;
        border-radius: 0.1em;
        text-decoration: none;
        /* background-color: #18181B; */
        /* color: white; */
        margin-left: 300px;
        margin-right: 300px;

    }

    .date-form {
        padding: 10px;
        font-size: medium;
    }

    .filter-btn {
        color: blue;
        font-size: 20px;
        margin-left: 15px;
        margin-right: 15px;
    }

    .reset-btn {
        display: block;
        font-size: 18px;
        margin-left: 15px;
        margin-right: 15px;
        border: 1px solid #999999;
        border-radius: 1px;
        padding: 5px;

    }

    .pagination {
        display: flex;
        display: block;
        justify-content: center;
        text-align: center;
        border-radius: 2px solid black;
        /* padding: 10px; */
        font-size: larger;
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        /* padding-bottom: 30px; */
        margin-top: 20px;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 50px;
        margin-right: 200px;
    }

    .pagination a {
        /* display: block; */
        padding: 0.5em 1em;
        /* border: 5px solid #999999; */
        border: 1px solid black;
        border-radius: 0.2em;
        text-decoration: none;
        /* background-color: #18181B;
        color: white; */
        font-size: 20px;
        /* margin-left: 200px; */
    }

    .pagination p {
        color: black;
        margin-left: 200px;
        font-size: 20px;
    }

    .pagination a.active {
        font-weight: bold;
        color: red;
    }
</style>

@section('content')
<div>

    <form action="{{ route('user.orders.orders') }}" method="GET" class="date-form">
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">


        <label for="to_date"> & To Date:</label>
        <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">

        <button type="submit" class="filter-btn">Filter</button>
        <button><a href="?" class="reset-btn">RESET</a></button>
    </form>


    <div class="main_container">
        @if($orders->count() > 0)

        @foreach ($orders as $order)
        <div class='order-box'>
            <div class='order-header'>
                <div>
                    <label>ORDER DATE</label><br>
                    <p class='value'>{{ $order->order_date }}</p>
                </div>
                <div>
                    <label>PLACED DATE</label><br>
                    <p class='value'>{{ $order->order_placed_date }}</p>
                </div>
                <div>
                    <label>GRAND TOTAL</label><br>
                    <p class='value'> ₹ {{ $order->grand_total }} /-</p>
                </div>
                <div>
                    <label class='status'>ORDER STATUS</label><br>
                    <p class='value'>● {{ $order->order_status }}</p>
                </div>
                <div>
                    <label>ORDER ID</label><br>
                    <p class='value'>#{{ $order->order_id }}</p>
                </div>
            </div>

            @foreach ($order->orderItems as $item)
            <div class='product-row'>
                <div class="img-gallery">
                    <div class="img-container">
                        @foreach ($item->product->images->take(5) as $image)
                        <div class="img-item">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $item->product->p_id }}">
                        </div>
                        @endforeach
                    </div>

                    <button class="prev-btn">&#10094;</button>
                    <button class="next-btn">&#10095;</button>
                </div>
                <div class='product-info'>
                    <input type='hidden' name='product_id' value='{{ $item->p_id }}'>
                    <input type='hidden' name='order_id' value='{{ $order->order_id }}'>

                    <div class='p-name'>{{ $item->product->p_name }}</div>
                    <div class='p-price'>Purchased_price: ₹{{ $item->price }}</div>
                    <div class='p-qty'>Quantity: {{ $item->qty }}</div>
                    <button class='detailtext'><a href="{{ route('user.products.details', ['p_id' => $item->product->p_id, 'cat_id' => $item->product->cat_id]) }}">Details</a></button>

                </div>

                @if ($order->order_status === \App\Enums\OrderStatus::delivered)

                <div class='rightside-btn'>
                    <a class='rate-review-button'
                        data-p_id='{{ $item->p_id }}'
                        data-order_id='{{ $order->order_id }}'
                        href="{{ route('user.orders.rateform', ['p_id' => $item->p_id, 'order' => $order->order_id]) }}">
                        ★ Rate & Review Product
                    </a>
                </div>



                @else
                <!-- <p>
                    {{ $order->order_status }}
                </p> -->
                <!-- <span class="text-muted">Review available after delivery</span> -->
                <div class='rightside-btn'>
                    <a href=''></a>

                </div>
                @endif


            </div>

            @endforeach

        </div>



        @endforeach
        @else
        <div class="warnbox">
            <h2>No orders found. </h2>
            <p>please click here to make ypur first order
                <a href="{{ route('user.products.products') }}" class="addprodlink">add products</a>
            </p>
        </div>
        @endif
    </div>
    <div class="pagination">
        {!! $orders->links() !!}
    </div>


    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script>
        $(function() {
            $("#from_date, #to_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

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
        $(document).on('click', '.rate-review-button', function() {
            // const product = $(this);
            let p_id = $(this).data("p_id");
            let order_id = $(this).data("order_id");

            $.ajax({
                url: "{{ route('user.orders.rateform', ['p_id' => $item->p_id, 'order' => $order->order_id]) }}",
                type: "POST",
                data: {
                    order_id: order_id,
                    p_id: p_id
                },
                success: function(response) {
                    //alert("jump to rate page Successfully!");
                    // window.location.href = 'rating_form.php?';
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(' AJAX Error:', error);
                    console.log("inside error");
                    console.log('Server response text:', xhr.responseText);
                }
            });
        });
    </script>