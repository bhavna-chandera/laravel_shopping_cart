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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>


    <h1>Order Management</h1>
    <!-- <button><a href="adduser.php">Add New Order </a></button> -->
    <br>
    <form action="{{ route('admin.orders.orders') }}" method="get" class="search-form">

        <input type="text" name="search" class="search" placeholder="search anything">
        <select name="status" class="status">
            <option value="">Filter by Status</option>
            <option value="in_process">In process</option>
            <option value="dispatched">Dispatched</option>
            <option value="out_for_delivery">Out for delivery</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
        </select>

        <!-- <form action="{{ route('user.orders.orders') }}" method="GET" class="date-form"> -->
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">


        <label for="to_date"> & To Date:</label>
        <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">

        <button type="submit" class="filter-btn">Filter</button>
        <button><a href="?" class="reset-btn">RESET</a></button>
        <!-- <button type="submit" class="search-icon" name="search_submit">🔎</button> -->

    </form>
    <form action="{{ route('admin.orders.orders') }}" method="GET">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <input type="hidden" name="status" value="{{ request('status') }}">
        <input type="hidden" name="from_date" value="{{ request('from_date') }}">
        <input type="hidden" name="to_date" value="{{ request('to_date') }}">

        <label>Sort By:</label>
        <select name="sort_by_column">
            <option value="order_id" {{ $currentSortColumn == 'order_id' ? 'selected' : '' }}>Order Id</option>
            <option value="user_id" {{ $currentSortColumn == 'user_id' ? 'selected' : '' }}>User ID</option>
            <option value="grand_total" {{ $currentSortColumn == 'email' ? 'selected' : '' }}>Grand Total</option>
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
                    <th>Order ID</th>
                    <th>User ID </th>
                    <th>Status </th>
                    <th>Change Status </th>
                    <th>Grand Total </th>
                    <th>Order Date </th>
                    <th>Placed date </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if(count($orders) > 0)
                <!-- 
            // $editUrl = "edituser.php?reg_id=" . $row['reg_id'] . "&page=" . $currentPage . "&search=" . urlencode($typedsearch) . "&filterbyrole=" . urlencode($filterbyrole);
            // $deleteUrl = "deleteuser.php?reg_id=" . $row['reg_id'] . "&page=" . $currentPage . "&search=" . urlencode($typedsearch) . "&filterbyrole=" . urlencode($filterbyrole);
            // <td>{$row['password']}</td> -->
                <div>
                    <tr>
                        @foreach($orders as $order)
                        <td>#{{$order->order_id}}</td>
                        <td>{{$order->user_id}}</td>
                        <!-- <td>{{ $order->user->name ?? 'N/A' }}</td> -->
                        <td>{{$order->order_status}}</td>
                        <td>
                            <form class='statusForm'>
                                <select name="order_status" class="status_dropdown" data-id="{{ $order->order_id }}">
                                    <option value="">Change Status</option>
                                    <option value="in_process" {{ $order->order_status=='in_process'?'selected':'' }}>In process</option>
                                    <option value="dispatched" {{ $order->order_status=='dispatched'?'selected':'' }}>Dispatched</option>
                                    <option value="out_for_delivery" {{ $order->order_status=='out_for_delivery'?'selected':'' }}>Out for delivery</option>
                                    <option value="delivered" {{ $order->order_status=='delivered'?'selected':'' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->order_status=='cancelled'?'selected':'' }}>Cancelled</option>
                                </select>
                            </form>

                            <!-- <form class='statusForm'>
                            <input type='hidden' name='order_id' value='{{ $order->order_id }}'>
                            <select name='order_status' class='status_dropdown'>
                                <option value=''>Status</option>
                                <option value='in_process'>in_process</option>
                                <option value='dispatched'>dispatched</option>
                                <option value='out_for_delivery'>out_for_delivery</option>
                                <option value='delivered'>delivered</option>
                                <option value='cancelled'>cancelled</option>
                            </select>
                        </form> -->
                        </td>
                        <td>₹ {{$order->grand_total}}</td>
                        <td>{{$order->order_date}}</td>
                        <td>{{$order->order_placed_date}}</td>

                        <td>
                            <a>
                                <form action="{{ route('admin.orders.orders.destroy', $order->order_id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this order?');" class="dlt">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </a>
                        </td>
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
            {!! $orders->links() !!}
        </div>
    </div>
</body>

</html>

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
    $(document).on("change", ".status_dropdown", function() {

        let orderId = $(this).data("id");
        let status = $(this).val();

        if (!status) return;

        $.ajax({
            url: "{{ route('admin.orders.updateorderstatus') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                order_id: orderId,
                order_status: status
            },
            success: function() {
                location.reload();
            },
            error: function() {
                alert("Failed to update status");
            }
        });
    });
</script>