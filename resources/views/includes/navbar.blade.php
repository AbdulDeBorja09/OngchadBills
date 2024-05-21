<nav class="navbar navbar-expand-md">
    <div class="nav-buttons">
        <a class="home-btn" href="{{ url('/') }}"> <i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#btn"
            aria-controls="btn"
            aria-expanded="false"
            aria-label="Toggle navigation"
            style="border: 0"
        >
            <i class="fa fa-navicon"></i>
        </button>
    </div>
    <div class="nav-item" id="btn">
        <a class="nav-link" href="{{ url('/payments') }}">PAYMENTS</a>
        <a class="nav-link" href="{{ url('/history') }}">HISTORY</a>
        <a class="nav-link" href="{{ url('/apartment') }}">APARTMENTS</a>
        <a class="nav-link" href="{{ url('/submeter') }}">SUBMETERS</a>
        <a class="nav-link" href="{{ url('/computation') }}">COMPUTATION</a>
    </div>
</nav>