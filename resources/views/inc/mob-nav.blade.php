 <nav class="navbar bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" onclick="window.history.back(); return false;">
                    <i class="bi bi-arrow-left me-3"></i>
                    <span>@yield('title-bar')</span>
                </a>
                <span>
                    {{-- <a href="#"><i class="bi bi-question-circle"></i></a> --}}
                    @yield('alt-link')
                </span>
            </div>
        </nav>
