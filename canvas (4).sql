-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 08:03 PM
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
-- Database: `canvas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(25) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'juhiachary@', '$2y$10$Uu13cWTfGEa0hC33/cpgWecjUixGibe0ony7WAWfUa5beIOxI5KWO'),
(2, 'krish@', '$2y$10$Uu13cWTfGEa0hC33/cpgWecjUixGibe0ony7WAWfUa5beIOxI5KWO');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `con_id` int(25) NOT NULL,
  `c_id` int(25) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `message` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`con_id`, `c_id`, `c_name`, `message`, `created_at`) VALUES
(1, 1, 'Krisha Parakhiya', 'Nice work, Excellent', '2024-09-28 10:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(250) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_password` varchar(250) NOT NULL,
  `c_email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_name`, `c_password`, `c_email`) VALUES
(1, 'krisha', '$2y$10$EgWkJaPMrtcVHyUYT23OZuJgJqpFueDo3Fz./qfc6N65ZE7ImHz.K', 'krishaparakhiya244@gmail.com'),
(2, 'Juhi ', '$2y$10$6VskCSt2e3Mqu6uSynyw9OaQYeXoxa.OQ7oO7MrQh4e2GwZ4AAHSK', 'juhi.acharya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `decorations`
--

CREATE TABLE `decorations` (
  `decoration_id` int(250) NOT NULL,
  `vendor_id` int(250) NOT NULL,
  `decoration_name` varchar(250) NOT NULL,
  `img_path` varchar(250) NOT NULL,
  `decoration_description` varchar(250) NOT NULL,
  `decoration_price` decimal(10,0) DEFAULT NULL,
  `category` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decorations`
--

INSERT INTO `decorations` (`decoration_id`, `vendor_id`, `decoration_name`, `img_path`, `decoration_description`, `decoration_price`, `category`) VALUES
(1, 2, 'Gold & Blush Elegance', 'uploads/reception-decor/1727444226_reception1.jpeg', ' Our gold and blush theme combines classic elegance with modern sophistication, making your special day unforgettable.', 25000, 'Reception'),
(2, 1, 'Elegant Enchantment', 'uploads/reception-decor/1727444337_reception2.jpeg', ' Elegantly adorned with white roses and delicate fairy lights, this setup creates a romantic ambiance perfect for a fairytale Reception.', 26000, 'Reception'),
(3, 3, 'Charming Garden Bliss', 'uploads/reception-decor/1727444433_reception3.jpeg', 'This charming garden setting with floral arches and rustic decor offers a serene and picturesque backdrop for your vows.', 27000, 'Reception'),
(4, 4, 'Vibrant Festive Flair', 'uploads/reception-decor/1727444523_reception4.jpeg', 'Celebrate your love story with our vibrant, colorful decorations that add a festive and joyous spirit to your reception day.', 28000, 'Reception'),
(5, 4, 'Minimalist Chic', 'uploads/reception-decor/1727444660_reception5.jpeg', ' This minimalist yet stylish setup features clean lines and sophisticated decor, perfect for a modern and chic reception.', 29000, 'Reception'),
(6, 5, 'Opulent Elegance', 'uploads/reception-decor/1727444746_reception6.jpg', ' Rich in texture and elegance, this setup combines deep colors and luxurious fabrics for a grand and opulent celebration.', 30000, 'Reception'),
(7, 6, 'Pastel Whimsy', 'uploads/reception-decor/1727444895_reception7.jpg', ' Bright and airy, this decor features light pastel hues and whimsical elements, perfect for a cheerful and lively reception.', 31000, 'Reception'),
(8, 7, 'Vintage Modern Fusion', 'uploads/reception-decor/1727445115_reception8.jpg', ' A blend of vintage and modern styles, this setup is designed to provide a nostalgic yet contemporary feel for your reception.', 32000, 'Reception'),
(9, 8, 'Enchanted Evening ', 'uploads/reception-decor/1727445195_reception9.jpg', ' Our elegant evening decor includes candlelit tables and luxurious drapes, creating an enchanting atmosphere for your celebration. ', 33000, 'Reception'),
(10, 9, 'Enchanted Evening ', 'uploads/reception-decor/1727445247_reception10.jpg', ' Our elegant evening decor includes candlelit tables and luxurious drapes, creating an enchanting atmosphere for your celebration. ', 34000, 'Reception'),
(11, 10, 'Rustic Cozy Charm', 'uploads/reception-decor/1727445392_reception11.jpg', ' Combining rustic charm with modern accents, this decor is ideal for an intimate and cozy reception setting.', 35000, 'Reception'),
(12, 1, 'Sophisticated Luxury', 'uploads/reception-decor/1727445459_reception12.jpg', ' Featuring a luxurious color palette and intricate designs, this setup is perfect for a sophisticated and elegant reception.', 36000, 'Reception'),
(13, 2, 'Sophisticated Luxury', 'uploads/reception-decor/1727445494_reception13.jpg', ' Featuring a luxurious color palette and intricate designs, this setup is perfect for a sophisticated and elegant reception.', 37000, 'Reception'),
(14, 3, 'Lush Greenery', 'uploads/reception-decor/1727445562_reception14.jpg', 'With its blend of lush greenery and delicate florals, this design creates a refreshing and natural setting for your vows.', 38000, 'Reception'),
(15, 6, 'Lush Greenery', 'uploads/reception-decor/1727445589_reception15.jpg', 'With its blend of lush greenery and delicate florals, this design creates a refreshing and natural setting for your vows.', 40000, 'Reception'),
(16, 5, 'Sleek Modernity ', 'uploads/reception-decor/1727445654_reception16.jpeg', 'Our modern and sleek setup is perfect for a contemporary wedding, featuring clean lines and bold decor elements.', 41000, 'Reception'),
(17, 7, 'Sleek Modernity ', 'uploads/reception-decor/1727445678_reception18.jpeg', 'Our modern and sleek setup is perfect for a contemporary wedding, featuring clean lines and bold decor elements.', 45000, 'Reception'),
(18, 7, 'Sleek Modernity ', 'uploads/reception-decor/1727445706_reception18.jpeg', 'Our modern and sleek setup is perfect for a contemporary reception, featuring clean lines and bold decor elements.', 45000, 'Reception'),
(19, 1, 'Vibrant floral arrangements ', 'uploads/haldi-decor/1727446784_haldi1.jpg', 'Beautifully decorated haldi setup with floral arrangements', 24000, 'Haldi'),
(21, 2, 'Elegant Enchantment', 'uploads/haldi-decor/1727446872_haldi2.jpg', 'An elegant setup creating a serene ambiance for the celebration.', 25000, 'Haldi'),
(22, 3, 'Elegant Enchantment', 'uploads/haldi-decor/1727446909_haldi3.jpg', 'An elegant setup creating a serene ambiance for the celebration.', 26000, 'Haldi'),
(23, 5, 'Lush Greenery', 'uploads/haldi-decor/1727446977_haldi4.jpg', 'Bright and cheerful decorations to celebrate love and joy.', 26000, 'Haldi'),
(24, 10, 'Lush Greenery', 'uploads/haldi-decor/1727447019_haldi5.jpg', 'Bright and cheerful decorations to celebrate love and joy.', 27000, 'Haldi'),
(25, 6, 'Gold & Blush Elegance', 'uploads/haldi-decor/1727447172_haldi6.jpg', 'Colorful and vibrant elements bringing the Haldi celebration to life.', 27000, 'Haldi'),
(26, 7, 'Gold & Blush Elegance', 'uploads/haldi-decor/1727447218_haldi7.jpg', 'Colorful and vibrant elements bringing the Haldi celebration to life.', 28000, 'Haldi'),
(27, 8, 'Charming Haldi decoration', 'uploads/haldi-decor/1727447304_haldi8.jpg', 'Charming drapes and decorations adding charm to the event.', 29000, 'Haldi'),
(28, 7, 'Charming Haldi decoration', 'uploads/haldi-decor/1727447329_haldi9.jpg', 'Charming drapes and decorations adding charm to the event.', 30000, 'Haldi'),
(29, 10, 'Traditional elements Haldi.', 'uploads/haldi-decor/1727447402_haldi10.jpg', 'Traditional elements that reflect the essence of Haldi.', 31000, 'Haldi'),
(30, 3, 'Charming Haldi decoration', 'uploads/haldi-decor/1727457334_haldi11.jpg', 'Charming drapes and decorations adding charm to the event.', 26000, 'Haldi'),
(31, 5, 'Charming Haldi decoration', 'uploads/haldi-decor/1727457380_haldi12.jpg', 'Charming drapes and decorations adding charm to the event.', 27000, 'Haldi'),
(32, 7, 'Bright Haldi decoration', 'uploads/haldi-decor/1727457561_haldi13.jpg', 'Bright and cheerful decorations to celebrate love and joy.', 29000, 'Haldi'),
(33, 9, 'Bright Haldi decoration', 'uploads/haldi-decor/1727457599_haldi14.jpg', 'Bright and cheerful decorations to celebrate love and joy.', 30000, 'Haldi'),
(34, 10, 'Artistic Haldi decor', 'uploads/haldi-decor/1727457665_haldi15.jpg', 'Artistic decor showcasing creativity and elegance.', 32000, 'Haldi'),
(35, 5, 'Artistic Haldi decor', 'uploads/haldi-decor/1727457691_haldi19.jpg', 'Artistic decor showcasing creativity and elegance.', 34000, 'Haldi'),
(36, 3, 'Colorful Haldi celebration', 'uploads/haldi-decor/1727457792_haldi17.jpg', 'Colorful and vibrant elements bringing the Haldi celebration to life.', 35000, 'Haldi'),
(37, 6, 'Colorful Haldi celebration', 'uploads/haldi-decor/1727457812_haldi18.jpg', 'Colorful and vibrant elements bringing the Haldi celebration to life.', 39000, 'Haldi'),
(38, 1, 'Intricate Mehndi Design', 'uploads/mehendi-decor/1727458317_mehendi1.jpg', 'Intricate floral patterns symbolizing love and joy, perfect for Mehndi celebrations.', 24000, 'Mehendi'),
(39, 2, 'Intricate Mehndi Design', 'uploads/mehendi-decor/1727458345_mehendi3.jpg', 'Intricate floral patterns symbolizing love and joy, perfect for Mehndi celebrations.', 25000, 'Mehendi'),
(40, 3, 'Vibrant Mehendi Setup', 'uploads/mehendi-decor/1727458471_mehendi4.jpg', 'A vibrant setup that captures the essence of traditional Mehendi ceremonies.', 26000, 'Mehendi'),
(41, 4, 'Vibrant Mehendi Setup', 'uploads/mehendi-decor/1727458497_mehendi5.jpg', 'A vibrant setup that captures the essence of traditional Mehendi ceremonies.', 28000, 'Mehendi'),
(42, 5, 'Traditional Mehendi Decoration', 'uploads/mehendi-decor/1727458562_mehendi6.jpg', 'Classic decorations that highlight the cultural significance of Mehendi.', 29000, 'Mehendi'),
(43, 6, 'Traditional Mehendi Decoration', 'uploads/mehendi-decor/1727458584_mehendi7.jpg', 'Classic decorations that highlight the cultural significance of Mehendi.', 30000, 'Mehendi'),
(44, 7, 'Elegant Mehendi Arrangement', 'uploads/mehendi-decor/1727458660_mehendi8.jpg', 'Elegant arrangements that add a touch of sophistication to your Mehendi event', 31000, 'Mehendi'),
(45, 8, 'Elegant Mehendi Arrangement', 'uploads/mehendi-decor/1727458680_mehendi9.jpg', 'Elegant arrangements that add a touch of sophistication to your Mehendi event', 33000, 'Mehendi'),
(46, 9, 'Artistic Mehendi Setup', 'uploads/mehendi-decor/1727458739_mehendi10.jpg', 'Artistic designs and setups that celebrate the beauty of Mehendi art.', 34000, 'Mehendi'),
(47, 9, 'Artistic Mehendi Setup', 'uploads/mehendi-decor/1727458762_mehendi11.jpg', 'Artistic designs and setups that celebrate the beauty of Mehendi art.', 35000, 'Mehendi'),
(48, 10, 'Colorful Mehendi Display', 'uploads/mehendi-decor/1727458863_mehendi12.jpg', 'A colorful display showcasing the festive spirit of Mehendi celebrations.', 36000, 'Mehendi'),
(49, 1, 'Colorful Mehendi Display', 'uploads/mehendi-decor/1727458890_mehendi13.jpg', 'A colorful display showcasing the festive spirit of Mehendi celebrations.', 37000, 'Mehendi'),
(50, 1, 'Festive Mehendi Theme', 'uploads/mehendi-decor/1727458970_mehendi16.jpg', 'A festive theme that brings together friends and family to celebrate love and unity.', 38000, 'Mehendi'),
(51, 3, 'Festive Mehendi Theme', 'uploads/mehendi-decor/1727459015_mehendi15.jpg', 'A festive theme that brings together friends and family to celebrate love and unity.', 40000, 'Mehendi'),
(52, 7, 'Exquisite Mehendi Setup', 'uploads/mehendi-decor/1727459085_mehendi19.jpg', 'An exquisite setup highlighting the intricate details of Mehendi decoration.', 45000, 'Mehendi'),
(53, 4, 'Charming Mehendi Decoration', 'uploads/mehendi-decor/1727459200_mehendi18.jpg', 'Stylish Mehendi art designs that reflect contemporary trends and traditions.', 46000, 'Mehendi'),
(54, 1, 'Gold & Blush Elegance', 'uploads/sangeet-decor/1727459568_sangeet1.jpg', 'Mesmerizing backdrops adorned with twinkling lights, perfect for capturing unforgettable moments.', 25000, 'Sangeet'),
(55, 2, 'Gold & Blush Elegance', 'uploads/sangeet-decor/1727459600_sangeet2.jpg', 'Mesmerizing backdrops adorned with twinkling lights, perfect for capturing unforgettable moments.', 26000, 'Sangeet'),
(56, 3, 'Charming Sangeet Decoration', 'uploads/sangeet-decor/1727459677_sangeet3.jpg', 'Charming seating arrangements that encourage laughter, dancing, and bonding among family and friends.', 27000, 'Sangeet'),
(57, 4, 'Charming Sangeet Decoration', 'uploads/sangeet-decor/1727459694_sangeet4.jpg', 'Charming seating arrangements that encourage laughter, dancing, and bonding among family and friends.', 28000, 'Sangeet'),
(58, 5, 'Elegant Enchantment', 'uploads/sangeet-decor/1727459753_sangeet5.jpg', 'Brightly lit dance floors that invite everyone to join in the celebration and let loose.', 29000, 'Sangeet'),
(59, 6, 'Elegant Enchantment', 'uploads/sangeet-decor/1727459784_sangeet6.jpg', 'Brightly lit dance floors that invite everyone to join in the celebration and let loose.', 30000, 'Sangeet'),
(61, 6, 'Lush Greenery', 'uploads/sangeet-decor/1727459856_sangeet7.jpg', 'Unique decor elements that reflect the couple\'s personality, adding a personal touch to the Sangeet night.\r\n', 30000, 'Sangeet'),
(63, 4, 'Gold & Blush Elegance', 'uploads/sangeet-decor/1727460130_sangeet8.jpg', 'Exquisite table settings with colorful centerpieces that bring vibrancy to the dining experience.', 31000, 'Sangeet'),
(64, 5, 'Intricate Sangeet Design', 'uploads/sangeet-decor/1727460173_sangeet9.jpg', 'Exquisite table settings with colorful centerpieces that bring vibrancy to the dining experience.', 33000, 'Sangeet'),
(65, 6, 'Intricate Sangeet Design', 'uploads/sangeet-decor/1727460214_sangeet10.jpg', 'A magical evening filled with laughter and music, surrounded by stunning decorations that create lasting memories.', 34000, 'Sangeet'),
(66, 7, 'Intricate Sangeet Design', 'uploads/sangeet-decor/1727460249_sangeet11.jpg', 'A magical evening filled with laughter and music, surrounded by stunning decorations that create lasting memories.', 35000, 'Sangeet'),
(67, 7, 'Sleek Modernity ', 'uploads/sangeet-decor/1727460388_sangeet13.jpg', 'Celebratory decor with traditional motifs that honor the culture while ensuring a modern celebration.', 35000, 'Sangeet'),
(68, 8, 'Elegant Enchantment', 'uploads/sangeet-decor/1727460418_sangeet14.jpg', 'Celebratory decor with traditional motifs that honor the culture while ensuring a modern celebration.', 34000, 'Sangeet'),
(71, 10, 'Lush Greenery', 'uploads/sangeet-decor/1727460544_sangeet18.jpg', 'Lavish floral arrangements that enhance the festive spirit of the Sangeet, making it a night to remember.', 39000, 'Sangeet'),
(72, 4, 'Lush Greenery', 'uploads/sangeet-decor/1727460610_sangeet17.jpg', 'Lavish floral arrangements that enhance the festive spirit of the Sangeet, making it a night to remember.', 45000, 'Sangeet'),
(73, 1, 'Sleek Modernity', 'uploads/wedding-decor/1727520316_wedding1.jpg', ' Our modern and sleek setup is perfect for a contemporary wedding, featuring clean lines and bold decor elements.', 27000, 'Wedding'),
(74, 2, 'Elegant Enchantment', 'uploads/wedding-decor/1727520344_wedding2.jpg', ' Our modern and sleek setup is perfect for a contemporary wedding, featuring clean lines and bold decor elements.', 29000, 'Wedding'),
(75, 3, 'Lush Greenery', 'uploads/wedding-decor/1727520450_wedding3.jpg', ' With its blend of lush greenery and delicate florals, this design creates a refreshing and natural setting for your vows.', 30000, 'Wedding'),
(76, 4, 'Sleek Modernity ', 'uploads/wedding-decor/1727520485_wedding4.jpg', ' With its blend of lush greenery and delicate florals, this design creates a refreshing and natural setting for your vows.', 31000, 'Wedding'),
(77, 5, ' Sophisticated Luxury', 'uploads/wedding-decor/1727520547_wedding5.jpg', ' Featuring a luxurious color palette and intricate designs, this setup is perfect for a sophisticated and elegant wedding.', 34000, 'Wedding'),
(78, 6, 'Elegant Enchantment', 'uploads/wedding-decor/1727520580_wedding6.jpg', ' Featuring a luxurious color palette and intricate designs, this setup is perfect for a sophisticated and elegant wedding.', 35000, 'Wedding'),
(79, 7, 'Charming Wedding Decoration', 'uploads/wedding-decor/1727520663_wedding7.jpg', ' Featuring a luxurious color palette and intricate designs, this setup is perfect for a sophisticated and elegant wedding.', 37000, 'Wedding'),
(80, 8, 'Golden Grandeur ', 'uploads/wedding-decor/1727520779_wedding7.jpg', ' This luxurious gold-themed decor adds a touch of grandeur and sophistication, making your special day truly spectacular.', 37000, 'Wedding'),
(81, 9, 'Sleek Modernity ', 'uploads/wedding-decor/1727520813_wedding8.jpg', ' This luxurious gold-themed decor adds a touch of grandeur and sophistication, making your special day truly spectacular.', 38000, 'Wedding'),
(82, 10, 'Rustic Cozy Charm', 'uploads/wedding-decor/1727520904_wedding9.jpg', 'Combining rustic charm with modern accents, this decor is ideal for an intimate and cozy wedding setting.', 39000, 'Wedding'),
(83, 1, 'Gold & Blush Elegance', 'uploads/wedding-decor/1727520939_wedding10.jpg', 'Combining rustic charm with modern accents, this decor is ideal for an intimate and cozy wedding setting.', 40000, 'Wedding'),
(84, 2, 'Enchanted Evening', 'uploads/wedding-decor/1727522065_wedding11.jpg', ' Our elegant evening decor includes candlelit tables and luxurious drapes, creating an enchanting atmosphere for your celebration.', 41000, 'Wedding'),
(85, 3, 'Sleek Modernity ', 'uploads/wedding-decor/1727522101_wedding12.jpg', ' Our elegant evening decor includes candlelit tables and luxurious drapes, creating an enchanting atmosphere for your celebration.', 42000, 'Wedding'),
(86, 3, 'Vintage Modern Fusion', 'uploads/wedding-decor/1727522190_wedding13.jpg', ' A blend of vintage and modern styles, this setup is designed to provide a nostalgic yet contemporary feel for your wedding.', 42000, 'Wedding'),
(87, 4, 'Vintage Modern Fusion', 'uploads/wedding-decor/1727522365_wedding14.jpg', ' A blend of vintage and modern styles, this setup is designed to provide a nostalgic yet contemporary feel for your wedding.', 43000, 'Wedding'),
(88, 5, 'Pastel Whimsy ', 'uploads/wedding-decor/1727522442_wedding15.jpg', ' Bright and airy, this decor features light pastel hues and whimsical elements, perfect for a cheerful and lively wedding.', 45000, 'Wedding'),
(89, 1, 'Whimsical Romance', 'uploads/engagement-decor/1727523151_engag1.jpg', 'A beautifully decorated engagement setup with elegant floral arrangements and soft lighting, creating a romantic ambiance.', 25000, 'Engagement'),
(90, 2, ' Modern Elegance', 'uploads/engagement-decor/1727523270_engag2.jpg', 'A chic and modern engagement decoration featuring minimalistic decor and vibrant colors, perfect for contemporary celebrations.', 26000, 'Engagement'),
(91, 3, 'Rustic Charm', 'uploads/engagement-decor/1727523382_engag3.jpg', 'A rustic-themed engagement arrangement with wooden elements and nature-inspired decor, giving a cozy and inviting feel.\r\n\r\n', 28000, 'Engagement'),
(92, 4, 'Glamorous Affair', 'uploads/engagement-decor/1727523444_engag4.jpg', 'An extravagant engagement setup adorned with luxurious fabrics and shimmering accents, ideal for a grand celebration.\r\n\r\n', 29000, 'Engagement'),
(93, 5, 'Playful Vibes', 'uploads/engagement-decor/1727523541_engag5.jpg', 'A playful and whimsical engagement decoration with bright colors and fun elements, perfect for a lively gathering.\r\n\r\n', 27000, 'Engagement'),
(94, 6, 'Timeless Classic', 'uploads/engagement-decor/1727523607_engag6.jpg', 'A classic engagement arrangement featuring elegant table settings and sophisticated floral centerpieces, exuding timeless charm.\r\n\r\n', 28000, 'Engagement'),
(95, 7, 'Serene Beachside', 'uploads/engagement-decor/1727523662_engag7.jpg', 'A beach-themed engagement decor that combines natural elements and soft hues, creating a serene and tranquil atmosphere.\r\n\r\n', 29000, 'Engagement'),
(96, 8, 'Fairy-Tale Dreams', 'uploads/engagement-decor/1727523886_engag8.jpg', 'A fairy-tale inspired setup with twinkling lights and dreamy decorations, perfect for creating a magical moment.\r\n\r\n', 30000, 'Engagement'),
(97, 9, 'Bold Celebration', 'uploads/engagement-decor/1727523957_engag9.jpg', 'A bold and colorful engagement display featuring vibrant flowers and eye-catching decor, making a striking impression.\r\n\r\n', 31000, 'Engagement'),
(98, 10, 'Garden Elegance', 'uploads/engagement-decor/1727524008_engag10.jpg', 'An elegant garden-themed decoration with lush greenery and delicate floral arrangements, providing a refreshing outdoor vibe.\r\n\r\n', 32000, 'Engagement'),
(99, 10, 'Vintage Nostalgia', 'uploads/engagement-decor/1727524053_engag11.jpg', 'A vintage-style engagement setup with nostalgic decor elements and soft pastel colors, evoking a sense of nostalgia.\r\n\r\n', 33000, 'Engagement'),
(100, 10, 'Luxurious Glamour', 'uploads/engagement-decor/1727524101_engag12.jpg', 'A luxurious engagement decor featuring gold accents and rich textures, ideal for a glamorous celebration.\r\n', 34000, 'Engagement'),
(101, 1, 'Contemporary Style', 'uploads/engagement-decor/1727524163_engag13.jpg', 'A modern engagement arrangement with geometric designs and sleek lines, offering a stylish and contemporary look.\r\n', 36000, 'Engagement'),
(102, 5, 'Intimate Gathering', 'uploads/engagement-decor/1727524213_engag15.jpg', 'A cozy and intimate engagement setup with warm lighting and personal touches, perfect for small gatherings.', 38000, 'Engagement'),
(103, 8, 'Artistic Flair', 'uploads/engagement-decor/1727524287_engag17.jpg', 'An artistic engagement display featuring unique decor items and creative arrangements, perfect for those looking for something different.', 40000, 'Engagement'),
(104, 5, 'Cultural Celebration', 'uploads/engagement-decor/1727524364_engag14.jpg', 'A vibrant cultural-themed engagement decoration celebrating heritage with traditional motifs and colors.', 45000, 'Engagement'),
(105, 5, 'Cultural Celebration', 'uploads/engagement-decor/1727524412_engag14.jpg', 'A vibrant cultural-themed engagement decoration celebrating heritage with traditional motifs and colors.', 45000, 'Engagement'),
(106, 9, 'Cultural Celebration', 'uploads/engagement-decor/1727524467_engag16.jpg', 'A vibrant cultural-themed engagement decoration celebrating heritage with traditional motifs and colors.', 41000, 'Engagement');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(250) NOT NULL,
  `decoration_id` int(250) NOT NULL,
  `c_id` int(250) NOT NULL,
  `event_date` date NOT NULL,
  `total_amount` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `venue` varchar(255) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `vendor_commission` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `decoration_id`, `c_id`, `event_date`, `total_amount`, `status`, `created_at`, `venue`, `contact_info`, `vendor_commission`) VALUES
(1, 55, 1, '2025-01-22', 'â‚¹26000', 'pending', '2024-09-28 10:29:44', 'Heaven Water Park', '9874561235', 1300),
(2, 46, 1, '2024-11-29', '₹34000', 'pending', '2024-09-28 15:55:08', 'testing', '9987452100', 1700),
(3, 84, 2, '2025-01-24', '₹41000', 'pending', '2024-09-28 16:26:44', 'testing ', '9832154894', 2050);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(250) NOT NULL,
  `c_id` int(250) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_email` varchar(250) NOT NULL,
  `payment_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `paid_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `c_id`, `c_name`, `c_email`, `payment_date`, `paid_amount`) VALUES
(1, 1, 'krisha', 'krishaparakhiya244@gmail.com', '2024-09-28 10:29:44.000000', 'â‚¹26000'),
(2, 1, 'krisha', 'krishaparakhiya244@gmail.com', '2024-09-28 15:55:08.000000', '₹34000'),
(3, 2, 'Juhi', 'juhi.acharya@gmail.com', '2024-09-28 16:26:44.000000', '₹41000');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(250) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_password` varchar(250) NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `vendor_email` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `vendor_password`, `contact_info`, `vendor_email`, `created_at`) VALUES
(1, 'Jayant Shah', '$2y$10$Fl4Cgc76TzLcq8sfnnCmqOSmDwBhlP8v8SMwzoG4KwMN09LexSlgS', '98546478965', 'jayantshah@gmail.com', '2024-09-27 07:31:27'),
(2, 'Vikas Poojara', '$2y$10$cZ5kvkbaAxxV7r1MZbxw7OZC0zqKFfdUKtDdGao76va7gECLMUf0O', '9874562131', 'vikas@gmail.com', '2024-09-27 07:32:43'),
(3, 'Mihir  Mehta', '$2y$10$PjqoFbsWekj5av9sw.ZRj./LT8rOM6LrkTXj5y2uz.PnehqIIL1SW', '9106869997', 'mihir@gmail.com', '2024-09-27 07:33:43'),
(4, 'Yash Soni', '$2y$10$zRIbG6VRO8WhPHDRLB/YHO.XlZeeTdeoP67cpa3VMWDWrjVhceLbq', '9784568712', 'yash@gmail.com', '2024-09-27 07:34:28'),
(5, 'Mohit Mehra', '$2y$10$JPNNee9AEuaz2nBx7wnE2.VRfzfijhYBFsbllr0Mi0yrhfMs3NxW.', '7897821426', 'mohit@gmail.com', '2024-09-27 07:35:34'),
(6, 'Harsh Makawana', '$2y$10$plAuus8d55Mxh5MgVkTm3uXmd7sF0rP8uIsaoWmgFUI11KVv/swPm', '7894581236', 'harsh@gmail.com', '2024-09-27 07:36:14'),
(7, 'Ram Joshi', '$2y$10$IgCF.zRhdAekdg.wjCMgGO7xe0nHzUL7I4cCdoxEfYcoZ06Cw.9aO', '7894561237', 'ram12@gmail.com', '2024-09-27 07:37:23'),
(8, 'Shiv Patel', '$2y$10$B.YGBMObVuwJuZSYN4wEm.HBZgtG5ubUmiEHavokXZ106WIJ3dwke', '7865489219', 'shiv@gmail.com', '2024-09-27 07:37:56'),
(9, 'Gopal Lakhani', '$2y$10$st0ztwmuC6ycK8VmuYznduJIa0gk.nZeGZ8K3zA3lisYE6pHF3J4y', '7895454569', 'gopal@gmail.com', '2024-09-27 07:39:17'),
(10, 'Kishan Ghelani', '$2y$10$kms4r4.RXtC/eYGIlxc5cuyJcRZCdpCHOFr09FUBR.jsRaaujuK4.', '8787965412', 'kishan@gmail.com', '2024-09-27 07:40:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `decorations`
--
ALTER TABLE `decorations`
  ADD PRIMARY KEY (`decoration_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `decoration_id` (`decoration_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `con_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `decorations`
--
ALTER TABLE `decorations`
  MODIFY `decoration_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customers` (`c_id`);

--
-- Constraints for table `decorations`
--
ALTER TABLE `decorations`
  ADD CONSTRAINT `decorations_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
