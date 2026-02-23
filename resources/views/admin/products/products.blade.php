<style>
    body {
        background-color: #f0f4f8;
        /* Light gray background */
        /* display: flex; */
        /* justify-content: center;
            align-items: center; */
        height: 100vh;
        margin-left: 250px;
        margin-top: 25px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    table {
        /* width: 100%; */
        border-collapse: collapse;
        table-layout: fixed;
        width: 1100px;
        height: 250px;
        margin-top: -40px;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        text-align: center;
        padding: 5px;
    }

    h1 {
        margin-bottom: 10px;
    }

    a {
        margin-right: 5px;
    }

    .container {
        position: flex;
        justify-content: center;
        text-align: center;
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
    }

    .pagination a.active {
        font-weight: bold;
        color: red;
    }

    .user_container {
        margin-top: 20px;
        margin-left: 210px;
        padding: 0px 8px;
    }

    .sidenav a:active {
        background-color: #f0f4f8;
        color: black;
    }

    .img-list {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .img-list img {
        width: 35px;
        height: 35px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>

<?php
// require __DIR__ . '/sidebar.php';

?>
@extends('admin.sidebar')
<h1>Product Management</h1>

<button><a href="{{ route('admin.products.prod_form') }}">Add New Product </a></button>
<br><br>
<form action="{{ route('admin.products.products') }}" method="get" class="search-form">

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
    <label for="from_date">From Date:</label>
    <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">


    <label for="to_date"> & To Date:</label>
    <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">

    <!-- <button type="submit" class="filter-btn">Filter</button> -->
    <button type="submit" class="search-icon" name="search_submit">🔎</button>
    <button><a href="?" class="reset-btn">RESET</a></button>

</form>

<form action="{{ route('admin.products.products') }}" method="GET">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <input type="hidden" name="filterbycat" value="{{ request('filterbycat') }}">
    <input type="hidden" name="from_date" value="{{ request('from_date') }}">
    <input type="hidden" name="to_date" value="{{ request('to_date') }}">

    <label>Sort By:</label>
    <select name="sort_by_column">
        <option value="p_id" {{ $currentSortColumn == 'p_id' ? 'selected' : '' }}>p_id</option>
        <option value="p_name" {{ $currentSortColumn == 'p_name' ? 'selected' : '' }}>name</option>
        <option value="p_price" {{ $currentSortColumn == 'p_price' ? 'selected' : '' }}>p_price</option>
        <option value="p_offerprice" {{ $currentSortColumn == 'p_offerprice' ? 'selected' : '' }}>p_offerprice</option>
        <option value="p_stock" {{ $currentSortColumn == 'p_stock' ? 'selected' : '' }}>p_stock</option>
        <option value="created_at" {{ $currentSortColumn == 'created_at' ? 'selected' : '' }}>Created Date</option>
        <option value="updated_at" {{ $currentSortColumn == 'updated_at' ? 'selected' : '' }}>Updates Date</option>
    </select>
    <label>Order:</label>
    <select name="sort_direction">
        <option value="asc" {{ $currentSortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
        <option value="desc" {{ $currentSortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
    </select>
    <button type="submit">Sort</button>
    <button><a href="?" class="reset-btn">RESET</a></button>

</form>
<br><br>
<div class="user_table">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>name </th>
                <th>imgs </th>
                <th>cat id - name </th>
                <th>Price </th>
                <th>Offer price </th>
                <th>p_stock </th>
                <th>Added At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->p_id }}</td>
                <td>{{ $product->p_name }}</td>

                <!-- IMAGES COLUMN -->
                <td>
                    <div class="img-list">
                        @forelse($product->images->take(5) as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $product->p_name }}">
                        @empty
                        <span>No image</span>
                        @endforelse
                    </div>
                </td>

                <td>{{ $product->cat_id }} - {{ $product->category->cat_name }}</td>
                <td>{{ $product->p_price }}</td>
                <td>{{ $product->p_offerprice }}</td>
                <td>{{ $product->p_stock }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>

                <td>
                    <a href="{{ route('admin.products.edit', ['p_id' => $product->p_id]) }}">Edit</a>
                    <a>
                        <form action="{{ route('admin.products.products.destroy', $product->p_id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this product?');" class="dlt">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

    <div class="pagination">
        {!! $products->links() !!}
    </div>


</div>

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