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
        margin-top: -15px;
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

<h1>User Management</h1>

<!-- <button><a href="{{ route('admin.users.adduser_form') }}">Add New User / Admin</a></button> -->
<button><a href="{{ route('admin.users.addadmin') }}">Add New Admin</a></button>

<br><br>
<form action="{{ route('admin.users.users') }}" method="get" class="search-form">

    <input type="text" name="search" class="search" placeholder="search anything">

    <select name="filterbyrole" class="filterbyrole">
        <option value="">Role</option>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <label for="from_date">From Date:</label>
    <input type="date" id="from_date" name="from_date" value="{{ request('from_date') }}">


    <label for="to_date"> & To Date:</label>
    <input type="date" id="to_date" name="to_date" value="{{ request('to_date') }}">

    <!-- <button type="submit" class="filter-btn">Filter</button> -->
    <button type="submit" class="search-icon" name="search_submit">🔎</button>
    <button><a href="?" class="reset-btn">RESET</a></button>

</form>

<form action="{{ route('admin.users.users') }}" method="GET">
    <input type="hidden" name="search" value="{{ request('search') }}">
    <input type="hidden" name="filterbyrole" value="{{ request('filterbyrole') }}">
    <input type="hidden" name="from_date" value="{{ request('from_date') }}">
    <input type="hidden" name="to_date" value="{{ request('to_date') }}">

    <label>Sort By:</label>
    <select name="sort_by_column">
        <option value="id" {{ $currentSortColumn == 'id' ? 'selected' : '' }}>Id</option>
        <option value="name" {{ $currentSortColumn == 'name' ? 'selected' : '' }}>Userame</option>
        <option value="email" {{ $currentSortColumn == 'email' ? 'selected' : '' }}>Email</option>
        <option value="created_at" {{ $currentSortColumn == 'created_at' ? 'selected' : '' }}>Created Date</option>
        <option value="updated_at" {{ $currentSortColumn == 'updated_at' ? 'selected' : '' }}>Updates Date</option>

    </select>

    <label>Order:</label>
    <select name="sort_direction">
        <option value="asc" {{ $currentSortDirection == 'asc' ? 'selected' : '' }}>Ascending</option>
        <option value="desc" {{ $currentSortDirection == 'desc' ? 'selected' : '' }}>Descending</option>
    </select>
    <button type="submit">Sort</button>

</form>
<br>

<br>
<div class="user_table">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username </th>
                <th>Email </th>
                <th>Role </th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @if(count($users) > 0)
            <!-- 
            // $editUrl = "edituser.php?reg_id=" . $row['reg_id'] . "&page=" . $currentPage . "&search=" . urlencode($typedsearch) . "&filterbyrole=" . urlencode($filterbyrole);
            // $deleteUrl = "deleteuser.php?reg_id=" . $row['reg_id'] . "&page=" . $currentPage . "&search=" . urlencode($typedsearch) . "&filterbyrole=" . urlencode($filterbyrole);
            // <td>{$row['password']}</td> -->
            <div>
                <tr>
                    @foreach($users as $user)
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td>
                        @if($user->role == 'admin')
                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">Edit</a>
                        @endif
                        <a>
                            <form action="{{ route('admin.users.users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');" class="dlt">
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
        {!! $users->links() !!}
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