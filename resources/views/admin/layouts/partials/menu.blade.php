<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('admin.dashboard')}}">
                    <span class="brand-logo ">
                        <img src="{{asset('assets/vuexy/app-assets/images/logo/logo.png')}}"/>
                    </span>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" {{request()->routeIs('admin.dashboard') ? 'active' : ''}} nav-item">
                <a class="d-flex align-items-center" href="{{route('admin.dashboard')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Home">{{__('labels.dashboard')}}</span>
                </a>
            </li>

{{--            USERS--}}



            <li class="nav-item {{request()->routeIs(['admin.user*','admin.admins*']) ? 'open' : ''}}">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="Account">
                        {{trans_choice('labels.accounts',2)}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{request()->routeIs('admin.admins*') ? 'active' : ''}}">
                        <a class="d-flex align-items-center" href="{{route('admin.admins.index')}}">
                            <i data-feather="user-plus"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">{{trans_choice('labels.admin',2)}}</span>
                        </a>
                    </li>

                    <li class="{{request()->routeIs('admin.users*') ? 'active' : ''}}">
                        <a class="d-flex align-items-center" href="{{route('admin.users.index')}}">
                            <i data-feather="user"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">{{trans_choice('labels.user',2)}}</span>
                        </a>
                    </li>

                    <li class="{{request()->routeIs('admin.partners*') ? 'active' : ''}}">
                        <a class="d-flex align-items-center" href="{{route('admin.partners.index')}}">
                            <i data-feather="users"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">{{trans_choice('labels.partner',2)}}</span>
                        </a>
                    </li>
                </ul>
            </li>







{{--            Evaluations--}}

            <li>
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="Evaluation">
                        {{trans_choice('labels.evaluation',2)}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li class=" {{request()->routeIs('admin.centers*') ? 'active' : ''}} nav-item">
                        <a class="d-flex align-items-center" href="{{route('admin.centers.index')}}">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">{{trans_choice('labels.center',2)}}</span>
                        </a>
                    </li>
                    <li class=" {{request()->routeIs('admin.evaluations*') ? 'active' : ''}} nav-item">
                        <a class="d-flex align-items-center" href="{{route('admin.evaluations.index')}}">
                            <i data-feather="check"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">{{trans_choice('labels.session',2)}}</span>
                        </a>
                    </li>
                    <li class=" {{request()->routeIs('admin.students*') ? 'active' : ''}} nav-item">
                        <a class="d-flex align-items-center" href="{{route('admin.students.index')}}">
                            <i data-feather="user-check"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">{{trans_choice('labels.student',2)}}</span>
                        </a>
                    </li>
                    <li class=" {{request()->routeIs('admin.thematics*') ? 'active' : ''}} nav-item">
                        <a class="d-flex align-items-center" href="{{route('admin.thematics.index')}}">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">{{trans_choice('labels.thematics',2)}}</span>
                        </a>
                    </li>
                </ul>
            </li>


{{--            SKILLS AND LEVELS --}}


            <li>
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Evaluation">
                        {{trans_choice('labels.skill',2)}}
                    </span>
                </a>


                <ul class="menu-content">

                    <li class=" {{request()->routeIs('admin.skills*') ? 'active' : ''}} nav-item">

                        <a class="d-flex align-items-center" href="{{route('admin.skills.index')}}">
                            <i data-feather="check-circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">{{trans_choice('labels.poleCompetence',2)}}</span>
                        </a>
                    </li>

                    <li class=" {{request()->routeIs('admin.tasks*') ? 'active' : ''}} nav-item">
                        <a class="d-flex align-items-center" href="{{route('admin.tasks.index')}}">
                            <i data-feather="edit"></i>
                            <span class="menu-title text-truncate" data-i18n="Task">{{trans_choice('labels.task',2)}}</span>
                        </a>
                    </li>

                    <li class=" {{request()->routeIs('admin.levels*') ? 'active' : ''}} nav-item">
                        <a class="d-flex align-items-center" href="{{route('admin.levels.index')}}">
                            <i data-feather="check"></i>
                            <span class="menu-title text-truncate" data-i18n="Task">{{trans_choice('labels.level',2)}}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="class= {{request()->routeIs('admin.resources.index*') ? 'active' : ''}} nav-item">
                <a class="d-flex align-items-center" href="{{route('admin.resources.index')}}">

                        <i data-feather="file"></i>
                        <span class="menu-title text-truncate" data-i18n="Resources">
                            {{__('labels.resources')}}
                        </span>
                </a>
            </li>
            <li class="class= {{request()->routeIs('admin.resource-categories.*') ? 'active' : ''}} nav-item">
                <a class="d-flex align-items-center" href="{{route('admin.resource-categories.index')}}">

                        <i data-feather="file"></i>
                        <span class="menu-title text-truncate" data-i18n="Category">
                            {{trans_choice('labels.resource-category',1)}}
                        </span>
                </a>
            </li>

            <li class="class= {{request()->routeIs('admin.pedagogical-referents.*') ? 'active' : ''}} nav-item">
                <a class="d-flex align-items-center" href="{{route('admin.pedagogical-referents.index')}}">

                    <i data-feather="file"></i>
                    <span class="menu-title text-truncate" data-i18n="Category">
                            {{trans_choice('labels.pedagogical-referent',1)}}
                        </span>
                </a>
            </li>


        </ul>
    </div>
</div>
