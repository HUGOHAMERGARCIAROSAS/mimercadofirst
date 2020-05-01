<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
        </div>

        <div class="navbar-brand">
            <a href="{{ route('admin.index') }}">
                <img src="{{ asset('admin/pyrus/images/LOGO ADMIN.png') }}"
                     alt="Lucid Logo" class="img-responsive logo">
            </a>
        </div>

        <div class="navbar-right">
            <div id="navbar-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#" class="icon-menu"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icon-login"></i>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}"
                              method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>