@extends('admin.sidebar')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f0f4f8;
            /* Light gray background */
            /* display: flex; */
            /* justify-content: center;
            align-items: center; */
            height: 100vh;
            margin-left: 250px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* Float four columns side by side */
        .column {
            float: left;
            width: 25%;
            padding: 0 10px;
        }

        /* Remove extra left and right margins, due to padding in columns */
        .row {
            margin: 0 -5px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            /* this adds the "card" effect */
            padding: 16px;
            text-align: center;
            border-radius: 30px;
            /* background-color: #f1f1f1; */
            background: #2b3352ff;
            color: #f0f4f8;
        }

        .info {
            border-radius: 10px;
        }

        .depth {
            margin-top: 20px;

        }

        /* Responsive columns - one column layout (vertical) on small screens */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="maindash_container">
        <h1>DASHBOARD</h1>
        <div class="abt_total">
            <div class="row">
                <div class="column">
                    <div class="card">
                        <h2>Total Users</h2>
                        <button class="info"><a href="{{ route('admin.dashboard.user') }}">more info ➡️</a></button>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h2>Total Posts</h2>
                        <button class="info"><a href="{{ route('admin.dashboard.product') }}">more info ➡️</a></button>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h2>Total Orders</h2>
                        <button class="info"><a href="{{ route('admin.dashboard.order') }}">more info ➡️</a></button>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h2>Total Reviews</h2>
                        <button class="info"><a href="{{ route('admin.dashboard.review') }}">more info ➡️</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="depth">
            <div class="row">
                <div class="column">
                    <div class="card">
                        <h2>Monthly Users</h2>
                        <button class="info"><a href="{{ route('admin.dashboard.abt_m_user') }}">more info ➡️</a></button>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h2>Posts views</h2>
                        <button class="info"><a href="{{ route('admin.dashboard.abt_prod_view') }}">more info ➡️</a></button>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <h2>About Orders</h2>
                        <button class="info"><a href="{{ route('admin.dashboard.abt_order') }}">more info ➡️</a></button>
                    </div>
                </div>
                <!-- <div class="column">
                    <div class="card">
                        <h2>Reviews by product</h2>
                        <button class="info"><a href="orders.php">more info ➡️</a></button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>



</body>

</html>