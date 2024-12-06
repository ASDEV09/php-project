-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 06:27 PM
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
-- Database: `musicplayer`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `album_title` varchar(100) NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `album_cover_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_title`, `artist_id`, `release_date`, `album_cover_url`, `created_at`, `updated_at`) VALUES
(1, 'Jal Pari', 7, '2024-07-06', 'album/Jal_Pari_Atif_aslam_cover.jpg', '2024-06-20 14:46:25', '2024-07-08 09:11:43'),
(2, 'Gully Boy', 2, '2023-02-01', 'album/Gully_Boy.jpg', '2024-06-20 14:46:25', '2024-07-08 09:35:07'),
(9, '\'X\' Multiply', 6, '0000-00-00', 'album/x.jpg', '2024-07-08 09:46:59', '2024-07-08 09:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `picture_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `artist_name`, `description`, `picture_url`, `created_at`, `updated_at`) VALUES
(1, 'Arijit Singh', 'Arijit Singh, born on April 25, 1987, in West Bengal, is a renowned Indian playback singer known for his soulful and emotive voice. Coming from a musical family, he gained widespread recognition with thesahit', 'artist/arijit_singh.jpg', '2024-06-20 14:46:25', '2024-07-05 21:06:37'),
(2, 'Atif Aslam', 'Atif Aslam is a renowned Pakistani playback singer and actor who has gained international fame for his soulful voice and versatile singing style. Known for hit songs like \"Tera Hone Laga Hoon,\" \"Jeene Laga Hoon,\" and \"Tajdar-e-Haram,\" Atif has a massive fan following across South Asia and beyond. His melodious voice and ability to convey emotions through his music have made him a beloved figure in the music industry.', 'artist/Atif_Aslam.jpg', '2024-06-20 14:46:25', '2024-07-08 08:54:49'),
(3, 'Talha Anjum', 'Talha Anjum is a prominent Pakistani rapper and lyricist, renowned for his distinctive style and thought-provoking lyrics. His music resonates with a blend of urban culture and social commentary, making him a standout figure in the Pakistani music scene.', 'artist/talha_anjum.jpg', '2024-06-20 21:31:52', '2024-07-06 11:22:45'),
(4, 'alan walker', 'Alan Walker is a Norwegian DJ and record producer known for his distinctive style of electronic music characterized by melodic and catchy tunes. Rising to fame with his hit single \"Faded,\" he has continued to produce music that blends elements of EDM with cinematic soundscapes. Walker is recognized for his signature hoodie and mask, which add to his mysterious persona in the music industry.', 'artist/alan_walker.jpg', '2024-07-04 11:06:25', '2024-07-08 08:55:36'),
(5, 'Shubh', 'Shubh Mangal is an energetic and talented music producer and composer known for his innovative beats and melodic compositions. With a passion for blending diverse musical influences, he creates vibrant and memorable soundscapes.', 'artist/shubh.jpg', '2024-06-23 12:51:03', '2024-06-23 15:17:46'),
(6, 'Sidhu Moose Wala', 'Sidhu Moose Wala is a popular Punjabi singer known for his impactful lyrics and bold style. Rising to fame with songs like \"So High\" and \"Issa Jatt,\" he addresses social issues and Punjabi culture. He\'s also ventured into acting, making a mark in both music and film.\r\n', 'artist/Sidhu.jpg', '2024-06-23 13:03:53', '2024-07-08 08:53:55'),
(7, 'Ali Zafar', 'Ali Zafar is a versatile Pakistani singer-songwriter and actor known for his soulful voice and impactful performances. With a diverse career spanning music and film, he has gained acclaim for his contributions to both industries.', 'artist/ali_zafar.jpg', '2024-06-23 15:09:22', '2024-06-23 15:09:22'),
(8, 'Neha Kakkar', 'Neha Kakkar is a celebrated Indian playback singer known for her vibrant voice and energetic performances. With numerous hit songs across Bollywood and independent music, she has garnered immense popularity for her melodious and versatile singing style.', 'artist/neha_kakkar.jpg', '2024-06-23 15:02:16', '2024-06-23 15:02:16'),
(10, 'Talhah Yunus', 'Talhah Yunus is a prominent Pakistani rapper known for his distinctive lyrical style and contributions to the local hip-hop scene. His music often addresses social issues and personal experiences, showcasing his talent for storytelling and wordplay. Talhah Yunus has established himself as a respected figure in Pakistani music through his impactful lyrics and unique approach to rap.', 'artist/talha_yunus.jpg', '2024-06-20 21:36:38', '2024-07-08 08:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(50) NOT NULL,
  `genre_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`, `genre_pic`) VALUES
(1, 'Romantic', 'all_song/genrepic/romantic.jpg'),
(2, 'Punjabi', 'all_song/genrepic/punjabi.jpg'),
(3, 'Pop', 'all_song/genrepic/pop.jpg'),
(4, 'Rap', 'all_song/genrepic/rap.jpg'),
(19, 'Romanti', 'all_song/genrepic/romantic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `language` enum('Regional','English') NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `new_flag` tinyint(1) DEFAULT 0,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(11) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `plays_count` int(11) NOT NULL DEFAULT 0,
  `pic_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `title`, `type`, `artist_id`, `album_id`, `year`, `genre_id`, `language`, `file_path`, `description`, `new_flag`, `added_date`, `admin_id`, `duration`, `plays_count`, `pic_url`) VALUES
(1, 'Ve Kamleye', 'Music', 1, NULL, 2024, 2, 'Regional', 'all_song/Arijit_Singh/VE_KAMLEYA.mp3', '', 0, '2024-06-24 10:51:31', 1, '4:16', 0, 'all_song/Arijit_Singh/vekamleya.jpg'),
(2, 'Sooraj Dooba Ha', 'Music', 1, NULL, 2023, 3, 'English', 'all_song/Arijit_Singh/Sooraj_Dooba_Hain.mp3', 'Descriptionasdasdasdasdasd of Song Two', 0, '2024-06-20 14:46:25', 1, '4:07', 0, 'all_song/Arijit_Singh/sooraj.jpg'),
(3, 'Tum Hi ho', 'Music', 1, NULL, 2023, 1, 'Regional', 'all_song/Arijit_Singh/_Tum_Hi_Ho__Aashiqui_2.mp3', 'Description of Video One', 1, '2024-06-20 14:46:25', 1, '4:27', 0, 'all_song/Arijit_Singh/tum hi ho.jpg'),
(6, 'Afsanay', 'Music', 3, NULL, 2023, 4, 'Regional', 'all_song/talha_anjum/Afsanay(0).mp3', 'sddsdxzx', 0, '2024-06-21 12:08:29', 1, '5:45', 0, 'all_song/talha_anjum/Afsanay(0).jpg'),
(7, 'Balli_Aur_Mein', 'Music', 3, NULL, 2023, 4, 'Regional', 'all_song/talha_anjum/Balli_Aur_Mein.mp3', '', 0, '2024-06-21 12:12:18', 1, '4:17', 0, 'all_song/talha_anjum/Balli_Aur_Mein.jpg'),
(8, 'Desperation', 'Music', 3, NULL, 1023, 4, 'Regional', 'all_song/talha_anjum/Desperation(0).mp3', 'asdasd', 0, '2024-06-21 12:15:30', 1, '3', 0, 'all_song/talha_anjum/Desperation(0).jpg'),
(9, 'Ik_Vaari_Aa', 'Music', 1, NULL, 0, 1, 'Regional', 'all_song/Arijit_Singh/Ik_Vaari_Aa.mp3', '', 0, '2024-06-21 15:33:14', 1, '2:39', 0, 'all_song/Arijit_Singh/Ik Vaari aa.jpg'),
(10, 'Janam Janam', 'Music', 1, NULL, 2023, 1, 'Regional', ' all_song/Arijit_singh/Janam_Janam.mp3', '', 0, '2024-06-22 08:27:42', 1, '3:08', 0, 'all_song/Arijit_Singh/janam janam.jpg'),
(11, 'Jo Bheji Thi Duaa', 'Music', 1, NULL, 2023, 1, 'Regional', 'all_song/Arijit_Singh/Jo_Bheji_Thi_Duaa_Shanghai.mp3', '', 0, '2024-06-22 08:29:19', 1, '2:58', 0, 'all_song/Arijit_Singh/jo bheji.jpg'),
(12, 'Khamoshiyan', 'Music', 1, NULL, 0, 1, 'Regional', 'all_song/Arijit_Singh/Khamoshiyan.mp3', '', 0, '2024-06-22 08:38:14', 1, '2:39', 0, 'all_song/Arijit_Singh/khamoshiya.jpg'),
(14, 'Phir Bhi Tumko Chaahunga', 'Music', 1, NULL, 0, 1, 'Regional', 'all_song/Arijit_Singh/Phir_Bhi_Tumko_Chaahunga.mp3', '', 0, '2024-06-22 08:45:14', 1, '2:56', 0, 'all_song/Arijit_Singh/Phir Bhi Tumko Chaahunga.jpg'),
(15, 'Jaan Nisaar', 'Music', 1, NULL, 0, 1, 'Regional', 'all_song/Arijit_Singh/Jaan_Nisaar.mp3', '', 0, '2024-06-22 08:58:43', 1, '4:08', 0, 'all_song/Arijit_Singh/jaannisaar.jpg'),
(16, 'Heeriye', 'Music', 1, NULL, 0, 2, 'Regional', 'all_song/Arijit_Singh/heeriye.mp3', '', 0, '2024-06-22 09:12:36', 1, '3:18', 0, 'all_song/Arijit_Singh/heeriye.jpg'),
(17, 'O Maahi', 'Music', 1, NULL, 0, 1, 'Regional', 'all_song/Arijit_Singh/O_Maahi.mp3', '', 0, '2024-06-22 09:17:26', 1, '3:53', 0, 'all_song/Arijit_Singh/mahii.jpg'),
(18, 'O Sajni Re', 'Music', 1, NULL, 0, 1, 'Regional', 'all_song/Arijit_Singh/O_Sajni_Re.mp3', '', 0, '2024-06-22 11:15:11', 1, '2:48', 0, 'all_song/Arijit_Singh/sajni.jpg'),
(3222, 'Ali Zafar Pehli Si Muhabbat', 'Video', 7, NULL, NULL, 2, 'English', 'all_song/videosong/Ali_Zafar___Pehli_Si_Muhabbat.mp4', '', 0, '2024-06-27 18:53:08', 1, '2:53', 0, 'artist/ali_zafar.jpg'),
(3223, 'Chal Dil Mere', 'Video', 7, NULL, NULL, 3, 'Regional', 'all_song/videosong/Chal_Dil_Mere.mp4', '', 0, '2024-06-27 18:57:04', 1, '3:40', 0, 'artist/ali_zafar.jpg'),
(3224, '4AM In Karachi', 'Music', 3, NULL, 0, 4, 'Regional', ' all_song/talha_anjum/4AM_in_Karachi(0).mp3', '', 0, '2024-07-02 11:21:25', 1, '3:28', 0, ' all_song/talha_anjum/4AM_in_Karachi.jpg'),
(3236, 'Downers At Dusk', 'Music', 3, NULL, 0, 4, 'Regional', 'all_song/talha_anjum/Downers_At_Dusk.mp3', '', 0, '2024-07-02 12:03:28', 1, '4:16', 0, 'all_song/talha_anjum/Downers_At_Dusk.jpg'),
(3237, 'Dekhte Dekhte', 'Video', 2, NULL, 2024, 1, 'Regional', 'all_song/videosong/Dekhte_Dekhte.mp4', '', 0, '2024-07-03 16:12:49', 1, '4:20', 0, 'all_song/talha_anjum/Downers_At_Dusk.'),
(3239, 'Laila O Laila Ali Zafar', 'Video', 7, NULL, 2023, 2, 'Regional', 'all_song/videosong/Laila_O_Laila_-_Ali_Zafar_ft_Urooj_Fatima___Lightingale_Productions(720p).mp4', '', 0, '2024-07-03 16:22:17', 1, '2', 0, 'asas'),
(3252, 'Apna Time Aayega', 'Music', NULL, 2, 2019, 4, 'Regional', 'all_song/gully boy/Apna Time Aayega.mp3', '', 0, '2024-07-11 14:52:20', 1, '2', 0, 'all_song/gully boy/Apna Time Aayega.jpg'),
(3253, 'Azadi - Gully Boy', 'Music', NULL, 2, 2019, 4, 'Regional', 'all_song/gully boy/Azadi - Gully Boy.mp3', '', 0, '2024-07-11 14:59:00', 1, '2', 0, 'all_song/gully boy/Azadi - Gully Boy.jpg'),
(3254, 'Doori  Gully Boy', 'Music', NULL, 2, 2019, 4, 'Regional', 'all_song/gully boy/Doori  Gully Boy.mp3', '', 0, '2024-07-11 15:30:04', 1, '2', 0, 'all_song/gully boy/Doori  Gully Boy.jpg'),
(3255, 'Mere Gully Mein', 'Music', NULL, 2, 2019, 4, 'Regional', 'all_song/gully boy/Mere Gully Mein.mp3', '', 0, '2024-07-11 15:52:48', 1, '2', 0, 'all_song/gully boy/Mere Gully Mein.jpg'),
(3256, 'Train Gully Boy', 'Music', NULL, 2, 2019, 4, 'Regional', 'all_song/gully boy/Train Gully Boy.mp3', '', 0, '2024-07-11 16:00:23', 1, '2', 0, 'all_song/gully boy/Train Gully Boy.jpg'),
(3257, 'Ehsaas', 'Music', 2, 1, 2012, NULL, 'Regional', 'all_song/jal pari/Ehsaas.mp3', '', 0, '2024-07-11 16:23:03', NULL, '3:44', 0, 'all_song/jal pari/Ehsaas.jpg'),
(3258, 'Bheegi Yaadein(Woh Lamhey)', 'Music', 2, 1, 2012, NULL, 'Regional', 'all_song/jal pari/Bheegi Yaadein(Woh Lamhey).mp3', '', 0, '2024-07-11 16:29:47', NULL, '4:07', 0, 'all_song/jal pari/Bheegi Yaadein(Woh Lamhey).jpg'),
(3259, 'Ankhon Se(Dil Harey)', 'Music', 2, 1, 2012, NULL, 'Regional', 'all_song/jal pari/Ankhon Se(Dil Harey).mp3', '', 0, '2024-07-11 16:29:47', NULL, '4:26', 0, 'all_song/jal pari/Ankhon Se(Dil Harey).jpg'),
(3260, 'Ab To Adat Si', 'Music', 2, 1, 2012, NULL, 'Regional', 'all_song/jal pari/Ab To Adat Si.mp3', '', 0, '2024-07-11 16:29:47', NULL, '4:24', 0, 'all_song/jal pari/Ab To Adat Si.jpg'),
(3262, 'Pehli Si Muhabbat', 'Music', 7, NULL, 2021, NULL, 'Regional', 'all_song/Ali_Zafar/Pehli_Si_Muhabbat.mp3', '', 0, '2024-07-11 16:58:00', NULL, '2:53', 0, 'all_song/Ali_Zafar/Pehli_Si_Muhabbat.jpg'),
(3263, 'Larsha Pekhawar', 'Music', 7, NULL, 2021, NULL, 'Regional', 'all_song/Ali_Zafar/Larsha_Pekhawar.mp3', '', 0, '2024-07-11 16:58:00', NULL, '4:40', 0, 'all_song/Ali_Zafar/Larsha_Pekhawar.jpg'),
(3264, 'Laila O Laila', 'Music', 7, NULL, 2019, NULL, 'Regional', 'all_song/Ali_Zafar/Laila_O_Laila.mp3', '', 0, '2024-07-11 16:58:00', NULL, '2:53', 0, 'all_song/Ali_Zafar/Laila_O_Laila.jpg'),
(3265, 'BALO BATIYAN', 'Music', 7, NULL, 2024, NULL, 'Regional', 'all_song/Ali_Zafar/BALO_BATIYAN.mp3', '', 0, '2024-07-11 16:58:00', NULL, '4:10', 0, 'all_song/Ali_Zafar/BALO_BATIYAN.jpg'),
(3266, 'Allay Munja Mar Wara', 'Music', 7, NULL, 2020, NULL, 'Regional', 'all_song/Ali_Zafar/Allay__Munja_Mar_Wara.mp3', '', 0, '2024-07-11 16:58:00', NULL, '3:20', 0, 'all_song/Ali_Zafar/Allay__Munja_Mar_Wara.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `user_id`, `media_id`, `added_at`) VALUES
(10, 38, 2, '2024-07-08 13:07:26'),
(11, 38, 16, '2024-07-08 13:16:39'),
(15, 26, 17, '2024-07-10 21:36:43'),
(16, 26, 1, '2024-07-11 11:56:39'),
(17, 26, 7, '2024-07-11 11:56:53'),
(18, 26, 6, '2024-07-11 11:56:54'),
(19, 26, 3252, '2024-07-11 15:07:36'),
(20, 26, 3253, '2024-07-11 15:48:19'),
(21, 26, 3257, '2024-07-11 17:42:40'),
(22, 26, 3, '2024-07-11 17:43:58'),
(24, 106, 1, '2024-07-11 17:46:37'),
(25, 106, 2, '2024-07-11 17:47:30'),
(27, 26, 3258, '2024-07-11 18:14:10'),
(28, 109, 3, '2024-07-11 18:21:59'),
(29, 109, 3252, '2024-07-11 18:23:24'),
(30, 113, 10, '2024-07-11 18:28:25'),
(31, 113, 3262, '2024-07-11 18:29:38'),
(32, 113, 3263, '2024-07-11 18:29:56'),
(33, 113, 1, '2024-07-11 18:30:30'),
(35, 113, 2, '2024-07-11 18:33:27'),
(36, 113, 9, '2024-07-11 18:33:56'),
(37, 113, 3257, '2024-07-11 18:34:15'),
(38, 113, 3259, '2024-07-11 18:44:27'),
(41, 115, 3, '2024-07-11 18:58:01'),
(43, 115, 2, '2024-07-11 18:59:48'),
(44, 90, 3260, '2024-07-12 10:32:10'),
(45, 26, 2, '2024-07-25 09:08:44'),
(46, 26, 3259, '2024-07-25 09:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `media_id`, `rating`, `review_text`, `review_date`) VALUES
(93, 38, 6, 5, 'test', '2024-06-29 19:00:05'),
(94, 38, 10, 5, 'aasd', '2024-06-29 19:04:27'),
(96, 26, 16, 4, 'sd', '2024-06-30 10:07:20'),
(113, 26, 12, 5, 'I like this song', '2024-06-30 19:53:52'),
(114, 26, 7, 2, 'sasas', '2024-06-30 19:54:18'),
(185, 26, 11, 2, 'asas', '2024-07-01 09:44:06'),
(194, 26, 6, 3, 'ass', '2024-07-01 11:20:55'),
(205, 26, 9, 5, 'this somg\r\n', '2024-07-01 11:49:08'),
(215, 90, 1, 2, 'as', '2024-07-03 14:57:10'),
(216, 90, 2, 2, 's', '2024-07-03 14:57:30'),
(224, 90, 9, 3, 'asas', '2024-07-03 15:37:17'),
(225, 90, 10, 3, 'asa', '2024-07-03 15:38:45'),
(226, 90, 11, 2, 'asasas', '2024-07-03 15:40:08'),
(227, 90, 12, 3, 'asas', '2024-07-03 15:41:35'),
(228, 90, 15, 2, 'aasqs', '2024-07-03 15:43:00'),
(229, 90, 16, 3, 'as', '2024-07-03 15:44:00'),
(230, 90, 14, 2, 'asasasa', '2024-07-03 15:44:51'),
(233, 90, NULL, NULL, NULL, '2024-07-05 19:46:04'),
(234, 90, NULL, NULL, NULL, '2024-07-05 19:46:04'),
(235, 90, NULL, NULL, NULL, '2024-07-05 19:46:06'),
(236, 90, NULL, NULL, NULL, '2024-07-05 19:46:06'),
(237, 90, NULL, NULL, NULL, '2024-07-05 19:46:07'),
(238, 90, NULL, NULL, NULL, '2024-07-05 19:46:07'),
(239, 90, NULL, NULL, NULL, '2024-07-05 19:46:29'),
(240, 90, NULL, NULL, NULL, '2024-07-05 19:46:29'),
(241, 38, 1, NULL, NULL, '2024-07-08 12:59:31'),
(242, 38, 11, NULL, NULL, '2024-07-08 12:59:33'),
(243, 38, 2, NULL, NULL, '2024-07-08 13:03:15'),
(244, 26, 3236, NULL, NULL, '2024-07-10 21:36:41'),
(245, 26, 17, NULL, NULL, '2024-07-10 21:36:43'),
(246, 26, 3252, NULL, NULL, '2024-07-11 15:07:36'),
(247, 26, 3253, NULL, NULL, '2024-07-11 15:48:19'),
(251, 26, 3258, 2, 'ds', '2024-07-11 18:14:10'),
(252, 109, 3, NULL, NULL, '2024-07-11 18:21:59'),
(253, 109, 3252, 4, 'love this song\r\n', '2024-07-11 18:23:24'),
(254, 113, 10, NULL, NULL, '2024-07-11 18:28:25'),
(255, 113, 3, 3, 'sd', '2024-07-11 18:31:36'),
(256, 113, 3257, 4, 'as', '2024-07-11 18:34:15'),
(257, 113, 3259, 2, 'AS', '2024-07-11 18:44:27'),
(259, 115, 2, NULL, NULL, '2024-07-11 18:59:48'),
(260, 90, 3260, 3, 'as\r\n', '2024-07-12 10:32:10'),
(264, 26, 3257, 3, 'fghfgh\r\n', '2024-07-25 09:39:32'),
(267, 26, 2, 5, 'nb\r\n', '2024-07-25 09:43:15'),
(268, 26, 3, 4, 'jgjh\r\n', '2024-07-25 09:46:55'),
(269, 26, 3259, NULL, NULL, '2024-07-25 09:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('Administrator','User') NOT NULL DEFAULT 'User',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `role`, `registration_date`, `last_login_date`, `email`) VALUES
(1, 'admin', 'password123', 'Administrator', '2024-06-20 14:46:25', '2024-07-07 19:17:03', 'junaid@gmail.com'),
(26, 'ayan', '$2y$10$vPTHl6Lq43/eYNZaDgLOyO03GPIVgWtTqaEj4vRgMeoBTQMyq0oKa', 'Administrator', '2024-06-29 09:40:42', '2024-07-04 20:00:22', 'muhammadayan670@gmail.com'),
(38, 'test', '$2y$10$81sS47jxOzWf/ITMnetmBu4ql8YWyiyHNpCfp3EoP4.SzQwZEOTNu', 'User', '2024-06-29 11:13:51', '2024-07-08 12:58:50', 'muhammadayan@gmail.com'),
(90, 'ayan', '$2y$10$sbFg83Q4GuAInw4YBa.WzukNmTwpmmAP0vcxJqQ1NVQHq3jxgrFMy', 'User', '2024-07-02 09:24:30', '2024-07-08 12:08:48', 'muhammadayan6700@gmail.com'),
(106, 'ebad', '$2y$10$bztfp5N22b3fcV3svMf8PeYCOww0prOjKZVXp/Lf23uDyaevTdYIm', 'User', '2024-07-11 17:46:12', '2024-07-11 17:46:12', 'ebad@gmail.com'),
(109, 'ebad', '$2y$10$tjrssyK.gcABZ9MLxjXGxe7sNtRRhNsX0b4MSZvNFk5ObOTZfzjzq', 'User', '2024-07-11 18:21:04', '2024-07-11 18:21:04', 'ebad12@gmail.com'),
(113, 'junaid', '$2y$10$RcNrJgi0nA2.1vjxixYeuuYajiZWhT1rJXAy3w7U8bsbZSTKq/CDm', 'User', '2024-07-11 18:27:00', '2024-07-11 18:27:00', 'junaid12@gmail.com'),
(115, 'hammad', '$2y$10$3.OuHhu/w.N8nXISHRieyeZi.fD1yxdX4e.byrTg1JXj.70o760bq', 'User', '2024-07-11 18:55:58', '2024-07-11 18:55:58', 'hammad@gmail.com'),
(116, 'ayan', '$2y$10$9m4/9s0IIsr9i6kCp0pYEu0APnWZI/l..hmJUu2Mti/fFQDYz..UW', 'User', '2024-07-11 19:01:02', '2024-07-11 19:01:02', 'ayan@gmail.com'),
(117, 'ayan', '$2y$10$/2QmvSJg9iMuD6z4f851DO/yvk7e0J1iJnep.esym70LloyUMfQT.', 'User', '2024-12-06 17:23:54', '2024-12-06 17:23:54', 'test@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_reviews_media_id` (`media_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3269;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`),
  ADD CONSTRAINT `media_ibfk_3` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`),
  ADD CONSTRAINT `media_ibfk_4` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `playlists_ibfk_2` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
