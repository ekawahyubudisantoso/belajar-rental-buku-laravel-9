<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
          <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/books*') ? 'active' : '' }}" href="/dashboard/books">
              <span data-feather="book" class="align-text-bottom"></span>
              Books
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
                <span data-feather="grid" class="align-text-bottom"></span>
                Categories
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
                <span data-feather="user" class="align-text-bottom"></span>
                Users
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/book-rents*') ? 'active' : '' }}" href="/dashboard/book-rents">
              <span data-feather="bookmark" class="align-text-bottom"></span>
              Book Rent
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/rent-logs*') ? 'active' : '' }}" href="/dashboard/rent-logs">
              <span data-feather="clock" class="align-text-bottom"></span>
              Rent Logs
            </a>
          </li>
        </ul>
      @endcan
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
        <span>Profile</span>
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/profile*') ? 'active' : '' }}" aria-current="page" href="/dashboard/profiles">
            <span data-feather="user" class="align-text-bottom"></span>
            Profile
          </a>
        </li>
      </ul>
    </div>
</nav>