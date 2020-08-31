<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
  <div class="c-sidebar-brand d-md-down-none">
    <img src="{{ asset('img/logo.png') }}" class="c-sidebar-brand-full">
  </div>

  <ul class="c-sidebar-nav ps ps--active-y">
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
      </a>
    </li>

    <li class="c-sidebar-nav-title">Order Management</li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="#">
        <i class="fas fa-shopping-cart mr-2"></i> Orders
      </a>
    </li>

    <li class="c-sidebar-nav-title">Products</li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('product-types') }}">
        <i class="fas fa-utensils mr-2"></i> Product Types
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('product-preferences') }}">
        <i class="fas fa-pepper-hot mr-2"></i> Product Preferences
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="#">
        <i class="fas fa-pizza-slice mr-2"></i> Products
      </a>
    </li>

    <li class="c-sidebar-nav-title">Expense Management</li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('suppliers') }}">
        <i class="fas fa-truck mr-2"></i> Suppliers
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('expenses') }}">
        <i class="fas fa-dollar-sign mr-2"></i> Expenses
      </a>
    </li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="#">
        <i class="fas fa-chart-line mr-2"></i> Tracking
      </a>
    </li>

    <li class="c-sidebar-nav-title">CRM</li>
    <li class="c-sidebar-nav-item">
      <a class="c-sidebar-nav-link" href="{{ route('customers') }}">
        <i class="fas fa-user-friends mr-2"></i> Customers
      </a>
    </li>

  </ul>

</div>