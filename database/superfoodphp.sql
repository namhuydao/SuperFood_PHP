-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 06, 2021 lúc 01:25 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `superfood`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link_news_tag`
--

CREATE TABLE `link_news_tag` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `link_news_tag`
--

INSERT INTO `link_news_tag` (`id`, `news_id`, `tag_id`) VALUES
(37, 15, 9),
(38, 15, 10),
(39, 15, 14),
(40, 16, 9),
(41, 16, 15),
(42, 16, 14),
(43, 16, 7),
(44, 3, 13),
(45, 3, 9),
(46, 3, 15),
(47, 3, 8),
(48, 4, 12),
(49, 4, 13),
(50, 4, 15),
(51, 4, 14),
(52, 4, 7),
(53, 4, 11),
(54, 5, 12),
(55, 5, 15),
(56, 5, 14),
(57, 5, 7),
(58, 5, 11),
(59, 14, 9),
(60, 14, 10),
(61, 14, 15),
(62, 14, 8),
(63, 14, 14),
(64, 6, 13),
(65, 6, 9),
(66, 6, 10),
(67, 6, 15),
(68, 6, 8),
(69, 13, 12),
(70, 13, 13),
(71, 13, 9),
(72, 13, 10),
(73, 13, 14),
(74, 13, 7),
(75, 13, 11),
(76, 11, 9),
(77, 11, 10),
(78, 11, 15),
(79, 11, 8),
(80, 11, 14),
(81, 11, 7),
(82, 10, 9),
(83, 10, 8),
(84, 10, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link_product_tag`
--

CREATE TABLE `link_product_tag` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `link_product_tag`
--

INSERT INTO `link_product_tag` (`id`, `product_id`, `tag_id`) VALUES
(1, 11, 2),
(3, 11, 3),
(4, 8, 2),
(5, 8, 1),
(6, 8, 3),
(7, 6, 1),
(9, 3, 2),
(10, 3, 4),
(13, 10, 1),
(14, 10, 4),
(15, 2, 3),
(16, 5, 2),
(17, 5, 4),
(18, 12, 3),
(19, 14, 2),
(20, 14, 1),
(21, 17, 6),
(22, 17, 3),
(23, 18, 6),
(24, 18, 1),
(25, 19, 1),
(26, 19, 3),
(27, 19, 4),
(28, 20, 2),
(29, 21, 6),
(30, 22, 3),
(31, 23, 6),
(32, 23, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link_role_permission`
--

CREATE TABLE `link_role_permission` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `link_role_permission`
--

INSERT INTO `link_role_permission` (`id`, `role_id`, `permission_id`) VALUES
(197, 1, 6),
(198, 1, 8),
(199, 1, 7),
(200, 1, 5),
(201, 1, 2),
(202, 1, 4),
(203, 1, 3),
(204, 1, 9),
(205, 2, 6),
(206, 2, 8),
(207, 2, 7),
(208, 2, 5),
(209, 2, 2),
(210, 2, 4),
(211, 2, 3),
(212, 2, 1),
(213, 2, 10),
(214, 2, 12),
(215, 2, 11),
(216, 2, 9),
(217, 2, 14),
(218, 2, 16),
(219, 2, 15),
(220, 2, 13),
(221, 15, 6),
(222, 15, 2),
(223, 15, 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `content`, `author`, `category_id`, `images`, `date`) VALUES
(3, 'qưdqwd  ds ssds q', 'qdwqwd', '<p>qưdqwdqw</p>\r\n', 'Huy', 4, '../../../../public/admin/assets/images/newsImages/6040ab03ee61b.jpg', '2021-01-30 12:32:58'),
(4, 'sadasd', 'qưdqw', '<p>qưeqweq</p>\r\n', 'Ád', 4, '../../../../public/admin/assets/images/newsImages/6040aafb027ae.jpg', '2021-01-30 12:42:26'),
(5, 'dqwq', 'qưdqwd', '<p>dqwdqdqw</p>\r\n', 'qưeqwe', 4, '../../../../public/admin/assets/images/newsImages/6040aaf43ae5d.jpg', '2021-01-30 12:48:21'),
(6, 'test', 'test testt', '<p>llsadascnanoeqcqefcqcbkbvybc,yxbajcasncqcnoicxc .s;SM</p>\r\n', 'sdncacaskc', 5, '../../../../public/admin/assets/images/newsImages/6040aaed9ddec.jpg', '2021-02-08 10:36:54'),
(10, 'ádasda', 'sdqwdqwd', '<p>&aacute;dasd<strong>&aacute;dasdaqw<em>&egrave;qefefe</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'sadasd', 4, '../../../../public/admin/assets/images/newsImages/6040aae71b57f.jpg', '2021-03-01 05:18:14'),
(11, 'đâs sca ae dứ', 'fewfefwe', '<h1>xin ch&agrave;o</h1>\r\n\r\n<p><strong><em>hưng hahaha</em></strong></p>\r\n', 'fefwfe', 4, '../../../../public/admin/assets/images/newsImages/6040aae041c62.jpg', '2021-03-01 05:19:37'),
(13, 'táo', 'ưqwqdqwdqw', '<p>hfdshsfdkjadsiucashlnshcslkdioqdkcdoiasldqoiads</p>\r\n', 'ádasdasd', 4, '../../../../public/admin/assets/images/newsImages/6040aad9394fe.jpg', '2021-03-03 14:18:50'),
(14, 'kkskkx', 'ad', '<p>hihihih xin ch&agrave;o sasscxycy</p>\r\n', 'kkaslsacxy', 8, '../../../../../superfood/public/admin/assets/images/newsImages/60409e73e1006.jpg', '2021-03-03 15:16:44'),
(15, 'ấdsdqw', 'qdwqwdqwd', '<p>fvwefsdgdsdvvcsfcycdas</p>\r\n', '3223423', 5, '../../../../../superfood/public/admin/assets/images/newsImages/60409e7b3db54.jpg', '2021-03-03 15:17:09'),
(16, 'fergfeffwdscsdfvf', 'dsgfdsgsdfsdf', '<p>ewfwdfsdfdsaf ừ ứd</p>\r\n', 'gg3gw', 6, '../../../../../superfood/public/admin/assets/images/newsImages/60409e828d237.jpg', '2021-03-03 15:17:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_categories`
--

CREATE TABLE `news_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `news_categories`
--

INSERT INTO `news_categories` (`id`, `name`, `parent_id`) VALUES
(4, 'Ngoài nước', 0),
(5, 'Thể thao', 0),
(6, 'Bóng đá', 5),
(7, 'Trong nước', 0),
(8, 'Thời sự', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_tags`
--

CREATE TABLE `news_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `news_tags`
--

INSERT INTO `news_tags` (`id`, `name`) VALUES
(7, 'Thời sự'),
(8, 'Thế giới'),
(9, 'Pháp luật'),
(10, 'Sức khỏe'),
(11, 'Đời sống'),
(12, 'Du lịch'),
(13, 'Khoa học'),
(14, 'Thể thao'),
(15, 'Tâm sự');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `code`, `name`) VALUES
(1, 'product_view', 'Xem sản phẩm'),
(2, 'product_add', 'Thêm sản phẩm'),
(3, 'product_edit', 'Sửa sản phẩm'),
(4, 'product_delete', 'Xóa sản phẩm'),
(5, 'post_view', 'Xem bài viết'),
(6, 'post_add', 'Thêm bài viết'),
(7, 'post_edit', 'Sửa bài viết'),
(8, 'post_delete', 'Xóa bài viết'),
(9, 'role_view', 'Xem quyền'),
(10, 'role_add', 'Thêm quyền'),
(11, 'role_edit', 'Sửa quyền'),
(12, 'role_delete', 'Xóa quyền'),
(13, 'user_view', 'Xem người dùng'),
(14, 'user_add', 'Thêm người dùng'),
(15, 'user_edit', 'Sửa người dùng'),
(16, 'user_delete', 'Xóa người dùng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `images` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `status`, `images`, `category_id`) VALUES
(3, 'fasas', 'đâsdasd', 400000, 0, '../../../../public/admin/assets/images/productImages/601d0922a8a77.jpg', 27),
(5, 'qưeqwe', 'ádasd', 11222, 1, '../../../../public/admin/assets/images/productImages/601d0ad4bc039.jpg', 25),
(6, 'dqw', 'qdasda', 323232323, 1, '../../../../public/admin/assets/images/productImages/601cff8ff3463.jpg', 27),
(8, 'ádasd', 'sadasd', 12213, 1, '../../../../public/admin/assets/images/productImages/601cffafd50f8.jpg', 27),
(10, 'ádqw', 'đưqqưd', 12312, 1, '../../../../public/admin/assets/images/productImages/601cffd68598d.jpg', 29),
(11, 'qưeqw', 'fqefqdsadasd', 12312, 1, '../../../../public/admin/assets/images/productImages/601cffef0524a.jpg', 29),
(12, 'ádasd', 'dqwdqwdq', 1231, 0, '../../../../public/admin/assets/images/productImages/601d002e1e5ef.jpg', 25),
(14, 'qưdqw', 'dqwdqw', 321, 0, '../../../../public/admin/assets/images/productImages/601d00409c371.jpg', 29),
(18, 'ssaycy', 'xycyxc', 21321, 0, '../../../../../webadmin/public/admin/assets/images/productImages/603ef9c319f9a.jpg', 25);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `parent_id`) VALUES
(24, 'a', 0),
(25, 'b', 24),
(26, 'c', 24),
(27, 'd', 25),
(28, 'e', 26),
(29, 'f', 27);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_tags`
--

CREATE TABLE `product_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_tags`
--

INSERT INTO `product_tags` (`id`, `name`) VALUES
(1, 'nổi bật'),
(2, 'mới'),
(3, 'phổ biến'),
(4, 'đẹp'),
(6, 'hihi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`) VALUES
(1, 'nv_nhap_lieu', 'Nhân viên nhập liệu'),
(2, 'quan_ly', 'Quản lý'),
(15, '', 'Ăn hại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `images`, `firstname`, `lastname`, `email`, `password`, `created_at`, `is_active`, `status`, `role_id`) VALUES
(18, '../../../../public/admin/assets/images/userImages/603cbb52836c9.jpg', 'Huy', 'Đào', 'namhuydao@tutamail.com', '164d5fdfd02634293161afac4cf47299', '2021-01-27 10:01:30', 1, 1, 2),
(22, '', 'ádasdasd', 'dưqdqwd', 'lackiluke@tutamail.com', '', '2021-03-01 16:40:40', 1, 1, 1),
(23, '', 'huy', 'ádasdasd', 'lackilu1ke@tutamail.com', '46e44aa0bc21d8a826d79344df38be4b', '2021-03-01 10:53:04', 1, 1, 15),
(24, '../../../../../webadmin/public/admin/assets/images/userImages/603f0a78c9eb2.jpg', 'Vũ', 'Hưng', 'vanvthy@gmail.com', '2b4110cde52d9be3748854a44e1105af', '2021-03-02 23:03:04', 1, 1, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `link_news_tag`
--
ALTER TABLE `link_news_tag`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `link_product_tag`
--
ALTER TABLE `link_product_tag`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `link_role_permission`
--
ALTER TABLE `link_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news_tags`
--
ALTER TABLE `news_tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `link_news_tag`
--
ALTER TABLE `link_news_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `link_product_tag`
--
ALTER TABLE `link_product_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `link_role_permission`
--
ALTER TABLE `link_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `news_tags`
--
ALTER TABLE `news_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
