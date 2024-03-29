<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->profile_picture ? asset(viewImage(auth()->user()->profile_picture,'dashboard_files/admins_pictures/')) : asset('dashboard_files/admins_pictures/blank.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

{{--            <li class="treeview">--}}
{{--                <a href="#">--}}
{{--                    <i class="fa fa-mars-double"></i> <span>Admins</span> <i class="fa fa-angle-left pull-right"></i>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    <li><a href="{{route('admins.index')}}"><i class="fa fa-circle-o"></i>View</a></li>--}}
{{--                    <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li><a href="{{route('dashboard.admins.index')}}"><i class="fa fa-mars-double"></i> <span>@lang('dashboard.admins')</span></a></li>
            <li><a href="{{route('dashboard.users.index')}}"><i class="fa fa-mars-double"></i> <span>@lang('dashboard.users')</span></a></li>
            <li><a href="{{route('dashboard.requests.index')}}"><i class="fa fa-mars-double"></i> <span>@lang('dashboard.requests')</span></a></li>
            <li><a href="{{route('dashboard.posts.index')}}"><i class="fa fa-mars-double"></i> <span>@lang('dashboard.posts')</span></a></li>
{{--            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-th"></i><span>@lang('site.dashboard')</span></a></li>--}}

{{--            @if (auth()->user()->hasPermission('read_categories'))--}}
{{--                <li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-th"></i><span>@lang('site.categories')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_products'))--}}
{{--                <li><a href="{{ route('dashboard.products.index') }}"><i class="fa fa-th"></i><span>@lang('site.products')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_clients'))--}}
{{--                <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-th"></i><span>@lang('site.clients')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_orders'))--}}
{{--                <li><a href="{{ route('dashboard.orders.index') }}"><i class="fa fa-th"></i><span>@lang('site.orders')</span></a></li>--}}
{{--            @endif--}}

{{--            @if (auth()->user()->hasPermission('read_users'))--}}
{{--                <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-th"></i><span>@lang('site.users')</span></a></li>--}}
{{--            @endif--}}

            {{--<li><a href="{{ route('dashboard.categories.index') }}"><i class="fa fa-book"></i><span>@lang('site.categories')</span></a></li>--}}
            {{----}}
            {{----}}
            {{--<li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>--}}

            {{--<li class="treeview">--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-pie-chart"></i>--}}
            {{--<span>الخرائط</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li>--}}
            {{--<a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
        </ul>

    </section>

</aside>

