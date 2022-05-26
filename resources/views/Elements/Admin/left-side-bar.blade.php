<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">  
		<div class="sidebar-brand">
			<a href="index.html"> <img alt="image" src="http://ecodelinfotel.com/lottery/assets/img/logo.png" class="header-logo" /> <span
                class="logo-name">Otika</span>
            </a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Main</li>
			<li class="dropdown active">
				<a href="{{route('admin.dashboard')}}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
			</li>
			<li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown {{Route::currentRouteName() == 'admin.categories.index' ? 'toggled' : ''}}"><i
                  data-feather="plus-square"></i><span>Category</span></a>
              <ul class="dropdown-menu" style="{{Route::currentRouteName() == 'admin.categories.index' ? 'display:block;' : ''}}">
                <li><a href="{{route('admin.categories.index')}}">All Categories</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown {{Route::currentRouteName() == 'admin.amenities.index' ? 'toggled' : ''}}"><i
                  data-feather="plus-square"></i><span>Amenities</span></a>
              <ul class="dropdown-menu" style="{{Route::currentRouteName() == 'admin.amenities.index' ? 'display:block;' : ''}}">
                <li><a href="{{route('admin.amenities.index')}}">All Amenities</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="feather"></i><span>Ads</span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('admin.ads.index')}}">All Ads</a></li>
                <li><a href="{{route('admin.ads.index')}}?status=active">Active Ads</a></li>
                <li><a href="{{route('admin.ads.index')}}?status=inactive">Inactive Ads</a></li>
                <li><a href="{{route('admin.ads.index')}}?type=trash">Deleted Ads</a></li>
                <li><a href="{{route('admin.ads.create')}}">Add Ads</a></li>

              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('admin.users.index')}}">All users</a></li>
				<li><a href="{{route('admin.users.index')}}?status=active">Active users</a></li>
                <li><a href="{{route('admin.users.index')}}?status=inactive">Inactive users</a></li>
                <li><a href="{{route('admin.users.index')}}?type=trash">Deleted users</a></li>
                <li><a href="{{route('admin.users.create')}}">Add users</a></li>

              </ul>
            </li>
           <li class="dropdown ">
              <a href="#" class="nav-link"><i data-feather="activity"></i><span>Revenue</span></a>
            </li>
            <li class="dropdown "> 
              <a href="#" class="nav-link"><i data-feather="dollar-sign"></i><span>Payments</span></a>
            </li>
             <li class="dropdown ">
              <a href="#" class="nav-link"><i data-feather="bar-chart"></i><span>Reports</span></a>
            </li>
			<li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>Miscellaneous</span></a>
				<ul class="dropdown-menu">
					<li><a href="{{route('admin.country.index')}}">Country</a></li>
					<li><a href="{{route('admin.state.index')}}">State</a></li>
					<li><a href="{{route('admin.city.index')}}">City</a></li>
				</ul>
            </li>
		</ul>
	</aside>
</div>

 