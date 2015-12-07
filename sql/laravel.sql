-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2015 at 01:22 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `published` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `published`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'This is SF', 'alsfjlasjfldadf阿斯顿发达到所看风景阿列克放假啊ljfdklk', '0000-00-00 00:00:00', '2015-11-27 08:09:38', '2015-11-27 08:09:38', 2),
(2, '13阿斯发放大', '阿斯顿发保护生态会有人图二与他人ybwe', '0000-00-00 00:00:00', '2015-11-27 08:09:47', '2015-11-27 08:09:53', 2),
(3, '发送到发放', '阿斯顿发发送到发送到发送到发', '0000-00-00 00:00:00', '2015-11-27 08:10:21', '2015-11-27 08:10:50', 1),
(4, '啊伐算法的萨', '阿斯发送法大赛发', '0000-00-00 00:00:00', '2015-11-27 08:10:25', '2015-11-27 08:10:25', 1),
(5, '啊伐司法萨斯', '阿斯飞洒得发疯打三分大赛的发送到f', '0000-00-00 00:00:00', '2015-11-27 08:10:32', '2015-11-27 08:10:32', 1),
(6, '发贴规范', '哪些内容会被删除？哪些情况账号会被禁止登陆？\r\n1. 总则\r\n1.1 车友圈处理违规内容的6字标准‘虚假’‘恶意’‘违规’。只要符合其中一项即可处理。\r\n1.2 虚假指虚假不实内容。\r\n1.3 恶意指用非正常手段。\r\n1.4 违规指违反国家政策法规和违反论坛相关规定。\r\n1.5 所有需单独协调用户的事件，均以本规范中的第五条实施。\r\n1.6 违规内容范围包括发帖、回帖、图片、头像和签名\r\n2.‘虚假’包含的以下内容和处理标准\r\n2.1 虚假注册。以下用户会被永久禁止发帖及回复\r\n2.1.1 论坛管理员通过技术手段对非正常情况下的用户注册进行排查并确认。\r\n2.1.2 致电用户后，对方明确表示自己和朋友并未在易车网注册。\r\n2.2 发布内容虚构的，举报方提供证明，查证后予以删除举报内容。论坛有义务联系被投诉人核实事件。协调用户参考本规范第5条。\r\n3.‘恶意’包含的以下内容和处理标准，以下内容第一次删除；第二次删除并酌情对帐号进行禁止发帖和回复的处理。', '0000-00-00 00:00:00', '2015-11-27 08:10:39', '2015-11-27 08:20:35', 1),
(7, 'Relations', 'Introduction\r\n\r\nDatabase tables are often related to one another. For example, a blog post may have many comments, or an order could be related to the user who placed it. Eloquent makes managing and working with these relationships easy, and supports several different types of relationships:\r\n\r\nOne To One\r\nOne To Many\r\nMany To Many\r\nHas Many Through\r\nPolymorphic Relations\r\nMany To Many Polymorphic Relations\r\n\r\nDefining Relationships\r\n\r\nEloquent relationships are defined as functions on your Eloquent model classes. Since, like Eloquent models themselves, relationships also serve as powerful query builders, defining relationships as functions provides powerful method chaining and querying capabilities. For example:\r\n\r\n$user->posts()->where(''active'', 1)->get();\r\nBut, before diving too deep into using relationships, let''s learn how to define each type:\r\n\r\n\r\nOne To One\r\n\r\nA one-to-one relationship is a very basic relation. For example, a User model might be associated with one Phone. To define this relationship, we place a phone method on the User model. The phone method should return the results of the hasOne method on the base Eloquent model class:\r\n\r\n<?php\r\n\r\nnamespace App;\r\n\r\nuse Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass User extends Model\r\n{\r\n    /**\r\n     * Get the phone record associated with the user.\r\n     */\r\n    public function phone()\r\n    {\r\n        return $this->hasOne(''App\\Phone'');\r\n    }\r\n}\r\nThe first argument passed to the hasOne method is the name of the related model. Once the relationship is defined, we may retrieve the related record using Eloquent''s dynamic properties. Dynamic properties allow you to access relationship functions as if they were properties defined on the model:\r\n\r\n$phone = User::find(1)->phone;\r\nEloquent assumes the foreign key of the relationship based on the model name. In this case, the Phone model is automatically assumed to have a user_id foreign key. If you wish to override this convention, you may pass a second argument to the hasOne method:\r\n\r\nreturn $this->hasOne(''App\\Phone'', ''foreign_key'');\r\nAdditionally, Eloquent assumes that the foreign key should have a value matching the id column of the parent. In other words, Eloquent will look for the value of the user''s id column in the user_id column of the Phone record. If you would like the relationship to use a value other than id, you may pass a third argument to the hasOne method specifying your custom key:\r\n\r\nreturn $this->hasOne(''App\\Phone'', ''foreign_key'', ''local_key'');\r\nDefining The Inverse Of The Relation\r\n\r\nSo, we can access the Phone model from our User. Now, let''s define a relationship on the Phone model that will let us access the User that owns the phone. We can define the inverse of a hasOne relationship using the belongsTo method:\r\n\r\n<?php\r\n\r\nnamespace App;\r\n\r\nuse Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass Phone extends Model\r\n{\r\n    /**\r\n     * Get the user that owns the phone.\r\n     */\r\n    public function user()\r\n    {\r\n        return $this->belongsTo(''App\\User'');\r\n    }\r\n}\r\nIn the example above, Eloquent will try to match the user_id from the Phone model to an id on the User model. Eloquent determines the default foreign key name by examining the name of the relationship method and suffixing the method name with _id. However, if the foreign key on the Phone model is not user_id, you may pass a custom key name as the second argument to the belongsTo method:\r\n\r\n/**\r\n * Get the user that owns the phone.\r\n */\r\npublic function user()\r\n{\r\n    return $this->belongsTo(''App\\User'', ''foreign_key'');\r\n}\r\nIf your parent model does not use id as its primary key, or you wish to join the child model to a different column, you may pass a third argument to the belongsTo method specifying your parent table''s custom key:\r\n\r\n/**\r\n * Get the user that owns the phone.\r\n */\r\npublic function user()\r\n{\r\n    return $this->belongsTo(''App\\User'', ''foreign_key'', ''other_key'');\r\n}', '0000-00-00 00:00:00', '2015-11-27 08:15:53', '2015-11-27 08:15:53', 1),
(8, '陈亚雷', '绿色空间的罚款的房间诉', '0000-00-00 00:00:00', '2015-11-27 08:46:55', '2015-11-27 08:46:55', 1),
(9, '2015/11/28最新发表了一篇文章', 'Taskdflak阿喀琉斯京东方卡拉胶快乐的发送机 阿斯看来大家法拉快速减肥拉开计算lk阿斯兰的房间拉开积分啊伐接口拉萨发\r\n阿龙索的房间里卡斯激发了阿迪所开发拉开减肥啦可放\r\n阿拉丁所肩负辣椒粉拉\r\n阿斯兰的罚款叫阿类似的发\r\n阿斯兰菲拉斯放假啦所开发就撒积分las\r\n斯蒂芬撒娇发撕开罗斯福卡斯看到发阿斯顿发卡斯积分地哦万恶可快速发凯撒的附件卡\r\n阿斯发送到叫阿塑封机哦萨克了房间阿斯顿立刻就阿斯兰打开附件', '0000-00-00 00:00:00', '2015-11-27 20:39:40', '2015-11-27 20:39:40', 1);

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
('2015_11_25_061844_create_article_table', 2),
('2015_11_26_233348_add_user_id_into_articles', 3);

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
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aylchen', '1028152157@qq.com', '$2y$10$DgYCPTTnSZ.q8OPs3cB8fuOalaiDN7PcBNg4i9Q7j0Yu.QUwmJNuy', 'AhtT5baqpQ3Q0WOfddyFxPLouETdEdOh89bml8t1gMvRMqs8wmGtkM0KFx1E', '2015-11-25 05:14:26', '2015-11-27 08:26:51'),
(2, 'SF', '4911360046@qq.com', '$2y$10$j0o.pH/fMSYGV2SfA/awT.c4XS/ro22t/pg9XbXU5KhY7oag4LFDW', 'w4U9dg3lv6ft21GBAp8T4qLQwB3MEqgm1Cye9mRx4H91dQYjBC7yAtKUTlgi', '2015-11-25 06:41:31', '2015-11-28 05:14:55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
