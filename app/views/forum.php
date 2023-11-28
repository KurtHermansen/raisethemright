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
        <div class="text-center">
        <h2 class="text-4xl font-bold mb-8 col-span-full">Forum Topics</h2>
        </div>
        

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php foreach ($forumTopics as $topic) : ?>
                <a href="/rthemr/forum/<?= $topic['forumID'] ?>" class="block">
                    <section class="p-6 bg-gray-200 rounded-md">
                        <div class="bg-gray-200 rounded-md mb-4 flex justify-center items-center">
                            <i class="fas fa-comments text-gray-600 text-5xl"></i>
                        </div>

                        <h2 class="text-xl font-semibold mb-4"><?= htmlspecialchars($topic['topic']) ?></h2>
                    </section>
                </a>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
</body>

</html>
