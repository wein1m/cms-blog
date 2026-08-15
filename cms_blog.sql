-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2026 at 08:35 AM
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
-- Database: `cms_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `img_cover` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `title`, `slug`, `content`, `img_cover`, `created_at`, `id_kategori`) VALUES
(2, 'Villains Are Destined to Die Manhwa Gets Animated Adaptation', 'villains-are-destined-to-die-manhwa-gets-animated-adaptation', '<p>Japanese digital comic platform Piccoma today announced that an animated TV adaptation of SUOL\'s <strong><em>Villains Are Destined to Die</em></strong> manhwa, which adapted Gwon Gyeoeul\'s original web novel, is in production. It is unconfirmed if the adaptation is a Japanese production, and further details are yet to be revealed.</p><p><br></p><p>Yen Press publishes the <strong><em>Villains Are Destined to Die</em></strong> manhwa in English and describes the story:</p><p><br></p><p><em>Playing Daughter of the Dukeâ€™s Super Love Project as the easy mode heroine, Ivonne, makes charming the male characters a breeze. But once you switch to hard mode and step into the shoes of Penelope, the misunderstood villain, itâ€™s nearly impossible to even stay alive! So imagine the shock of suddenly waking up in Penelopeâ€™s bodyâ€”you know right away that your life is on the line. With love interests who will kill you if their affection meters drop too low and the inability to speak without choosing from pre-selected dialogue, it quickly becomes clear that Penelopeâ€™s chances have been rigged from the startâ€”and this villain might just be destined to die!</em></p>', 'https://a.storyblok.com/f/178900/1280x720/f9202b80c5/villains-are-destined-to-die-header.jpg/m/576x0/filters:quality(95)format(webp)', '2026-08-11 13:19:35', 1),
(3, 'Star Detective Precure! Anime Film Announces Three Guest Cast Members', 'star-detective-precure-anime-film-announces-three-guest-cast-members', '<p><a href=\"https://2026.precure-movie.com/news/?p=335\" rel=\"noopener noreferrer\" target=\"_blank\">The official website</a> for <strong><em>Eiga Meitantei Precure! Fushigina Niwa to Futari no Himitsu</em></strong> (<em>Star Detective Precure! The Movie: The Mysterious Garden and the Secret of the Two</em>) revealed the guest voice actors who will play the film\'s three original characters. The feature film based on the 23rd and current Precure TV series, <strong><em><a href=\"https://www.crunchyroll.com/series/GT00369409/star-detective-precure?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=detective-precure_en&amp;referrer=news_cr_editorial_cr_detective-precure_en\" rel=\"noopener noreferrer\" target=\"_blank\">Star Detective Precure!</a></em></strong>, is scheduled to open in Japan on <strong>September 18, 2026</strong>.</p><p><br></p><p><strong>Akari Kito</strong> (Nezuko Kamado in <strong><em><a href=\"https://www.crunchyroll.com/series/GY5P48XEY/demon-slayer-kimetsu-no-yaiba?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\">Demon Slayer: Kimetsu no Yaiba</a></em></strong><a href=\"https://www.crunchyroll.com/series/GY5P48XEY/demon-slayer-kimetsu-no-yaiba?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\"> </a>is cast as Karin, the girl who holds the key to the story; <strong>Nobunaga Shimazaki</strong> (Haruka Nanase in <strong><em><a href=\"https://www.crunchyroll.com/series/GRDQV2VWY/free---iwatobi-swim-club?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\">Free! - Iwatobi Swim Club</a> </em></strong>plays Alan, the fairy who watches over her; and <strong>Koki Uchiyama</strong> (Toge Inumaki in <strong><em><a href=\"https://www.crunchyroll.com/series/GRDV0019R/jujutsu-kaisen?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\">JUJUTSU KAISEN</a> </em></strong>portrays Rain, the fairy client who comes to the CUREtto Detective Agency with a request. While this marks the first appearance in the Precure series for Kito and Shimazaki, Uchiyama previously voiced a guest character named Yuya Kaito in Episode 32 and 40 of <strong><em>HappinessCharge Precure!</em></strong> (2014).</p><p><br></p><p>The latest clip featuring Karin, Alan, and Rain, played by the three of them, has been released.</p><p><br></p><p>Furthermore, a new visual has been released showing Cure Answer reaching out her hand to Karin, while Alan and Rain look on.</p><p><br></p><p>Hanako Ueda, an episode director for <strong><em>Wonderful Precure!</em></strong> and<strong><em>You and Idol Precure</em></strong>, is directing the <strong><em>Star Detective Precure!</em></strong> feature film with a screenplay by Yoshimi Narita, the series composition writer for <strong><em><a href=\"https://www.crunchyroll.com/series/GVDHX85JN/precure-splash-star?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\">Precure Splash Star</a></em></strong> (2006â€“2007), <strong><em><a href=\"https://www.crunchyroll.com/series/GKEH2G054/yes-precure-5?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\">Yes! Precure 5</a></em></strong> (2007â€“2008), and <strong><em>Wonderful Precure! </em></strong>Emiko Yoshimoto, the character designer for <strong><em><a href=\"https://www.crunchyroll.com/series/G1XHJV04W/witchy-precure?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\">Witchy Precure!</a></em></strong> (2016â€“2017), serves as the character designer and chief animation director for the film.</p>', 'https://a.storyblok.com/f/178900/960x540/be3a7827eb/detective-precure-film-guest-voice-cast.jpg/m/576x0/filters:quality(95)format(webp)', '2026-08-11 13:23:08', 1),
(4, 'DIGIMON BEATBREAK Anime Releases Asuka Arc Key Visual', 'digimon-beatbreak-anime-releases-asuka-arc-key-visual', '<p>The <strong><em><a href=\"https://www.crunchyroll.com/series/GT00364378/digimon-beatbreak?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=news_en&amp;referrer=news_cr_editorial_cr_news\" rel=\"noopener noreferrer\" target=\"_blank\">DIGIMON BEATBREAK</a></em></strong> TV anime will enter its final chapter, the Asuka Arc, starting with episode 42, which airs on August 9 in Japan. Ahead of the broadcast, the key visual for the final chapter has been released. </p><p><br></p><p>In the visual, Tomoro Tenma (CV: Miyu Irino) and Gekkomon (CV: Megumi Han) are reaching out their hands toward Tomoro\'s older brother, Auska Tenma (CV: Kazuya Nakai), who has been Cold Hearted. The tagline on the visual reads: \"Seize Tomorrow.\"</p><p><br></p><p><u>Episode 42 synopsis:</u></p><p><em>Tomoro went to visit the hospital, taking along Kyo, who wanted to see Asuka for the first time in a while. On the way to the hospital, Kyo begins to talk about memories with Asuka that even Tomoro did not know. Hidden within those stories was the secret of Cougarmon\'s birth.</em></p><p><br></p><p>Additionally, to commemorate the anime\'s entering its final chapter, a special anime music video condensing episodes 1 through the latest episode 41 has been released. Set to the opening theme song <strong>\"Mad Pulse\"</strong> performed by MADKID, the video looks back on Glowing Dawn\'s journey so far.</p>', 'https://a.storyblok.com/f/178900/960x540/8287f725d1/digimon-beatbreak-episode42-1.jpg/m/576x0/filters:quality(95)format(webp)', '2026-08-11 13:25:24', 1),
(5, 'Gachiakutaâ€™s Fumihiko Suganuma and Aoi Ishikawa Discuss the Importance of Vital Things Coming to an End', 'gachiakuta-s-fumihiko-suganuma-and-aoi-ishikawa-discuss-the-importance-of-vital-things-coming-to-an-end', '<p><strong><em><a href=\"https://www.crunchyroll.com/series/GP5HJ84P7/gachiakuta?utm_source=news_cr&amp;utm_medium=editorial_cr&amp;utm_campaign=gachiakuta_en&amp;referrer=news_cr_editorial_cr_gachiakuta_en\" rel=\"noopener noreferrer\" target=\"_blank\">Gachiakuta</a> </em></strong>is a unique take on the phrase, \"One man\'s trash is another man\'s treasure.\" Focusing on a young boy named Rudo, he himself is literally discarded like trash, only to find support amongst the garbage heaps he\'s forced to survive in. But <strong><em>Gachiakuta </em></strong>is more than a found family narrative; it\'s a solid reminder that what one person considers to be trash can very well still have some value in it.</p><p><br></p><p>According to anime director Fumihiko Suganuma and Rudo\'s Japanese voice actor Aoi Ishikawa, that is a core theme of the anime, but there\'s another, more hidden theme, one that suggests that, at some point, all things must come to an end.</p><p><br></p><p>During our interview at Anime Expo 2026, the two spoke about the importance of the journey, what makes something vital and how part of its significance is the fact that, eventually, it\'ll come to an end. Oh, and of course, the two revealed what their vital instruments would be. Check out the interview below!</p><p><br></p><p><strong>NOTE:</strong> This interview was interpreted by Rika Takahashi Chen and has been edited for clarity.</p><p><br></p><p><strong>Before we begin, I have to say congratulations for all the recognition <em>Gachiakuta</em> received at this yearâ€™s Anime Awards. It won â€œBest New Series,â€ â€œBest Character Design,â€ â€œBest Background Artâ€ and was nominated for several different awards as well. Whatâ€™s it been like seeing the reception to <em>Gachiakuta</em>?</strong></p><p><br></p><p><strong>Fumihiko Suganuma:</strong> To be honest, I didn\'t think we were gonna win that many awards so I was surprised, and I also feel very pressured as a result. This was the first series that I was the director for, and I really feel that it\'s not just me, but the entire staff, especially since such a big studio picked me up to do the series. I felt like I had a really good time, and it was a great experience for me.</p>', 'https://a.storyblok.com/f/178900/960x540/fa77968686/gachiakuta-episode-21.jpg/m//576x0/filters:quality(95)format(webp)', '2026-08-12 12:41:32', 2),
(6, 'Danganronpa 2x2 Writer Kazutaka Kodaka and Producer Shohei Sakakibara on Developing the Remake', 'danganronpa-2x2-writer-kazutaka-kodaka-and-producer-shohei-sakakibara-on-developing-the-remake', '<p>The <strong><em>Danganronpa </em></strong>series has cultivated a passionate fan following since the series landed in 2010. The concept of seeing talented kids forced into a death game really enraptured us. With themes of hope, betrayal, and truth, <strong><em>Danganronpa </em></strong>kept us sticking through the many sequels, spin-offs, anime adaptations, and light novels that expanded the universeâ€™s lore over the years.</p><p><br></p><p>Now, developer Spike Chunsoft is revisiting the series with <strong><em>Danganronpa 2x2</em></strong>, a retelling of the second game, <strong><em>Danganronpa 2: Goodbye Despair</em></strong>, complete with a brand new alternative storyline called Slayhem thatâ€™s even longer than the original.</p><p><br></p><p>At Anime Expo 2026, I spoke with writer Kazutaka Kodaka and producer Shohei Sakakibara about their reasons for returning to <strong><em>Danganronpa 2</em></strong>, more details regarding Slayhem, and crafting <strong><em>2x2</em></strong>â€™s new 3D roaming world.</p><p><br></p><p><strong>Why did you choose to expand on <em>Danganronpa 2</em> in particular, as opposed to the first <em>Danganronpa </em>or <em>Danganronpa V3</em>?</strong></p><p><strong>Sakakibara</strong>: We did originally consider the first <strong><em>Danganronpa </em></strong>as the base of this remake, but then looking at the series and premise, it didn\'t feel that it may work with new scenarios and whatnot. After evaluation, we concluded that <strong><em>Danganronpa 2</em></strong> would best fit what we wanted to make in <strong><em>2x2</em></strong>.</p>', 'https://a.storyblok.com/f/178900/960x540/b5738164ac/danganronpa-2x2-hajime-and-nagito.png/m/576x0/filters:quality(95)format(webp)', '2026-08-12 14:01:44', 2);

-- --------------------------------------------------------

--
-- Table structure for table `artikel_tag`
--

CREATE TABLE `artikel_tag` (
  `artikel_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `artikel_tag`
--

INSERT INTO `artikel_tag` (`artikel_id`, `tag_id`) VALUES
(2, 1),
(2, 3),
(2, 6),
(2, 7),
(3, 1),
(3, 6),
(3, 7),
(4, 1),
(4, 6),
(4, 8),
(5, 1),
(5, 2),
(5, 6),
(5, 8),
(6, 1),
(6, 2),
(6, 6),
(6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `name`) VALUES
(1, 'News'),
(2, 'Interviews'),
(3, 'Reviews'),
(4, 'Stories');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Anime'),
(2, 'Manga'),
(3, 'Manhwa'),
(4, 'Manhua'),
(5, 'Movie'),
(6, 'TV Series'),
(7, 'Romance'),
(8, 'Action'),
(9, 'Slice of Life');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `artikel_tag`
--
ALTER TABLE `artikel_tag`
  ADD PRIMARY KEY (`artikel_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `artikel_tag`
--
ALTER TABLE `artikel_tag`
  ADD CONSTRAINT `artikel_tag_ibfk_1` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `artikel_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
