<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <div class="d-flex sidebar-profile">
                <div class="sidebar-profile-image">
                    <img src="images/faces/face29.png" alt="image">
                    <span class="sidebar-status-indicator"></span>
                </div>
                <div class="sidebar-profile-name">
                    <p class="sidebar-name">
                        {{ Auth::user()->email }}
                    </p>
                    <p class="sidebar-designation">
                        Welcome
                    </p>
                </div>
            </div>
            <p class="sidebar-menu-title">Dash menu</p>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard <span class="badge badge-primary ml-3">New</span></span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('checkIn') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Check In</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('checkOut') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Check Out</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('room-bills') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Room Bills</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('restaurant-bills') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Restaurant Bills</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('taxi-bills') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Taxi Bills</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laundry-bills') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Laundry Bills</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('invoice') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Invoice</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="typcn typcn-film menu-icon"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rooms') }}">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Rooms</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('items') }}">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Restaurant Items</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>