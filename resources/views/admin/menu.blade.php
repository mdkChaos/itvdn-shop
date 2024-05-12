<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="fa-solid fa-users"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.products.index') }}" class="nav-link">
                <i class="fa-brands fa-product-hunt"></i>
                <p>Products</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" class="nav-link">
                <i class="fa-regular fa-rectangle-list"></i>
                <p>Orders</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
