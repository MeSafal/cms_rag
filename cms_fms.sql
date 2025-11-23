-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2025 at 01:51 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articles_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articles_id`, `title`, `subtitle`, `alias`, `parent`, `cover`, `thumb`, `description`, `entries`, `remarks`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'The Evolution of Industrial Robotics: Visobotics\' Journey', 'From Manual Labor to Automated Precision', 'the-evolution-of-industrial-robotics-visobotics-journey', NULL, 'storage/photos/1/Robo/horizontal6.jpg', 'storage/photos/1/Robo/square2.jpg,storage/photos/1/Robo/vertical1.jpg', '<p>The story of industrial robotics is a tale of innovation, resilience, and transformative impact&mdash;and at the heart of this journey is Visobotics. From rudimentary mechanical arms to intelligent autonomous systems, the evolution of robotics has redefined how industries operate, and Visobotics has played a pivotal role in shaping this trajectory.</p>\r\n\r\n<p>In the early days, industrial robots were designed for repetitive, high-risk tasks&mdash;primarily in automotive and heavy manufacturing. These machines were isolated in cages, programmed to perform singular motions with limited flexibility. While effective, they lacked adaptability and required significant human oversight.</p>\r\n\r\n<p>Visobotics entered the scene with a vision: to make robots smarter, safer, and truly collaborative. Our commitment to innovation led to the integration of advanced sensors, machine learning algorithms, and real-time data analytics into robotic systems. As a result, today&#39;s Visobotics robots are not just machines&mdash;they&#39;re intelligent partners that adapt, learn, and evolve within dynamic environments.</p>\r\n\r\n<p>This article explores the major technological milestones Visobotics has achieved over the years. From multi-axis manipulators with AI-powered vision systems to mobile robots navigating complex facilities, we highlight how each breakthrough has pushed the boundaries of what&#39;s possible in automation.</p>\r\n\r\n<p>Beyond the technology, our journey also reflects a shift in philosophy. We believe robotics is not about replacing humans&mdash;it&#39;s about augmenting their potential. Visobotics has worked closely with manufacturers, warehouse operators, and logistics companies to develop solutions that enhance efficiency while maintaining human oversight and safety.</p>\r\n\r\n<p>As we look toward the future, our focus is on hyper-automation, predictive maintenance, and fully autonomous production ecosystems. The journey of industrial robotics is far from over&mdash;and with Visobotics leading the charge, the next chapter promises even greater possibilities.</p>', NULL, NULL, 'The Evolution of Industrial Robotics: Visobotics\' Journey', 'industrial robotics, Visobotics, automation, manufacturing robots', 'Explore the transformative journey of industrial robotics and Visobotics\' pivotal role in advancing automation technologies.', 3, 1, '1', '1', '2025-05-17 03:18:34', '2025-05-16 21:55:10'),
(2, 'Collaborative Robots: Enhancing Human-Robot Synergy', 'The Rise of Cobots in Modern Industries', 'collaborative-robots-enhancing-human-robot-synergy', NULL, 'storage/photos/1/Robo/horizontal3.jpg', 'storage/photos/1/Robo/vertical6.jpg,storage/photos/1/Robo/vertical4.jpg', '<p>The future of automation lies not in isolation, but in collaboration. At Visobotics, we believe the next generation of robotics is not about replacing humans&mdash;it&rsquo;s about working alongside them. This belief drives our commitment to advancing <strong>collaborative robots</strong>, or <strong>cobots</strong>, that are engineered to operate in shared spaces, enhance human productivity, and create safer, smarter workflows.</p>\r\n\r\n<p>Unlike traditional industrial robots that were confined behind safety cages and programmed for repetitive tasks, cobots are designed to work in tandem with humans. They are equipped with sophisticated sensors, force-limiting joints, and AI-driven decision-making capabilities that allow them to perceive their environment, understand context, and adjust actions accordingly.</p>\r\n\r\n<p>This article delves into how Visobotics has developed a new generation of collaborative robots tailored for real-world applications across manufacturing, logistics, healthcare, and more. We highlight key features such as vision-guided assistance, natural language interaction, gesture recognition, and real-time learning&mdash;capabilities that allow our cobots to seamlessly blend into human-centric workflows.</p>\r\n\r\n<p>At the heart of Visobotics&#39; cobot technology is <strong>synergy</strong>&mdash;the idea that human intuition and machine precision, when combined, can produce outcomes far superior to either alone. From assisting in high-precision assembly lines to supporting technicians with heavy material handling, our collaborative robots are reshaping how tasks are executed.</p>\r\n\r\n<p>We also explore the psychological and cultural dimensions of cobot adoption. Trust, comfort, and seamless user experience are critical for human-robot interaction, and our design process integrates feedback from real users to ensure intuitive operation and meaningful assistance.</p>\r\n\r\n<p>As industries evolve, the demand for safe, intelligent, and flexible robotic teammates is growing. Visobotics is at the forefront of this shift, pioneering the development of collaborative systems that not only improve efficiency but also empower the workforce of the future.</p>', NULL, NULL, 'Collaborative Robots: Enhancing Human-Robot Synergy', 'collaborative robots, cobots, Visobotics, human-robot collaboration', 'Discover how Visobotics\' collaborative robots are enhancing human-robot synergy across various industries.', 1, 1, '1', '1', '2025-05-17 03:18:34', '2025-05-16 23:37:05'),
(3, 'AI Integration in Robotics: Visobotics\' Smart Solutions', 'Harnessing Artificial Intelligence for Advanced Automation', 'ai-integration-in-robotics-visobotics-smart-solutions', NULL, 'storage/photos/1/Robo/horizontal5.jpg', 'storage/photos/1/Robo/vertical7.jpg,storage/photos/1/Robo/vertical3.jpg', '<p>Artificial Intelligence is no longer a distant frontier&mdash;it&rsquo;s the backbone of the most transformative robotics systems in the world today. At Visobotics, we have fully embraced AI as the core enabler of intelligent, adaptive, and self-improving robotic solutions. This article explores how our AI-powered robotics are setting new standards for performance, perception, and autonomy across industries.</p>\r\n\r\n<p>Traditional robots, while efficient, were constrained by fixed programming and predictable environments. Their performance depended on precise pre-defined instructions and lacked the ability to adapt to real-time changes. The integration of AI has radically shifted this paradigm. Visobotics robots now possess the ability to <strong>see, learn, reason, and make decisions</strong>&mdash;in real time.</p>\r\n\r\n<p>From computer vision systems that allow robots to interpret their surroundings with human-like clarity, to reinforcement learning algorithms that enable task optimization over time, our smart solutions are built for fluid and complex environments. Whether it&#39;s navigating a dynamic warehouse, detecting anomalies on a production line, or collaborating with human operators in unpredictable conditions&mdash;Visobotics robots continuously adapt, making them exponentially more valuable than static automation systems.</p>\r\n\r\n<p>The article also showcases specific AI features developed by Visobotics, such as real-time object recognition, voice-guided task execution, edge computing for low-latency responses, and cloud-based behavioral learning. These technologies empower our robots to perform with higher efficiency, lower error rates, and better operational foresight.</p>\r\n\r\n<p>But we don&#39;t stop at technical integration. Our approach to AI in robotics is grounded in <strong>ethical design, safety-first development, and transparent decision-making logic</strong>. We ensure every AI model used in our systems undergoes rigorous testing, bias assessment, and continuous updates to remain accurate and trustworthy.</p>\r\n\r\n<p>AI isn&rsquo;t just a feature at Visobotics&mdash;it&rsquo;s a philosophy. One that&rsquo;s redefining the role of robotics in manufacturing, logistics, healthcare, and beyond. With AI at their core, Visobotics&rsquo; smart robots are not just tools&mdash;they&rsquo;re intelligent teammates leading the future of work.</p>', NULL, NULL, 'AI Integration in Robotics: Visobotics\' Smart Solutions', 'AI robotics, Visobotics, smart automation, artificial intelligence', 'Explore how Visobotics integrates AI into robotics to develop smart, adaptive automation solutions.', 2, 1, '1', '1', '2025-05-17 03:18:34', '2025-05-16 21:55:10'),
(4, 'Robotics in Healthcare: Visobotics\' Contributions', 'Enhancing Patient Care through Automation', 'robotics-in-healthcare-visobotics-contributions', NULL, 'storage/photos/1/Robo/horizontal3.jpg', 'storage/photos/1/Robo/vertical5.jpg,storage/photos/1/Robo/vertical2.jpg', '<p>The healthcare industry is undergoing a profound transformation fueled by cutting-edge technology, and robotics stands at the forefront of this revolution. At Visobotics, we are proud to contribute significantly to the integration of advanced robotic systems that enhance patient care, streamline medical procedures, and improve overall healthcare outcomes.</p>\r\n\r\n<p>This article explores the multifaceted role that robotics plays within modern healthcare and highlights Visobotics&rsquo; innovative solutions that are shaping the future of medical technology. From surgical assistants that offer unparalleled precision to rehabilitation robots that accelerate patient recovery, our systems are designed to augment healthcare professionals&rsquo; skills and extend their capabilities.</p>\r\n\r\n<p>Visobotics&rsquo; healthcare robots are equipped with state-of-the-art sensors, AI-driven analytics, and intuitive user interfaces, enabling them to perform complex tasks such as minimally invasive surgeries, remote diagnostics, and patient monitoring. Our solutions not only increase the accuracy and efficiency of medical procedures but also reduce human error and fatigue&mdash;ultimately leading to better patient outcomes.</p>\r\n\r\n<p>Beyond the operating room, Visobotics has developed robotic platforms that support elderly care, including mobility assistance, medication management, and social engagement through interactive features. These robots foster independence and improve quality of life for seniors, addressing critical challenges in aging populations worldwide.</p>\r\n\r\n<p>The article also emphasizes our commitment to safety, ethics, and regulatory compliance, ensuring all healthcare robots meet stringent standards for reliability and patient privacy. Collaboration with medical experts and continuous feedback loops drive our iterative development process, making Visobotics a trusted partner in healthcare innovation.</p>\r\n\r\n<p>As healthcare demands grow increasingly complex, Visobotics remains dedicated to pushing the boundaries of what robotics can achieve. Our contributions are not just technological advancements&mdash;they are catalysts for a healthier, more accessible future for patients and providers alike.</p>', NULL, NULL, 'Robotics in Healthcare: Visobotics\' Contributions', 'healthcare robotics, Visobotics, medical automation, surgical robots', 'Discover Visobotics\' contributions to healthcare through surgical assistance, rehabilitation, and diagnostics.', 4, 1, '1', '1', '2025-05-17 03:18:34', '2025-05-16 22:01:41'),
(5, 'Autonomous Navigation: How Visobotics Powers Smart Mobility', 'The Next Frontier in Robotic Transportation', 'autonomous-navigation-how-visobotics-powers-smart-mobility', NULL, 'storage/photos/1/Robo/horizontal4.jpg', 'storage/photos/1/Robo/vertical6.jpg,storage/photos/1/Robo/vertical3.jpg', '<p>In an era where automation and mobility intersect, autonomous navigation is revolutionizing how robots move, interact, and perform tasks in dynamic environments. At Visobotics, we are pioneers in developing smart mobility solutions that empower robots with precise, reliable, and adaptive navigation capabilities.</p>\r\n\r\n<p>This article delves into the core technologies and innovations behind Visobotics&rsquo; autonomous navigation systems. Utilizing advanced sensors such as LiDAR, cameras, ultrasonic detectors, and GPS, our robots construct detailed maps of their surroundings, detect obstacles, and plan optimal routes in real time. The integration of AI and machine learning algorithms allows these systems to continuously improve navigation efficiency and decision-making, even in complex and unpredictable settings.</p>\r\n\r\n<p>Visobotics&rsquo; autonomous robots are deployed across industries including warehousing, manufacturing, logistics, and public services, where they handle material transport, inspection, and delivery with minimal human intervention. Our navigation technology supports a variety of platforms, from compact indoor mobile robots to rugged outdoor vehicles, ensuring flexibility and scalability.</p>\r\n\r\n<p>Beyond technical sophistication, Visobotics prioritizes safety and reliability. Our autonomous systems are built with redundant fail-safes, emergency stop protocols, and human-robot interaction frameworks that guarantee smooth coexistence in shared workspaces. This makes our smart mobility solutions not only efficient but also trusted partners in critical operational environments.</p>\r\n\r\n<p>The article also explores how autonomous navigation contributes to operational cost savings, increased productivity, and sustainability by optimizing energy consumption and reducing downtime. Visobotics is committed to driving the future of mobility with systems that adapt intelligently to changing conditions and user needs.</p>\r\n\r\n<p>As industries embrace Industry 4.0, Visobotics stands at the forefront of smart mobility innovation, powering a new generation of autonomous robots that transform how goods and services move through space.</p>', NULL, NULL, 'Autonomous Navigation: How Visobotics Powers Smart Mobility', 'autonomous robots, smart navigation, Visobotics, AI mobility', 'Learn how Visobotics leads the field in autonomous navigation and AI-powered robotic mobility.', 5, 1, '1', '1', '2025-05-17 03:18:34', '2025-05-16 22:03:01'),
(6, 'The Intelligence Behind Every Move', NULL, 'the-intelligence-behind-every-move', NULL, NULL, NULL, '<p>Precision meets possibility in a world powered by robotics. At Visobotics, we don&rsquo;t just build machines&mdash;we engineer intelligence, streamline industries, and shape the future. Our creations are not replacements, but reinforcements&mdash;smart, reliable, and human-centric. From factory floors to surgical suites, we&rsquo;re redefining what&rsquo;s possible through innovation, automation, and a relentless pursuit of excellence.</p>', NULL, NULL, NULL, NULL, NULL, 7, 1, '1', '1', '2025-05-16 22:32:16', '2025-05-16 22:36:44'),
(7, 'The Intelligence Behind Every Move', NULL, 'the-intelligence-behind-every-move', NULL, NULL, NULL, '<blockquote>\r\n<p><em><span style=\"font-size:18px\"><span style=\"color:#cc0099\"><tt><span style=\"font-family:Comic Sans MS,cursive\"><strong>The future doesn&rsquo;t wait&mdash;it&rsquo;s built. At Visobotics, we turn vision into motion, and motion into progress. When innovation leads, possibilities follow.</strong></span></tt></span></span></em></p>\r\n</blockquote>', NULL, NULL, NULL, NULL, NULL, 6, 1, '1', '1', '2025-05-16 22:36:26', '2025-05-16 22:44:18'),
(8, 'NeuroStride X9', 'Adaptive Neuro-Motion Bipedal Bot', 'neurostride-x9', NULL, 'storage/photos/1/Robo/horizontal2.jpg', 'storage/photos/1/Robo/vertical6.jpg,storage/photos/1/Robo/horizontal8.png', '<p>NeuroStride X9 is Visobotics&rsquo; flagship bipedal robot designed to mimic human gait with astonishing accuracy using a deep learning-powered neuromotor system. It adapts to terrain in real-time, balances on uneven surfaces, and can perform complex movements like climbing stairs or pivot turns. Ideal for research, security patrol, or even high-engagement retail scenarios, it blends precision engineering with graceful kinetics. Designed to operate with minimal supervision, NeuroStride is a step closer to redefining mobility.</p>', NULL, NULL, NULL, NULL, NULL, 8, 1, '1', '1', '2025-05-17 05:33:42', '2025-05-17 05:35:28'),
(9, 'Robo Quote', NULL, 'robo-quote', NULL, 'storage/photos/1/Robo/horizontal2.jpg', NULL, '<blockquote>\r\n<p><span style=\"color:#9b59b6\"><em><strong><span style=\"font-family:Courier New,Courier,monospace\"><span style=\"font-size:18px\">We don&rsquo;t wait for the future&mdash;we engineer it. At Visobotics, every circuit, every code, every motion is a step toward a smarter, stronger, and more connected world.</span></span></strong></em></span></p>\r\n</blockquote>', NULL, NULL, NULL, NULL, NULL, 9, 1, '1', '1', '2025-05-17 05:41:34', '2025-05-17 05:41:34'),
(10, '🤖 Steelcore Dominion', 'The Alpha-Class Autonomous Combat & Heavy Ops Unit', 'name-steelcore-dominion', NULL, NULL, 'storage/photos/1/Robo/horizontal2.jpg', '<p><strong>Uncompromising. Unstoppable. Unmatched.</strong><br />\r\n<em>Steelcore Dominion</em> is the apex of Visobotics engineering&mdash;a titan forged for the toughest environments and most demanding operations. With a reinforced titanium alloy exoskeleton, AI-driven threat assessment, and hydraulic limbs capable of lifting over 1,000 kg, this beast isn&rsquo;t just a robot&mdash;it&rsquo;s a force of nature.</p>\r\n\r\n<p>Equipped with terrain-adaptive mobility, modular weapon and tool mounts, and autonomous decision protocols, Steelcore dominates military zones, disaster recovery fields, and industrial extremes alike. Whether it&rsquo;s breaching, hauling, or defending, it executes with military-grade precision and raw mechanical muscle.</p>\r\n\r\n<p>It doesn&rsquo;t hesitate. It doesn&rsquo;t break. It doesn&rsquo;t back down.<br />\r\n<strong>Steelcore Dominion is where human strategy meets robotic supremacy.</strong></p>', NULL, NULL, NULL, NULL, NULL, 10, 1, '1', '1', '2025-05-17 05:44:34', '2025-05-17 05:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blogs_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blogs_id`, `title`, `subtitle`, `author`, `alias`, `parent`, `cover`, `thumb`, `description`, `entries`, `remarks`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'How Robotics Is Redefining the Future of Manufacturing', 'The Smart Revolution in Production Lines', 'Admin', 'how-robotics-is-redefining-future-manufacturing', NULL, 'images/blogs/robotics-manufacturing.jpg', 'storage/photos/1/Robo/horizontal8.png', '<p>Manufacturing has always been at the heart of innovation, but in the age of smart machines, it is transforming like never before. This blog dives into the journey of automation in manufacturing and how robotics&mdash;especially at Visobotics&mdash;is enabling production that is faster, safer, and more scalable.</p>', NULL, NULL, 'How Robotics Is Redefining the Future of Manufacturing', 'robotics, manufacturing automation, Visobotics', 'Explore how Visobotics is transforming the manufacturing sector with cutting-edge robotics and intelligent systems.', 1, 1, '1', '1', NULL, '2025-05-17 06:25:36'),
(2, 'Top Trends in Robotics for 2025 and Beyond', 'Visobotics’ Predictions for the Future of Automation', 'Admin', 'top-trends-in-robotics-2025-and-beyond', NULL, 'images/blogs/robotics-trends-2025.jpg', 'images/blogs/thumbs/robotics-trends-2025.jpg', 'As the robotics industry matures, trends evolve fast. In this blog, we cover the most exciting directions robotics is headed—from AI-infused mobility systems to biodegradable robot components. Visobotics weighs in with expert analysis on what the next five years will bring.', 'The future includes swarm robotics, surgical microbots, and socially aware assistance bots. With examples from Visobotics labs, the blog offers an insider’s view into innovations already underway.', NULL, 'Top Trends in Robotics for 2025 and Beyond', 'robotic trends, future of robotics, Visobotics', 'Discover upcoming trends shaping robotics in 2025 and how Visobotics is staying ahead of the curve.', 2, 1, '1', '1', NULL, '2025-05-17 03:19:43'),
(3, 'Visobotics Behind the Scenes: Engineering Our Flagship Robot', 'A Deep Dive into Design, Code, and Performance', 'Admin', 'visobotics-behind-the-scenes-flagship-robot', NULL, 'images/blogs/visobotics-engineering.jpg', 'images/blogs/thumbs/visobotics-engineering.jpg', 'Go behind the curtain and discover how Visobotics engineered its flagship robotic model—from CAD sketches and AI model training to prototyping and deployment. This blog covers everything from sensor fusion to mechanical agility.', 'We also spotlight the team behind the project and share exclusive footage of the robot performing in high-pressure industrial scenarios. It’s more than machinery—it’s a symbol of innovation done right.', NULL, 'Visobotics Behind the Scenes: Our Flagship Robot', 'robot design, Visobotics engineering, AI robot development', 'Get an exclusive look into the engineering of Visobotics’ flagship robotic system from concept to market.', 3, 1, '1', '1', NULL, '2025-05-17 03:19:43'),
(4, 'The Role of Robotics in Smart Cities', 'How Visobotics Enhances Urban Efficiency and Security', 'Admin', 'role-of-robotics-in-smart-cities', NULL, 'images/blogs/smart-city-robotics.jpg', 'images/blogs/thumbs/smart-city-robotics.jpg', 'As urban populations grow, cities must become smarter—and robotics is playing a key role in that transformation. This blog explores how Visobotics solutions are being integrated into urban infrastructure to optimize traffic, enhance public safety, and manage logistics.', 'Topics include autonomous surveillance drones, robotic street cleaners, delivery bots, and AI-enabled traffic systems—all tested and deployed by Visobotics in pilot programs across smart city zones.', NULL, 'The Role of Robotics in Smart Cities', 'smart cities, robotics, urban automation, Visobotics', 'Learn how Visobotics is driving smart city innovation through urban robotic deployment and intelligent automation.', 4, 1, '1', '1', NULL, '2025-05-17 03:19:43'),
(5, 'Robotics and Sustainability: A Greener Tomorrow with Visobotics', 'How Automation Supports the Environment', 'Admin', 'robotics-and-sustainability-greener-tomorrow-visobotics', NULL, 'images/blogs/robotics-sustainability.jpg', 'images/blogs/thumbs/robotics-sustainability.jpg', 'Environmental sustainability and technology are often seen as opposites—but at Visobotics, we believe robotics can be a powerful ally in creating a greener future. This blog explores how our automation reduces energy use, improves recycling systems, and cuts down industrial emissions.', 'We also present use cases where Visobotics-powered farming bots reduce water waste, and how factory robots contribute to circular manufacturing processes.', NULL, 'Robotics and Sustainability: A Greener Tomorrow with Visobotics', 'green robotics, sustainable tech, Visobotics, eco robots', 'See how Visobotics is making robotics part of the global solution to sustainability challenges.', 5, 1, '1', '1', NULL, '2025-05-17 03:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `buttons`
--

CREATE TABLE `buttons` (
  `buttons_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '_self',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:3:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";}s:11:\"permissions\";a:140:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:17:\"unisharp.lfm.show\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"dashboard\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"error\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"profile.edit\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:14:\"profile.update\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"profile.destroy\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"articles.index\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"articles.create\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"articles.store\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"articles.edit\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"articles.update\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"articles.view\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"articles.delete\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"articles.alias\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"articles.publish\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:20:\"articles.updateOrder\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"roles.index\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:11:\"roles.store\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:10:\"roles.edit\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"roles.update\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:10:\"roles.view\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"roles.delete\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"roles.alias\";s:1:\"c\";s:3:\"web\";}i:23;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"roles.publish\";s:1:\"c\";s:3:\"web\";}i:24;a:3:{s:1:\"a\";i:25;s:1:\"b\";s:17:\"roles.updateOrder\";s:1:\"c\";s:3:\"web\";}i:25;a:3:{s:1:\"a\";i:26;s:1:\"b\";s:14:\"settings.index\";s:1:\"c\";s:3:\"web\";}i:26;a:3:{s:1:\"a\";i:27;s:1:\"b\";s:15:\"settings.create\";s:1:\"c\";s:3:\"web\";}i:27;a:3:{s:1:\"a\";i:28;s:1:\"b\";s:14:\"settings.store\";s:1:\"c\";s:3:\"web\";}i:28;a:3:{s:1:\"a\";i:29;s:1:\"b\";s:13:\"settings.edit\";s:1:\"c\";s:3:\"web\";}i:29;a:3:{s:1:\"a\";i:30;s:1:\"b\";s:15:\"settings.update\";s:1:\"c\";s:3:\"web\";}i:30;a:3:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";}i:31;a:3:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"settings.delete\";s:1:\"c\";s:3:\"web\";}i:32;a:3:{s:1:\"a\";i:33;s:1:\"b\";s:14:\"settings.alias\";s:1:\"c\";s:3:\"web\";}i:33;a:3:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"settings.publish\";s:1:\"c\";s:3:\"web\";}i:34;a:3:{s:1:\"a\";i:35;s:1:\"b\";s:20:\"settings.updateOrder\";s:1:\"c\";s:3:\"web\";}i:35;a:3:{s:1:\"a\";i:36;s:1:\"b\";s:11:\"users.index\";s:1:\"c\";s:3:\"web\";}i:36;a:3:{s:1:\"a\";i:37;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";}i:37;a:3:{s:1:\"a\";i:38;s:1:\"b\";s:11:\"users.store\";s:1:\"c\";s:3:\"web\";}i:38;a:3:{s:1:\"a\";i:39;s:1:\"b\";s:10:\"users.edit\";s:1:\"c\";s:3:\"web\";}i:39;a:3:{s:1:\"a\";i:40;s:1:\"b\";s:12:\"users.update\";s:1:\"c\";s:3:\"web\";}i:40;a:3:{s:1:\"a\";i:41;s:1:\"b\";s:10:\"users.view\";s:1:\"c\";s:3:\"web\";}i:41;a:3:{s:1:\"a\";i:42;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";}i:42;a:3:{s:1:\"a\";i:43;s:1:\"b\";s:11:\"users.alias\";s:1:\"c\";s:3:\"web\";}i:43;a:3:{s:1:\"a\";i:44;s:1:\"b\";s:13:\"users.publish\";s:1:\"c\";s:3:\"web\";}i:44;a:3:{s:1:\"a\";i:45;s:1:\"b\";s:17:\"users.updateOrder\";s:1:\"c\";s:3:\"web\";}i:45;a:3:{s:1:\"a\";i:46;s:1:\"b\";s:11:\"menus.index\";s:1:\"c\";s:3:\"web\";}i:46;a:3:{s:1:\"a\";i:47;s:1:\"b\";s:12:\"menus.create\";s:1:\"c\";s:3:\"web\";}i:47;a:3:{s:1:\"a\";i:48;s:1:\"b\";s:11:\"menus.store\";s:1:\"c\";s:3:\"web\";}i:48;a:3:{s:1:\"a\";i:49;s:1:\"b\";s:10:\"menus.edit\";s:1:\"c\";s:3:\"web\";}i:49;a:3:{s:1:\"a\";i:50;s:1:\"b\";s:12:\"menus.update\";s:1:\"c\";s:3:\"web\";}i:50;a:3:{s:1:\"a\";i:51;s:1:\"b\";s:10:\"menus.view\";s:1:\"c\";s:3:\"web\";}i:51;a:3:{s:1:\"a\";i:52;s:1:\"b\";s:12:\"menus.delete\";s:1:\"c\";s:3:\"web\";}i:52;a:3:{s:1:\"a\";i:53;s:1:\"b\";s:11:\"menus.alias\";s:1:\"c\";s:3:\"web\";}i:53;a:3:{s:1:\"a\";i:54;s:1:\"b\";s:13:\"menus.publish\";s:1:\"c\";s:3:\"web\";}i:54;a:3:{s:1:\"a\";i:55;s:1:\"b\";s:17:\"menus.updateOrder\";s:1:\"c\";s:3:\"web\";}i:55;a:3:{s:1:\"a\";i:56;s:1:\"b\";s:11:\"blogs.index\";s:1:\"c\";s:3:\"web\";}i:56;a:3:{s:1:\"a\";i:57;s:1:\"b\";s:12:\"blogs.create\";s:1:\"c\";s:3:\"web\";}i:57;a:3:{s:1:\"a\";i:58;s:1:\"b\";s:11:\"blogs.store\";s:1:\"c\";s:3:\"web\";}i:58;a:3:{s:1:\"a\";i:59;s:1:\"b\";s:10:\"blogs.edit\";s:1:\"c\";s:3:\"web\";}i:59;a:3:{s:1:\"a\";i:60;s:1:\"b\";s:12:\"blogs.update\";s:1:\"c\";s:3:\"web\";}i:60;a:3:{s:1:\"a\";i:61;s:1:\"b\";s:10:\"blogs.view\";s:1:\"c\";s:3:\"web\";}i:61;a:3:{s:1:\"a\";i:62;s:1:\"b\";s:12:\"blogs.delete\";s:1:\"c\";s:3:\"web\";}i:62;a:3:{s:1:\"a\";i:63;s:1:\"b\";s:11:\"blogs.alias\";s:1:\"c\";s:3:\"web\";}i:63;a:3:{s:1:\"a\";i:64;s:1:\"b\";s:13:\"blogs.publish\";s:1:\"c\";s:3:\"web\";}i:64;a:3:{s:1:\"a\";i:65;s:1:\"b\";s:17:\"blogs.updateOrder\";s:1:\"c\";s:3:\"web\";}i:65;a:3:{s:1:\"a\";i:66;s:1:\"b\";s:13:\"sliders.index\";s:1:\"c\";s:3:\"web\";}i:66;a:3:{s:1:\"a\";i:67;s:1:\"b\";s:14:\"sliders.create\";s:1:\"c\";s:3:\"web\";}i:67;a:3:{s:1:\"a\";i:68;s:1:\"b\";s:13:\"sliders.store\";s:1:\"c\";s:3:\"web\";}i:68;a:3:{s:1:\"a\";i:69;s:1:\"b\";s:12:\"sliders.edit\";s:1:\"c\";s:3:\"web\";}i:69;a:3:{s:1:\"a\";i:70;s:1:\"b\";s:14:\"sliders.update\";s:1:\"c\";s:3:\"web\";}i:70;a:3:{s:1:\"a\";i:71;s:1:\"b\";s:12:\"sliders.view\";s:1:\"c\";s:3:\"web\";}i:71;a:3:{s:1:\"a\";i:72;s:1:\"b\";s:14:\"sliders.delete\";s:1:\"c\";s:3:\"web\";}i:72;a:3:{s:1:\"a\";i:73;s:1:\"b\";s:13:\"sliders.alias\";s:1:\"c\";s:3:\"web\";}i:73;a:3:{s:1:\"a\";i:74;s:1:\"b\";s:15:\"sliders.publish\";s:1:\"c\";s:3:\"web\";}i:74;a:3:{s:1:\"a\";i:75;s:1:\"b\";s:19:\"sliders.updateOrder\";s:1:\"c\";s:3:\"web\";}i:75;a:3:{s:1:\"a\";i:76;s:1:\"b\";s:20:\"menuCategories.index\";s:1:\"c\";s:3:\"web\";}i:76;a:3:{s:1:\"a\";i:77;s:1:\"b\";s:21:\"menuCategories.create\";s:1:\"c\";s:3:\"web\";}i:77;a:3:{s:1:\"a\";i:78;s:1:\"b\";s:20:\"menuCategories.store\";s:1:\"c\";s:3:\"web\";}i:78;a:3:{s:1:\"a\";i:79;s:1:\"b\";s:19:\"menuCategories.edit\";s:1:\"c\";s:3:\"web\";}i:79;a:3:{s:1:\"a\";i:80;s:1:\"b\";s:21:\"menuCategories.update\";s:1:\"c\";s:3:\"web\";}i:80;a:3:{s:1:\"a\";i:81;s:1:\"b\";s:19:\"menuCategories.view\";s:1:\"c\";s:3:\"web\";}i:81;a:3:{s:1:\"a\";i:82;s:1:\"b\";s:21:\"menuCategories.delete\";s:1:\"c\";s:3:\"web\";}i:82;a:3:{s:1:\"a\";i:83;s:1:\"b\";s:20:\"menuCategories.alias\";s:1:\"c\";s:3:\"web\";}i:83;a:3:{s:1:\"a\";i:84;s:1:\"b\";s:22:\"menuCategories.publish\";s:1:\"c\";s:3:\"web\";}i:84;a:3:{s:1:\"a\";i:85;s:1:\"b\";s:26:\"menuCategories.updateOrder\";s:1:\"c\";s:3:\"web\";}i:85;a:3:{s:1:\"a\";i:86;s:1:\"b\";s:11:\"pages.index\";s:1:\"c\";s:3:\"web\";}i:86;a:3:{s:1:\"a\";i:87;s:1:\"b\";s:12:\"pages.create\";s:1:\"c\";s:3:\"web\";}i:87;a:3:{s:1:\"a\";i:88;s:1:\"b\";s:11:\"pages.store\";s:1:\"c\";s:3:\"web\";}i:88;a:3:{s:1:\"a\";i:89;s:1:\"b\";s:10:\"pages.edit\";s:1:\"c\";s:3:\"web\";}i:89;a:3:{s:1:\"a\";i:90;s:1:\"b\";s:12:\"pages.update\";s:1:\"c\";s:3:\"web\";}i:90;a:3:{s:1:\"a\";i:91;s:1:\"b\";s:10:\"pages.view\";s:1:\"c\";s:3:\"web\";}i:91;a:3:{s:1:\"a\";i:92;s:1:\"b\";s:12:\"pages.delete\";s:1:\"c\";s:3:\"web\";}i:92;a:3:{s:1:\"a\";i:93;s:1:\"b\";s:11:\"pages.alias\";s:1:\"c\";s:3:\"web\";}i:93;a:3:{s:1:\"a\";i:94;s:1:\"b\";s:13:\"pages.publish\";s:1:\"c\";s:3:\"web\";}i:94;a:3:{s:1:\"a\";i:95;s:1:\"b\";s:17:\"pages.updateOrder\";s:1:\"c\";s:3:\"web\";}i:95;a:3:{s:1:\"a\";i:96;s:1:\"b\";s:15:\"pages.showChild\";s:1:\"c\";s:3:\"web\";}i:96;a:3:{s:1:\"a\";i:97;s:1:\"b\";s:19:\"pages.fetch.content\";s:1:\"c\";s:3:\"web\";}i:97;a:3:{s:1:\"a\";i:98;s:1:\"b\";s:13:\"buttons.index\";s:1:\"c\";s:3:\"web\";}i:98;a:3:{s:1:\"a\";i:99;s:1:\"b\";s:14:\"buttons.create\";s:1:\"c\";s:3:\"web\";}i:99;a:3:{s:1:\"a\";i:100;s:1:\"b\";s:13:\"buttons.store\";s:1:\"c\";s:3:\"web\";}i:100;a:3:{s:1:\"a\";i:101;s:1:\"b\";s:12:\"buttons.edit\";s:1:\"c\";s:3:\"web\";}i:101;a:3:{s:1:\"a\";i:102;s:1:\"b\";s:14:\"buttons.update\";s:1:\"c\";s:3:\"web\";}i:102;a:3:{s:1:\"a\";i:103;s:1:\"b\";s:12:\"buttons.view\";s:1:\"c\";s:3:\"web\";}i:103;a:3:{s:1:\"a\";i:104;s:1:\"b\";s:14:\"buttons.delete\";s:1:\"c\";s:3:\"web\";}i:104;a:3:{s:1:\"a\";i:105;s:1:\"b\";s:13:\"buttons.alias\";s:1:\"c\";s:3:\"web\";}i:105;a:3:{s:1:\"a\";i:106;s:1:\"b\";s:15:\"buttons.publish\";s:1:\"c\";s:3:\"web\";}i:106;a:3:{s:1:\"a\";i:107;s:1:\"b\";s:19:\"buttons.updateOrder\";s:1:\"c\";s:3:\"web\";}i:107;a:3:{s:1:\"a\";i:108;s:1:\"b\";s:23:\"buttons.getTemplateData\";s:1:\"c\";s:3:\"web\";}i:108;a:3:{s:1:\"a\";i:109;s:1:\"b\";s:15:\"templates.index\";s:1:\"c\";s:3:\"web\";}i:109;a:3:{s:1:\"a\";i:110;s:1:\"b\";s:16:\"templates.create\";s:1:\"c\";s:3:\"web\";}i:110;a:3:{s:1:\"a\";i:111;s:1:\"b\";s:15:\"templates.store\";s:1:\"c\";s:3:\"web\";}i:111;a:3:{s:1:\"a\";i:112;s:1:\"b\";s:14:\"templates.edit\";s:1:\"c\";s:3:\"web\";}i:112;a:3:{s:1:\"a\";i:113;s:1:\"b\";s:16:\"templates.update\";s:1:\"c\";s:3:\"web\";}i:113;a:3:{s:1:\"a\";i:114;s:1:\"b\";s:14:\"templates.view\";s:1:\"c\";s:3:\"web\";}i:114;a:3:{s:1:\"a\";i:115;s:1:\"b\";s:16:\"templates.delete\";s:1:\"c\";s:3:\"web\";}i:115;a:3:{s:1:\"a\";i:116;s:1:\"b\";s:15:\"templates.alias\";s:1:\"c\";s:3:\"web\";}i:116;a:3:{s:1:\"a\";i:117;s:1:\"b\";s:17:\"templates.publish\";s:1:\"c\";s:3:\"web\";}i:117;a:3:{s:1:\"a\";i:118;s:1:\"b\";s:21:\"templates.updateOrder\";s:1:\"c\";s:3:\"web\";}i:118;a:3:{s:1:\"a\";i:119;s:1:\"b\";s:18:\"templates.all-data\";s:1:\"c\";s:3:\"web\";}i:119;a:3:{s:1:\"a\";i:120;s:1:\"b\";s:16:\"templates.parent\";s:1:\"c\";s:3:\"web\";}i:120;a:3:{s:1:\"a\";i:121;s:1:\"b\";s:17:\"templates.getData\";s:1:\"c\";s:3:\"web\";}i:121;a:3:{s:1:\"a\";i:122;s:1:\"b\";s:21:\"templates.getChildren\";s:1:\"c\";s:3:\"web\";}i:122;a:3:{s:1:\"a\";i:123;s:1:\"b\";s:24:\"templates.updateChildren\";s:1:\"c\";s:3:\"web\";}i:123;a:3:{s:1:\"a\";i:124;s:1:\"b\";s:22:\"templates.childPublish\";s:1:\"c\";s:3:\"web\";}i:124;a:3:{s:1:\"a\";i:125;s:1:\"b\";s:23:\"templates.fetchChildren\";s:1:\"c\";s:3:\"web\";}i:125;a:3:{s:1:\"a\";i:126;s:1:\"b\";s:17:\"navigations.index\";s:1:\"c\";s:3:\"web\";}i:126;a:3:{s:1:\"a\";i:127;s:1:\"b\";s:18:\"navigations.create\";s:1:\"c\";s:3:\"web\";}i:127;a:3:{s:1:\"a\";i:128;s:1:\"b\";s:17:\"navigations.store\";s:1:\"c\";s:3:\"web\";}i:128;a:3:{s:1:\"a\";i:129;s:1:\"b\";s:16:\"navigations.edit\";s:1:\"c\";s:3:\"web\";}i:129;a:3:{s:1:\"a\";i:130;s:1:\"b\";s:18:\"navigations.update\";s:1:\"c\";s:3:\"web\";}i:130;a:3:{s:1:\"a\";i:131;s:1:\"b\";s:16:\"navigations.view\";s:1:\"c\";s:3:\"web\";}i:131;a:3:{s:1:\"a\";i:132;s:1:\"b\";s:18:\"navigations.delete\";s:1:\"c\";s:3:\"web\";}i:132;a:3:{s:1:\"a\";i:133;s:1:\"b\";s:17:\"navigations.alias\";s:1:\"c\";s:3:\"web\";}i:133;a:3:{s:1:\"a\";i:134;s:1:\"b\";s:19:\"navigations.publish\";s:1:\"c\";s:3:\"web\";}i:134;a:3:{s:1:\"a\";i:135;s:1:\"b\";s:23:\"navigations.updateOrder\";s:1:\"c\";s:3:\"web\";}i:135;a:3:{s:1:\"a\";i:136;s:1:\"b\";s:24:\"navigations.fetchContent\";s:1:\"c\";s:3:\"web\";}i:136;a:3:{s:1:\"a\";i:137;s:1:\"b\";s:19:\"navigations.getData\";s:1:\"c\";s:3:\"web\";}i:137;a:3:{s:1:\"a\";i:138;s:1:\"b\";s:8:\"register\";s:1:\"c\";s:3:\"web\";}i:138;a:3:{s:1:\"a\";i:139;s:1:\"b\";s:5:\"login\";s:1:\"c\";s:3:\"web\";}i:139;a:3:{s:1:\"a\";i:140;s:1:\"b\";s:6:\"logout\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:0:{}}', 1747679587);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `contents_id` bigint UNSIGNED NOT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `child_id` bigint UNSIGNED DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`contents_id`, `template_id`, `child_id`, `entries`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 24, 29, '[\"Slider:1\",\"Slider:2\",\"Slider:5\"]', 1, 1, '1', '1', '2025-05-16 20:32:17', '2025-05-18 10:27:21'),
(2, 24, 27, '[\"MenuCategory:1\",\"MenuCategory:2\",\"MenuCategory:3\"]', 2, 1, '1', '1', '2025-05-16 21:03:20', '2025-05-16 21:07:42'),
(3, 24, 25, '[\"Article:3\"]', 3, 1, '1', '1', '2025-05-16 21:37:48', '2025-05-16 21:54:39'),
(4, 24, 28, '[\"Article:2\",\"Article:1\"]', 4, 1, '1', '1', '2025-05-16 21:51:20', '2025-05-16 21:54:39'),
(5, 61, 28, '[\"Article:4\",\"Article:5\"]', 5, 1, '1', '1', '2025-05-16 22:00:21', '2025-05-16 22:03:21'),
(6, 61, 59, '[\"Slider:10\"]', 6, 1, '1', '1', '2025-05-16 22:04:37', '2025-05-16 22:26:45'),
(7, 61, 58, '[\"Article:6\",\"Article:7\"]', 7, 1, '1', '1', '2025-05-16 22:32:16', '2025-05-16 22:44:18'),
(8, 63, 12, '[\"Article:8\"]', 8, 1, '1', '1', '2025-05-17 05:33:42', '2025-05-17 05:35:28'),
(9, 63, 64, '[\"Article:9\"]', 9, 1, '1', '1', '2025-05-17 05:42:48', '2025-05-17 05:42:48'),
(10, 63, 13, '[\"Article:10\"]', 10, 1, '1', '1', '2025-05-17 05:44:34', '2025-05-17 05:49:08'),
(11, 63, 14, '[\"Slider:3\"]', 11, 1, '1', '1', '2025-05-17 05:58:08', '2025-05-17 06:00:50'),
(12, 65, 10, '[]', 12, 1, '1', '1', '2025-05-17 06:17:19', '2025-05-17 06:24:01'),
(13, 65, 14, '[\"Slider:4\"]', 13, 1, '1', '1', '2025-05-17 06:24:01', '2025-05-17 06:24:01'),
(14, 65, 4, '[\"Blog:1\"]', 14, 1, '1', '1', '2025-05-17 06:25:36', '2025-05-17 06:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `labels_id` bigint UNSIGNED NOT NULL,
  `en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `np` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`labels_id`, `en`, `alias`, `np`, `hi`, `status`, `display_order`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Visobotics', NULL, NULL, NULL, 1, 1, '1', '1', NULL, NULL),
(2, 'Dashboard', NULL, NULL, NULL, 1, 2, '1', '1', NULL, NULL),
(3, 'Title', NULL, NULL, NULL, 1, 3, '1', '1', NULL, NULL),
(4, 'Preview', NULL, NULL, NULL, 1, 4, '1', '1', NULL, NULL),
(5, 'Publish', NULL, NULL, NULL, 1, 5, '1', '1', NULL, NULL),
(6, 'Submit', NULL, NULL, NULL, 1, 6, '1', '1', NULL, NULL),
(7, 'Cancel', NULL, NULL, NULL, 1, 7, '1', '1', NULL, NULL),
(8, 'Subtitle', NULL, NULL, NULL, 1, 8, '1', '1', NULL, NULL),
(9, 'Remarks', NULL, NULL, NULL, 1, 9, '1', '1', NULL, NULL),
(10, 'Image', NULL, NULL, NULL, 1, 10, '1', '1', NULL, NULL),
(11, 'Seo Title', NULL, NULL, NULL, 1, 11, '1', '1', NULL, NULL),
(12, 'Seo Keyword', NULL, NULL, NULL, 1, 12, '1', '1', NULL, NULL),
(13, 'Seo Description', NULL, NULL, NULL, 1, 13, '1', '1', NULL, NULL),
(14, 'Cover Image', NULL, NULL, NULL, 1, 14, '1', '1', NULL, NULL),
(15, 'Thumb', NULL, NULL, NULL, 1, 15, '1', '1', NULL, NULL),
(16, 'Description', NULL, NULL, NULL, 1, 16, '1', '1', NULL, NULL),
(17, 'URL', NULL, NULL, NULL, 1, 17, '1', '1', NULL, NULL),
(18, 'Detail', NULL, NULL, NULL, 1, 18, '1', '1', NULL, NULL),
(19, 'If Page has any detail, leave it here.', NULL, NULL, NULL, 1, 19, '1', '1', NULL, NULL),
(20, 'Sub Title', NULL, NULL, NULL, 1, 20, '1', '1', NULL, NULL),
(21, 'Extra Image', NULL, NULL, NULL, 1, 21, '1', '1', NULL, NULL),
(22, 'Main Menu', NULL, NULL, NULL, 1, 22, '1', '1', NULL, NULL),
(23, 'View Pages', NULL, NULL, NULL, 1, 23, '1', '1', NULL, NULL),
(24, 'home', NULL, NULL, NULL, 1, 24, '1', '1', NULL, NULL),
(25, 'Blog', NULL, NULL, NULL, 1, 25, '1', '1', NULL, NULL),
(26, 'Story', NULL, NULL, NULL, 1, 26, '1', '1', NULL, NULL),
(27, 'Test Template', NULL, NULL, NULL, 1, 27, '1', '1', NULL, NULL),
(28, 'Chef', NULL, NULL, NULL, 1, 28, '1', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menucategories`
--

CREATE TABLE `menucategories` (
  `menuCategories_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menucategories`
--

INSERT INTO `menucategories` (`menuCategories_id`, `title`, `subtitle`, `alias`, `cover`, `thumb`, `parent`, `remarks`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Autonomous Robots', 'Self-operating smart robotics', 'autonomous-robots', NULL, NULL, NULL, NULL, 1, 1, '1', '1', '2025-05-17 02:03:32', '2025-05-17 02:03:32'),
(2, 'Humanoid Robots', 'Machines that mimic human form and function', 'humanoid-robots', NULL, NULL, NULL, NULL, 2, 1, '1', '1', '2025-05-17 02:03:32', '2025-05-17 02:03:32'),
(3, 'Industrial Automation', 'Precision bots for manufacturing', 'industrial-automation', NULL, NULL, NULL, NULL, 3, 1, '1', '1', '2025-05-17 02:03:32', '2025-05-19 07:32:11'),
(4, 'Robotic Components', 'Parts powering next-gen robots', 'robotic-components', NULL, NULL, NULL, NULL, 4, 1, '1', '1', '2025-05-17 02:03:32', '2025-05-17 02:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menus_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuCategory_id` int DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menus_id`, `title`, `subtitle`, `alias`, `menuCategory_id`, `price`, `thumb`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'PathFinder A1', 'AI-based navigation bot', 'pathfinder-a1', 1, 'Rs. 1,20,000', NULL, 1, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(2, 'Guardian Rover', 'Surveillance and terrain robot', 'guardian-rover', 1, 'Rs. 1,75,000', NULL, 2, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(3, 'AgriBot S2', 'Smart farming assistant', 'agribot-s2', 1, 'Rs. 95,000', NULL, 3, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(4, 'Scout Pro X', 'Exploration and terrain analysis', 'scout-pro-x', 1, 'Rs. 2,00,000', NULL, 4, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(5, 'RescueMate', 'Disaster zone recovery bot', 'rescuemate', 1, 'Rs. 2,50,000', NULL, 5, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(6, 'Delivery Droid', 'Last-mile autonomous delivery', 'delivery-droid', 1, 'Rs. 1,40,000', NULL, 6, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(7, 'Luna Rover', 'Lunar surface exploration unit', 'luna-rover', 1, 'Rs. 5,00,000', NULL, 7, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(8, 'Eva Companion', 'Emotional response AI bot', 'eva-companion', 2, 'Rs. 3,50,000', NULL, 1, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(9, 'ChefBot H1', 'Cooking and kitchen assistant', 'chefbot-h1', 2, 'Rs. 2,80,000', NULL, 2, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(10, 'MediCare Droid', 'Hospital aid and health assistant', 'medicare-droid', 2, 'Rs. 3,20,000', NULL, 3, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(11, 'Reception Rover', 'Front desk customer handler', 'reception-rover', 2, 'Rs. 2,00,000', NULL, 4, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(12, 'EduBot Alpha', 'Teaching assistant bot', 'edubot-alpha', 2, 'Rs. 1,95,000', NULL, 5, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(13, 'CleanBot M', 'Home and office cleaning droid', 'cleanbot-m', 2, 'Rs. 1,60,000', NULL, 6, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(14, 'MeetMate Z', 'Event hosting humanoid', 'meetmate-z', 2, 'Rs. 2,70,000', NULL, 7, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(15, 'LineBot 500', 'Assembly line automation', 'linebot-500', 3, 'Rs. 4,50,000', NULL, 1, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(16, 'WeldMaster X', 'Precision welding bot', 'weldmaster-x', 3, 'Rs. 4,80,000', NULL, 2, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(17, 'PackBot Z2', 'Automated packaging robot', 'packbot-z2', 3, 'Rs. 3,90,000', NULL, 3, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(18, 'LiftPro R1', 'Heavy lifting robotic arm', 'liftpro-r1', 3, 'Rs. 3,20,000', NULL, 4, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(19, 'Sorter YX', 'Product sorting machine', 'sorter-yx', 3, 'Rs. 2,70,000', NULL, 5, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(20, 'GripMaster', 'Flexible gripper arm', 'gripmaster', 3, 'Rs. 3,00,000', NULL, 6, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(21, 'PaintBot G7', 'Industrial painting robot', 'paintbot-g7', 3, 'Rs. 4,20,000', NULL, 7, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(22, 'ServoCore X', 'High-torque servo motor', 'servocore-x', 4, 'Rs. 15,000', NULL, 1, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(23, 'VisionEye 4K', 'Robotic vision module', 'visioneye-4k', 4, 'Rs. 22,000', NULL, 2, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(24, 'AI Core N1', 'Neural processor chip', 'ai-core-n1', 4, 'Rs. 35,000', NULL, 3, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(25, 'Motion Tracker', '6-axis motion sensor', 'motion-tracker', 4, 'Rs. 12,000', NULL, 4, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(26, 'Battery Pack Pro', 'Extended-life lithium cell', 'battery-pack-pro', 4, 'Rs. 18,000', NULL, 5, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(27, 'SmartGrip Handle', 'Adaptive gripper accessory', 'smartgrip-handle', 4, 'Rs. 10,000', NULL, 6, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42'),
(28, 'Control Hub 2.0', 'Wireless control processor', 'control-hub-20', 4, 'Rs. 25,000', NULL, 7, 1, '1', '1', '2025-05-17 02:03:42', '2025-05-17 02:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_24_134819_create_routes_table', 1),
(5, '2024_12_09_021547_create_permission_tables', 1),
(6, '2025_02_27_095717_create_pages_table', 1),
(7, '2025_02_27_105940_create_viso_articles_table', 1),
(8, '2025_02_27_105941_create_viso_labels_table', 1),
(9, '2025_02_27_105942_create_viso_settings_table', 1),
(10, '2025_03_06_061453_create_menus_table', 1),
(11, '2025_03_06_061627_create_blogs_table', 1),
(12, '2025_03_06_061709_create_menu_categories_table', 1),
(13, '2025_03_06_061748_create_sliders_table', 1),
(14, '2025_03_07_015808_create_button_table', 1),
(15, '2025_03_08_023740_create_templates_table', 1),
(16, '2025_03_30_031633_create_navigations_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `navigations_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '_self',
  `location` int NOT NULL DEFAULT '1',
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`navigations_id`, `title`, `alias`, `parent`, `url`, `target`, `location`, `thumb`, `entries`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'About US', 'about-us', NULL, '#', '_self', 1, NULL, NULL, 1, 1, '1', '1', '2025-05-16 22:45:41', '2025-05-16 22:45:41'),
(2, 'Our Story', 'our-story', 1, 'templates,61', '_self', 1, NULL, 'templates,61', 2, 1, '1', '1', '2025-05-16 22:57:39', '2025-05-16 22:57:53'),
(3, 'Our Robots', 'our-chef', 1, 'templates,63', '_self', 1, NULL, 'templates,63', 3, 1, '1', '1', '2025-05-17 05:25:07', '2025-05-17 05:27:49'),
(4, 'Blogs', 'blogs', 1, 'templates,65', '_self', 1, NULL, 'templates,65', 4, 1, '1', '1', '2025-05-17 05:54:28', '2025-05-17 05:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pages_id` bigint UNSIGNED NOT NULL,
  `parent` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'unisharp.lfm.show', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(2, 'dashboard', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(3, 'error', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(4, 'profile.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(5, 'profile.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(6, 'profile.destroy', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(7, 'articles.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(8, 'articles.create', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(9, 'articles.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(10, 'articles.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(11, 'articles.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(12, 'articles.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(13, 'articles.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(14, 'articles.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(15, 'articles.publish', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(16, 'articles.updateOrder', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(17, 'roles.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(18, 'roles.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(19, 'roles.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(20, 'roles.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(21, 'roles.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(22, 'roles.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(23, 'roles.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(24, 'roles.publish', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(25, 'roles.updateOrder', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(26, 'settings.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(27, 'settings.create', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(28, 'settings.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(29, 'settings.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(30, 'settings.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(31, 'settings.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(32, 'settings.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(33, 'settings.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(34, 'settings.publish', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(35, 'settings.updateOrder', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(36, 'users.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(37, 'users.create', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(38, 'users.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(39, 'users.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(40, 'users.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(41, 'users.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(42, 'users.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(43, 'users.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(44, 'users.publish', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(45, 'users.updateOrder', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(46, 'menus.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(47, 'menus.create', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(48, 'menus.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(49, 'menus.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(50, 'menus.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(51, 'menus.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(52, 'menus.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(53, 'menus.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(54, 'menus.publish', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(55, 'menus.updateOrder', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(56, 'blogs.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(57, 'blogs.create', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(58, 'blogs.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(59, 'blogs.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(60, 'blogs.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(61, 'blogs.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(62, 'blogs.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(63, 'blogs.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(64, 'blogs.publish', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(65, 'blogs.updateOrder', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(66, 'sliders.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(67, 'sliders.create', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(68, 'sliders.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(69, 'sliders.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(70, 'sliders.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(71, 'sliders.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(72, 'sliders.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(73, 'sliders.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(74, 'sliders.publish', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(75, 'sliders.updateOrder', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(76, 'menuCategories.index', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(77, 'menuCategories.create', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(78, 'menuCategories.store', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(79, 'menuCategories.edit', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(80, 'menuCategories.update', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(81, 'menuCategories.view', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(82, 'menuCategories.delete', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(83, 'menuCategories.alias', 'web', '2025-05-16 20:14:47', '2025-05-16 20:14:47'),
(84, 'menuCategories.publish', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(85, 'menuCategories.updateOrder', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(86, 'pages.index', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(87, 'pages.create', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(88, 'pages.store', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(89, 'pages.edit', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(90, 'pages.update', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(91, 'pages.view', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(92, 'pages.delete', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(93, 'pages.alias', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(94, 'pages.publish', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(95, 'pages.updateOrder', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(96, 'pages.showChild', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(97, 'pages.fetch.content', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(98, 'buttons.index', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(99, 'buttons.create', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(100, 'buttons.store', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(101, 'buttons.edit', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(102, 'buttons.update', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(103, 'buttons.view', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(104, 'buttons.delete', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(105, 'buttons.alias', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(106, 'buttons.publish', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(107, 'buttons.updateOrder', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(108, 'buttons.getTemplateData', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(109, 'templates.index', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(110, 'templates.create', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(111, 'templates.store', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(112, 'templates.edit', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(113, 'templates.update', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(114, 'templates.view', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(115, 'templates.delete', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(116, 'templates.alias', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(117, 'templates.publish', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(118, 'templates.updateOrder', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(119, 'templates.all-data', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(120, 'templates.parent', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(121, 'templates.getData', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(122, 'templates.getChildren', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(123, 'templates.updateChildren', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(124, 'templates.childPublish', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(125, 'templates.fetchChildren', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(126, 'navigations.index', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(127, 'navigations.create', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(128, 'navigations.store', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(129, 'navigations.edit', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(130, 'navigations.update', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(131, 'navigations.view', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(132, 'navigations.delete', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(133, 'navigations.alias', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(134, 'navigations.publish', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(135, 'navigations.updateOrder', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(136, 'navigations.fetchContent', 'web', '2025-05-16 20:14:48', '2025-05-16 20:14:48'),
(137, 'navigations.getData', 'web', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(138, 'register', 'web', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(139, 'login', 'web', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(140, 'logout', 'web', '2025-05-16 20:14:49', '2025-05-16 20:14:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2025-05-16 20:14:46', '2025-05-16 20:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `uri`, `created_at`, `updated_at`) VALUES
(1, 'unisharp.lfm.show', 'laravel-filemanager', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(2, 'dashboard', 'dashboard', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(3, 'error', 'error', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(4, 'profile.edit', 'profile', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(5, 'profile.update', 'profile', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(6, 'profile.destroy', 'profile', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(7, 'articles.index', 'admin/articles', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(8, 'articles.create', 'admin/articles/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(9, 'articles.store', 'admin/articles/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(10, 'articles.edit', 'admin/articles/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(11, 'articles.update', 'admin/articles/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(12, 'articles.view', 'admin/articles/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(13, 'articles.delete', 'admin/articles/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(14, 'articles.alias', 'admin/articles/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(15, 'articles.publish', 'admin/articles/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(16, 'articles.updateOrder', 'admin/articles/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(17, 'roles.index', 'admin/roles', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(18, 'roles.store', 'admin/roles/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(19, 'roles.edit', 'admin/roles/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(20, 'roles.update', 'admin/roles/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(21, 'roles.view', 'admin/roles/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(22, 'roles.delete', 'admin/roles/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(23, 'roles.alias', 'admin/roles/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(24, 'roles.publish', 'admin/roles/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(25, 'roles.updateOrder', 'admin/roles/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(26, 'settings.index', 'admin/settings', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(27, 'settings.create', 'admin/settings/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(28, 'settings.store', 'admin/settings/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(29, 'settings.edit', 'admin/settings/edit', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(30, 'settings.update', 'admin/settings/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(31, 'settings.view', 'admin/settings/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(32, 'settings.delete', 'admin/settings/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(33, 'settings.alias', 'admin/settings/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(34, 'settings.publish', 'admin/settings/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(35, 'settings.updateOrder', 'admin/settings/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(36, 'users.index', 'admin/users', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(37, 'users.create', 'admin/users/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(38, 'users.store', 'admin/users/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(39, 'users.edit', 'admin/users/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(40, 'users.update', 'admin/users/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(41, 'users.view', 'admin/users/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(42, 'users.delete', 'admin/users/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(43, 'users.alias', 'admin/users/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(44, 'users.publish', 'admin/users/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(45, 'users.updateOrder', 'admin/users/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(46, 'menus.index', 'admin/menus', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(47, 'menus.create', 'admin/menus/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(48, 'menus.store', 'admin/menus/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(49, 'menus.edit', 'admin/menus/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(50, 'menus.update', 'admin/menus/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(51, 'menus.view', 'admin/menus/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(52, 'menus.delete', 'admin/menus/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(53, 'menus.alias', 'admin/menus/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(54, 'menus.publish', 'admin/menus/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(55, 'menus.updateOrder', 'admin/menus/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(56, 'blogs.index', 'admin/blogs', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(57, 'blogs.create', 'admin/blogs/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(58, 'blogs.store', 'admin/blogs/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(59, 'blogs.edit', 'admin/blogs/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(60, 'blogs.update', 'admin/blogs/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(61, 'blogs.view', 'admin/blogs/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(62, 'blogs.delete', 'admin/blogs/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(63, 'blogs.alias', 'admin/blogs/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(64, 'blogs.publish', 'admin/blogs/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(65, 'blogs.updateOrder', 'admin/blogs/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(66, 'sliders.index', 'admin/sliders', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(67, 'sliders.create', 'admin/sliders/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(68, 'sliders.store', 'admin/sliders/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(69, 'sliders.edit', 'admin/sliders/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(70, 'sliders.update', 'admin/sliders/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(71, 'sliders.view', 'admin/sliders/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(72, 'sliders.delete', 'admin/sliders/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(73, 'sliders.alias', 'admin/sliders/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(74, 'sliders.publish', 'admin/sliders/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(75, 'sliders.updateOrder', 'admin/sliders/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(76, 'menuCategories.index', 'admin/menuCategories', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(77, 'menuCategories.create', 'admin/menuCategories/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(78, 'menuCategories.store', 'admin/menuCategories/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(79, 'menuCategories.edit', 'admin/menuCategories/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(80, 'menuCategories.update', 'admin/menuCategories/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(81, 'menuCategories.view', 'admin/menuCategories/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(82, 'menuCategories.delete', 'admin/menuCategories/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(83, 'menuCategories.alias', 'admin/menuCategories/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(84, 'menuCategories.publish', 'admin/menuCategories/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(85, 'menuCategories.updateOrder', 'admin/menuCategories/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(86, 'pages.index', 'admin/pages', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(87, 'pages.create', 'admin/pages/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(88, 'pages.store', 'admin/pages/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(89, 'pages.edit', 'admin/pages/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(90, 'pages.update', 'admin/pages/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(91, 'pages.view', 'admin/pages/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(92, 'pages.delete', 'admin/pages/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(93, 'pages.alias', 'admin/pages/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(94, 'pages.publish', 'admin/pages/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(95, 'pages.updateOrder', 'admin/pages/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(96, 'pages.showChild', 'admin/pages/showChild/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(97, 'pages.fetch.content', 'admin/pages/fetch-content', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(98, 'buttons.index', 'admin/buttons', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(99, 'buttons.create', 'admin/buttons/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(100, 'buttons.store', 'admin/buttons/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(101, 'buttons.edit', 'admin/buttons/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(102, 'buttons.update', 'admin/buttons/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(103, 'buttons.view', 'admin/buttons/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(104, 'buttons.delete', 'admin/buttons/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(105, 'buttons.alias', 'admin/buttons/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(106, 'buttons.publish', 'admin/buttons/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(107, 'buttons.updateOrder', 'admin/buttons/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(108, 'buttons.getTemplateData', 'admin/buttons/getTemplateData/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(109, 'templates.index', 'admin/templates', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(110, 'templates.create', 'admin/templates/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(111, 'templates.store', 'admin/templates/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(112, 'templates.edit', 'admin/templates/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(113, 'templates.update', 'admin/templates/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(114, 'templates.view', 'admin/templates/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(115, 'templates.delete', 'admin/templates/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(116, 'templates.alias', 'admin/templates/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(117, 'templates.publish', 'admin/templates/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(118, 'templates.updateOrder', 'admin/templates/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(119, 'templates.all-data', 'admin/templates/all-data', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(120, 'templates.parent', 'admin/templates/parent/{id}/{parent}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(121, 'templates.getData', 'admin/templates/getData/{entries}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(122, 'templates.getChildren', 'admin/templates/getChildren/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(123, 'templates.updateChildren', 'admin/templates/updateChildren', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(124, 'templates.childPublish', 'admin/templates/childPublish/{id}/{template_id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(125, 'templates.fetchChildren', 'admin/templates/fetchChildren/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(126, 'navigations.index', 'admin/navigations', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(127, 'navigations.create', 'admin/navigations/create', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(128, 'navigations.store', 'admin/navigations/store', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(129, 'navigations.edit', 'admin/navigations/edit/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(130, 'navigations.update', 'admin/navigations/update/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(131, 'navigations.view', 'admin/navigations/view/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(132, 'navigations.delete', 'admin/navigations/delete/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(133, 'navigations.alias', 'admin/navigations/alias/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(134, 'navigations.publish', 'admin/navigations/publish/{id}/{publish}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(135, 'navigations.updateOrder', 'admin/navigations/updateOrder', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(136, 'navigations.fetchContent', 'admin/navigations/fetchContent', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(137, 'navigations.getData', 'admin/navigations/getData/{id}', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(138, 'register', 'register', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(139, 'login', 'login', '2025-05-16 20:14:46', '2025-05-16 20:14:46'),
(140, 'logout', 'logout', '2025-05-16 20:14:46', '2025-05-16 20:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SlJgwI6skHObJzbHliVNDYRWlj2nyXIVCR8MLunY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZzNvaHRraThSTjNsVWhOYWx4Z1lCZ1duVmlGY29IZTFEUmVZanAwTiI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly9jbXMtZm1zLnRlc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToicGFyZW50X2lkIjtzOjI6IjI0IjtzOjc6ImlzX29wZW4iO2I6MTt9', 1747661198);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` bigint UNSIGNED NOT NULL,
  `switch_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selected_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_color` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `switch_state`, `profile_image`, `selected_color`, `custom_color`, `status`, `display_order`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'on', NULL, '#530d82', '#000000', 1, 1, '1', '1', '2025-05-16 20:19:09', '2025-05-16 20:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `sliders_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`sliders_id`, `title`, `subtitle`, `alias`, `cover`, `remarks`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Robots Built to Transform the Future', 'Get Prepared to See the change', 'robots-built-to-transform-the-future', 'storage/photos/1/Robo/horizontal9.jpg', NULL, NULL, NULL, NULL, 2, 1, '1', '1', '2025-05-17 02:03:56', '2025-05-16 21:09:27'),
(2, 'Automation That Understands Your Needs', NULL, 'automation-that-understands-your-needs', 'storage/photos/1/Robo/horizontal10.jpg', NULL, NULL, NULL, NULL, 1, 1, '1', '1', '2025-05-17 02:03:56', '2025-05-16 20:56:16'),
(3, 'Smarter Machines, Safer Industries', NULL, 'smarter-machines-safer-industries', 'storage/photos/1/Robo/horizontal3.jpg', NULL, NULL, NULL, NULL, 3, 1, '1', '1', '2025-05-17 02:03:56', '2025-05-17 05:59:21'),
(4, 'Empowering the Next Industrial Revolution', NULL, 'empowering-the-next-industrial-revolution', 'storage/photos/1/Robo/horizontal6.jpg', NULL, NULL, NULL, NULL, 4, 1, '1', '1', '2025-05-17 02:03:56', '2025-05-17 06:17:31'),
(5, 'Human-Robot Synergy Made Real', NULL, 'human-robot-synergy-made-real', 'storage/photos/1/Robo/horizontal8.png', NULL, NULL, NULL, NULL, 5, 1, '1', '1', '2025-05-17 02:03:56', '2025-05-18 10:27:21'),
(6, 'Precision Engineering for a Digital Age', NULL, 'precision-engineering-for-a-digital-age', 'storage/photos/1/robots/robot_6.jpg', NULL, NULL, NULL, NULL, 6, -1, '1', '1', '2025-05-17 02:03:56', '2025-05-17 02:03:56'),
(7, 'Next-Gen Bots, Real-World Applications', NULL, 'next-gen-bots-real-world-applications', 'storage/photos/1/robots/robot_7.jpg', NULL, NULL, NULL, NULL, 7, -1, '1', '1', '2025-05-17 02:03:56', '2025-05-17 02:03:56'),
(8, 'Mechanical Brilliance with a Mind', NULL, 'mechanical-brilliance-with-a-mind', 'storage/photos/1/robots/robot_8.jpg', NULL, NULL, NULL, NULL, 8, -1, '1', '1', '2025-05-17 02:03:56', '2025-05-17 02:03:56'),
(9, 'Explore, Innovate, Automate with Robotics', NULL, 'explore-innovate-automate-with-robotics', 'storage/photos/1/robots/robot_9.jpg', NULL, NULL, NULL, NULL, 9, -1, '1', '1', '2025-05-17 02:03:56', '2025-05-17 02:03:56'),
(10, 'Beyond Intelligence — The Robotic Way', 'Expressing Beyond The Reality', 'beyond-intelligence-the-robotic-way', 'storage/photos/1/Robo/horizontal4.jpg', NULL, NULL, NULL, NULL, 10, 1, '1', '1', '2025-05-17 02:03:56', '2025-05-16 22:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `templates_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `children` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `parent` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`templates_id`, `title`, `alias`, `thumb`, `entries`, `children`, `status`, `parent`, `display_order`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, '404', '404', NULL, NULL, NULL, 1, -1, 1, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(2, 'blogDetail', 'blogDetail', NULL, NULL, NULL, 1, -1, 2, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(3, 'blog.grid-white', 'blog-grid-white', NULL, NULL, NULL, 1, -1, 3, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(4, 'blog.grid', 'blog-grid', NULL, NULL, NULL, 1, -1, 4, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(5, 'blog.grid_1', 'blog-grid_1', NULL, NULL, NULL, 1, -1, 5, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(6, 'blog.list', 'blog-list', NULL, NULL, NULL, 1, -1, 6, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(7, 'blog.masonary', 'blog-masonary', NULL, NULL, NULL, 1, -1, 7, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(8, 'blog.overlay', 'blog-overlay', NULL, NULL, NULL, 1, -1, 8, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(9, 'blog.overlay_1', 'blog-overlay_1', NULL, NULL, NULL, 1, -1, 9, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(10, 'blog.slider', 'blog-slider', NULL, NULL, NULL, 1, -1, 10, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(11, 'blog.standerd', 'blog-standerd', NULL, NULL, NULL, 1, -1, 11, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(12, 'chef.chef', 'chef-chef', NULL, NULL, NULL, 1, -1, 12, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(13, 'chef.executive', 'chef-executive', NULL, NULL, NULL, 1, -1, 13, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(14, 'chef.slider', 'chef-slider', NULL, NULL, NULL, 1, -1, 14, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(15, 'chef.video', 'chef-video', NULL, NULL, NULL, 1, -1, 15, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(16, 'commingsoon', 'commingsoon', NULL, NULL, NULL, 1, -1, 16, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(17, 'contact.about', 'contact-about', NULL, NULL, NULL, 1, -1, 17, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(18, 'contact.form', 'contact-form', NULL, NULL, NULL, 1, -1, 18, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(19, 'contact.slider', 'contact-slider', NULL, NULL, NULL, 1, -1, 19, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(20, 'darkMenu.style1', 'darkMenu-style1', NULL, NULL, NULL, 1, -1, 20, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(21, 'darkMenu.style2', 'darkMenu-style2', NULL, NULL, NULL, 1, -1, 21, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(22, 'darkMenu.style3', 'darkMenu-style3', NULL, NULL, NULL, 1, -1, 22, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(23, 'darkMenu.style4', 'darkMenu-style4', NULL, NULL, NULL, 1, -1, 23, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(24, 'home', 'home', NULL, NULL, '45,46,47,29,25,27,26,28,44,43', 1, 1, 24, '1', '1', '2025-05-16 20:14:49', '2025-05-19 07:33:13'),
(25, 'home.about', 'home-about', NULL, NULL, NULL, 1, -1, 25, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(26, 'home.gallery', 'home-gallery', NULL, NULL, NULL, 1, -1, 26, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(27, 'home.menu', 'home-menu', NULL, NULL, NULL, 1, -1, 27, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(28, 'home.service', 'home-service', NULL, NULL, NULL, 1, -1, 28, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(29, 'home.slider', 'home-slider', NULL, NULL, NULL, 1, -1, 29, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(30, 'menu.order1', 'menu-order1', NULL, NULL, NULL, 1, -1, 30, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(31, 'menu.order2', 'menu-order2', NULL, NULL, NULL, 1, -1, 31, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(32, 'menu.order3', 'menu-order3', NULL, NULL, NULL, 1, -1, 32, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(33, 'menu.service', 'menu-service', NULL, NULL, NULL, 1, -1, 33, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(34, 'menu.slider', 'menu-slider', NULL, NULL, NULL, 1, -1, 34, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(35, 'menu.style1', 'menu-style1', NULL, NULL, NULL, 1, -1, 35, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(36, 'menu.style2', 'menu-style2', NULL, NULL, NULL, 1, -1, 36, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(37, 'menu.style3', 'menu-style3', NULL, NULL, NULL, 1, -1, 37, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(38, 'menu.style4', 'menu-style4', NULL, NULL, NULL, 1, -1, 38, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(39, 'menu.style5', 'menu-style5', NULL, NULL, NULL, 1, -1, 39, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(40, 'menu.style6', 'menu-style6', NULL, NULL, NULL, 1, -1, 40, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(41, 'menu.style7', 'menu-style7', NULL, NULL, NULL, 1, -1, 41, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(42, 'menu.style8', 'menu-style8', NULL, NULL, NULL, 1, -1, 42, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(43, 'partials.footer', 'partials-footer', NULL, NULL, NULL, 1, -1, 43, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(44, 'partials.form', 'partials-form', NULL, NULL, NULL, 1, -1, 44, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(45, 'partials.header', 'partials-header', NULL, NULL, NULL, 1, -1, 45, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(46, 'partials.loader', 'partials-loader', NULL, NULL, NULL, 1, -1, 46, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(47, 'partials.navMenu', 'partials-navMenu', NULL, NULL, NULL, 1, -1, 47, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(48, 'partials.newsletter', 'partials-newsletter', NULL, NULL, NULL, 1, -1, 48, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(49, 'product-list.shop-3column', 'product-list-shop-3column', NULL, NULL, NULL, 1, -1, 49, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(50, 'product-list.shop-4column', 'product-list-shop-4column', NULL, NULL, NULL, 1, -1, 50, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(51, 'reservation.form-style1', 'reservation-form-style1', NULL, NULL, NULL, 1, -1, 51, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(52, 'reservation.form-style2', 'reservation-form-style2', NULL, NULL, NULL, 1, -1, 52, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(53, 'reservation.location-style1', 'reservation-location-style1', NULL, NULL, NULL, 1, -1, 53, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(54, 'reservation.location-style2', 'reservation-location-style2', NULL, NULL, NULL, 1, -1, 54, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(55, 'reservation.location-style3', 'reservation-location-style3', NULL, NULL, NULL, 1, -1, 55, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(56, 'reservation.slider', 'reservation-slider', NULL, NULL, NULL, 1, -1, 56, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(57, 'story.gallery', 'story-gallery', NULL, NULL, NULL, 1, -1, 57, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(58, 'story.quote', 'story-quote', NULL, NULL, NULL, 1, -1, 58, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(59, 'story.slider', 'story-slider', NULL, NULL, NULL, 1, -1, 59, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(60, 'story.testimonial', 'story-testimonial', NULL, NULL, NULL, 1, -1, 60, '1', '1', '2025-05-16 20:14:49', '2025-05-16 20:14:49'),
(61, 'Story', 'story', NULL, NULL, '-46,47,59,58,28,57,60,44,43', 1, 1, 62, '1', '1', '2025-05-16 21:58:04', '2025-05-18 10:14:24'),
(62, 'Test Template', 'test-template', NULL, NULL, '4', 1, 1, 63, '1', '1', '2025-05-16 23:18:11', '2025-05-17 08:46:58'),
(63, 'Chef', 'chef', NULL, NULL, '47,14,13,64,12,15,44,43', 1, 1, 65, '1', '1', '2025-05-17 05:23:44', '2025-05-17 08:46:58'),
(64, 'chef.quote', 'chef-quote', NULL, NULL, NULL, 1, -1, 64, '1', '1', '2025-05-17 05:24:22', '2025-05-17 05:24:22'),
(65, 'Blog', 'blog', NULL, NULL, '47,14,4,44,43', 1, 1, 61, '1', '1', '2025-05-17 05:53:28', '2025-05-18 10:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gokul Subedi', 'subedigokul119@gmail.com', NULL, '$2y$12$BwDQN81dXXkdpi9HYEnV8uuWWX8aYlrkjvvgTkZTLKsBsKj3jCZ1.', 'zob6SdKkujITrWdaoraebRRV3Acu52v0OKC2alHlSX6qtonlXRR0CaeuEYTR', '2025-05-16 20:14:46', '2025-05-16 20:14:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articles_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogs_id`);

--
-- Indexes for table `buttons`
--
ALTER TABLE `buttons`
  ADD PRIMARY KEY (`buttons_id`);

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
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`contents_id`);

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
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`labels_id`);

--
-- Indexes for table `menucategories`
--
ALTER TABLE `menucategories`
  ADD PRIMARY KEY (`menuCategories_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menus_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`navigations_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pages_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routes_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`sliders_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`templates_id`),
  ADD UNIQUE KEY `templates_title_unique` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articles_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogs_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buttons`
--
ALTER TABLE `buttons`
  MODIFY `buttons_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `contents_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `labels_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `menucategories`
--
ALTER TABLE `menucategories`
  MODIFY `menuCategories_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menus_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `navigations_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pages_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `sliders_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `templates_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
