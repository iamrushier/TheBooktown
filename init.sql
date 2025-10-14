-- Optional cleanup
DROP TABLE IF EXISTS `admin`, `cart`, `message`, `orders`, `products`, `sell_requests`, `users`;

-- ADMIN
CREATE TABLE `admin` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL
);

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Rushi', 'admin@example.com', '12345');

-- CART
CREATE TABLE `cart` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `price` INT NOT NULL,
  `quantity` INT NOT NULL,
  `image` VARCHAR(255) NOT NULL
);

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(44, 3, 'Be Well Bee', 900, 2, 'be_well_bee.jpg'),
(45, 3, 'Boring Girls', 300, 1, 'boring_girls_a_novel.jpg'),
(47, 1, 'Boring Girls', 300, 1, 'boring_girls_a_novel.jpg'),
(49, 6, 'Atomic Habits', 599, 1, 'atomic-habits.jpg'),
(50, 6, 'Bash and Lucy', 158, 1, 'bash_and_lucy-2.jpg');

-- MESSAGE
CREATE TABLE `message` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `number` VARCHAR(20) NOT NULL,
  `message` TEXT NOT NULL
);

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(4, 3, 'Amar Choudhary', 'amar@micromail.com', '1122112211', 'It is working fine'),
(5, 6, 'abc', 'a@g.com', '1523', 'the website is good.'),
(6, 6, 'abc', 'a@gmail.com', '569874562', 'this website is good'),
(7, 7, 'new', 'new@gmail.com', '123467890', 'its good');

-- ORDERS
CREATE TABLE `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `number` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `method` VARCHAR(100) NOT NULL,
  `address` TEXT NOT NULL,
  `total_products` TEXT NOT NULL,
  `total_price` INT NOT NULL,
  `placed_on` VARCHAR(50) NOT NULL,
  `payment_status` VARCHAR(50) NOT NULL DEFAULT 'pending'
);

INSERT INTO `orders`
(`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(6, 1, 'Hardik Pandya', '7499450771', 'pandyahardik@gmail.com', 'Cash on delivery', 'flat no. 123, Test Street, Mumbai, India - 400001', ', The happy lemon (1) , Nightshade (2) ', 1701, '21-Oct-2023', 'pending'),
(7, 3, 'Test User', '7499450771', 'testuser@example.com', 'Cash on delivery', 'flat no. 456, Sample Avenue, Pune, India - 411001', ', Lloyd (1) ', 149, '03-Nov-2023', 'pending'),
(8, 4, 'Test User', '07499450771', 'testuser@example.com', 'Cash on delivery', 'flat no. 789, Placeholder Road, Nagpur, India - 440001', ', Red Queen (1) ', 195, '04-Nov-2023', 'completed'),
(9, 7, 'Test User', '07499450771', 'testuser@example.com', 'Cash on delivery', 'flat no. 101, Fictional Lane, Hyderabad, India - 500001', ', Be Well Bee (2) ', 1800, '05-Apr-2024', 'completed');

-- PRODUCTS
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `price` INT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255) NOT NULL DEFAULT 'Unknown',
  `description` TEXT,
  `rating` FLOAT NOT NULL DEFAULT 1.00
);

INSERT INTO `products` (`id`, `name`, `price`, `image`, `author`, `description`, `rating`) VALUES
(10, 'Bash and Lucy', 158, 'bash_and_lucy-2.jpg', 'Lisa and Michael Cohn', 'Bash and Lucy is a heartwarming children''s book that tells the story of a special friendship between a dog named Bash and a young girl named Lucy. It explores themes of companionship, resilience, and the power of friendship.', 1.00),
(11, 'Be Well Bee', 900, 'be_well_bee.jpg', 'Dr. Alison Friesen', 'Be Well Bee is a comprehensive guide to the health and well-being of honey bees. It covers bee biology, beekeeping basics, and honey bee conservation.', 1.00),
(12, 'Boring Girls', 300, 'boring_girls_a_novel.jpg', 'Sara Taylor', 'Boring Girls is a dark and disturbing novel about two teenage girls who form a heavy metal band and embark on a bloody journey of revenge.', 1.00),
(13, 'Red Queen', 195, 'red_queen.jpg', 'Victoria Aveyard', 'Red Queen is a captivating fantasy novel set in a world divided by blood — the elite with silver blood and the oppressed red-blooded commoners.', 1.00),
(14, 'Harry Potter and the Sorcerer''s Stone', 150, 'harry_potter_ss.jpg', 'J.K. Rowling', 'Harry Potter learns he is a wizard and attends Hogwarts School of Witchcraft and Wizardry.', 1.00),
(15, 'The Lord of the Rings: The Fellowship of the Ring', 300, 'fellowship_of_rings.jpg', 'J.R.R. Tolkien', 'Frodo Baggins inherits the One Ring and must destroy it in the fires of Mount Doom.', 1.00),
(16, 'Algorithms to Live By: The Computer Science of Human Decisions', 650, 'algorithms_to_live_by.jpg', 'Brian Christian and Tom Griffiths', 'Discusses how computer science can be used to make better decisions in everyday life.', 1.00),
(17, 'Python Crash Course: A Hands-On, Project-Based Introduction to Programming', 500, 'python_crashcourse.jpg', 'Eric Matthes', 'An introduction to Python covering the basics and more advanced topics like OOP and web development.', 1.00),
(18, 'Algorithms Unlocked', 525, 'algorithms_unlocked.jpg', 'Thomas Cormen', 'A gentle introduction to algorithms, including graph algorithms and dynamic programming.', 1.00),
(19, 'The God of Small Things', 200, 'the_god_of_small_things.jpg', 'Arundhati Roy', 'A Booker Prize-winning novel about the lives of two fraternal twins, Rahel and Estha, in Kerala, India.', 1.00);

-- SELL REQUESTS
CREATE TABLE `sell_requests` (
  `request_id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  `name` VARCHAR(255) NOT NULL,
  `price` FLOAT NOT NULL,
  `description` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `request_status` VARCHAR(50) DEFAULT 'pending',
  `author` VARCHAR(255) NOT NULL DEFAULT 'Unknown'
);

INSERT INTO `sell_requests` (`request_id`, `user_id`, `name`, `price`, `description`, `image`, `request_status`, `author`) VALUES
(6, 1, 'Atomic Habits', 599.00, 'Best selling self help book', 'atomic-habits.jpg', 'approved', 'James Clear'),
(7, 5, 'Atomic Habits', 1000.00, 'siu', 'atomic-habits.jpg', 'pending', 'Cristiano'),
(8, 6, 'Ab', 520.00, 'atomiv habita', 'atomic-habits.jpg', 'pending', 'CV'),
(9, 7, 'test', 56.00, 'test', 'atomic-habits.jpg', 'approved', 'Unknown');

-- USERS
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL
);

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, '123', '123@123', '202cb962ac59075b964b07152d234b70'),
(3, 'Test User', 'testuser@example.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'yash', 'yash@gmail.com', 'c296539f3286a899d8b3f6632fd62274'),
(5, 'Cristiano Ronaldo', 'cristiano@gmail.com', '88e7436afc4ca02741c771e9149a2e7c'),
(6, 'vish', 'vish@gmail.com', 'c9e55fc0be18bed4a9c695a6d8ac2840'),
(7, 'New', 'new@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');