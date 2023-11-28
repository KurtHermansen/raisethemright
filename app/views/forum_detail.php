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

        <div class="container mx-auto p-6">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($forumTopic['topic']) ?></h1>
                <!-- Forum Topic Content Goes Here -->

                <!-- Comments Section -->
                <h2 class="text-2xl font-bold mt-6 mb-4">Forum</h2>
                <?php foreach ($comments as $comment) : ?>
                    <div class="bg-gray-100 p-4 rounded mb-4">
                        <p class="font-semibold"><?= htmlspecialchars($comment['username']) ?>:</p>
                        <p><?= htmlspecialchars($comment['forumcommentText']) ?></p>
                    </div>
                <?php endforeach; ?>

                <!-- Add a Comment Form -->
                <form method="post" action="/rthemr/submit-forumcomment">
                    <textarea name="commentText" class="w-full p-2 border border-gray-300 rounded mt-4" rows="4" placeholder="Add a comment..."></textarea>
                    <input type="hidden" name="forumID" value="<?= $forumID ?>">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Submit Comment</button>
                </form>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
</body>

</html>
