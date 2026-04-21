<header class="ease">
    <div class="contain">
        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ get_site_image_src('images', $site_settings->site_logo) }}" alt="">
            </a>
        </div>
        <div class="toggle"><span></span></div>
        <nav class="ease" nav id="nav">
            <ul>
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">Home</a>
                </li>

                <li class="{{ Request::is('aviva-pools') ? 'active' : '' }}">
                    <a href="{{ url('aviva-pools') }}">Aviva Pools</a>
                </li>

                <li class="drop {{ Request::is('renaissance-patio') || Request::is('stick-built') ? 'active' : '' }}">
                    <a href="javascript:void(0)">Patio Covers</a>
                    <ul class="sub">
                        <li><a href="{{ url('renaissance-patio') }}">Renaissance Patio</a></li>
                        <li><a href="{{ url('stick-built') }}">Stick Built</a></li>
                    </ul>
                </li>

                <li class="{{ Request::is('hardscapes') ? 'active' : '' }}">
                    <a href="{{ url('hardscapes') }}">Hardscapes</a>
                </li>

                <li class="{{ Request::is('colors') ? 'active' : '' }}">
                    <a href="{{ url('colors') }}">Colors</a>
                </li>

                <li class="{{ Request::is('about') ? 'active' : '' }}">
                    <a href="{{ url('about') }}">About Us</a>
                </li>

                <li class="{{ Request::is('request-quote') ? 'active' : '' }}">
                    <a href="{{ url('request-quote') }}" class="site_btn">Request a Quote</a>
                </li>



            </ul>
        </nav>
        <div class="clearfix"></div>
    </div>
</header>
<!-- header -->

<div class="pBar hidden"><span id="myBar" style="width:0%"></span></div>