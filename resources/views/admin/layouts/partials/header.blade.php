<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="javascript:void(0);">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a id="switch-mode" class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{auth()->user()->name}}</span>
                        <span class="user-status">{{auth()->user()->role}}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{auth()->user()->image_url}}" alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                        <i class="mr-50" data-feather="home"></i>
                        {{__('labels.dashboard')}}
                    </a>
                    <a class="dropdown-item" href="{{route('admin.users.show',auth()->id())}}">
                        <i class="mr-50" data-feather="user"></i>
                        {{__('labels.profile')}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('admin.users.show',auth()->id())}}">
                        <i class="mr-50" data-feather="settings"></i>
                        {{__('labels.settings')}}
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit()">
                        <i class="mr-50" data-feather="power"></i>
                       {{__('labels.logout')}}
                    </a>
                </div>
            </li>
        </ul>
        <form action="{{route('admin.logout')}}" method="post" id="logout-form">@csrf</form>
    </div>
</nav>
