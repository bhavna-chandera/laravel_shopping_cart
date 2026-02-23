@extends('layouts.app') {{-- Assuming you have a layout file --}}


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
        padding: 20px
    }

    .cat {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #71717A;
        margin-bottom: 5px
    }

    .title {
        font-size: 18px;
        font-weight: 700;
        color: #18181B;
        margin: 0 0 10px;
        letter-spacing: -.5px
    }

    .desc {
        font-size: 13px;
        color: #52525B;
        line-height: 1.4;
        margin-bottom: 12px
    }

    .bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px
    }

    .price {
        display: flex;
        flex-direction: column
    }

    .old {
        font-size: 13px;
        text-decoration: line-through;
        color: #A1A1AA;
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
        border-top: 1px solid #F4F4F5;
        padding-top: 12px
    }

    .rate_avg {
        position: absolute;
        /* top: 10px; */
        bottom: 15px;
        right: 10px;
        background: linear-gradient(to right, rgba(255, 174, 1, 1) 0%, rgba(249, 137, 8, 1) 44%, rgba(235, 162, 5, 1) 100%);
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

@if($wishlistProducts->count())
<div class='products_container'>
    @foreach($wishlistProducts as $product) {
    <div>
        @foreach($products as $product){
        <div>
            @php
            $discount = $product->p_price - $product->p_offerprice;

            if ($product->p_price > 0) {
            $offer = round(($discount / $product->p_price) * 100);
            } else {
            $offer = 0;
            }
            @endphp
        </div>

    </div>

    }

    <!-- <hp
            if (($item->products->p_price) > 0) {
                $offer = round((($item->products->p_price - $item->products->p_offerprice) / $item->products->p_price) * 100, 2);
            } else {
                $offer = 1;
            }
            ?> -->
    <div class='card'>
        <div class='badge-1 wishlist-toggle' data-p_id='{$row[' p_id']}'>♥️</div>
        <div class='badge-2'>@php echo $offer . '% OFF'; @endphp</div>
        <div class='tilt'>
            <!-- <div class='img'>
                <img src='../../uploads/$first_image' alt='{$row[' p_name']}'>
            </div> -->
        </div>

        <div class='info'>
            <div class='cat'>{{ $product->cat_id }}</div>
            <h2 class='title'>{{ $product->p_name }}</h2>
            <p class='desc'>{{ $product->p_desc }}</p>

            <div class='bottom'>
                <div class='price'>
                    <span class='old'>{{ $product->p_price }}/-</span>
                    <span class='new'>{{ $product->p_offerprice }}/-</span>
                </div>

                <div class='btn quantity active quantity-box' data-qty='{$row[' qty']}' data-p_id='{$row[' p_id']}' data-price='{$row[' p_offerprice']}'>
                    <button class='minus'>−</button>
                    <span class='count'>2</span>
                    <button class='plus'>+</button>
                </div>

                <div class='btn quantity add-to-cart' data-p_id='{$row[' p_id']}' data-price='{$row[' p_offerprice']}'>
                    <span class='number count'>Add to cart</span>
                </div>


            </div>
            <div class='meta'></div>
            <button><a href='$singleprodUrl'>Details</a></button>
            <div class='rate_avg'>5★<span>5</span></div>
        </div>
    </div>
    @endforeach
    @endforeach
</div>


@else
<p>No records found.</p>
@endif

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- <script>
    $(document).on('click', '.wishlist-toggle', function() {
        const like = $(this);
        const p_id = like.data('p_id');
        var user_id = <hp echo $user_id; ?>;
        const isLiked = like.data('isLiked');


        $.ajax({
            url: 'wishlist_action.php',
            method: 'POST',
            dataType: 'json',
            data: {
                p_id: p_id,
                user_id: user_id,
                isLiked: isLiked
            },
            success: function(response) {
                console.log(" Server responded:", response);

                if (response.message === 'added in wishlist') {
                    like.text('❤️');
                } else if (response.message === 'removed from wishlist') {
                    like.text('🤍');
                } else {
                    console.error("Unexpected server response:", response.message);
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
        e.preventDefault();
        const like = $(this);
        const p_id = like.data('p_id');

        $.ajax({
            url: '/wishlist/toggle/' + p_id,
            type: 'POST',
            data: {
                p_id: p_id,
                user_id: user_id
            },
            success: function(response) {
                if (response.inWishlist) {
                    like.text('❤️');
                } else {
                    like.text('🤍');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
</script>