-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 06:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`id`, `firstName`, `lastName`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Swagat', 'Ghimire', 'admin@gmail.com', '$2y$12$rI3xaV5bHR5nc2i5PW6iY.JqS.I9vmhwIJK8ZUoR.Li9tCe78s0w2', '2025-06-11 18:42:54', '2025-06-11 18:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_isbn` varchar(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_price` decimal(8,2) NOT NULL,
  `book_publication` varchar(255) NOT NULL,
  `book_condition` varchar(255) NOT NULL,
  `book_quantity` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subsubcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `book_pic` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_isbn`, `book_name`, `book_author`, `book_price`, `book_publication`, `book_condition`, `book_quantity`, `category_id`, `subcategory_id`, `subsubcategory_id`, `book_pic`, `owner_email`, `created_at`, `updated_at`) VALUES
(1, '1111111111111', 'The time machine', 'H.G Wells', 876.00, 'pageturner', 'brand_new', 1, 2, 5, 4, 'pictures/the_time_machine.jpg', 'sajal@gmail.com', '2025-06-12 19:26:59', '2025-06-12 19:29:27'),
(2, '2222222222222', 'Lord of The Rings', 'J.R.R. TOLKINE', 654.00, 'pageturner', 'brand_new', 1, 1, 3, 3, 'pictures/lord_of_the_rings.jpg', 'saksham@gmail.com', '2025-06-12 19:28:54', '2025-06-12 19:28:54'),
(3, '3333333333333', 'JAVA, A Beginner\'s Guide', 'Herbert Schildt', 512.00, 'ORACAl', 'used', 1, 4, 7, 8, 'pictures/java.jpg', 'tashi@gmail.com', '2025-06-12 19:32:06', '2025-06-12 19:32:06'),
(4, '4444444444444', 'Programming Basic with C#', 'Dr. SVETLIN NAKOV', 324.00, 'SoftUni Foundation', 'used', 1, 4, 7, 8, 'pictures/csharp.png', 'subinam@gmail.com', '2025-06-12 19:35:04', '2025-06-12 19:35:04'),
(5, '5555555555555', 'IRON MAN', 'Marvel', 879.00, 'Marvel', 'brand_new', 1, 3, 2, 1, 'pictures/ironman.jpg', 'gaurab@gmail.com', '2025-06-12 20:12:26', '2025-06-12 20:12:26'),
(6, '6666666666666', 'Return of Wolverine', 'Marvel', 899.00, 'Marvel', 'brand_new', 1, 3, 2, 1, 'pictures/wolverine.jpg', 'ghimireswagat316@gmail.com', '2025-06-12 20:13:14', '2025-06-12 20:13:14'),
(7, '7777777777777', 'ANSI C', 'E. BALAGURUSAMY', 518.00, 'Mc Graw Hill Education', 'used', 1, 4, 7, 8, 'pictures/c.jpg', 'ghimireswagat316@gmail.com', '2025-06-12 20:15:50', '2025-06-12 20:15:50'),
(8, '0000000000000', 'Lord of The Rings', 'H.G Wells', 876.00, 'Marvel', 'brand_new', 3, 2, NULL, NULL, 'pictures/lord_of_the_rings.jpg', 'tashi@gmail.com', '2025-06-13 00:05:32', '2025-06-13 00:05:32'),
(9, '1000000000001', 'The Hobbit', 'J.R.R. Tolkien', 650.00, 'HarperCollins', 'brand_new', 1, 1, 3, 3, 'pictures/hobbit.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(10, '1000000000002', 'A Brief History of Time', 'Stephen Hawking', 780.00, 'Bantam Books', 'used', 1, 2, 5, 4, 'pictures/history_of_time.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(11, '1000000000003', 'The Great Gatsby', 'F. Scott Fitzgerald', 520.00, 'Scribner', 'brand_new', 1, 1, 4, NULL, 'pictures/gatsby.jpg', 'ghimireswagat316@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(12, '1000000000004', 'To Kill a Mockingbird', 'Harper Lee', 670.00, 'J.B. Lippincott & Co.', 'brand_new', 1, 1, 4, NULL, 'pictures/mockingbird.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(13, '1000000000005', '1984', 'George Orwell', 610.00, 'Secker & Warburg', 'used', 1, 1, 3, NULL, 'pictures/1984.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(14, '1000000000006', 'The Catcher in the Rye', 'J.D. Salinger', 600.00, 'Little, Brown and Company', 'brand_new', 1, 1, 3, NULL, 'pictures/catcher_rye.jpg', 'ghimireswagat316@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(15, '1000000000007', 'Pride and Prejudice', 'Jane Austen', 550.00, 'T. Egerton', 'used', 1, 2, 6, NULL, 'pictures/pride_prejudice.jpg', 'ghimireswagat316@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(16, '1000000000008', 'The Alchemist', 'Paulo Coelho', 700.00, 'HarperTorch', 'brand_new', 1, 2, 5, NULL, 'pictures/alchemist.jpg', 'ghimireswagat316@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(17, '1000000000009', 'War and Peace', 'Leo Tolstoy', 900.00, 'The Russian Messenger', 'used', 1, 1, 4, NULL, 'pictures/war_peace.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(18, '1000000000010', 'Moby Dick', 'Herman Melville', 720.00, 'Harper & Brothers', 'brand_new', 1, 1, 4, NULL, 'pictures/moby_dick.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(19, '1000000000011', 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 890.00, 'Bloomsbury', 'brand_new', 1, 1, 3, NULL, 'pictures/harry_potter1.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(20, '1000000000012', 'Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 910.00, 'Bloomsbury', 'brand_new', 1, 1, 3, NULL, 'pictures/harry_potter2.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(21, '1000000000013', 'Harry Potter and the Prisoner of Azkaban', 'J.K. Rowling', 930.00, 'Bloomsbury', 'brand_new', 1, 1, 3, NULL, 'pictures/harry_potter3.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(22, '1000000000014', 'Harry Potter and the Goblet of Fire', 'J.K. Rowling', 950.00, 'Bloomsbury', 'brand_new', 1, 1, 3, NULL, 'pictures/harry_potter4.jpg', 'subinam@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(23, '1000000000015', 'Harry Potter and the Order of the Phoenix', 'J.K. Rowling', 980.00, 'Bloomsbury', 'brand_new', 1, 1, 3, NULL, 'pictures/harry_potter5.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(24, '1000000000016', 'Harry Potter and the Half-Blood Prince', 'J.K. Rowling', 1000.00, 'Bloomsbury', 'brand_new', 1, 1, 3, NULL, 'pictures/harry_potter6.jpg', 'aditi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(25, '1000000000017', 'Harry Potter and the Deathly Hallows', 'J.K. Rowling', 1050.00, 'Bloomsbury', 'brand_new', 1, 1, 3, NULL, 'pictures/harry_potter7.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(26, '1000000000018', 'The Da Vinci Code', 'Dan Brown', 780.00, 'Doubleday', 'brand_new', 1, 1, 4, NULL, 'pictures/da_vinci_code.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(27, '1000000000019', 'Angels and Demons', 'Dan Brown', 760.00, 'Pocket Books', 'used', 1, 1, 4, NULL, 'pictures/angels_demons.jpg', 'subinam@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(28, '1000000000020', 'Inferno', 'Dan Brown', 800.00, 'Doubleday', 'brand_new', 1, 1, 4, NULL, 'pictures/inferno.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(29, '1000000000021', 'Digital Fortress', 'Dan Brown', 740.00, 'St. Martin\'s Press', 'used', 1, 1, 4, NULL, 'pictures/digital_fortress.jpg', 'aditi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(30, '1000000000022', 'The Lost Symbol', 'Dan Brown', 820.00, 'Doubleday', 'brand_new', 1, 1, 4, NULL, 'pictures/lost_symbol.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(31, '1000000000023', 'The Chronicles of Narnia', 'C.S. Lewis', 920.00, 'Geoffrey Bles', 'brand_new', 1, 1, 3, NULL, 'pictures/narnia.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(32, '1000000000024', 'The Shining', 'Stephen King', 880.00, 'Doubleday', 'used', 1, 1, 4, NULL, 'pictures/shining.jpg', 'subinam@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(33, '1000000000025', 'It', 'Stephen King', 910.00, 'Viking Press', 'brand_new', 1, 1, 4, NULL, 'pictures/it.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(34, '1000000000026', 'The Green Mile', 'Stephen King', 870.00, 'Orion Publishing Group', 'used', 1, 1, 4, NULL, 'pictures/green_mile.jpg', 'aditi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(35, '1000000000027', 'The Dark Tower', 'Stephen King', 940.00, 'Grant', 'brand_new', 1, 1, 4, NULL, 'pictures/dark_tower.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(36, '1000000000028', 'The Outsider', 'Stephen King', 820.00, 'Scribner', 'used', 1, 1, 4, NULL, 'pictures/outsider.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(37, '1000000000029', 'Doctor Sleep', 'Stephen King', 860.00, 'Scribner', 'brand_new', 1, 1, 4, NULL, 'pictures/doctor_sleep.jpg', 'subinam@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(38, '1000000000030', 'Salem\'s Lot', 'Stephen King', 880.00, 'Doubleday', 'used', 1, 1, 4, NULL, 'pictures/salems_lot.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(39, '1000000000031', 'Pet Sematary', 'Stephen King', 900.00, 'Doubleday', 'brand_new', 1, 1, 4, NULL, 'pictures/pet_sematary.jpg', 'aditi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(40, '1000000000032', 'The Godfather', 'Mario Puzo', 850.00, 'G.P. Putnam\'s Sons', 'used', 1, 1, 4, NULL, 'pictures/godfather.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(41, '1000000000033', 'The Sicilian', 'Mario Puzo', 810.00, 'Random House', 'used', 1, 1, 4, NULL, 'pictures/sicilian.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(42, '1000000000034', 'The Last Don', 'Mario Puzo', 830.00, 'Random House', 'brand_new', 1, 1, 4, NULL, 'pictures/last_don.jpg', 'subinam@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(43, '1000000000035', 'Omerta', 'Mario Puzo', 790.00, 'Random House', 'used', 1, 1, 4, NULL, 'pictures/omerta.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(44, '1000000000036', 'Fools Die', 'Mario Puzo', 820.00, 'G.P. Putnam\'s Sons', 'brand_new', 1, 1, 4, NULL, 'pictures/fools_die.jpg', 'aditi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(45, '1000000000037', 'American Psycho', 'Bret Easton Ellis', 870.00, 'Vintage Books', 'used', 1, 1, 4, NULL, 'pictures/american_psycho.jpg', 'sajal@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(46, '1000000000038', 'Less Than Zero', 'Bret Easton Ellis', 810.00, 'Simon & Schuster', 'brand_new', 1, 1, 4, NULL, 'pictures/less_than_zero.jpg', 'tashi@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(47, '1000000000039', 'Glamorama', 'Bret Easton Ellis', 830.00, 'Knopf', 'used', 1, 1, 4, NULL, 'pictures/glamorama.jpg', 'subinam@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(48, '1000000000040', 'The Rules of Attraction', 'Bret Easton Ellis', 790.00, 'Simon & Schuster', 'used', 1, 1, 4, NULL, 'pictures/rules_of_attraction.jpg', 'saksham@gmail.com', '2025-06-14 00:02:46', '2025-06-14 00:02:46'),
(55, '2324156154321', '13 Reasons Why', 'Jay Asher', 200.00, 'fiction', 'used', 1, 2, 5, 4, 'pictures/13.jpg', 'sajal@gmail.com', '2025-06-28 01:50:24', '2025-06-28 01:50:24'),
(56, '9784091240554', 'Naruto', 'Masashi Kishimoto', 15.99, 'Shonen Jump', 'brand_new', 1, 3, 1, NULL, 'pictures/naruto.jpg', 'pratik.thapa@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:06:11'),
(57, '9781302903322', 'Spider-Man: Into the Spider-Verse', 'Brian Michael Bendis', 20.00, 'Marvel Comics', 'brand_new', 1, 3, 2, 1, 'pictures/spiderman.jpg', 'pratik.thapa@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:06:28'),
(58, '9780756404740', 'The Name of the Wind', 'Patrick Rothfuss', 25.00, 'DAW Books', 'brand_new', 1, 1, 3, NULL, 'pictures/name_of_the_wind.jpg', 'pratik.thapa@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:17:50'),
(59, '9780345537968', 'Gone Girl', 'Gillian Flynn', 18.99, 'Crown Publishing Group', 'brand_new', 1, 1, 4, NULL, 'pictures/gone_girl.jpg', 'pratik.thapa@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:18:23'),
(60, '9780553176988', 'A Brief History of Time', 'Stephen Hawking', 10.99, 'Bantam Books', 'brand_new', 1, 4, 8, NULL, 'pictures/history_of_time.jpg', 'pratik.thapa@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:18:44'),
(61, '9780062457714', 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', 14.99, 'HarperOne', 'brand_new', 1, 2, 6, NULL, 'pictures/subtle_art.jpg', 'sita.shrestha@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:19:41'),
(62, '9780262033848', 'Introduction to Algorithms', 'Thomas H. Cormen', 75.00, 'MIT Press', 'brand_new', 1, 4, 7, 8, 'pictures/algorithms.jpg', 'sita.shrestha@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:20:17'),
(63, '9780226458384', 'The Structure of Scientific Revolutions', 'Thomas S. Kuhn', 22.00, 'University of Chicago Press', 'brand_new', 1, 2, 5, NULL, 'pictures/scientific_revolutions.jpg', 'sita.shrestha@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:20:51'),
(64, '9780618260300', 'The Hobbit', 'J.R.R. Tolkien', 15.99, 'Houghton Mifflin Harcourt', 'brand_new', 1, 1, 3, NULL, 'pictures/hobbit.jpg', 'sita.shrestha@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:21:21'),
(65, '9780307473585', 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 19.99, 'Knopf', 'brand_new', 1, 1, 4, NULL, 'pictures/girl_with_dragon_tattoo.jpg', 'sita.shrestha@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:21:46'),
(66, '9781591166777', 'Attack on Titan', 'Hajime Isayama', 12.99, 'Kodansha', 'brand_new', 1, 3, 1, NULL, 'pictures/attack_on_titan.jpg', 'ramesh.khadka@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:07:46'),
(67, '9781401200513', 'Batman: Year One', 'Frank Miller', 24.99, 'DC Comics', 'brand_new', 1, 3, 2, 2, 'pictures/batman_year_one.jpg', 'ramesh.khadka@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:08:04'),
(68, '9780765321790', 'Mistborn', 'Brandon Sanderson', 29.99, 'Tor Books', 'brand_new', 1, 1, 3, NULL, 'pictures/mistborn.jpg', 'ramesh.khadka@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:16:30'),
(69, '9780199291151', 'The Selfish Gene', 'Richard Dawkins', 14.99, 'Houghton Mifflin', 'brand_new', 1, 2, 6, NULL, 'pictures/selfish_gene.jpg', 'ramesh.khadka@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:16:56'),
(70, '9780735216246', 'Atomic Habits', 'James Clear', 12.99, 'Avery', 'brand_new', 1, 2, 6, 6, 'pictures/atomic_habits.jpg', 'ramesh.khadka@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:17:08'),
(71, '9780134686097', 'Artificial Intelligence: A Modern Approach', 'Stuart Russell', 70.00, 'Pearson', 'brand_new', 1, 4, 7, NULL, 'pictures/ai_modern_approach.jpg', 'anjali.gurung@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:22:50'),
(72, '9780062211220', 'Guns, Germs, and Steel', 'Jared Diamond', 19.99, 'Penguin Books', 'brand_new', 1, 2, NULL, NULL, 'pictures/guns_germs_steel.jpg', 'anjali.gurung@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:23:47'),
(73, '9780765326358', 'The Way of Kings', 'Brandon Sanderson', 29.99, 'Tor Books', 'brand_new', 1, 1, 3, NULL, 'pictures/way_of_kings.jpg', 'anjali.gurung@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:24:12'),
(74, '9780385504201', 'The Da Vinci Code', 'Dan Brown', 14.99, 'Doubleday', 'brand_new', 1, 1, 4, NULL, 'pictures/da_vinci_code.jpg', 'anjali.gurung@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:24:40'),
(75, '9780062316097', 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 18.99, 'Harper', 'brand_new', 1, 2, NULL, NULL, 'pictures/sapiens.jpg', 'anjali.gurung@gmail.com', '2025-06-28 18:18:08', '2025-06-28 13:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'fiction', 1, '2025-06-12 18:59:56', '2025-06-12 18:59:56'),
(2, 'non-fiction', 1, '2025-06-12 19:00:03', '2025-06-12 19:00:03'),
(3, 'comics & graphics novels', 1, '2025-06-12 19:00:57', '2025-06-12 19:00:57'),
(4, 'academic & educational', 1, '2025-06-12 19:04:29', '2025-06-12 19:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(92, '0001_01_01_000000_create_admin_info_table', 1),
(93, '0001_01_01_000000_create_users_table', 1),
(94, '0001_01_01_000001_create_cache_table', 1),
(95, '0001_01_01_000002_create_jobs_table', 1),
(96, '0001_08_05_115209_create_categories_table', 1),
(97, '0001_08_05_115209_create_subcategories_table', 1),
(98, '0001_08_05_115210_create_subsubcategories_table', 1),
(99, '0001_08_07_082200_create_books_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('einTpzKnBeuGyjaCX5V1FMrLOMBGpUKRp7qIDhTF', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSmJpRkJzTWxyUVB3NWx5NmhXSXRMaGp1YWVtb0lYQnp5TzdxS3M2OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==', 1731433552),
('Oxh2wBlyFmGqpMJF9qw6eh3xPZI0XLBjabl9o2eb', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:130.0) Gecko/20100101 Firefox/130.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicDNQdkY4eTcyRXAxalJYa1JTOXV6QURjb2FBcUtBQnl4MmsyQWNKNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWxsaGVyZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1727583945);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'manga', 1, '2025-06-12 19:01:06', '2025-06-12 19:01:06'),
(2, 3, 'superhero', 1, '2025-06-12 19:01:15', '2025-06-12 19:01:15'),
(3, 1, 'fantacy', 1, '2025-06-12 19:02:21', '2025-06-12 19:02:21'),
(4, 1, 'thriller', 1, '2025-06-12 19:02:32', '2025-06-12 19:02:32'),
(5, 2, 'science', 1, '2025-06-12 19:03:21', '2025-06-12 19:03:21'),
(6, 2, 'self-help', 1, '2025-06-12 19:03:50', '2025-06-12 19:03:50'),
(7, 4, 'textbooks', 1, '2025-06-12 19:04:51', '2025-06-12 19:04:51'),
(8, 4, 'research paper', 1, '2025-06-12 19:05:33', '2025-06-12 19:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `subsubcategories`
--

CREATE TABLE `subsubcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `subsubcategory_name` varchar(255) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subsubcategories`
--

INSERT INTO `subsubcategories` (`id`, `subcategory_id`, `subsubcategory_name`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'marvel universe', 1, '2025-06-12 19:01:35', '2025-06-12 19:01:35'),
(2, 2, 'dc universe', 1, '2025-06-12 19:02:02', '2025-06-12 19:02:02'),
(3, 3, 'urban fantacy', 1, '2025-06-12 19:02:56', '2025-06-12 19:02:56'),
(4, 5, 'physics', 1, '2025-06-12 19:03:29', '2025-06-12 19:03:29'),
(5, 5, 'chemestry', 1, '2025-06-12 19:03:37', '2025-06-12 19:03:37'),
(6, 6, 'leadership', 1, '2025-06-12 19:04:00', '2025-06-12 19:04:00'),
(7, 7, 'math', 1, '2025-06-12 19:05:00', '2025-06-12 19:05:00'),
(8, 7, 'programming', 1, '2025-06-12 19:30:30', '2025-06-12 19:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `user_pic` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `phone`, `address`, `email`, `password`, `dob`, `gender`, `user_pic`, `status`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'Swagat', NULL, 'Ghimire', '9869458287', 'Balaju', 'ghimireswagat316@gmail.com', '$2y$12$1gMdhVdblhHHqq9WjMhJ6.3W5.7wIp9khukp4qc/KLLtLgB2anHC2', '2001-12-14', 'Male', 'swagat.jpg', 1, NULL, '2025-06-12 18:43:42', '2025-06-12 18:54:50'),
(2, 'Sajal', NULL, 'Maraseni', '9823456789', 'Syambhu', 'sajal@gmail.com', '$2y$12$eecaySNSC87da0RNe3JNp.jQttoZTDNy9kqVTWqrFiGODSCgFGTfG', '2004-03-21', 'Male', 'sajal.jpg', 1, NULL, '2025-06-12 18:44:53', '2025-06-12 18:49:03'),
(3, 'Tashi', NULL, 'Lama', '9846308287', 'Jamal', 'tashi@gmail.com', '$2y$12$O7rQwWrYjq0A.2DCZhVN8OouP5K1v4sO/U3Vjm3HaZMQqPWTZ2Z.C', '2003-05-23', 'Male', 'tashi.jpg', 1, NULL, '2025-06-12 18:46:02', '2025-06-22 11:47:25'),
(4, 'Saksham', NULL, 'Chatkuli', '9823174388', 'Shorahakhutte', 'saksham@gmail.com', '$2y$12$L/oBAV/cNvwyqyX4zkYmvO5RsL8AsfFz5zN6BbeihdCnx.rkNtMsu', '2002-02-12', 'Male', 'saksham.jpg', 1, NULL, '2025-06-12 18:57:17', '2025-06-24 16:10:19'),
(5, 'Subinam', NULL, 'Dangal', '9840458398', 'Lalitpur', 'subinam@gmail.com', '$2y$12$p9SZs3W/0P.Gw89KGY0z9e/8Gj2DC8fqXRTO8yv6m8MIXxrPS8hji', '2000-01-17', 'Male', 'subinam.jpg', 1, NULL, '2025-06-12 19:35:51', '2025-06-12 19:36:29'),
(8, 'Gaurab', NULL, 'Basyal', '9876543210', 'Baneshor', 'gaurab@gmail.com', '$2y$12$QlTrPd0ltH5kbSejeDWATOX8O/v6yr3mpXFfu8w0pFN.JDrLChJ.W', '2002-01-12', NULL, NULL, 1, NULL, '2025-06-27 09:03:02', '2025-06-27 09:54:51'),
(9, 'Leo', NULL, 'Messi', '9803308155', 'Argentina', 'leo@gmail.com', '$2y$12$ERShXq/vd.k.SMee2xSP0.Rwn7Qq6MZrJy/05kxxFmivT1/3GY51i', '1979-10-01', 'Male', 'messi.jpg', 1, NULL, '2025-06-28 01:40:49', '2025-06-28 01:52:02'),
(20, 'Pratik', NULL, 'Thapa', '9812345678', 'Lalitpur', 'pratik.thapa@gmail.com', '$2y$12$nmeXtrm96uyAVIBrnxG4N.s1aH8x0qMSjAbYye6v2WG3ONYsaRd.e', '2002-05-15', NULL, NULL, 1, NULL, '2025-06-28 12:19:06', '2025-06-28 13:01:04'),
(21, 'Sita', NULL, 'Shrestha', '9823456789', 'Kathmandu', 'sita.shrestha@gmail.com', '$2y$12$KJ3c1dSTkYfHTgHxvbYGg.QCrerxgOksAwP4TDVoi5t45rSxQCA6G', '2000-08-25', NULL, NULL, 1, NULL, '2025-06-28 12:21:12', '2025-06-28 13:01:04'),
(22, 'Ramesh', NULL, 'Khadka', '9834567890', 'Bhaktapur', 'ramesh.Khadka@gmail.com', '$2y$12$QJyKFbIqMlOyFPqxn8nxXeO.aH5YI3px41JBMNJaUe6w.h266b33C', '1998-12-30', NULL, NULL, 1, NULL, '2025-06-28 12:22:25', '2025-06-28 13:01:11'),
(23, 'Anjali', NULL, 'Gurung', '9845678901', 'Dharan', 'anjali.gurung@gmail.com', '$2y$12$wH83BjkU8bXoRFmbe7e1CO./Hrpf3YDf5qzDlbC/9N/yWKUqSNWWe', '1999-02-20', NULL, NULL, 1, NULL, '2025-06-28 12:23:44', '2025-06-28 13:01:05'),
(24, 'Samir', NULL, 'Maharjan', '9856789012', 'Pokhara', 'samir.maharjan@gmail.com', '$2y$12$7QX3k748H67R3zlH02UE9OMyT35LcHW.AifwGARtQpnHTk9ts3qAe', '2001-01-10', NULL, NULL, 1, NULL, '2025-06-28 12:24:58', '2025-06-28 13:01:06'),
(25, 'Priya', NULL, 'Thakuri', '9867890123', 'Biratnagar', 'priya.thakuri@gmail.com', '$2y$12$u1BdwQQ6o5fOK0sOBqj4kegpPd6W8WvHimwxxF2SiWU8CeS.EkIMy', '1997-04-11', NULL, NULL, 1, NULL, '2025-06-28 12:26:47', '2025-06-28 13:01:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_info_email_unique` (`email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_book_isbn_unique` (`book_isbn`),
  ADD KEY `books_category_id_foreign` (`category_id`),
  ADD KEY `books_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `books_subsubcategory_id_foreign` (`subsubcategory_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`),
  ADD KEY `subcategories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `subsubcategories`
--
ALTER TABLE `subsubcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subsubcategories_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `subsubcategories_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_admin_id_foreign` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subsubcategories`
--
ALTER TABLE `subsubcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `books_subsubcategory_id_foreign` FOREIGN KEY (`subsubcategory_id`) REFERENCES `subsubcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin_info` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin_info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subsubcategories`
--
ALTER TABLE `subsubcategories`
  ADD CONSTRAINT `subsubcategories_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin_info` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subsubcategories_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin_info` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
