<?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/meta.php'; ?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/header.php'; ?>

    <main>
        <section class="welcomeimg bg-cover bg-center bg-gray-700 text-white text-center py-32 relative">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 z-10 flex flex-col justify-center items-center">
                <h2 class="text-2xl font-bold mb-4">"<?php echo $quote['quote']; ?>"</h2>
                <h2 class="text-2xl font-bold mb-4">-<?php echo $quote['author']; ?></h2>
            </div>
        </section>

        <div class="container mx-auto p-4">
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Video and its details -->
                <div class="flex-1">
                    <video controls class="w-full">
                        <source src="<?= htmlspecialchars($video['path']) ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="mt-4">
                        <h2 class="text-2xl font-semibold"><?= htmlspecialchars($video['title']) ?></h2>
                        <p class="text-gray-600 mt-2"><?= htmlspecialchars($video['description']) ?></p>
                    </div>

                    <!-- Comment Section -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-2">Add a Comment</h3>
                        <form method="post" action="/rthemr/submit-videocomment">
                            <textarea class="w-full p-2 border border-gray-300 rounded-md" name="commentText" placeholder="Your comment here"></textarea>
                            <input type="hidden" name="videoID" value="<?= $video['videoID'] ?>">
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Post Comment</button>
                        </form>

                        <!-- Existing Comments -->
                        <div class="mt-4">
                            <div class="mt-4">
                                <h4 class="text-lg font-semibold mb-2">Comments</h4>
                                <?php foreach ($comments as $comment) : ?>
                                    <div class="border-t border-gray-300 pt-2 mt-2">
                                        <p class="text-gray-800"><strong><?= htmlspecialchars($comment['username']) ?>:</strong> <?= htmlspecialchars($comment['commentText']) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    </div>

                    <!-- Related Videos Section -->
                    <div class="w-1/2 md:w-1/4 lg:w-1/3">
                        <h3 class="text-xl font-semibold mb-4">Related Videos</h3>
                        <!-- Iterate over related videos -->
                        <?php foreach ($relatedVideos as $relatedVideo) : ?>
                            <a href="/rthemr/video/<?= $relatedVideo['videoID'] ?>" class="block">
                                <section class="p-6 bg-gray-200 rounded-md mb-2">
                                    <div class="relative bg-gray-200 rounded-md">
                                        <video controls class="w-full filter grayscale mb-4">
                                            <source src="<?= htmlspecialchars($relatedVideo['path']) ?>" type="video/mp4">
                                        </video>
                                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                            <i class="fas fa-play-circle text-white text-5xl"></i>
                                        </div>
                                    </div>

                                    <h2 class="text-xl font-semibold mb-4"><?= htmlspecialchars($relatedVideo['title']) ?></h2>
                                </section>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <!-- End of Example Related Video -->
                </div>
            </div>

    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
    </div>
</body>

</html>