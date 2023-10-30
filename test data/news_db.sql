-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 02:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(7, 'business'),
(6, 'economy'),
(3, 'education'),
(9, 'entertainment'),
(5, 'environment'),
(8, 'fashion'),
(1, 'government'),
(4, 'health'),
(2, 'politics'),
(14, 'science'),
(10, 'sport'),
(13, 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `regDate`) VALUES
(1, 'Alaa Lotfy', 'A11@gmail.com', 'about the article on microsoft.', 'This is a test message. Hello there can you please check the Microsoft article for accuracy.', '2023-10-22 12:04:19'),
(2, 'Alaa', 'A@gmail.com', 'test', 'test message', '2023-10-30 01:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'format YYYY-MM-DD',
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT '0:unpublished, 1:published',
  `image` varchar(50) NOT NULL,
  `featured` tinyint(1) NOT NULL COMMENT '0:unfeatured, 1:featured',
  `breaking` tinyint(1) NOT NULL COMMENT '0:normal, 1:urgent',
  `views` int(11) NOT NULL DEFAULT 0,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `content`, `author`, `active`, `image`, `featured`, `breaking`, `views`, `cat_id`) VALUES
(1, '2023-10-19', 'SAG-AFTRA’s Fran Drescher Responds to George Clooney-led Plan to Accelerate End to Actors’ Strike: It “Does Not Impact the Contract”', 'SAG-AFTRA president Fran Drescher welcomed a George Clooney-led proposal on taking caps off union dues but said the offer wouldn’t be legally compatible with the union’s contract with the Alliance of Motion Pictures and Television Producers, saying “that does not impact the contract that we’re striking over whatsoever.”\r\n\r\nEarlier this week, Clooney and a group of other A-list actors met with SAG-AFTRA national executive director and chief negotiator Duncan Crabtree-Ireland and Drescher and offered a bold proposal to leaders suggesting that the union remove the cap on dues for high-earning members in order to infuse more funds into the union’s coffers over the course of three years.', 'Abid Rahman', 1, 'bde1b610ab111a2c73de0620f5cb8a4c.jpeg', 0, 0, 5, 4),
(2, '2023-10-20', 'Thursday Night Football: Christian Kirk\'s late touchdown pushes Jags over Saints', 'For a long stretch Thursday, it appeared as though the Jacksonville Jaguars would coast to a win over the New Orleans Saints. But with three minutes left to play, the Jaguars needed some heroics to pull ahead.\r\n\r\nChristian Kirk delivered, taking a short pass from Trevor Lawrence 44 yards down the field and into the end zone to give Jacksonville a late 31-24 lead.\r\n\r\nDerek Carr and the Saints made a valiant effort to tie things up down the stretch, but a key drop in the end zone by tight end Foster Moreau doomed New Orleans\' comeback hopes. The Saints had one more shot to score, but Carr underthrew a fade to Chris Olave that got knocked to the ground by a Jaguars defender.\r\n\r\nThe win pushes Jacksonville to 5-2, and gives them an edge in the AFC South. New Orleans falls to 3-4 with the loss, though are still in decent shape in a weak NFC South.', 'Chris Cwik', 1, '09d90f089fd0cb2baf424d6225555d25.webp', 0, 0, 0, 10),
(4, '2023-10-20', 'Sam Bankman-Fried, FTX allies secretly poured $50 million into ‘dark money’ groups, evidence shows', 'Former crypto king Sam Bankman-Fried and his allies donated $50 million during the 2022 election cycle toward politically active groups that do not publicly disclose the names of donors, according to documents recently made public by prosecutors.\r\n\r\nBankman-Fried, his cryptocurrency exchange FTX and at least two of his former colleagues gave to nonprofits aligned with Senate Minority Leader Mitch McConnell, R-Ky., and other senior Republican senators; a group linked to Democratic Senate Majority Leader Chuck Schumer, D-N.Y.; and a wide range of obscure groups that have quietly influenced politics.\r\n\r\nThe documents give the first full look at Bankman-Fried and his allies’ contributions to so-called “dark money” organizations. Nishad Singh, FTX’s former head of engineering, provided further testimony earlier this week that shed light on how Bankman-Fried used a private signal chat called “Donation Processing” to request certain contributions be made in Singh’s name.\r\n\r\nBankman-Fried’s mother, Barbara Fried, also encouraged donations that were actually from her son to be made in Singh’s name, according to evidence tied to a lawsuit brought by FTX.\r\n\r\nBankman-Fried is on trial for several federal fraud charges, as well as for allegedly using FTX customer funds to help finance over $100 million in political giving during the 2022 midterms. He faces a potential life sentence in prison. He has pleaded not guilty.\r\n\r\nBankman-Fried said in an interview last year that he gave what he called “dark” contributions because he didn’t want the public to know that he was giving money to Republican-leaning organizations. While Bankman-Fried quietly funded more conservative dark money groups behind the scenes, he publicly cultivated a profile that was clearly aligned with the Democratic Party.', 'Brian Schwartz', 1, 'db0a66a391e6dcd3d03f65c418992cab.jpeg', 0, 0, 3, 7),
(5, '2023-10-20', 'The Morning After: OnePlus\' thinner, more affordable flagship foldable', 'Compared to Samsung\'s Galaxy Z Fold 5, not only does OnePlus’ first foldable pack two larger displays, it’s also thinner and lighter — as long as you don’t count the hulking camera module. The most impressive thing the Open is doing is putting pressure on the price of big foldables.\r\nStarting at $1,700, it costs $100 less than the Z Fold 5 and Google’s Pixel Fold — and that’s before you factor in the launch deal that knocks another $200 off with the trade-in of any phone. We put it through its paces in our full review.\r\n\r\nAnd if you’re more interested in Oppo’s new foldable… well, they’re pretty much the same device.', 'Mat Smith', 1, '5311550e46bcac542aec8f1b371cdc95.webp', 1, 0, 0, 13),
(6, '2023-10-19', '‘The Golden Bachelor’ Recap: Competition Heats Up With Pickle Ball Tournament & Gerry Addresses Tiff Between 2 Women', 'After an emotional and somewhat stressful week, Gerry is ready to take his relationships to the next level as his journey on The Golden Bachelor reaches the halfway point.\r\n\r\nThat’s right, folks. Next week is the last dates before hometowns, which means that the pressure is on for the nine remaining women. The episode begins with a fun surprise for the ladies. The OG Bachelorette, Trista Sutter is here!', 'John Fleenor', 1, '19ceb6389bbf7a587e85fd8e295ea1ca.webp', 0, 0, 4, 10),
(7, '2023-10-20', 'The Astros Own the Rangers’ Ballpark, and Are Now in Control of the ALCS', 'By the end of American League Championship Series Game 4 on Thursday night, the lawyers left in the crowd at Globe Life Field must have been thumbing through the Texas Constitution to see if what they’ve been watching all year is actually legal. When they came upon Article 1, Section 17, they realized what has been happening: eminent domain, the taking of public property.\r\n\r\nWith 76 runs in eight games, including 8–5 and 10–3 thumpings of the Rangers in the ALCS, the Astros own Globe Life Field, if not the ALCS itself. The batters’ eye, the fast playing surface and the lack of depth in the Texas pitching staff all contribute to Houston becoming the Arlington Astros here. It may be a quirky narrative, but it’s a real one with real momentum.', 'Tom Verducci', 1, '17736114d74b325bcc54db6557372c73.webp', 0, 1, 0, 10),
(8, '2023-10-17', 'Astronomers Link “Starquakes” to Mysterious Radio Signals From Space.', 'Research from the University of Tokyo links fast radio bursts (FRBs) to “starquakes” on neutron stars, offering new insights into earthquakes and nuclear physics.\r\n\r\nFast radio bursts, or FRBs, are an astronomical mystery, with their exact cause and origins still unconfirmed. These intense bursts of radio energy are invisible to the human eye, but show up brightly on radio telescopes. Previous studies have noted broad similarities between the energy distribution of repeat FRBs, and that of earthquakes and solar flares.', 'University Of Tokyo', 1, '9c720587c8faf3f88ea3737833b5db08.webp', 1, 1, 3, 14),
(9, '2023-10-21', 'U.S. payments on debt spike to $659 billion, nearly doubling in two years', 'The U.S. government spent $659 billion this year paying off the interest on its debt, according to a Treasury report released Friday, as the nation’s widening fiscal imbalance and the Federal Reserve’s rate hikes dramatically raised the federal cost of borrowing.\r\nBecause the federal government spends more than it collects in tax revenue, the Treasury Department issues new debt to cover the rest of its payment obligations. That debt must be repaid with interest — costs that grow as the debt grows. And as the central bank has raised interest rates to cool inflation, the borrowing costs to the U.S. government are also way up.', 'Jeff Stein', 1, '470f88e0f5c78fcbdd663772fd3a4095.jpeg', 1, 1, 19, 7),
(10, '2023-10-21', 'Microsoft is now a gaming juggernaut.', 'Microsoft (MSFT) officially owns Activision Blizzard (ATVI), making it the third-largest gaming company in the world by revenue behind just Tencent and Sony (SONY). But the acquisition does more than boost Microsoft’s standing in the global gaming industry. It gives the company far greater access to the mobile gaming market, lines it up for revenue via mobile games advertising, and provides it with the opportunity to grow its Xbox Game Pass subscription service and Xbox Cloud Gaming streaming service.\r\n\r\n“It\'s certainly a seismic shift in how the money flows around the gaming ecosystem,” explained International Data Corporation (IDC) research director Lewis Ward. “It is the biggest acquisition in Microsoft\'s history. It is one of the biggest acquisitions in the tech market. It is … by anyone’s measure, a big sea change.”\r\n\r\nBut don’t expect the company to start reaping the benefits of the $69-billion deal anytime soon. Microsoft still has a long way to go before it can begin to put its stamp on any of Activision Blizzard’s games like “Call of Duty” and longer still before its bet on cloud gaming pays off.', 'Daniel Howley', 1, '1d0a2958580434e3a6b769d37c4c3394.jpeg', 1, 0, 3, 13),
(11, '2023-10-21', 'Sam Bankman-Fried\'s ex-friends and top lieutenants all demolished his criminal defense from the witness stand', 'During opening statements at Sam Bankman-Fried\'s trial, it quickly became clear that prosecutors and his defense attorneys had very different approaches.\r\n\r\nProsecutors told a simple story of straightforward theft. Bankman-Fried, they alleged, stole funds deposited by customers of his cryptocurrency exchange, FTX, by moving it to his hedge fund, Alameda Research, and took out loans for his own benefit.\r\n\r\nThree of his close friends and associates — Caroline Ellison, Gary Wang, and Nishad Singh — had already pleaded guilty to conspiring with Bankman-Fried and would testify in the trial. The mechanics, involving financial concepts like cryptocurrency, highly leveraged loans, and market-makers, could be esoteric. But in a federal courthouse in downtown Manhattan, Assistant US Attorney Thane Rehn put it in plain terms.\r\n\r\n\"He spent the money on lavish houses for himself, his parents, and his friends,\" Rehn said. \"He spent it so he could get introduced to celebrities. He spent millions more on political donations to gain influence in Washington. He poured money — other people\'s money — into his own investments to try to make himself even richer.\"', ' Jacob Shamsian ', 1, '09613a7cc2eddd8f039250629b4690dd.webp', 1, 1, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: inactive, 1: active',
  `supervisor` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not supervisor, 1: supervisor\r\n',
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `active`, `supervisor`, `password`, `reg_date`) VALUES
(6, 'Nourhan Abdelaziz', 'Nour', 'n2@gmail.com', 1, 1, '$2y$10$5xHpdmewAK4brqo4oA.DDu9LYkGrEDR3efLwtMepSyUwlmDbgNhgC', '2023-10-17 21:38:19'),
(7, 'Alaa Lotfy', 'Alaa', 'A2@gmail.com', 1, 0, '$2y$10$i/ei6uKI/m3AXIp68r1UFe4./6ziveHWtCVFzmmwH4SfNjO6qgm1q', '2023-10-17 21:39:08'),
(8, 'Sara Mohamed', 'Sara', 'Sara@gmail.com', 0, 0, '$2y$10$2BzwNg9yMxPD0iGf0ZeYOO9uONYswfoatbUCsYSTZkghpqN4Al/fa', '2023-10-17 21:39:31'),
(9, 'Mohamed Ahmed', 'Mo', 'M@gmail.com', 0, 0, '$2y$10$oDyasfDj.T8lCBpaxcn9O..aJ..BsnEUqw1eVe.zWg2aX6/oaPzhe', '2023-10-17 22:54:46'),
(10, 'Mona Ahmed', 'Mona', 'Mona@gmail.com', 1, 0, '$2y$10$Ea3g5rugU3rTzOZt8.vE6.h/emxi/1QgGIRNV31sOH4.M6kQni4jq', '2023-10-17 22:56:00'),
(11, 'Ahmed Said', 'Ahmed', 'AA@gmail.com', 1, 0, '$2y$10$yTsgkvVxMfc7xyuDMVd8ee1iAX9jFf8DmYG3p4NLonmR8M8669Np.', '2023-10-19 21:01:02'),
(12, 'test', 'test', 't@example.com', 0, 0, '$2y$10$NYgGYi5TMzKy73kfpSSRLO7W7n6Q8LN50w3a1CAxqrsWFAT/KRXMO', '2023-10-30 01:10:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
