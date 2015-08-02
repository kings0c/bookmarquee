<nav class="top-bar" data-topbar role="navigation">
    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="left">
            <li><a href="{{ URL::to('/') }}">Home</a></li>
        </ul>
        <ul class="right">
            <li><a href="{{ URL::to('/') }}/auth/register">Register</a></li>
            <li><a href="{{ URL::to('/') }}/auth/login">Sign In</a></li>
        </ul>
    </section>
</nav>