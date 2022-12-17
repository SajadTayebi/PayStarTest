<div class="myaccount-tab-menu nav" role="tablist">

    <a href="{{ route('home.users_profile.index') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
        <i class="sli sli-user ml-1"></i>
        پروفایل
    </a>

    <a href="{{ route('home.orders.users_profile.index') }}" class="{{ request()->is('profile/orders') ? 'active' : '' }}">
        <i class="sli sli-basket ml-1"></i>
        سفارشات
    </a>

    <a href="{{ route('home.addresses.index') }}" class="{{ request()->is('profile/addresses') ? 'active' : '' }}">
        <i class="sli sli-map ml-1"></i>
        آدرس ها‍
    </a>

    <a href="{{ route('home.wishlist.users_profile.index') }}" class="{{ request()->is('profile/wishlist') ? 'active' : '' }}">
        <i class="sli sli-heart ml-1"></i>
        لیست علاقه مندی ها
    </a>

    <a href="{{ route('home.comments.users_profile.index') }}" class="{{ request()->is('profile/comments') ? 'active' : '' }}">
        <i class="sli sli-bubble ml-1"></i>
        نظرات
    </a>

{{--    <form action="{{route('logout')}}" method="post">--}}
{{--        @csrf--}}
{{--        <a onclick="">--}}
{{--            <i class="sli sli-logout ml-1"></i>--}}
{{--            خروج--}}
{{--        </a>--}}
{{--    </form>--}}


    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    خروج
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

</div>
