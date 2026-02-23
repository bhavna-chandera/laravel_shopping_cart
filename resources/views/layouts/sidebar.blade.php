<!-- resources/views/includes/sidebar.blade.php -->
<nav id="sidebar" class="col-md-4">
    <div class="sidebar-header">
        <h3>Admin Dashboard</h3>
    </div>
    <ul class="nav nav-pills nav-stacked">
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li><a href="{{ route('products.index') }}">Products</a></li>
        <!-- Add more menu items here -->
    </ul>
</nav>