<!-- NavBar For Authenticated Users -->
{{ require('/woopra_tracker.php') }}
{{ $woopra = new WoopraTracker(array("domain" => 'partners.brightmountainmedia.com')) }}
{{ $woopra->identify(array('email' => Auth::user()->email, 'first_name' => Auth::user()->first_name, 'last_name' => Auth::user()->last_name)) }}
<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            @include('nav.brand')
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @includeIf('nav.user-left')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
            	@includeIf('nav.user-right')

                <!-- Authentication Links -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if (Auth::user()->role === 'admin')
                            <!-- Admin -->
                            <li class="dropdown-header">Admin</li>

                            <!-- Add User Role -->
                            <!-- <li>
                                <a href="/admin/add-user-role">
                                    <i class="fa fa-fw fa-btn fa-plus"></i> Add User Role
                                </a>
                            </li> -->

                            <!-- Add User -->
                            <!-- <li>
                                <a href="/admin/add-user">
                                    <i class="fa fa-fw fa-btn fa-user-plus"></i> Add User
                                </a>
                            </li> -->

                            <!-- Publishers -->
                            <li>
                                <a href="/admin/add-stats">
                                    <i class="fa fa-fw fa-btn fa-area-chart"></i> Add Stats
                                </a>
                            </li>

                            <li class="divider"></li>
                        @endif

                        <!-- Dashboard -->
                        <li class="dropdown-header">Dashboard</li>

                        <!-- Dashboard -->
                        <li>
                            <a href="/dashboard">
                                <i class="fa fa-fw fa-btn fa-dashboard"></i> Dashboard
                            </a>
                        </li>

                        <li class="divider"></li>

                        <!-- Settings -->
                        <li class="dropdown-header">Settings</li>

                        <!-- Profile -->
                        <li>
                            <a href="/profile">
                                <i class="fa fa-fw fa-btn fa-user"></i> Profile
                            </a>
                        </li>

                        <!-- Security -->
                        <li>
                            <a href="/security">
                                <i class="fa fa-fw fa-btn fa-lock"></i> Security
                            </a>
                        </li>

                        <li class="divider"></li>

                        <!-- Support -->
                        <!-- <li class="dropdown-header">Support</li>

                        <li>
                            <a @click.prevent="showSupportForm" style="cursor: pointer;">
                                <i class="fa fa-fw fa-btn fa-paper-plane"></i> Email Us
                            </a>
                        </li>

                        <li class="divider"></li> -->

                        <!-- Logout -->
                        <li>
                            <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-btn fa-sign-out"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>