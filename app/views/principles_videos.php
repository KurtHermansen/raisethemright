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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($videos as $video) : ?>
                <a href="/rthemr/video/<?= $video['videoID'] ?>" class="block">
                    <section class="p-6 bg-gray-200 rounded-md">
                        <div class="relative bg-gray-200 rounded-md">
                            <video controls class="w-full filter grayscale mb-4">
                                <source src="<?= htmlspecialchars($video['path']) ?>" type="video/mp4">
                            </video>
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <i class="fas fa-play-circle text-white text-5xl"></i>
                            </div>
                        </div>

                        <h2 class="text-xl font-semibold mb-4"><?= htmlspecialchars($video['title']) ?></h2>
                        <p class="text-gray-600"><?= htmlspecialchars($video['description']) ?></p>
                    </section>
                </a>
            <?php endforeach; ?>
        </div>



    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
    </div>
</body>

</html>