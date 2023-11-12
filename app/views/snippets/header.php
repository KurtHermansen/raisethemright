<div class="">

    <header class="text-white flex justify-between items-center shadow-lg">
        <div class="flex items-center">
            <img src="/rthemr/app/views/images/RTR-logos_white.png" alt="Company Logo" class="w-32 mr-2 rounded-full">
            <div>
                <h1 class="text-2xl font-bold font-cinzel">Raise Them Right</h1>
            </div>
        </div>

<!-- Responsive Navigation -->
<div class="md:hidden flex items-center">
    <button id="menuBtn" class="text-xl">
        <i class="fas fa-bars"></i>
    </button>
</div>


        <nav id="navLinks" class="hidden md:flex flex-grow justify-end pr-8 space-x-4">
            <!-- Check if the user is logged in and has paid -->
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && isset($_SESSION['has_paid']) && $_SESSION['has_paid']): ?>
                <a href="welcome" class="text-white">Welcome</a>
                <a href="foundations" class="text-white">Foundations</a>
                <a href="about" class="text-white">About Us</a>
                <a href="services" class="text-white">Store</a>
                <a href="contact" class="text-white">Contact</a>
            <?php else: ?>
                <a href="/rthemr" class="text-white">Home</a>
                <a href="welcome" class="text-white">Welcome</a>
                <a href="foundations" class="text-white">Foundations</a>
                <a href="about" class="text-white">About Us</a>
                <a href="services" class="text-white">Store</a>
                <a href="contact" class="text-white">Contact</a>
                <a href="login" class="text-white">Login</a>
                <a href="/login/google" class="text-white">Sign Up</a>
            <?php endif; ?>
        </nav>

    </header>