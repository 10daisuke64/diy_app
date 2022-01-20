-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022 年 1 月 13 日 14:55
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `diy_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `questions_table`
--

CREATE TABLE `questions_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `body` text COLLATE utf8mb4_bin NOT NULL,
  `is_published` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `questions_table`
--

INSERT INTO `questions_table` (`id`, `user_id`, `title`, `body`, `is_published`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 2, 'タイトル', '内容', 1, 0, '2022-01-13 20:59:45', '2022-01-13 20:59:45'),
(2, 1, '床下の調湿について聞きたいです', '床下から水が湧き出ていて困っています', 0, 0, '2022-01-13 21:18:40', '2022-01-13 22:12:28'),
(3, 1, '根太の間隔について', '床の根太は何ミリ間隔に配置したらいいですか？', 1, 0, '2022-01-13 22:29:14', '2022-01-13 22:29:14'),
(4, 1, '断熱材について', 'おすすめの断熱材はありますか？ 壁の間柱の間に入れるものを探しています。', 1, 0, '2022-01-13 22:29:46', '2022-01-13 22:29:46');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_diyer` int(1) NOT NULL,
  `is_mentor` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `name`, `email`, `password`, `is_admin`, `is_diyer`, `is_mentor`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'テスト', 'test@mail.com', '$2y$10$Kv1T8vrMjVeGfxsn4BGMe.qCWnz7Pz2QQXVVeoet8QHvayy3DvCqC', 0, 1, 0, 0, '2022-01-13 15:24:04', '2022-01-13 15:24:04'),
(2, 'すみだ', 'sumida@mail.com', '$2y$10$drTY8PdsHlz/EfMoDubTxeST0HARdvhACaLXknoQRk1F0R628lp06', 0, 1, 0, 0, '2022-01-13 18:51:19', '2022-01-13 18:51:19'),
(3, 'aaa', 'aaa@mail.com', '$2y$10$Nj2G3pMx9sB6WSi/40HtFua7vUBwjTSfgkMncEkhbWK1rQBTKSpSG', 0, 1, 0, 0, '2022-01-13 18:57:50', '2022-01-13 18:57:50'),
(4, 'テスト', 'diyer@example.com', '$2y$10$WhI6fjvunjOGZSktQDbzNOMLx4ZetKpormwLDbohv1Vc59ndT/Gpy', 0, 1, 0, 0, '2022-01-13 19:00:53', '2022-01-13 19:00:53');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `questions_table`
--
ALTER TABLE `questions_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `questions_table`
--
ALTER TABLE `questions_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
