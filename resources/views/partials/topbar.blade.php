<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>RBF</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>AdminRBF</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
           <li class="tasks-menu">
            <a href="javascript:void(0)" style="font-size:20px; font-width: bold;" id="top_bar_current_balance"></a>
          </li>

          <li class="tasks-menu hmm">
            <a href="javascript:void(0)" style="font-size:20px; font-width: bold;">
                {{ Dates::SR(Dates::Today()) }}
            </a>
          </li>

          <li class="tasks-menu">
            <a href="/downloads/backup" class="">
              <i class="fa fa-download"></i>
            </a>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('images/ab.jpg') }}" class="user-image" alt="x">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('images/ab.jpg') }}" class="img-circle" alt="x">

                <p>
                  {{ Auth::user()->name }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  {{-- <a href="{{ Route('logout') }}" class="btn btn-default btn-flat">Sign out</a> --}}
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

          <li id="show_timeline">
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i><div class="badge" id="timeline_badge"></div></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>