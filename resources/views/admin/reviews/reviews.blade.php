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
        margin-top: 75px;
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
</style>

<?php
// require __DIR__ . '/sidebar.php';

?>
@extends('admin.sidebar')

<h1>Rate & Review Management</h1>
<br>

<!-- <button><a href="adduser.php">Add New User / Admin</a></button> -->

<form action="{{ route('admin.reviews.reviews') }}" method="get" class="search-form">

    <input type="text" name="search" class="search" placeholder="search anything">

    <select name="rates" class="rates">
        <option value="">Rates</option>
        <option value="5">★★★★★</option>
        <option value="4">★★★★</option>
        <option value="3">★★★</option>
        <option value="2">★★</option>
        <option value="1">★</option>
    </select>
    <label for="from_date">From Date:</label>
    <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">


    <label for="to_date"> & To Date:</label>
    <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">

    <!-- <button type="submit" class="filter-btn">Filter</button> -->
    <button type="submit" class="search-icon" name="search_submit">🔎</button>
    <button><a href="?" class="reset-btn">RESET</a></button>
</form>
<form action="{{ route('admin.reviews.reviews') }}" method="GET">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <input type="hidden" name="rates" value="{{ request('rates') }}">
    <input type="hidden" name="from_date" value="{{ request('from_date') }}">
    <input type="hidden" name="to_date" value="{{ request('to_date') }}">

    <label>Sort By:</label>
    <select name="sort_by_column">
        <option value="rate_id" {{ $currentSortColumn == 'rate_id' ? 'selected' : '' }}>Rate Id</option>
        <option value="user_id" {{ $currentSortColumn == 'user_id' ? 'selected' : '' }}>User ID</option>
        <option value="p_id" {{ $currentSortColumn == 'p_id' ? 'selected' : '' }}>Product id </option>
        <option value="rates" {{ $currentSortColumn == 'rates' ? 'selected' : '' }}>rates </option>review
        <option value="review" {{ $currentSortColumn == 'review' ? 'selected' : '' }}>review </option>
        <option value="order_id" {{ $currentSortColumn == 'order_id' ? 'selected' : '' }}>Order Id</option>
        <option value="created_at" {{ $currentSortColumn == 'created_at' ? 'selected' : '' }}>Order Date</option>
        <option value="order_placed_date" {{ $currentSortColumn == 'order_placed_date' ? 'selected' : '' }}>Order placed Date</option>

    </select>

    <label>Order:</label>
    <select name="sort_direction">
        <option value="asc" {{ $currentSortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
        <option value="desc" {{ $currentSortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
    </select>
    <button type="submit">Sort</button>
    <button><a href="?" class="reset-btn">RESET</a></button>

</form>


<div class="user_table">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User id </th>
                <th>Product id </th>
                <th>Rates </th>
                <th>Review </th>
                <th>Order id </th>
                <th>Created_at</th>
                <th>Updated_at</th>

            </tr>
        </thead>
        <tbody>

            @if(count($ratings) > 0)
            <!-- 
            // $editUrl = "edituser.php?reg_id=" . $row['reg_id'] . "&page=" . $currentPage . "&search=" . urlencode($typedsearch) . "&filterbyrole=" . urlencode($filterbyrole);
            // $deleteUrl = "deleteuser.php?reg_id=" . $row['reg_id'] . "&page=" . $currentPage . "&search=" . urlencode($typedsearch) . "&filterbyrole=" . urlencode($filterbyrole);
            // <td>{$row['password']}</td> -->
            <div>
                <tr>
                    @foreach($ratings as $rate)
                    <td>{{$rate->rate_id}}</td>
                    <td>{{$rate->user_id}}</td>
                    <td>{{$rate->p_id}}</td>
                    <td>{{$rate->rates}}★</td>
                    <td>{{$rate->review}}</td>
                    <td>{{$rate->order_id}}</td>
                    <td>{{$rate->created_at}}</td>
                    <td>{{$rate->updated_at}}</td>

                </tr>
            </div>
            @endforeach


            @else
            <tr>
                <td colspan='8'>No records found</td>
            </tr>
            @endif


        </tbody>
    </table>
    <div class="pagination">
        {!! $ratings->links() !!}
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