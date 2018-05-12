-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Maio-2018 às 03:09
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diversificainvestimentos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_commission`
--

CREATE TABLE `rs_commission` (
  `idCommission` int(11) NOT NULL,
  `groupProfit` float NOT NULL,
  `paymentMethod` varchar(45) COLLATE utf8_bin NOT NULL,
  `dateUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `rs_commission`
--

INSERT INTO `rs_commission` (`idCommission`, `groupProfit`, `paymentMethod`, `dateUpdated`) VALUES
(1, 0.03, 'Dogecoin', '2017-12-24 19:48:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_companies`
--

CREATE TABLE `rs_companies` (
  `idCompany` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `site` varchar(150) COLLATE utf8_bin NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `rs_companies`
--

INSERT INTO `rs_companies` (`idCompany`, `name`, `site`, `dateCreated`, `active`) VALUES
(1, 'Genesis-Mining', 'https://www.genesis-mining.com/a/269210', '2017-10-14 20:48:09', 1),
(2, 'HashFlare', 'https://hashflare.io/r/2718D801', '2017-10-14 20:49:14', 1),
(3, 'Maximus Digital', 'https://private.maximus.digital/MaxNet/user_profile/81223cdbc423187751dd0add951d40a3665fea99ecbc3133cba791ee846f58db', '2017-10-14 21:56:00', 0),
(4, 'Berkley Invest.', 'http://berkleyinvest.com/painel/patrocinador/danilomobr', '2017-10-14 22:08:26', 1),
(5, 'TDC Invest.', 'https://goo.gl/ipMbSY', '2017-10-14 22:11:38', 1),
(6, 'BitBull', 'https://bitbull.pro/ref/9c9f0154', '2017-10-14 22:12:26', 0),
(7, 'TCI Invest.', 'https://tci.group/?referral=danilomobr97', '2017-10-18 17:41:30', 0),
(8, 'CredClub', 'https://credclub.net/cadastro/danilomobr', '2017-11-15 19:07:17', 1),
(9, 'BitClub Network', 'https://bitclubnetwork.com/danilomobr/signup.html', '2017-12-03 01:26:16', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_countries`
--

CREATE TABLE `rs_countries` (
  `idCountry` int(11) NOT NULL,
  `code` varchar(2) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rs_countries`
--

INSERT INTO `rs_countries` (`idCountry`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People\'s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_incomes`
--

CREATE TABLE `rs_incomes` (
  `idIncome` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `fixed` int(1) DEFAULT '0',
  `date` date DEFAULT NULL,
  `profit` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rs_incomes`
--

INSERT INTO `rs_incomes` (`idIncome`, `idCompany`, `fixed`, `date`, `profit`) VALUES
(1, 1, 1, '2017-10-01', 0.2),
(2, 2, 1, '2017-10-01', 0.26),
(17, 4, 0, '2017-10-02', 0.15),
(18, 4, 0, '2017-10-03', 0.04),
(19, 4, 0, '2017-10-04', 0.03),
(20, 4, 0, '2017-10-05', 0.16),
(21, 4, 0, '2017-10-06', 0.32),
(22, 4, 0, '2017-10-09', 0.11),
(23, 4, 0, '2017-10-10', 0.17),
(24, 4, 0, '2017-10-11', 0.34),
(25, 4, 0, '2017-10-13', 0.15),
(26, 4, 0, '2017-10-16', 0.12),
(27, 4, 0, '2017-10-17', 0.18),
(28, 4, 0, '2017-10-18', 0.17),
(29, 4, 0, '2017-10-19', 0.35),
(30, 4, 0, '2017-10-20', 0.13),
(31, 5, 0, '2017-10-01', 0.42),
(32, 5, 0, '2017-10-02', 0.29),
(33, 5, 0, '2017-10-03', 0.31),
(34, 5, 0, '2017-10-04', 0.21),
(35, 5, 0, '2017-10-05', 0.49),
(36, 5, 0, '2017-10-06', 0.28),
(37, 5, 0, '2017-10-07', 0.32),
(38, 5, 0, '2017-10-08', 0.28),
(39, 5, 0, '2017-10-09', 0.39),
(40, 5, 0, '2017-10-10', 0.29),
(41, 5, 0, '2017-10-11', 0.3),
(42, 5, 0, '2017-10-12', 0.26),
(43, 5, 0, '2017-10-13', 0.29),
(44, 5, 0, '2017-10-14', 0.31),
(45, 5, 0, '2017-10-15', 0.36),
(46, 5, 0, '2017-10-16', 0.28),
(47, 5, 0, '2017-10-17', 0.29),
(48, 5, 0, '2017-10-18', 0.34),
(49, 5, 0, '2017-10-19', 0.32),
(50, 5, 0, '2017-10-20', 0.33),
(51, 5, 0, '2017-10-21', 0.26),
(52, 6, 0, '2017-10-02', 0.3),
(53, 6, 0, '2017-10-03', 0.31),
(54, 6, 0, '2017-10-04', 0.35),
(55, 6, 0, '2017-10-05', 0.26),
(56, 6, 0, '2017-10-06', 0.29),
(57, 6, 0, '2017-10-09', 0.28),
(58, 6, 0, '2017-10-10', 0.33),
(59, 6, 0, '2017-10-11', 0.35),
(60, 6, 0, '2017-10-13', 0.29),
(61, 6, 0, '2017-10-16', 0.22),
(62, 6, 0, '2017-10-17', 0.25),
(63, 6, 0, '2017-10-18', 0.29),
(64, 6, 0, '2017-10-19', 0.25),
(65, 6, 0, '2017-10-20', 0.24),
(66, 7, 0, '2017-10-17', 0.47),
(67, 7, 0, '2017-10-18', 0.46),
(68, 7, 0, '2017-10-19', 0.42),
(69, 7, 0, '2017-10-20', 0.43),
(70, 7, 0, '2017-10-21', 0.4),
(72, 4, 0, '2017-10-23', 0.18),
(73, 5, 0, '2017-10-22', 0.28),
(74, 5, 0, '2017-10-23', 0.31),
(75, 7, 0, '2017-10-23', 0.42),
(77, 4, 0, '2017-10-24', 0.13),
(78, 6, 0, '2017-10-23', 0.25),
(79, 7, 0, '2017-10-24', 0.46),
(81, 4, 0, '2017-10-25', 0.28),
(82, 5, 0, '2017-10-24', 0.3),
(83, 5, 0, '2017-10-25', 0.28),
(84, 6, 0, '2017-10-24', 0.26),
(85, 6, 0, '2017-10-25', 0.25),
(86, 7, 0, '2017-10-25', 0.48),
(87, 4, 0, '2017-10-26', 0.13),
(88, 5, 0, '2017-10-26', 0.33),
(89, 7, 0, '2017-10-26', 0.44),
(90, 6, 0, '2017-10-26', 0.22),
(91, 7, 0, '2017-10-27', 0.41),
(92, 4, 0, '2017-10-27', 0.12),
(93, 3, 1, '2017-10-02', 0.25),
(94, 4, 0, '2017-10-30', 0.14),
(95, 4, 0, '2017-10-31', 0.17),
(96, 5, 0, '2017-10-27', 0.29),
(97, 5, 0, '2017-09-28', 0.31),
(98, 5, 0, '2017-09-29', 0.27),
(99, 5, 0, '2017-10-30', 0.32),
(100, 5, 0, '2017-10-31', 0.27),
(101, 7, 0, '2017-10-30', 0.45),
(102, 6, 0, '2017-10-27', 0.24),
(103, 6, 0, '2017-10-30', 0.21),
(104, 4, 0, '2017-11-01', 0.44),
(105, 5, 0, '2017-11-01', 0.31),
(106, 5, 0, '2017-11-02', 0.35),
(107, 6, 0, '2017-10-31', 0.23),
(108, 7, 0, '2017-10-31', 0.48),
(109, 7, 0, '2017-11-01', 0.53),
(110, 4, 0, '2017-11-03', 0.35),
(111, 5, 0, '2017-11-03', 0.37),
(112, 5, 0, '2017-11-04', 0.29),
(113, 5, 0, '2017-11-05', 0.26),
(114, 7, 0, '2017-11-03', 0.61),
(115, 6, 0, '2017-11-01', 0.22),
(116, 6, 0, '2017-11-02', 0.22),
(117, 6, 0, '2017-11-03', 0.2),
(118, 7, 0, '2017-11-06', 0.63),
(119, 7, 0, '2017-11-07', 0.68),
(120, 4, 0, '2017-11-06', 0.11),
(121, 4, 0, '2017-11-07', 0.16),
(122, 4, 0, '2017-11-08', 0.13),
(123, 5, 0, '2017-11-06', 0.27),
(124, 4, 0, '2017-11-09', 0.37),
(125, 5, 0, '2017-11-07', 0.31),
(126, 5, 0, '2017-11-08', 0.28),
(127, 6, 0, '2017-11-06', 0.25),
(128, 6, 0, '2017-11-07', 0.21),
(129, 8, 1, '2017-11-01', 0.55),
(130, 4, 0, '2017-11-10', 0.45),
(131, 4, 0, '2017-11-13', 0.14),
(132, 4, 0, '2017-11-14', 0.11),
(133, 4, 0, '2017-11-16', 0.16),
(134, 4, 0, '2017-11-17', 0.21),
(135, 5, 0, '2017-11-09', 0.31),
(136, 5, 0, '2017-11-10', 0.26),
(137, 5, 0, '2017-11-11', 0.27),
(138, 5, 0, '2017-11-12', 0.28),
(139, 5, 0, '2017-11-13', 0.32),
(140, 5, 0, '2017-11-14', 0.28),
(141, 5, 0, '2017-11-15', 0.36),
(142, 5, 0, '2017-11-16', 0.28),
(143, 5, 0, '2017-11-17', 0.3),
(144, 5, 0, '2017-11-18', 0.29),
(145, 5, 0, '2017-11-19', 0.31),
(146, 6, 0, '2017-11-08', 0.21),
(147, 6, 0, '2017-11-09', 0.22),
(148, 6, 0, '2017-11-10', 0.19),
(149, 6, 0, '2017-11-13', 0.2),
(150, 6, 0, '2017-11-14', 0.23),
(151, 6, 0, '2017-11-16', 0.21),
(152, 7, 0, '2017-11-08', 0.54),
(153, 7, 0, '2017-11-09', 0.69),
(154, 7, 0, '2017-11-10', 0.71),
(155, 7, 0, '2017-11-13', 0.66),
(156, 7, 0, '2017-11-14', 0.73),
(157, 7, 0, '2017-11-15', 0.73),
(158, 7, 0, '2017-11-16', 0.79),
(159, 7, 0, '2017-11-17', 0.71),
(160, 4, 0, '2017-11-21', 0.14),
(161, 4, 0, '2017-11-22', 0.07),
(162, 4, 0, '2017-11-23', 0.15),
(163, 4, 0, '2017-11-24', 0.29),
(164, 4, 0, '2017-11-27', 0.22),
(165, 4, 0, '2017-11-28', 0.18),
(166, 5, 0, '2017-11-20', 0.33),
(167, 5, 0, '2017-11-21', 0.27),
(168, 5, 0, '2017-11-22', 0.29),
(169, 5, 0, '2017-11-23', 0.26),
(170, 5, 0, '2017-11-24', 0.3),
(171, 5, 0, '2017-11-25', 0.28),
(172, 5, 0, '2017-11-26', 0.32),
(173, 5, 0, '2017-11-27', 0.33),
(174, 6, 0, '2017-11-17', 0.22),
(175, 6, 0, '2017-11-20', 0.18),
(176, 6, 0, '2017-11-21', 0.2),
(177, 6, 0, '2017-11-22', 0.21),
(178, 6, 0, '2017-11-23', 0.21),
(179, 6, 0, '2017-11-24', 0.23),
(180, 6, 0, '2017-11-27', 0.22),
(181, 7, 0, '2017-11-20', 0.69),
(182, 7, 0, '2017-11-21', 0.75),
(183, 7, 0, '2017-11-22', 0.63),
(184, 7, 0, '2017-11-23', 0.58),
(185, 7, 0, '2017-11-24', 0.26),
(186, 7, 0, '2017-11-27', 0.58),
(187, 7, 0, '2017-11-28', 0.55),
(188, 4, 0, '2017-11-29', 0.71),
(189, 4, 0, '2017-11-30', 0.13),
(190, 5, 0, '2017-11-28', 0.25),
(191, 5, 0, '2017-11-29', 0.23),
(192, 5, 0, '2017-11-30', 0.29),
(193, 6, 0, '2017-11-28', 0.2),
(194, 6, 0, '2017-11-29', 0.21),
(195, 7, 0, '2017-11-29', 0.64),
(196, 9, 1, '2017-12-01', 0.4),
(197, 4, 0, '2017-12-01', 0.12),
(198, 4, 0, '2017-12-04', 0.15),
(199, 4, 0, '2017-12-05', 0.32),
(200, 4, 0, '2017-12-06', 0.11),
(201, 4, 0, '2017-12-07', 0.34),
(202, 4, 0, '2017-12-08', 0.19),
(203, 4, 0, '2017-12-11', 0.18),
(204, 4, 0, '2017-12-12', 0.14),
(205, 4, 0, '2017-12-13', 0.24),
(206, 4, 0, '2017-12-14', 0.38),
(207, 4, 0, '2017-12-15', 0.25),
(208, 5, 0, '2017-12-01', 0.36),
(209, 5, 0, '2017-12-02', 0.23),
(210, 5, 0, '2017-12-03', 0.31),
(211, 5, 0, '2017-12-04', 0.29),
(212, 5, 0, '2017-12-05', 0.26),
(213, 5, 0, '2017-12-06', 0.28),
(214, 5, 0, '2017-12-07', 0.25),
(215, 5, 0, '2017-12-08', 0.31),
(216, 5, 0, '2017-12-09', 0.28),
(217, 5, 0, '2017-12-10', 0.27),
(218, 5, 0, '2017-12-11', 0.22),
(219, 5, 0, '2017-12-12', 0.29),
(220, 5, 0, '2017-12-13', 0.3),
(221, 5, 0, '2017-12-14', 0.27),
(222, 7, 0, '2017-11-30', 0.48),
(223, 7, 0, '2017-12-01', 0.45),
(224, 7, 0, '2017-12-04', 0.49),
(225, 7, 0, '2017-12-05', 0.53),
(226, 7, 0, '2017-12-06', 0.55),
(227, 7, 0, '2017-12-07', 0.58),
(228, 7, 0, '2017-12-08', 0.64),
(229, 7, 0, '2017-12-11', 0.41),
(230, 7, 0, '2017-12-12', 0.39),
(231, 7, 0, '2017-12-13', 0.53),
(232, 7, 0, '2017-12-14', 0.44);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_investments`
--

CREATE TABLE `rs_investments` (
  `idInvestment` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL,
  `investedBTC` float NOT NULL DEFAULT '0',
  `investedReal` float NOT NULL DEFAULT '0',
  `totalProfit` float DEFAULT '0',
  `bitcoinTeamProfit` float DEFAULT '0',
  `realTeamProfit` float DEFAULT '0',
  `dateUpdated` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rs_investments`
--

INSERT INTO `rs_investments` (`idInvestment`, `idLogin`, `investedBTC`, `investedReal`, `totalProfit`, `bitcoinTeamProfit`, `realTeamProfit`, `dateUpdated`, `active`) VALUES
(1, 2, 0.0471739, 1500, 0.0075, 0, 0, '2017-12-24 19:48:16', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_logins`
--

CREATE TABLE `rs_logins` (
  `idLogin` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `password_reset_token` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `level` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rs_logins`
--

INSERT INTO `rs_logins` (`idLogin`, `name`, `username`, `password`, `password_reset_token`, `email`, `dateCreated`, `level`, `active`) VALUES
(1, 'Admin', 'admin', '$2y$13$mU6T0/cCn4pDNRZAZaCoNOjYYx/XuF6ziqW6bN3daYwf6uYehZHfC', NULL, 'diversificamais@gmail.com', '2017-04-08 19:36:05', 2, 1),
(2, 'User', 'user', '$2y$13$mU6T0/cCn4pDNRZAZaCoNOjYYx/XuF6ziqW6bN3daYwf6uYehZHfC', NULL, 'danilo@aaa.com', '2017-07-18 01:51:13', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_logins_companies`
--

CREATE TABLE `rs_logins_companies` (
  `idLoginCompany` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `rs_logins_companies`
--

INSERT INTO `rs_logins_companies` (`idLoginCompany`, `idLogin`, `idCompany`) VALUES
(230, 2, 1),
(231, 2, 2),
(232, 2, 4),
(233, 2, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_login_access`
--

CREATE TABLE `rs_login_access` (
  `idLoginAccess` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idLogin` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rs_login_access`
--

INSERT INTO `rs_login_access` (`idLoginAccess`, `idUser`, `idLogin`, `ip`, `date`) VALUES
(1101, NULL, 1, '::1', '2018-05-12 01:03:46'),
(1102, NULL, 2, '::1', '2018-05-12 01:05:02'),
(1103, NULL, 2, '::1', '2018-05-12 01:06:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_users`
--

CREATE TABLE `rs_users` (
  `idUser` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `dateBirth` date NOT NULL,
  `profession` varchar(50) NOT NULL,
  `referral` int(11) NOT NULL,
  `termsService` tinyint(1) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rs_users`
--

INSERT INTO `rs_users` (`idUser`, `name`, `gender`, `dateBirth`, `profession`, `referral`, `termsService`, `dateCreated`) VALUES
(1, 'Administrador', 'm', '1982-12-16', 'Analista de Sistemas', 0, 1, '2016-12-30 06:10:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_users_address`
--

CREATE TABLE `rs_users_address` (
  `idUserAddress` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `street` varchar(120) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `country` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_users_phone`
--

CREATE TABLE `rs_users_phone` (
  `idUserPhone` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_wallets`
--

CREATE TABLE `rs_wallets` (
  `idWallet` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL,
  `bitcoin` varchar(50) DEFAULT NULL,
  `litecoin` varchar(50) NOT NULL,
  `dogecoin` varchar(50) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `rs_wallets`
--

INSERT INTO `rs_wallets` (`idWallet`, `idLogin`, `bitcoin`, `litecoin`, `dogecoin`, `dateCreated`) VALUES
(1, 1, 'xxxxxxxxxxxxxxxxxxxxxxx', '', '', '2017-04-08 19:36:05'),
(2, 2, '14MiUa46vfs1q9TkEjZeo4qsEzLPXohA5a', 'LhSv4d8ie8VxBPQ9Ej4MCcyw3jb38AoSou', 'DHLvHVdk3i5R1B2jm4syWsuoFMT9EVqDDd', '2017-07-18 01:51:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rs_withdrawals`
--

CREATE TABLE `rs_withdrawals` (
  `idWithdrawal` int(11) NOT NULL,
  `idLogin` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paymentMethod` varchar(45) NOT NULL,
  `address` varchar(50) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rs_commission`
--
ALTER TABLE `rs_commission`
  ADD PRIMARY KEY (`idCommission`);

--
-- Indexes for table `rs_companies`
--
ALTER TABLE `rs_companies`
  ADD PRIMARY KEY (`idCompany`);

--
-- Indexes for table `rs_countries`
--
ALTER TABLE `rs_countries`
  ADD PRIMARY KEY (`idCountry`);

--
-- Indexes for table `rs_incomes`
--
ALTER TABLE `rs_incomes`
  ADD PRIMARY KEY (`idIncome`,`idCompany`) USING BTREE,
  ADD KEY `idCompany` (`idCompany`) USING BTREE,
  ADD KEY `profit` (`profit`) USING BTREE;

--
-- Indexes for table `rs_investments`
--
ALTER TABLE `rs_investments`
  ADD PRIMARY KEY (`idInvestment`,`idLogin`),
  ADD KEY `idLogin` (`idLogin`);

--
-- Indexes for table `rs_logins`
--
ALTER TABLE `rs_logins`
  ADD PRIMARY KEY (`idLogin`);

--
-- Indexes for table `rs_logins_companies`
--
ALTER TABLE `rs_logins_companies`
  ADD PRIMARY KEY (`idLoginCompany`,`idLogin`,`idCompany`) USING BTREE,
  ADD KEY `idLogin` (`idLogin`),
  ADD KEY `idCompany` (`idCompany`) USING BTREE;

--
-- Indexes for table `rs_login_access`
--
ALTER TABLE `rs_login_access`
  ADD PRIMARY KEY (`idLoginAccess`,`idLogin`) USING BTREE,
  ADD KEY `fk_rs_login_acesso_rs_login1_idx` (`idLogin`) USING BTREE;

--
-- Indexes for table `rs_users`
--
ALTER TABLE `rs_users`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `rs_users_address`
--
ALTER TABLE `rs_users_address`
  ADD PRIMARY KEY (`idUserAddress`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `rs_users_phone`
--
ALTER TABLE `rs_users_phone`
  ADD PRIMARY KEY (`idUserPhone`,`idUser`),
  ADD KEY `fk_rs_users_phone` (`idUser`);

--
-- Indexes for table `rs_wallets`
--
ALTER TABLE `rs_wallets`
  ADD PRIMARY KEY (`idWallet`,`idLogin`),
  ADD KEY `idLogin` (`idLogin`);

--
-- Indexes for table `rs_withdrawals`
--
ALTER TABLE `rs_withdrawals`
  ADD PRIMARY KEY (`idWithdrawal`,`idLogin`),
  ADD KEY `fk_rs_withdrawals_idx` (`idLogin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rs_commission`
--
ALTER TABLE `rs_commission`
  MODIFY `idCommission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rs_companies`
--
ALTER TABLE `rs_companies`
  MODIFY `idCompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `rs_countries`
--
ALTER TABLE `rs_countries`
  MODIFY `idCountry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `rs_incomes`
--
ALTER TABLE `rs_incomes`
  MODIFY `idIncome` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;
--
-- AUTO_INCREMENT for table `rs_investments`
--
ALTER TABLE `rs_investments`
  MODIFY `idInvestment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `rs_logins`
--
ALTER TABLE `rs_logins`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `rs_logins_companies`
--
ALTER TABLE `rs_logins_companies`
  MODIFY `idLoginCompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;
--
-- AUTO_INCREMENT for table `rs_login_access`
--
ALTER TABLE `rs_login_access`
  MODIFY `idLoginAccess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1104;
--
-- AUTO_INCREMENT for table `rs_users`
--
ALTER TABLE `rs_users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rs_users_address`
--
ALTER TABLE `rs_users_address`
  MODIFY `idUserAddress` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rs_users_phone`
--
ALTER TABLE `rs_users_phone`
  MODIFY `idUserPhone` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rs_wallets`
--
ALTER TABLE `rs_wallets`
  MODIFY `idWallet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `rs_withdrawals`
--
ALTER TABLE `rs_withdrawals`
  MODIFY `idWithdrawal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `rs_investments`
--
ALTER TABLE `rs_investments`
  ADD CONSTRAINT `rs_investments_ibfk_2` FOREIGN KEY (`idLogin`) REFERENCES `rs_logins` (`idLogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `rs_logins_companies`
--
ALTER TABLE `rs_logins_companies`
  ADD CONSTRAINT `rs_logins_companies_ibfk_3` FOREIGN KEY (`idLogin`) REFERENCES `rs_logins` (`idLogin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rs_logins_companies_ibfk_4` FOREIGN KEY (`idCompany`) REFERENCES `rs_companies` (`idCompany`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `rs_wallets`
--
ALTER TABLE `rs_wallets`
  ADD CONSTRAINT `rs_wallets_ibfk_1` FOREIGN KEY (`idLogin`) REFERENCES `rs_logins` (`idLogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `rs_withdrawals`
--
ALTER TABLE `rs_withdrawals`
  ADD CONSTRAINT `rs_withdrawals_ibfk_1` FOREIGN KEY (`idLogin`) REFERENCES `rs_logins` (`idLogin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
