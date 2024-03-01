-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 05:11 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis_tmsticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(14, 'Software'),
(15, 'Hardware');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `groupId` mediumint(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `groupId`) VALUES
(1, 'JOEL', 'HERNANDEZ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `eventlog`
--

CREATE TABLE `eventlog` (
  `id` bigint(20) NOT NULL,
  `ticketid` bigint(20) NOT NULL,
  `eventdate` datetime NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `clientid` bigint(20) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `categoryid` bigint(20) DEFAULT NULL,
  `subcategoryid` bigint(20) DEFAULT NULL,
  `assigneduser` varchar(30) DEFAULT NULL,
  `parentticketid` bigint(20) DEFAULT NULL,
  `groupid` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `eventlog`
--

INSERT INTO `eventlog` (`id`, `ticketid`, `eventdate`, `status`, `clientid`, `subject`, `categoryid`, `subcategoryid`, `assigneduser`, `parentticketid`, `groupid`) VALUES
(1, 1, '2019-07-12 21:30:14', 'Closed', 1232123424, 'Test ticket', 14, 45, 'janobe ', 0, 1),
(2, 1, '2019-07-12 21:34:37', 'Open', 1232123424, 'Test ticket', 14, 45, 'janobe ', 0, NULL),
(3, 2, '2019-07-12 21:36:20', 'Open', 1232123424, 'Test ticket', 14, 45, 'janobe ', 0, NULL),
(4, 3, '2019-07-12 21:40:09', 'Open', 1232123424, 'Test ticket', 14, 45, 'janobe ', 0, NULL),
(5, 3, '2019-07-12 21:40:54', 'Open', 1232123424, 'Test ticket', 14, 45, 'janobe  ', 0, 0),
(6, 3, '2019-07-12 21:41:14', 'Open', 1232123424, 'Test ticket', 14, 45, 'janobe   ', 0, 2),
(7, 3, '2019-07-12 21:41:31', 'Closed', 1232123424, 'Test ticket', 14, 45, 'janobe    ', 0, 2),
(8, 3, '2019-07-12 21:41:57', 'Open', 1232123424, 'Test ticket', 14, 45, 'janobe     ', 0, 2),
(9, 3, '2019-07-12 21:42:12', 'Open', 1232123424, 'Test ticket', 14, 45, 'janobe     ', 0, 2),
(10, 4, '2019-07-13 14:05:20', 'Waiting on Client', 0, 'Test ticket 1234444', 14, 45, 'janobe ', 0, 2),
(11, 5, '2019-07-13 15:44:14', 'Open', 21, 'Thank you', 14, 45, 'janobe ', 0, 1),
(12, 5, '2019-07-13 15:45:00', 'Open', 21, 'Thank you', 14, 45, 'janobe  ', 0, 1),
(13, 1, '2019-07-14 13:16:08', 'Open', 1232123424, 'Test ticket', 14, 45, 'user_accounting ', 0, 1),
(14, 2, '2019-07-14 13:17:37', 'Open', 21, 'Thank you', 14, 45, 'user_it ', 0, 2),
(15, 1, '2019-07-14 13:20:42', 'Waiting on Client', 1232123424, 'Test ticket', 14, 45, 'lhermandez', 0, 2),
(16, 2, '2019-07-14 13:43:02', 'Closed', 21, 'Thank you', 14, 45, 'user_it  ', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'accounting'),
(2, 'IT'),
(3, 'Marketing'),
(4, 'Engineering'),
(5, 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` mediumint(9) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'nilo');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `categoryid` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `categoryid`) VALUES
(45, 'Install/Update Applicatgion', 14),
(46, 'Ethernet Cable problem', 15);

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`, `value`) VALUES
(1, 'version', '0.1'),
(2, 'Authentication', 'LDAP'),
(3, 'system email', 'nilohernandez@yahoo.com'),
(4, 'language', 'English'),
(5, 'siteurl', 'http://NA'),
(6, 'brand', 'Zynaps');

-- --------------------------------------------------------

--
-- Table structure for table `systemlanguage`
--

CREATE TABLE `systemlanguage` (
  `id` mediumint(9) NOT NULL,
  `language` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `systemlanguage`
--

INSERT INTO `systemlanguage` (`id`, `language`, `keyword`, `value`) VALUES
(1, 'english', 'save', 'save'),
(2, 'english', 'ticket', 'ticket'),
(3, 'english', 'client', 'client'),
(4, 'english', 'subject', 'subject'),
(5, 'english', 'details', 'details'),
(6, 'english', 'create', 'create'),
(7, 'english', 'close', 'close'),
(8, 'english', 'category', 'category'),
(9, 'english', 'subcategory', 'sub category'),
(10, 'english', 'assigned', 'assigned'),
(11, 'english', 'status', 'status'),
(12, 'english', 'reset', 'reset'),
(13, 'english', 'New Ticket', 'New Ticket'),
(14, 'english', 'Recent Ticket', 'Recent Ticket'),
(15, 'english', 'Search', 'Search'),
(16, 'english', 'Submit', 'Submit'),
(17, 'english', 'Open', 'Open'),
(18, 'english', 'Closed', 'Closed'),
(19, 'english', 'Ticket Desk', 'Ticket Desk'),
(20, 'english', 'Tickets', 'Tickets'),
(21, 'english', 'Reports', 'Reports'),
(22, 'english', 'System', 'System'),
(23, 'english', 'My Tickets', 'My Tickets'),
(24, 'english', 'All', 'All'),
(25, 'english', 'Waiting On Client', 'Waiting On Client'),
(26, 'english', 'Waiting On Agent', 'Waiting On Agent'),
(27, 'english', 'Waiting On Other', 'Waiting On Other'),
(28, 'english', 'Report Name', 'Report Name'),
(29, 'english', 'Start Date', 'Start Date'),
(30, 'english', 'End Date', 'End Date'),
(31, 'english', 'Created by', 'Created by'),
(32, 'english', 'Categories', 'Categories'),
(33, 'english', 'Users', 'Users'),
(34, 'english', 'Groups', 'Groups'),
(35, 'english', 'Log Out', 'Log Out'),
(36, 'english', 'Log In', 'Log In'),
(37, 'english', 'Forgot?', 'Forgot?'),
(38, 'english', 'Register', 'Register'),
(39, 'english', 'Username', 'Username'),
(40, 'english', 'Password', 'Password'),
(41, 'english', 'Add', 'Add'),
(42, 'english', 'Delete', 'Delete'),
(43, 'english', 'Save', 'Save');

-- --------------------------------------------------------

--
-- Table structure for table `tblreferhistory`
--

CREATE TABLE `tblreferhistory` (
  `ReferID` int(11) NOT NULL,
  `ticketid` varchar(90) NOT NULL,
  `groupFrom` int(11) NOT NULL,
  `groupTo` int(11) NOT NULL,
  `username` varchar(90) NOT NULL,
  `daterefer` date NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblreferhistory`
--

INSERT INTO `tblreferhistory` (`ReferID`, `ticketid`, `groupFrom`, `groupTo`, `username`, `daterefer`, `notes`) VALUES
(1, '2', 2, 4, 'user_it', '2019-07-14', 'REFER TO ENGINEERING TESTING123'),
(2, '2', 4, 5, 'jame_yap', '2019-07-14', 'refer to hr for final testing');

-- --------------------------------------------------------

--
-- Table structure for table `ticketattachments`
--

CREATE TABLE `ticketattachments` (
  `ticketid` bigint(20) NOT NULL,
  `filepath` varchar(200) DEFAULT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `filename` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ticketnotes`
--

CREATE TABLE `ticketnotes` (
  `id` bigint(20) NOT NULL,
  `ticketid` bigint(20) NOT NULL,
  `note` varchar(8000) NOT NULL,
  `user` varchar(30) NOT NULL,
  `notedate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ticketnotes`
--

INSERT INTO `ticketnotes` (`id`, `ticketid`, `note`, `user`, `notedate`) VALUES
(1, 1, 'update updatge accounting', 'user_accounting', '2019-07-14 13:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) NOT NULL,
  `clientid` bigint(20) DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `categoryid` bigint(20) NOT NULL,
  `subcategoryid` bigint(20) DEFAULT NULL,
  `comments` varchar(8000) DEFAULT NULL,
  `transferyn` tinyint(1) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `opendate` datetime NOT NULL,
  `parentticketid` bigint(20) DEFAULT '0',
  `assigneduser` varchar(30) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `clientid`, `user`, `subject`, `categoryid`, `subcategoryid`, `comments`, `transferyn`, `groupid`, `opendate`, `parentticketid`, `assigneduser`, `lastupdate`) VALUES
(1, 1232123424, 'user_accounting', 'Test ticket', 14, 45, 'test ticket  ', NULL, 2, '2019-07-14 13:16:00', 0, 'lhermandez', NULL),
(2, 21, 'user_it', 'Thank you', 14, 45, 'Thankyoi  ', NULL, 5, '2019-07-14 13:17:34', 0, 'user_it  ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticketstatus`
--

CREATE TABLE `ticketstatus` (
  `id` bigint(20) NOT NULL,
  `ticketid` bigint(20) NOT NULL,
  `groupid` int(11) NOT NULL,
  `Notes` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `statusdate` datetime NOT NULL,
  `username` varchar(90) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ticketstatus`
--

INSERT INTO `ticketstatus` (`id`, `ticketid`, `groupid`, `Notes`, `status`, `statusdate`, `username`) VALUES
(1, 1, 0, '', 'Closed', '2019-07-14 13:16:00', ''),
(2, 1, 0, '', 'Open', '2019-07-14 13:16:08', ''),
(3, 2, 0, '', 'Open', '2019-07-14 13:17:34', ''),
(4, 2, 0, '', 'Open', '2019-07-14 13:17:37', ''),
(5, 1, 0, '', 'Waiting on Client', '2019-07-14 13:20:42', ''),
(6, 2, 0, '', 'Closed', '2019-07-14 13:43:02', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `UserType` varchar(90) NOT NULL,
  `groupid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `UserType`, `groupid`) VALUES
(10, 'nilohernandezsssss', 'ef767cc40843e719a5f56c28efd8763938eb57ede38077176ce48753d27b4e8b9d7668dbd130c5e7d3718005e172e36b0831ee72a4d1a53a9ebf11a795528d10', 'a5d2bf2afb43c8f67b72ac4248a9dfd2f03b948e53e9fd69d76ed30c2d32bee91676cbd72921542262d093b524c56cad43f8a9fe692d03887b110805d2f5e4a4', 'nilohernandez@yahoo.com', 'Administrator', 3),
(11, 'lhermandez', 'a523b911377ba0d10169ea1a81e2ffe8770e507b9bc34008c6724d99a869a32416e20eb0e0b18b1ff8963f1f7df41f3e757a88142f23b47cc31ecd9abe0829b9', 'ea462b4e4193589023bb9edf69c4383c27d840bba7ecd2536b9b7d6351d764945dcd2ca58e06dabb210276aab96615638fca13261fecdaa0facd75c8084dd930', 'admin@admin.com', '', 0),
(12, 'janobe', '44895d72ab86e17630f8dd7990872a931a6ccdad399c12b8c849ee7e28caaf6b29e895d9791b3a3f4697d197dce4cbc356db2a6fafafc56a010eefa36fe9065f', 'aea5566a4b9a97eaf6e594aa869a306a93167d6e0f7348c77916fe1c76ac1c9da0b42f97a34a905c87a3d761b1cfa17733b0d2e2892d7b08d3977e3aacba4039', 'janobe@gmail.com', 'Administrator', 0),
(21, 'admin', '3c6d9b4e0d9d1d156b0123ad3f150f6f19931f882cc22302c2c857f446205c0039902ba811c08d9f5748b28d33c6c64a52477e77fa59b229a8124be454d377be', '470d2d19904747d8720361206a8f7126f4466cce4b9fda2722b4af333717e37fabbef41689d2b5b438e5499cd702f849f59ed46b058d75e76c15b5c252d542a4', 'bsapilar2019@gmail.com', 'Administrator', 3),
(22, 'jake', '5f01ae530a9b5b03c2e150f6e6341ae0eb5fd1960740fa2526d243345bb545f77227d706051c9b609c99c9c72db138a298e53b549d4f6d407e4098c65ba5fac0', '2037ee54d7cdb0259ba4cfd22fd7aeb971f1c24247a5efa20ab29b9b7ffaef52da56d84e106c2dc8597345b06d9872f987862ba36309e04d0f8157098ab87ee7', 'jake@gmail.com', 'User', 1),
(23, 'user_accounting', '6a5a2a0aa471ed82e851e31754d778f143328b9ee589019e3f53f59a409bdc26ad43f4c0743d5087bbd7e0a3c82c8821f167a9c077d4955918653f0f519c3cd4', '2b54cb8841fbea62fc62b6f3c3211618d5083f334c2d034a1a76fc5519ca1833f6fa31165365c6043c311832f652422c1b86fdb5cf6ea1b07b52f138b8d21961', 'user_1@yahoo.com', 'User', 1),
(24, 'user_it', 'b8871732236f700d9362987901244d09519f9c57d771a21e6922cd18b585f3b40fcf579782e1bd9fc0f8af28e5f38c6814d69db5670583e2d3c596b44429925f', '0b2599d65280c675ada992c89732a9824bc51b25e7ef15f09c55fe7e61c6be7d95583748ece6306658b427e57377836c2547983de9189e36183e707c28baaed5', 'user_2@yahoo.com', 'User', 2),
(25, 'jame_yap', 'f7894ed77b167e282e451ddd3d06b42c17b9a2d47c26be130ab96ae1a30f344a356dd10b8e66a581b2a3fa7eb8288a38ff4d8f269b48a032ac24f3dfe93e7750', 'f44254f681cba8a6b06ca9b6e7e476582854031d63ce7e42aafb6ff4356b08fe186296e00bfbfd3d3262d8b923cedd9637e519b2961b8deefe6d3845d0d2d61e', 'jamesyap@gmail.com', 'User', 4),
(26, 'hr', 'e867cd84d75b58d7ad8b71866e2b30d29bda773dfffc22a0521a4c4e451973e6d5642d7ec0be39aaa197063a3eb537ec5bb524fdaf368f81e89b0b6c25cd93c2', '487f5f3d2f3202b07f1d66dbd38488a8961a31baea87fca7ed1c98f391a60edb5ce7a63180ed8992210f648890c2d3d111e63fb8486d79b91acdd3a0d69e8d94', 'hr@gmail.com', 'User', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `eventlog`
--
ALTER TABLE `eventlog`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `systemlanguage`
--
ALTER TABLE `systemlanguage`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tblreferhistory`
--
ALTER TABLE `tblreferhistory`
  ADD PRIMARY KEY (`ReferID`);

--
-- Indexes for table `ticketnotes`
--
ALTER TABLE `ticketnotes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `ticketstatus`
--
ALTER TABLE `ticketstatus`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eventlog`
--
ALTER TABLE `eventlog`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `systemlanguage`
--
ALTER TABLE `systemlanguage`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tblreferhistory`
--
ALTER TABLE `tblreferhistory`
  MODIFY `ReferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticketnotes`
--
ALTER TABLE `ticketnotes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ticketstatus`
--
ALTER TABLE `ticketstatus`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
