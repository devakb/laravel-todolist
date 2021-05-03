<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        {{ config('app.name', 'Laravel Todolist') }}
    </div>
    <ul class="c-sidebar-nav ps">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link  @if(request()->routeIs('dashboard')) bg-primary @endif" href="{{ route('dashboard') }}">
                Dashboard
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link  @if(request()->routeIs('todolist')) bg-primary @endif" href="{{ route('todolist') }}">
                Todo List
            </a>
        </li>

        <li class="c-sidebar-nav-item mt-auto">
            <a class="c-sidebar-nav-link c-sidebar-nav-link-danger" href="{{ route('logout') }}" target="_top">
                Logout
            </a>
        </li>
</div>
