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


        <section class=" py-16 light-gray">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 container mx-auto text-center">
                <h2 class="text-4xl font-bold mb-8 col-span-full">Three Pillars to a Solid Foundation</h2>

                <div class="grid grid-cols-1 gap-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-8 bg-white rounded-lg shadow-lg p-6">
                        <div class="relative">
                            <h3 class="text-2xl font-bold mb-4">Religious Values</h3>
                            <img src="/rthemr/app/views/images/jesus.png" alt="Jesus Image" class="w-200 h-150 mx-auto">
                        </div>
                        <div class="text-left">

                            <p class="text-gray-700 mb-4">The endeavor to instill a strong value base in children through the teachings of Christ is not merely about religious instruction; it is about equipping the next generation with a set of universal principles that can withstand the challenges of any era. These values—love, patience, kindness, forgiveness, and humility—are not exclusive to Christianity but are cornerstones in the foundation of a harmonious society. When children are taught to "love your neighbor as yourself," a commandment from Mark 12:31, they learn to extend beyond their own needs and consider the well-being of others, promoting a culture of altruism and understanding...</p>
                            <a href="/rthemr/values" id="values" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">View Content</a>

                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-8 bg-white rounded-lg shadow-lg p-6">
                        <div class="text-left">
                            <h3 class="text-2xl font-bold mb-4">American Principles</h3>
                            <p class="text-gray-700 mb-4">Inculcating the wisdom of the American Founding Principles into the education of children is a profound act of preparing them for the responsibilities of citizenship and leadership in a free society. These principles are not just historical artifacts; they are the very sinews that hold together the fabric of American democracy. By grounding children in the values of liberty, justice, and the pursuit of happiness, parents are fostering an appreciation for the delicate balance between freedom and responsibility. As James Madison, the Father of the Constitution, emphasized the importance of a well-instructed people to the endurance of democracy, imparting these principles is also to prepare the young to be such well-instructed and vigilant guardians of their own rights and the rights of others...</p>
                            <a href="/rthemr/principles" id="principles" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">View Content</a>

                        </div>
                        <div class="relative">
                            <img src="/rthemr/app/views/images/america.png" alt="american flag on stone wall" class="w-200 h-150 mx-auto">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8">                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-8 bg-white rounded-lg shadow-lg p-6">
                        <div class="relative">
                            <h3 class="text-2xl font-bold mb-4">Moral Character</h3>
                            <img src="/rthemr/app/views/images/Character.jpg" alt="Sculptor working on a self portrait" class="w-200 h-150 mx-auto">
                        </div>
                        <div class="text-left">

                            <p class="text-gray-700 mb-4">Fostering strong moral character in children is essential, as it is the very essence of their future self. This character-building is a complex process that involves more than just teaching right from wrong; it is about cultivating an inner compass that guides them through life's myriad decisions and interactions. Renowned figures throughout history have espoused the virtues of character. For instance, Eleanor Roosevelt, a champion of human rights, said, "People grow through experience if they meet life honestly and courageously. This is how character is built." Her words resonate with the parental role in guiding children to face life with honesty and bravery, thereby shaping a resilient and robust moral fiber...</p>
                            <a href="/rthemr/character" id="character" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">View Content</a>

                        </div>
                    </div>
                    
                </div>

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
                        <h3 class="text-2xl font-bold mb-4">How It Works</h3>
                        <p class="text-gray-700 mb-4">Watch this video to learn more about our process and how to raise them right.</p>
                        <a href="#" class="text-blue-500 hover:underline">Learn More</a>
                    </div>
                </div>
            </div>
        </section>


        <section class="bg-gray-200 py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold mb-8">Testimonials</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 ">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <img src="/rthemr/app/views/images/john.jpg" alt="Client 1" class="w-20 h-30 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-2">John Ramirez</h3>
                            <p class="text-gray-700">Father of 2</p>
                        </div>
                        <p class="text-gray-700 mb-4">"Finding this website was a game-changer for our family. The insights and practical advice on instilling core values in our children have been invaluable. The lessons are easy to understand and apply, making it simpler for us to pass on important life principles to our kids. Our home is now more harmonious, and I've seen a significant positive change in my children's attitudes and behaviors."</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <img src="/rthemr/app/views/images/jane.png" alt="Client 2" class="w-20 h-30 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-2">Jane Lynn</h3>
                            <p class="text-gray-700">Mother of 3 girls and 1 boy</p>
                        </div>
                        <p class="text-gray-700 mb-4">"Balancing work and family life is tough, but this website has given me the tools to teach my kids important life principles. The interactive modules on honesty, hard work, and responsibility resonate with my children, and I see them applying these lessons in their daily lives. It's heartening to watch them grow into responsible and caring individuals. This website is a treasure trove of resources for any parent wanting to lay a strong moral foundation for their children."</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="mb-4">
                            <img src="/rthemr/app/views/images/Susan.jpg" alt="Client 3" class="w-20 h-30 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-bold mb-2">Susan Johnson</h3>
                            <p class="text-gray-700">Grandmother</p>
                        </div>
                        <p class="text-gray-700 mb-4">"As a grandmother, I always look for ways to contribute positively to my grandchildren's upbringing. This website has provided me with fresh perspectives and innovative ideas to impart timeless values to them. I'm confident that these lessons will stay with them for life, shaping them into compassionate and responsible adults."</p>
                    </div>
                </div>
            </div>


    </main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/rthemr/app/views/snippets/footer.php'; ?>
    </div>
</body>

</html>