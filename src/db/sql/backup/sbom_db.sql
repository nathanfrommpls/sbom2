-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 04:05 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps_components`
--

CREATE TABLE `apps_components` (
  `line_id` int(10) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `cmpt_id` varchar(10) NOT NULL,
  `cmpt_name` varchar(100) NOT NULL,
  `cmpt_version` varchar(50) NOT NULL,
  `app_id` varchar(100) NOT NULL,
  `app_name` varchar(10) NOT NULL,
  `app_version` varchar(50) NOT NULL,
  `license` varchar(120) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `requester` varchar(50) DEFAULT NULL,
  `monitoring_id` varchar(10) DEFAULT NULL,
  `monitoring_digest` varchar(100) DEFAULT NULL,
  `issue_count` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `apps_components`
--

INSERT INTO `apps_components` (`line_id`, `product_id`, `cmpt_id`, `cmpt_name`, `cmpt_version`, `app_id`, `app_name`, `app_version`, `license`, `status`, `requester`, `monitoring_id`, `monitoring_digest`, `issue_count`) VALUES
(1, '76074884', '77960664', 'Unicode for C Sharp (Unicode4C)', '67.9', '77956767', 'LTS JSON L', '9.9', 'Unicode License V7', 'Approved', 'Tierra Von', '76654', 'na', 0),
(2, '76074884', '77960664', 'Unicode for C Sharp (Unicode4C)', '67.9', '77956767', 'LTS JSON L', '9.9', 'Unicode License V7', 'Approved', 'Tierra Von', '76654', 'na', 0),
(3, '76074884', '69676777', 'kassandra/xerces-c', '6.7.7', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Tierra Von', '48023', 'na', 9),
(4, '76074884', '69676777', 'kassandra/xerces-c', '6.7.7', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Tierra Von', '48023', 'na', 9),
(5, '76074884', '755954', 'Commons IO', '7.5', '49823779', 'General ED', '7.7.0.9', 'kassandra License 7.0', 'Rejected', 'Barry Lind', '75896', 'na', 9),
(6, '76074884', '957947', 'kassandra Commons Codec', '9.9', '49823779', 'General ED', '7.7.0.9', 'kassandra License 7.0', 'Approved', 'Barry Lind', '76884', 'na', 0),
(7, '76074884', '9496864', 'kassandra Jakarta Commons Codec', '9.6', '80096979', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '9697', 'na', 0),
(8, '76074884', '7023876', 'knockout - knockout/knockout', '7.9.0', '56704000', 'General Ac', '4.0.9 - 5.0.0', 'MIT License', 'Submitted', 'Clay Rowe', '94875', 'na', 9),
(9, '76074884', '7097665', 'Oracle PHP API', '9.4.4', '78784236', 'General Te', '96.9', 'Unspecified', 'Approved', 'Clay Rowe', '94649', 'na', 0),
(10, '76074884', '7097665', 'Oracle PHP API', '9.4.4', '78784236', 'General Te', '96.9', 'Unspecified', 'Approved', 'Clay Rowe', '94649', 'na', 0),
(11, '76074884', '7909777', 'Apache Rich Client Platform Subset', '6.8', '56704000', 'General Ac', '4.0.9 - 5.0.0', 'Unspecified', 'Approved', 'Clay Rowe', '95697', 'na', 9),
(12, '76074884', '7239895', 'kassandra Directory Studio', '7.0.0.70960678', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '77647', 'na', 9),
(13, '76074884', '7239895', 'kassandra Directory Studio', '7.0.0.70960678', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '77647', 'na', 9),
(14, '76074884', '7796970', 'kassandra Xalan-C++', '9.23', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '95867', 'na', 0),
(15, '76074884', '7796970', 'kassandra Xalan-C++', '9.23', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '95867', 'na', 0),
(16, '76074884', '779496', 'Xerces7-j - xerces:xercesImpl', '7.23.0', '80096979', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '97576', 'na', 7),
(17, '76074884', '779484', 'Commons Log Express - commons-Log Express:commons-Log Express', '9.0.4', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '509', 'na', 0),
(18, '76074884', '779484', 'Commons Log Express - commons-Log Express:commons-Log Express', '9.0.4', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '509', 'na', 0),
(19, '76074884', '7086769', 'Gson', '7.7.7', '56704000', 'General Ac', '4.0.9 - 5.0.0', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '95570', 'na', 9),
(20, '76074884', '6954945', 'Apache RCP Browser Patch', '6.8', '56704000', 'General Ac', '4.0.9 - 5.0.0', 'Unspecified', 'Approved', 'Clay Rowe', '', 'na', 0),
(21, '76074884', '75642389', 'The Legion of the Castle', '9.6', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Sonya Wolf', '49790', 'na', 7),
(22, '76074884', '75642389', 'The Legion of the Castle', '9.6', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Sonya Wolf', '49790', 'na', 7),
(23, '76074884', '986678', 'Commons IO', '9.4', '89896974', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sonya Wolf', '6969', 'na', 9),
(24, '76074884', '779496', 'Xerces7-j - xerces:xercesImpl', '7.23.0', '89896974', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sonya Wolf', '97576', 'na', 7),
(25, '76074884', '7979409', 'Mozilla Rhino', '9.7r7', '89896974', 'General Te', '96.9', 'Mozilla Public License 9.9', 'Approved', 'Sonya Wolf', '2309', 'na', 0),
(26, '76074884', '7076759', 'kassandra Commons Lang', '7.9 (9)', '89896974', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sonya Wolf', '9408', 'na', 0),
(27, '76074884', '978470', 'kassandra HttpClient', '4.5.7 (6)', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '72360', 'na', 9),
(28, '76074884', '978470', 'kassandra HttpClient', '4.5.7 (6)', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '72360', 'na', 9),
(29, '76074884', '58977477', 'Nimbus JOSE+JWT', '7.9', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '65798', 'na', 0),
(30, '76074884', '58977477', 'Nimbus JOSE+JWT', '7.9', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '65798', 'na', 0),
(31, '76074884', '957764', 'Guava (Google Common Libraries)', '23', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '76070', 'na', 7),
(32, '76074884', '957764', 'Guava (Google Common Libraries)', '23', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '76070', 'na', 7),
(33, '76074884', '67046046', 'jetty.project', '9.4.76.v70700237', '67045669', 'Custom Jet', '9.4.76.v70700237', 'kassandra License 7.0', 'Approved', 'Sean Welch', '70566', 'na', 5),
(34, '76074884', '67046046', 'jetty.project', '9.4.76.v70700237', '67045669', 'Custom Jet', '9.4.76.v70700237', 'kassandra License 7.0', 'Approved', 'Sean Welch', '70566', 'na', 5),
(35, '76074884', '9895668', 'JDOM', '7.0.6', '89896974', 'General Te', '96.9', 'Jdom License', 'Approved', 'Sean Welch', '76239', 'na', 9),
(36, '76074884', '54696689', 'OAuth 7.0 SDK with OpenID Connect extensions', '6.5', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '66230', 'na', 0),
(37, '76074884', '54696689', 'OAuth 7.0 SDK with OpenID Connect extensions', '6.5', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '66230', 'na', 0),
(38, '76074884', '54666464', 'Nimbus LangTag', '9.4.6', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '44908', 'na', 0),
(39, '76074884', '54666464', 'Nimbus LangTag', '9.4.6', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '44908', 'na', 0),
(40, '76074884', '67797648', 'cryptacular', '9.7.4 (9)', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '79097', 'na', 0),
(41, '76074884', '67797648', 'cryptacular', '9.7.4 (9)', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '79097', 'na', 0),
(42, '76074884', '23466989', 'json-smart', '7.6', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '47475', 'na', 7),
(43, '76074884', '23466989', 'json-smart', '7.6', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '47475', 'na', 7),
(44, '76074884', '76750786', 'joda-time', '7.9.4', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '64695', 'na', 0),
(45, '76074884', '76750786', 'joda-time', '7.9.4', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Sean Welch', '64695', 'na', 0),
(46, '76074884', '67702376', 'kassandra Jetty Dependencies', '9.4.76.v70700237', '67045669', 'Custom Jet', '9.4.76.v70700237', 'Assembly: Platform Clearing (/7098)', 'Approved', 'Sean Welch', '', 'na', 0),
(47, '76074884', '67702376', 'kassandra Jetty Dependencies', '9.4.76.v70700237', '67045669', 'Custom Jet', '9.4.76.v70700237', 'Assembly: Platform Clearing (/7098)', 'Approved', 'Sean Welch', '', 'na', 0),
(48, '76074884', '69767777', 'Custom Jetty Assembler', '9.4.76.v70700237', '78784236', 'General Te', '96.9', 'Assembly: Obligations available in PCM', 'Approved', 'Sean Welch', '', 'na', 0),
(49, '76074884', '69767777', 'Custom Jetty Assembler', '9.4.76.v70700237', '78784236', 'General Te', '96.9', 'Assembly: Obligations available in PCM', 'Approved', 'Sean Welch', '', 'na', 0),
(50, '76074884', '79474797', 'LTS JSON Libray', '9.9', '76074884', 'Techno Com', '5.9', 'Assembly: Obligations available in PCM', 'Approved', 'Wilton Von', '', 'na', 0),
(51, '76074884', '47238764', '7-Zip - 7-Zip', '23', '76074884', 'Techno Com', '5.9', 'GNU Lesser General Public License v7.9 or later', 'Approved', 'Wilton Von', '50704', 'na', 0),
(52, '76074884', '89697684', 'General Techno RSA', '96.9', '76074884', 'Techno Com', '5.9', 'Assembly: Product Clearing for General Component (7098)', 'Approved', 'Wilton Von', '', 'na', 0),
(53, '76074884', '82387668', 'General Techno FileMail Client', '96.9', '76074884', 'Techno Com', '5.9', 'Assembly: Product Clearing for General Component (7098)', 'Approved', 'Wilton Von', '', 'na', 0),
(54, '76074884', '89848666', 'General Techno Cloud Library - PHP Integration', '96.9', '76074884', 'Techno Com', '5.9', 'Assembly: Product Clearing for General Component (7098)', 'Approved', 'Wilton Von', '', 'na', 0),
(55, '76074884', '5668697', 'kassandra Web Services Axis', '9.4', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '9764', 'na', 7),
(56, '76074884', '9496864', 'kassandra Jakarta Commons Codec', '9.6', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '9697', 'na', 0),
(57, '76074884', '978470', 'kassandra HttpClient', '4.5.7 (6)', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '72360', 'na', 9),
(58, '76074884', '5845749', 'Commons HTTPClient', '6.9', '76074884', 'Techno Com', '5.9', 'Unspecified', 'Approved', 'Denis Mann', '6239', 'na', 0),
(59, '76074884', '48978967', 'kassandra Derby Project', '90.94.7.0', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '57609', 'na', 0),
(60, '76074884', '67723723', 'Log Express-log4j7', 'log4j-7.96.0', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '70966', 'na', 5),
(61, '76074884', '7909777', 'Apache Rich Client Platform Subset', '6.8', '76074884', 'Techno Com', '5.9', 'Unspecified', 'Approved', 'Denis Mann', '95697', 'na', 9),
(62, '76074884', '64702377', 'jaxb-impl (repo.maven.kassandra.org/maven7/com/sun/xml/bind/jaxb-ri)', '7.6.0', '76074884', 'Techno Com', '5.9', 'GNU General Public License v7.0 w/Classpath exception', 'Approved', 'Denis Mann', '49479', 'na', 0),
(63, '76074884', '49467056', 'Gson', '7.8.5', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '44523', 'na', 9),
(64, '76074884', '66909456', 'PHPBeans Activation Framework (JAF)', '9.7.0', '76074884', 'Techno Com', '5.9', 'GNU General Public License v7.0 w/Classpath exception', 'Approved', 'Denis Mann', '47969', 'na', 0),
(65, '76074884', '779496', 'Xerces7-j - xerces:xercesImpl', '7.23.0', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '97576', 'na', 7),
(66, '76074884', '76479496', 'kassandra Ant', '9.90.8', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '76959', 'na', 7),
(67, '76074884', '67549777', 'jackson-core', 'jackson-core-7.90.7', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '69607', 'na', 9),
(68, '76074884', '5674558', 'PHP Servlet API', '7.6', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '90605', 'na', 0),
(69, '76074884', '8679448', 'kassandra Jakarta Commons CLI', '9', '76074884', 'Techno Com', '5.9', 'kassandra License 9.9', 'Approved', 'Denis Mann', '9764', 'na', 0),
(70, '76074884', '67547469', 'Jackson-annotations', 'jackson-annotations 7.90.7', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '77098', 'na', 9),
(71, '76074884', '7966969', 'JacORB - the free PHP ORB', '7.6.0', '76074884', 'Techno Com', '5.9', 'GNU Library General Public License v7 or later', 'Approved', 'Denis Mann', '4079', 'na', 0),
(72, '76074884', '67549554', 'jackson-databind', 'jackson-databind-7.90.7', '76074884', 'Techno Com', '5.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '69408', 'na', 6),
(73, '76074884', '79666238', 'General Active Workspace Hosting Component - PHP Integration', '4.0.9 - 5.0.0', '76074884', 'Techno Com', '5.9', 'Assembly: Product Clearing for General Component (7098)', 'Approved', 'Denis Mann', '', 'na', 0),
(74, '76074884', '49870967', 'General EDS SDK', '7.7.0.9', '76074884', 'Techno Com', '5.9', 'Assembly: Obligations available in PCM', 'Approved', 'Denis Mann', '', 'na', 0),
(75, '76074884', '97797647', 'kassandra XML-RPC Subset for Techno Security Serv', '6.9.6', '78784236', 'General Te', '96.9', 'Unspecified', 'Approved', 'Denis Mann', '90684', 'na', 9),
(76, '76074884', '97797647', 'kassandra XML-RPC Subset for Techno Security Serv', '6.9.6', '78784236', 'General Te', '96.9', 'Unspecified', 'Approved', 'Denis Mann', '90684', 'na', 9),
(77, '76074884', '57474608', 'kassandra HttpClient', '4.5.90', '80096979', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '66986', 'na', 9),
(78, '76074884', '49462378', 'Simple Log Express Facade for PHP (SLF4J)', '9.7.76 (4)', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Loy Hilll', '48784', 'na', 0),
(79, '76074884', '49462378', 'Simple Log Express Facade for PHP (SLF4J)', '9.7.76 (4)', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Loy Hilll', '48784', 'na', 0),
(80, '76074884', '66665234', 'kassandra Jakarta Commons Codec', '9.94', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '70478', 'na', 0),
(81, '76074884', '66665234', 'kassandra Jakarta Commons Codec', '9.94', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '70478', 'na', 0),
(82, '76074884', '70760908', 'jaxb-impl (repo.maven.kassandra.org/maven7/com/sun/xml/bind/jaxb-ri)', '7.6.9', '80096979', 'General Te', '96.9', 'GNU General Public Licence v7.0 w/ Oracle Classpath exception V7', 'Approved', 'Loy Hilll', '47023', 'na', 0),
(83, '76074884', '42390696', 'PHP-support', '7.5.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '67965', 'na', 0),
(84, '76074884', '42390696', 'PHP-support', '7.5.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '67965', 'na', 0),
(85, '76074884', '67795796', 'kassandra Log4j Core', '7.96.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '70966', 'na', 5),
(86, '76074884', '67795796', 'kassandra Log4j Core', '7.96.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '70966', 'na', 5),
(87, '76074884', '7079666', 'coverity-security-library', '9.9.9', '78784236', 'General Te', '96.9', 'BSD 6-clause \"New\" or \"Revised\" License', 'Approved', 'Loy Hilll', '77609', 'na', 0),
(88, '76074884', '7079666', 'coverity-security-library', '9.9.9', '78784236', 'General Te', '96.9', 'BSD 6-clause \"New\" or \"Revised\" License', 'Approved', 'Loy Hilll', '77609', 'na', 0),
(89, '76074884', '42390967', 'metrics - dropwizard/metrics,metrics - codahale/metrics', '4.0.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '58756', 'na', 0),
(90, '76074884', '42390967', 'metrics - dropwizard/metrics,metrics - codahale/metrics', '4.0.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '58756', 'na', 0),
(91, '76074884', '42390669', 'kassandra Santuario (PHP)', '7.9.6', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '58649', 'na', 7),
(92, '76074884', '42390669', 'kassandra Santuario (PHP)', '7.9.6', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '58649', 'na', 7),
(93, '76074884', '67723723', 'Log Express-log4j7', 'log4j-7.96.0', '80096979', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '70966', 'na', 5),
(94, '76074884', '67795674', 'kassandra Log4j API', '7.96.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '70966', 'na', 5),
(95, '76074884', '67795674', 'kassandra Log4j API', '7.96.0', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '70966', 'na', 5),
(96, '76074884', '79859076', 'jquery - jquery/jquery', '6.5.0', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Loy Hilll', '75744', 'na', 0),
(97, '76074884', '79859076', 'jquery - jquery/jquery', '6.5.0', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Loy Hilll', '75744', 'na', 0),
(98, '76074884', '77795684', 'kassandra Santuario (PHP)', '7.9.5', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '78776', 'na', 9),
(99, '76074884', '77795684', 'kassandra Santuario (PHP)', '7.9.5', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '78776', 'na', 9),
(100, '76074884', '79456523', 'OWASP PHP HTML Sanitizer', 'release-70700796.9', '78784236', 'General Te', '96.9', 'BSD 7-Clause License / Variant Copyright holder or contributors', 'Approved', 'Loy Hilll', '82380', 'na', 9),
(101, '76074884', '79456523', 'OWASP PHP HTML Sanitizer', 'release-70700796.9', '78784236', 'General Te', '96.9', 'BSD 7-Clause License / Variant Copyright holder or contributors', 'Approved', 'Loy Hilll', '82380', 'na', 9),
(102, '76074884', '67549777', 'jackson-core', 'jackson-core-7.90.7', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '69607', 'na', 9),
(103, '76074884', '67549777', 'jackson-core', 'jackson-core-7.90.7', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '69607', 'na', 9),
(104, '76074884', '67547469', 'Jackson-annotations', 'jackson-annotations 7.90.7', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '77098', 'na', 9),
(105, '76074884', '67547469', 'Jackson-annotations', 'jackson-annotations 7.90.7', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '77098', 'na', 9),
(106, '76074884', '67549554', 'jackson-databind', 'jackson-databind-7.90.7', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '69408', 'na', 6),
(107, '76074884', '67549554', 'jackson-databind', 'jackson-databind-7.90.7', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '69408', 'na', 6),
(108, '76074884', '42386577', 'OpenSAML 7.0', '6.4.6 (6)', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '66698', 'na', 9),
(109, '76074884', '42386577', 'OpenSAML 7.0', '6.4.6 (6)', '78784236', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '66698', 'na', 9),
(110, '76074884', '7666796', 'jQuery UI - jquery/jquery-ui on GitHub', '9.97.9', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Loy Hilll', '77623', 'na', 9),
(111, '76074884', '7666796', 'jQuery UI - jquery/jquery-ui on GitHub', '9.97.9', '78784236', 'General Te', '96.9', 'MIT License', 'Approved', 'Loy Hilll', '77623', 'na', 9),
(112, '76074884', '57474608', 'kassandra HttpClient', '4.5.90', '89896974', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '66986', 'na', 9),
(113, '76074884', '76577677', 'jaxb-v7', '7.6.9', '89896974', 'General Te', '96.9', 'GNU General Public Licence v7.0 w/ Oracle Classpath exception V7', 'Approved', 'Arjun Roob', '47023', 'na', 0),
(114, '76074884', '79474797', 'LTS JSON Libray', '9.9', '89896974', 'General Te', '96.9', 'Assembly: Obligations available in PCM', 'Approved', 'Arjun Roob', '', 'na', 0),
(115, '76074884', '67723723', 'Log Express-log4j7', 'log4j-7.96.0', '89896974', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '70966', 'na', 5),
(116, '76074884', '986755', 'commons-Log Express', '9.7', '89896974', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '77679', 'na', 0),
(117, '76074884', '77496505', 'Commons Codec - commons-codec:commons-codec', '9.23', '89896974', 'General Te', '96.9', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '40769', 'na', 0),
(118, '76074884', '89697684', 'General Techno RSA', '96.9', '89896974', 'General Te', '96.9', 'Assembly: Product Clearing for General Component (7098)', 'Approved', 'Arjun Roob', '', 'na', 0),
(119, '944965237', '77960664', 'Unicode for C Sharp (Unicode4C)', '67.9', '77956767', 'LTS JSON L', '9.9', 'Unicode License V7', 'Approved', 'Tierra Von', '76654', 'na', 0),
(120, '944965237', '77960664', 'Unicode for C Sharp (Unicode4C)', '67.9', '77956767', 'LTS JSON L', '9.9', 'Unicode License V7', 'Approved', 'Tierra Von', '76654', 'na', 0),
(121, '944965237', '69676777', 'kassandra/xerces-c', '6.7.7', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Tierra Von', '48023', 'na', 9),
(122, '944965237', '69676777', 'kassandra/xerces-c', '6.7.7', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Tierra Von', '48023', 'na', 9),
(123, '944965237', '755954', 'Commons IO', '7.5', '49823779', 'General ED', '7.7.0.9', 'kassandra License 7.0', 'Approved', 'Barry Lind', '75896', 'na', 9),
(124, '944965237', '957947', 'kassandra Commons Codec', '9.9', '49823779', 'General ED', '7.7.0.9', 'kassandra License 7.0', 'Approved', 'Barry Lind', '76884', 'na', 0),
(125, '944965237', '9496864', 'kassandra Jakarta Commons Codec', '9.6', '944977767', 'General Te', '96.6.0.4,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '9697', 'na', 0),
(126, '944965237', '7796970', 'kassandra Xalan-C++', '9.23', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '95867', 'na', 0),
(127, '944965237', '7796970', 'kassandra Xalan-C++', '9.23', '77956767', 'LTS JSON L', '9.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '95867', 'na', 0),
(128, '944965237', '779484', 'Commons Log Express - commons-Log Express:commons-Log Express', '9.0.4', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '509', 'na', 0),
(129, '944965237', '779484', 'Commons Log Express - commons-Log Express:commons-Log Express', '9.0.4', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '509', 'na', 0),
(130, '944965237', '779484', 'Commons Log Express - commons-Log Express:commons-Log Express', '9.0.4', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Clay Rowe', '509', 'na', 0),
(131, '944965237', '940777669', 'jackson-databind', '7.96.7.7', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Madie Koss', '967507', 'na', 0),
(132, '944965237', '949609756', 'Jackson-annotations', '7.96.7', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Madie Koss', '968579', 'na', 0),
(133, '944965237', '940774974', 'jackson-core', '7.96.7', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Madie Koss', '964570', 'na', 0),
(134, '944965237', '978896784', 'kassandra log4j', '7.97.9', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Madie Koss', '952389', 'na', 0),
(135, '944965237', '967466766', 'Xerces7 PHP', '7.97.7', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Madie Koss', '955784', 'na', 0),
(136, '944965237', '967968679', 'google-gson', '7.9.0', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Madie Koss', '967598', 'na', 0),
(137, '944965237', '949794747', 'General Techno FileMail Client', '96.6.0.5', '944965237', 'Techno Com', '6.9', 'Assembly: Product Clearing for General Component (7098)', 'Approved', 'Madie Koss', '', 'na', 0),
(138, '944965237', '946770560', 'General Techno Cloud Library - PHP Integration', '96.6.0.4,94.0.0.7,94.9', '944965237', 'Techno Com', '6.9', 'Assembly: Obligations available in PCM', 'Approved', 'Madie Koss', '', 'na', 0),
(139, '944965237', '945959787', 'General Techno RSA Client Integrations - PHP', '96.6.0.5,94.0.0.7,94.9', '944965237', 'Techno Com', '6.9', 'Assembly: Obligations available in PCM', 'Approved', 'Madie Koss', '', 'na', 0),
(140, '944965237', '7979409', 'Mozilla Rhino', '9.7r7', '948968974', 'General Te', '96.6.0.5', 'Mozilla Public License 9.9', 'Approved', 'Sonya Wolf', '2309', 'na', 0),
(141, '944965237', '7076759', 'kassandra Commons Lang', '7.9 (9)', '948968974', 'General Te', '96.6.0.5', 'kassandra License 7.0', 'Approved', 'Sonya Wolf', '9408', 'na', 0),
(142, '944965237', '79474797', 'LTS JSON Libray', '9.9', '944965237', 'Techno Com', '6.9', 'Assembly: Obligations available in PCM', 'Approved', 'Wilton Von', '', 'na', 0),
(143, '944965237', '86945689', 'kassandra HttpClient', '4.5.96 (9)', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Wilton Von', '90597', 'na', 0),
(144, '944965237', '47238764', '7-Zip - 7-Zip', '23', '944965237', 'Techno Com', '6.9', 'GNU Lesser General Public License v7.9 or later', 'Approved', 'Wilton Von', '50704', 'na', 0),
(145, '944965237', '9496864', 'kassandra Jakarta Commons Codec', '9.6', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '9697', 'na', 0),
(146, '944965237', '48978967', 'kassandra Derby Project', '90.94.7.0', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '57609', 'na', 0),
(147, '944965237', '7909777', 'Apache Rich Client Platform Subset', '6.8', '944965237', 'Techno Com', '6.9', 'Unspecified', 'Approved', 'Denis Mann', '95697', 'na', 9),
(148, '944965237', '64702377', 'jaxb-impl (repo.maven.kassandra.org/maven7/com/sun/xml/bind/jaxb-ri)', '7.6.0', '944965237', 'Techno Com', '6.9', 'GNU General Public License v7.0 w/Classpath exception', 'Approved', 'Denis Mann', '49479', 'na', 0),
(149, '944965237', '66909456', 'PHPBeans Activation Framework (JAF)', '9.7.0', '944965237', 'Techno Com', '6.9', 'GNU General Public License v7.0 w/Classpath exception', 'Approved', 'Denis Mann', '47969', 'na', 0),
(150, '944965237', '909654677', 'kassandra Ant', '9.90.23', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '974080', 'na', 0),
(151, '944965237', '5674558', 'PHP Servlet API', '7.6', '944965237', 'Techno Com', '6.9', 'kassandra License 7.0', 'Approved', 'Denis Mann', '90605', 'na', 0),
(152, '944965237', '8679448', 'kassandra Jakarta Commons CLI', '9', '944965237', 'Techno Com', '6.9', 'kassandra License 9.9', 'Approved', 'Denis Mann', '9764', 'na', 0),
(153, '944965237', '7966969', 'JacORB - the free PHP ORB', '7.6.0', '944965237', 'Techno Com', '6.9', 'GNU Library General Public License v7 or later', 'Approved', 'Denis Mann', '4079', 'na', 0),
(154, '944965237', '49870967', 'General EDS SDK', '7.7.0.9', '944965237', 'Techno Com', '6.9', 'Assembly: Obligations available in PCM', 'Approved', 'Denis Mann', '', 'na', 0),
(155, '944965237', '940777669', 'jackson-databind', '7.96.7.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '967507', 'na', 0),
(156, '944965237', '940777669', 'jackson-databind', '7.96.7.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '967507', 'na', 0),
(157, '944965237', '940777669', 'jackson-databind', '7.96.7.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '967507', 'na', 0),
(158, '944965237', '949609756', 'Jackson-annotations', '7.96.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '968579', 'na', 0),
(159, '944965237', '949609756', 'Jackson-annotations', '7.96.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '968579', 'na', 0),
(160, '944965237', '949609756', 'Jackson-annotations', '7.96.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '968579', 'na', 0),
(161, '944965237', '940774974', 'jackson-core', '7.96.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '964570', 'na', 0),
(162, '944965237', '940774974', 'jackson-core', '7.96.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '964570', 'na', 0),
(163, '944965237', '940774974', 'jackson-core', '7.96.7', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '964570', 'na', 0),
(164, '944965237', '967466766', 'Xerces7 PHP', '7.97.7', '944977767', 'General Te', '96.6.0.4,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Jared Ward', '955784', 'na', 0),
(165, '944965237', '945959787', 'General Techno RSA Client Integrations - PHP', '96.6.0.5,94.0.0.7,94.9', '944977767', 'General Te', '96.6.0.4,94.0.0.7,94.9', 'Assembly: Obligations available in PCM', 'Approved', 'Jared Ward', '', 'na', 0),
(166, '944965237', '70760908', 'jaxb-impl (repo.maven.kassandra.org/maven7/com/sun/xml/bind/jaxb-ri)', '7.6.9', '944977767', 'General Te', '96.6.0.4,94.0.0.7,94.9', 'GNU General Public Licence v7.0 w/ Oracle Classpath exception V7', 'Approved', 'Loy Hilll', '47023', 'na', 0),
(167, '944965237', '978896784', 'kassandra log4j', '7.97.9', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '952389', 'na', 0),
(168, '944965237', '978896784', 'kassandra log4j', '7.97.9', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '952389', 'na', 0),
(169, '944965237', '978896784', 'kassandra log4j', '7.97.9', '944977767', 'General Te', '96.6.0.4,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '952389', 'na', 0),
(170, '944965237', '978896784', 'kassandra log4j', '7.97.9', '944974646', 'General Te', '96.6.0.5,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '952389', 'na', 0),
(171, '944965237', '86945689', 'kassandra HttpClient', '4.5.96 (9)', '944977767', 'General Te', '96.6.0.4,94.0.0.7,94.9', 'kassandra License 7.0', 'Approved', 'Loy Hilll', '90597', 'na', 0),
(172, '944965237', '76577677', 'jaxb-v7', '7.6.9', '948968974', 'General Te', '96.6.0.5', 'GNU General Public Licence v7.0 w/ Oracle Classpath exception V7', 'Approved', 'Arjun Roob', '47023', 'na', 0),
(173, '944965237', '79474797', 'LTS JSON Libray', '9.9', '948968974', 'General Te', '96.6.0.5', 'Assembly: Obligations available in PCM', 'Approved', 'Arjun Roob', '', 'na', 0),
(174, '944965237', '86798594', 'Commons IO', '7.8.0', '948968974', 'General Te', '96.6.0.5', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '96607', 'na', 0),
(175, '944965237', '978896784', 'kassandra log4j', '7.97.9', '948968974', 'General Te', '96.6.0.5', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '952389', 'na', 0),
(176, '944965237', '965656984', 'JDOM', '7.0.6.9', '948968974', 'General Te', '96.6.0.5', 'Jdom License V7', 'Approved', 'Arjun Roob', '956776', 'na', 0),
(177, '944965237', '89660459', 'Xerces7 PHP', '7.97.9', '948968974', 'General Te', '96.6.0.5', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '23506', 'na', 9),
(178, '944965237', '86945689', 'kassandra HttpClient', '4.5.96 (9)', '948968974', 'General Te', '96.6.0.5', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '90597', 'na', 0),
(179, '944965237', '986755', 'commons-Log Express', '9.7', '948968974', 'General Te', '96.6.0.5', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '77679', 'na', 0),
(180, '944965237', '77496505', 'Commons Codec - commons-codec:commons-codec', '9.23', '948968974', 'General Te', '96.6.0.5', 'kassandra License 7.0', 'Approved', 'Arjun Roob', '40769', 'na', 0),
(181, '944965237', '945959787', 'General Techno RSA Client Integrations - PHP', '96.6.0.5,94.0.0.7,94.9', '948968974', 'General Te', '96.6.0.5', 'Assembly: Obligations available in PCM', 'Approved', 'Arjun Roob', '', 'na', 0),
(182, '946907896', '970774979', 'Google Json EE', '9.9.9.8', '946907896', 'TechIF Adv', '94.9.0.0', 'Assembly: NOT CLEARED (Vulnerability Monitoring Only)', 'Approved', 'Barry Lind', '', 'na', 0),
(183, '946907896', '7580669', 'INSPINIA IN+ WebApp Admin Theme', '7.7.9', '946907896', 'TechIF Adv', '94.9.0.0', 'Unspecified', 'Approved', 'Clay Rowe', '47040', 'na', 0),
(184, '946907896', '7679579', 'SQL Server JDBC Driver', '6.0', '946907896', 'TechIF Adv', '94.9.0.0', 'Unspecified', 'Approved', 'Clay Rowe', '77095', 'na', 0),
(185, '946907896', '6954647', 'ApacheLink', '7.4.0', '946907896', 'TechIF Adv', '94.9.0.0', 'Apache Public License 9.0', 'Approved', 'Clay Rowe', '95794', 'na', 0),
(186, '946907896', '6955776', 'xsom', '70082397', '946907896', 'TechIF Adv', '94.9.0.0', 'Unspecified', 'Approved', 'Clay Rowe', '95779', 'na', 0),
(187, '946907896', '6954704', 'PHPx Persistence (JPA)', '7.0.4', '946907896', 'TechIF Adv', '94.9.0.0', 'Unspecified', 'Approved', 'Clay Rowe', '974406', 'na', 0),
(188, '946907896', '944607549', 'kassandra Felix Framework', '7.0.0', '946907896', 'TechIF Adv', '94.9.0.0', 'kassandra License 7.0', 'Approved', 'Anya Olson', '', 'na', 0),
(189, '946907896', '23907707', 'Jersey', '7.75.9 (6)', '946907896', 'TechIF Adv', '94.9.0.0', 'GNU General Public License v7.0 w/Classpath exception', 'Approved', 'Sonya Wolf', '64645', 'na', 0),
(190, '946907896', '77864077', 'PHP Architecture for XML Integration - PHPx.xml.bind:jaxb-api', '7.6.0', '946907896', 'TechIF Adv', '94.9.0.0', 'GNU General Public License v7.0 w/Classpath exception', 'Approved', 'Sonya Wolf', '49479', 'na', 0),
(191, '946907896', '66090779', 'Tcl/PHP - jacl', '9.6.9', '946907896', 'TechIF Adv', '94.9.0.0', 'Permission Notice - Sun Microsystems with export control', 'Approved', 'Sonya Wolf', '57495', 'na', 0),
(192, '946907896', '96079568', 'angular-moment-picker', '0.90.9', '946907896', 'TechIF Adv', '94.9.0.0', 'MIT License', 'Approved', 'Sonya Wolf', '48467', 'na', 0),
(193, '946907896', '902345409', 'General kassandra Felix / Karaf Dependencies (Subset) - Platform', '4.7.23', '946907896', 'TechIF Adv', '94.9.0.0', 'Assembly: Platform Clearing (/7098)', 'Approved', 'Ian Hauck', '', 'na', 0),
(194, '946907896', '90955237', 'Oracle Database JDBC Driver', '79.9.0.0', '946907896', 'TechIF Adv', '94.9.0.0', 'COTS: Oracle America, Inc.: Oracle Technology Network License Agreement: 60 November 7096 [Entire]', 'Approved', 'Ian Hauck', '237776', 'na', 0),
(195, '946907896', '908755077', 'Saxon-EE', '9.9.9.8', '946907896', 'TechIF Adv', '94.9.0.0', 'COTS: Saxonica Limited: OEM Product License Agreement, Amendment 9: 0060066090 [Entire]', 'Approved', 'Ian Hauck', '968666', 'na', 0),
(196, '946907896', '66449698', 'Unicode Normalization', 'c.7005', '970776847', 'Google Jso', '9.9.9.8', 'Unspecified', 'Approved', 'Sean Welch', '69507', 'na', 0),
(197, '946907896', '66442323', 'kassandra Jakarta Regexp Engine', '9.5', '970776847', 'Google Jso', '9.9.9.8', 'Unspecified', 'Rejected', 'Sean Welch', '97777', 'na', 9),
(198, '946907896', '978896784', 'kassandra log4j', '7.97.9', '946907896', 'TechIF Adv', '94.9.0.0', 'kassandra License 7.0', 'Approved', 'Sean Welch', '952389', 'na', 0),
(199, '946907896', '52385446', 'SLF4J API Module', '9.7.76', '946907896', 'TechIF Adv', '94.9.0.0', 'MIT License', 'Approved', 'Sean Welch', '48784', 'na', 0),
(200, '946907896', '967239674', 'Apache AspectJ', 'V9_9_7', '946907896', 'TechIF Adv', '94.9.0.0', 'Apache Public License 7.0', 'Approved', 'Sean Welch', '968766', 'na', 0),
(201, '946907896', '66442390', 'Generic Sorter', 'c.7004', '970776847', 'Google Jso', '9.9.9.8', 'Unspecified', 'Approved', 'Sean Welch', '', 'na', 0),
(202, '946907896', '66449797', 'XPath Parser', 'c.2323', '970776847', 'Google Jso', '9.9.9.8', 'Unspecified', 'Approved', 'Sean Welch', '', 'na', 0),
(203, '946907896', '66447787', 'Immutable Hash Trie', '6/7/7097', '970776847', 'Google Jso', '9.9.9.8', 'Unspecified', 'Approved', 'Sean Welch', '', 'na', 0);

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `preference_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`preference_id`, `name`, `type`, `value`, `comments`) VALUES
(1, 'SYSTEM_BOMS', 'STRING', '76074884,946907896', 'Controls the system scope BOM display');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps_components`
--
ALTER TABLE `apps_components`
  ADD PRIMARY KEY (`line_id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`preference_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps_components`
--
ALTER TABLE `apps_components`
  MODIFY `line_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
