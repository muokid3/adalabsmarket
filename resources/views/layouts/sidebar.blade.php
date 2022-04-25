<div class="sidebar" data-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            CT
        </a>
        <a href="{{url('/')}}" class="simple-text logo-normal">
             Ada Market Admin
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{url('assets/img/faces/avatar.jpg')}}" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                {{ auth()->user()->name }}
                <b class="caret"></b>
              </span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> My Profile </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('logout')}}">
                                <span class="sidebar-mini"> L </span>
                                <span class="sidebar-normal"> Logout </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item {{ \Request::is('dashboard') ? 'active' : '' }} ">
                <a class="nav-link" href="{{url('dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>

            <li class="nav-item {{ \Request::is('admin/blog') ? 'active' : '' }} ">
                <a class="nav-link" href="{{url('admin/blog')}}">
                    <i class="material-icons">widgets</i>
                    <p> Blog </p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                    <i class="material-icons">image</i>
                    <p> Products
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples">
                    <ul class="nav">
                        <li class="nav-item {{ \Request::is('admin/categories') ? 'active' : '' }}">
                            <a class="nav-link" href="{{url('admin/categories')}}">
                                <span class="sidebar-mini"> C </span>
                                <span class="sidebar-normal"> Categories </span>
                            </a>
                        </li>
                        <li class="nav-item {{ \Request::is('admin/products') ? 'active' : '' }} ">
                            <a class="nav-link" href="{{url('admin/products')}}">
                                <span class="sidebar-mini"> P </span>
                                <span class="sidebar-normal"> Products </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#users">
                    <i class="material-icons">image</i>
                    <p> User Management
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="users">
                    <ul class="nav">
                        <li class="nav-item {{ \Request::is('admin/user_groups') ? 'active child' : '' }} ">
                            <a class="nav-link" href="{{url('admin/user_groups')}}">
                                <span class="sidebar-mini"> UG </span>
                                <span class="sidebar-normal"> User Groups </span>
                            </a>
                        </li>
                        <li class="nav-item {{ \Request::is('admin/users') ? 'active child' : '' }}  ">
                            <a class="nav-link" href="{{url('admin/users')}}">
                                <span class="sidebar-mini"> AU </span>
                                <span class="sidebar-normal"> All Users </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
