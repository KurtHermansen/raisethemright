<?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/meta.php'; ?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/header.php'; ?>

    <main>
        <section class="bg-gray-100 py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold mb-8">Latest Projects</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-lg shadow-lg">
                        <img src="project-1.jpg" alt="Project 1" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4">Project Title 1</h3>
                            <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="#" class="text-blue-500 hover:underline">Read More</a>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg">
                        <img src="project-2.jpg" alt="Project 2" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4">Project Title 2</h3>
                            <p class="text-gray-700 mb-4">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <a href="#" class="text-blue-500 hover:underline">Read More</a>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg">
                        <img src="project-3.jpg" alt="Project 3" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-4">Project Title 3</h3>
                            <p class="text-gray-700 mb-4">Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                            <a href="#" class="text-blue-500 hover:underline">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-gray-200 py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold mb-8">Testimonials</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <img src="testimonial-1.jpg" alt="Client 1" class="w-20 h-20 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-2">John Doe</h3>
                            <p class="text-gray-700">Web Developer</p>
                        </div>
                        <p class="text-gray-700 mb-4">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non metus ut ex luctus bibendum in eu purus."</p>
                        <div class="text-blue-500 hover:underline">- Client Name</div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <img src="testimonial-2.jpg" alt="Client 2" class="w-20 h-20 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-2">Jane Smith</h3>
                            <p class="text-gray-700">Digital Marketer</p>
                        </div>
                        <p class="text-gray-700 mb-4">"Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris."</p>
                        <div class="text-blue-500 hover:underline">- Client Name</div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <img src="testimonial-3.jpg" alt="Client 3" class="w-20 h-20 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-2">Mike Johnson</h3>
                            <p class="text-gray-700">UX Designer</p>
                        </div>
                        <p class="text-gray-700 mb-4">"Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."</p>
                        <div class="text-blue-500 hover:underline">- Client Name</div>
                    </div>
                </div>
            </div>
            <section class="bg-gray-300 py-16">
                <div class="container mx-auto text-center">
                    <h2 class="text-4xl font-bold mb-8">Featured Video</h2>

                    <div class="mx-auto max-w-3xl">
                        <video controls class="w-full rounded-lg shadow-lg">
                            <source src="featured-video.mp4" type="video/mp4">
                            <source src="featured-video.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </section>


            <section class="bg-gray-300 py-16">
                <div class="container mx-auto text-center">
                    <h2 class="text-4xl font-bold mb-8">Featured Video</h2>

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
                            <h3 class="text-2xl font-bold mb-4">How We Work</h3>
                            <p class="text-gray-700 mb-4">Watch this video to learn more about our process and how we can help you achieve your goals.</p>
                            <a href="#" class="text-blue-500 hover:underline">Learn More</a>
                        </div>
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
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
    </div>
</body>

</html>