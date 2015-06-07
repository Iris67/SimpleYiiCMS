-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 07 2015 г., 11:11
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `yiicms_host`
--

-- --------------------------------------------------------

--
-- Структура таблицы `c_category`
--

CREATE TABLE IF NOT EXISTS `c_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `c_category`
--

INSERT INTO `c_category` (`id`, `title`) VALUES
(6, 'Волгоград'),
(7, 'Камышин');

-- --------------------------------------------------------

--
-- Структура таблицы `c_comment`
--

CREATE TABLE IF NOT EXISTS `c_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `author` varchar(25) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `c_comment`
--

INSERT INTO `c_comment` (`id`, `content`, `status`, `create_time`, `author`, `email`, `url`, `post_id`, `author_id`) VALUES
(38, 'Ага. Бывала там.', 2, 1429476248, 'author', NULL, NULL, 19, 3),
(39, 'Скоро 9 Мая.', 2, 1429476345, 'admin', NULL, NULL, 21, 1),
(40, 'Был на открытии.', 1, 1429476374, 'tapok', 'tapok@mail.com', '', 20, NULL),
(41, 'Привет.', 1, 1432141990, 'tap', 'tap@ed.c', '', 21, NULL),
(42, 'Скоро новая выставка. Подробнее смотрите на сайте музея.', 2, 1432797532, 'admin', 'Sasha@mail.com', '', 19, 1),
(43, 'Недавно была чудесная выставка.', 2, 1432797597, 'Маша', 'Masha@mail.com', '', 19, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `c_config`
--

CREATE TABLE IF NOT EXISTS `c_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(128) NOT NULL,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `c_config`
--

INSERT INTO `c_config` (`id`, `param`, `value`) VALUES
(1, 'APP_NAME', 'Достопримечательные места России'),
(2, 'ADMIN_EMAIL', 'webmaster@example.com'),
(3, 'CHOOSE_THEME', '2'),
(4, 'USE_CONTACT_FORM', '1'),
(5, 'COMMENT_NEED_APPROVAL', '1'),
(6, 'USE_PORTLET_RECENT_COMMENTS', '1'),
(7, 'USE_PORTLET_RECENT_POSTS', '1'),
(8, 'USE_PORTLET_CATEGORIES', '1'),
(9, 'USE_PORTLET_TAG_CLOUD', '1'),
(10, 'RECENT_COMMENTS_COUNT', '10'),
(11, 'RECENT_POSTS_COUNT', '10'),
(12, 'TAGS_COUNT', '20');

-- --------------------------------------------------------

--
-- Структура таблицы `c_lookup`
--

CREATE TABLE IF NOT EXISTS `c_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `c_lookup`
--

INSERT INTO `c_lookup` (`id`, `type`, `name`, `code`) VALUES
(1, 'PostStatus', 'Черновик', 1),
(2, 'PostStatus', 'На утверждении', 2),
(3, 'PostStatus', 'Опубликовано', 3),
(4, 'UserRole', 'admin', 1),
(5, 'UserRole', 'editor', 2),
(6, 'UserRole', 'author', 3),
(7, 'UserRole', 'subscriber', 4),
(8, 'CommentStatus', 'На утверждении', 1),
(9, 'CommentStatus', 'Опубликовано', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `c_page`
--

CREATE TABLE IF NOT EXISTS `c_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `position` int(11) NOT NULL,
  `visible` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `c_page`
--

INSERT INTO `c_page` (`id`, `url`, `title`, `content`, `position`, `visible`, `description`, `keywords`) VALUES
(1, 'about', 'О сайте', '<h3 style="text-align:justify">О сайте</h3>\r\n\r\n<p style="text-align:justify">Сайт является демонстрационным. Он создан с помощью CMS, построенной на основе Yii фреймворка. Ссылка на github: .</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1, 1, 'Информация о сайте "Достопримечательные места России"', 'Достопримечательные места России, cms, Yii framework, github');

-- --------------------------------------------------------

--
-- Структура таблицы `c_post`
--

CREATE TABLE IF NOT EXISTS `c_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `introcontent` text NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  `tags` text,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `c_post`
--

INSERT INTO `c_post` (`id`, `title`, `introcontent`, `content`, `create_time`, `update_time`, `status`, `tags`, `category_id`, `author_id`) VALUES
(19, 'Краеведческий музей', '<p style="text-align:justify;">Камышинский историко-краеведческий музей — самое красивое старинное здание города. Оно было возведено в 1901 году на средства предводителя камышинского дворянства, графа Дмитрия Адамовича Олсуфьева. Здесь размещалась уездная земская управа, проходили заседания думы, обсуждались и воплощались в жизнь планы по развитию города…</p>\r\n\r\n<p style="text-align:justify;">Краеведческие традиции в Камышине существовали давно. Например, есть сведения о краеведческом уголке в камышинском реальном училище (для справки: оно распахнуло двери в 1877 году). В литературе встречается упоминание о музее Наркомпроса в 1920 году.</p>\r\n\r\n<p style="text-align:justify;">Потом война, затишье… Лишь в конце 1959 года интеллигенция города поставила перед властями вопрос о создании музея. Был создан оргкомитет, состоялись первые заседания… Наконец,...</p>', '<p style="text-align:justify">Камышинский историко-краеведческий музей &mdash; самое красивое старинное здание города. Оно было возведено в 1901 году на средства предводителя камышинского дворянства, графа Дмитрия Адамовича Олсуфьева. Здесь размещалась уездная земская управа, проходили заседания думы, обсуждались и воплощались в жизнь планы по развитию города&hellip;</p>\r\n\r\n<p style="text-align:justify">Краеведческие традиции в Камышине существовали давно. Например, есть сведения о краеведческом уголке в камышинском реальном училище (для справки: оно распахнуло двери в 1877 году). В литературе встречается упоминание о музее Наркомпроса в 1920 году.</p>\r\n\r\n<p style="text-align:justify">Потом война, затишье&hellip; Лишь в конце 1959 года интеллигенция города поставила перед властями вопрос о создании музея. Был создан оргкомитет, состоялись первые заседания&hellip; Наконец, оргкомитету были выделены две комнаты в доме № 16 по улице Октябрьской. Остальные комнаты в то время занимал Дом пионеров.</p>\r\n\r\n<p style="text-align:justify">13 августа 1961 года состоялось торжественное открытие Камышинского историко-краеведческого музея. Большую подвижническую работу для этого проделали местные историки и краеведы Е. Хорошунов, С. Мантуров, К. Дыбля, Г. Шендаков, И. Саталкин и многие-многие другие. В 1968 году народный музей получил статус государственного, а в 1971 году переехал в здание бывшей Земской управы, где располагается по сегодняшний день.</p>\r\n\r\n<p style="text-align:justify">(Информация взята с сайта http://infokam.su/)</p>\r\n\r\n<p style="text-align:justify">Официальный сайт музея:&nbsp;http://museumkam.ru/</p>\r\n\r\n<p style="text-align:justify">Где находится:</p>\r\n\r\n<p><iframe frameborder="0" height="300" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1280.2147770027823!2d45.411526!3d50.078244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41117159e4344573%3A0x1bf1ad8ed9d6017b!2z0J3QsNCx0LXRgNC10LbQvdCw0Y8g0YPQuy4sIDEsINCa0LDQvNGL0YjQuNC9LCDQktC-0LvQs9C-0LPRgNCw0LTRgdC60LDRjyDQvtCx0LsuLCA0MDM4OTM!5e0!3m2!1sru!2sru!4v1433671014487" style="border:0" width="400"></iframe></p>\r\n', 1429638724, 1433674205, 3, 'museum', 7, 1),
(20, 'Памятник Маресьеву', '<p style="text-align:justify;"><span style="color:rgb(42,42,42);font-family:verdana, arial, helvetica, sans-serif;font-size:12px;">20 мая 2006 года прошло торжественное открытие памятника легендарному летчику-асу А.П. Маресьеву, уроженцу Камышина. </span>Во время ожесточенных боев апреля 1942 года Маресьев был подбит врагом и ранен. Более двух недель пробирался летчик с отмороженными ногами сквозь лес. Обе ноги летчика пришлось ампутировать. Однако это не сломило дух Маресьева. Несмотря на отсутствие ног, он сумел освоить протезы: научился не только ходить, но и бегать и даже танцевать. А в 1943 году вновь отправился на фронт, защищать Родину от фашистских врагов. В воздухе Маресьеву за весь период войны удалось сбить 11 вражеских самолетов. Мало кто знает, что...</p>', '<p style="text-align:justify"><span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">20 мая 2006 года прошло торжественное открытие памятника легендарному летчику-асу А.П. Маресьеву, уроженцу Камышина.&nbsp;</span>Во время ожесточенных боев апреля 1942 года Маресьев был подбит врагом и ранен. Более двух недель пробирался летчик с отмороженными ногами сквозь лес. Обе ноги летчика пришлось ампутировать. Однако это не сломило дух Маресьева. Несмотря на отсутствие ног, он сумел освоить протезы: научился не только ходить, но и бегать и даже танцевать. А в 1943 году вновь отправился на фронт, защищать Родину от фашистских врагов. В воздухе Маресьеву за весь период войны удалось сбить 11 вражеских самолетов. Мало кто знает, что летчик-герой Маресьев стал прототипом персонажа повести Б. Полевого &laquo;Повесть о настоящем человеке&raquo;.</p>\r\n\r\n<p><img alt="" src="/yiicms_host/uploads/images/01.jpg" style="height:482px; width:328px" /></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">Героизм и мужество камышинского летчика не могло быть не вознаграждено. В благодарность за героический поступок был открыт&nbsp;</span><strong>памятник Маресьеву</strong><span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">. Автором трехметрового бронзового монумента стал волгоградский скульптор Сергей Щербаков. Именно благодаря усилиям не только органов власти, но и общественности памятник Маресьеву был установлен в центре&nbsp;</span>Камышина<span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">, на пересечении двух улиц &ndash; Ленина и Некрасова. Открытие монумента проходило торжественно. Присутствовали не только жители Камышина, но и приезжие из других регионов, а также многочисленные родственники Маресьева, губернатор&nbsp;</span>Волгоградской области<span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">, представители ВВС России. Необычным было выступление ВВС России &ndash; был совершен пролет группы штурмовиков СУ-24 над всем&nbsp;</span>Камышином<span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">. Красочным был и военный парад в честь открытия памятника.</span></p>\r\n\r\n<p style="text-align:justify"><img alt="" src="/yiicms_host/uploads/images/03.jpg" style="height:292px; width:430px" /></p>\r\n\r\n<p style="text-align:justify"><span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">(Информация взята с сайта&nbsp;</span>http://vetert.ru/<span style="color:rgb(42, 42, 42); font-family:verdana,arial,helvetica,sans-serif; font-size:12px">)</span></p>\r\n\r\n<p style="text-align:justify">Где находится:</p>\r\n\r\n<p><iframe frameborder="0" height="300" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2559.2508239402982!2d45.427364!3d50.100312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x05bac18763040948!2z0J_QsNC80Y_RgtC90LjQuiDQnNCw0YDQtdGB0YzQtdCy0YM!5e0!3m2!1sru!2sru!4v1433670425922" style="border:0" width="400"></iframe></p>\r\n', 1429475832, 1433674132, 3, 'monument', 7, 4),
(21, 'Скульптура «Родина-мать зовёт!» ', '<p style="text-align:justify;">Скульптура «Родина-мать зовёт!» — композиционный центр памятника-ансамбля «Героям Сталинградской битвы» на Мамаевом кургане в Волгограде. Одна из самых высоких статуй мира.</p>\r\n\r\n<p style="text-align:justify;">Является центральной частью триптиха, в который входят монумент «Тыл — фронту» в Магнитогорске, в котором Рабочий передаёт Воину выкованный на Урале меч; данного памятника, символизирующего, что этот разящий меч был поднят в Сталинграде, и памятника «Воин-освободитель» в Берлине, в котором меч войны Солдатом опущен.</p>\r\n\r\n<p style="text-align:justify;"><img alt="" src="/yiicms_host/uploads/images/mamayev-kurgan-2.jpg" style="height:450px;width:600px;" /></p>\r\n\r\n<p style="text-align:justify;">Работа скульптора Е. В. Вучетича и инженера Н. В. Никитина представляет собой многометровую фигуру женщины, шагнувшей вперёд с поднятым мечом. Статуя является аллегорическим образом Родины, зовущей своих сыновей на битву с врагом.</p>\r\n\r\n<p style="text-align:justify;">Строительство монумента было начато в мае 1959...</p>', '<p style="text-align:justify">Скульптура &laquo;Родина-мать зовёт!&raquo; &mdash; композиционный центр памятника-ансамбля &laquo;Героям Сталинградской битвы&raquo; на Мамаевом кургане в Волгограде. Одна из самых высоких статуй мира.</p>\r\n\r\n<p style="text-align:justify">Является центральной частью триптиха, в который входят монумент &laquo;Тыл &mdash; фронту&raquo; в Магнитогорске, в котором Рабочий передаёт Воину выкованный на Урале меч; данного памятника, символизирующего, что этот разящий меч был поднят в Сталинграде, и памятника &laquo;Воин-освободитель&raquo; в Берлине, в котором меч войны Солдатом опущен.</p>\r\n\r\n<p style="text-align:justify"><img alt="" src="/yiicms_host/uploads/images/mamayev-kurgan-2.jpg" style="height:450px; width:600px" /></p>\r\n\r\n<p style="text-align:justify">Работа скульптора&nbsp;Е.&nbsp;В.&nbsp;Вучетича&nbsp;и инженера&nbsp;Н.&nbsp;В.&nbsp;Никитина&nbsp;представляет собой многометровую фигуру женщины, шагнувшей вперёд с поднятым&nbsp;мечом. Статуя является&nbsp;аллегорическим&nbsp;образом Родины, зовущей своих сыновей на битву с врагом.</p>\r\n\r\n<p style="text-align:justify">Строительство монумента было начато в мае 1959 года и завершено 15 октября 1967 года. Скульптура на момент создания была самым высоким в мире изваянием.&nbsp;</p>\r\n\r\n<p style="text-align:justify">&nbsp;</p>\r\n\r\n<p style="text-align:justify">Где находится:</p>\r\n\r\n<p><iframe frameborder="0" height="300" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2631.070764394977!2d44.53703!3d48.742345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x411acaeb2335dc79%3A0xb82b0d0bdd465803!2z0KDQvtC00LjQvdCwLdC80LDRgtGMINC30L7QstGR0YIh!5e0!3m2!1sru!2sru!4v1433670603100" style="border:0" width="400"></iframe></p>\r\n', 1429476187, 1433674182, 3, 'monument', 6, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `c_tag`
--

CREATE TABLE IF NOT EXISTS `c_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `c_tag`
--

INSERT INTO `c_tag` (`id`, `name`, `frequency`) VALUES
(7, 'museum', 1),
(8, 'monument', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `c_user`
--

CREATE TABLE IF NOT EXISTS `c_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `role` int(11) NOT NULL,
  `activationKey` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `c_user`
--

INSERT INTO `c_user` (`id`, `username`, `password`, `email`, `url`, `role`, `activationKey`, `status`) VALUES
(1, 'admin', '$2y$13$/v5Tn4AzhO2uATBhOdYFCOKKM6qVbGh4Fsdvvj.jzNUPDh6tKLzMm', 'webmaster@example.com', '', 1, '', 1),
(2, 'demo', '$2y$13$ogH04RQoaFnY6USz2SeoAuI17fACn0wPsmZY/sW6xiHbQvoXAl0VO', 'demo@localhost.com', '', 4, '', 1),
(3, 'author', '$2y$13$BFEGyE0IcWYYcBCekJcpyuvL4JwFWVRCg7rKetiJgUErF8AvSNbsO', 'author@localhost.com', '', 3, '', 1),
(4, 'editor', '$2y$13$oKeb.YARlU8ZFYBW3q2DC.t0AllFwcDH3PpwN3sv.Nk6eYJ88lRVC', 'editor@localhost.com', '', 2, '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
