-- Table structure for table `admin`
DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `password` TEXT NOT NULL
);

-- Dumping data for table `admin`
INSERT INTO
    `admin`
VALUES
    (1, 'Rushi', 'rushikeshsurve193@gmail.com', '12345');

-- Table structure for table `cart`
DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `user_id` INTEGER NOT NULL,
    `name` TEXT NOT NULL,
    `price` INTEGER NOT NULL,
    `quantity` INTEGER NOT NULL,
    `image` TEXT NOT NULL
);

-- Dumping data for table `cart`
INSERT INTO
    `cart`
VALUES
    (44, 3, 'Be Well Bee', 900, 2, 'be_well_bee.jpg'),
(
        45,
        3,
        'Boring Girls',
        300,
        1,
        'boring_girls_a_novel.jpg'
    ),
(
        47,
        1,
        'Boring Girls',
        300,
        1,
        'boring_girls_a_novel.jpg'
    ),
(49, 6, 'Atomic Habits', 599, 1, 'atomic-habits.jpg'),
(50, 6, 'Bash and Lucy', 158, 1, 'bash_and_lucy-2.jpg');

-- Table structure for table `message`
DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `user_id` INTEGER NOT NULL,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `number` TEXT NOT NULL,
    `message` TEXT NOT NULL
);

-- Dumping data for table `message`
INSERT INTO
    `message`
VALUES
    (
        4,
        3,
        'Amar Choudhary',
        'amar@micromail.com',
        '1122112211',
        'It is working fine'
    ),
(
        5,
        6,
        'abc',
        'a@g.com',
        '1523',
        'the website is good.'
    ),
(
        6,
        6,
        'abc',
        'a@gmail.com',
        '569874562',
        'this website is good'
    ),
(7, 7, 'new', 'new@gmail.com', '123467890', 'its good');

-- Table structure for table `orders`
DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `user_id` INTEGER NOT NULL,
    `name` TEXT NOT NULL,
    `number` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `method` TEXT NOT NULL,
    `address` TEXT NOT NULL,
    `total_products` TEXT NOT NULL,
    `total_price` INTEGER NOT NULL,
    `placed_on` TEXT NOT NULL,
    `payment_status` TEXT NOT NULL DEFAULT 'pending'
);

-- Dumping data for table `orders`
INSERT INTO
    `orders`
VALUES
    (
        6,
        1,
        'Hardik Pandya',
        '7499450771',
        'pandyahardik@gmail.com',
        'Cash on delivery',
        'flat no. Gujrat Titans, IPL, Surat, India - 412416',
        ', The happy lemon (1) , Nightshade (2) ',
        1701,
        '21-Oct-2023',
        'pending'
    ),
(
        7,
        3,
        'Rushikesh Shekhar Surve',
        '7499450771',
        'rushikeshsurve193@gmail.com',
        'Cash on delivery',
        'flat no. Ratnagiri, , Ratnagiri, India - 415615',
        ', Lloyd (1) ',
        149,
        '03-Nov-2023',
        'pending'
    ),
(
        8,
        4,
        'Rushikesh Shekhar Surve',
        '07499450771',
        'rushikeshsurve193@gmail.com',
        'Cash on delivery',
        'flat no. Near Aadarsh Jeevan Shikshan Marathi School, At Bhandarpule, Post Ganapatipule, Tal.Dist. Ratnagiri, , Ratnagiri, India - 415615',
        ', Red Qeen (1) ',
        195,
        '04-Nov-2023',
        'completed'
    ),
(
        9,
        7,
        'Rushikesh Shekhar Surve',
        '07499450771',
        'rushikeshsurve193@gmail.com',
        'Cash on delivery',
        'flat no. Near Aadarsh Jeevan Shikshan Marathi School, At Bhandarpule, Post Ganapatipule, Tal.Dist. Ratnagiri, , Ratnagiri, India - 415615',
        ', Be Well Bee (2) ',
        1800,
        '05-Apr-2024',
        'completed'
    );

-- Table structure for table `products`
DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `name` TEXT NOT NULL,
    `price` INTEGER NOT NULL,
    `image` TEXT NOT NULL,
    `author` TEXT NOT NULL DEFAULT 'Unknown',
    `description` TEXT,
    `rating` REAL NOT NULL DEFAULT 1.00
);

-- Dumping data for table `products`
INSERT INTO
    `products`
VALUES
    (
        10,
        'Bash and Lucy',
        158,
        'bash_and_lucy-2.jpg',
        'Lisa and Michael Cohn',
        '''Bash and Lucy'' is a heartwarming children''s book that tells the story of a special friendship between a dog named Bash and a young girl named Lucy. It explores themes of companionship, resilience, and the power of friendship. The story highlights the adventures and bond between the two, teaching valuable lessons about love and loyalty.',
        1.00
    ),
(
        11,
        'Be Well Bee',
        900,
        'be_well_bee.jpg',
        'Dr. Alison Friesen',
        '''Be Well Bee'' is a comprehensive guide to the health and well-being of honey bees. It provides practical advice on how to keep your bees healthy and productive, and it covers a wide range of topics, including the biology of honey bees, beekeeping basics, bee nutrition and health, bee diseases and pests, and honey bee conservation.',
        1.00
    ),
(
        12,
        'Boring Girls',
        300,
        'boring_girls_a_novel.jpg',
        'Sara Taylor',
        ' Book name: Boring Girls Author: Sara Taylor Price (INR): 599 Brief description:  Boring Girls is a dark and disturbing novel about two teenage girls who form a heavy metal band and embark on a bloody journey of revenge. Rachel and Fern are both outcasts who have been mistreated by the people around them. They find solace in each other and in their music, but their anger and frustration soon boil over into violence.',
        1.00
    ),
(
        13,
        'Red Qeen',
        195,
        'red_queen.jpg',
        'Victoria Aveyard',
        '''Red Queen'' is a captivating fantasy novel set in a world divided by blood — the elite with silver blood possessing superhuman abilities, and the oppressed red-blooded commoners. The story follows Mare Barrow, a Red girl who discovers she has Silver-like abilities, and she becomes embroiled in the dangerous world of the Silvers, where betrayal and power play a significant role. It''s a tale of rebellion, power struggles, and the fight against societal injustice.',
        1.00
    ),
(
        14,
        'Harry Potter and the Sorcerer''s Stone',
        150,
        'harry_potter_ss.jpg',
        'J.K. Rowling',
        'Harry Potter is an orphan boy who lives with his cruel aunt, uncle, and cousin. On his eleventh birthday, he learns that he is a wizard and is invited to attend Hogwarts School of Witchcraft and Wizardry. At Hogwarts, Harry makes new friends, learns about magic, and faces off against the evil Lord Voldemort.',
        1.00
    ),
(
        15,
        'The Lord of the Rings: The Fellowship of the Ring',
        300,
        'fellowship_of_rings.jpg',
        'J.R.R. Tolkien',
        'Frodo Baggins inherits the One Ring, an evil artifact created by the Dark Lord Sauron. Frodo must set out on a perilous journey to destroy the One Ring in the fires of Mount Doom, the only place where it can be destroyed. Along the way, he is joined by a fellowship of companions who help him on his quest.',
        1.00
    ),
(
        16,
        'Algorithms to Live By: The Computer Science of Human Decisions',
        650,
        'algorithms_to_live_by.jpg',
        'Brian Christian and Tom Griffiths',
        'In Algorithms to Live By, Brian Christian and Tom Griffiths discuss how computer science can be used to make better decisions in everyday life. They cover topics such as algorithms for finding the best mate, the best job, and the best way to invest your money.',
        1.00
    ),
(
        17,
        'Python Crash Course: A Hands-On, Project-Based Introduction to Programming',
        500,
        'python_crashcourse.jpg',
        'Eric Matthes',
        'Python Crash Course is a fast-paced introduction to the Python programming language. It covers the basics of Python, such as variables, functions, loops, and data structures, as well as more advanced topics such as object-oriented programming and web development.',
        1.00
    ),
(
        18,
        'Algorithms Unlocked',
        525,
        'algorithms_unlocked.jpg',
        'Thomas Cormen',
        'Algorithms Unlocked is a gentle introduction to the world of algorithms. It covers the basics of algorithm design and analysis, as well as more advanced topics such as graph algorithms and dynamic programming.',
        1.00
    ),
(
        19,
        'The God of Small Things',
        200,
        'the_god_of_small_things.jpg',
        'Arundhati Roy',
        ' The God of Small Things is a Booker Prize-winning novel about the lives of two fraternal twins, Rahel and Estha, in Kerala, India. The novel is a lyrical and moving exploration of love, loss, and the power of memory.',
        1.00
    );

-- Table structure for table `sell_requests`
DROP TABLE IF EXISTS `sell_requests`;

CREATE TABLE `sell_requests` (
    `request_id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `user_id` INTEGER,
    `name` TEXT NOT NULL,
    `price` REAL NOT NULL,
    `description` TEXT NOT NULL,
    `image` TEXT NOT NULL,
    `request_status` TEXT DEFAULT 'pending',
    `author` TEXT NOT NULL DEFAULT 'Unknown'
);

-- Dumping data for table `sell_requests`
INSERT INTO
    `sell_requests`
VALUES
    (
        6,
        1,
        'Atomic Habits',
        599.00,
        'Best selling self help book',
        'atomic-habits.jpg',
        'approved',
        'James Clear'
    ),
(
        7,
        5,
        'Atomic Habits',
        1000.00,
        'siu',
        'atomic-habits.jpg',
        'pending',
        'cristiano'
    ),
(
        8,
        6,
        'Ab',
        520.00,
        'atomiv habita',
        'atomic-habits.jpg',
        'pending',
        'CV'
    ),
(
        9,
        7,
        'test',
        56.00,
        'test',
        'atomic-habits.jpg',
        'approved',
        'Unknown'
    );

-- Table structure for table `users`
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `password` TEXT NOT NULL
);

-- Dumping data for table `users`
INSERT INTO
    `users`
VALUES
    (
        1,
        '123',
        '123@123',
        '202cb962ac59075b964b07152d234b70'
    ),
(
        3,
        'Rushikesh',
        'rushikeshsurve193@gmail.com',
        '827ccb0eea8a706c4c34a16891f84e7b'
    ),
(
        4,
        'yash',
        'yash@gmail.com',
        'c296539f3286a899d8b3f6632fd62274'
    ),
(
        5,
        'Cristiano Ronaldo',
        'cristiano@gmail.com',
        '88e7436afc4ca02741c771e9149a2e7c'
    ),
(
        6,
        'vish',
        'vish@gmail.com',
        'c9e55fc0be18bed4a9c695a6d8ac2840'
    ),
(
        7,
        'New',
        'new@gmail.com',
        '81dc9bdb52d04dc20036dbd8313ed055'
    );