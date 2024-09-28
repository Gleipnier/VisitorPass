
<div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="{{asset('/admincss/img/placeholderhuman.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h5">Admin</h1>
              <p>Developer</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
                  <li class="active"><a href="{{url('admin/dashboard')}}"> <i class="icon-home"></i>Home </a></li>
                  <li><a href="{{url('view_category')}}"> <i class="icon-grid"></i>Category </a></li>
                  <li><a href="{{url('scanner')}}"> <i class="fa fa-bar-chart"></i>Scanner </a></li>
                  <li><a href="{{url('statistics')}}"> <i class="fa fa-bar-chart"></i>Visitors </a></li>
                  <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                      <li><a href="#">Page</a></li>
                      <li><a href="#">Page</a></li>
                      <li><a href="#">Page</a></li>
                    </ul>
                  </li>
        </nav>