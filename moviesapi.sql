-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2020 m. Geg 18 d. 04:30
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviesapi`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `apis`
--

CREATE TABLE `apis` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `apis`
--

INSERT INTO `apis` (`id`, `name`, `api_key`) VALUES
(1, 'Tmdb', '15c36cbe9b5589d67b3b6d722c34cddc');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `api_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `genres`
--

INSERT INTO `genres` (`id`, `api_id`, `name`, `genre_id`) VALUES
(1, 1, 'Action', 28),
(2, 1, 'Adventure', 12),
(3, 1, 'Animation', 16),
(4, 1, 'Comedy', 35),
(5, 1, 'Crime', 80),
(6, 1, 'Documentary', 99),
(7, 1, 'Drama', 18),
(8, 1, 'Family', 10751),
(9, 1, 'Fantasy', 14),
(10, 1, 'History', 36),
(11, 1, 'Horror', 27),
(12, 1, 'Music', 10402),
(13, 1, 'Mystery', 9648),
(14, 1, 'Romance', 10749),
(15, 1, 'Science Fiction', 878),
(16, 1, 'TV Movie', 10770),
(17, 1, 'Thriller', 53),
(18, 1, 'War', 10752),
(19, 1, 'Western', 37);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int(11) DEFAULT NULL,
  `shared_api_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `post_date`, `parent_id`, `shared_api_id`, `movie_id`) VALUES
(3, 7, 'Pirmoji žinutė', '2020-04-13 15:06:26', NULL, NULL, 0),
(4, 5, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, provident et. Minima, quisquam. Est nemo dicta natus laboriosam id, soluta aliquid non. Modi illo odit vel perferendis recusandae molestiae. Aut! Lorem ipsum dolor sit amet consectetur, adipisicing elit. In dolore libero non iste temporibus natus dicta iusto itaque! Asperiores soluta repellendus nisi ducimus, in molestiae unde qui obcaecati possimus et. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, eaque ipsum voluptate fuga similique ab harum animi repellat a cumque voluptates exercitationem quos quasi omnis excepturi officia. Eligendi, dolore sit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam asperiores ullam eaque fugit deserunt repellat porro cumque. Optio eius necessitatibus alias odio laudantium, ab itaque provident doloribus tempora fuga. Aliquid! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et quasi similique neque, sapiente quaerat tempore omnis, facere, ab labore dicta repudiandae optio ipsa distinctio repellat minima facilis aliquam? Assumenda, accusamusLorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, provident et. Minima, quisquam. Est nemo dicta natus laboriosam id, soluta aliquid non. Modi illo odit vel perferendis recusandae molestiae. Aut! Lorem ipsum dolor sit amet consectetur, adipisicing elit. In dolore libero non iste temporibus natus dicta iusto itaque! Asperiores soluta repellendus nisi ducimus, in molestiae unde qui obcaecati possimus et. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, eaque ipsum voluptate fuga similique ab harum animi repellat a cumque voluptates exercitationem quos quasi omnis excepturi officia. Eligendi, dolore sit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam asperiores ullam eaque fugit deserunt repellat porro cumque. Optio eius necessitatibus alias odio laudantium, ab itaque provident doloribus tempora fuga. Aliquid! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et quasi similique neque, sapiente quaerat tempore omnis, facere, ab labore dicta repudiandae optio ipsa distinctio repellat minima facilis aliquam? Assumenda, accusamus', '2020-04-13 15:06:50', NULL, NULL, 0),
(5, 6, 'Pirmoji žinutė 3', '2020-04-13 15:06:58', NULL, NULL, 0),
(6, 5, 'Begemotas 4', '2020-04-13 15:07:05', NULL, NULL, 0),
(7, 5, 'I am indeed a bird', '2020-04-13 21:07:53', NULL, NULL, 0),
(8, 6, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, provident et. Minima, quisquam. Est nemo dicta natus laboriosam id, soluta aliquid non. Modi illo odit vel perferendis recusandae molestiae. Aut! Lorem ipsum dolor sit amet consectetur, adipisicing elit. In dolore libero non iste temporibus natus dicta iusto itaque! Asperiores soluta repellendus nisi ducimus, in molestiae unde qui obcaecati possimus et. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, eaque ipsum voluptate fuga similique ab harum animi repellat a cumque voluptates exercitationem quos quasi omnis excepturi officia. Eligendi, dolore sit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam asperiores ullam eaque fugit deserunt repellat porro cumque. Optio eius necessitatibus alias odio laudantium, ab itaque provident doloribus tempora fuga. Aliquid! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et quasi similique neque, sapiente quaerat tempore omnis, facere, ab labore dicta repudiandae optio ipsa distinctio repellat minima facilis aliquam? Assumenda, accusamusLorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, provident et. Minima, quisquam. Est nemo dicta natus laboriosam id, soluta aliquid non. Modi illo odit vel perferendis recusandae molestiae. Aut! Lorem ipsum dolor sit amet consectetur, adipisicing elit. In dolore libero non iste temporibus natus dicta iusto itaque! Asperiores soluta repellendus nisi ducimus, in molestiae unde qui obcaecati possimus et. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, eaque ipsum voluptate fuga similique ab harum animi repellat a cumque voluptates exercitationem quos quasi omnis excepturi officia. Eligendi, dolore sit? Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam asperiores ullam eaque fugit deserunt repellat porro cumque. Optio eius necessitatibus alias odio laudantium, ab itaque provident doloribus tempora fuga. Aliquid! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et quasi similique neque, sapiente quaerat tempore omnis, facere, ab labore dicta repudiandae optio ipsa distinctio repellat minima facilis aliquam? Assumenda, accusamus', '2020-04-13 21:50:50', NULL, NULL, 0),
(9, 5, 'Hello, WE COME WITH PEACE', '2020-04-13 21:53:50', NULL, NULL, 0),
(10, 7, 'First message', '2020-04-13 21:55:50', NULL, NULL, 0),
(11, 6, 'Second message', '2020-04-13 21:54:50', NULL, NULL, 0),
(12, 5, 'Test Message', '2020-04-13 21:56:50', NULL, NULL, 0),
(13, 5, 'I am a test', '2020-04-13 21:57:59', NULL, NULL, 0),
(17, 5, 'Žinutės tekstas', '2020-04-13 22:03:14', NULL, NULL, 0),
(18, 5, 'Parodomoji žinutė', '2020-04-13 22:05:20', NULL, NULL, 0),
(19, 5, 'Žinutės bandymas', '2020-04-13 22:08:59', NULL, NULL, 0),
(20, 5, 'Žinutė', '2020-04-13 22:09:36', NULL, NULL, 0),
(22, 9, 'Bandymas', '2020-04-13 22:23:28', NULL, NULL, 0),
(23, 12, 'Have you seen Gladiator? I have never seen such art style in movies', '2020-04-13 22:28:44', NULL, NULL, 0),
(24, 5, 'Hello again', '2020-04-15 19:20:50', NULL, NULL, 0),
(30, 5, '&lt;b&gt;This text is bold&lt;/b&gt;\n&lt;i&gt;This text is italic&lt;/i&gt; \n&lt;img src=\'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg\' height=300; width=300&gt;', '2020-04-16 21:29:42', NULL, NULL, 0),
(60, 5, 'Why?', '2020-04-18 21:51:42', 30, NULL, 0),
(61, 5, 'HI', '2020-04-18 21:51:50', 24, NULL, 0),
(66, 5, 'Star wars was amazing', '2020-04-18 22:12:35', NULL, NULL, 0),
(67, 5, 'I know right?', '2020-04-18 22:12:50', 66, NULL, 0),
(68, 9, 'I disagree ', '2020-04-18 22:35:17', 30, NULL, 0),
(70, 5, 'Wow\r\n&lt;img src=https://cnet3.cbsistatic.com/img/0RHV-g86luLG7otcqz7yAgZhq6k=/940x0/2019/12/14/1387f7f7-6cbe-4a14-a9a7-e9f4c9741b65/baby-yoda-news-door-cb-1.jpg height=150&gt;', '2020-04-19 11:17:17', 30, NULL, 0),
(78, 5, 'The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.', '2020-05-04 00:07:11', NULL, NULL, 419704),
(80, 14, 'Demo žinutė', '2020-05-16 00:21:49', NULL, NULL, NULL),
(81, 14, 'Demo komentaras', '2020-05-16 00:25:30', 78, NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200405150927', '2020-04-05 15:09:34'),
('20200405151221', '2020-04-05 15:12:26'),
('20200405172016', '2020-04-05 17:20:22'),
('20200405173526', '2020-04-05 17:35:31'),
('20200405173706', '2020-04-05 17:37:12'),
('20200405173804', '2020-04-05 17:38:10'),
('20200405175630', '2020-04-05 17:56:38'),
('20200410181506', '2020-04-10 18:15:18'),
('20200410182325', '2020-04-10 18:23:31'),
('20200410185640', '2020-04-10 18:56:45'),
('20200411182558', '2020-04-11 18:26:26'),
('20200412152648', '2020-04-12 15:26:58'),
('20200412154246', '2020-04-12 15:42:51'),
('20200413100215', '2020-04-13 10:02:27'),
('20200413120541', '2020-04-13 12:05:46'),
('20200421173819', '2020-04-21 17:38:30'),
('20200426072935', '2020-04-26 07:29:49'),
('20200503113835', '2020-05-03 11:39:01'),
('20200503115608', '2020-05-03 11:56:14'),
('20200503115945', '2020-05-03 11:59:49'),
('20200503192500', '2020-05-03 19:25:05'),
('20200503192541', '2020-05-03 19:25:45');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `overview` longtext COLLATE utf8mb4_unicode_ci,
  `poster_path` longtext COLLATE utf8mb4_unicode_ci,
  `original_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double DEFAULT NULL,
  `api_id` int(11) NOT NULL,
  `genres` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:array)',
  `most_popular` int(11) DEFAULT NULL,
  `movie_id` int(11) NOT NULL,
  `top_rated` int(11) DEFAULT NULL,
  `upcoming` int(11) DEFAULT NULL,
  `latest` int(11) DEFAULT NULL,
  `now_playing` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `movies`
--

INSERT INTO `movies` (`id`, `title`, `author`, `release_date`, `overview`, `poster_path`, `original_title`, `rating`, `api_id`, `genres`, `most_popular`, `movie_id`, `top_rated`, `upcoming`, `latest`, `now_playing`) VALUES
(1, 'Underwater', NULL, '2020-01-08', 'After an earthquake destroys their underwater station, six researchers must navigate two miles along the dangerous, unknown depths of the ocean floor to make it to safety in a race against time.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/gzlbb3yeVISpQ3REd3Ga1scWGTU.jpg', 'Underwater', 6.4, 1, 'a:4:{i:0;s:6:\"Horror\";i:1;s:15:\"Science Fiction\";i:2;s:6:\"Action\";i:3;s:8:\"Thriller\";}', 22, 443791, NULL, NULL, NULL, NULL),
(2, 'F#*@BOIS', NULL, '2019-08-02', 'Ace, 23, and Miko, 17, desperately want to become famous actors but it seems the Universe has a different plan for their lives.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/dRCip3nvvHd5jW5E0GrjBsk0OX1.jpg', 'F#*@BOIS', 6.5, 1, 'a:2:{i:0;s:5:\"Drama\";i:1;s:8:\"Thriller\";}', NULL, 614375, NULL, NULL, NULL, NULL),
(3, 'Star Wars: The Rise of Skywalker', NULL, '2019-12-18', 'The surviving Resistance faces the First Order once again as the journey of Rey, Finn and Poe Dameron continues. With the power and knowledge of generations behind them, the final battle begins.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/db32LaOibwEliAmSL2jjDF6oDdj.jpg', 'Star Wars: The Rise of Skywalker', 6.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 13, 181812, NULL, NULL, NULL, NULL),
(4, 'Extraction', NULL, '2020-04-24', 'Tyler Rake, a fearless mercenary who offers his services on the black market, embarks on a dangerous mission when he is hired to rescue the kidnapped son of a Mumbai crime lord…', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/wlfDxbGEsW58vGhFljKkcR5IxDj.jpg', 'Extraction', 7.5, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:6:\"Action\";i:2;s:8:\"Thriller\";}', 5, 545609, NULL, NULL, NULL, NULL),
(5, 'Sonic the Hedgehog', NULL, '2020-02-12', 'Based on the global blockbuster videogame franchise from Sega, Sonic the Hedgehog tells the story of the world’s speediest hedgehog as he embraces his new home on Earth. In this live-action adventure comedy, Sonic and his new best friend team up to defend the planet from the evil genius Dr. Robotnik and his plans for world domination.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/aQvJ5WPzZgYVDrxLX4R6cLJCEaQ.jpg', 'Sonic the Hedgehog', 7.5, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:15:\"Science Fiction\";i:2;s:6:\"Comedy\";i:3;s:6:\"Family\";}', 3, 454626, NULL, NULL, NULL, NULL),
(6, 'Mortal Kombat Legends: Scorpion\'s Revenge', NULL, '2020-04-12', 'After the vicious slaughter of his family by stone-cold mercenary Sub-Zero, Hanzo Hasashi is exiled to the torturous Netherrealm. There, in exchange for his servitude to the sinister Quan Chi, he’s given a chance to avenge his family – and is resurrected as Scorpion, a lost soul bent on revenge. Back on Earthrealm, Lord Raiden gathers a team of elite warriors – Shaolin monk Liu Kang, Special Forces officer Sonya Blade and action star Johnny Cage – an unlikely band of heroes with one chance to save humanity. To do this, they must defeat Shang Tsung’s horde of Outworld gladiators and reign over the Mortal Kombat tournament.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/4VlXER3FImHeFuUjBShFamhIp9M.jpg', 'Mortal Kombat Legends: Scorpion\'s Revenge', 8.5, 1, 'a:4:{i:0;s:7:\"Fantasy\";i:1;s:6:\"Action\";i:2;s:9:\"Adventure\";i:3;s:9:\"Animation\";}', 121, 664767, NULL, NULL, NULL, NULL),
(7, 'Miracle in Cell No. 7', NULL, '2019-10-10', 'Separated from his daughter, a father with an intellectual disability must prove his innocence when he is jailed for the death of a commander\'s child.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/bOth4QmNyEkalwahfPCfiXjNh1r.jpg', '7. Koğuştaki Mucize', 8.3, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:6:\"Comedy\";i:2;s:6:\"Family\";}', NULL, 637920, NULL, NULL, NULL, NULL),
(8, 'The Rhythm Section', NULL, '2020-01-31', 'After the death of her family in an airplane crash on a flight that she was meant to be on, Stephanie Patrick discovers the crash was not an accident. She then seeks to uncover the truth by adapting the identity of an assassin to track down those responsible.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/spTr0VYyRtl36Lkk6nCnnbFXhus.jpg', 'The Rhythm Section', 5.6, 1, 'a:2:{i:0;s:6:\"Action\";i:1;s:8:\"Thriller\";}', NULL, 466622, NULL, NULL, NULL, NULL),
(9, 'Ad Astra', NULL, '2019-09-17', 'The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet Earth, astronaut Roy McBride undertakes a mission across the immensity of space and its many perils to uncover the truth about a lost expedition that decades before boldly faced emptiness and silence in search of the unknown.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg', 'Ad Astra', 6, 1, 'a:2:{i:0;s:15:\"Science Fiction\";i:1;s:5:\"Drama\";}', 1, 419704, NULL, NULL, NULL, NULL),
(10, 'Bloodshot', NULL, '2020-03-05', 'After he and his wife are murdered, marine Ray Garrison is resurrected by a team of scientists. Enhanced with nanotechnology, he becomes a superhuman, biotech killing machine—\'Bloodshot\'. As Ray first trains with fellow super-soldiers, he cannot recall anything from his former life. But when his memories flood back and he remembers the man that killed both him and his wife, he breaks out of the facility to get revenge, only to discover that there\'s more to the conspiracy than he thought.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/8WUVHemHFH2ZIP6NWkwlHWsyrEL.jpg', 'Bloodshot', 7.1, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:15:\"Science Fiction\";i:2;s:5:\"Drama\";}', 2, 338762, NULL, NULL, NULL, NULL),
(11, 'Crayon Shin-chan: Fierceness That Invites Storm! The Battle of the Warring States', NULL, '2002-04-20', 'Shin-chan somehow travels back in time, where he promptly involves himself in samurai wars and political intrigue, changing history left and right!', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/jR0rLDNv4kGPhdZD1uj6nz1nMSZ.jpg', 'クレヨンしんちゃん 嵐を呼ぶ アッパレ!戦国大合戦', 5.3, 1, 'a:1:{i:0;s:9:\"Animation\";}', NULL, 117084, NULL, NULL, NULL, NULL),
(12, 'Justice League Dark: Apokolips War', NULL, '2020-05-05', 'Earth is decimated after intergalactic tyrant Darkseid has devastated the Justice League in a poorly executed war by the DC Super Heroes. Now the remaining bastions of good – the Justice League, Teen Titans, Suicide Squad and assorted others – must regroup, strategize and take the war to Darkseid in order to save the planet and its surviving inhabitants.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/c01Y4suApJ1Wic2xLmaq1QYcfoZ.jpg', 'Justice League Dark: Apokolips War', 8.6, 1, 'a:5:{i:0;s:9:\"Animation\";i:1;s:6:\"Action\";i:2;s:7:\"Fantasy\";i:3;s:15:\"Science Fiction\";i:4;s:9:\"Adventure\";}', 8, 618344, NULL, NULL, NULL, NULL),
(13, '1917', NULL, '2019-12-25', 'At the height of the First World War, two young British soldiers must cross enemy territory and deliver a message that will stop a deadly attack on hundreds of soldiers.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/AuGiPiGMYMkSosOJ3BQjDEAiwtO.jpg', '1917', 7.9, 1, 'a:5:{i:0;s:3:\"War\";i:1;s:5:\"Drama\";i:2;s:6:\"Action\";i:3;s:8:\"Thriller\";i:4;s:7:\"History\";}', 4, 530915, NULL, NULL, NULL, NULL),
(14, 'Onward', NULL, '2020-02-29', 'In a suburban fantasy world, two teenage elf brothers embark on an extraordinary quest to discover if there is still a little magic left out there.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/f4aul3FyD3jv3v4bul1IrkWZvzq.jpg', 'Onward', 7.9, 1, 'a:5:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Comedy\";i:3;s:7:\"Fantasy\";i:4;s:6:\"Family\";}', 6, 508439, NULL, NULL, NULL, NULL),
(15, 'Frozen II', NULL, '2019-11-20', 'Elsa, Anna, Kristoff and Olaf head far into the forest to learn the truth about an ancient mystery of their kingdom.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/pjeMs3yqRmFL3giJy4PMXWZTTPa.jpg', 'Frozen II', 7.2, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Family\";}', 7, 330457, NULL, NULL, NULL, NULL),
(16, 'Birds of Prey (and the Fantabulous Emancipation of One Harley Quinn)', NULL, '2020-02-05', 'Harley Quinn joins forces with a singer, an assassin and a police detective to help a young girl who had a hit placed on her after she stole a rare diamond from a crime lord.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/h4VB6m0RwcicVEZvzftYZyKXs6K.jpg', 'Birds of Prey (and the Fantabulous Emancipation of One Harley Quinn)', 7.2, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:6:\"Comedy\";i:2;s:5:\"Crime\";}', 9, 495764, NULL, NULL, NULL, NULL),
(17, 'Scoob!', NULL, '2020-05-15', 'In Scooby-Doo’s greatest adventure yet, see the never-before told story of how lifelong friends Scooby and Shaggy first met and how they joined forces with young detectives Fred, Velma, and Daphne to form the famous Mystery Inc. Now, with hundreds of cases solved, Scooby and the gang face their biggest, toughest mystery ever: an evil plot to unleash the ghost dog Cerberus upon the world. As they race to stop this global “dogpocalypse,” the gang discovers that Scooby has a secret legacy and an epic destiny greater than anyone ever imagined.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/zG2l9Svw4PTldWJAzC171Y3d6G8.jpg', 'Scoob!', 8.3, 1, 'a:5:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Comedy\";i:3;s:7:\"Mystery\";i:4;s:6:\"Family\";}', 10, 385103, NULL, NULL, NULL, NULL),
(18, 'The Call of the Wild', NULL, '2020-02-19', 'Buck is a big-hearted dog whose blissful domestic life is turned upside down when he is suddenly uprooted from his California home and transplanted to the exotic wilds of the Yukon during the Gold Rush of the 1890s. As the newest rookie on a mail delivery dog sled team—and later its leader—Buck experiences the adventure of a lifetime, ultimately finding his true place in the world and becoming his own master.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/33VdppGbeNxICrFUtW2WpGHvfYc.jpg', 'The Call of the Wild', 7.3, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:5:\"Drama\";i:2;s:6:\"Family\";}', 11, 481848, NULL, NULL, NULL, NULL),
(19, 'The Wrong Missy', NULL, '2020-05-13', 'A guy meets the woman of his dreams and invites her to his company\'s corporate retreat, but realizes he sent the invite to the wrong person.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/A2YlIrzypvhS3vTFMcDkG3xLvac.jpg', 'The Wrong Missy', 6.1, 1, 'a:2:{i:0;s:6:\"Comedy\";i:1;s:7:\"Romance\";}', 12, 582596, NULL, NULL, NULL, NULL),
(20, 'Hang \'em High', NULL, '1968-07-31', 'Marshall Jed Cooper survives a hanging, vowing revenge on the lynch mob that left him dangling. To carry out his oath for vengeance, he returns to his former job as a lawman. Before long, he\'s caught up with the nine men on his hit list and starts dispensing his own brand of Wild West justice.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/ejdsKe7osgsYT5WpYqAMSvmdMEx.jpg', 'Hang \'em High', 6.7, 1, 'a:1:{i:0;s:7:\"Western\";}', 14, 4929, NULL, NULL, NULL, NULL),
(21, 'Bad Boys for Life', NULL, '2020-01-15', 'Marcus and Mike are forced to confront new threats, career changes, and midlife crises as they join the newly created elite team AMMO of the Miami police department to take down the ruthless Armando Armas, the vicious leader of a Miami drug cartel.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/y95lQLnuNKdPAzw9F9Ab8kJ80c3.jpg', 'Bad Boys for Life', 7.2, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:5:\"Crime\";i:2;s:8:\"Thriller\";}', 15, 38700, NULL, NULL, NULL, NULL),
(22, 'Parasite', NULL, '2019-05-30', 'All unemployed, Ki-taek\'s family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', '기생충', 8.5, 1, 'a:3:{i:0;s:6:\"Comedy\";i:1;s:5:\"Drama\";i:2;s:8:\"Thriller\";}', 16, 496243, NULL, NULL, NULL, NULL),
(23, 'Cars', NULL, '2006-06-08', 'Lightning McQueen, a hotshot rookie race car driven to succeed, discovers that life is about the journey, not the finish line, when he finds himself unexpectedly detoured in the sleepy Route 66 town of Radiator Springs. On route across the country to the big Piston Cup Championship in California to compete against two seasoned pros, McQueen gets to know the town\'s offbeat characters.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/qa6HCwP4Z15l3hpsASz3auugEW6.jpg', 'Cars', 6.8, 1, 'a:4:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Comedy\";i:3;s:6:\"Family\";}', 17, 920, NULL, NULL, NULL, NULL),
(24, 'The Invisible Man', NULL, '2020-02-26', 'When Cecilia\'s abusive ex takes his own life and leaves her his fortune, she suspects his death was a hoax. As a series of coincidences turn lethal, Cecilia works to prove that she is being hunted by someone nobody can see.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/5EufsDwXdY2CVttYOk2WtYhgKpa.jpg', 'The Invisible Man', 7.1, 1, 'a:3:{i:0;s:6:\"Horror\";i:1;s:15:\"Science Fiction\";i:2;s:8:\"Thriller\";}', 18, 570670, NULL, NULL, NULL, NULL),
(25, 'Joker', NULL, '2019-10-02', 'During the 1980s, a failed stand-up comedian is driven insane and turns to a life of crime and chaos in Gotham City while becoming an infamous psychopathic crime figure.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', 'Joker', 8.2, 1, 'a:3:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";i:2;s:8:\"Thriller\";}', 19, 475557, NULL, NULL, NULL, NULL),
(26, 'Avengers: Infinity War', NULL, '2018-04-25', 'As the Avengers and their allies have continued to protect the world from threats too large for any one hero to handle, a new danger has emerged from the cosmic shadows: Thanos. A despot of intergalactic infamy, his goal is to collect all six Infinity Stones, artifacts of unimaginable power, and use them to inflict his twisted will on all of reality. Everything the Avengers have fought for has led up to this moment - the fate of Earth and existence itself has never been more uncertain.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7WsyChQLEftFiDOVTGkv3hFpyyt.jpg', 'Avengers: Infinity War', 8.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 20, 299536, NULL, NULL, NULL, NULL),
(27, 'Jojo Rabbit', NULL, '2019-10-18', 'A World War II satire that follows a lonely German boy whose world view is turned upside down when he discovers his single mother is hiding a young Jewish girl in their attic. Aided only by his idiotic imaginary friend, Adolf Hitler, Jojo must confront his blind nationalism.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7GsM4mtM0worCtIVeiQt28HieeN.jpg', 'Jojo Rabbit', 8.2, 1, 'a:3:{i:0;s:6:\"Comedy\";i:1;s:5:\"Drama\";i:2;s:3:\"War\";}', 21, 515001, NULL, NULL, NULL, NULL),
(28, 'Dolittle', NULL, '2020-01-01', 'After losing his wife seven years earlier, the eccentric Dr. John Dolittle, famed doctor and veterinarian of Queen Victoria’s England, hermits himself away behind the high walls of Dolittle Manor with only his menagerie of exotic animals for company. But when the young queen falls gravely ill, a reluctant Dolittle is forced to set sail on an epic adventure to a mythical island in search of a cure, regaining his wit and courage as he crosses old adversaries and discovers wondrous creatures.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/uoplwswBDy7gsOyrbGuKyPFoPCs.jpg', 'Dolittle', 6.8, 1, 'a:4:{i:0;s:9:\"Adventure\";i:1;s:6:\"Comedy\";i:2;s:7:\"Fantasy\";i:3;s:6:\"Family\";}', 23, 448119, NULL, NULL, NULL, NULL),
(29, 'Knives Out', NULL, '2019-11-27', 'When renowned crime novelist Harlan Thrombey is found dead at his estate just after his 85th birthday, the inquisitive and debonair Detective Benoit Blanc is mysteriously enlisted to investigate. From Harlan\'s dysfunctional family to his devoted staff, Blanc sifts through a web of red herrings and self-serving lies to uncover the truth behind Harlan\'s untimely death.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/pThyQovXQrw2m0s9x82twj48Jq4.jpg', 'Knives Out', 7.8, 1, 'a:5:{i:0;s:7:\"Mystery\";i:1;s:8:\"Thriller\";i:2;s:6:\"Comedy\";i:3;s:5:\"Drama\";i:4;s:5:\"Crime\";}', 24, 546554, NULL, NULL, NULL, NULL),
(30, 'Interstellar', NULL, '2014-11-05', 'Interstellar chronicles the adventures of a group of explorers who make use of a newly discovered wormhole to surpass the limitations on human space travel and conquer the vast distances involved in an interstellar voyage.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg', 'Interstellar', 8.3, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:5:\"Drama\";i:2;s:15:\"Science Fiction\";}', 25, 157336, NULL, NULL, NULL, NULL),
(31, 'Aladdin', NULL, '2019-05-22', 'A kindhearted street urchin named Aladdin embarks on a magical adventure after finding a lamp that releases a wisecracking genie while a power-hungry Grand Vizier vies for the same lamp that has the power to make their deepest wishes come true.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/3iYQTLGoy7QnjcUYRJy4YrAgGvp.jpg', 'Aladdin', 7.1, 1, 'a:5:{i:0;s:9:\"Adventure\";i:1;s:6:\"Comedy\";i:2;s:7:\"Fantasy\";i:3;s:7:\"Romance\";i:4;s:6:\"Family\";}', 26, 420817, NULL, NULL, NULL, NULL),
(32, 'Blood and Money', NULL, '2020-05-15', 'A retired veteran hunting in the Allagash backcountry of Maine discovers a dead woman with a duffle bag full of money. He soon finds himself in a web of deceit and murder.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/st4n0FALlo0twLkSqxAvU15SKvU.jpg', 'Allagash', 4.6, 1, 'a:1:{i:0;s:8:\"Thriller\";}', 27, 691812, NULL, NULL, NULL, NULL),
(33, 'Star Wars', NULL, '1977-05-25', 'Princess Leia is captured and held hostage by the evil Imperial forces in their effort to take over the galactic Empire. Venturesome Luke Skywalker and dashing captain Han Solo team together with the loveable robot duo R2-D2 and C-3PO to rescue the beautiful princess and restore peace and justice in the Empire.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/6FfCtAuVAW8XJjZ7eWeLibRLWTw.jpg', 'Star Wars', 8.2, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 28, 11, NULL, NULL, NULL, NULL),
(34, 'Spider-Man: Far from Home', NULL, '2019-06-28', 'Peter Parker and his friends go on a summer trip to Europe. However, they will hardly be able to rest - Peter will have to agree to help Nick Fury uncover the mystery of creatures that cause natural disasters and destruction throughout the continent.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/4q2NNj4S5dG2RLF9CpXsej7yXl.jpg', 'Spider-Man: Far from Home', 7.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 29, 429617, NULL, NULL, NULL, NULL),
(35, 'Jumanji: The Next Level', NULL, '2019-12-04', 'As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored in order to escape the world’s most dangerous game.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/jyw8VKYEiM1UDzPB7NsisUgBeJ8.jpg', 'Jumanji: The Next Level', 6.9, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:6:\"Comedy\";i:2;s:7:\"Fantasy\";}', 30, 512200, NULL, NULL, NULL, NULL),
(36, 'Fantasy Island', NULL, '2020-02-12', 'A group of contest winners arrive at an island hotel to live out their dreams, only to find themselves trapped in nightmare scenarios.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/8ZMrZGGW65ePWIgRn1260nA1uUm.jpg', 'Fantasy Island', 6.2, 1, 'a:3:{i:0;s:7:\"Fantasy\";i:1;s:6:\"Horror\";i:2;s:15:\"Science Fiction\";}', 31, 539537, NULL, NULL, NULL, NULL),
(37, 'The Hunt', NULL, '2020-03-11', 'Twelve strangers wake up in a clearing. They don\'t know where they are—or how they got there. In the shadow of a dark internet conspiracy theory, ruthless elitists gather at a remote location to hunt humans for sport. But their master plan is about to be derailed when one of the hunted turns the tables on her pursuers.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/wxPhn4ef1EAo5njxwBkAEVrlJJG.jpg', 'The Hunt', 6.8, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:6:\"Horror\";i:2;s:8:\"Thriller\";}', 32, 514847, NULL, NULL, NULL, NULL),
(38, 'Inception', NULL, '2010-07-15', 'Cobb, a skilled thief who commits corporate espionage by infiltrating the subconscious of his targets is offered a chance to regain his old life as payment for a task considered to be impossible: \"inception\", the implantation of another person\'s idea into a target\'s subconscious.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg', 'Inception', 8.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 33, 27205, NULL, NULL, NULL, NULL),
(39, 'Harry Potter and the Philosopher\'s Stone', NULL, '2001-11-16', 'Harry Potter has lived under the stairs at his aunt and uncle\'s house his whole life. But on his 11th birthday, he learns he\'s a powerful wizard -- with a place waiting for him at the Hogwarts School of Witchcraft and Wizardry. As he learns to harness his newfound powers with the help of the school\'s kindly headmaster, Harry uncovers the truth about his parents\' deaths -- and about the villain who\'s to blame.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/wuMc08IPKEatf9rnMNXvIDxqP4W.jpg', 'Harry Potter and the Philosopher\'s Stone', 7.9, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:7:\"Fantasy\";i:2;s:6:\"Family\";}', 34, 671, NULL, NULL, NULL, NULL),
(40, 'Once Upon a Time… in Hollywood', NULL, '2019-07-25', 'Los Angeles, 1969. TV star Rick Dalton, a struggling actor specializing in westerns, and stuntman Cliff Booth, his best friend, try to survive in a constantly changing movie industry. Dalton is the neighbor of the young and promising actress and model Sharon Tate, who has just married the prestigious Polish director Roman Polanski…', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/8j58iEBw9pOXFD2L0nt0ZXeHviB.jpg', 'Once Upon a Time… in Hollywood', 7.5, 1, 'a:3:{i:0;s:6:\"Comedy\";i:1;s:5:\"Drama\";i:2;s:8:\"Thriller\";}', 35, 466272, NULL, NULL, NULL, NULL),
(41, 'The Platform', NULL, '2019-11-08', 'A mysterious place, an indescribable prison, a deep hole. An unknown number of levels. Two inmates living on each level. A descending platform containing food for all of them. An inhuman fight for survival, but also an opportunity for solidarity…', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/8ZX18L5m6rH5viSYpRnTSbb9eXh.jpg', 'El hoyo', 7.1, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:15:\"Science Fiction\";i:2;s:8:\"Thriller\";}', 36, 619264, NULL, NULL, NULL, NULL),
(42, 'The Rifleman of the Voroshilov Regiment', NULL, '1999-04-19', 'A very typical post-Soviet era storyline. A bunch of vagabonds lured an innocent teenage girl to their apartment, offered her a drink, intimidated, then gang raped her. Local cops are incapable to undertake an adequate actions against the scoundrels - prevented by the superior chief of the local police, who is the dad of one of the scumbags. The case is closed. The girl\'s granddad tired of an endless circumlocution decides to take revenge in his own hands.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/ncMZhkjktqLLlN7j0o3PZ3dF4XP.jpg', 'Ворошиловский стрелок', 7.3, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:6:\"Action\";i:2;s:5:\"Crime\";}', 37, 71186, NULL, NULL, NULL, NULL),
(43, 'Capone', NULL, '2020-05-12', 'The 47-year old Al Capone, after 10 years in prison, starts suffering from dementia and comes to be haunted by his violent past.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/75gDv38UgRtAukSxNXcjatyQmEa.jpg', 'Capone', 5.5, 1, 'a:2:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";}', 38, 429422, NULL, NULL, NULL, NULL),
(44, 'Ford v Ferrari', NULL, '2019-11-13', 'American car designer Carroll Shelby and the British-born driver Ken Miles work together to battle corporate interference, the laws of physics, and their own personal demons to build a revolutionary race car for Ford Motor Company and take on the dominating race cars of Enzo Ferrari at the 24 Hours of Le Mans in France in 1966.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/6ApDtO7xaWAfPqfi2IARXIzj8QS.jpg', 'Ford v Ferrari', 7.9, 1, 'a:2:{i:0;s:6:\"Action\";i:1;s:5:\"Drama\";}', 39, 359724, NULL, NULL, NULL, NULL),
(45, 'The Gentlemen', NULL, '2020-01-01', 'American expat Mickey Pearson has built a highly profitable marijuana empire in London. When word gets out that he’s looking to cash out of the business forever it triggers plots, schemes, bribery and blackmail in an attempt to steal his domain out from under him.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/jtrhTYB7xSrJxR1vusu99nvnZ1g.jpg', 'The Gentlemen', 7.7, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:6:\"Comedy\";i:2;s:5:\"Crime\";}', 40, 522627, NULL, NULL, NULL, NULL),
(46, 'Gone Girl', NULL, '2014-10-01', 'With his wife\'s disappearance having become the focus of an intense media circus, a man sees the spotlight turned on him when it\'s suspected that he may not be innocent.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/n9wBQ9loiC1KUAoJ7WcqASvCiAJ.jpg', 'Gone Girl', 7.9, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:7:\"Mystery\";i:2;s:8:\"Thriller\";}', 41, 210577, NULL, NULL, NULL, NULL),
(47, 'The Lion King', NULL, '2019-07-12', 'Simba idolizes his father, King Mufasa, and takes to heart his own royal destiny. But not everyone in the kingdom celebrates the new cub\'s arrival. Scar, Mufasa\'s brother—and former heir to the throne—has plans of his own. The battle for Pride Rock is ravaged with betrayal, tragedy and drama, ultimately resulting in Simba\'s exile. With help from a curious pair of newfound friends, Simba will have to figure out how to grow up and take back what is rightfully his.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/2bXbqYdUdNVa8VIWXVfclP2ICtT.jpg', 'The Lion King', 7.2, 1, 'a:2:{i:0;s:9:\"Adventure\";i:1;s:6:\"Family\";}', 42, 420818, NULL, NULL, NULL, NULL),
(48, 'The Lord of the Rings: The Fellowship of the Ring', NULL, '2001-12-18', 'Young hobbit Frodo Baggins, after inheriting a mysterious ring from his uncle Bilbo, must leave his home in order to keep it from falling into the hands of its evil creator. Along the way, a fellowship is formed to protect the ringbearer and make sure that the ring arrives at its final destination: Mt. Doom, the only place where it can be destroyed.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/6oom5QYQ2yQTMJIbnvbkBL9cHo6.jpg', 'The Lord of the Rings: The Fellowship of the Ring', 8.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";}', 43, 120, NULL, NULL, NULL, NULL),
(49, 'The Hobbit: The Battle of the Five Armies', NULL, '2014-12-10', 'Immediately after the events of The Desolation of Smaug, Bilbo and the dwarves try to defend Erebor\'s mountain of treasure from others who claim it: the men of the ruined Laketown and the elves of Mirkwood. Meanwhile an army of Orcs led by Azog the Defiler is marching on Erebor, fueled by the rise of the dark lord Sauron. Dwarves, elves and men must unite, and the hope for Middle-Earth falls into Bilbo\'s hands.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/r4fUzktMexHnTfR3Qn44o3r0XAq.jpg', 'The Hobbit: The Battle of the Five Armies', 7.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";}', 44, 122917, NULL, NULL, NULL, NULL),
(50, 'The Mad Hatter', NULL, '2020-05-15', 'No overview given yet.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/45Pg5ZzRa4fDwtPQmmE09dT018p.jpg', 'The Mad Hatter', 5, 1, 'a:2:{i:0;s:6:\"Horror\";i:1;s:8:\"Thriller\";}', 45, 698320, NULL, NULL, NULL, NULL),
(51, 'Léon: The Professional', NULL, '1994-09-14', 'Léon, the top hit man in New York, has earned a rep as an effective \"cleaner\". But when his next-door neighbors are wiped out by a loose-cannon DEA agent, he becomes the unwilling custodian of 12-year-old Mathilda. Before long, Mathilda\'s thoughts turn to revenge, and she considers following in Léon\'s footsteps.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/gbw7Tm7SUyiTMhI2B8yHk4OcT9I.jpg', 'Léon: The Professional', 8.3, 1, 'a:3:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";i:2;s:6:\"Action\";}', 46, 101, NULL, NULL, NULL, NULL),
(52, 'The Dark Knight', NULL, '2008-07-16', 'Batman raises the stakes in his war on crime. With the help of Lt. Jim Gordon and District Attorney Harvey Dent, Batman sets out to dismantle the remaining criminal organizations that plague the streets. The partnership proves to be effective, but they soon find themselves prey to a reign of chaos unleashed by a rising criminal mastermind known to the terrified citizens of Gotham as the Joker.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/qJ2tW6WMUDux911r6m7haRef0WH.jpg', 'The Dark Knight', 8.4, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:5:\"Crime\";i:2;s:5:\"Drama\";i:3;s:8:\"Thriller\";}', 47, 155, NULL, NULL, NULL, NULL),
(53, 'Terminator: Dark Fate', NULL, '2019-10-23', 'Decades after Sarah Connor prevented Judgment Day, a lethal new Terminator is sent to eliminate the future leader of the resistance. In a fight to save mankind, battle-hardened Sarah Connor teams up with an unexpected ally and an enhanced super soldier to stop the deadliest Terminator yet.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/vqzNJRH4YyquRiWxCCOH0aXggHI.jpg', 'Terminator: Dark Fate', 6.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 48, 290859, NULL, NULL, NULL, NULL),
(54, 'Mission: Impossible - Fallout', NULL, '2018-07-13', 'When an IMF mission ends badly, the world is faced with dire consequences. As Ethan Hunt takes it upon himself to fulfill his original briefing, the CIA begin to question his loyalty and his motives. The IMF team find themselves in a race against time, hunted by assassins while trying to prevent a global catastrophe.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/AkJQpZp9WoNdj7pLYSj1L0RcMMN.jpg', 'Mission: Impossible - Fallout', 7.3, 1, 'a:2:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";}', 49, 353081, NULL, NULL, NULL, NULL),
(55, 'Star Wars: The Last Jedi', NULL, '2017-12-13', 'Rey develops her newly discovered abilities with the guidance of Luke Skywalker, who is unsettled by the strength of her powers. Meanwhile, the Resistance prepares to do battle with the First Order.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/kOVEVeg59E0wsnXmF9nrh6OmWII.jpg', 'Star Wars: The Last Jedi', 7, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 50, 181808, NULL, NULL, NULL, NULL),
(56, 'Spies in Disguise', NULL, '2019-12-04', 'Super spy Lance Sterling and scientist Walter Beckett are almost exact opposites. Lance is smooth, suave and debonair. Walter is… not. But what Walter lacks in social skills he makes up for in smarts and invention, creating the awesome gadgets Lance uses on his epic missions. But when events take an unexpected turn, Walter and Lance suddenly have to rely on each other in a whole new way.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/30YacPAcxpNemhhwX0PVUl9pVA3.jpg', 'Spies in Disguise', 7.7, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:9:\"Animation\";i:3;s:6:\"Comedy\";}', 51, 431693, NULL, NULL, NULL, NULL),
(57, 'Godzilla: King of the Monsters', NULL, '2019-05-29', 'Follows the heroic efforts of the crypto-zoological agency Monarch as its members face off against a battery of god-sized monsters, including the mighty Godzilla, who collides with Mothra, Rodan, and his ultimate nemesis, the three-headed King Ghidorah. When these ancient super-species - thought to be mere myths - rise again, they all vie for supremacy, leaving humanity\'s very existence hanging in the balance.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/pU3bnutJU91u3b4IeRPQTOP8jhV.jpg', 'Godzilla: King of the Monsters', 6.3, 1, 'a:2:{i:0;s:6:\"Action\";i:1;s:15:\"Science Fiction\";}', 52, 373571, NULL, NULL, NULL, NULL),
(58, 'Blade Runner 2049', NULL, '2017-10-04', 'Thirty years after the events of the first film, a new blade runner, LAPD Officer K, unearths a long-buried secret that has the potential to plunge what\'s left of society into chaos. K\'s discovery leads him on a quest to find Rick Deckard, a former LAPD blade runner who has been missing for 30 years.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/gajva2L0rPYkEWjzgFlBXCAVBE5.jpg', 'Blade Runner 2049', 7.4, 1, 'a:2:{i:0;s:5:\"Drama\";i:1;s:15:\"Science Fiction\";}', 53, 335984, NULL, NULL, NULL, NULL),
(59, 'Trolls World Tour', NULL, '2020-03-12', 'Queen Poppy and Branch make a surprising discovery — there are other Troll worlds beyond their own, and their distinct differences create big clashes between these various tribes. When a mysterious threat puts all of the Trolls across the land in danger, Poppy, Branch, and their band of friends must embark on an epic quest to create harmony among the feuding Trolls to unite them against certain doom.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7W0G3YECgDAfnuiHG91r8WqgIOe.jpg', 'Trolls World Tour', 7.6, 1, 'a:6:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Comedy\";i:3;s:7:\"Fantasy\";i:4;s:5:\"Music\";i:5;s:6:\"Family\";}', 54, 446893, NULL, NULL, NULL, NULL),
(60, 'The Half of It', NULL, '2020-05-01', 'Shy, straight-A student Ellie is hired by sweet but inarticulate jock Paul, who needs help wooing the most popular girl in school. But their new and unlikely friendship gets tricky when Ellie discovers she has feelings for the same girl.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/jC1PNXGET1ZZQyrJvdFhPfXdPP1.jpg', 'The Half of It', 7.4, 1, 'a:2:{i:0;s:6:\"Comedy\";i:1;s:7:\"Romance\";}', 55, 597219, NULL, NULL, NULL, NULL),
(61, 'Thor: Ragnarok', NULL, '2017-10-25', 'Thor is imprisoned on the other side of the universe and finds himself in a race against time to get back to Asgard to stop Ragnarok, the destruction of his home-world and the end of Asgardian civilization, at the hands of an all-powerful new threat, the ruthless Hela.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/rzRwTcFvttcN1ZpX2xv4j3tSdJu.jpg', 'Thor: Ragnarok', 7.6, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:6:\"Comedy\";i:3;s:7:\"Fantasy\";}', 56, 284053, NULL, NULL, NULL, NULL),
(62, 'The Matrix', NULL, '1999-03-30', 'Set in the 22nd century, The Matrix tells the story of a computer hacker who joins a group of underground insurgents fighting the vast and powerful computers who now rule the earth.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg', 'The Matrix', 8.1, 1, 'a:2:{i:0;s:6:\"Action\";i:1;s:15:\"Science Fiction\";}', 57, 603, NULL, NULL, NULL, NULL),
(63, 'All the Money in the World', NULL, '2017-12-21', 'The story of the kidnapping of 16-year-old John Paul Getty III and the desperate attempt by his devoted mother to convince his billionaire grandfather Jean Paul Getty to pay the ransom.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/q6nE9Hf0ezszjI4DbCxwzQ73MMy.jpg', 'All the Money in the World', 6.4, 1, 'a:4:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";i:2;s:7:\"Mystery\";i:3;s:8:\"Thriller\";}', 58, 446791, NULL, NULL, NULL, NULL),
(64, 'Inside Out', NULL, '2015-06-09', 'Growing up can be a bumpy road, and it\'s no exception for Riley, who is uprooted from her Midwest life when her father starts a new job in San Francisco. Riley\'s guiding emotions— Joy, Fear, Anger, Disgust and Sadness—live in Headquarters, the control centre inside Riley\'s mind, where they help advise her through everyday life and tries to keep things positive, but the emotions conflict on how best to navigate a new city, house and school.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/2H1TmgdfNtsKlU9jKdeNyYL5y8T.jpg', 'Inside Out', 7.9, 1, 'a:4:{i:0;s:9:\"Animation\";i:1;s:6:\"Comedy\";i:2;s:5:\"Drama\";i:3;s:6:\"Family\";}', 59, 150540, NULL, NULL, NULL, NULL),
(65, 'Star Wars: The Force Awakens', NULL, '2015-12-15', 'Thirty years after defeating the Galactic Empire, Han Solo and his allies face a new threat from the evil Kylo Ren and his army of Stormtroopers.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/9rd002JS49RwDW944fF1wjU8iTV.jpg', 'Star Wars: The Force Awakens', 7.4, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";i:3;s:7:\"Fantasy\";}', 60, 140607, NULL, NULL, NULL, NULL),
(66, 'Jocks', NULL, '1986-11-14', 'The coach of a college tennis team is given an ultimatum: put together a winning team, or else.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/tgjpxqrugdbnADyKGvo65kySaBL.jpg', 'Jocks', 5.2, 1, 'a:1:{i:0;s:6:\"Comedy\";}', 61, 67693, NULL, NULL, NULL, NULL),
(67, 'The Shawshank Redemption', NULL, '1994-09-23', 'Framed in the 1940s for the double murder of his wife and her lover, upstanding banker Andy Dufresne begins a new life at the Shawshank prison, where he puts his accounting skills to work for an amoral warden. During his long stretch in prison, Dufresne comes to be admired by the other inmates -- including an older prisoner named Red -- for his integrity and unquenchable sense of hope.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/5KCVkau1HEl7ZzfPsKAPM0sMiKc.jpg', 'The Shawshank Redemption', 8.7, 1, 'a:2:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";}', 62, 278, NULL, NULL, NULL, NULL),
(68, 'The Room', NULL, '2019-09-12', 'Kate and Matt discover that a part of their house can grant wishes. In the wake of several miscarriages, what they want most is a child.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/bWyQwZziHh1DK9F59eqahZD8Upc.jpg', 'The Room', 6.4, 1, 'a:4:{i:0;s:5:\"Drama\";i:1;s:7:\"Mystery\";i:2;s:15:\"Science Fiction\";i:3;s:8:\"Thriller\";}', 63, 582913, NULL, NULL, NULL, NULL),
(69, 'Deadpool', NULL, '2016-02-09', 'Deadpool tells the origin story of former Special Forces operative turned mercenary Wade Wilson, who after being subjected to a rogue experiment that leaves him with accelerated healing powers, adopts the alter ego Deadpool. Armed with his new abilities and a dark, twisted sense of humor, Deadpool hunts down the man who nearly destroyed his life.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/yGSxMiF0cYuAiyuve5DA6bnWEOI.jpg', 'Deadpool', 7.6, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:6:\"Comedy\";}', 64, 293660, NULL, NULL, NULL, NULL),
(70, 'Captain Marvel', NULL, '2019-03-06', 'The story follows Carol Danvers as she becomes one of the universe’s most powerful heroes when Earth is caught in the middle of a galactic war between two alien races. Set in the 1990s, Captain Marvel is an all-new adventure from a previously unseen period in the history of the Marvel Cinematic Universe.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/AtsgWhDnHTq68L0lLsUrCnM7TjG.jpg', 'Captain Marvel', 7, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 65, 299537, NULL, NULL, NULL, NULL),
(71, 'Forrest Gump', NULL, '1994-07-06', 'A man with a low IQ has accomplished great things in his life and been present during significant historic events—in each case, far exceeding what anyone imagined he could do. But despite all he has achieved, his one true love eludes him.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/clolk7rB5lAjs41SD0Vt6IXYLMm.jpg', 'Forrest Gump', 8.4, 1, 'a:3:{i:0;s:6:\"Comedy\";i:1;s:5:\"Drama\";i:2;s:7:\"Romance\";}', 66, 13, NULL, NULL, NULL, NULL),
(72, 'Rogue One: A Star Wars Story', NULL, '2016-12-14', 'A rogue band of resistance fighters unite for a mission to steal the Death Star plans and bring a new hope to the galaxy.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/5jX3p0apUG5bkMHtnKZch0xpkBS.jpg', 'Rogue One: A Star Wars Story', 7.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 67, 330459, NULL, NULL, NULL, NULL),
(73, 'The Grudge', NULL, '2020-01-02', 'After a young mother murders her family in her own house, a detective attempts to investigate the mysterious case, only to discover that the house is cursed by a vengeful ghost. Now targeted by the demonic spirits, the detective must do anything to protect herself and her family from harm.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/vN7JHlHOT9rHNDU27tfYqhABBj5.jpg', 'The Grudge', 5.7, 1, 'a:2:{i:0;s:6:\"Horror\";i:1;s:7:\"Mystery\";}', 68, 465086, NULL, NULL, NULL, NULL),
(74, 'The Lord of the Rings: The Return of the King', NULL, '2003-12-01', 'Aragorn is revealed as the heir to the ancient kings as he, Gandalf and the other members of the broken fellowship struggle to save Gondor from Sauron\'s forces. Meanwhile, Frodo and Sam take the ring closer to the heart of Mordor, the dark lord\'s realm.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/rCzpDGLbOoPwLjy3OAm5NUPOTrC.jpg', 'The Lord of the Rings: The Return of the King', 8.4, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";}', 69, 122, NULL, NULL, NULL, NULL),
(75, 'Spider-Man: Homecoming', NULL, '2017-07-05', 'Following the events of Captain America: Civil War, Peter Parker, with the help of his mentor Tony Stark, tries to balance his life as an ordinary high school student in Queens, New York City, with fighting crime as his superhero alter ego Spider-Man as a new threat, the Vulture, emerges.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/c24sv2weTHPsmDa7jEMN0m2P3RT.jpg', 'Spider-Man: Homecoming', 7.4, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:5:\"Drama\";i:3;s:15:\"Science Fiction\";}', 70, 315635, NULL, NULL, NULL, NULL),
(76, 'Vivarium', NULL, '2019-07-12', 'A young woman and her fiancé are in search of the perfect starter home. After following a mysterious real estate agent to a new housing development, the couple finds themselves trapped in a maze of identical houses and forced to raise an otherworldly child.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/myf3qzpeN0JbuFRPwSpJcz7rmAT.jpg', 'Vivarium', 5.7, 1, 'a:3:{i:0;s:6:\"Horror\";i:1;s:15:\"Science Fiction\";i:2;s:8:\"Thriller\";}', 71, 458305, NULL, NULL, NULL, NULL),
(77, 'Harry Potter and the Chamber of Secrets', NULL, '2002-11-13', 'Cars fly, trees fight back, and a mysterious house-elf comes to warn Harry Potter at the start of his second year at Hogwarts. Adventure and danger await when bloody writing on a wall announces: The Chamber Of Secrets Has Been Opened. To save Hogwarts will require all of Harry, Ron and Hermione’s magical abilities and courage.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/sdEOH0992YZ0QSxgXNIGLq1ToUi.jpg', 'Harry Potter and the Chamber of Secrets', 7.7, 1, 'a:2:{i:0;s:9:\"Adventure\";i:1;s:7:\"Fantasy\";}', 72, 672, NULL, NULL, NULL, NULL),
(78, 'Wonder Woman', NULL, '2017-05-30', 'An Amazon princess comes to the world of Man in the grips of the First World War to confront the forces of evil and bring an end to human conflict.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/gfJGlDaHuWimErCr5Ql0I8x9QSy.jpg', 'Wonder Woman', 7.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";}', 73, 297762, NULL, NULL, NULL, NULL),
(79, 'El Camino: A Breaking Bad Movie', NULL, '2019-10-11', 'In the wake of his dramatic escape from captivity, Jesse Pinkman must come to terms with his past in order to forge some kind of future.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/ePXuKdXZuJx8hHMNr2yM4jY2L7Z.jpg', 'El Camino: A Breaking Bad Movie', 6.8, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:5:\"Crime\";i:2;s:5:\"Drama\";i:3;s:8:\"Thriller\";}', 74, 559969, NULL, NULL, NULL, NULL),
(80, 'The Lord of the Rings: The Two Towers', NULL, '2002-12-18', 'Frodo and Sam are trekking to Mordor to destroy the One Ring of Power while Gimli, Legolas and Aragorn search for the orc-captured Merry and Pippin. All along, nefarious wizard Saruman awaits the Fellowship members at the Orthanc Tower in Isengard.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/5VTN0pR8gcqV3EPUHHfMGnJYN9L.jpg', 'The Lord of the Rings: The Two Towers', 8.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";}', 75, 121, NULL, NULL, NULL, NULL),
(81, 'Emma.', NULL, '2020-02-13', 'In 1800s England, a well-meaning but selfish young woman meddles in the love lives of her friends.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/sm8iVzA7kRp0d4BSIsgXjsSBMKV.jpg', 'Emma.', 7, 1, 'a:3:{i:0;s:6:\"Comedy\";i:1;s:5:\"Drama\";i:2;s:7:\"Romance\";}', 76, 556678, NULL, NULL, NULL, NULL),
(82, 'Black Panther', NULL, '2018-02-13', 'King T\'Challa returns home from America to the reclusive, technologically advanced African nation of Wakanda to serve as his country\'s new leader. However, T\'Challa soon finds that he is challenged for the throne by factions within his own country as well as without. Using powers reserved to Wakandan kings, T\'Challa assumes the Black Panther mantel to join with girlfriend Nakia, the queen-mother, his princess-kid sister, members of the Dora Milaje (the Wakandan \'special forces\') and an American secret agent, to prevent Wakanda from being dragged into a world war.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/uxzzxijgPIY7slzFvMotPv8wjKA.jpg', 'Black Panther', 7.4, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";i:3;s:15:\"Science Fiction\";}', 77, 284054, NULL, NULL, NULL, NULL),
(83, 'The Postcard Killings', NULL, '2020-03-13', 'A New York detective investigates the death of his daughter who was murdered while on her honeymoon in London and recruits the help of a Scandinavian journalist when other couples throughout Europe suffer a similar fate.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/iPOHjGttfXfPsqhhv6x0fv5rU1H.jpg', 'The Postcard Killings', 6.5, 1, 'a:3:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";i:2;s:7:\"Mystery\";}', 78, 449756, NULL, NULL, NULL, NULL),
(84, 'Pirates of the Caribbean: The Curse of the Black Pearl', NULL, '2003-07-09', 'Jack Sparrow, a freewheeling 18th-century pirate, quarrels with a rival pirate bent on pillaging Port Royal. When the governor\'s daughter is kidnapped, Sparrow decides to help the girl\'s love save her.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/z8onk7LV9Mmw6zKz4hT6pzzvmvl.jpg', 'Pirates of the Caribbean: The Curse of the Black Pearl', 7.7, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";}', 79, 22, NULL, NULL, NULL, NULL),
(85, 'Wonder Wheel', NULL, '2017-12-01', 'The story of four characters whose lives intertwine amid the hustle and bustle of the Coney Island amusement park in the 1950s: Ginny, an emotionally volatile former actress now working as a waitress in a clam house; Humpty, Ginny’s rough-hewn carousel operator husband; Mickey, a handsome young lifeguard who dreams of becoming a playwright; and Carolina, Humpty’s long-estranged daughter, who is now hiding out from gangsters at her father’s apartment.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/fPXn8SW4pa4kJErAIAJLmb3Znns.jpg', 'Wonder Wheel', 6.4, 1, 'a:1:{i:0;s:5:\"Drama\";}', 80, 429189, NULL, NULL, NULL, NULL),
(86, 'Love Wedding Repeat', NULL, '2020-04-10', 'While trying to make his sister\'s wedding day go smoothly, Jack finds himself juggling an angry ex-girlfriend, an uninvited guest with a secret, a misplaced sleep sedative, and the girl that got away in alternate versions of the same day.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/zn7feouGPU8sELez4qvpp0EtgeQ.jpg', 'Love Wedding Repeat', 5.7, 1, 'a:2:{i:0;s:6:\"Comedy\";i:1;s:7:\"Romance\";}', 81, 624808, NULL, NULL, NULL, NULL),
(87, 'Gladiator', NULL, '2000-05-01', 'In the year 180, the death of emperor Marcus Aurelius throws the Roman Empire into chaos.  Maximus is one of the Roman army\'s most capable and trusted generals and a key advisor to the emperor.  As Marcus\' devious son Commodus ascends to the throne, Maximus is set to be executed.  He escapes, but is captured by slave traders.  Renamed Spaniard and forced to become a gladiator, Maximus must battle to the death with other men for the amusement of paying audiences.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/dvKsQB84W2Sv6s7jpGmzQBVyQe3.jpg', 'Gladiator', 8.2, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:5:\"Drama\";}', 82, 98, NULL, NULL, NULL, NULL),
(88, 'It Chapter Two', NULL, '2019-09-04', '27 years after overcoming the malevolent supernatural entity Pennywise, the former members of the Losers\' Club, who have grown up and moved away from Derry, are brought back together by a devastating phone call.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/zfE0R94v1E8cuKAerbskfD3VfUt.jpg', 'It Chapter Two', 6.8, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:7:\"Fantasy\";i:2;s:6:\"Horror\";}', 83, 474350, NULL, NULL, NULL, NULL),
(89, 'The Hunger Games: Mockingjay - Part 1', NULL, '2014-11-19', 'Katniss Everdeen reluctantly becomes the symbol of a mass rebellion against the autocratic Capitol.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/4FAA18ZIja70d1Tu5hr5cj2q1sB.jpg', 'The Hunger Games: Mockingjay - Part 1', 6.8, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:15:\"Science Fiction\";i:2;s:8:\"Thriller\";}', 84, 131631, NULL, NULL, NULL, NULL),
(90, 'Dangerous Lies', NULL, '2020-04-30', 'After losing her waitressing job, Katie Franklin takes a job as a caretaker to a wealthy elderly man in his sprawling, empty Chicago estate. The two grow close, but when he unexpectedly passes away and names Katie as his sole heir, she and her husband Adam are pulled into a complex web of lies, deception, and murder. If she\'s going to survive, Katie will have to question everyone\'s motives — even the people she loves.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/x0g9tzgZKKmNEtwcjS3aF4kduRi.jpg', 'Dangerous Lies', 6.2, 1, 'a:1:{i:0;s:8:\"Thriller\";}', 85, 689723, NULL, NULL, NULL, NULL);
INSERT INTO `movies` (`id`, `title`, `author`, `release_date`, `overview`, `poster_path`, `original_title`, `rating`, `api_id`, `genres`, `most_popular`, `movie_id`, `top_rated`, `upcoming`, `latest`, `now_playing`) VALUES
(91, 'Captain America: Civil War', NULL, '2016-04-27', 'Following the events of Age of Ultron, the collective governments of the world pass an act designed to regulate all superhuman activity. This polarizes opinion amongst the Avengers, causing two factions to side with Iron Man or Captain America, which causes an epic battle between former allies.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/A6BCtWOv5R1X6DmklAuSM6OxnL9.jpg', 'Captain America: Civil War', 7.4, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 86, 271110, NULL, NULL, NULL, NULL),
(92, 'The Maze Runner', NULL, '2014-09-10', 'Set in a post-apocalyptic world, young Thomas is deposited in a community of boys after his memory is erased, soon learning they\'re all trapped in a maze that will require him to join forces with fellow “runners” for a shot at escape.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/ode14q7WtDugFDp78fo9lCsmay9.jpg', 'The Maze Runner', 7.1, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:7:\"Mystery\";i:2;s:15:\"Science Fiction\";i:3;s:8:\"Thriller\";}', 87, 198663, NULL, NULL, NULL, NULL),
(93, 'Pulp Fiction', NULL, '1994-09-10', 'A burger-loving hit man, his philosophical partner, a drug-addled gangster\'s moll and a washed-up boxer converge in this sprawling, comedic crime caper. Their adventures unfurl in three stories that ingeniously trip back and forth in time.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/d5iIlFn5s0ImszYzBPb8JPIfbXD.jpg', 'Pulp Fiction', 8.5, 1, 'a:2:{i:0;s:5:\"Crime\";i:1;s:8:\"Thriller\";}', 88, 680, NULL, NULL, NULL, NULL),
(94, 'Whiplash', NULL, '2014-10-10', 'Under the direction of a ruthless instructor, a talented young drummer begins to pursue perfection at any cost, even his humanity.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/qq8xf2SQqHifUUyc0k6Hj1065f1.jpg', 'Whiplash', 8.4, 1, 'a:2:{i:0;s:5:\"Drama\";i:1;s:5:\"Music\";}', 89, 244786, NULL, NULL, NULL, NULL),
(95, 'Avengers: Endgame', NULL, '2019-04-24', 'After the devastating events of Avengers: Infinity War, the universe is in ruins due to the efforts of the Mad Titan, Thanos. With the help of remaining allies, the Avengers must assemble once more in order to undo Thanos\' actions and restore order to the universe once and for all, no matter what consequences may be in store.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/or06FN3Dka5tukK1e9sl16pB3iy.jpg', 'Avengers: Endgame', 8.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 90, 299534, NULL, NULL, NULL, NULL),
(96, 'Iron Man', NULL, '2008-04-30', 'After being held captive in an Afghan cave, billionaire engineer Tony Stark creates a unique weaponized suit of armor to fight evil.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/78lPtwv72eTNqFW9COBYI0dWDJa.jpg', 'Iron Man', 7.6, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 91, 1726, NULL, NULL, NULL, NULL),
(97, 'Little Women', NULL, '2019-12-25', 'Four sisters come of age in America in the aftermath of the Civil War.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/yn5ihODtZ7ofn8pDYfxCmxh8AXI.jpg', 'Little Women', 7.9, 1, 'a:2:{i:0;s:5:\"Drama\";i:1;s:7:\"Romance\";}', 92, 331482, NULL, NULL, NULL, NULL),
(98, 'Toy Story 4', NULL, '2019-06-19', 'Woody has always been confident about his place in the world and that his priority is taking care of his kid, whether that\'s Andy or Bonnie. But when Bonnie adds a reluctant new toy called \"Forky\" to her room, a road trip adventure alongside old and new friends will show Woody how big the world can be for a toy.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/w9kR8qbmQ01HwnvK4alvnQ2ca0L.jpg', 'Toy Story 4', 7.6, 1, 'a:5:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Comedy\";i:3;s:7:\"Fantasy\";i:4;s:6:\"Family\";}', 93, 301528, NULL, NULL, NULL, NULL),
(99, 'John Wick: Chapter 3 - Parabellum', NULL, '2019-05-15', 'Super-assassin John Wick returns with a $14 million price tag on his head and an army of bounty-hunting killers on his trail. After killing a member of the shadowy international assassin’s guild, the High Table, John Wick is excommunicado, but the world’s most ruthless hit men and women await his every turn.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/ziEuG1essDuWuC5lpWUaw1uXY2O.jpg', 'John Wick: Chapter 3 - Parabellum', 7.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:5:\"Crime\";i:2;s:8:\"Thriller\";}', 94, 458156, NULL, NULL, NULL, NULL),
(100, 'Blade Runner', NULL, '1982-06-25', 'In the smog-choked dystopian Los Angeles of 2019, blade runner Rick Deckard is called out of retirement to terminate a quartet of replicants who have escaped to Earth seeking their creator for a way to extend their short life spans.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/vfzE3pjE5G7G7kcZWrA3fnbZo7V.jpg', 'Blade Runner', 7.9, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:15:\"Science Fiction\";i:2;s:8:\"Thriller\";}', 95, 78, NULL, NULL, NULL, NULL),
(101, 'Guardians of the Galaxy Vol. 2', NULL, '2017-04-19', 'The Guardians must fight to keep their newfound family together as they unravel the mysteries of Peter Quill\'s true parentage.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/y4MBh0EjBlMuOzv9axM4qJlmhzz.jpg', 'Guardians of the Galaxy Vol. 2', 7.6, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:6:\"Comedy\";i:3;s:15:\"Science Fiction\";}', 96, 283995, NULL, NULL, NULL, NULL),
(102, 'My Neighbor Totoro', NULL, '1988-04-16', 'Two sisters move to the country with their father in order to be closer to their hospitalized mother, and discover the surrounding trees are inhabited by Totoros, magical spirits of the forest. When the youngest runs away from home, the older sister seeks help from the spirits to find her.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/g6CsQ3xmalyrGzTSqmkZbNbHK3L.jpg', 'となりのトトロ', 8.1, 1, 'a:3:{i:0;s:9:\"Animation\";i:1;s:7:\"Fantasy\";i:2;s:6:\"Family\";}', 97, 8392, NULL, NULL, NULL, NULL),
(103, 'Fast & Furious Presents: Hobbs & Shaw', NULL, '2019-08-01', 'Ever since US Diplomatic Security Service Agent Hobbs and lawless outcast Shaw first faced off, they just have swapped smacks and bad words. But when cyber-genetically enhanced anarchist Brixton\'s ruthless actions threaten the future of humanity, both join forces to defeat him. (A spin-off of “The Fate of the Furious,” focusing on Johnson\'s Luke Hobbs and Statham\'s Deckard Shaw.)', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/qRyy2UmjC5ur9bDi3kpNNRCc5nc.jpg', 'Fast & Furious Presents: Hobbs & Shaw', 6.8, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:6:\"Comedy\";}', 98, 384018, NULL, NULL, NULL, NULL),
(104, 'Frozen', NULL, '2013-11-27', 'Young princess Anna of Arendelle dreams about finding true love at her sister Elsa’s coronation. Fate takes her on a dangerous journey in an attempt to end the eternal winter that has fallen over the kingdom. She\'s accompanied by ice delivery man Kristoff, his reindeer Sven, and snowman Olaf. On an adventure where she will find out what friendship, courage, family, and true love really means.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/yald8Lsb4uCRvjIH3spzR84Kdwf.jpg', 'Frozen', 7.3, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Family\";}', 99, 109445, NULL, NULL, NULL, NULL),
(105, 'Midway', NULL, '2019-11-06', 'The story of the Battle of Midway, and the leaders and soldiers who used their instincts, fortitude and bravery to overcome massive odds.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/hj8pyoNnynGeJTAbl7jcLZO8Uhx.jpg', 'Midway', 7, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:5:\"Drama\";i:2;s:7:\"History\";i:3;s:3:\"War\";}', 100, 522162, NULL, NULL, NULL, NULL),
(106, 'The Way Back', NULL, '2020-03-05', 'A former basketball all-star, who has lost his wife and family foundation in a struggle with addiction attempts to regain his soul and salvation by becoming the coach of a disparate ethnically mixed high school basketball team at his alma mater.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/zwgPO5bamUuajIAEc02q9XZ2qhq.jpg', 'The Way Back', 6.6, 1, 'a:1:{i:0;s:5:\"Drama\";}', 101, 529485, NULL, NULL, NULL, NULL),
(107, 'Justice League', NULL, '2017-11-15', 'Fuelled by his restored faith in humanity and inspired by Superman\'s selfless act, Bruce Wayne and Diana Prince assemble a team of metahumans consisting of Barry Allen, Arthur Curry and Victor Stone to face the catastrophic threat of Steppenwolf and the Parademons who are on the hunt for three Mother Boxes on Earth.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/eifGNCSDuxJeS1loAXil5bIGgvC.jpg', 'Justice League', 6.2, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";i:3;s:15:\"Science Fiction\";}', 102, 141052, NULL, NULL, NULL, NULL),
(108, 'My Spy', NULL, '2020-01-09', 'A hardened CIA operative finds himself at the mercy of a precocious 9-year-old girl, having been sent undercover to surveil her family.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/n2C6jRK9PtPIs99RQhKtqGlsnsO.jpg', 'My Spy', 7.1, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:6:\"Comedy\";i:2;s:6:\"Family\";}', 103, 592834, NULL, NULL, NULL, NULL),
(109, 'Deadpool 2', NULL, '2018-05-10', 'Wisecracking mercenary Deadpool battles the evil and powerful Cable and other bad guys to save a boy\'s life.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/to0spRl1CMDvyUbOnbb4fTk3VAd.jpg', 'Deadpool 2', 7.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:6:\"Comedy\";}', 104, 383498, NULL, NULL, NULL, NULL),
(110, 'Zootopia', NULL, '2016-02-11', 'Determined to prove herself, Officer Judy Hopps, the first bunny on Zootopia\'s police force, jumps at the chance to crack her first case - even if it means partnering with scam-artist fox Nick Wilde to solve the mystery.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/hlK0e0wAQ3VLuJcsfIYPvb4JVud.jpg', 'Zootopia', 7.7, 1, 'a:4:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Comedy\";i:3;s:6:\"Family\";}', 105, 269149, NULL, NULL, NULL, NULL),
(111, 'Harry Potter and the Deathly Hallows: Part 2', NULL, '2011-07-07', 'Harry, Ron and Hermione continue their quest to vanquish the evil Voldemort once and for all. Just as things begin to look hopeless for the young wizards, Harry discovers a trio of magical objects that endow him with powers to rival Voldemort\'s formidable skills.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/c54HpQmuwXjHq2C9wmoACjxoom3.jpg', 'Harry Potter and the Deathly Hallows: Part 2', 8.1, 1, 'a:2:{i:0;s:9:\"Adventure\";i:1;s:7:\"Fantasy\";}', 106, 12445, NULL, NULL, NULL, NULL),
(112, 'Expectant', NULL, '2020-04-25', 'A pregnant woman finds herself in serious danger when she agrees to live with the couple who plan to adopt her unborn child.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/a0pckz6ciRImDKJE355WjROSSPL.jpg', 'Expectant', 8.1, 1, 'a:1:{i:0;s:7:\"Mystery\";}', 107, 697741, NULL, NULL, NULL, NULL),
(113, 'No Country for Old Men', NULL, '2007-11-08', 'Llewelyn Moss stumbles upon dead bodies, $2 million and a hoard of heroin in a Texas desert, but methodical killer Anton Chigurh comes looking for it, with local sheriff Ed Tom Bell hot on his trail. The roles of prey and predator blur as the violent pursuit of money and justice collide.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/6d5XOczc226jECq0LIX0siKtgHR.jpg', 'No Country for Old Men', 7.9, 1, 'a:3:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";i:2;s:8:\"Thriller\";}', 108, 6977, NULL, NULL, NULL, NULL),
(114, 'Maleficent: Mistress of Evil', NULL, '2019-10-16', 'Maleficent and her goddaughter Aurora begin to question the complex family ties that bind them as they are pulled in different directions by impending nuptials, unexpected allies, and dark new forces at play.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/vloNTScJ3w7jwNwtNGoG8DbTThv.jpg', 'Maleficent: Mistress of Evil', 7.3, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:7:\"Fantasy\";i:2;s:6:\"Family\";}', 109, 420809, NULL, NULL, NULL, NULL),
(115, 'Avatar', NULL, '2009-12-10', 'In the 22nd century, a paraplegic Marine is dispatched to the moon Pandora on a unique mission, but becomes torn between following orders and protecting an alien civilization.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/btnl50ZDJDSCal2NLQIYWw0XxvH.jpg', 'Avatar', 7.4, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";i:3;s:15:\"Science Fiction\";}', 110, 19995, NULL, NULL, NULL, NULL),
(116, 'Fury', NULL, '2014-10-15', 'In the last months of World War II, as the Allies make their final push in the European theatre, a battle-hardened U.S. Army sergeant named \'Wardaddy\' commands a Sherman tank called \'Fury\' and its five-man crew on a deadly mission behind enemy lines. Outnumbered and outgunned, Wardaddy and his men face overwhelming odds in their heroic attempts to strike at the heart of Nazi Germany.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/pfte7wdMobMF4CVHuOxyu6oqeeA.jpg', 'Fury', 7.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:5:\"Drama\";i:2;s:3:\"War\";}', 111, 228150, NULL, NULL, NULL, NULL),
(117, 'The Godfather', NULL, '1972-03-14', 'Spanning the years 1945 to 1955, a chronicle of the fictional Italian-American Corleone crime family. When organized crime family patriarch, Vito Corleone barely survives an attempt on his life, his youngest son, Michael steps in to take care of the would-be killers, launching a campaign of bloody revenge.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/iVZ3JAcAjmguGPnRNfWFOtLHOuY.jpg', 'The Godfather', 8.7, 1, 'a:2:{i:0;s:5:\"Crime\";i:1;s:5:\"Drama\";}', 112, 238, NULL, NULL, NULL, NULL),
(118, 'Jurassic World: Fallen Kingdom', NULL, '2018-06-06', 'Three years after the demise of Jurassic World, a volcanic eruption threatens the remaining dinosaurs on the isla Nublar, so Claire Dearing, the former park manager, recruits Owen Grady to help prevent the extinction of the dinosaurs once again.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/c9XxwwhPHdaImA2f1WEfEsbhaFB.jpg', 'Jurassic World: Fallen Kingdom', 6.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 113, 351286, NULL, NULL, NULL, NULL),
(119, 'Birdman or (The Unexpected Virtue of Ignorance)', NULL, '2014-08-27', 'A fading actor best known for his portrayal of a popular superhero attempts to mount a comeback by appearing in a Broadway play. As opening night approaches, his attempts to become more altruistic, rebuild his career, and reconnect with friends and family prove more difficult than expected.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/lvWL5ZRlYFh7M7fOvYswcRqyprI.jpg', 'Birdman or (The Unexpected Virtue of Ignorance)', 7.5, 1, 'a:2:{i:0;s:6:\"Comedy\";i:1;s:5:\"Drama\";}', 114, 194662, NULL, NULL, NULL, NULL),
(120, 'The Martian', NULL, '2015-09-30', 'During a manned mission to Mars, Astronaut Mark Watney is presumed dead after a fierce storm and left behind by his crew. But Watney has survived and finds himself stranded and alone on the hostile planet. With only meager supplies, he must draw upon his ingenuity, wit and spirit to subsist and find a way to signal to Earth that he is alive.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/5BHuvQ6p9kfc091Z8RiFNhCwL4b.jpg', 'The Martian', 7.7, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:5:\"Drama\";i:2;s:15:\"Science Fiction\";}', 115, 286217, NULL, NULL, NULL, NULL),
(121, 'Spirited Away', NULL, '2001-07-20', 'A young girl, Chihiro, becomes trapped in a strange new world of spirits. When her parents undergo a mysterious transformation, she must call upon the courage she never knew she had to free her family.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/8Q2kDDyswBB8SPUJWfNlqvxdDFX.jpg', '千と千尋の神隠し', 8.5, 1, 'a:3:{i:0;s:9:\"Animation\";i:1;s:7:\"Fantasy\";i:2;s:6:\"Family\";}', 116, 129, NULL, NULL, NULL, NULL),
(122, 'Fight Club', NULL, '1999-10-15', 'A ticking-time-bomb insomniac and a slippery soap salesman channel primal male aggression into a shocking new form of therapy. Their concept catches on, with underground \"fight clubs\" forming in every town, until an eccentric gets in the way and ignites an out-of-control spiral toward oblivion.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/bptfVGEQuv6vDTIMVCHjJ9Dz8PX.jpg', 'Fight Club', 8.4, 1, 'a:1:{i:0;s:5:\"Drama\";}', 117, 550, NULL, NULL, NULL, NULL),
(123, 'Trainspotting', NULL, '1996-02-23', 'Mark Renton, deeply immersed in the Edinburgh drug scene, tries to clean up and get out, despite the allure of the drugs and influence of friends.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/6UTzw3kipgTYAJCX8GExoXzcVOx.jpg', 'Trainspotting', 8, 1, 'a:2:{i:0;s:5:\"Drama\";i:1;s:5:\"Crime\";}', 118, 627, NULL, NULL, NULL, NULL),
(124, 'Se7en', NULL, '1995-09-22', 'Two homicide detectives are on a desperate hunt for a serial killer whose crimes are based on the \"seven deadly sins\" in this dark and haunting film that takes viewers from the tortured remains of one victim to the next. The seasoned Det. Sommerset researches each sin in an effort to get inside the killer\'s mind, while his novice partner, Mills, scoffs at his efforts to unravel the case.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/6yoghtyTpznpBik8EngEmJskVUO.jpg', 'Se7en', 8.3, 1, 'a:3:{i:0;s:5:\"Crime\";i:1;s:7:\"Mystery\";i:2;s:8:\"Thriller\";}', 119, 807, NULL, NULL, NULL, NULL),
(125, 'Mad Max: Fury Road', NULL, '2015-05-13', 'An apocalyptic story set in the furthest reaches of our planet, in a stark desert landscape where humanity is broken, and most everyone is crazed fighting for the necessities of life. Within this world exist two rebels on the run who just might be able to restore order.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/sQuxceRcV3cxKH5CAnAUZe0qFKS.jpg', 'Mad Max: Fury Road', 7.5, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 120, 76341, NULL, NULL, NULL, NULL),
(126, 'The Avengers', NULL, '2012-04-25', 'When an unexpected enemy emerges and threatens global safety and security, Nick Fury, director of the international peacekeeping agency known as S.H.I.E.L.D., finds himself in need of a team to pull the world back from the brink of disaster. Spanning the globe, a daring recruitment effort begins!', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/RYMX2wcKCBAr24UyPD7xwmjaTn.jpg', 'The Avengers', 7.7, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 122, 24428, NULL, NULL, NULL, NULL),
(127, 'Gemini Man', NULL, '2019-10-02', 'Henry Brogan is an elite 51-year-old assassin who\'s ready to call it quits after completing his 72nd job. His plans get turned upside down when he becomes the target of a mysterious operative who can seemingly predict his every move. To his horror, Brogan soon learns that the man who\'s trying to kill him is a younger, faster, cloned version of himself.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/uTALxjQU8e1lhmNjP9nnJ3t2pRU.jpg', 'Gemini Man', 6.2, 1, 'a:2:{i:0;s:6:\"Action\";i:1;s:8:\"Thriller\";}', 123, 453405, NULL, NULL, NULL, NULL),
(128, 'Harry Potter and the Deathly Hallows: Part 1', NULL, '2010-10-17', 'Harry, Ron and Hermione walk away from their last year at Hogwarts to find and destroy the remaining Horcruxes, putting an end to Voldemort\'s bid for immortality. But with Harry\'s beloved Dumbledore dead and Voldemort\'s unscrupulous Death Eaters on the loose, the world is more dangerous than ever.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/iGoXIpQb7Pot00EEdwpwPajheZ5.jpg', 'Harry Potter and the Deathly Hallows: Part 1', 7.8, 1, 'a:2:{i:0;s:9:\"Adventure\";i:1;s:7:\"Fantasy\";}', 124, 12444, NULL, NULL, NULL, NULL),
(129, 'Contagion', NULL, '2011-09-08', 'As an epidemic of a lethal airborne virus - that kills within days - rapidly grows, the worldwide medical community races to find a cure and control the panic that spreads faster than the virus itself.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/qL0IooP0bjXy0KXl9KEyPo22ll0.jpg', 'Contagion', 6.5, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:15:\"Science Fiction\";i:2;s:8:\"Thriller\";}', 125, 39538, NULL, NULL, NULL, NULL),
(130, 'Alita: Battle Angel', NULL, '2019-01-31', 'When Alita awakens with no memory of who she is in a future world she does not recognize, she is taken in by Ido, a compassionate doctor who realizes that somewhere in this abandoned cyborg shell is the heart and soul of a young woman with an extraordinary past.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/xRWht48C2V8XNfzvPehyClOvDni.jpg', 'Alita: Battle Angel', 7, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 126, 399579, NULL, NULL, NULL, NULL),
(131, 'The Lodge', NULL, '2019-01-25', 'When a father is forced to abruptly depart for work, he leaves his children, Aidan and Mia, at their holiday home in the care of his new girlfriend, Grace. Isolated and alone, a blizzard traps them inside the lodge as terrifying events summon specters from Grace\'s dark past.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/yake2myhbW7c6dKbmwYDy1i40bm.jpg', 'The Lodge', 6.3, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:6:\"Horror\";i:2;s:8:\"Thriller\";}', 127, 474764, NULL, NULL, NULL, NULL),
(132, 'Alien', NULL, '1979-05-25', 'During its return to the earth, commercial spaceship Nostromo intercepts a distress signal from a distant planet. When a three-member team of the crew discovers a chamber containing thousands of eggs on the planet, a creature inside one of the eggs attacks an explorer. The entire crew is unaware of the impending nightmare set to descend upon them when the alien parasite planted inside its unfortunate host is birthed.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/vfrQk5IPloGg1v9Rzbh2Eg3VGyM.jpg', 'Alien', 8.1, 1, 'a:2:{i:0;s:6:\"Horror\";i:1;s:15:\"Science Fiction\";}', 128, 348, NULL, NULL, NULL, NULL),
(133, 'Rambo: Last Blood', NULL, '2019-09-19', 'After fighting his demons for decades, John Rambo now lives in peace on his family ranch in Arizona, but his rest is interrupted when Gabriela, the granddaughter of his housekeeper María, disappears after crossing the border into Mexico to meet her biological father. Rambo, who has become a true father figure for Gabriela over the years, undertakes a desperate and dangerous journey to find her.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/kTQ3J8oTTKofAVLYnds2cHUz9KO.jpg', 'Rambo: Last Blood', 6.2, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:5:\"Drama\";i:2;s:8:\"Thriller\";}', 129, 522938, NULL, NULL, NULL, NULL),
(134, 'Batman Begins', NULL, '2005-06-10', 'Driven by tragedy, billionaire Bruce Wayne dedicates his life to uncovering and defeating the corruption that plagues his home, Gotham City.  Unable to work within the system, he instead creates a new identity, a symbol of fear for the criminal underworld - The Batman.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/rdXILMlfINsio98WbUFoXTXPz5S.jpg', 'Batman Begins', 7.7, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:5:\"Crime\";i:2;s:5:\"Drama\";}', 130, 272, NULL, NULL, NULL, NULL),
(135, 'Schindler\'s List', NULL, '1993-11-30', 'The true story of how businessman Oskar Schindler saved over a thousand Jewish lives from the Nazis while they worked as slaves in his factory during World War II.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/c8Ass7acuOe4za6DhSattE359gr.jpg', 'Schindler\'s List', 8.6, 1, 'a:3:{i:0;s:5:\"Drama\";i:1;s:7:\"History\";i:2;s:3:\"War\";}', 131, 424, NULL, NULL, NULL, NULL),
(136, 'Dark Phoenix', NULL, '2019-06-05', 'The X-Men face their most formidable and powerful foe when one of their own, Jean Grey, starts to spiral out of control. During a rescue mission in outer space, Jean is nearly killed when she\'s hit by a mysterious cosmic force. Once she returns home, this force not only makes her infinitely more powerful, but far more unstable. The X-Men must now band together to save her soul and battle aliens that want to use Grey\'s new abilities to rule the galaxy.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/cCTJPelKGLhALq3r51A9uMonxKj.jpg', 'Dark Phoenix', 6, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 132, 320288, NULL, NULL, NULL, NULL),
(137, 'Avengers: Age of Ultron', NULL, '2015-04-22', 'When Tony Stark tries to jumpstart a dormant peacekeeping program, things go awry and Earth’s Mightiest Heroes are put to the ultimate test as the fate of the planet hangs in the balance. As the villainous Ultron emerges, it is up to The Avengers to stop him from enacting his terrible plans, and soon uneasy alliances and unexpected action pave the way for an epic and unique global adventure.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/4ssDuvEDkSArWEdyBl2X5EHvYKU.jpg', 'Avengers: Age of Ultron', 7.3, 1, 'a:3:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:15:\"Science Fiction\";}', 133, 99861, NULL, NULL, NULL, NULL),
(138, 'The Hunger Games: Catching Fire', NULL, '2013-11-15', 'Katniss Everdeen has returned home safe after winning the 74th Annual Hunger Games along with fellow tribute Peeta Mellark. Winning means that they must turn around and leave their family and close friends, embarking on a \"Victor\'s Tour\" of the districts. Along the way Katniss senses that a rebellion is simmering, but the Capitol is still very much in control as President Snow prepares the 75th Annual Hunger Games (The Quarter Quell) - a competition that could change Panem forever.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7c1JtraYsjMMnk8Md0IMoyRzqZJ.jpg', 'The Hunger Games: Catching Fire', 7.4, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:6:\"Action\";i:2;s:15:\"Science Fiction\";}', 134, 101299, NULL, NULL, NULL, NULL),
(139, 'Spider-Man: Into the Spider-Verse', NULL, '2018-12-06', 'Miles Morales is juggling his life between being a high school student and being a spider-man. When Wilson \"Kingpin\" Fisk uses a super collider, others from across the Spider-Verse are transported to this dimension.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/iiZZdoQBEYBv6id8su7ImL0oCbD.jpg', 'Spider-Man: Into the Spider-Verse', 8.4, 1, 'a:5:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:9:\"Animation\";i:3;s:6:\"Comedy\";i:4;s:15:\"Science Fiction\";}', 135, 324857, NULL, NULL, NULL, NULL),
(140, 'Spider-Man', NULL, '2002-05-01', 'After being bitten by a genetically altered spider, nerdy high school student Peter Parker is endowed with amazing powers to become the Amazing superhero known as Spider-Man.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/cqyN8Kt10wCrIUUZX7l5uDJIY0C.jpg', 'Spider-Man', 7.1, 1, 'a:2:{i:0;s:6:\"Action\";i:1;s:7:\"Fantasy\";}', 136, 557, NULL, NULL, NULL, NULL),
(141, 'Doctor Strange', NULL, '2016-10-25', 'After his career is destroyed, a brilliant but arrogant surgeon gets a new lease on life when a sorcerer takes him under her wing and trains him to defend the world against evil.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/gwi5kL7HEWAOTffiA14e4SbOGra.jpg', 'Doctor Strange', 7.4, 1, 'a:4:{i:0;s:6:\"Action\";i:1;s:9:\"Adventure\";i:2;s:7:\"Fantasy\";i:3;s:15:\"Science Fiction\";}', 137, 284052, NULL, NULL, NULL, NULL),
(142, 'Ralph Breaks the Internet', NULL, '2018-11-20', 'Video game bad guy Ralph and fellow misfit Vanellope von Schweetz must risk it all by traveling to the World Wide Web in search of a replacement part to save Vanellope\'s video game, Sugar Rush. In way over their heads, Ralph and Vanellope rely on the citizens of the internet — the netizens — to help navigate their way, including an entrepreneur named Yesss, who is the head algorithm and the heart and soul of trend-making site BuzzzTube.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/qEnH5meR381iMpmCumAIMswcQw2.jpg', 'Ralph Breaks the Internet', 7.2, 1, 'a:4:{i:0;s:9:\"Adventure\";i:1;s:9:\"Animation\";i:2;s:6:\"Comedy\";i:3;s:6:\"Family\";}', 138, 404368, NULL, NULL, NULL, NULL),
(143, 'Harry Potter and the Goblet of Fire', NULL, '2005-11-16', 'Harry starts his fourth year at Hogwarts, competes in the treacherous Triwizard Tournament and faces the evil Lord Voldemort. Ron and Hermione help Harry manage the pressure – but Voldemort lurks, awaiting his chance to destroy Harry and all that he stands for.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/fECBtHlr0RB3foNHDiCBXeg9Bv9.jpg', 'Harry Potter and the Goblet of Fire', 7.8, 1, 'a:3:{i:0;s:9:\"Adventure\";i:1;s:7:\"Fantasy\";i:2;s:6:\"Family\";}', 139, 674, NULL, NULL, NULL, NULL),
(144, 'Love The Way You Are', NULL, '2019-06-21', 'Opposites clash when spunky girl next door Lin Lin meets eccentric nerd Yuke. Despite being neighbors and schoolmates since childhood, Lin Lin and Yuke barely know each other. When the pair are both admitted into the same university, Lin Lin discovers that Yuke harbors a secret crush for campus beauty, Ruting. Ever the busybody, Lin Lin decides to matchmake Yuke and Ruting, only to find herself gradually falling for Yuke.', 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/7BC2Mv2ekyBIto68YOrc1DRARv6.jpg', '我的青春都是你', 4.1, 1, 'a:2:{i:0;s:6:\"Comedy\";i:1;s:7:\"Romance\";}', 140, 597295, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `birth_date` date NOT NULL,
  `register_date` date NOT NULL,
  `chat_banned_until` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `name`, `profile_picture`, `description`, `birth_date`, `register_date`, `chat_banned_until`) VALUES
(5, 'arlauskas.mar@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$cGRPVDUvUG5tRk1EanFjMg$lrzfHE/owhao63obm0jViRD/SzGgxygMyzwz3nK42Qo', 'Marius', '1587407090_Sword Art Online (76).jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis, provident et. Minima, quisquam. Est nemo dicta natus laboriosam id, soluta aliquid non!', '2000-03-02', '2020-03-30', '2019-05-22'),
(6, 'test@test.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$MzJFQVUyR0V4eE44WlVNNA$a1KPyHAFOSCqSZTZIXA4d/Yb+a+ZY9mHsEGW6NUDY7E', 'Vartotojas Jonas', NULL, NULL, '0000-00-00', '2020-03-30', NULL),
(7, 'admin@admin.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$c3ZFN21xc0Jrd2dLQThSMA$z4QpbLLQhi2WdeKeHVIaL2B/et/1O03xebsF+OnQwCg', 'Adminas', NULL, NULL, '0000-00-00', '2020-03-30', '2028-05-10'),
(9, 'zmogus@zmogus.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$dUIxVC8vYnRCYnBzbUU3aA$tRShuHT6IsoLLg8FGKdQx7ksfagwEikDiHc0GanmJgs', 'Žmogus', NULL, NULL, '2015-05-21', '2020-04-13', '2022-05-20'),
(12, 'band@band.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$cGRPVDUvUG5tRk1EanFjMg$lrzfHE/owhao63obm0jViRD/SzGgxygMyzwz3nK42Qo', 'Bandymas', '1589574989_sKx2t0U.jpg', 'Hello I\'m here from 2020-04-13', '1999-05-20', '2020-04-13', '2003-05-07'),
(13, 'random@random.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$UTVyNGJjeXVTY1F6VEdqeA$veZV3XhxpyXk4TJ0kz/Z1IMULfc7ORp1tsQKlrG3odQ', 'Kęstas', NULL, 'Hello I\'m here from 2020-04-16', '2020-01-07', '2020-04-16', NULL),
(14, 'demo@demo.com', '[\"ROLE_USER\"]', '$argon2i$v=19$m=65536,t=4,p=1$ZXVCaVR2RWZURFNtQUZzaQ$aIxfyKt/fFGiirKtIwwXKDbqw3Bw85ebe3RlmEXzuyk', 'Demonstracija', NULL, 'Hello I\'m here from 2020-05-15', '1994-05-19', '2020-05-15', NULL),
(15, 'vardas0@gmail.com', '[\"ROLE_USER\"]', '$2y$10$OLa..nIHmrJtnMcfBT2sauvu0hfonL7QTkvL57rP9kdrKamDzk9Ry', 'TestUser', NULL, 'Hello I\'m here from 2020-05-17', '2000-10-10', '2020-05-17', NULL),
(16, 'Vardas1@mail.com', '[\"ROLE_USER\"]', '$2y$10$idS0Q.7bnL6S4qaBQJU8EubLFc6JGWKkn/fdLOxeCOjBWDoYb2HMC', 'vardas1', NULL, 'Hello I\'m here from 2020-05-17', '2000-10-10', '2020-05-17', NULL),
(17, 'Vardas100@mail.com', '[\"ROLE_USER\"]', '$2y$10$IFvGZPNZZzeohpqYTmtu8.ADCqedpCrkQW8Wkq1AW5z4nVuI3pb2G', 'vardas1', NULL, 'Hello I\'m here from 2020-05-17', '2000-10-10', '2020-05-17', NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users_movies`
--

CREATE TABLE `users_movies` (
  `id` int(11) NOT NULL,
  `relation_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `api_id` int(11) NOT NULL,
  `is_favorite` tinyint(1) NOT NULL,
  `user_rating` int(11) DEFAULT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `users_movies`
--

INSERT INTO `users_movies` (`id`, `relation_type_id`, `user_id`, `movie_id`, `api_id`, `is_favorite`, `user_rating`, `date_added`) VALUES
(2, 1, 5, 338762, 1, 1, 5, '0000-00-00'),
(8, 5, 5, 508439, 1, 1, NULL, '0000-00-00'),
(12, 2, 6, 338762, 1, 1, NULL, '0000-00-00'),
(14, 1, 5, 419704, 1, 0, 5, '0000-00-00'),
(16, 5, 5, 495764, 1, 0, 10, '0000-00-00'),
(17, NULL, 5, 619264, 1, 1, NULL, '0000-00-00'),
(18, 3, 5, 772, 1, 1, 4, '0000-00-00'),
(20, 3, 5, 496243, 1, 0, 4, '0000-00-00'),
(21, 1, 5, 408647, 1, 1, NULL, '0000-00-00'),
(22, 1, 5, 157336, 1, 0, NULL, '0000-00-00'),
(23, NULL, 5, 299536, 1, 1, NULL, '0000-00-00'),
(24, 3, 5, 446893, 1, 0, NULL, '0000-00-00'),
(25, 1, 5, 920, 1, 1, 5, '0000-00-00'),
(26, 2, 5, 24021, 1, 0, NULL, '0000-00-00'),
(27, NULL, 9, 338762, 1, 1, NULL, '0000-00-00'),
(28, 2, 9, 495764, 1, 1, NULL, '0000-00-00'),
(29, 3, 9, 19543, 1, 0, 7, '0000-00-00'),
(30, 5, 9, 512200, 1, 0, 7, '0000-00-00'),
(31, 1, 9, 38700, 1, 1, NULL, '0000-00-00'),
(32, 4, 9, 419704, 1, 0, 1, '0000-00-00'),
(33, 3, 12, 338762, 1, 0, NULL, '0000-00-00'),
(34, 3, 12, 495764, 1, 1, 7, '0000-00-00'),
(35, NULL, 12, 38700, 1, 1, NULL, '0000-00-00'),
(36, 3, 12, 772, 1, 0, NULL, '0000-00-00'),
(37, 4, 12, 446893, 1, 0, NULL, '0000-00-00'),
(38, 2, 5, 16119, 1, 0, NULL, '0000-00-00'),
(39, 1, 5, 570670, 1, 0, NULL, '0000-00-00'),
(40, 1, 5, 475557, 1, 0, NULL, '0000-00-00'),
(41, 1, 5, 330457, 1, 0, NULL, '0000-00-00'),
(42, 1, 5, 522627, 1, 1, NULL, '0000-00-00'),
(44, 2, 5, 664767, 1, 0, NULL, '2020-04-26'),
(45, 1, 5, 614375, 1, 0, NULL, '2020-04-26'),
(47, 5, 5, 637920, 1, 0, NULL, '2020-04-26'),
(50, 3, 9, 443791, 1, 0, NULL, '2020-04-26'),
(51, 2, 9, 181812, 1, 0, NULL, '2020-04-26'),
(52, 4, 9, 466622, 1, 0, NULL, '2020-04-26'),
(53, 2, 5, 443791, 1, 0, NULL, '2020-04-26'),
(54, 2, 7, 443791, 1, 0, NULL, '2020-04-26'),
(55, 4, 7, 614375, 1, 0, NULL, '2020-04-26'),
(56, 3, 5, 545609, 1, 0, NULL, '2020-05-05'),
(57, 3, 5, 454626, 1, 0, NULL, '2020-05-05'),
(59, NULL, 5, 181812, 1, 1, NULL, '2020-05-05'),
(66, 2, 14, 419704, 1, 0, NULL, '2020-05-16'),
(67, NULL, 14, 454626, 1, 1, NULL, '2020-05-16'),
(68, 4, 14, 338762, 1, 0, NULL, '2020-05-16'),
(69, 1, 14, 117084, 1, 1, NULL, '2020-05-16'),
(70, 1, 14, 545609, 1, 0, NULL, '2020-05-16'),
(72, 3, 5, 618344, 1, 0, NULL, '2020-05-17'),
(73, NULL, 5, 530915, 1, 1, NULL, '2020-05-17');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users_movies_relation_types`
--

CREATE TABLE `users_movies_relation_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `users_movies_relation_types`
--

INSERT INTO `users_movies_relation_types` (`id`, `name`) VALUES
(1, 'Planning'),
(2, 'Watching'),
(3, 'Completed'),
(4, 'Dropped'),
(5, 'Paused');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apis`
--
ALTER TABLE `apis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`api_id`,`genre_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`user_id`,`movie_id`,`parent_id`,`shared_api_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`most_popular`,`movie_id`,`top_rated`,`upcoming`,`latest`,`now_playing`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- Indexes for table `users_movies`
--
ALTER TABLE `users_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`relation_type_id`,`user_id`,`movie_id`,`api_id`);

--
-- Indexes for table `users_movies_relation_types`
--
ALTER TABLE `users_movies_relation_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apis`
--
ALTER TABLE `apis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_movies`
--
ALTER TABLE `users_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users_movies_relation_types`
--
ALTER TABLE `users_movies_relation_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

DELIMITER $$
--
-- Įvykiai
--
CREATE DEFINER=`root`@`localhost` EVENT `moviesTruncate` ON SCHEDULE EVERY 1 HOUR STARTS '2020-04-05 14:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
DELETE FROM movies;
ALTER TABLE movies AUTO_INCREMENT=1;
END$$

CREATE DEFINER=`root`@`localhost` EVENT `truncate genres` ON SCHEDULE EVERY 1 HOUR STARTS '2020-04-12 10:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
DELETE FROM genres;
ALTER TABLE genres AUTO_INCREMENT=1;
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
