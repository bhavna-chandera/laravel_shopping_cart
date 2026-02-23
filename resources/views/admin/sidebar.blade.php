<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 220px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
            gap: 10px;
            padding: 10px;
            font-size: 0.94rem;

            position: fixed;
            width: 220px;
            margin: 5px;
            border-radius: 16px;
            background: #151A2D;
            height: calc(100vh - 32px);
            transition: all 0.4s ease;
        }

        .logo_admin {
            display: flex;
            justify-content: center;
            text-align: center;
            color: #f0f4f8;
            font-size: xx-large;

        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            text-decoration: solid;
            font-size: 18px;
            color: #f0f4f8;
            display: block;
            gap: 10px;
            padding: 10px;
            font-size: 20px;
        }

        .sidenav a:hover {
            /* color: #d11111ff; */
            background-color: #809cb8ff;
            color: black;
        }

        .sidenav a.active {
            background-color: #f0f4f8;
            color: black;
        }


        .logout-btn {
            font-size: 20px;
            padding: 5px;
            margin-top: 245px;
            margin-left: 45px;
            /* color: #f0f4f8; */
        }

        .logout-btn a {
            color: black;
        }

        .logout-btn:hover {
            background-color: #f0f4f8;
            color: black;
        }

        .logout {
            margin-left: 50px;
            margin-bottom: 5px;
            margin-top: 150px;
            padding: 7px;
            font-size: 18px;
        }

        * {
            /* margin: 0;
            padding: 0; */
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="sidenav">
        <h2 class="logo_admin">ADMIN</h2>
        <!-- <select name="main_dash" id="main_dash">
            <option value="">Dashboard</option>
            <option value="abt_user">About Users</option>
            <option value="abt_products">About Products</option>
            <option value="abt_orders">About Orders</option>
            <option value="abt_reviews">About Rate/reviews❖</option>
        </select> -->
        <!-- <a href="../DASHBOARD/maindash.php" class="< ($current_page == 'maindash.php' || 'user.php' || 'product.php' || 'order.php' || 'review.php' || 'abt_m_user.php' || 'abt_order.php') ? 'active' : '' ?>">🎛️ DASHBOARD</a> -->
        <!-- <a href="../DASHBOARD/admindash.php">DASHBOARD</a> -->
        <a href="{{ route('admin.dashboard.dashboard') }}" class="nav-item @if(request()->routeIs('admin.dashboard.dashboard')) active @endif">🎛️ DASHBOARD</a>
        <a href="{{ route('admin.users.users') }}" class="nav-item @if(request()->routeIs('admin.users.users')) active @endif">👮 USERS</a>
        <a href="{{ route('admin.products.products') }}" class="nav-item @if(request()->routeIs('admin.products.products')) active @endif">🎁 PRODUCTS</a>
        <a href="{{ route('admin.orders.orders') }}" class="nav-item @if(request()->routeIs('admin.orders.orders')) active @endif">🛒 ORDERS</a>
        <a href="{{ route('admin.reviews.reviews') }}" class="nav-item @if(request()->routeIs('admin.reviews.reviews')) active @endif">⭐ REVIEWS</a>
        <!-- <form action="" method="post">
            <button type="submit" name="logout-btn" class="logout-btn"><a href=" {{ route('logout') }}">Logout</a></button>
        </form> -->
        <br><br><br><br>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="logout" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</body>

</html>