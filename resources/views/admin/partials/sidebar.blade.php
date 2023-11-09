<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav mt-2">
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart"></i>Orders</a>
                    <ul class="sub-menu children dropdown-menu">                            
                        <li><i class="fa fa-shopping-cart"></i><a href="{{ route('admin.order') }}">Manage Orders</a></li>
                        <li><i class="fa fa-clock-o"></i><a href="{{ route('admin.order.history') }}">Orders History</a></li>
                        <li><i class="fa fa-check-square-o"></i><a href="{{ route('admin.order.processing') }}">Order Processing</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown {{ Request::is('admin/product*') ? 'active' : '' }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tags"></i>Products</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-tags"></i><a href="{{ route('admin.product') }}">Manage Products</a></li>
                        <li><i class="fa fa-th-large"></i><a href="{{ route('admin.product.inventory') }}">Inventory Management</a></li>
                    </ul>
                </li>
                <li class=" {{ Request::is('admin/customer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.customer') }}"><i class="menu-icon fa fa-users"></i>Customers</a>
                </li>
            </ul>
        </div>
    </nav>
</aside>