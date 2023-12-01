<?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/meta.php'; ?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/header.php'; ?>

    <main>
        <section class="backgroudimg bg-cover bg-center bg-gray-700 text-white text-center py-32 relative">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 z-10 flex flex-col justify-center items-center">
                <h2 class="text-4xl font-bold mb-4">Start Building your Child's Strong Moral Foundation Today</h2>
                <p class="text-lg mb-8">"The strength of a nation derives from the integrity of the home."<br>- Confucius</p>
                <a href="signup" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">Sign Up</a>
            </div>
        </section>

        <!-- Contact Us Form Section -->
        <section class="py-32 bg-gray-200 text-gray-700">
            <div class="container mx-auto">
                <h2 class="text-4xl font-bold text-center mb-8">Contact Us</h2>
                <form action="#" method="post" class="max-w-md mx-auto">
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold mb-2">Name:</label>
                        <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold mb-2">Email:</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-semibold mb-2">Message:</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-3 py-2 border rounded" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">Submit</button>
                    </div>
                </form>
            </div>
        </section>

    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
</body>
</html>
