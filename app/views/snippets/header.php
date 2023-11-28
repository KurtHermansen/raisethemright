    <header class="header text-white flex flex-row justify-between items-center shadow-lg p-5">
        <div class="flex items-center header-logo">
            <img src="/rthemr/app/views/images/RTR-logos_white.png" alt="Company Logo" class="w-10 mr-2">
            <div>
                <h1 class="text-2xl font-bold font-cinzel">Raise Them Right</h1>
            </div>
        </div>

        <!-- Responsive Navigation -->
        <div class="md:hidden flex items-center">
            <button id="menuBtn" class="text-xl">
                <i class="hamburger fas fa-bars"></i>
                <i class="close fa-solid fa-xmark absolute top-5 right-5 hidden"></i>
            </button>
        </div>


        <nav id="navLinks" class="hidden md:flex flex-grow justify-end pr-8 space-x-4">
            <!-- Check if the user is logged in and has paid -->
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
                <a href="/rthemr" class="text-white">Home</a>
                <a href="/rthemr/welcome" class="text-white">Welcome</a>
                <a href="/rthemr/forum" class="text-white">Forum</a>
                <a href="/rthemr/about" class="text-white">About Us</a>
                <a href="/rthemr/contact" class="text-white">Contact</a>
                <a href="/rthemr/logout" class="text-white">Login Out</a>
            <?php else : ?>
                <a href="/rthemr" class="text-white">Home</a>
                <a href="/rthemr/about" class="text-white">About Us</a>
                <a href="/rthemr/contact" class="text-white">Contact</a>
                <a href="/rthemr/signup" class="text-white">Sign Up</a>
                <a href="/rthemr/login-user" class="text-white">Login</a>
            <?php endif; ?>
        </nav>

    </header>