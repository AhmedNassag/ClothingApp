-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2024 at 03:59 PM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u939534869_clothingapp`
--

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
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `file_size` varchar(255) NOT NULL,
  `file_sort` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `mediable_id` bigint(20) UNSIGNED NOT NULL,
  `mediable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_path`, `file_type`, `file_size`, `file_sort`, `mediable_id`, `mediable_type`, `created_at`, `updated_at`) VALUES
(4, '1704200722.FB_IMG_1704107946449[1].jpg', 'https://clothingapp.fashionmar.com/public/attachments/user/1704200722.FB_IMG_1704107946449[1].jpg', 'image/jpeg', '77461', 1, 1, 'App\\Models\\User', '2024-01-02 13:05:22', '2024-01-02 13:05:22'),
(5, 'user_avatar.jpg', 'https://clothingapp.fashionmar.com/public/attachments/user/user_avatar.jpg', 'image/jpg', '1670', 1, 15, 'App\\Models\\User', '2024-01-03 07:47:31', '2024-01-03 07:47:31'),
(6, 'user_avatar.jpg', 'https://clothingapp.fashionmar.com/public/attachments/user/user_avatar.jpg', 'image/jpg', '1670', 1, 16, 'App\\Models\\User', '2024-01-03 08:16:15', '2024-01-03 08:16:15'),
(7, 'user_avatar.jpg', 'https://clothingapp.fashionmar.com/public/attachments/user/user_avatar.jpg', 'image/jpg', '1670', 1, 17, 'App\\Models\\User', '2024-01-04 05:09:44', '2024-01-04 05:09:44'),
(8, 'user_avatar.jpg', 'https://clothingapp.fashionmar.com/public/attachments/user/user_avatar.jpg', 'image/jpg', '1670', 1, 18, 'App\\Models\\User', '2024-01-04 14:22:09', '2024-01-04 14:22:09'),
(9, '17046564320.WhatsApp Image 2022-12-20 at 4.54.17 PM.jpeg', 'https://clothingapp.fashionmar.com/public/attachments/post/17046564320.WhatsApp Image 2022-12-20 at 4.54.17 PM.jpeg', 'image/jpeg', '58053', 0, 3, 'App\\Models\\Post', '2024-01-07 19:40:32', '2024-01-07 19:40:32'),
(10, '17047200580.309562163_201154352291597_6531646514343460420_n.jpg', 'https://clothingapp.fashionmar.com/public/attachments/post/17047200580.309562163_201154352291597_6531646514343460420_n.jpg', 'image/jpeg', '333787', 0, 5, 'App\\Models\\Post', '2024-01-08 13:20:58', '2024-01-08 13:20:58'),
(11, '17047200581.318407580_213188307754868_6245310990910438712_n.jpg', 'https://clothingapp.fashionmar.com/public/attachments/post/17047200581.318407580_213188307754868_6245310990910438712_n.jpg', 'image/jpeg', '177938', 1, 5, 'App\\Models\\Post', '2024-01-08 13:20:58', '2024-01-08 13:20:58'),
(12, 'user_avatar.jpg', 'https://clothingapp.fashionmar.com/public/attachments/user/user_avatar.jpg', 'image/jpg', '1670', 1, 19, 'App\\Models\\User', '2024-01-09 14:46:00', '2024-01-09 14:46:00');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_12_06_000000_create_users_table', 1),
(3, '2023_12_06_100000_create_password_resets_table', 1),
(4, '2023_12_07_000000_create_failed_jobs_table', 1),
(5, '2023_12_07_191449_create_posts_table', 1),
(6, '2023_12_07_211556_create_post_comments_table', 1),
(7, '2023_12_07_211628_create_post_likes_table', 1),
(8, '2023_12_09_102127_create_media_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'post content', 1, '2024-01-02 14:53:08', NULL),
(5, 'post content with upload files', 1, '2024-01-08 13:20:58', '2024-01-08 13:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `content`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'comment content', 2, 1, '2024-01-02 14:53:38', NULL),
(8, 'test comment', 2, 19, '2024-01-09 14:51:14', '2024-01-09 14:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_like` tinyint(1) DEFAULT 0 COMMENT '[''0''=>''dislike'', ''1''=>''like'']',
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `is_like`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2024-01-02 15:00:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(225) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `phone`, `bio`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ahmednassag', 'ahmednassag@gmail.com', NULL, '$2y$10$nVEfnGZS.KKjPUYMRgV5sekkBo03eZY1SI7DqQ10QRlHtKwzyUp4G', '01016856433', NULL, NULL, '2023-12-10 06:30:51', '2024-01-02 13:05:22'),
(16, 'user bio', 'bio@user.com', NULL, '$2y$10$.nHmvfnBW60PyhKHcwzC2uQYQQIBfrfN77MzsmSdzcfdFvhirSfZO', '01666666666', 'bio content', NULL, '2024-01-03 08:16:15', '2024-01-03 08:16:15'),
(17, 'Mohamed', 'midoelhram@gmail.com', NULL, '$2y$10$DtJ4qWuohM5rImo5keD5JuYO9CG17h0TzitNMTVFniiXGW0L2U1qi', '01120886487', NULL, NULL, '2024-01-04 05:09:44', '2024-01-04 05:09:44'),
(19, 'Mohamed Fares', 'mido@gmail.com', NULL, '$2y$10$3cw6TtQoZ8IAaqKcuROto.2CLtJga2i.K/SkygsGWfN4DxUZW/ygm', '01127502002', NULL, NULL, '2024-01-09 14:46:00', '2024-01-09 14:46:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_likes_post_id_foreign` (`post_id`),
  ADD KEY `post_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
