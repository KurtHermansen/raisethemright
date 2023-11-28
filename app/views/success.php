<?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/meta.php'; ?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/header.php'; ?>

    <main>
        <section class="backgroudimg bg-cover bg-center bg-gray-700 text-white text-center py-32 relative">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 z-10 flex flex-col justify-center items-center">
                <h3 class="text-lg mb-8">"The strength of a nation derives from the integrity of the home."<br>- Confucius</h3>
            </div>
        </section>
        <!-- Success Message Section -->
        <div class="container mx-auto px-4 py-16 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">You signed in successfully!</h1>
            <p class="text-lg mb-8">Welcome to our community. You almost have access to rthemr.com Use the link Below to gain access to all the content. </p>

        </div>
        <script async src="https://js.stripe.com/v3/buy-button.js">
        </script>
        <div class="flex justify-center items-center">
            <script async src="https://js.stripe.com/v3/buy-button.js"></script>
            <stripe-buy-button buy-button-id="buy_btn_1OF8zeAqRXKZiVKLimWyt68i" publishable-key="pk_test_51OEMfZAqRXKZiVKLDG4zt2DOQczQW4YDg7VjXey8sSbldPa0YhTEnwllMlDTur7NbrwpbElx6KH1R8UVJoSvwuGn00W6pavnlB"></stripe-buy-button>
        </div>



    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
    </div>
</body>

</html>