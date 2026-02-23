@extends('layouts.app')

<?php
// echo "inside details page";
?>


<!DOCTYPE html>
<html>

<head>

    <style>
        body {
            background-color: #a9a9b2ff;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        .product_container {
            display: flex;
            justify-content: center;
            gap: 50px;
            padding: 30px;
            flex-wrap: wrap;
        }

        /* Left side */
        .left-side {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            margin-left: 0px;
        }

        .left-side .img {
            width: 100%;
            height: 470px;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 20px;
            border-radius: 1px solid black;
        }

        .left-side .img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }



        .left-side .wishlist-toggle {
            font-size: 30px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            user-select: none;
            transition: transform 0.3s;
        }

        .left-side .wishlist-toggle:hover {
            transform: scale(1.2);
        }

        /* Right side */
        .right-side {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
        }

        .right-side .cat {
            font-size: 12px;
            font-weight: 600;
            color: #71717A;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .right-side .title {
            font-size: 28px;
            font-weight: 700;
            color: #18181B;
            margin-bottom: 15px;
        }

        .right-side .desc {
            font-size: 16px;
            color: #52525B;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .right-side .price {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .right-side .price .old {
            text-decoration: line-through;
            color: #888;
            font-size: 18px;
        }

        .right-side .price .new {
            font-size: 24px;
            font-weight: 700;
            color: #18181B;
        }

        .right-side .spec {
            font-size: 16px;
            color: #56b409ff;
            /* color: #ef4444; */

            font-weight: 600;
        }

        .right-side .offer {
            font-size: 15px;
            color: #ef4444;
            /* color: #4a9f04ff; */
            font-weight: 600;
            background: linear-gradient(to right, rgba(169, 3, 41, 1) 0%, rgba(196, 72, 72, 1) 44%, rgba(170, 34, 56, 1) 100%);
            color: #fff;
            border-radius: 10px;
            padding: 5px 10px;
        }

        .right-side .rate_avg {
            position: absolute;
            /* top: 10px; */
            /* bottom: 15px; */
            /* right: 10px; */
            background: linear-gradient(to right, rgba(255, 174, 1, 1) 0%, rgba(249, 137, 8, 1) 44%, rgba(235, 162, 5, 1) 100%);
            color: #fff;
            padding: 5px 10px;
            margin-top: 0px;
            margin-bottom: 10px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .2);
            z-index: 10
        }

        .right-side .btn-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 50px;
            margin-top: -15px;
        }

        .right-side .btn-addcart {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: -120px;
            margin-top: 70px;

        }

        .right-side .quantity-box {
            background: linear-gradient(45deg, #18181B, #27272A);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: .3s;
            /* box-shadow: 0 3px 10px rgba(0, 0, 0, .1) */
        }

        .right-side .back {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #18181B, #27272A);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            gap: 10px;
            transition: 0.3s;
            margin-bottom: 15px;
            margin-top: 150px;
            /* margin-right: 50px; */
        }

        .right-side .back2 {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #18181B, #27272A);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            gap: 10px;
            transition: 0.3s;
            margin-bottom: 15px;
            margin-top: 150px;
            /* margin-right: 50px; */
        }

        .right-side .back .back2:hover {
            background: linear-gradient(45deg, #27272A, #3F3F46);
        }

        .right-side .add-to-cart {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #18181B, #27272A);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 15px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            gap: 10px;
            transition: 0.3s;
            margin-bottom: 15px;
            /* margin-top: 150px; */
        }

        .right-side .add-to-cart:hover {
            background: linear-gradient(45deg, #27272A, #3F3F46);
        }

        .prev-btn,
        .next-btn {
            position: absolute;
            top: 40%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            font-size: 30px;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
            margin: 5px;
            /* margin-top: 25px; */
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


        .btn {
            background: linear-gradient(45deg, #18181B, #27272A);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 15px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            /* display: flex; */
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
            position: fixed;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .1), transparent);
            transition: .5s
        }

        .btn:after {
            content: '';
            position: fixed;
            top: 0;
            left: -100%;
            padding: 8px 15px;
            /* width: 100%;
            height: 100%; */
            /* background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .1), transparent); */
            /* transition: .5s */
        }

        .active .minus,
        .active .plus {
            background: #444;
            color: #fff;
            border: none;
            padding: 5px 5px;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
        }

        .active .minus:hover,
        .active .plus:hover {
            background: #666;
        }


        @media (max-width: 900px) {
            .product_container {
                flex-direction: column;
                align-items: center;
            }

            .left-side,
            .right-side {
                max-width: 90%;
            }

            .left-side .img {
                height: 400px;
            }
        }
    </style>
</head>
<!-- <h2>pagee</h2> -->


@section('content')



<div class='products_container'>
    @if(isset($products))


    <body>
        <div class='product_container'>
            <?php
            $offer = round((($products->p_price - $products->p_offerprice) / $products->p_price) * 100, 2);
            ?>

            <div class='left-side'>
                <div class="img">
                    <!-- @if($products->images->count())
                    @foreach($products->images->take(5) as $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $products->p_id }}">
                    @endforeach
                    @else
                    <img src="{{ asset('images/no-image.png') }}" alt="No Image Available">
                    @endif -->

                    @if ($products->images->where('p_id', $products->p_id)->count() > 0)
                    @foreach ($products->images as $image)
                    {{-- Assuming 'url' is the column for the image path --}}
                    <td>
                        <div class="img-gallery">
                            <div class="img-container">
                                @foreach($products->images->take(5) as $image)
                                <div class="img-item">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $products->p_name }}">
                                </div>
                                @endforeach
                            </div>

                            <button class="prev-btn">&#10094;</button>
                            <button class="next-btn">&#10095;</button>
                        </div>
                    </td>
                    @endforeach
                    @endif
                </div>
                <!-- <button class='add-to-cart' data-id='{$row[' p_id']}'>Add to Cart</button> -->
                <!-- <div class='wishlist-toggle' data-p_id='{$row[' p_id']}'>🤍</div> -->
                <div class='card'>

                </div>
            </div>

            <!-- Right Side -->
            <div class='right-side'>
                <!-- <button class="back">Back to Products</button> -->
                <form action="{{ route('user.wishlist.toggle', ['p_id' => $products->p_id]) }}" method="post">
                    @csrf
                    <button type="submit" data-p_id="{{ $products->p_id }}">
                        <div class='badge-1 wishlist-toggle heart-icon'>{{ in_array($products->p_id, $wishlist) ? '❤️' : '🤍' }}</div>

                    </button>
                </form>
                <div class='cat'>category id: {{ $products->cat_id }}</div>
                <div class='cat'>product id: {{ $products->p_id }}</div>
                <h2 class='title'>{{ $products->p_name }}</h2>
                <p class='desc'> {{ $products->p_desc }}</p>

                <p class='spec'>Special price: </p>

                <div class='price'>
                    <span class='new'>₹{{ (int)$products->p_offerprice }}</span>
                    <br>
                    <span class='old'>₹{{ (int)$products->p_price }}</span>

                    <div class='offer'>@php echo $offer . '% OFF'; @endphp</div>
                </div>

                @php
                $averageRating = round($products->ratings_avg_rates ?? 0, 2);
                $totalRating = round($products->ratings_count ?? 0, 2);

                @endphp
                <div class='rate_avg'>{{ $averageRating, 1 }}★<span>({{ $totalRating }})</span></div>



                <div class="btn-addcart">
                    @php
                    $qtyInCart = $cart[$products->p_id] ?? 0;
                    @endphp

                    @if($qtyInCart > 0)
                    <div class="btn active quantity-box"
                        data-product="{{ $products->p_id }}"
                        data-price="{{ $products->p_offerprice }}">
                        <button class="minus">−</button>
                        <span class="count">{{ $qtyInCart }}</span>
                        <button class="plus">+</button>
                    </div>
                    @else
                    <div class="btn add-to-cart"
                        data-product="{{ $products->p_id }}"
                        data-price="{{ $products->p_offerprice }}">
                        Add to cart
                    </div>
                    @endif
                </div>

                <div class="btn-container">

                    <button class="back"><a href="{{ route('user.cart.cart') }}">
                            Back to Cart</a></button>

                    <button class="back2"><a href="{{ route('user.products.products') }}">
                            Back to Products</a></button>

                    <button class="back2"><a href="{{ route('user.orders.orders') }}">
                            Back to Orders</a></button>

                </div>
            </div>
        </div>
    </body>


    @endif
</div>

@endsection

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.img-gallery').forEach(gallery => {

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

            // Initial state
            updateButtons();
        });

    });
</script>

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
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

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
        console.log("Plus/Minus clicked");
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


    // $.ajaxSetup({
    //     beforeSend: function(xhr, type) {
    //         if (!type.crossDomain) {
    //             xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
    //         }
    //     },
    // });


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