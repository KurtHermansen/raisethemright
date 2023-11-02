

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Complex Styled Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="/rthemr/app/views/images/favicon-32x32.png">
    <style>
        body {
            background-color: #a3a3a3;
            color: #52525B;
            font-family: 'Arial', sans-serif;
            margin-top: 56px; /* Add margin to account for the fixed navbar */
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.8); /* Make the initial navbar background transparent with a slight opacity */
            backdrop-filter: blur(10px); /* Apply a blur effect to the background */
            transition: background-color 0.3s, backdrop-filter 0.3s; /* Add smooth transition effect */
        }

        .navbar.fixed-top.scrolled {
            background-color: rgba(255, 255, 255, 0.8); /* Change background color when scrolled */
        }

        .section {
            padding: 100px 0;
        }

        .section-heading {
            margin-bottom: 60px;
        }

        .section-heading h2 {
            font-size: 2.5rem;
        }

        .description-image-section {
            background-color: #fff;
        }

        .description-image-section .row {
            display: flex;
            align-items: center;
        }

        .description-image-section .description {
            padding: 30px;
        }

        .description-image-section .description h3 {
            margin-bottom: 20px;
        }

        .description-image-section .image img {
            max-width: 100%;
            height: auto;
        }

        .column-section .card {
            border: none;
            margin-bottom: 30px;
        }

        .column-section .card img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">Your Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#singleColumn">Single Column</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#doubleColumn">Double Column</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tripleColumn">Triple Column</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#descImage">Description with Image</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Single Column Section -->
    <section id="singleColumn" class="section">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Single Column Section</h2>
                <p>Content in a single column layout.</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut suscipit odio. Integer non
                        lacinia libero. Pellentesque euismod libero ut urna dictum vehicula. Etiam ut metus at mi
                        vestibulum bibendum.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Double Column Section -->
    <section id="doubleColumn" class="section">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Double Column Section</h2>
                <p>Content in a two column layout.</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut suscipit odio. Integer non
                        lacinia libero. Pellentesque euismod libero ut urna dictum vehicula.</p>
                </div>
                <div class="col-md-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut suscipit odio. Integer non
                        lacinia libero. Pellentesque euismod libero ut urna dictum vehicula.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Triple Column Section -->
    <section id="tripleColumn" class="section">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Triple Column Section</h2>
                <p>Content in a three column layout.</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut suscipit odio. Integer non
                        lacinia libero.</p>
                </div>
                <div class="col-md-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut suscipit odio. Integer non
                        lacinia libero.</p>
                </div>
                <div class="col-md-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut suscipit odio. Integer non
                        lacinia libero.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Description with Image Section -->
    <section id="descImage" class="description-image-section section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 description">
                    <h3>Description Title</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut suscipit odio. Integer non
                        lacinia libero. Pellentesque euismod libero ut urna dictum vehicula.</p>
                </div>
                <div class="col-md-6 image">
                    <img src="image-placeholder.jpg" alt="Image">
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add scroll event listener to navbar
            $(window).scroll(function() {
                // Check if user has scrolled down enough to apply styles
                if ($(this).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        });
    </script>

</body>

</html>


        <!-- <section class="bg-gray-300 py-16">
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
                    </div> -->
                    <!-- <div class="text-left">
                        <h3 class="text-2xl font-bold mb-4">Aims and Goals</h3>
                        <p class="text-gray-700 mb-4">Watch this video to learn more about our process and how we can help you achieve your goals.</p>
                        <a href="#" class="text-blue-500 hover:underline">Learn More</a>
                        <p class="text-gray-700 mb-4">At R Them R, we uphold the belief that certain core values, which some might describe as right-leaning, can play a crucial role in raising well-rounded individuals. We guide parents in crystallizing their own political, religious, and character beliefs, ensuring they're equipped to pass these principles on to their children. Through comprehensive insights and actionable strategies, we aid parents in nurturing these foundational values in the next generation. Our ultimate goal is to foster a brighter future by helping parents 'Raise Them Right.'</p>
                    </div> -->
                <!-- </div>
            </div>
        </section> -->