<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>



<?php include __DIR__ . '../snippets/meta.php'; ?>

<body>
<?php include __DIR__ . '../snippets/header.php'; ?>

    <main>
        <section class="backgroudimg bg-cover bg-center bg-gray-700 text-white text-center py-32 relative">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 z-10 flex flex-col justify-center items-center">
                <h2 class="text-4xl font-bold mb-4">Start Building your Child's</h2>
                <h2 class="text-4xl font-bold mb-4">Strong Moral Foundation Today</h2>
                <p class="text-lg mb-8">"The strength of a nation derives from the integrity of the home."<br>- Confucius</p>
                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">Sign Up</a>
            </div>
        </section>

        <section class=" py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold mb-8">Mission Statement</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="relative">
                        <video id="featuredVideo" class="w-full rounded-lg shadow-lg" controls>
                            <source src="featured-video.mp4" type="video/mp4">
                            <source src="featured-video.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                        <button onclick="playPause()" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white text-gray-800 px-4 py-2 rounded-full shadow-lg hover:bg-gray-100">Play/Pause</button>
                    </div>
                    <div class="text-left">
                        <h3 class="text-2xl font-bold mb-4">Aims and Goals</h3>
                        <p class="text-gray-700 mb-4">Watch this video to learn more about our process and how we can help you achieve your goals.</p>
                        <a href="#" id="learnMoreLink" class="text-blue-500 hover:underline">Learn More</a>
                        <p id="hiddenText" class="text-gray-700 mb-4 hidden">At R Them R, we uphold the belief that certain core values, which some might describe as right-leaning, can play a crucial role in raising well-rounded individuals. We guide parents in crystallizing their own political, religious, and character beliefs, ensuring they're equipped to pass these principles on to their children. Through comprehensive insights and actionable strategies, we aid parents in nurturing these foundational values in the next generation. Our ultimate goal is to foster a brighter future by helping parents 'Raise Them Right.'</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="medium-gray py-16">
                <div class="container mx-auto text-center">
                    <h2 class="text-4xl font-bold mb-8">Sample Principle</h2>

                    <div class="mx-auto max-w-3xl">
                        <video controls class="w-full rounded-lg shadow-lg">
                            <source src="featured-video.mp4" type="video/mp4">
                            <source src="featured-video.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </section>

        <script>
            function playPause() {
                var video = document.getElementById("featuredVideo");
                if (video.paused) {
                    video.play();
                } else {
                    video.pause();
                }
            }
        </script>


    </main>
    <?php include __DIR__ . '../snippets/footer.php'; ?>
    </div>
</body>

</html>