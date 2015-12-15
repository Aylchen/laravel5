-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2015 at 03:59 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel5`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(4, 'Aylchen', '4297f44b13955235245b2497399d7a93', '2015-12-10 06:01:19', '2015-12-11 10:45:53'),
(5, 'sf', '4297f44b13955235245b2497399d7a93', '2015-12-08 16:00:00', '2015-12-09 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE IF NOT EXISTS `admin_role` (
  `admin_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`admin_id`,`role_id`),
  KEY `admin_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`admin_id`, `role_id`) VALUES
(4, 1),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Article First', 'This is an article!!!', '2015-12-05 01:29:06', '2015-12-05 01:29:06', 1),
(2, 'Article Second', 'Content field cann''t be empty!!!', '2015-12-05 01:29:29', '2015-12-05 01:29:29', 1),
(4, '惠普HP ENVY 13-D024TU 笔记本电脑', '系统特性\r\n安装的操作系统	Windows 10 家庭版 64\r\n处理器	带英特尔® HD 520 显卡的英特尔® 酷睿™ i5-6200U 处理器（2.3 GHz、高达 2.8 GHz、3 MB 高速缓存、双核）\r\n内存\r\n标配内存	4 GB DDR3L-1600 SDRAM（机载）\r\n显卡及显示器\r\n显示屏	13.3 英寸对角 QHD+高亮背光显示屏 (3200 x 1800)\r\n显卡	英特尔® 520 HD 显卡\r\n显示器尺寸（对角）	13.3 英寸\r\n存储\r\n硬盘驱动器	256 GB M.2 SSD 硬盘\r\n尺寸与重量\r\n产品重量	1.36 千克起\r\n产品外形尺寸（宽 X 深 X 高）	32.65 x 22.6 x 1.29 厘米', '2015-12-05 01:30:44', '2015-12-05 11:42:38', 1),
(5, 'A惠普HP SPECTRE X360 CONVERTIBLE 13-4116TU笔记本（INTEL SKYLAKE新平台） 限量版A', ' 产品规格\r\nWindows 10 家庭版 64\r\n带英特尔® HD 520 显卡的英特尔® 酷睿™ i7-6500U 处理器（2.5 GHz、4 MB 高速缓存、双核）\r\n256 GB M.2 SSD 硬盘\r\n8 GB LDDR3 SDRAM（机载）\r\n英特尔® 520 HD 显卡\r\n 产品特色\r\n现在笔记本电脑可以满足更多要求。 精心设计的 x360 将功能和灵活性集于一身。 Spectre x360 可以满足各种要求。 这款可转换 PC 具有 4 种模式、闪电般的性能、出众的电池使用时间，成为无懈可击的理想选择。\r\n\r\nWindows 10 家庭版 64\r\n这一可转换型 PC 具有设计优雅的 360 度转轴，从每个角度看起来都非常时尚，让您从笔记本电脑顺利过渡到平板电脑，尽享两者的优势。\r\n这款可转换 PC 的漂亮金属机身十分轻薄，是设计和性能的完美融合。 外形仅为 15.9 毫米，却提供了四种模式，难觅对手。\r\n高级 x360 的电池寿命高达 12.5 小时，可以全天提供闪电般的性能，不会影响完成计划。[1]', '2015-12-05 01:31:13', '2015-12-05 01:31:44', 1),
(6, '惠普HP PAVILION GAMING NB 15-AK001TX （INTEL SKYLAKE新平台）', ' 产品规格\r\nWindows 10 家庭版 64\r\n带英特尔® HD 530 显卡的英特尔® 酷睿™ i7-6700HQ 处理器（2.6 GHz、高达 3.5 GHz、6 MB 高速缓存、四核）\r\n1 TB SATA 硬盘（5400 转/分钟）\r\n8 GB DDR3L SDRAM (1 x 8 GB)\r\nNVIDIA GeForce GTX 950M 显卡（4 GB DDR3L 独立显存）\r\n不参加促销活动\r\n\r\n 产品特色\r\n这款笔记本电脑让您立于不败之地，令对手刮目相看。 它硬件功能强大、设计冷酷，您可以随时随地准备完成下一个史诗任务。\r\n\r\nWindows 10 家庭版 64\r\nNVIDIA® GTX 950M 显卡和英特尔四核处理器性能强大，运行任何游戏都游刃有余。 无需妥协。\r\n笔记本电脑造型冷酷。 采用激进的绿色外壳，设计与高性能相得益彰。\r\n让您尽享真实的音频体验。 不只局限于听，配备 B&O PLAY 音频功能的 HP 可以带来深深的震撼。\r\n 概述\r\n这款笔记本电脑硬件功能强大、设计冷酷，让您立于不败之地，令对手刮目相看。\r\n\r\n不参加促销活动', '2015-12-05 01:31:32', '2015-12-05 01:31:32', 1),
(7, 'I come here123456', '签收人应当为订单指定的收货人本人，签收时需要提供收货人的身份证明或收货人的手机号进行核对。\r\n在配送人员与收货人联系时，请收货人安排好收货时间并保持手机畅通，以保证能够亲自按时签收商品。\r\n签收前，请您仔细核对发货清单中所列出的商品与实际送到商品，并检查商品外包装是否完整无破损、无变形，封口部分是否完好无被拆封痕迹。如果没有问题，您即可放心签收。如发现外包装有严重破损，您有权拒绝签收，遇到问题请致电我们的客户服务热线（早9：00至晚6：00）：400-820-1015、800-820-1015（仅限固话），我们专业的客服人员会为您带来最优质的服务。\r\n在实际发生配送服务后，如因客户原因拒收商品，产生的配送费用由客户自行承担（配送费用具体金额以承运商最终确认金额为准）。\r\n签收人应当为订单指定的收货人本人，签收时需要提供收货人的身份证明或收货人的手机号进行核对。\r\n在配送人员与收货人联系时，请收货人安排好收货时间并保持手机畅通，以保证能够亲自按时签收商品。\r\n签收前，请您仔细核对发货清单中所列出的商品与实际送到商品，并检查商品外包装是否完整无破损、无变形，封口部分是否完好无被拆封痕迹。如果没有问题，您即可放心签收。如发现外包装有严重破损，您有权拒绝签收，遇到问题请致电我们的客户服务热线（早9：00至晚6：00）：400-820-1015、800-820-1015（仅限固话），我们专业的客服人员会为您带来最优质的服务。\r\n在实际发生配送服务后，如因客户原因拒收商品，产生的配送费用由客户自行承担（配送费用具体金额以承运商最终确认金额为准）。\r\n签收人应当为订单指定的收货人本人，签收时需要提供收货人的身份证明或收货人的手机号进行核对。\r\n在配送人员与收货人联系时，请收货人安排好收货时间并保持手机畅通，以保证能够亲自按时签收商品。\r\n签收前，请您仔细核对发货清单中所列出的商品与实际送到商品，并检查商品外包装是否完整无破损、无变形，封口部分是否完好无被拆封痕迹。如果没有问题，您即可放心签收。如发现外包装有严重破损，您有权拒绝签收，遇到问题请致电我们的客户服务热线（早9：00至晚6：00）：400-820-1015、800-820-1015（仅限固话），我们专业的客服人员会为您带来最优质的服务。\r\n在实际发生配送服务后，如因客户原因拒收商品，产生的配送费用由客户自行承担（配送费用具体金额以承运商最终确认金额为准）。\r\n签收人应当为订单指定的收货人本人，签收时需要提供收货人的身份证明或收货人的手机号进行核对。\r\n在配送人员与收货人联系时，请收货人安排好收货时间并保持手机畅通，以保证能够亲自按时签收商品。\r\n签收前，请您仔细核对发货清单中所列出的商品与实际送到商品，并检查商品外包装是否完整无破损、无变形，封口部分是否完好无被拆封痕迹。如果没有问题，您即可放心签收。如发现外包装有严重破损，您有权拒绝签收，遇到问题请致电我们的客户服务热线（早9：00至晚6：00）：400-820-1015、800-820-1015（仅限固话），我们专业的客服人员会为您带来最优质的服务。\r\n在实际发生配送服务后，如因客户原因拒收商品，产生的配送费用由客户自行承担（配送费用具体金额以承运商最终确认金额为准）。签收人应当为订单指定的收货人本人，签收时需要提供收货人的身份证明或收货人的手机号进行核对。\r\n在配送人员与收货人联系时，请收货人安排好收货时间并保持手机畅通，以保证能够亲自按时签收商品。\r\n签收前，请您仔细核对发货清单中所列出的商品与实际送到商品，并检查商品外包装是否完整无破损、无变形，封口部分是否完好无被拆封痕迹。如果没有问题，您即可放心签收。如发现外包装有严重破损，您有权拒绝签收，遇到问题请致电我们的客户服务热线（早9：00至晚6：00）：400-820-1015、800-820-1015（仅限固话），我们专业的客服人员会为您带来最优质的服务。\r\n在实际发生配送服务后，如因客户原因拒收商品，产生的配送费用由客户自行承担（配送费用具体金额以承运商最终确认金额为准）。', '2015-12-05 01:32:51', '2015-12-05 11:12:42', 2),
(8, 'i7-4790k', '4790K中文原装2169块，英文水货便宜150 \r\n\r\n4790K+大霜塔标准版（我用的这个U，玄冰400不超平满载都上65度还是今天的温度，最少6管风冷散热器，推荐大霜塔标准版，今晚待机27度满载51度，旗舰版没必要都一样的）大霜塔标准版190块\r\n\r\n主板打DOTA别上交火板了，上混火板。技嘉Z97-HD3 REV2.0是大板，供电质量都不错。不需要上ASUS，这款板ASUS要上千的，质量都差不多。 价格720-50=670 很多网商在做活动，670-690能买到\r\n\r\n硬盘西数10EZEX 345块\r\n\r\n机箱 刺客1重装版+两个机箱风扇  140块\r\n\r\n光驱华硕刻录光驱  110块\r\n\r\n内存别买金士顿全假货，威刚万紫千红也别买，全假货，买威刚游戏威龙 475块\r\n\r\n显卡打DOTA买低功耗显卡 别上192BIT或者256BIT，那都是中高端卡，买128BIT的1G卡，128BIT2G卡是噱头虚的带不动2G，质量好寿命长的三个一线牌子：蓝宝石（N卡A卡都做，较贵）、迪兰恒进（A卡之王）、华硕（做板子的技术用到显卡上了），推荐迪兰恒进R7 260X 酷能1G CD  价格770块\r\n\r\n电源 国产的选航嘉，但是质量没以前好了 这种配置不需要模组电源，以不超频算 4790K满载130-140W（TDP是散热功率不是总功率），主板20W，显卡70W，机箱风扇20W，硬盘12W，内存10W，CPU双风扇20W，全都是顶着算的放心绝对够大功率 350W电源足够足够  上航嘉磐石400，额定350W最大400W，价格280块\r\n\r\n你听我的，我对这块CPU的散热和配板子十分了解，功率我也懂的很,。总预算不带显示器5169（CPU原装价格）水货散货5000搞定，如果嫌速度不够快上浦科特M6S固态128G 加430块', '2015-12-05 04:07:17', '2015-12-05 04:07:32', 2),
(9, '再发布一篇文章！！！', '啊的发生发发生方式打是否撒啊啊撒是地方\r\n==================================', '2015-12-05 11:37:37', '2015-12-05 11:42:53', 1),
(10, 'I want to publish an article', 'This is the content of the article!!!', '2015-12-09 08:00:08', '2015-12-09 08:00:08', 2),
(11, 'A', 'B132', '2015-12-10 01:35:29', '2015-12-10 01:35:29', 2),
(14, '文章发表', '文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表\r\n文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表文章发表', '2015-12-14 05:44:00', '2015-12-14 05:44:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `article_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'I want to say something, but I don''t know what to say !!!', 7, 2, '2015-12-05 05:57:23', '2015-12-05 05:57:23'),
(2, 'I Just Want To Say Something...', 7, 2, '2015-12-05 05:59:05', '2015-12-05 05:59:05'),
(3, 'asfdadfsa', 7, 2, '2015-12-05 06:02:43', '2015-12-05 06:02:43'),
(5, '++++++++++++++++++++++\r\n+++++++++++++++_________________', 7, 2, '2015-12-05 06:03:51', '2015-12-05 06:03:51'),
(6, 'Move The createComment method to ArticleController\r\n', 7, 2, '2015-12-05 06:57:26', '2015-12-05 06:57:26'),
(7, 'I want to sing a song', 7, 1, '2015-12-05 07:22:10', '2015-12-05 07:22:10'),
(8, 'asdfa103213\r\n', 7, 1, '2015-12-05 07:25:38', '2015-12-08 10:31:28'),
(9, 'The last comment!!!', 7, 1, '2015-12-05 07:31:52', '2015-12-05 07:31:52'),
(10, '签收人应当为订单指定的收货人本人，', 7, 1, '2015-12-05 07:38:27', '2015-12-05 07:38:27'),
(11, '签收人应当为订单指定的收货人本人，签收人应当为订单指定的收货人本人，', 7, 1, '2015-12-05 07:38:33', '2015-12-05 07:38:33'),
(12, '好吧！！！', 5, 2, '2015-12-05 08:35:05', '2015-12-05 08:35:05'),
(13, '不好！！！', 5, 2, '2015-12-05 08:35:23', '2015-12-05 08:35:23'),
(14, '每个都要评论一遍', 4, 2, '2015-12-05 10:02:35', '2015-12-05 10:02:35'),
(15, '每个都要评论一遍', 4, 2, '2015-12-05 10:02:41', '2015-12-05 10:02:41'),
(17, '每个都要评论一遍', 1, 2, '2015-12-05 10:02:53', '2015-12-05 10:02:53'),
(18, '每个都要评论一遍', 1, 2, '2015-12-05 10:02:54', '2015-12-05 10:02:54'),
(19, '每个都要评论一遍', 1, 2, '2015-12-05 10:02:56', '2015-12-05 10:02:56'),
(27, '每个都要评论一遍', 1, 2, '2015-12-05 10:03:06', '2015-12-07 07:04:24'),
(28, '$this->validate($request, [\r\n            ''content'' => ''required''\r\n        ]);', 1, 2, '2015-12-05 10:03:07', '2015-12-05 11:24:58'),
(29, 'AAA', 5, 1, '2015-12-05 11:35:54', '2015-12-05 11:35:54'),
(30, '45685479849684哭国际化国际化规范化\r\n', 4, 1, '2015-12-05 11:40:54', '2015-12-05 11:46:09'),
(31, '我也评论！！！132', 1, 1, '2015-12-05 11:43:27', '2015-12-05 11:43:37'),
(32, '撒发发艾弗森打', 5, 1, '2015-12-05 11:46:22', '2015-12-05 11:46:22'),
(33, '额', 4, 1, '2015-12-05 11:46:38', '2015-12-05 11:46:38'),
(34, '爱上地方撒发', 7, 1, '2015-12-05 11:46:53', '2015-12-05 11:46:53'),
(36, 'Say Something123', 6, 2, '2015-12-08 01:15:05', '2015-12-10 01:35:50'),
(37, '==================================', 9, 1, '2015-12-08 10:31:50', '2015-12-08 10:31:50'),
(38, '==================================.\r\n==================================', 9, 1, '2015-12-08 10:31:58', '2015-12-08 10:31:58'),
(39, '==================================', 9, 1, '2015-12-08 10:32:07', '2015-12-08 10:32:07'),
(40, '23423423', 9, 1, '2015-12-08 10:34:01', '2015-12-08 10:34:01'),
(42, '1', 10, 2, '2015-12-09 09:16:04', '2015-12-09 09:16:04'),
(48, 'afdas ', 10, 2, '2015-12-14 07:00:21', '2015-12-14 07:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_11_25_061844_create_article_table', 1),
('2015_11_26_233348_add_user_id_into_articles', 1),
('2015_12_05_122025_create_comment_table', 2),
('2015_12_09_150533_create_administrator_table', 3),
('2015_12_09_152724_create_administrators_table', 4),
('2015_12_09_161642_create_administrations_table', 5),
('2015_12_09_174817_create_admins_table', 6),
('2015_12_10_081949_create_admin_role_table', 7),
('2015_12_10_082621_create_roles_table', 8),
('2015_12_10_083104_create_permission_roles_user_table', 9),
('2015_12_10_133614_add_column_into_permission', 10),
('2015_12_10_153327_create_permission_role_admin_table', 11),
('2015_12_11_124129_add_column_into_permission_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `permission_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_show` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission` (`permission`),
  UNIQUE KEY `permission_name` (`permission_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `created_at`, `updated_at`, `permission_name`, `is_show`) VALUES
(1, 'admin', '2015-12-11 03:00:00', '2015-12-11 04:00:00', '首页', 1),
(3, 'admin/permissions', '2015-12-10 03:48:28', '2015-12-14 02:02:19', '权限管理(permission)', 1),
(4, 'admin/roles', '2015-12-11 07:10:18', '2015-12-14 02:02:28', '角色管理(roles)', 1),
(6, 'admin/administrators', '2015-12-11 01:55:44', '2015-12-14 07:58:17', '后台用户(admins)', 1),
(7, 'admin/users', '2015-12-11 01:55:50', '2015-12-14 06:49:36', '用户管理(users)', 1),
(8, 'admin/articles', '2015-12-11 01:55:54', '2015-12-14 06:49:46', '文章管理(articles)', 1),
(9, 'admin/comments', '2015-12-11 01:55:59', '2015-12-14 06:49:54', '评论管理(comments)', 1),
(10, 'admin/permissions/delete', '2015-12-11 04:40:54', '2015-12-11 04:40:54', '权限删除', 0),
(12, 'admin/permissions/edit', '2015-12-10 16:00:00', '2015-12-10 16:00:00', '权限编辑', 0),
(23, 'admin/roles/edit', '2015-12-11 07:08:54', '2015-12-11 07:08:54', '角色编辑', 0),
(24, 'admin/roles/delete', '2015-12-11 07:09:07', '2015-12-11 07:09:07', '角色删除', 0),
(32, 'admin/administrators/edit', '2015-12-11 09:53:16', '2015-12-11 09:53:16', '后台用户编辑', 0),
(33, 'admin/administrators/delete', '2015-12-11 09:53:34', '2015-12-11 09:53:34', '后台用户删除', 0),
(35, 'admin/users/delete', '2015-12-11 09:54:02', '2015-12-11 09:54:19', '用户删除', 0),
(36, 'admin/articles/delete', '2015-12-14 02:10:04', '2015-12-14 02:10:04', '文章删除', 0),
(37, 'admin/comments/delete', '2015-12-14 02:34:58', '2015-12-14 02:34:58', '评论删除', 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(4, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(12, 1),
(23, 1),
(24, 1),
(32, 1),
(33, 1),
(35, 1),
(36, 1),
(37, 1),
(1, 3),
(7, 3),
(8, 3),
(9, 3),
(35, 3),
(36, 3),
(37, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, '超级管理员', '2015-12-10 03:45:44', '2015-12-10 03:45:44'),
(3, '普通管理员', '2015-12-10 03:48:28', '2015-12-11 09:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aylchen', '1028152157@qq.com', '$2y$10$xb3wucw54QaZWdumvtKCl.8hzogfp/QKZ8Q6Z4Y6nH4jNQ6sdPFha', 'MHOOLVOg0U3ZhIozK5QeMEYI1F5xU4OM8HFwT0YhKeh5r0QpUlUf2qmyqaUN', '2015-12-05 01:28:49', '2015-12-08 08:44:51'),
(2, 'sf', '491136046@qq.com', '$2y$10$ix/983aed/ipChjyBx/tSOaLdGzFQbsItRg5QeoFtWGZ3mVA9bIGy', 'OmibypiTEQs8GR3Ed8wybmAv1NROgnHshYZY8qe2C7Ybn5pMcNGVBJpfUa2h', '2015-12-05 01:32:06', '2015-12-14 02:58:03');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD CONSTRAINT `admin_role_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;