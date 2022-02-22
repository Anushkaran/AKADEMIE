<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
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
                    <span class="brand-logo ">
                        <img  height="10%" width="10%" src="{{asset('assets/vuexy/app-assets/images/logo/logo.png')}}"/>
                    </span>
                    </a>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{auth()->user()->name}}</span>
                        <span class="user-status">{{auth()->user()->role}}</span>
                    </div>
                    <span class="avatar bg-light-primary">
                       <span class="avatar-content">{{auth('partner')->user()->avatar_name}}</span>
                        <span class="avatar-status-online"></span>
                    </span>

                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('partner.dashboard')}}">
                        <i class="mr-50" data-feather="home"></i>
                        {{__('labels.dashboard')}}
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form').submit()">
                        <i class="mr-50" data-feather="power"></i>
                        {{__('labels.logout')}}
                    </a>
                    <a class="dropdown-item" href="{{route('partner.settings.absence-sheet.index')}}">
                        <i class="mr-50" data-feather="settings"></i>
                        {{trans_choice('labels.settings',2)}}
                    </a>
                </div>
            </li>
        </ul>
        <form action="{{route('partner.logout')}}" method="post" id="logout-form">@csrf</form>
    </div>

</nav>

