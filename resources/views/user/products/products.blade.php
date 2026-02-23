@extends('layouts.app') {{-- Assuming you have a layout file --}}

<style>
    .search-form {
        padding: 10px;
        font-size: medium;
    }

    .search {
        width: 180px;
        /* Adjust as needed */
        height: 25px;
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
        width: 200px;
        /* Adjust as needed */
        height: 25px;
        /* Adjust as needed */
        padding: 0px 5px 5px 5px;
        /* Increase padding for more space inside */
        font-size: 14px;

    }

    /* .reset-btn { */
    /* width: 100px;
        height: 38px;
        padding: 10px 10px 10px 10px;
        font-size: 18px; */
    /* } */
    .reset-btn {
        width: 100px;
        height: 38px;
        padding: 10px 10px 10px 10px;
        font-size: 18px;
    }

    .reset-btn {
        display: block;
        font-size: 18px;
        margin-left: 15px;
        margin-right: 5px;
        border: 1px solid #999999;
        border-radius: 1px;
        padding: 5px;

    }
    .add-prod-btn {
        /* display: block; */
        font-size: 12px;
        margin-left: 50px;
        /* margin-right: 50px; */
        border: 1px solid #999999;
        border-radius: 1px;
        padding: 5px;
    }

    body {
        background-color: #a9a9b2ff;
        /*min-height: 100vh;*/
    }

    .products_container {
        display: grid;
        /*grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); */
        grid-template-columns: auto auto auto auto;
        /* gap: 20px; */
        /* padding: 10px; */
        /*justify-items: center;
             centers cards horizontally */
        align-items: start;
        margin: 0px;
        font-family: Arial, Helvetica, sans-serif;
        /* margin-top: 20px; */
        grid-gap: 30px;
        padding: 30px;
    }

    .card {
        /*width: 60%; */
        /* Let grid control card width */
        max-width: 360px;
        /* Don’t let it get too big */
        /* width: 360px; */
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
        transition: .3s;
        font-family: 'Segoe UI', sans-serif;
        margin: 0px 0px;
        overflow: hidden;
        position: relative;
        cursor: pointer
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .15)
    }

    .badge-1 {
        position: absolute;
        top: 10px;
        left: 10px;
        color: #fff;
        padding: 5px 10px;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
        z-index: 10
    }

    .badge-2 {
        position: absolute;
        top: 10px;
        right: 10px;
        background: linear-gradient(to right, rgba(169, 3, 41, 1) 0%, rgba(196, 72, 72, 1) 44%, rgba(170, 34, 56, 1) 100%);
        color: #fff;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
        z-index: 10
    }

    .tilt {
        overflow: hidden
    }

    .img {
        height: 400px;
        overflow: hidden
    }

    .img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s
    }

    .card:hover .img img {
        transform: scale(1.05)
    }

    .info {
        padding: 10px
    }

    .cat {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #71717A;
        margin-bottom: 1px
    }

    .title {
        font-size: 18px;
        font-weight: 700;
        color: #18181B;
        margin: 0 0 10px;
        letter-spacing: -.5px
    }

    .desc {
        font-size: 12px;
        color: #52525B;
        line-height: 1.4;
        margin-bottom: 9px
    }

    .bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 9px
    }

    .price {
        display: flex;
        flex-direction: column
    }

    .old {
        font-size: 13px;
        text-decoration: line-through;
        color: #616176ff;
        margin-bottom: 2px
    }

    .new {
        font-size: 20px;
        font-weight: 700;
        color: #18181B
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
        box-shadow: 0 3px 10px rgba(0, 0, 0, .1)
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


    .meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 2px solid #F4F4F5;
        padding-top: 9px
    }

    .detailtext {
        color: blue;

    }

    .rate_avg {
        position: absolute;
        /* top: 10px; */
        bottom: 9px;
        right: 10px;
        background: linear-gradient(to right, rgba(255, 174, 1, 1) 0%, rgba(249, 137, 8, 1) 44%, rgba(235, 162, 5, 1) 100%);
        color: #fff;
        padding: 5px 5px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
        z-index: 10
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 2px
    }

    .rcount {
        margin-left: 6px;
        font-size: 11px;
        color: #71717A
    }

    .stock {
        font-size: 11px;
        font-weight: 600;
        color: #22C55E
    }

    .products_container {
        display: grid;
        /*grid-template-columns: repeat(auto-fill, minmax(420px, 1fr)); */
        grid-template-columns: auto auto auto auto;
        /*grid-gap: 5px;*/
        padding: 0px;
        margin-top: 20px;
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

    }

    .pagination a {
        display: block;
        padding: 0.5em 1em;
        /* border: 5px solid #999999; */
        border: 2px solid black;
        border-radius: 0.2em;
        text-decoration: none;
        background-color: #18181B;
        color: white;
    }

    .pagination a.active {
        font-weight: bold;
        color: red;
    }

    .wishlist-toggle {
        cursor: pointer;
        font-size: 22px
    }

    /*       for swipe*/
    .img-gallery {
        position: relative;
        width: 100%;
        max-width: 600px;
        /* Adjust based on your layout */
        margin: auto;
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
        width: 100%;
        height: 300px;
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
        font-size: 30px;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 10;
        margin: 5px;
        margin-top: 45px;
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
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

    .search-form {
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

    .search {
        /* padding: 15px; */
        margin: 1px;
        padding-top: 5px;
    }


    /* .active .minus,
        .active .plus { */
    /* background: #444;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer; */
    /* } */

    /* .active .minus:hover,
        .active .plus:hover { */
    /* background: #666; */
    /* } */

    @media (max-width:400px) {
        .card {
            width: 90%
        }

        .title {
            font-size: 16px
        }

        .img {
            height: 180px
        }

        .bottom {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px
        }

        .price {
            margin-bottom: 5px
        }

        .btn {
            width: 100%;
            justify-content: center
        }
    }
</style>


@section('content')

<form action="{{ route('user.products.products') }}" method="get" class="search-form">
    <div>
        <input type="text" name="search" class="search" placeholder="search anything">
        <select name="filterbycat" class="filterbycat">
            <option value="">Select Category</option>
            <option value=2>Electronics</option>
            <option value=3>Beauty and personal care</option>
           <option value=4>Health and Wellness</option>
            <option value=5>Fashion</option>
            <option value=6>Household and Grocery</option>
           <option value=7>Other</option>
        </select>
        <button type="submit" class="search-icon" name="search_submit">🔎</button>
        <button><a href="?" class="reset-btn">RESET</a></button>
        <button class="add-prod-btn"><a href="{{ route('user.products.prodform') }}">✚ Add Product(for testing)</a></button>
    </div>
</form>
<!-- <button>Add Product</button> -->
<br>
<br><br>


@if(count($products) > 0)
<div class='products_container'>

    @foreach ($products as $product)
    <?php
    $offer = round((($product->p_price - $product->p_offerprice) / $product->p_price) * 100, 2);
    // $heart = ($wishlist->$inWishlist) == false ? '🤍' : '❤️';
    ?>
    <div class='card'>
        <form action="{{ route('user.wishlist.toggle', ['p_id' => $product->p_id]) }}" method="post">
            @csrf
            <button type="submit" data-p_id="{{ $product->p_id }}">
                <div class='badge-1 wishlist-toggle heart-icon'>{{ in_array($product->p_id, $wishlist) ? '❤️' : '🤍' }}</div>

            </button>
        </form>
        <!-- <div class=' badge-1 wishlist-toggle'>{{ '🤍' ? '❤️' : '🤍'; }}</div> -->
        <!-- <div class='badge-2'>{{ round((($product->p_price - $product->p_offerprice) / $product->p_price) * 100, 2) }}% OFF</div> -->
        <div class='badge-2'>@php echo $offer . '% OFF'; @endphp</div>
        <div class='tilt'>


            <div class="img-gallery">
                <div class="img-container">
                    @foreach($product->images->take(5) as $image)
                    <div class="img-item">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $product->p_id }}">
                    </div>
                    @endforeach
                </div>

                <button class="prev-btn">&#10094;</button>
                <button class="next-btn">&#10095;</button>
            </div>


        </div>

        <div class='info'>
            <div class='cat'>{{ $product->cat_id }}</div>
            <!-- <div class='cat'>{{ $product->category->cat_name }}</div> -->
            <h2 class='title'>{{ $product->p_name }}</h2>
            <p class='desc'>{{ $product->p_desc }}</p>

            <div class='bottom'>
                <div class='price'>
                    <span class='new'>₹{{ (int)$product->p_offerprice }}</span>
                    <span class='old'>₹{{ (int)$product->p_price }}</span>
                </div>

                @php
                $qtyInCart = $cart[$product->p_id] ?? 0;
                @endphp

                @if($qtyInCart > 0)
                <div class="btn active quantity-box"
                    data-product="{{ $product->p_id }}"
                    data-price="{{ $product->p_offerprice }}">
                    <button class="minus">−</button>
                    <span class="count">{{ $qtyInCart }}</span>
                    <button class="plus">+</button>
                </div>
                @else
                <div class="btn add-to-cart"
                    data-product="{{ $product->p_id }}"
                    data-price="{{ $product->p_offerprice }}">
                    Add to cart
                </div>
                @endif

            </div>
            <div class='meta'></div>
            <button class='detailtext'><a href="{{ route('user.products.details', ['p_id' => $product->p_id, 'cat_id' => $product->cat_id]) }}">Details</a></button>
            @php
            $averageRating = round($product->ratings_avg_rates ?? 0, 2);
            @endphp
            <div class='rate_avg'>{{ $averageRating, 1 }}★<span>({{ $product->ratings_count }})</span></div>
        </div>
    </div>
    @endforeach
</div>


@else
<p>No records found.</p>
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

<!-- <script>
    $(document).on('click', '.wishlist-toggle', function() {
        var user_id = $userId;
        const like = $(this);
        const p_id = like.data('p_id');
        //const isLiked = like.data('isLiked');

        $.ajax({
            url: '/wishlist/toggle/{p_id}',
            method: 'POST',
            // Add this line to tell jQuery you expect JSON
            dataType: 'json',
            data: {
                p_id: p_id,
                user_id: user_id
                // isLiked: isLiked
            },
            success: function(response) {
                console.log(" Server responded:", response);
                if (response.inWishlist) {
                    like.text('❤️');
                } else {
                    like.text('🤍');
                }
            },
            error: function(xhr, status, error) {
                console.error(' AJAX Error:', error);
                console.log('Server response text:', xhr.responseText);
            }

        });
        return false;
    });
</script> -->

<script>
    $(document).on('click', '.wishlist-toggle', function() {
        // e.preventDefault();
        const like = $(this);
        // const p__id = like.data('p_id');
        // const p_id = parseInt(p__id);

        const p_id = like.data('p_id');

        $.ajax({
            url: '/user/wishlist/toggle/' + p_id,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                p_id: p_id
            },
            success: function(response) {
                if (response.inWishlist) {
                    like.text('❤️');
                    // div.find('.heart-icon').text('❤️');
                } else {
                    like.text('🤍');
                    // div.find('.heart-icon').text('🤍');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
</script>

<script>
    $(document).on('click', '.add-to-cart', function() {
        let box = $(this);
        let productId = box.data('product');
        let price = box.data('price');
        let qty = 1;

        updateCart(productId, qty, price);

        box.addClass('active quantity-box')
            .removeClass('add-to-cart')
            .html(`
           <button class="minus">−</button>
           <span class="count">1</span>
           <button class="plus">+</button>
       `);
    });


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
            updateCart(productId, 0, price);
            box.removeClass('active quantity-box')
                .addClass('add-to-cart')
                .html('Add to cart');
            return;
        }

        countqty.text(qty);
        updateCart(productId, qty, price);
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
                console.log("Quantity updated in cart:", res);
            },
            error: function(xhr, status, error) {
                console.error(' AJAX Error:', error);
                console.log("inside error");
                console.log('Server response text:', xhr.responseText);
            }

        })

    }
</script>