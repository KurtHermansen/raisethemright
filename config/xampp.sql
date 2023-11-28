-- -----------------------------------------------------
-- Schema dbs12191674
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbs12191674` DEFAULT CHARACTER SET utf8 ;
USE `dbs12191674` ;
-- -----------------------------------------------------
-- Table `dbs12191674`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`user` (
  `userID` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NULL,
  `lname` VARCHAR(45) NULL,
  `username` VARCHAR(150) NULL,
  `password` VARCHAR(45) NULL,
  `email` VARCHAR(150) NULL,
  `login` tinyint(1) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`userID`))
  AUTO_INCREMENT = 1000;

-- -----------------------------------------------------
-- Table `dbs12191674`.`video`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `dbs12191674`.`video` (
  `videoID` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(5000) NULL,
  `path` VARCHAR(150) NULL,
  `category` VARCHAR(45) NULL,
  PRIMARY KEY (`videoID`))
AUTO_INCREMENT = 1000;

-- -----------------------------------------------------
-- Table `dbs12191674`.`forum`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `dbs12191674`.`forum` (
  `forumID` INT NOT NULL AUTO_INCREMENT,
  `topic` VARCHAR(45) NULL,
  PRIMARY KEY (`forumID`))
AUTO_INCREMENT = 1000;

-- -----------------------------------------------------
-- Table `dbs12191674`.`forumcomments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`forumcomments` (
  `forumcommentsID` INT NOT NULL AUTO_INCREMENT,
  `forumcommentText` VARCHAR(5000) NULL,
  `userID` INT NOT NULL,
  `forumID` INT NOT NULL,
  PRIMARY KEY (`forumcommentsID`),
  INDEX `fk_forumcomments_user_idx` (`userID` ASC),
  INDEX `fk_forumcomments_forum1_idx` (`forumID` ASC),
  CONSTRAINT `fk_forumcomments_user`
    FOREIGN KEY (`userID`)
    REFERENCES `dbs12191674`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_forumcomments_forum1`
    FOREIGN KEY (`forumID`)
    REFERENCES `dbs12191674`.`forum` (`forumID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `dbs12191674`.`quote`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `dbs12191674`.`quotes` (
  `quoteID` INT NOT NULL AUTO_INCREMENT,
  `category` VARCHAR(45) NULL,
  `quote` VARCHAR(5000) NULL,
  `author` VARCHAR(150) NULL,
  PRIMARY KEY (`quoteID`))
AUTO_INCREMENT = 1;



-- -----------------------------------------------------
-- Table `dbs12191674`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`comments` (
  `commentsID` INT NOT NULL AUTO_INCREMENT,
  `commentText` VARCHAR(5000) NULL,
  `userID` INT NOT NULL,
  `videoID` INT NOT NULL,
  PRIMARY KEY (`commentsID`),
  INDEX `fk_comments_user_idx` (`userID` ASC),
  INDEX `fk_comments_video1_idx` (`videoID` ASC),
  CONSTRAINT `fk_comments_user`
    FOREIGN KEY (`userID`)
    REFERENCES `dbs12191674`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_video1`
    FOREIGN KEY (`videoID`)
    REFERENCES `dbs12191674`.`video` (`videoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



-- -----------------------------------------------------
-- Table `dbs12191674`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`task` (
  `taskID` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(2000) NULL,
  `complete` TINYINT NULL,
  `userID` INT NOT NULL,
  `videoID` INT NOT NULL,
  PRIMARY KEY (`taskID`),
  INDEX `fk_task_user1_idx` (`userID` ASC),
  INDEX `fk_task_video1_idx` (`videoID` ASC),
  CONSTRAINT `fk_task_user1`
    FOREIGN KEY (`userID`)
    REFERENCES `dbs12191674`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_video1`
    FOREIGN KEY (`videoID`)
    REFERENCES `dbs12191674`.`video` (`videoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



-- -----------------------------------------------------
-- Table `dbs12191674`.`timestamps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`timestamps` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL,
  `taskID` INT NOT NULL,
  `commentsID` INT NOT NULL,
  `userID` INT NOT NULL,
  INDEX `fk_timestamps_task1_idx` (`taskID` ASC),
  INDEX `fk_timestamps_comments1_idx` (`commentsID` ASC),
  INDEX `fk_timestamps_user1_idx` (`userID` ASC),
  CONSTRAINT `fk_timestamps_task1`
    FOREIGN KEY (`taskID`)
    REFERENCES `dbs12191674`.`task` (`taskID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_timestamps_comments1`
    FOREIGN KEY (`commentsID`)
    REFERENCES `dbs12191674`.`comments` (`commentsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_timestamps_user1`
    FOREIGN KEY (`userID`)
    REFERENCES `dbs12191674`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


    INSERT INTO video (videoID, title, description, path, category)
VALUES
(DEFAULT, 'Liberty/Freedom', 'Liberty, often interchanged with freedom, is one of the foundational tenets of democratic societies. It is a state where individuals are free from undue restrictions and constraints imposed by higher authorities, allowing them to pursue happiness, voice their opinions, and make choices about their lives. Historically, the fight for liberty has been a driving force behind revolutions and social movements. Nelson Mandela''s words, “For to be free is not merely to cast off one''s chains, but to live in a way that respects and enhances the freedom of others,” underscores that genuine freedom is not just personal but also collective. It''s a symbiotic relationship where the freedom of one person is linked to the freedom of all.', 'app/video/LibertyFreedom', 'principles'),
(DEFAULT, 'Responsibility', 'Responsibility is an intrinsic moral compass that governs our actions and decisions. It serves as the backbone of mature societies, compelling individuals to act conscientiously and bear the consequences of their actions. Eleanor Roosevelt''s statement, “In the long run, we shape our lives, and we shape ourselves. The choices we make are ultimately our responsibility,” beautifully captures the essence of autonomy and the weight of decision-making. Responsibility is an acknowledgment that our choices ripple out, influencing ourselves, others, and the world around us.', 'app/video/Responsibility', 'principles'),
(DEFAULT, 'Prosperity', 'Prosperity, while commonly associated with material wealth, transcends monetary boundaries. It encapsulates the holistic well-being of individuals, communities, and nations. Prosperity signifies thriving economies, robust health, and enriched lives. As Rose Kennedy noted, “Prosperity tries the fortunate, adversity the great,” suggesting that prosperity, while desirable, also presents its own set of challenges and tests. A truly prosperous society is not just wealthy but is also resilient, equitable, and forward-looking.', 'app/video/Prosperity', 'principles'),
(DEFAULT, 'Independence', 'Independence is the embodiment of autonomy and self-reliance. Whether referring to nations breaking free from colonial rule or individuals charting their unique paths, independence is a celebration of sovereignty. As Susan B. Anthony astutely observed, “Independence is happiness.” To be independent is to be unshackled from external controls, allowing one''s internal compass to guide the way.', 'app/video/Independence', 'principles'),
(DEFAULT, 'Opportunity', 'Opportunity is the gateway to growth, innovation, and progress. It represents moments where circumstances align, providing a favorable platform to achieve, grow, and advance. Chris Grosser''s insight, “Opportunities don''t happen. You create them,” underscores the proactive nature of opportunities. It''s not enough to wait passively; seizing or creating opportunities requires effort, vision, and initiative.', 'app/video/Opportunity', 'principles'),
(DEFAULT, 'Equality', 'At its core, equality champions the belief that all individuals, irrespective of race, gender, or background, deserve equal rights, opportunities, and respect. It challenges hierarchies and biases, advocating for a level playing field. Sonia Sotomayor''s reflection, “Until we get equality in education, we won''t have an equal society,” highlights the foundational role of education in establishing equality, emphasizing the interconnectedness of societal systems.', 'app/video/Equality', 'principles'),
(DEFAULT, 'Civic Duty', 'Civic duty is the social contract individuals have with their communities and nations. It encapsulates the responsibilities of citizenship, ranging from voting to community service. Theodore Roosevelt''s sentiment, “The first requisite of a good citizen in this republic of ours is that he shall be able and willing to pull his own weight,” underscores that a thriving democracy is a collective effort, relying on the active participation of its citizenry.', 'app/video/CivicDuty', 'principles'),
(DEFAULT, 'Self-Reliance', 'Self-reliance champions the virtues of independence and self-trust. Rooted in the belief that individuals possess the tools to navigate their destinies, it encourages autonomy and resilience. Ralph Waldo Emerson''s call to “Trust thyself: every heart vibrates to that iron string,” is a poignant reminder of the strength within, urging individuals to trust their instincts and capabilities.', 'app/video/SelfReliance', 'principles'),
(DEFAULT, 'Justice', 'Justice is the moral cornerstone of civilizations. It represents fairness, equity, and righteousness, ensuring that individuals are treated impartially. Martin Luther King Jr.''s proclamation, “Injustice anywhere is a threat to justice everywhere,” underscores the interconnectedness of justice. A single act of injustice can destabilize the very fabric of a just society, emphasizing the continuous vigilance required to uphold justice.', 'app/video/Justice', 'principles'),
(DEFAULT, 'Frugality', 'Frugality is the art of judicious living. More than mere penny-pinching, it''s about appreciating value, avoiding waste, and making thoughtful choices. Benjamin Franklin''s cautionary words, “Beware of little expenses; a small leak will sink a great ship,” encapsulate the essence of frugality. It''s a reminder that being mindful of the small things can prevent larger catastrophes, promoting a life of reflection and intention.', 'app/video/Frugality', 'principles');


INSERT INTO video (title, description, path, category)
VALUES
('Love', 'In the religious context, love is often considered the greatest and most fundamental virtue. It transcends mere affection or emotional bonds, encompassing a selfless, sacrificial willingness to seek the best for others. Many religions advocate for love not only towards kin and friends but also towards strangers, enemies, and the divine. This universal love is captured in the Christian scripture where it is said, "God is love, and whoever abides in love abides in God, and God abides in him" (1 John 4:16). Love, in its purest religious sense, becomes a reflection of the divine within human interactions.', 'app/video/Love', 'values'),
('Faith', 'Faith is a principle that operates on belief and trust in the divine, often without requiring empirical evidence. It is the assurance in things unseen, providing a foundation for religious beliefs and practices. Faith is a personal journey and experience, where one aligns with the divine will and guidance. The Biblical verse, "Now faith is the assurance of things hoped for, the conviction of things not seen" (Hebrews 11:1), encapsulates the essence of faith as a conviction that guides believers through uncertainty.', 'app/video/Faith', 'values'),
('Hope', 'Hope, within a religious framework, is the confident expectation of what is promised by the divine. It is a forward-looking virtue, grounded in the faith that positive outcomes lie ahead. This hope is not based on human predictions but on divine assurance. It is a sustaining force for believers, especially during times of trials and tribulations. As stated in religious texts, such as the Bible, hope is what anchors the soul, providing stability and confidence (Hebrews 6:19).', 'app/video/Hope', 'values'),
('Charity/Service', 'Charity or service is a principle that manifests through acts of love and kindness towards others. It''s about giving of oneself – time, resources, abilities – for the benefit of others, without seeking personal gain. Many religious traditions emphasize the importance of serving the less fortunate, often considering service to others as service to the divine. In Christianity, the principle of service is exemplified by Jesus washing the feet of his disciples, an act of humility and service.', 'app/video/CharityService', 'values'),
('Mercy', 'Mercy is a compassionate response that withholds deserved punishment and instead offers kindness and forgiveness. It''s a principle deeply rooted in the character of the divine in many religious traditions, where the divine is often depicted as merciful and forgiving. Followers are encouraged to emulate this attribute through forgiving those who wrong them and extending kindness where harshness might be expected.', 'app/video/Mercy', 'values'),
('Obedience', 'Obedience in a religious sense is compliance with the divine will and teachings. It represents a voluntary submission out of respect and reverence for the divine authority. Obedience is often linked with the idea of discipline in following religious practices and moral codes, viewing adherence as a path to spiritual growth and fulfillment.', 'app/video/Obedience', 'values'),
('Honesty', 'Honesty is the principle of truthfulness and integrity. It involves being truthful in words and actions, as well as being authentic in one’s faith and convictions. Honesty is considered essential to the fabric of a religious community, as it builds trust and reflects the divine nature. Many religions teach that honesty is not just a social virtue but a spiritual mandate.', 'app/video/Honesty', 'values'),
('Forgiveness', 'Forgiveness is the act of pardoning an offender and letting go of resentment. It is a principle that liberates both the forgiver and the forgiven from the bonds of anger and retribution. In many faiths, forgiveness is a divine attribute that believers are encouraged to practice, following the example of the divine mercy that forgives human shortcomings.', 'app/video/Forgiveness', 'values'),
('Gratitude', 'Gratitude is the recognition and appreciation of the blessings and gifts received. It is an acknowledgment of the benevolence of the divine and the generosity of others. Gratitude is a common theme in religious prayers and practices, where believers express thanks for life, health, provision, and spiritual guidance.', 'app/video/Gratitude', 'values'),
('Purity', 'Purity is a multifaceted principle involving the cleanliness of body, mind, and spirit. It encompasses moral integrity and the avoidance of actions or thoughts considered spiritually harmful. Purity is often associated with rituals and lifestyles that promote holiness and health, reflecting a state of living that is in harmony with the divine will.', 'app/video/Purity', 'values'),
('Generosity', 'Generosity is the willingness to give freely and abundantly. It is not limited to material possessions but also includes sharing knowledge, time, and talent. It’s a reflection of the divine generosity that many religions teach should be mirrored by the faithful. Generosity is seen as a way to lessen attachment to material possessions and to cultivate a spirit of giving.', 'app/video/Generosity', 'values'),
('Humility', 'Humility is the quality of being humble and recognizing one’s own limitations and fallibility. In religious contexts, humility is a virtue that opposes pride and arrogance, encouraging believers to regard others as equal or higher than themselves. It is often seen as the correct stance before the divine—acknowledging one''s dependency on the divine grace.', 'app/video/Humility', 'values');


INSERT INTO video (title, description, path, category) VALUES
('Ambition', 'Ambition is the fuel that drives individuals to achieve and excel. It is more than mere desire; it is an intrinsic motivation that compels one to strive for higher goals and aspire to greatness. Ambition is the seed from which the fruits of success and achievement grow. However, it must be tempered with ethical considerations and a regard for the common good to prevent it from becoming mere self-serving desire.', 'app/video/Ambition', 'character'),
('Assertive', 'Assertiveness is the quality that enables individuals to stand up for themselves and their beliefs in a positive and persistent manner. It is a middle ground between passive acquiescence and aggression. Assertive individuals can navigate social and professional landscapes with clarity and directness, advocating for their needs and rights without undermining those of others. It requires a strong sense of self-awareness and respect for mutual communication.', 'app/video/Assertive', 'character'),
('Confidence', 'Confidence is the trust in one''s abilities and judgment. It is not an innate trait but a cultivated belief built upon experiences and successes. Confident individuals inspire trust and are often seen as capable and reliable. Confidence should not be mistaken for arrogance, which is an overestimation of one''s abilities. True confidence is self-assured yet open to learning and growth.', 'app/video/Confidence', 'character'),
('Consistency', 'Consistency is the adherence to the same principles, course, form, or actions over time. It is an essential trait for building a reputation of reliability and trustworthiness. Consistency demonstrates commitment and can be a measure of predictability in an often unpredictable world. It is a key component in the development of habits that lead to long-term success and achievement.', 'app/video/Consistency', 'character'),
('Courage', 'Courage is the mental or moral strength to venture, persevere, and withstand danger, fear, or difficulty. It is not the absence of fear but the ability to act in spite of it. Courage allows individuals to confront challenges head-on, take risks, and make difficult decisions. It is the principle that empowers one to uphold other virtues at the cost of personal risk or sacrifice.', 'app/video/Courage', 'character'),
('Determination', 'Determination is the firmness of purpose that drives an individual to persist in the face of obstacles. It is the resolve to keep pushing forward, even when the path becomes arduous. Determination is closely linked with goal-setting and focus; it is the engine behind sustained effort and the refusal to give up.', 'app/video/Determination', 'character'),
('Discipline', 'Discipline is the practice of training oneself to do something in a controlled and habitual way. It involves self-regulation and the ability to work towards one''s goals systematically and consistently. Discipline is often what separates aspiration from actualization, as it demands that one stays the course despite distractions or waning motivation.', 'app/video/Discipline', 'character'),
('Patience', 'Patience is the capacity to accept or tolerate delay, trouble, or suffering without getting angry or upset. It is a virtue that recognizes the value of perseverance through time and challenges. Patience is essential for enduring growth periods, overcoming long-term challenges, and is often a component of wisdom.', 'app/video/Patience', 'character'),
('Perseverance', 'Perseverance is steadfastness in doing something despite difficulty or delay in achieving success. It is similar to determination but is specifically oriented towards long-term goals and the capacity to recover from setbacks. Perseverance is the principle that underpins stories of great achievements that were not readily attained but were the results of sustained effort.', 'app/video/Perseverance', 'character'),
('Persistence', 'Persistence is the firm continuance in a course of action in spite of difficulty or opposition. It is the twin of perseverance but emphasizes the active continuation of action against obstacles. Persistence is often the determining factor between an unfinished attempt and a successful endeavor.', 'app/video/Persistence', 'character'),
('Reliability', 'Reliability is the quality of being trustworthy and performing consistently well. It is the trait of being dependable, which is essential in forming strong interpersonal and professional relationships. A reliable individual is one who can be counted on to keep their word and fulfill their commitments.', 'app/video/Reliability', 'character'),
('Resilience', 'Resilience is the toughness and the ability to recover quickly from difficulties. It is the elasticity of character that enables individuals to bounce back from failure, adversity, or trauma. Resilience does not eliminate stress or erase life''s difficulties, but it provides the strength to tackle problems head-on, overcome adversity, and move on with life.', 'app/video/Resilience', 'character');
INSERT INTO forum (forumID, topic) VALUES
(DEFAULT, "Religious Values"),
(DEFAULT, "Love"),
(DEFAULT, "Faith"),
(DEFAULT, "Hope"),
(DEFAULT, "Charity/Service"),
(DEFAULT, "Mercy"),
(DEFAULT, "Obedience"),
(DEFAULT, "Honesty"),
(DEFAULT, "Forgiveness"),
(DEFAULT, "Gratitude"),
(DEFAULT, "Purity"),
(DEFAULT, "Generosity"),
(DEFAULT, "Humility"),
(DEFAULT, "American Principals"),
(DEFAULT, "Liberty/Freedom"),
(DEFAULT, "Responsibility"),
(DEFAULT, "Prosperity"),
(DEFAULT, "Independents"),
(DEFAULT, "Opportunity"),
(DEFAULT, "Equality"),
(DEFAULT, "Civic Duty"),
(DEFAULT, "Self-Reliance"),
(DEFAULT, "Justice"),
(DEFAULT, "Frugality"),
(DEFAULT, "Moral Character"),
(DEFAULT, "Ambition"),
(DEFAULT, "Assertive"),
(DEFAULT, "Confidence"),
(DEFAULT, "Consistency"),
(DEFAULT, "Courage"),
(DEFAULT, "Determination"),
(DEFAULT, "Discipline"),
(DEFAULT, "Patience"),
(DEFAULT, "perseverance"),
(DEFAULT, "Persistence"),
(DEFAULT, "Reliability"),
(DEFAULT, "Resilience");
