<nav class="top-bar" data-topbar role="navigation">
    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="left">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="{{ URL::to('/') }}/dashboard">Dashboard</a></li>
            <li><a href="{{ URL::to('/bookmark') }}">Bookmarks</a></li>
        </ul>
        <ul class="right">
            <li><a href="{{ URL::to('/') }}/auth/logout">Logout</a></li>
        </ul>
    </section>
</nav>