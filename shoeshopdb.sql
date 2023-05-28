-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2023 at 04:47 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoeshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brandid` int NOT NULL,
  `brandname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `brandimagepath` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brandid`, `brandname`, `brandimagepath`) VALUES
(1, 'Nike', '/photos/brands/android-icon-192x192.png'),
(2, 'Adidas', '/photos/brands/Adidas-Logo-1991.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int NOT NULL,
  `productsizeid` int NOT NULL,
  `userid` int NOT NULL,
  `qty` int NOT NULL,
  `ischeckout` tinyint(1) NOT NULL,
  `isdelivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `productsizeid`, `userid`, `qty`, `ischeckout`, `isdelivered`) VALUES
(6, 45, 21, 1, 1, 1),
(8, 46, 21, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryid` int NOT NULL,
  `categoryname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `categorysubname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryid`, `categoryname`, `categorysubname`) VALUES
(1, 'Men', 'Lifestyle'),
(2, 'Men', 'Jordan'),
(3, 'Men', 'Football'),
(4, 'Women', 'Lifestyle'),
(5, 'Women', 'Running'),
(6, 'Women', 'Tennis'),
(7, 'Kids', 'Lifestyle'),
(8, 'Kids', 'Running'),
(9, 'Kids', 'Basketball');

-- --------------------------------------------------------

--
-- Table structure for table `productcolors`
--

CREATE TABLE `productcolors` (
  `productid` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productcolors`
--

INSERT INTO `productcolors` (`productid`, `color`) VALUES
(1, 'Black'),
(3, 'Black/Dark Smoke'),
(5, 'Cloud White'),
(5, 'Solar Red'),
(6, 'Black'),
(7, 'Sail'),
(8, 'Cave Purple'),
(9, 'Photo Blue'),
(10, 'White'),
(11, 'Citron Tint'),
(12, 'Vivid Purple');

-- --------------------------------------------------------

--
-- Table structure for table `productphotos`
--

CREATE TABLE `productphotos` (
  `id` int NOT NULL,
  `productid` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `imagepath` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productphotos`
--

INSERT INTO `productphotos` (`id`, `productid`, `color`, `imagepath`) VALUES
(2, 3, 'Black/Dark Smoke', '/photos/products/646c97bcd1104.jpg'),
(3, 3, 'Black/Dark Smoke', '/photos/products/646c98361861d.jpg'),
(4, 3, 'Black/Dark Smoke', '/photos/products/646c9842205aa.webp'),
(5, 3, 'Black/Dark Smoke', '/photos/products/646c9852034e1.webp'),
(6, 3, 'Black/Dark Smoke', '/photos/products/646c986177493.webp'),
(7, 3, 'Black/Dark Smoke', '/photos/products/646cb0182fd7e.webp'),
(12, 1, 'Black', '/photos/products/646cc083de46f.webp'),
(13, 1, 'Black', '/photos/products/646cc08fd5470.webp'),
(14, 1, 'Black', '/photos/products/646cc0994f017.webp'),
(15, 1, 'Black', '/photos/products/646cc0ac8e7bd.webp'),
(16, 1, 'Black', '/photos/products/646cc0b8d2b72.webp'),
(17, 1, 'Black', '/photos/products/646cc0c83701c.webp'),
(18, 5, 'Cloud White', '/photos/products/646cc25c1f188.webp'),
(19, 5, 'Cloud White', '/photos/products/646cc268cfd9b.webp'),
(20, 5, 'Cloud White', '/photos/products/646cc271b44fe.webp'),
(21, 5, 'Cloud White', '/photos/products/646cc27a81a30.webp'),
(23, 5, 'Cloud White', '/photos/products/646cc28f7e02e.webp'),
(24, 5, 'Solar Red', '/photos/products/646cc2dd1b8ae.webp'),
(25, 5, 'Solar Red', '/photos/products/646cc2e65c1ca.webp'),
(26, 5, 'Solar Red', '/photos/products/646cc2ee3ef8f.webp'),
(27, 5, 'Solar Red', '/photos/products/646cc2f8a4e65.webp'),
(28, 6, 'Black', '/photos/products/646cc3ad6eb0f.webp'),
(29, 6, 'Black', '/photos/products/646cc3b7200e9.webp'),
(30, 6, 'Black', '/photos/products/646cc3c503ee8.webp'),
(31, 6, 'Black', '/photos/products/646cc3d015073.webp'),
(33, 6, 'Black', '/photos/products/646cc3ed92124.webp'),
(34, 7, 'Sail', '/photos/products/646cc4df26c89.webp'),
(35, 7, 'Sail', '/photos/products/646cc4e713087.webp'),
(36, 7, 'Sail', '/photos/products/646cc4efee9ad.webp'),
(37, 7, 'Sail', '/photos/products/646cc4fba2c72.webp'),
(38, 7, 'Sail', '/photos/products/646cc50e901d1.webp'),
(39, 8, 'Cave Purple', '/photos/products/646cc5c7be954.webp'),
(40, 8, 'Cave Purple', '/photos/products/646cc5d0a5d43.webp'),
(41, 8, 'Cave Purple', '/photos/products/646cc5da92791.webp'),
(42, 8, 'Cave Purple', '/photos/products/646cc5e29faf4.jpg'),
(43, 8, 'Cave Purple', '/photos/products/646cc5ed42f30.webp'),
(44, 9, 'Photo Blue', '/photos/products/646cc7ae749c8.webp'),
(45, 9, 'Photo Blue', '/photos/products/646cc7c21958b.webp'),
(46, 9, 'Photo Blue', '/photos/products/646cc7cb91b59.webp'),
(47, 10, 'White', '/photos/products/646cc88667c4a.webp'),
(48, 10, 'White', '/photos/products/646cc88f0fc0c.webp'),
(49, 10, 'White', '/photos/products/646cc8976ebeb.webp'),
(50, 11, 'Citron Tint', '/photos/products/646cc94e340b4.webp'),
(51, 11, 'Citron Tint', '/photos/products/646cc9559c63f.webp'),
(52, 11, 'Citron Tint', '/photos/products/646cc95d9d06b.webp'),
(53, 11, 'Citron Tint', '/photos/products/646cc969d2de3.webp'),
(54, 11, 'Citron Tint', '/photos/products/646cc97455e53.webp'),
(55, 12, 'Vivid Purple', '/photos/products/646cca0e40f9e.webp'),
(56, 12, 'Vivid Purple', '/photos/products/646cca152448c.webp'),
(57, 12, 'Vivid Purple', '/photos/products/646cca1ce1476.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` int NOT NULL,
  `productname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `shortdescription` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` smallint NOT NULL,
  `sizetype` varchar(3) COLLATE utf8mb4_general_ci NOT NULL,
  `brandid` int NOT NULL,
  `categoryid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `productname`, `price`, `discount`, `shortdescription`, `description`, `gender`, `sizetype`, `brandid`, `categoryid`) VALUES
(1, 'Nike Air Max TW', '245.00', 0, 'Men\'s Shoes - Sustainable Materials', 'So you\'re in love with the classic look of the \'90s, but you\'ve got a thing for today\'s fast-paced culture. Meet the Air Max TW. Inspired by the treasured franchise that brought Nike Air cushioning to the world and laid the foundation for the track-to-street aesthetic, its eye-catching design delivers a 1–2 punch of comfort and fashion. Ready to highlight any \'fit, its lightweight upper pairs angular and organic lines to create an entrancing haptic effect. The contrasting colourways make it easy to style. And if you\'re ready for the next step, the 5 windows underfoot deliver a modern edge to visible Air cushioning.\r\n\r\n', 0, 'US', 1, 1),
(3, 'Nike Pegasus 39 Shield', '129.90', 40, 'Women\'s Weatherised Road Running Shoes', 'Your workhorse with wings returns to help you push through the rain. A water-repellent finish helps keep you dry while a cosy fleece-like feel on the inside helps keep your feet warm for nasty-weather runs. Rugged traction and 2 Zoom Air units provide grip and soft cushioning, so you can power through the elements.\r\n\r\n', 1, 'EU', 1, 4),
(5, 'GIÀY ĐÁ BÓNG FIRM GROUND LOW PREDATOR EDGE.1', '321.00', 0, 'Bóng đá', 'Giảm thêm 30% Không đúng kích cỡ hoặc màu sắc? Vui lòng truy cập trang Trả lại hàng & Hoàn tiền của chúng tôi để biết chi tiết.', 0, 'UK', 2, 3),
(6, 'Air Jordan XXXVII PF', '312.00', 0, 'Men\'s Basketball Shoes', 'You\'ve got the hops and the speed—lace up in shoes that enhance what you bring to the court. The latest AJ is all about take-offs and landings, with multiple Air units to get you off the ground and Formula 23 foam to cushion your impact. Up top, you\'ll find layers of tough, reinforced leno-weave fabric that\'ll keep you contained—and leave your game uncompromised—no matter how fast you move.', 0, 'EU', 1, 2),
(7, 'Air Jordan 1 Elevate High', '260.00', 0, 'Women\'s Shoes', 'Classic Jordan style reaches new heights in this lifted AJ-1. The platform stance and high-top collar make a statement, while crisp leather and flashy finishes make these kicks the winning assist your outfit needs. For added flex, the puffy, stitched-on Wings \"logo\" delivers big (and just wait until you feel the ultra-comfortable Air cushioning underfoot). Go ahead, elevate your game.', 1, 'EU', 1, 4),
(8, 'Nike Infinity React 3', '253.00', 0, 'Women\'s Road Running Shoes', 'Still one of our most tested shoes, the Nike Infinity React 3 has soft and supportive cushioning. Its soft, stable feel with a smooth ride will carry you through routes, long and short. A breathable upper is made to feel contained, yet flexible. We even added more cushioning to the collar for a soft feel. Keep running, we\'ve got you.', 0, 'EU', 1, 5),
(9, 'NikeCourt Air Zoom GP Turbo Naomi Osaka', '253.00', 15, 'Women\'s Clay Tennis Shoes', 'Tennis matches are fast, fierce and long. This version of Naomi Osaka\'s shoe combines a responsive Zoom Air unit with zones of durability, so you can stay fresh longer. We drew inspiration from Naomi\'s \"all heart, all smiles\" social media message and leaned on her luxury fashion partnership for the repeating-pattern look for a special design.', 0, 'EU', 1, 6),
(10, 'Nike Air Max 90 LTR', '146.00', 0, 'Older Kids\' Shoes', 'The Air Max 90 returns with an even better feel for you. Cushioning is softer and more flexible than previous versions, the Max Air unit is tuned for growing feet and the shape gives your toes more wiggle room. With a design and look that are still the same, it brings a \'90s fave to a new generation.', 0, 'EU', 1, 7),
(11, 'Nike Flex Runner 2', '58.00', 0, 'Baby/Toddler Shoes', 'Who\'s ready to play? The Nike Flex Runner 2 is built for the kiddo on the go—from the cot to the playground to wherever their day takes them. It\'s laces-free! Meaning it\'s super quick to slip on and off. The straps and bootie-like design make sure your little one\'s fit stays snug.', 0, 'EU', 1, 8),
(12, 'LeBron XX SE', '249.00', 0, 'Older Kids\' Basketball Shoes', 'There\'s a reason LeBron James is considered one of the best. From racking up MVPs to winning championships, the King has shattered expectations on the court for nearly 2 decades. Celebrate that dominance in the LeBron XX (or LeBron 20), the 20th edition of his signature shoe. With Zoom Air cushioning and a super-lightweight feel, they\'ll help you run, jump and compete until the final buzzer sounds.', 0, 'EU', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `productsizes`
--

CREATE TABLE `productsizes` (
  `id` int NOT NULL,
  `productid` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` float NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productsizes`
--

INSERT INTO `productsizes` (`id`, `productid`, `color`, `size`, `qty`) VALUES
(1, 3, 'Black/Dark Smoke', 40, 10),
(2, 3, 'Black/Dark Smoke', 40.5, 10),
(3, 3, 'Black/Dark Smoke', 41, 10),
(4, 3, 'Black/Dark Smoke', 42, 10),
(5, 3, 'Black/Dark Smoke', 42.5, 5),
(6, 3, 'Black/Dark Smoke', 43, 3),
(7, 3, 'Black/Dark Smoke', 44, 15),
(8, 3, 'Black/Dark Smoke', 44.5, 0),
(11, 1, 'Black', 40, 10),
(12, 1, 'Black', 40.5, 10),
(13, 1, 'Black', 41, 10),
(14, 1, 'Black', 42, 10),
(15, 1, 'Black', 42.5, 10),
(16, 1, 'Black', 43, 3),
(17, 1, 'Black', 44, 15),
(18, 1, 'Black', 44.5, 0),
(19, 5, 'Cloud White', 6, 1),
(20, 5, 'Cloud White', 7, 1),
(21, 5, 'Cloud White', 8, 2),
(22, 5, 'Cloud White', 11.5, 1),
(23, 5, 'Solar Red', 8, 1),
(24, 6, 'Black', 40, 10),
(25, 6, 'Black', 42, 10),
(26, 6, 'Black', 44, 10),
(27, 6, 'Black', 45.5, 0),
(28, 6, 'Black', 47.5, 0),
(29, 7, 'Sail', 36.5, 10),
(30, 7, 'Sail', 38.5, 10),
(31, 7, 'Sail', 40.5, 10),
(32, 8, 'Cave Purple', 36, 10),
(33, 8, 'Cave Purple', 38, 10),
(34, 8, 'Cave Purple', 40, 10),
(35, 8, 'Cave Purple', 42, 10),
(36, 9, 'Photo Blue', 36, 10),
(37, 9, 'Photo Blue', 38, 10),
(38, 9, 'Photo Blue', 40, 0),
(39, 10, 'White', 35.5, 10),
(40, 10, 'White', 37.5, 10),
(41, 10, 'White', 39.5, 10),
(42, 11, 'Citron Tint', 18.5, 20),
(43, 11, 'Citron Tint', 22, 20),
(44, 11, 'Citron Tint', 26.5, 10),
(45, 12, 'Vivid Purple', 35.5, 10),
(46, 12, 'Vivid Purple', 37.5, 10),
(47, 12, 'Vivid Purple', 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `birthday` date NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `emailconfirmed` tinyint(1) NOT NULL DEFAULT '0',
  `passwordhash` text COLLATE utf8mb4_general_ci NOT NULL,
  `accessfailedcount` int NOT NULL DEFAULT '0',
  `username` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `confirmationtoken` text COLLATE utf8mb4_general_ci,
  `resettoken` text COLLATE utf8mb4_general_ci,
  `resettokenissuedtime` datetime DEFAULT NULL,
  `roleid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `birthday`, `firstname`, `lastname`, `gender`, `email`, `emailconfirmed`, `passwordhash`, `accessfailedcount`, `username`, `confirmationtoken`, `resettoken`, `resettokenissuedtime`, `roleid`) VALUES
(1, '2002-09-20', 'my', 'admin', 0, 'admin@mail.com', 1, '$2y$10$weBQT6hgmF33ZifTM.DEXOFhe4DLUMsC9YHKQj9gU5GHMLdUuPUve', 0, 'admin', NULL, NULL, NULL, 1),
(21, '2002-09-20', 'Do', 'Sang', 0, 'dothesang20@gmail.com', 0, '$2y$10$iG4xL1NM7i5z41YsT2avDunJbaxnXGpGW4NgIGpFS9NykarIEYdCe', 0, 'sang09', '73eb8b365458dfb72fdab358471af69a', NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `cart_user` (`userid`),
  ADD KEY `cart_product` (`productsizeid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `productcolors`
--
ALTER TABLE `productcolors`
  ADD PRIMARY KEY (`productid`,`color`);

--
-- Indexes for table `productphotos`
--
ALTER TABLE `productphotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_color` (`productid`,`color`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `product_brand` (`brandid`),
  ADD KEY `product_category` (`categoryid`);

--
-- Indexes for table `productsizes`
--
ALTER TABLE `productsizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `size_color` (`productid`,`color`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_role` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `productphotos`
--
ALTER TABLE `productphotos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `productsizes`
--
ALTER TABLE `productsizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product` FOREIGN KEY (`productsizeid`) REFERENCES `productsizes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_user` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `productcolors`
--
ALTER TABLE `productcolors`
  ADD CONSTRAINT `productcolor_product` FOREIGN KEY (`productid`) REFERENCES `products` (`productid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `productphotos`
--
ALTER TABLE `productphotos`
  ADD CONSTRAINT `photo_color` FOREIGN KEY (`productid`,`color`) REFERENCES `productcolors` (`productid`, `color`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_brand` FOREIGN KEY (`brandid`) REFERENCES `brands` (`brandid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_category` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`categoryid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `productsizes`
--
ALTER TABLE `productsizes`
  ADD CONSTRAINT `size_color` FOREIGN KEY (`productid`,`color`) REFERENCES `productcolors` (`productid`, `color`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
