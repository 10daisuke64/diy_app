-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022 年 1 月 20 日 15:39
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
-- テーブルの構造 `answers_table`
--

CREATE TABLE `answers_table` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `body` text COLLATE utf8mb4_bin NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `categories_table`
--

CREATE TABLE `categories_table` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `slug` varchar(128) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `categories_table`
--

INSERT INTO `categories_table` (`id`, `name`, `slug`) VALUES
(1, '木材', 'material'),
(2, '工具', 'tool'),
(3, '内装', 'interior'),
(4, '中古物件', 'resale_house'),
(5, '古民家', 'old_house'),
(6, '基礎工事', 'foundation'),
(7, '電気工事', 'electrical'),
(8, '水道工事', 'water');

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
(12, 1, '古民家の購入を検討しています', '古民家の購入を検討しており、何度か内見に行きましたが、修繕費がどのぐらいかかるか予想できません。内見時の写真をお見せするので、アドバイスいただけないでしょうか？', 1, 0, '2022-01-20 22:24:04', '2022-01-20 22:24:04'),
(13, 1, '基礎からセルフビルドで小屋を建てます', '基礎からセルフビルドで小屋を作ろうと計画しています。\r\n基礎工事について、ご相談できる方を探しております。', 1, 0, '2022-01-20 22:29:37', '2022-01-20 22:29:37'),
(14, 2, 'ハイコーキとマキタどっちがいいですか', 'ホームセンターの自社ブランドのインパクトドライバーを使用していますが、本格的にDIYを始めるので、ハイコーキかマキタの18V工具で揃えようと考えています。工具について相談できるメンターさんを募集します！', 1, 0, '2022-01-20 22:31:59', '2022-01-20 22:31:59'),
(15, 3, '古民家の床の張り替えを行なっています', '古民家の畳をフローリング化する作業を行なっていますが、大引がシロアリに食べられた形跡があり、交換すべきかどうか・交換する場合はどの木材を買ったらいいかで悩んでいます。', 1, 0, '2022-01-20 22:34:33', '2022-01-20 22:34:33'),
(16, 3, '分電盤の交換について', '中古物件のリフォームをDIYで行っており、既存の電気配線が古いので分電盤ごと交換する予定です。私は第二種電工の有資格者ですが、ブランクがあるので心配です。作業の流れを確認していただけませんか？', 1, 0, '2022-01-20 22:40:30', '2022-01-20 22:40:30'),
(17, 18, '壁紙を貼るのがうまくいきません', '中古物件のリフォームで、大部屋に間仕切りを作って2部屋にしようと考えています。下地は作って、これからパテ塗りとクロス貼りに入りますが、なかなかキレイにできません。何かやり方が間違っているのでしょうか？ アドバイスお願いします。', 1, 0, '2022-01-20 22:46:31', '2022-01-20 22:46:31'),
(18, 18, '無垢の床材が高い……', '中古物件のリフォームで、無垢のフローリングを貼ろうと考えています。しかし調べてみると値段が高いので悩んでいます。山口県内で安く買えるお店や、端材マーケット、端材のあまりを譲ってくれる方、などなどご紹介いただけないでしょうか？', 1, 0, '2022-01-20 22:48:58', '2022-01-20 22:49:27'),
(19, 19, 'トイレDIYで給水管の位置を変更したい', 'トイレのリフォームを行なっており、下地作りからやり直しています。現状、トイレの給水管が壁出しになっているので、床出しに変更したいと思っています。水道工事は初めてなので、段取りを確認していただける方を探しています。', 1, 0, '2022-01-20 22:53:30', '2022-01-20 22:53:30'),
(20, 19, 'トイレDIYでの接地極付きコンセントについて', 'トイレのリフォームを行なっています。現状、普通のコンセントが1口ついているのですが、アース付きコンセントへ変更したく、D種設置をやってみようと思っています。絶縁抵抗の測定方法がよくわからないのでご相談させていただきたいです。', 1, 0, '2022-01-20 22:56:07', '2022-01-20 22:56:07');

-- --------------------------------------------------------

--
-- テーブルの構造 `question_category`
--

CREATE TABLE `question_category` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `question_category`
--

INSERT INTO `question_category` (`id`, `question_id`, `category_id`) VALUES
(10, 12, 5),
(11, 13, 2),
(12, 13, 6),
(13, 14, 2),
(14, 15, 1),
(15, 15, 5),
(16, 16, 4),
(17, 16, 7),
(18, 17, 3),
(19, 17, 4),
(20, 18, 1),
(21, 18, 3),
(22, 18, 4),
(23, 19, 8),
(24, 20, 7);

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
(1, 'A', 'diyer_a@example.com', '$2y$10$IptMLf/UWAXN.UCl.uBdkeF6RQmjP46PZnu3FG5mrYWZuZsobL1jC', 0, 1, 0, 0, '2022-01-20 22:13:11', '2022-01-20 22:13:11'),
(2, 'B', 'diyer_b@example.com', '$2y$10$kuAXfbt0w6RERuQL8FMGtu5wqI5GojoD3KgNH0/weG4vAAwpW07HO', 0, 1, 0, 0, '2022-01-20 22:15:02', '2022-01-20 22:15:02'),
(3, 'C', 'diyer_c@example.com', '$2y$10$AuJwclUJH3MlgF.mYvyrVeg0oprz5wIFBbw.U5j2nSS4UWnqNzNki', 0, 1, 0, 0, '2022-01-20 22:15:42', '2022-01-20 22:15:42'),
(4, '職人Z', 'mentor_z@example.com', '$2y$10$inqSLEU2DFqmdFkzHKUmDuCQ3yVzu1xp2gnryQYc3Z3/N86M5FUK.', 0, 0, 1, 0, '2022-01-20 22:16:49', '2022-01-20 22:16:49'),
(5, '職人Y', 'mentor_y@example.com', '$2y$10$0XZ7uHdQ2j75BIvBLF.yQutW8FgiU0zfaamw7BdzIbCU.pqtLPNae', 0, 0, 1, 0, '2022-01-20 22:17:15', '2022-01-20 22:17:15'),
(6, '職人X', 'mentor_x@example.com', '$2y$10$ZtqGiTbu5WS4Sif0l/8hTOK8h3jJiy2CYuWl5CQztll0XBXnD7P7W', 0, 0, 1, 0, '2022-01-20 22:17:38', '2022-01-20 22:17:38'),
(18, 'D', 'diyer_d@example.com', '$2y$10$e6rgW60/cawElzhAHLJoceiQdGw4gVqdzobU8szByiVKlQMUJymkG', 0, 1, 0, 0, '2022-01-20 22:43:09', '2022-01-20 22:43:09'),
(19, 'E', 'diyer_e@example.com', '$2y$10$aN9Nb6EzSpj0g3.tuGRw5e41/P8yDps.fT5C4zluXZyOf8/hKwLRm', 0, 1, 0, 0, '2022-01-20 22:50:36', '2022-01-20 22:50:36');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answers_table`
--
ALTER TABLE `answers_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `categories_table`
--
ALTER TABLE `categories_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `questions_table`
--
ALTER TABLE `questions_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `question_category`
--
ALTER TABLE `question_category`
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
-- テーブルの AUTO_INCREMENT `answers_table`
--
ALTER TABLE `answers_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `categories_table`
--
ALTER TABLE `categories_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- テーブルの AUTO_INCREMENT `questions_table`
--
ALTER TABLE `questions_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `question_category`
--
ALTER TABLE `question_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
