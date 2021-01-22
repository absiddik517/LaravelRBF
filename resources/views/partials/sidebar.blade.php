<aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('images/ab.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>A.B. Siddik</p>
          <a href="#">PHP Developer</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">Main Navigation</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
          </ul>
        </li>

        <li class="header">Controller</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Controller</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('products') }}"><i class="fa fa-list"></i> <span>Product Controller</span></a></li>
            <li><a href="{{ route('party.party_type') }}"><i class="fa fa-list"></i> <span>Party Type Controller</span></a></li>
          </ul>
        </li>
        
        
        <li class="header">Product</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i>
            <span>Sell</span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('sells.form') }}"><i class="fa fa-circle-o"></i> Sell Product</a></li>
            <li><a href="{{  route('sells.viewAll') }}"><i class="fa fa-circle-o"></i> View All Sells</a></li>
          </ul>
        </li>
        

        <li class="treeview">
          <a href="#">
            <i class="fa fa-truck"></i>
            <span>Project</span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('project.index') }}"><i class="fa fa-circle-o"></i> View Project </a></li>
            <li><a href="{{ route('project.delevery') }}"><i class="fa fa-circle-o"></i> Delivery </a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-truck"></i>
            <span>Delevery</span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('delivery.add') }}"><i class="fa fa-circle-o"></i> Delevery Product </a></li>
            <li><a href="{{ route('delivery.viewAll') }}"><i class="fa fa-circle-o"></i> View Delevery </a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> View Panding Delevery </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Due </span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('due.add') }}"><i class="fa fa-circle-o"></i> Due Pay </a></li>
            <li><a href="{{ route('due.viewAll') }}"><i class="fa fa-circle-o"></i> View Due Pay </a></li>
          </ul>
        </li>

        <li class="header">Cost </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-credit-card"></i>
            <span>Cost </span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('cost.add') }}"><i class="fa fa-circle-o"></i> Add Cost </a></li>
            <li><a href="{{ route('cost.viewToday') }}"><i class="fa fa-circle-o"></i> View Cost </a></li>
            <li><a href="{{ route('cost.viewAll') }}"><i class="fa fa-circle-o"></i> View All Cost </a></li>
          </ul>
        </li>

        <li class="header">Random </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i>
            <span>Outcash </span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('outcash.add') }}"><i class="fa fa-circle-o"></i> Take Loan </a></li>
            <li><a href="{{ route('outcash.viewAll') }}"><i class="fa fa-circle-o"></i> View All Transection </a></li>
          </ul>
        </li>
        <li class="header">People </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-md"></i>
            <span>Staff </span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('staff.all') }}"><i class="fa fa-circle-o"></i> View Staff </a></li>
            <li><a href="{{ route('staff.payments') }}"><i class="fa fa-circle-o"></i> Staff Payment </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-male"></i>
            <span>Dealer </span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('dealer.all') }}"><i class="fa fa-circle-o"></i>View Dealer </a></li>
            <li><a href="{{ route('dealer.payments') }}"><i class="fa fa-circle-o"></i> Dealer Payment </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Worker </span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('worker.all') }}"><i class="fa fa-circle-o"></i>View Worker </a></li>
            <li><a href="{{ route('worker.payments') }}"><i class="fa fa-circle-o"></i>Worker Payment </a></li>
          </ul>
        </li>

        <!-- party section  -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Party</span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('party.all') }}"><i class="fa fa-circle-o"></i>View Party </a></li>
                <li><a href="{{ route('party.payments') }}"><i class="fa fa-circle-o"></i> Party Payment </a></li>
                <li><a href="{{ route('party.production') }}"><i class="fa fa-circle-o"></i> Production </a></li>
              </ul>
        </li>


        <li class="header">Admin Area</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cloud-download"></i>
            <span>Download</span>
            <span class="pull-right-container">
              <!-- <span class="label label-primary pull-right">4</span> -->
            </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/downloads/ladger"><i class="fa fa-file-pdf-o"></i> Ladger</a></li>
            <li><a href="/downloads/cost-voutcher"><i class="fa fa-file-pdf-o"></i> Cost Vautcher</a></li>
            <li><a href="/downloads/backup"><i class="fa fa-database"></i> Database Backup</a></li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-tag"></i>
                <span>Others </span>
                <span class="pull-right-container">
                  <!-- <span class="label label-primary pull-right">4</span> -->
                </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/downloads/print-daily-total"><i class="fa fa-file-text-o"></i> Daily Total </a></li>

                <li><a href="/downloads/print-delevery"><i class="fa fa-file-text-o"></i> Delevery </a></li>
                
                <li><a href="/downloads/print-all-due"><i class="fa fa-file-text-o"></i> View All Due </a></li>
              </ul>
            </li>

          </ul>
        </li>

        <li><a href="/notes"><i class="fa fa-sticky-note-o"></i> <span> Note</span></a></li>

        <li><a href="/profile"><i class="fa fa-user-secret"></i> <span>Profile</span></a></li>

        <li><a href="/users"><i class="fa fa-users"></i> <span>Users</span></a></li>
        
        <li><a href="/license"><i class="fa fa-key"></i> <span>License</span></a></li>

        <li><a href="{{ route('setting.index') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>