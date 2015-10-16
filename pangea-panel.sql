-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2015 at 01:00 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pangea-panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid_replies_child`
--

DROP TABLE IF EXISTS `bid_replies_child`;
CREATE TABLE IF NOT EXISTS `bid_replies_child` (
  `bid_child_id` bigint(11) NOT NULL auto_increment,
  `bid_id` bigint(11) NOT NULL,
  `project_country_id` bigint(11) NOT NULL,
  `project_cpc` decimal(8,2) NOT NULL,
  `hide_cpc` tinyint(4) NOT NULL COMMENT '0-show,1-hide',
  `project_ncomplete` int(8) NOT NULL,
  `bid_comments` text NOT NULL,
  PRIMARY KEY  (`bid_child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bid_replies_child`
--


-- --------------------------------------------------------

--
-- Table structure for table `bid_replies_master`
--

DROP TABLE IF EXISTS `bid_replies_master`;
CREATE TABLE IF NOT EXISTS `bid_replies_master` (
  `bid_id` bigint(11) NOT NULL auto_increment,
  `project_id` bigint(11) NOT NULL,
  `researcher_id` bigint(11) NOT NULL,
  `researcher_user_id` bigint(11) NOT NULL,
  `partner_id` bigint(11) NOT NULL,
  `partner_user_id` bigint(11) NOT NULL,
  `bid_type` tinyint(4) NOT NULL COMMENT '1: Researcher, 2:Partner',
  `bid_status` tinyint(4) NOT NULL COMMENT '0-fresh bid, 1: Continue, 2: Close, 3-won',
  `is_read` tinyint(4) NOT NULL,
  `project_country_id` bigint(11) NOT NULL,
  `project_cpc` float NOT NULL,
  `hide_cpc` smallint(6) NOT NULL,
  `project_ncomplete` int(11) NOT NULL,
  `project_management_fee` float NOT NULL,
  `project_setup_cost` float NOT NULL,
  `fee_type` tinyint(4) NOT NULL default '2' COMMENT '1:whole project; 2:only this segment',
  `bid_comments` text NOT NULL,
  `bid_createddate` datetime NOT NULL,
  `bid_modifieddate` datetime NOT NULL,
  `bid_remote_ip` varchar(100) NOT NULL,
  `bid_long_id` varchar(255) NOT NULL,
  PRIMARY KEY  (`bid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bid_replies_master`
--

INSERT INTO `bid_replies_master` (`bid_id`, `project_id`, `researcher_id`, `researcher_user_id`, `partner_id`, `partner_user_id`, `bid_type`, `bid_status`, `is_read`, `project_country_id`, `project_cpc`, `hide_cpc`, `project_ncomplete`, `project_management_fee`, `project_setup_cost`, `fee_type`, `bid_comments`, `bid_createddate`, `bid_modifieddate`, `bid_remote_ip`, `bid_long_id`) VALUES
(1, 8, 1, 1, 2, 4, 1, 0, 1, 11, 10, 0, 1000, 0, 0, 0, 'this is 1st bid with pp', '2015-03-06 17:34:09', '2015-03-06 17:34:09', '127.0.0.1', ''),
(2, 8, 1, 1, 2, 4, 2, 3, 1, 11, 20, 1, 100, 0, 0, 0, 'This is from partner PP', '2015-03-06 23:12:54', '2015-03-18 18:49:39', '127.0.0.1', ''),
(3, 9, 1, 1, 2, 4, 1, 0, 0, 13, 10, 1, 102, 0, 0, 0, 'this is just testing', '2015-03-06 18:52:00', '2015-03-06 18:52:00', '127.0.0.1', ''),
(4, 10, 1, 1, 3, 6, 1, 3, 0, 16, 20, 1, 1000, 0, 0, 0, 'hkhjkhj', '2015-03-06 18:53:53', '2015-03-06 19:22:58', '127.0.0.1', ''),
(5, 10, 1, 1, 2, 4, 1, 3, 0, 16, 12, 1, 1000, 0, 0, 0, 'this is testing for tab', '2015-03-06 19:06:59', '2015-03-06 19:24:19', '127.0.0.1', ''),
(6, 10, 1, 1, 2, 4, 1, 3, 0, 18, 11, 1, 1, 0, 0, 0, 'gdfgdgdgd', '2015-03-06 19:09:19', '2015-03-06 19:24:59', '127.0.0.1', ''),
(7, 10, 1, 1, 3, 6, 1, 3, 1, 18, 41, 1, 1, 0, 0, 0, 'ddadada', '2015-03-06 19:13:34', '2015-05-05 16:29:01', '127.0.0.1', ''),
(8, 10, 1, 1, 3, 6, 1, 0, 1, 18, 41, 1, 1, 0, 0, 0, 'ddadada', '2015-03-06 19:13:34', '2015-05-05 16:29:01', '127.0.0.1', ''),
(9, 9, 1, 1, 3, 6, 1, 3, 0, 13, 10, 0, 100, 0, 0, 0, 'Wanna do this task?', '2015-03-07 05:37:18', '2015-03-07 05:40:17', '127.0.0.1', ''),
(10, 9, 1, 1, 2, 4, 1, 3, 0, 13, 12, 0, 102, 0, 0, 0, '', '2015-03-11 07:27:41', '2015-03-11 08:08:34', '127.0.0.1', ''),
(11, 8, 1, 1, 2, 4, 1, 3, 0, 15, 11, 0, 100, 0, 0, 0, 'Hi, This is tst''', '2015-03-17 08:59:54', '2015-03-17 09:01:02', '127.0.0.1', ''),
(12, 11, 1, 1, 2, 4, 1, 0, 1, 20, 10, 1, 100, 0, 0, 0, 'Please ask RJ', '2015-03-19 13:58:02', '2015-03-21 07:57:06', '127.0.0.1', ''),
(13, 11, 1, 1, 2, 4, 2, 3, 1, 20, 11, 0, 100, 0, 0, 0, 'really sturggling', '2015-03-19 13:59:31', '2015-04-22 14:28:43', '127.0.0.1', ''),
(14, 11, 1, 0, 2, 4, 2, 3, 1, 20, 10, 0, 100, 0, 0, 0, 'Testing yo yo!', '2015-03-21 07:57:06', '2015-04-22 14:28:43', '127.0.0.1', ''),
(15, 7, 1, 1, 2, 4, 1, 0, 0, 10, 10, 0, 1000, 0, 0, 0, '', '2015-03-21 08:06:53', '2015-03-21 08:06:53', '127.0.0.1', ''),
(16, 11, 1, 1, 3, 6, 1, 0, 1, 20, 10, 0, 100, 0, 0, 0, 'jhjhkh', '2015-04-09 13:34:50', '2015-05-03 09:38:13', '127.0.0.1', ''),
(17, 12, 1, 1, 2, 4, 1, 0, 1, 22, 10, 0, 1000, 0, 0, 0, '', '2015-04-22 14:30:48', '2015-04-22 14:32:58', '127.0.0.1', ''),
(18, 12, 1, 1, 3, 6, 1, 0, 1, 22, 10, 0, 1000, 0, 0, 0, '11', '2015-04-22 14:30:56', '2015-04-23 10:33:12', '127.0.0.1', ''),
(19, 12, 1, 1, 2, 4, 2, 1, 1, 22, 11, 0, 1000, 0, 0, 0, '', '2015-04-22 14:32:58', '2015-05-07 06:33:52', '127.0.0.1', ''),
(20, 12, 1, 1, 2, 4, 2, 3, 1, 22, 10, 0, 1000, 0, 0, 0, '', '2015-04-22 14:33:24', '2015-05-07 06:33:52', '127.0.0.1', ''),
(21, 12, 1, 1, 2, 4, 1, 0, 1, 24, 5, 0, 100, 0, 0, 0, '', '2015-04-22 15:17:46', '2015-04-22 15:18:10', '127.0.0.1', ''),
(22, 12, 1, 1, 2, 4, 2, 1, 1, 24, 6, 0, 100, 0, 0, 0, '', '2015-04-22 15:18:10', '2015-05-07 06:33:48', '127.0.0.1', ''),
(23, 12, 1, 1, 2, 4, 2, 3, 1, 24, 7, 0, 100, 0, 0, 0, '', '2015-04-22 15:18:46', '2015-05-07 06:33:48', '127.0.0.1', ''),
(24, 12, 1, 1, 3, 6, 2, 1, 1, 22, 10, 0, 1000, 0, 0, 0, '10', '2015-04-23 10:33:12', '2015-05-07 06:33:52', '127.0.0.1', ''),
(25, 12, 1, 1, 3, 6, 2, 3, 1, 22, 12, 0, 1000, 0, 0, 0, '', '2015-04-23 10:33:30', '2015-05-07 06:33:52', '127.0.0.1', ''),
(26, 11, 1, 1, 3, 6, 2, 1, 0, 20, 9, 0, 100, 0, 0, 0, 'hnbhvnbn', '2015-05-03 09:38:13', '2015-05-03 09:38:13', '127.0.0.1', ''),
(27, 11, 1, 1, 3, 6, 2, 1, 0, 20, 9, 0, 100, 9, 0, 0, 'vbcvbcb', '2015-05-03 09:38:37', '2015-05-03 09:38:37', '127.0.0.1', ''),
(28, 11, 1, 1, 3, 6, 2, 1, 0, 20, 7, 0, 100, 8, 0, 0, '', '2015-05-03 09:44:09', '2015-05-03 09:44:09', '127.0.0.1', ''),
(29, 11, 1, 1, 3, 6, 2, 1, 0, 20, 7, 0, 90, 0, 0, 0, '', '2015-05-05 13:43:53', '2015-05-05 13:43:53', '127.0.0.1', ''),
(30, 11, 1, 1, 3, 6, 2, 1, 0, 20, 6, 0, 90, 0, 0, 0, '', '2015-05-05 13:45:37', '2015-05-05 13:45:37', '127.0.0.1', ''),
(31, 11, 1, 1, 3, 6, 2, 1, 0, 20, 6, 0, 95, 0, 0, 0, '', '2015-05-05 13:54:28', '2015-05-05 13:54:28', '127.0.0.1', ''),
(32, 10, 1, 1, 3, 6, 2, 1, 1, 18, 10000, 0, 1, 100, 500, 2, 'test setup cost', '2015-05-05 16:29:02', '2015-06-29 10:40:52', '127.0.0.1', ''),
(33, 10, 1, 1, 3, 6, 2, 1, 1, 18, 10000, 0, 5, 200, 500, 2, 'management fee changes', '2015-05-05 16:32:58', '2015-06-29 10:40:52', '127.0.0.1', ''),
(34, 12, 1, 1, 3, 6, 1, 0, 0, 24, 5, 0, 200, 0, 0, 2, 'this is just testing', '2015-05-07 06:24:10', '2015-05-07 06:24:10', '127.0.0.1', ''),
(35, 14, 1, 1, 2, 4, 1, 0, 0, 26, 10, 0, 20, 0, 0, 2, 'this is just testing', '2015-05-07 06:54:55', '2015-05-07 06:54:55', '127.0.0.1', ''),
(36, 14, 1, 1, 3, 6, 1, 0, 1, 26, 10, 0, 100, 0, 0, 2, 'this is latesst one', '2015-05-07 07:04:01', '2015-05-07 07:04:38', '127.0.0.1', ''),
(37, 14, 1, 1, 3, 6, 2, 3, 1, 26, 10, 0, 100, 10, 20, 2, 'this is final', '2015-05-07 07:04:38', '2015-06-09 07:37:46', '127.0.0.1', ''),
(38, 9, 1, 1, 3, 6, 1, 0, 0, 14, 2000, 1, 20, 0, 0, 2, 'this is just testing', '2015-07-19 13:23:19', '2015-07-19 13:23:19', '127.0.0.1', '6860799f'),
(39, 16, 1, 1, 2, 4, 1, 0, 0, 27, 10, 0, 1000, 0, 0, 2, 'this is first', '2015-07-30 05:57:23', '2015-07-30 05:57:23', '127.0.0.1', '038c7f6e'),
(40, 16, 1, 1, 3, 6, 1, 0, 1, 27, 10, 1, 1000, 0, 0, 2, 'this is wat testing', '2015-07-30 06:05:36', '2015-07-30 06:05:59', '127.0.0.1', 'a972639b'),
(41, 16, 1, 1, 3, 6, 2, 3, 1, 27, 0, 0, 1000, 100, 10, 2, '', '2015-07-30 06:05:59', '2015-07-30 06:13:36', '127.0.0.1', '82ad58e3'),
(42, 16, 1, 1, 3, 6, 1, 0, 1, 28, 10, 0, 1000, 0, 0, 2, 'this is second', '2015-07-30 06:51:20', '2015-07-30 06:51:53', '127.0.0.1', 'c6134a9d'),
(43, 16, 1, 1, 3, 6, 2, 3, 0, 28, 10, 0, 1000, 10, 10, 2, '', '2015-07-30 06:51:53', '2015-07-30 06:52:06', '127.0.0.1', '1050bae5');

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

DROP TABLE IF EXISTS `company_master`;
CREATE TABLE IF NOT EXISTS `company_master` (
  `company_id` bigint(11) NOT NULL auto_increment,
  `company_name` varchar(255) NOT NULL,
  `company_type` int(8) NOT NULL COMMENT '''1'' - Researcher , ''2'' - Partner',
  `company_email` varchar(255) NOT NULL,
  `company_url` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_city` varchar(255) NOT NULL,
  `company_state` varchar(255) NOT NULL,
  `company_country` varchar(255) NOT NULL,
  `company_zipcode` varchar(255) NOT NULL,
  `company_contact_no` varchar(255) NOT NULL,
  `company_tags` text NOT NULL,
  `company_segment` varchar(255) NOT NULL,
  `company_countries` text NOT NULL,
  `company_panel_names` text NOT NULL,
  `company_primary_user` bigint(11) NOT NULL,
  `company_time_zone` varchar(100) NOT NULL,
  `cost_rank` float default NULL,
  `performance_rank` float default NULL,
  `company_entry_date` datetime NOT NULL,
  `company_modified_date` datetime NOT NULL,
  `company_entry_ip` varchar(255) NOT NULL,
  PRIMARY KEY  (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`company_id`, `company_name`, `company_type`, `company_email`, `company_url`, `company_address`, `company_city`, `company_state`, `company_country`, `company_zipcode`, `company_contact_no`, `company_tags`, `company_segment`, `company_countries`, `company_panel_names`, `company_primary_user`, `company_time_zone`, `cost_rank`, `performance_rank`, `company_entry_date`, `company_modified_date`, `company_entry_ip`) VALUES
(1, 'EOL', 1, 'ritavyas1611@gmail.com', 'http://www.mvixusa.com', 'Adajan', 'Surat', 'Gujarat', '99', '395009', '04234723897', '0', '0', '0', '0', 0, ',,', NULL, NULL, '2015-01-03 17:18:50', '2015-05-23 10:18:30', '127.0.0.1'),
(2, 'PP', 2, 'javed.mojanidar@gmail.com', 'http://www.google.com', 'Adress1', 'Spanish Fork', 'IL', '3', '12345', '9909015790', 'IT', '1,2', '13,99', '', 4, '', 1.33333, 7.66667, '2015-01-03 19:13:43', '2015-01-14 11:10:00', '127.0.0.1'),
(3, 'TestPP', 2, 'priyanka@gmail.com', 'http://www.google.com', 'Test', 'surat', 'Gujarat', '99', '12345', '9909015790', 'IT,CMO,10000,SMOKER, PREGNANT,34324,HR,PP,1000,File,45252,HR,PP,2000,SMOKER, PREGNANT,45252,HR,PP,3000,SMOKER, PREGNANT,2342', '1,2,3,4', '223,38,44,99', '', 6, '1,0,0', 0, 5.5, '2015-02-15 23:39:12', '2015-07-08 05:54:18', '127.0.0.1'),
(5, 'Rita', 1, 'ritzgvyas@gmail.com', 'http://www.google.com', 'Adajan', 'Surat', 'Gujarat', '99', '395009', '9909015790', '0', '0', '0', '0', 0, '', NULL, NULL, '2015-03-23 22:57:10', '2015-03-24 13:51:45', '127.0.0.1'),
(6, 'Pinku', 2, 'pinku@gmail.com', 'http://www.google.com', 'Adajan', 'Surat', 'Gujarat', '99', '395009', '09909015790', 'rita', '1', '10', 'rita', 9, '', NULL, NULL, '2015-03-24 19:26:10', '2015-03-24 13:57:39', '127.0.0.1'),
(7, 'ABZ', 1, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', NULL, NULL, '2015-06-06 20:07:50', '2015-06-06 20:07:50', '127.0.0.1'),
(8, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', NULL, NULL, '2015-07-18 19:02:26', '2015-07-18 19:02:26', '127.0.0.1'),
(9, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', NULL, NULL, '2015-07-18 19:04:48', '2015-07-18 19:04:48', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `country_master`
--

DROP TABLE IF EXISTS `country_master`;
CREATE TABLE IF NOT EXISTS `country_master` (
  `country_id` int(8) NOT NULL auto_increment,
  `country_name` varchar(255) NOT NULL,
  `iso_code_2` char(3) NOT NULL,
  `iso_code_3` char(5) NOT NULL,
  PRIMARY KEY  (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_master`
--

INSERT INTO `country_master` (`country_id`, `country_name`, `iso_code_2`, `iso_code_3`) VALUES
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Albania', 'AL', 'ALB'),
(3, 'Algeria', 'DZ', 'DZA'),
(4, 'American Samoa', 'AS', 'ASM'),
(5, 'Andorra', 'AD', 'AND'),
(6, 'Angola', 'AO', 'AGO'),
(7, 'Anguilla', 'AI', 'AIA'),
(8, 'Antarctica', 'AQ', 'ATA'),
(9, 'Antigua and Barbuda', 'AG', 'ATG'),
(10, 'Argentina', 'AR', 'ARG'),
(11, 'Armenia', 'AM', 'ARM'),
(12, 'Aruba', 'AW', 'ABW'),
(13, 'Australia', 'AU', 'AUS'),
(14, 'Austria', 'AT', 'AUT'),
(15, 'Azerbaijan', 'AZ', 'AZE'),
(16, 'Bahamas', 'BS', 'BHS'),
(17, 'Bahrain', 'BH', 'BHR'),
(18, 'Bangladesh', 'BD', 'BGD'),
(19, 'Barbados', 'BB', 'BRB'),
(20, 'Belarus', 'BY', 'BLR'),
(21, 'Belgium', 'BE', 'BEL'),
(22, 'Belize', 'BZ', 'BLZ'),
(23, 'Benin', 'BJ', 'BEN'),
(24, 'Bermuda', 'BM', 'BMU'),
(25, 'Bhutan', 'BT', 'BTN'),
(26, 'Bolivia', 'BO', 'BOL'),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH'),
(28, 'Botswana', 'BW', 'BWA'),
(29, 'Bouvet Island', 'BV', 'BVT'),
(30, 'Brazil', 'BR', 'BRA'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT'),
(32, 'Brunei Darussalam', 'BN', 'BRN'),
(33, 'Bulgaria', 'BG', 'BGR'),
(34, 'Burkina Faso', 'BF', 'BFA'),
(35, 'Burundi', 'BI', 'BDI'),
(36, 'Cambodia', 'KH', 'KHM'),
(37, 'Cameroon', 'CM', 'CMR'),
(38, 'Canada', 'CA', 'CAN'),
(39, 'Cape Verde', 'CV', 'CPV'),
(40, 'Cayman Islands', 'KY', 'CYM'),
(41, 'Central African Republic', 'CF', 'CAF'),
(42, 'Chad', 'TD', 'TCD'),
(43, 'Chile', 'CL', 'CHL'),
(44, 'China', 'CN', 'CHN'),
(45, 'Christmas Island', 'CX', 'CXR'),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK'),
(47, 'Colombia', 'CO', 'COL'),
(48, 'Comoros', 'KM', 'COM'),
(49, 'Congo', 'CG', 'COG'),
(50, 'Cook Islands', 'CK', 'COK'),
(51, 'Costa Rica', 'CR', 'CRI'),
(52, 'Cote D''Ivoire', 'CI', 'CIV'),
(53, 'Croatia', 'HR', 'HRV'),
(54, 'Cuba', 'CU', 'CUB'),
(55, 'Cyprus', 'CY', 'CYP'),
(56, 'Czech Republic', 'CZ', 'CZE'),
(57, 'Denmark', 'DK', 'DNK'),
(58, 'Djibouti', 'DJ', 'DJI'),
(59, 'Dominica', 'DM', 'DMA'),
(60, 'Dominican Republic', 'DO', 'DOM'),
(61, 'East Timor', 'TP', 'TMP'),
(62, 'Ecuador', 'EC', 'ECU'),
(63, 'Egypt', 'EG', 'EGY'),
(64, 'El Salvador', 'SV', 'SLV'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ'),
(66, 'Eritrea', 'ER', 'ERI'),
(67, 'Estonia', 'EE', 'EST'),
(68, 'Ethiopia', 'ET', 'ETH'),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK'),
(70, 'Faroe Islands', 'FO', 'FRO'),
(71, 'Fiji', 'FJ', 'FJI'),
(72, 'Finland', 'FI', 'FIN'),
(73, 'France', 'FR', 'FRA'),
(74, 'France Metropolitan', 'FX', 'FXX'),
(75, 'French Guiana', 'GF', 'GUF'),
(76, 'French Polynesia', 'PF', 'PYF'),
(77, 'French Southern Territories', 'TF', 'ATF'),
(78, 'Gabon', 'GA', 'GAB'),
(79, 'Gambia', 'GM', 'GMB'),
(80, 'Georgia', 'GE', 'GEO'),
(81, 'Germany', 'DE', 'DEU'),
(82, 'Ghana', 'GH', 'GHA'),
(83, 'Gibraltar', 'GI', 'GIB'),
(84, 'Greece', 'GR', 'GRC'),
(85, 'Greenland', 'GL', 'GRL'),
(86, 'Grenada', 'GD', 'GRD'),
(87, 'Guadeloupe', 'GP', 'GLP'),
(88, 'Guam', 'GU', 'GUM'),
(89, 'Guatemala', 'GT', 'GTM'),
(90, 'Guinea', 'GN', 'GIN'),
(91, 'Guinea-bissau', 'GW', 'GNB'),
(92, 'Guyana', 'GY', 'GUY'),
(93, 'Haiti', 'HT', 'HTI'),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD'),
(95, 'Honduras', 'HN', 'HND'),
(96, 'Hong Kong', 'HK', 'HKG'),
(97, 'Hungary', 'HU', 'HUN'),
(98, 'Iceland', 'IS', 'ISL'),
(99, 'India', 'IN', 'IND'),
(100, 'Indonesia', 'ID', 'IDN'),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN'),
(102, 'Iraq', 'IQ', 'IRQ'),
(103, 'Ireland', 'IE', 'IRL'),
(104, 'Israel', 'IL', 'ISR'),
(105, 'Italy', 'IT', 'ITA'),
(106, 'Jamaica', 'JM', 'JAM'),
(107, 'Japan', 'JP', 'JPN'),
(108, 'Jordan', 'JO', 'JOR'),
(109, 'Kazakhstan', 'KZ', 'KAZ'),
(110, 'Kenya', 'KE', 'KEN'),
(111, 'Kiribati', 'KI', 'KIR'),
(112, 'Korea Democratic People''s Republic of', 'KP', 'PRK'),
(113, 'Korea Republic of', 'KR', 'KOR'),
(114, 'Kuwait', 'KW', 'KWT'),
(115, 'Kyrgyzstan', 'KG', 'KGZ'),
(116, 'Lao People''s Democratic Republic', 'LA', 'LAO'),
(117, 'Latvia', 'LV', 'LVA'),
(118, 'Lebanon', 'LB', 'LBN'),
(119, 'Lesotho', 'LS', 'LSO'),
(120, 'Liberia', 'LR', 'LBR'),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY'),
(122, 'Liechtenstein', 'LI', 'LIE'),
(123, 'Lithuania', 'LT', 'LTU'),
(124, 'Luxembourg', 'LU', 'LUX'),
(125, 'Macau', 'MO', 'MAC'),
(126, 'Macedonia The Former Yugoslav Republic of', 'MK', 'MKD'),
(127, 'Madagascar', 'MG', 'MDG'),
(128, 'Malawi', 'MW', 'MWI'),
(129, 'Malaysia', 'MY', 'MYS'),
(130, 'Maldives', 'MV', 'MDV'),
(131, 'Mali', 'ML', 'MLI'),
(132, 'Malta', 'MT', 'MLT'),
(133, 'Marshall Islands', 'MH', 'MHL'),
(134, 'Martinique', 'MQ', 'MTQ'),
(135, 'Mauritania', 'MR', 'MRT'),
(136, 'Mauritius', 'MU', 'MUS'),
(137, 'Mayotte', 'YT', 'MYT'),
(138, 'Mexico', 'MX', 'MEX'),
(139, 'Micronesia Federated States of', 'FM', 'FSM'),
(140, 'Moldova Republic of', 'MD', 'MDA'),
(141, 'Monaco', 'MC', 'MCO'),
(142, 'Mongolia', 'MN', 'MNG'),
(143, 'Montserrat', 'MS', 'MSR'),
(144, 'Morocco', 'MA', 'MAR'),
(145, 'Mozambique', 'MZ', 'MOZ'),
(146, 'Myanmar', 'MM', 'MMR'),
(147, 'Namibia', 'NA', 'NAM'),
(148, 'Nauru', 'NR', 'NRU'),
(149, 'Nepal', 'NP', 'NPL'),
(150, 'Netherlands', 'NL', 'NLD'),
(151, 'Netherlands Antilles', 'AN', 'ANT'),
(152, 'New Caledonia', 'NC', 'NCL'),
(153, 'New Zealand', 'NZ', 'NZL'),
(154, 'Nicaragua', 'NI', 'NIC'),
(155, 'Niger', 'NE', 'NER'),
(156, 'Nigeria', 'NG', 'NGA'),
(157, 'Niue', 'NU', 'NIU'),
(158, 'Norfolk Island', 'NF', 'NFK'),
(159, 'Northern Mariana Islands', 'MP', 'MNP'),
(160, 'Norway', 'NO', 'NOR'),
(161, 'Oman', 'OM', 'OMN'),
(162, 'Pakistan', 'PK', 'PAK'),
(163, 'Palau', 'PW', 'PLW'),
(164, 'Panama', 'PA', 'PAN'),
(165, 'Papua New Guinea', 'PG', 'PNG'),
(166, 'Paraguay', 'PY', 'PRY'),
(167, 'Peru', 'PE', 'PER'),
(168, 'Philippines', 'PH', 'PHL'),
(169, 'Pitcairn', 'PN', 'PCN'),
(170, 'Poland', 'PL', 'POL'),
(171, 'Portugal', 'PT', 'PRT'),
(172, 'Puerto Rico', 'PR', 'PRI'),
(173, 'Qatar', 'QA', 'QAT'),
(174, 'Reunion', 'RE', 'REU'),
(175, 'Romania', 'RO', 'ROM'),
(176, 'Russian Federation', 'RU', 'RUS'),
(177, 'Rwanda', 'RW', 'RWA'),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(179, 'Saint Lucia', 'LC', 'LCA'),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(181, 'Samoa', 'WS', 'WSM'),
(182, 'San Marino', 'SM', 'SMR'),
(183, 'Sao Tome and Principe', 'ST', 'STP'),
(184, 'Saudi Arabia', 'SA', 'SAU'),
(185, 'Senegal', 'SN', 'SEN'),
(186, 'Seychelles', 'SC', 'SYC'),
(187, 'Sierra Leone', 'SL', 'SLE'),
(188, 'Singapore', 'SG', 'SGP'),
(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK'),
(190, 'Slovenia', 'SI', 'SVN'),
(191, 'Solomon Islands', 'SB', 'SLB'),
(192, 'Somalia', 'SO', 'SOM'),
(193, 'South Africa', 'ZA', 'ZAF'),
(194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(195, 'Spain', 'ES', 'ESP'),
(196, 'Sri Lanka', 'LK', 'LKA'),
(197, 'St. Helena', 'SH', 'SHN'),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM'),
(199, 'Sudan', 'SD', 'SDN'),
(200, 'Suriname', 'SR', 'SUR'),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM'),
(202, 'Swaziland', 'SZ', 'SWZ'),
(203, 'Sweden', 'SE', 'SWE'),
(204, 'Switzerland', 'CH', 'CHE'),
(205, 'Syrian Arab Republic', 'SY', 'SYR'),
(206, 'Taiwan', 'TW', 'TWN'),
(207, 'Tajikistan', 'TJ', 'TJK'),
(208, 'Tanzania United Republic of', 'TZ', 'TZA'),
(209, 'Thailand', 'TH', 'THA'),
(210, 'Togo', 'TG', 'TGO'),
(211, 'Tokelau', 'TK', 'TKL'),
(212, 'Tonga', 'TO', 'TON'),
(213, 'Trinidad and Tobago', 'TT', 'TTO'),
(214, 'Tunisia', 'TN', 'TUN'),
(215, 'Turkey', 'TR', 'TUR'),
(216, 'Turkmenistan', 'TM', 'TKM'),
(217, 'Turks and Caicos Islands', 'TC', 'TCA'),
(218, 'Tuvalu', 'TV', 'TUV'),
(219, 'Uganda', 'UG', 'UGA'),
(220, 'Ukraine', 'UA', 'UKR'),
(221, 'United Arab Emirates', 'AE', 'ARE'),
(222, 'United Kingdom', 'GB', 'GBR'),
(223, 'United States', 'US', 'USA'),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI'),
(225, 'Uruguay', 'UY', 'URY'),
(226, 'Uzbekistan', 'UZ', 'UZB'),
(227, 'Vanuatu', 'VU', 'VUT'),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT'),
(229, 'Venezuela', 'VE', 'VEN'),
(230, 'Viet Nam', 'VN', 'VNM'),
(231, 'Virgin Islands (British)', 'VG', 'VGB'),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR'),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF'),
(234, 'Western Sahara', 'EH', 'ESH'),
(235, 'Yemen', 'YE', 'YEM'),
(236, 'Yugoslavia', 'YU', 'YUG'),
(237, 'Zaire', 'ZR', 'ZAR'),
(238, 'Zambia', 'ZM', 'ZMB'),
(239, 'Zimbabwe', 'ZW', 'ZWE');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

DROP TABLE IF EXISTS `email_template`;
CREATE TABLE IF NOT EXISTS `email_template` (
  `email_template_id` int(8) NOT NULL auto_increment,
  `email_template_shortcode` varchar(255) NOT NULL,
  `email_template_subject` text NOT NULL,
  `email_template_content` text NOT NULL,
  `email_template_createddate` datetime NOT NULL,
  `email_template_modifieddate` datetime NOT NULL,
  `email_template_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`email_template_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`email_template_id`, `email_template_shortcode`, `email_template_subject`, `email_template_content`, `email_template_createddate`, `email_template_modifieddate`, `email_template_remote_ip`) VALUES
(2, 'registration', 'Registration Validation', '<p>Hi {Full Name},</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2015-02-06 17:42:58', '2015-03-26 11:02:23', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_detail`
--

DROP TABLE IF EXISTS `invoice_detail`;
CREATE TABLE IF NOT EXISTS `invoice_detail` (
  `detail_id` bigint(11) NOT NULL auto_increment,
  `invoice_id` bigint(11) NOT NULL,
  `project_closing_id` bigint(11) NOT NULL,
  `project_id` bigint(11) NOT NULL,
  `cost` float NOT NULL,
  PRIMARY KEY  (`detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_detail`
--

INSERT INTO `invoice_detail` (`detail_id`, `invoice_id`, `project_closing_id`, `project_id`, `cost`) VALUES
(1, 1, 1, 12, 10500);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

DROP TABLE IF EXISTS `invoice_master`;
CREATE TABLE IF NOT EXISTS `invoice_master` (
  `invoice_id` bigint(11) NOT NULL auto_increment,
  `batch_number` int(8) NOT NULL,
  `invoice_date` datetime NOT NULL,
  `partner_id` bigint(11) NOT NULL,
  `amount` float NOT NULL,
  `payment_status` tinyint(4) NOT NULL COMMENT '0-invoice_sent, 1- paid, 2-Pushback, 3-Delay',
  `status` tinyint(4) NOT NULL COMMENT '0-active,1inactive, 2-preparing',
  `invoice_link` text NOT NULL,
  `external_id` varchar(255) NOT NULL,
  `external_link` text NOT NULL,
  `comment` text NOT NULL,
  `created_by` bigint(11) NOT NULL,
  `viewed_by` bigint(11) NOT NULL,
  `viewed_day` datetime NOT NULL,
  `viewed_ip` varchar(255) NOT NULL,
  PRIMARY KEY  (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_master`
--

INSERT INTO `invoice_master` (`invoice_id`, `batch_number`, `invoice_date`, `partner_id`, `amount`, `payment_status`, `status`, `invoice_link`, `external_id`, `external_link`, `comment`, `created_by`, `viewed_by`, `viewed_day`, `viewed_ip`) VALUES
(1, 15, '2015-08-11 19:49:11', 2, 10500, 0, 2, '', '', '', '', 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment`
--

DROP TABLE IF EXISTS `invoice_payment`;
CREATE TABLE IF NOT EXISTS `invoice_payment` (
  `payment_id` bigint(11) NOT NULL auto_increment,
  `invoice_id` bigint(11) NOT NULL,
  `pay_date` datetime NOT NULL,
  `method` tinyint(4) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `pay_type` tinyint(4) NOT NULL default '1' COMMENT '0-partial,-full',
  `remaining_payment` float NOT NULL,
  `created_by` bigint(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `pushback` tinyint(4) NOT NULL COMMENT '0-No,1-Yes',
  `pushback_comment` text NOT NULL,
  PRIMARY KEY  (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `invoice_pushback`
--

DROP TABLE IF EXISTS `invoice_pushback`;
CREATE TABLE IF NOT EXISTS `invoice_pushback` (
  `pushback_id` bigint(11) NOT NULL auto_increment,
  `invoice_id` bigint(11) NOT NULL,
  `pushback_by` bigint(11) NOT NULL,
  `pushback_date` datetime NOT NULL,
  `partner_comment` text NOT NULL,
  `researcher_comment` text NOT NULL,
  `pp_comment` text NOT NULL,
  `valid` tinyint(4) NOT NULL COMMENT '0-No,1-Yes',
  `new_batch_id` int(8) NOT NULL,
  PRIMARY KEY  (`pushback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_pushback`
--


-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL auto_increment,
  `notification_type` int(11) NOT NULL,
  `notification_name` varchar(150) NOT NULL,
  `notification_description` text NOT NULL,
  `is_read` tinyint(4) NOT NULL,
  `read_by` int(11) NOT NULL,
  `read_date` datetime NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY  (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--


-- --------------------------------------------------------

--
-- Table structure for table `notification_master`
--

DROP TABLE IF EXISTS `notification_master`;
CREATE TABLE IF NOT EXISTS `notification_master` (
  `notification_id` bigint(11) NOT NULL auto_increment,
  `notification_type` varchar(255) NOT NULL,
  `notification_name` varchar(255) NOT NULL,
  `notification_description` text NOT NULL,
  `notification_read` tinyint(1) NOT NULL COMMENT '0-No,1-Yes',
  `read_by` bigint(11) NOT NULL,
  `readdate` datetime NOT NULL,
  `notofication_link` varchar(255) NOT NULL,
  PRIMARY KEY  (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_master`
--


-- --------------------------------------------------------

--
-- Table structure for table `panel_user_master`
--

DROP TABLE IF EXISTS `panel_user_master`;
CREATE TABLE IF NOT EXISTS `panel_user_master` (
  `user_id` bigint(11) NOT NULL auto_increment,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_state` varchar(255) NOT NULL,
  `user_country` varchar(255) NOT NULL,
  `user_zipcode` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_designation` varchar(255) NOT NULL,
  `user_type` char(10) NOT NULL COMMENT '1 - Admin, 2 - User',
  `company_id` bigint(11) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `long_key` varchar(100) NOT NULL,
  `is_active` smallint(1) NOT NULL COMMENT '0-inactive, 1-active',
  `user_entry_date` datetime NOT NULL,
  `user_modified_date` datetime NOT NULL,
  `user_entry_ip` varchar(255) NOT NULL,
  `profile_complete` tinyint(1) NOT NULL default '0' COMMENT '0-No 1-Yes',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panel_user_master`
--

INSERT INTO `panel_user_master` (`user_id`, `user_name`, `user_email`, `user_password`, `user_address`, `user_city`, `user_state`, `user_country`, `user_zipcode`, `user_phone`, `user_designation`, `user_type`, `company_id`, `profile_pic`, `long_key`, `is_active`, `user_entry_date`, `user_modified_date`, `user_entry_ip`, `profile_complete`) VALUES
(1, 'Rita Vyas', 'ritavyas1611@gmail.com', '9c6f8ccc31282d75876ac8d7b6919784', 'Adajan', 'Surat', 'Guajrat', '99', '395009', '232142', 'MD', '1', 1, 'avatar21.jpg', 'f0fce1af3df63fdd41c7b08884811e1c', 1, '2015-01-03 17:18:50', '2015-05-23 10:18:30', '127.0.0.1', 1),
(3, 'Rita Vyas1', 'ritavyas11@gmail.com', '698d51a19d8a121ce581499d7b701668', 'Adajan', 'Surat', 'Gujarat', '99', '395009', '31738173127', 'MD', '2', 1, 'avatar1.jpg', 'c24d16ecb859dda90af8a07845a5f371', 1, '2015-01-03 17:24:57', '2015-01-12 14:55:26', '127.0.0.1', 1),
(4, 'Javed M', 'javed.mojanidar@gmail.com', '9c6f8ccc31282d75876ac8d7b6919784', '', '', '', '', '', '', 'PM Worker', '1', 2, 'avatar31.jpg', 'ye47c7bbbee0640d4a138caae2728797', 1, '2015-01-03 19:13:43', '2015-01-03 13:58:41', '127.0.0.1', 1),
(5, 'Santosh Joshi', 'eol.santosh@gmail.com', '5a1b841f3d97ab538f19483181ecfc4c', '', '', '', '', '', '', '', '2', 2, 'avatar2.jpg', 'yf72370a223123f034b863674151da77', 1, '2015-01-03 19:19:25', '2015-04-22 14:32:11', '127.0.0.1', 1),
(6, 'Priyanka', 'priyanka@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '', '', '', '', '', '', '', '1', 3, '', 'd1b3a71f1dd2c2babac37e27d682ef27', 1, '2015-02-15 23:39:12', '2015-05-23 10:19:17', '127.0.0.1', 1),
(8, 'Ritz', 'ritzgvyas@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '', '1', 5, '', 'ydb2b902982f93998ffdda10fbcd50af', 1, '2015-03-23 22:57:10', '2015-03-24 13:51:45', '127.0.0.1', 1),
(9, 'Pinku', 'pinku@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '', '1', 6, '', 'f7bfe61ba45fa0ae0262b097b18c7437', 1, '2015-03-24 19:26:10', '2015-03-24 13:57:39', '127.0.0.1', 1),
(10, 'abz', 'abz@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '', '', '', '1', 7, '', 'x7d2ee9ec80aeb303af10af6045c583b', 1, '2015-06-06 20:07:50', '2015-06-06 20:07:50', '127.0.0.1', 0),
(11, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', '', '', '1', 8, '', '252e775e0ed60d181cc3290e7b03bb79', 0, '2015-07-18 19:02:26', '2015-07-18 19:02:26', '127.0.0.1', 0),
(12, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '', '', '', '', '', '1', 9, '', '803a62a124162a3398ea23c9a28ba404', 0, '2015-07-18 19:04:48', '2015-07-18 19:04:48', '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `partner_segments`
--

DROP TABLE IF EXISTS `partner_segments`;
CREATE TABLE IF NOT EXISTS `partner_segments` (
  `entry_id` bigint(11) NOT NULL auto_increment,
  `partner_id` bigint(11) NOT NULL,
  `country_id` int(4) NOT NULL,
  `segment_id` int(2) NOT NULL,
  `tags` text NOT NULL,
  `number_panelists` int(8) NOT NULL default '0',
  `entry_created_by` bigint(11) NOT NULL,
  `entry_created_date` datetime NOT NULL,
  `entry_modified_by` bigint(11) NOT NULL,
  `entry_modified_date` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`entry_id`),
  KEY `partner_id` (`partner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner_segments`
--

INSERT INTO `partner_segments` (`entry_id`, `partner_id`, `country_id`, `segment_id`, `tags`, `number_panelists`, `entry_created_by`, `entry_created_date`, `entry_modified_by`, `entry_modified_date`, `entry_remote_ip`) VALUES
(201, 3, 223, 1, 'IT;CMO', 10000, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(202, 3, 223, 2, 'SMOKER; PREGNANT', 34324, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(203, 3, 223, 3, 'lauging', 2342, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(204, 3, 223, 4, 'Calling', 323, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(205, 3, 38, 1, 'HR;PP', 1000, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(206, 3, 38, 2, 'File', 45252, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(207, 3, 38, 3, 'yyy', 32423, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(208, 3, 38, 4, 'Xxx', 232, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(209, 3, 44, 1, 'HR;PP', 2000, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(210, 3, 44, 2, 'SMOKER; PREGNANT', 45252, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(211, 3, 44, 3, 'File', 3232, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(212, 3, 44, 4, 'File', 3223, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(213, 3, 99, 1, 'HR;PP', 3000, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(214, 3, 99, 2, 'SMOKER; PREGNANT', 2342, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(215, 3, 99, 3, 'lauging', 232, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1'),
(216, 3, 99, 4, 'Calling', 232, 6, '2015-07-08 05:54:18', 6, '2015-07-08 05:54:18', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL auto_increment,
  `module_name` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `permission_json` text NOT NULL,
  PRIMARY KEY  (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `project_closing_detail`
--

DROP TABLE IF EXISTS `project_closing_detail`;
CREATE TABLE IF NOT EXISTS `project_closing_detail` (
  `project_closing_id` bigint(11) NOT NULL auto_increment,
  `partner_id` bigint(11) NOT NULL,
  `project_country_id` bigint(11) NOT NULL,
  `project_cpc` float NOT NULL,
  `project_ncomplete` int(8) NOT NULL,
  `project_estimated_cost` float NOT NULL,
  `researcher_estimated_cost` float NOT NULL,
  `project_id` bigint(11) NOT NULL,
  `partner_cost_rank` int(8) NOT NULL,
  `bid_speed_rank` float NOT NULL,
  `quality_rank` float NOT NULL,
  `value_rank` float NOT NULL,
  `over_all_rank` float NOT NULL,
  `partner_rank` int(8) NOT NULL,
  `partner_approved` tinyint(4) NOT NULL COMMENT '0:false;1:true; 2:rejected',
  `partner_approved_by` int(11) NOT NULL,
  `partner_approved_date` date NOT NULL,
  `reject_reason` text NOT NULL,
  `entry_created_by` int(8) NOT NULL,
  `entry_modified_by` int(8) NOT NULL,
  `entry_created_date` datetime NOT NULL,
  `entry_modified_date` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  `confirmed_payment` tinyint(2) NOT NULL,
  `confirmed_payment_user_id` bigint(11) NOT NULL,
  `confirmed_payment_date` datetime NOT NULL,
  `confirmed_payment_amount` float NOT NULL,
  PRIMARY KEY  (`project_closing_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_closing_detail`
--

INSERT INTO `project_closing_detail` (`project_closing_id`, `partner_id`, `project_country_id`, `project_cpc`, `project_ncomplete`, `project_estimated_cost`, `researcher_estimated_cost`, `project_id`, `partner_cost_rank`, `bid_speed_rank`, `quality_rank`, `value_rank`, `over_all_rank`, `partner_rank`, `partner_approved`, `partner_approved_by`, `partner_approved_date`, `reject_reason`, `entry_created_by`, `entry_modified_by`, `entry_created_date`, `entry_modified_date`, `entry_remote_ip`, `confirmed_payment`, `confirmed_payment_user_id`, `confirmed_payment_date`, `confirmed_payment_amount`) VALUES
(1, 2, 22, 10, 1000, 10700, 10500, 12, 4, 0, 0, 0, 0, 4, 1, 6, '2015-07-09', '', 1, 1, '2015-04-22 15:20:41', '2015-04-30 08:41:16', '127.0.0.1', 0, 0, '0000-00-00 00:00:00', 0),
(2, 2, 16, 12, 1000, 12011, 12011, 10, 0, 15, 18, 19, 20, 20, 1, 6, '0000-00-00', '', 1, 1, '2015-04-23 10:36:52', '2015-06-27 07:41:38', '127.0.0.1', 0, 0, '0000-00-00 00:00:00', 0),
(3, 3, 20, 10, 100, 1000, 0, 11, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', '', 1, 1, '2015-04-30 08:45:43', '2015-04-30 08:45:43', '127.0.0.1', 0, 0, '0000-00-00 00:00:00', 0),
(4, 2, 20, 10, 100, 1000, 100, 11, 0, 15, 7, 19, 19, 19, 0, 0, '0000-00-00', '', 1, 1, '2015-06-27 06:17:47', '2015-06-27 07:40:00', '127.0.0.1', 0, 0, '0000-00-00 00:00:00', 0),
(5, 3, 16, 20, 1000, 70500, 200, 10, 0, 13, 19, 19, 11, 11, 0, 0, '0000-00-00', '', 1, 1, '2015-06-29 11:12:45', '2015-06-29 11:12:45', '127.0.0.1', 0, 0, '0000-00-00 00:00:00', 0),
(6, 3, 27, 0, 1000, 10020, 1000, 16, 0, 14, 20, 16, 20, 20, 0, 0, '0000-00-00', '', 1, 1, '2015-07-30 07:18:40', '2015-07-30 07:18:40', '127.0.0.1', 0, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_closing_master`
--

DROP TABLE IF EXISTS `project_closing_master`;
CREATE TABLE IF NOT EXISTS `project_closing_master` (
  `project_closing_master_id` bigint(11) NOT NULL auto_increment,
  `project_closing_date` varchar(255) NOT NULL,
  `opt_for_closing` smallint(6) NOT NULL COMMENT '0-Yes 1-No',
  `project_id` bigint(11) NOT NULL,
  `entry_created_by` int(8) NOT NULL,
  `entry_modified_by` int(8) NOT NULL,
  `entry_created_date` datetime NOT NULL,
  `entry_modified_date` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`project_closing_master_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_closing_master`
--

INSERT INTO `project_closing_master` (`project_closing_master_id`, `project_closing_date`, `opt_for_closing`, `project_id`, `entry_created_by`, `entry_modified_by`, `entry_created_date`, `entry_modified_date`, `entry_remote_ip`) VALUES
(1, '2015-04-18', 0, 11, 0, 1, '0000-00-00 00:00:00', '2015-04-18 16:58:20', '127.0.0.1'),
(2, '2015-04-21', 0, 10, 0, 1, '0000-00-00 00:00:00', '2015-04-21 19:21:29', '127.0.0.1'),
(3, '2015-04-22', 0, 12, 0, 1, '0000-00-00 00:00:00', '2015-04-22 15:19:23', '127.0.0.1'),
(4, '2015-05-07', 0, 14, 0, 1, '0000-00-00 00:00:00', '2015-05-07 07:13:10', '127.0.0.1'),
(6, '2015-07-30', 0, 16, 0, 1, '0000-00-00 00:00:00', '2015-07-30 07:18:19', '127.0.0.1'),
(7, '2015-08-10', 0, 18, 0, 1, '0000-00-00 00:00:00', '2015-08-10 05:01:06', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `project_country_master`
--

DROP TABLE IF EXISTS `project_country_master`;
CREATE TABLE IF NOT EXISTS `project_country_master` (
  `project_country_id` bigint(11) NOT NULL auto_increment,
  `project_id` bigint(11) NOT NULL,
  `country_id` int(8) NOT NULL,
  `segment_name` text NOT NULL,
  `project_segments` text NOT NULL,
  `project_target` text NOT NULL,
  `project_ir` int(8) NOT NULL,
  `project_loi` int(8) NOT NULL,
  `project_cpc` decimal(8,2) NOT NULL,
  `project_ncomplete` int(8) NOT NULL,
  `is_delete` tinyint(4) NOT NULL default '0' COMMENT '0-False 1-True',
  `entry_created_by` bigint(11) NOT NULL,
  `entry_modified_by` bigint(11) NOT NULL,
  `entry_createddate` datetime NOT NULL,
  `entry_modifieddate` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`project_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_country_master`
--

INSERT INTO `project_country_master` (`project_country_id`, `project_id`, `country_id`, `segment_name`, `project_segments`, `project_target`, `project_ir`, `project_loi`, `project_cpc`, `project_ncomplete`, `is_delete`, `entry_created_by`, `entry_modified_by`, `entry_createddate`, `entry_modifieddate`, `entry_remote_ip`) VALUES
(1, 1, 0, '', '1', 'IT', 100, 10, '11.00', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, 1, 0, '', '2', 'IT', 20, 220, '10.00', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(5, 5, 0, '', '1', '', 0, 0, '0.00', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, 6, 99, '', '1', 'rita,vyas,IT', 10, 12, '11.00', 100, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(7, 6, 222, '', '2', 'uk,it', 10, 100, '12.00', 190, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(8, 6, 13, '', '3', 'rita,australia', 100, 11, '14.00', 4, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(9, 6, 6, '', '3', 'priyanka,patel', 5, 66, '77.00', 33, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(10, 7, 99, 'ritavyas', '1', 'rita,vyas', 10, 100, '10.00', 1000, 0, 1, 1, '2015-02-10 12:45:42', '2015-02-10 13:02:07', '127.0.0.1'),
(11, 8, 99, 'ritavyas', '1', 'rita,vyas', 10, 100, '10.00', 1000, 0, 1, 1, '2015-02-10 13:07:47', '2015-03-04 05:50:36', '127.0.0.1'),
(12, 8, 44, 'ChinaB2C', '2', 'rita,vyas', 20, 200, '2000.00', 20, 0, 1, 1, '2015-03-02 19:02:06', '2015-03-02 19:02:51', '127.0.0.1'),
(13, 9, 99, 'ritavyas', '1', 'rita,vyas,it', 10, 100, '10.00', 1000, 0, 1, 1, '2015-03-04 05:44:41', '2015-03-11 08:04:12', '127.0.0.1'),
(14, 9, 44, 'ChinaB2C', '2', 'rita,vyas', 20, 200, '2000.00', 20, 0, 1, 1, '2015-03-04 05:44:41', '2015-03-07 05:39:24', '127.0.0.1'),
(15, 8, 99, 'India b2c', '2', 'it', 10, 100, '11.00', 100, 0, 1, 1, '2015-03-06 09:45:35', '2015-03-06 09:45:35', '127.0.0.1'),
(16, 10, 99, 'India B2B', '1', 'rita,vyas', 10, 100, '10.00', 1000, 0, 1, 1, '2015-03-06 13:55:35', '2015-03-19 13:46:05', '127.0.0.1'),
(17, 10, 44, 'ChinaB2C', '2', 'rita,vyas', 20, 200, '2000.00', 20, 0, 1, 1, '2015-03-06 13:55:35', '2015-03-06 13:55:35', '127.0.0.1'),
(18, 10, 99, 'indiab2b', '2', 'rita,', 100, 11, '11.00', 1, 0, 1, 1, '2015-03-06 19:09:06', '2015-03-06 19:09:06', '127.0.0.1'),
(19, 8, 1, 'hgjg', '1', '', 0, 0, '0.00', 0, 0, 1, 1, '2015-03-18 17:27:45', '2015-03-18 17:28:23', '127.0.0.1'),
(20, 11, 99, 'india B2B', '1', 'IT', 10, 10, '10.00', 100, 0, 1, 1, '2015-03-19 13:57:13', '2015-03-20 06:36:51', '127.0.0.1'),
(21, 11, 99, 'India community', '1', 'IT', 10, 10, '100.00', 100, 0, 1, 1, '2015-04-16 13:04:01', '2015-04-16 13:04:40', '127.0.0.1'),
(22, 12, 99, 'ritavyas', '1', 'rita,vyas,it', 10, 100, '10.00', 1000, 0, 1, 1, '2015-04-22 14:30:19', '2015-04-22 14:30:19', '127.0.0.1'),
(23, 12, 44, 'ChinaB2C', '2', 'rita,vyas', 20, 200, '2000.00', 20, 0, 1, 1, '2015-04-22 14:30:19', '2015-04-22 14:30:19', '127.0.0.1'),
(24, 12, 99, 'b2c', '2', 'IT', 10, 10, '5.00', 100, 0, 1, 1, '2015-04-22 15:17:14', '2015-04-22 15:17:14', '127.0.0.1'),
(25, 12, 1, '', '1', '', 0, 0, '0.00', 0, 0, 1, 1, '2015-04-30 09:26:25', '2015-04-30 09:26:25', '127.0.0.1'),
(26, 14, 99, 'IndiaB2B', '1', 'IT', 100, 1000, '10.00', 100, 0, 1, 1, '2015-05-07 06:49:38', '2015-06-19 06:22:02', '127.0.0.1'),
(27, 16, 99, 'India B2B', '1', 'IT', 100, 1000, '10.00', 1000, 0, 1, 1, '2015-07-28 01:09:46', '2015-07-28 01:09:46', '127.0.0.1'),
(28, 16, 38, 'Canada B2C', '2', 'IT,shop', 100, 1000, '10.00', 1000, 0, 1, 1, '2015-07-28 01:11:47', '2015-07-30 06:40:33', '127.0.0.1'),
(29, 16, 18, 'BanIND', '3', 'IT,Fashion,Shop', 1, 100, '100.00', 1000, 0, 1, 1, '2015-07-30 06:28:45', '2015-07-30 06:38:55', '127.0.0.1'),
(30, 17, 99, 'India B2B', '1', 'IT', 100, 1000, '10.00', 1000, 0, 1, 1, '2015-07-30 07:35:41', '2015-07-30 07:35:41', '127.0.0.1'),
(31, 17, 38, 'Canada B2C', '2', 'IT,shop', 100, 1000, '10.00', 1000, 0, 1, 1, '2015-07-30 07:35:41', '2015-07-30 07:35:41', '127.0.0.1'),
(32, 17, 18, 'BanIND', '3', 'IT,Fashion,Shop', 1, 100, '100.00', 1000, 0, 1, 1, '2015-07-30 07:35:41', '2015-07-30 07:35:41', '127.0.0.1'),
(33, 18, 99, 'India B2B', '1', 'IT', 100, 1000, '10.00', 1000, 0, 1, 1, '2015-07-30 07:35:49', '2015-07-30 07:35:49', '127.0.0.1'),
(34, 18, 38, 'Canada B2C', '2', 'IT,shop', 100, 1000, '10.00', 1000, 0, 1, 1, '2015-07-30 07:35:49', '2015-07-30 07:35:49', '127.0.0.1'),
(35, 18, 18, 'BanIND', '3', 'IT,Fashion,Shop', 1, 100, '100.00', 1000, 0, 1, 1, '2015-07-30 07:35:49', '2015-07-30 07:35:49', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `project_files_master`
--

DROP TABLE IF EXISTS `project_files_master`;
CREATE TABLE IF NOT EXISTS `project_files_master` (
  `project_file_id` bigint(11) NOT NULL auto_increment,
  `project_file` varchar(255) NOT NULL,
  `project_file_name` varchar(255) NOT NULL,
  `project_file_description` text NOT NULL,
  `project_file_segment` int(8) NOT NULL,
  `opt_for_bid` char(3) NOT NULL,
  `project_id` bigint(11) NOT NULL,
  `entry_created_by` int(8) NOT NULL,
  `entry_modified_by` int(8) NOT NULL,
  `entry_created_date` datetime NOT NULL,
  `entry_modified_date` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`project_file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_files_master`
--

INSERT INTO `project_files_master` (`project_file_id`, `project_file`, `project_file_name`, `project_file_description`, `project_file_segment`, `opt_for_bid`, `project_id`, `entry_created_by`, `entry_modified_by`, `entry_created_date`, `entry_modified_date`, `entry_remote_ip`) VALUES
(5, 'banktheme-1421142416 - Copy.jpg', 'HealthCare', 'This is just for testing', 11, 'Yes', 8, 1, 1, '2015-02-19 14:03:34', '2015-02-19 14:03:34', '127.0.0.1'),
(7, 'shethnacarLogo01.jpg', 'Smoker', 'This fine', 11, 'Yes', 8, 1, 1, '2015-02-19 14:08:44', '2015-02-19 14:08:44', '127.0.0.1'),
(8, 'banner1-old.jpg', 'demo', 'jghjgjgh', 11, 'Yes', 8, 1, 1, '2015-03-06 09:38:11', '2015-03-06 09:38:11', '127.0.0.1'),
(9, 'task04032015.xlsx', 'rj', 'hghgh', 13, 'Yes', 9, 1, 1, '2015-03-11 07:31:52', '2015-03-11 07:31:52', '127.0.0.1'),
(10, 'task04032015.xlsx', 'zipIndia', 'Zip for India', 0, 'Yes', 11, 1, 1, '2015-03-19 13:57:39', '2015-03-19 13:57:39', '127.0.0.1'),
(11, 'task04032015.xlsx', 'test', 'test', 0, 'Yes', 9, 1, 1, '2015-03-21 08:14:42', '2015-03-21 08:14:42', '127.0.0.1'),
(12, 'font.css', 'ddgdg', 'gdfgdfg', 0, 'Yes', 10, 1, 1, '2015-04-09 13:21:26', '2015-04-09 13:21:26', '127.0.0.1'),
(13, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:08', '2015-05-07 06:41:08', '127.0.0.1'),
(14, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:08', '2015-05-07 06:41:08', '127.0.0.1'),
(15, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:09', '2015-05-07 06:41:09', '127.0.0.1'),
(16, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:09', '2015-05-07 06:41:09', '127.0.0.1'),
(17, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:10', '2015-05-07 06:41:10', '127.0.0.1'),
(18, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:10', '2015-05-07 06:41:10', '127.0.0.1'),
(19, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:11', '2015-05-07 06:41:11', '127.0.0.1'),
(20, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:11', '2015-05-07 06:41:11', '127.0.0.1'),
(21, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:12', '2015-05-07 06:41:12', '127.0.0.1'),
(22, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:12', '2015-05-07 06:41:12', '127.0.0.1'),
(23, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:13', '2015-05-07 06:41:13', '127.0.0.1'),
(24, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:13', '2015-05-07 06:41:13', '127.0.0.1'),
(25, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:14', '2015-05-07 06:41:14', '127.0.0.1'),
(26, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:14', '2015-05-07 06:41:14', '127.0.0.1'),
(27, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:15', '2015-05-07 06:41:15', '127.0.0.1'),
(28, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:15', '2015-05-07 06:41:15', '127.0.0.1'),
(29, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:15', '2015-05-07 06:41:15', '127.0.0.1'),
(30, 'Pangea Panel.png', 'screenshot', 'This is error screenshot', 0, 'Yes', 13, 1, 1, '2015-05-07 06:41:16', '2015-05-07 06:41:16', '127.0.0.1'),
(31, 'Pangea Panel.png', 'Error Screenshot', 'this is screenshot', 0, 'Yes', 14, 1, 1, '2015-05-07 06:45:32', '2015-05-07 06:45:32', '127.0.0.1'),
(32, 'doctor.txt', 'Testing File', 'Hello this is doctor testing', 27, 'Yes', 16, 1, 1, '2015-07-28 01:14:22', '2015-07-28 01:14:22', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `project_master`
--

DROP TABLE IF EXISTS `project_master`;
CREATE TABLE IF NOT EXISTS `project_master` (
  `project_id` bigint(11) NOT NULL auto_increment,
  `project_name` varchar(255) NOT NULL,
  `researcher_id` bigint(11) NOT NULL,
  `project_internal_note` text NOT NULL,
  `project_external_note` text NOT NULL,
  `project_status` tinyint(4) NOT NULL COMMENT '0-Inactive 1- Active 2-Close',
  `project_long_key` varchar(100) NOT NULL,
  `project_created_by` bigint(11) NOT NULL,
  `project_modified_by` bigint(11) NOT NULL,
  `project_createddate` datetime NOT NULL,
  `project_modifieddate` datetime NOT NULL,
  `project_remoteip` varchar(100) NOT NULL,
  PRIMARY KEY  (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_master`
--

INSERT INTO `project_master` (`project_id`, `project_name`, `researcher_id`, `project_internal_note`, `project_external_note`, `project_status`, `project_long_key`, `project_created_by`, `project_modified_by`, `project_createddate`, `project_modifieddate`, `project_remoteip`) VALUES
(1, 'proj', 1, 'rewiui', '', 1, 'e9f493dfc3c0c275947e40dc5be776bb', 1, 0, '2015-01-26 16:46:48', '2015-01-26 16:46:48', '127.0.0.1'),
(2, 'proj', 1, 'rewiui', '', 1, '5b4a2fde86f3c21df0f941dc8e04b684', 1, 0, '2015-01-26 16:57:05', '2015-01-26 16:57:05', '127.0.0.1'),
(3, 'Project 1', 1, '', '', 1, '89e85c7911774c688004767b3e1e8471', 1, 0, '2015-01-27 05:18:30', '2015-01-27 05:18:30', '127.0.0.1'),
(4, '', 0, '', '', 0, '389daddc443e7b159db6631553002c13', 1, 0, '2015-01-27 05:27:57', '2015-01-27 05:27:57', '127.0.0.1'),
(5, 'test', 1, 'test', '', 1, '6a2a9679597a78b19d89eacc827f9d8e', 1, 0, '2015-01-27 05:38:38', '2015-02-07 15:36:24', '127.0.0.1'),
(6, 'Rita demo project 54', 1, 'this is latest code project 1263', '', 1, 'b34935e326621f3cdf7eafa6076e3e94', 1, 0, '2015-02-07 14:22:22', '2015-02-10 06:22:12', '127.0.0.1'),
(7, 'testing for', 1, 'hi hello', 'this is external', 1, '62e32142a22bf7d079417184bc454836', 1, 1, '2015-02-09 14:04:47', '2015-05-01 10:34:25', '127.0.0.1'),
(8, 'clone-testing for', 1, 'hi hello', 'this is external', 1, '525a1d7ff4e703a8434db5e26869193f', 1, 1, '2015-02-10 13:07:47', '2015-03-02 17:46:27', '127.0.0.1'),
(9, 'clone-clone-testing for', 1, 'hi hello', 'this is external', 1, 'fc1998bf7297a76e9fd2f73a2bc14baf', 1, 1, '2015-03-04 05:44:41', '2015-03-04 05:44:41', '127.0.0.1'),
(10, 'clone-clone-clone-testing for', 1, 'hi hello', 'this is external', 2, '3efd27ba10d7ae8ee03ca6ee0fe5e7bc', 1, 1, '2015-03-06 13:55:35', '2015-04-09 13:28:37', '127.0.0.1'),
(11, 'fulltesting', 1, 'hdfhfghf', 'hi fgdg', 2, '949ecd5ea4735a0f0731904a7fed7b8e', 1, 1, '2015-03-19 13:56:20', '2015-04-10 07:27:31', '127.0.0.1'),
(12, 'clone-clone-clone-testing for', 1, 'hi hello', 'this is external', 1, '1f1f96e6b16f456168172bcaba00ea23', 1, 1, '2015-04-22 14:30:19', '2015-04-30 09:32:23', '127.0.0.1'),
(13, 'Fresh Project 1', 1, 'This fresh project', 'this is very much fresh project', 1, '3e6d66ba0c914b832440899c6952fcd2', 1, 1, '2015-05-07 06:40:04', '2015-05-07 06:40:04', '127.0.0.1'),
(14, 'Fresh Project 1', 1, 'This fresh project gh', 'this is very much fresh project', 1, '4d385e6f2a251dc50e5dbc156dfd8611', 1, 1, '2015-05-07 06:40:04', '2015-06-13 05:24:53', '127.0.0.1'),
(15, 'Rita testing act', 1, 'this is just for testing', 'this is just for testing', 1, '97735db2519e2ae68759d02a0d84fe70', 1, 1, '2015-07-19 10:29:24', '2015-07-19 10:29:24', '127.0.0.1'),
(16, 'Rita testing Act1', 1, 'This is just', 'this is just', 2, '328a5e7aca05999895928226f634ec09', 1, 1, '2015-07-19 10:30:56', '2015-07-19 10:30:56', '127.0.0.1'),
(17, 'clone-Rita testing Act1', 1, 'This is just', 'this is just', 2, '615a531313ed34cf70f1b9f12fdc42ad', 1, 1, '2015-07-30 07:35:40', '2015-07-30 07:35:40', '127.0.0.1'),
(18, 'clone-Rita testing Act1', 1, 'This is just', 'this is just', 2, '2e0578cab3467485516a9211bddf01bc', 1, 1, '2015-07-30 07:35:49', '2015-07-30 07:35:49', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `researcher_reward`
--

DROP TABLE IF EXISTS `researcher_reward`;
CREATE TABLE IF NOT EXISTS `researcher_reward` (
  `entry_id` bigint(11) NOT NULL auto_increment,
  `researcher_id` bigint(11) NOT NULL,
  `total_rewards` float NOT NULL,
  `reedeamed_rewards` float NOT NULL,
  `entry_by` bigint(11) NOT NULL,
  `entry_modified_by` bigint(11) NOT NULL,
  `entry_date` datetime NOT NULL,
  `entry_modified_date` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `researcher_reward`
--

INSERT INTO `researcher_reward` (`entry_id`, `researcher_id`, `total_rewards`, `reedeamed_rewards`, `entry_by`, `entry_modified_by`, `entry_date`, `entry_modified_date`, `entry_remote_ip`) VALUES
(1, 1, 118, 20, 1, 1, '2015-04-22 20:50:41', '0000-00-00 00:00:00', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `researcher_reward_details`
--

DROP TABLE IF EXISTS `researcher_reward_details`;
CREATE TABLE IF NOT EXISTS `researcher_reward_details` (
  `entry_id` bigint(11) NOT NULL auto_increment,
  `researcher_id` bigint(11) NOT NULL,
  `partner_id` bigint(11) NOT NULL,
  `project_id` bigint(11) NOT NULL,
  `cost` float NOT NULL,
  `reward_amt` float NOT NULL,
  `entry_created_by` bigint(11) NOT NULL,
  `entry_modified_by` bigint(11) NOT NULL,
  `entry_created_date` datetime NOT NULL,
  `entry_modified_date` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `researcher_reward_details`
--

INSERT INTO `researcher_reward_details` (`entry_id`, `researcher_id`, `partner_id`, `project_id`, `cost`, `reward_amt`, `entry_created_by`, `entry_modified_by`, `entry_created_date`, `entry_modified_date`, `entry_remote_ip`) VALUES
(1, 1, 2, 12, 10500, 105, 1, 1, '2015-04-22 15:20:41', '2015-04-30 08:41:16', '127.0.0.1'),
(2, 1, 2, 10, 0, 0, 1, 1, '2015-04-23 10:36:52', '2015-06-27 07:41:38', '127.0.0.1'),
(3, 1, 2, 11, 100, 1, 1, 1, '2015-06-27 06:17:47', '2015-06-27 07:40:00', '127.0.0.1'),
(4, 1, 3, 10, 200, 2, 1, 1, '2015-06-29 11:12:45', '2015-06-29 11:12:45', '127.0.0.1'),
(5, 1, 3, 16, 1000, 10, 1, 1, '2015-07-30 07:18:40', '2015-07-30 07:18:40', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `researcher_reward_requests`
--

DROP TABLE IF EXISTS `researcher_reward_requests`;
CREATE TABLE IF NOT EXISTS `researcher_reward_requests` (
  `entry_id` bigint(11) NOT NULL auto_increment,
  `researcher_id` bigint(11) NOT NULL,
  `reward_amt` float NOT NULL,
  `reward_method` int(11) NOT NULL,
  `notes` text NOT NULL,
  `status` smallint(6) NOT NULL COMMENT '0-Pending, 1- Approved',
  `request_by` bigint(11) NOT NULL,
  `request_date` datetime NOT NULL,
  `approved_by` bigint(11) NOT NULL,
  `approved_date` datetime NOT NULL,
  `entry_by` bigint(11) NOT NULL,
  `entry_modified_by` bigint(11) NOT NULL,
  `entry_date` datetime NOT NULL,
  `entry_modified_date` datetime NOT NULL,
  `entry_remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `researcher_reward_requests`
--

INSERT INTO `researcher_reward_requests` (`entry_id`, `researcher_id`, `reward_amt`, `reward_method`, `notes`, `status`, `request_by`, `request_date`, `approved_by`, `approved_date`, `entry_by`, `entry_modified_by`, `entry_date`, `entry_modified_date`, `entry_remote_ip`) VALUES
(1, 1, 10, 1, 'this is just testing', 0, 1, '2015-04-25 16:26:12', 0, '0000-00-00 00:00:00', 1, 1, '2015-04-25 16:26:12', '2015-04-25 16:26:12', '127.0.0.1'),
(2, 1, 10, 2, 'this is just testing', 0, 1, '2015-07-31 01:34:34', 0, '0000-00-00 00:00:00', 1, 1, '2015-07-31 01:34:34', '2015-07-31 01:34:34', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `session_log_master`
--

DROP TABLE IF EXISTS `session_log_master`;
CREATE TABLE IF NOT EXISTS `session_log_master` (
  `session_log_id` bigint(11) NOT NULL auto_increment,
  `user_id` bigint(11) NOT NULL,
  `remote_ip` varchar(100) NOT NULL,
  `last_access` datetime NOT NULL,
  `log_status` tinyint(1) NOT NULL COMMENT '0 - Login 1- Logout',
  PRIMARY KEY  (`session_log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_log_master`
--

INSERT INTO `session_log_master` (`session_log_id`, `user_id`, `remote_ip`, `last_access`, `log_status`) VALUES
(1, 1, '127.0.0.1', '2015-05-11 14:00:22', 0),
(2, 1, '127.0.0.1', '2015-05-11 14:00:37', 1),
(3, 1, '127.0.0.1', '2015-05-11 16:25:12', 0),
(4, 1, '127.0.0.1', '2015-05-13 13:42:10', 0),
(5, 1, '127.0.0.1', '2015-05-13 14:09:13', 1),
(6, 6, '127.0.0.1', '2015-05-13 14:09:35', 0),
(7, 6, '127.0.0.1', '2015-05-13 15:14:49', 1),
(8, 1, '127.0.0.1', '2015-05-13 15:15:05', 0),
(9, 1, '127.0.0.1', '2015-05-13 15:21:12', 1),
(10, 6, '127.0.0.1', '2015-05-13 15:21:37', 0),
(11, 6, '127.0.0.1', '2015-05-13 15:52:16', 1),
(12, 1, '127.0.0.1', '2015-05-13 15:52:41', 0),
(13, 1, '127.0.0.1', '2015-05-13 15:53:53', 1),
(14, 6, '127.0.0.1', '2015-05-21 17:00:23', 0),
(15, 6, '127.0.0.1', '2015-05-22 05:31:53', 0),
(16, 6, '127.0.0.1', '2015-05-22 05:43:22', 1),
(17, 6, '127.0.0.1', '2015-05-22 05:47:29', 0),
(18, 6, '127.0.0.1', '2015-05-22 09:46:05', 0),
(19, 6, '127.0.0.1', '2015-05-23 09:06:10', 0),
(20, 6, '127.0.0.1', '2015-05-23 10:18:11', 1),
(21, 1, '127.0.0.1', '2015-05-23 10:18:21', 0),
(22, 1, '127.0.0.1', '2015-05-23 10:18:54', 1),
(23, 6, '127.0.0.1', '2015-05-23 10:19:09', 0),
(24, 1, '127.0.0.1', '2015-05-26 07:41:07', 0),
(25, 6, '127.0.0.1', '2015-05-26 12:59:38', 0),
(26, 1, '127.0.0.1', '2015-06-01 08:02:32', 0),
(27, 1, '127.0.0.1', '2015-06-01 09:29:01', 1),
(28, 6, '127.0.0.1', '2015-06-01 09:29:14', 0),
(29, 6, '127.0.0.1', '2015-06-01 09:52:47', 1),
(30, 1, '127.0.0.1', '2015-06-01 09:52:58', 0),
(31, 6, '127.0.0.1', '2015-06-05 10:41:33', 0),
(32, 6, '127.0.0.1', '2015-06-05 10:43:32', 1),
(33, 1, '127.0.0.1', '2015-06-05 11:09:20', 0),
(34, 10, '127.0.0.1', '2015-06-06 14:40:39', 0),
(35, 6, '127.0.0.1', '2015-06-06 15:00:34', 0),
(36, 1, '127.0.0.1', '2015-06-08 09:11:35', 0),
(37, 1, '127.0.0.1', '2015-06-09 06:34:24', 0),
(38, 1, '127.0.0.1', '2015-06-09 06:40:50', 1),
(39, 1, '127.0.0.1', '2015-06-09 06:41:04', 0),
(40, 1, '127.0.0.1', '2015-06-09 08:54:04', 1),
(41, 1, '127.0.0.1', '2015-06-09 08:54:15', 0),
(42, 1, '127.0.0.1', '2015-06-09 09:07:01', 1),
(43, 1, '127.0.0.1', '2015-06-09 09:07:11', 0),
(44, 1, '127.0.0.1', '2015-06-09 09:12:03', 1),
(45, 1, '127.0.0.1', '2015-06-09 09:12:15', 0),
(46, 1, '127.0.0.1', '2015-06-13 05:03:14', 0),
(47, 1, '127.0.0.1', '2015-06-16 10:07:37', 0),
(48, 1, '127.0.0.1', '2015-06-19 05:34:21', 0),
(49, 1, '127.0.0.1', '2015-06-19 05:38:07', 1),
(50, 6, '127.0.0.1', '2015-06-19 05:38:18', 0),
(51, 6, '127.0.0.1', '2015-06-19 06:09:49', 1),
(52, 1, '127.0.0.1', '2015-06-19 06:10:03', 0),
(53, 1, '127.0.0.1', '2015-06-19 06:20:38', 1),
(54, 1, '127.0.0.1', '2015-06-19 06:21:09', 0),
(55, 1, '127.0.0.1', '2015-06-19 12:27:53', 0),
(56, 1, '127.0.0.1', '2015-06-20 05:18:04', 0),
(57, 1, '127.0.0.1', '2015-06-23 12:48:57', 0),
(58, 1, '127.0.0.1', '2015-06-24 03:52:50', 0),
(59, 1, '127.0.0.1', '2015-06-24 06:15:10', 1),
(60, 1, '127.0.0.1', '2015-06-26 07:26:50', 0),
(61, 1, '127.0.0.1', '2015-06-27 01:45:50', 0),
(62, 1, '127.0.0.1', '2015-06-29 01:38:29', 0),
(63, 1, '127.0.0.1', '2015-06-29 06:05:21', 0),
(64, 1, '127.0.0.1', '2015-06-29 09:57:37', 0),
(65, 1, '127.0.0.1', '2015-06-30 14:04:34', 0),
(66, 1, '127.0.0.1', '2015-06-30 14:12:45', 1),
(67, 6, '127.0.0.1', '2015-06-30 14:12:55', 0),
(68, 6, '127.0.0.1', '2015-06-30 14:13:15', 1),
(69, 1, '127.0.0.1', '2015-07-08 04:19:27', 0),
(70, 1, '127.0.0.1', '2015-07-08 05:44:48', 1),
(71, 6, '127.0.0.1', '2015-07-08 05:45:02', 0),
(72, 1, '127.0.0.1', '2015-07-09 01:26:18', 0),
(73, 6, '127.0.0.1', '2015-07-09 02:23:21', 0),
(74, 1, '127.0.0.1', '2015-07-14 03:44:29', 0),
(75, 1, '127.0.0.1', '2015-07-14 03:44:54', 1),
(76, 1, '127.0.0.1', '2015-07-18 09:20:00', 0),
(77, 1, '127.0.0.1', '2015-07-18 09:20:14', 1),
(78, 1, '127.0.0.1', '2015-07-19 10:16:47', 0),
(79, 1, '127.0.0.1', '2015-07-19 13:03:59', 0),
(80, 1, '127.0.0.1', '2015-07-28 01:05:13', 0),
(81, 1, '127.0.0.1', '2015-07-28 03:52:58', 0),
(82, 1, '127.0.0.1', '2015-07-30 04:20:20', 0),
(83, 6, '127.0.0.1', '2015-07-30 06:04:39', 0),
(84, 1, '127.0.0.1', '2015-07-30 10:38:52', 0),
(85, 1, '127.0.0.1', '2015-07-30 12:20:14', 1),
(86, 1, '127.0.0.1', '2015-07-30 12:21:13', 0),
(87, 1, '127.0.0.1', '2015-07-31 01:30:05', 0),
(88, 1, '127.0.0.1', '2015-08-10 03:33:06', 0),
(89, 1, '127.0.0.1', '2015-08-10 12:16:02', 0),
(90, 1, '127.0.0.1', '2015-08-10 12:26:17', 1),
(91, 6, '127.0.0.1', '2015-08-10 12:26:30', 0),
(92, 1, '127.0.0.1', '2015-08-11 09:42:32', 0),
(93, 1, '127.0.0.1', '2015-08-13 00:56:48', 0),
(94, 1, '127.0.0.1', '2015-08-13 01:24:20', 1),
(95, 6, '127.0.0.1', '2015-08-13 01:24:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_log`
--

DROP TABLE IF EXISTS `user_activity_log`;
CREATE TABLE IF NOT EXISTS `user_activity_log` (
  `activity_id` bigint(11) NOT NULL auto_increment,
  `company_id` bigint(11) NOT NULL,
  `company_type` tinyint(1) NOT NULL COMMENT '1-researcher, 2-PArtner',
  `user_id` bigint(11) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `activity_description` text NOT NULL,
  `activity_time` datetime NOT NULL,
  `remote_ip` varchar(100) NOT NULL,
  PRIMARY KEY  (`activity_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activity_log`
--

INSERT INTO `user_activity_log` (`activity_id`, `company_id`, `company_type`, `user_id`, `activity_type`, `activity_description`, `activity_time`, `remote_ip`) VALUES
(1, 1, 1, 1, 'Add Project', '1 has added new Rita testing act project', '2015-07-19 10:29:24', '127.0.0.1'),
(2, 1, 1, 1, 'Add Project', 'Rita Vyas has added new "Rita testing Act1" project', '2015-07-19 10:30:56', '127.0.0.1'),
(3, 1, 1, 1, 'Send Bid', 'Rita Vyas has sent to 6 on "clone-clone-testing for" project', '2015-07-19 13:23:19', '127.0.0.1'),
(4, 1, 1, 1, 'Add Project', 'Rita Vyas has added new "India B2B" project segment', '2015-07-28 01:09:46', '127.0.0.1'),
(5, 1, 1, 1, 'Add Project Segment', 'Rita Vyas has added new "Canada B2C" project segment', '2015-07-28 01:11:47', '127.0.0.1'),
(6, 1, 1, 1, 'ADD_FILE_TYPE', 'Rita Vyas has added new "Testing File" segment file', '2015-07-28 01:14:22', '127.0.0.1'),
(7, 1, 1, 1, 'Send Bid', 'Rita Vyas has sent to PP on "Rita testing Act1" project', '2015-07-30 05:57:23', '127.0.0.1'),
(8, 1, 1, 1, 'Send Bid', 'Rita Vyas has sent to TestPP on "Rita testing Act1" project', '2015-07-30 06:05:36', '127.0.0.1'),
(9, 1, 1, 1, 'Accept Bid', 'Rita Vyas has accepted bid of partner "TestPP" on "India&nbsp;B2B &nbsp;(India B2B)" segment for  project', '2015-07-30 06:10:35', '127.0.0.1'),
(10, 1, 1, 1, 'Add Project Segment', 'Rita Vyas has added new "BanIND" project segment', '2015-07-30 06:28:45', '127.0.0.1'),
(11, 1, 1, 1, 'Edit Project', 'Rita Vyas has edited new "BanIND" project segment', '2015-07-30 06:29:01', '127.0.0.1'),
(12, 1, 1, 1, 'Edit Project', 'Rita Vyas has edited new "BanIND" project segment', '2015-07-30 06:29:19', '127.0.0.1'),
(13, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:29:35', '127.0.0.1'),
(14, 1, 1, 1, 'Edit Project', 'Rita Vyas has edited new "BanIND" project segment', '2015-07-30 06:31:07', '127.0.0.1'),
(15, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:31:49', '127.0.0.1'),
(16, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:34:43', '127.0.0.1'),
(17, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:37:10', '127.0.0.1'),
(18, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:37:21', '127.0.0.1'),
(19, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:38:02', '127.0.0.1'),
(20, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:38:12', '127.0.0.1'),
(21, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:38:19', '127.0.0.1'),
(22, 1, 1, 1, 'Edit Project', 'Rita Vyas has edited new "BanIND" project segment', '2015-07-30 06:38:38', '127.0.0.1'),
(23, 1, 1, 1, 'Edit Project', 'Rita Vyas has edited new "BanIND" project segment', '2015-07-30 06:38:55', '127.0.0.1'),
(24, 1, 1, 1, 'Edit Project', 'Rita Vyas has edited new "Canada B2C" project segment', '2015-07-30 06:40:33', '127.0.0.1'),
(25, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "Canada B2C" of project "Rita testing Act1"', '2015-07-30 06:40:45', '127.0.0.1'),
(26, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "Canada B2C" of project "Rita testing Act1"', '2015-07-30 06:40:51', '127.0.0.1'),
(27, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:41:25', '127.0.0.1'),
(28, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:41:47', '127.0.0.1'),
(29, 1, 1, 1, 'Delete segment', 'Rita Vyas has deleted segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:48:53', '127.0.0.1'),
(30, 1, 1, 1, 'Enable segment', 'Rita Vyas has enabled segment "BanIND" of project "Rita testing Act1"', '2015-07-30 06:48:59', '127.0.0.1'),
(31, 1, 1, 1, 'Send Bid', 'Rita Vyas has sent to TestPP on "Rita testing Act1" project', '2015-07-30 06:51:20', '127.0.0.1'),
(32, 1, 1, 1, 'Accept Bid', 'Rita Vyas has accepted bid of partner "TestPP" on "Canada&nbsp;B2C &nbsp;(Canada B2C)" segment for  project', '2015-07-30 06:52:06', '127.0.0.1'),
(33, 1, 1, 1, 'Close Project', 'Rita Vyas has closed project "Rita testing Act1"', '2015-07-30 07:17:49', '127.0.0.1'),
(34, 1, 1, 1, 'Close Project', 'Rita Vyas has closed project "Rita testing Act1"', '2015-07-30 07:18:19', '127.0.0.1'),
(35, 1, 1, 1, 'Closing detail for partner', 'Rita Vyas has close project "" with partner "TestPP"', '2015-07-30 07:18:40', '127.0.0.1'),
(36, 1, 1, 1, 'Clone Project', 'Rita Vyas has clone project of "Rita testing Act1". New cloned project added "clone-Rita testing Act1"', '2015-07-30 07:35:40', '127.0.0.1'),
(37, 1, 1, 1, 'Add Project', 'Rita Vyas has added new "clone-Rita testing Act1" project', '2015-07-30 07:35:40', '127.0.0.1'),
(38, 1, 1, 1, 'Clone Project', 'Rita Vyas has clone project of "Rita testing Act1". New cloned project added "clone-Rita testing Act1"', '2015-07-30 07:35:49', '127.0.0.1'),
(39, 1, 1, 1, 'Add Project', 'Rita Vyas has added new "clone-Rita testing Act1" project', '2015-07-30 07:35:49', '127.0.0.1'),
(40, 1, 1, 1, 'Redeem rewards', 'Rita Vyas has redeem rewards point "$10" payment by Cheque', '2015-07-31 01:34:34', '127.0.0.1'),
(41, 1, 1, 1, '', 'User Rita Vyas has logged in successfully', '2015-08-10 03:33:06', '127.0.0.1'),
(42, 1, 1, 1, 'Close Project', 'Rita Vyas has closed project "clone-Rita testing Act1"', '2015-08-10 05:01:01', '127.0.0.1'),
(43, 1, 1, 1, 'Close Project', 'Rita Vyas has closed project "clone-Rita testing Act1"', '2015-08-10 05:01:06', '127.0.0.1'),
(44, 1, 1, 1, '', 'User Rita Vyas has logged in successfully', '2015-08-10 12:16:02', '127.0.0.1'),
(45, 1, 1, 1, '', 'User Rita Vyas has logged out successfully', '2015-08-10 12:26:17', '127.0.0.1'),
(46, 3, 2, 6, '', 'User Priyanka has logged in successfully', '2015-08-10 12:26:30', '127.0.0.1'),
(47, 1, 1, 1, '', 'User Rita Vyas has logged in successfully', '2015-08-11 09:42:32', '127.0.0.1'),
(48, 1, 1, 1, '', 'User Rita Vyas has logged in successfully', '2015-08-13 00:56:49', '127.0.0.1'),
(49, 1, 1, 1, '', 'User Rita Vyas has logged out successfully', '2015-08-13 01:24:20', '127.0.0.1'),
(50, 3, 2, 6, '', 'User Priyanka has logged in successfully', '2015-08-13 01:24:39', '127.0.0.1');
