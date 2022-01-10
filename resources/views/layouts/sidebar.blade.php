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
            <a class="nav-link" href="{{ route('rooms') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Rooms</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Restaurant Items</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('checkIn') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Check In</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('room-bills') }}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Room Bills</span>
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
    </ul>
</nav>