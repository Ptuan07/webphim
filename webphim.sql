-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 16, 2023 lúc 05:46 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webphim`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `status`, `slug`, `position`) VALUES
(5, 'Phim mới', 'Phim mới', 1, 'phim-moi', 1),
(6, 'Phim lẻ', 'Phim lẻ', 1, 'phim-le', 2),
(7, 'Phim chiếu rạp', 'Phim chiếu rạp', 1, 'phim-chieu-rap', 0),
(8, 'Phim bộ', 'Phim truyền hình dài tập', 1, 'phim-truyen-hinh-dai-tap', 5),
(9, 'Phim Thuyết Minh', 'phim được lồng tiếng', 1, 'phim-thuyet-minh', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `countries`
--

INSERT INTO `countries` (`id`, `title`, `description`, `status`, `slug`) VALUES
(2, 'Việt Nam', 'Việt Nam', 1, 'viet-nam'),
(3, 'Trung Quốc', 'Trung Quốc', 1, 'trung-quoc'),
(4, 'Mỹ', 'Mỹ', 1, 'my'),
(5, 'Hàn Quốc', 'oppa', 1, 'han-quoc'),
(6, 'Nhật Bản', 'ádfasd', 1, 'nhat-ban'),
(7, 'Thái Lan', 'nana', 1, 'thai-lan'),
(8, 'Ấn Độ', 'âfdfwrqrq', 1, 'an-do');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `linkphim` varchar(10000) NOT NULL,
  `episode` int(11) NOT NULL,
  `updated_at` varchar(50) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `episodes`
--

INSERT INTO `episodes` (`id`, `movie_id`, `linkphim`, `episode`, `updated_at`, `created_at`) VALUES
(1, 17, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VN29td-lsQU?si=Ky72HeVGvPvo292E\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, '2023-11-16 08:25:25', '2023-11-16 08:25:25'),
(2, 17, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VN29td-lsQU?si=Ky72HeVGvPvo292E\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 2, '2023-11-16 09:21:02', '2023-11-16 09:21:02'),
(3, 17, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VN29td-lsQU?si=Ky72HeVGvPvo292E\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 3, '2023-11-16 09:21:07', '2023-11-16 09:21:07'),
(4, 18, '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/VN29td-lsQU?si=Ky72HeVGvPvo292E\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe>', 1, '2023-11-16 09:48:48', '2023-11-16 09:48:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `genres`
--

INSERT INTO `genres` (`id`, `title`, `description`, `status`, `slug`) VALUES
(2, 'Võ thuật', 'Võ thuật', 1, 'vo-thuat'),
(3, 'Tâm lý', 'Tâm lý', 1, 'tam-ly'),
(4, 'Trinh thám', 'Trinh thám', 1, 'trinh-tham'),
(5, 'Khoa học viễn tưởng', 'Phim Khoa học viễn tưởng', 1, 'khoa-hoc-vien-tuong'),
(6, 'Kinh dị', 'Phim kinh dị', 1, 'kinh-di'),
(7, 'Hoạt Hình', 'Phim Hoạt Hình', 1, 'hoat-hinh'),
(8, 'Hành Động', 'Phim đấm nhau', 1, 'hanh-dong'),
(9, 'Lãng Mạng', 'Phim lãng mạng', 1, 'lang-mang'),
(10, 'Cổ Trang', 'Phim Cổ Trang', 1, 'co-trang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `time` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `phim_hot` int(11) NOT NULL,
  `name_eng` varchar(255) NOT NULL,
  `resolution` int(50) DEFAULT 0,
  `vietsub` int(11) NOT NULL,
  `season` int(11) DEFAULT 0,
  `ngaytao` varchar(50) DEFAULT NULL,
  `ngaycapnhat` varchar(50) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `topview` int(11) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `sotap` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `title`, `time`, `description`, `status`, `image`, `category_id`, `genre_id`, `country_id`, `slug`, `phim_hot`, `name_eng`, `resolution`, `vietsub`, `season`, `ngaytao`, `ngaycapnhat`, `year`, `tags`, `topview`, `trailer`, `sotap`) VALUES
(4, 'BÓNG MA ANH QUỐC', NULL, 'ccưewewewe', 1, 'bong-ma-anh-quoc-phan-1-1111452942102.jpg', 5, 4, 4, 'bong-ma-anh-quoc', 1, 'vietnamese', 4, 0, 0, '', '', '2023', NULL, 0, NULL, 1),
(5, 'Đại chiến Thái Bình Dương', NULL, 'Phim bắt đầu bởi lời kể của anh chàng da màu Jake Pentecost về việc loại người đã chế tạo ra các người máy Jeager để ...', 1, 'tải xuống546.jpg', 5, 2, 2, 'dai-chien-thai-binh-duong', 1, 'Pacific Rim', 0, 0, 0, '', '', '2018', NULL, 2, NULL, 1),
(6, 'Tết Ở Làng Địa Ngục', NULL, 'Tết Ở Làng Địa Ngục các hậu duệ của một băng cướp khét tiếng điều tra hàng loạt án mạng tàn bạo ở làng của họ. Liệu đây là nghiệp chướng hay “tác phẩm” của kẻ báo thù?', 1, 'tải xuống4840.jpg', 7, 6, 2, 'tet-o-lang-dia-nguc', 1, 'Hellbound Village', 0, 0, 0, '', '2023-11-11 15:09:59', '2023', NULL, 0, NULL, 1),
(7, 'Năm Đêm Kinh Hoàng', NULL, 'Năm Đêm Kinh Hoàng – Five Nights at Freddy’s (2023) nhân viên bảo vệ Mike bắt đầu làm việc tại Freddy Fazbear’s Pizza. Trong đêm làm việc đầu tiên, anh nhận ra mình sẽ không dễ gì vượt qua được ca đêm ở đây. Chẳng mấy chốc, anh sẽ vén màn sự thật đã xảy ra tại Freddy’s.', 1, 'Nam-Dem-Kinh-Hoang3976.jpg', 6, 6, 4, 'nam-dem-kinh-hoang', 1, 'Five Nights at Freddy\'s 2023', 4, 0, 0, '', '2023-11-11 15:09:51', '2023', NULL, 1, NULL, 1),
(8, 'Lưỡi Cưa 10', NULL, 'Lưỡi Cưa 10 – Saw X (2023) lấy bối cảnh giữa các sự kiện của hai phần phim đầu phim, John Kramer ốm yếu và tuyệt vọng đến Mexico để thực hiện một quy trình y tế thử nghiệm và mạo hiểm với hy vọng chữa khỏi bệnh ung thư của mình bằng phép màu nhưng rồi mau chóng phát hiện ra rằng toàn bộ ca phẫu thuật là một trò lừa đảo nhằm lừa đảo những người dễ bị tổn thương nhất', 1, 'Luoi-cua-106726.jpg', 5, 6, 4, 'luoi-cua-10', 1, 'Saw X 2023', 3, 1, 0, '', '', '2021', NULL, 1, NULL, 1),
(9, 'Cuộc Chiến Sinh Tồn', NULL, 'Cuộc Chiến Sinh Tồn – The Escape of the Seven (2023) thuộc thể loại tội phạm bí ẩn, gay cấn, đặc biệt khác với phần lớn dự án khác thường chú trọng vào cái thiện, phim lại tập trung vào nhân vật phản diện với những ham muốn xấu xa đáng sợ.\r\n\r\nBộ phim xoay quanh bảy người bị cuốn vào vụ án về sự biến mất đầy bí ẩn của một cô gái trẻ. Bảy người họ với hoàn cảnh xuất thân khác nhau cùng bị vướng vào vòng xoáy của sự dối trá, những cám dỗ và tham vọng đầy phức tạp, trói buộc họ với vụ án mất tích.', 1, 'The-Escape-of-the-Seven6788.jpg', 5, 6, 2, 'cuoc-chien-sinh-ton', 1, 'The Escape of the Seven 2023', 4, 0, 0, '', '', '2019', NULL, 2, NULL, 1),
(10, 'HỘ TÂM', NULL, 'Hộ Tâm kể về yêu long Thiên Diệu đem lòng yêu Tố Ảnh nhưng lại bị nàng ta phản bột, rút xương phong ấn ở nhiều nơi. Biết được ý đồ của Tố Ảnh, Thiên Diệu lột vảy hộ tâm, ném nội đan đi. Vảy hộ tâm và nội đan của Thiên Diệu rơi xuống trần gian, vô tình cứu giúp Nhạn Hồi. Nhạn Hồi cũng vô tình mà giúp hắn phá vỡ 1 phần phong ấn, giải thoát linh hồn. Thế rồi Nhạn Hồi và Thiên Diệu gặp nhau. Thiên Diệu biết được vảy hộ tâm và nội đan của hắn đang ở trên người Nhạn Hồi nên một mực bám lấy nàng, bày mưu tính kế để nàng giúp mình, coi nàng là quân cờ trong đại nghiệp phục thù. Nhưng hắn đâu ngờ, bản thân lại đánh rơi trái tim nơi nàng mất rồi. Câu chuyện giữa Nhạn Hồi và Thiên Diệu sẽ tiếp tục ra sao?', 1, 'ho-tam1139.jpg', 8, 2, 3, 'ho-tam', 1, 'Back From the Brink', 4, 0, 0, '', '', NULL, NULL, 0, NULL, 1),
(11, 'THẾ GIỚI HOÀN MỸ', '25 Phút / 1 Tập', 'Thế Giới Hoàn Mỹ kể về quá trình trưởng thành của một đứa trẻ trời sinh Chí Tôn cốt (đứa bé này tương lai có thể sánh vai cùng hung Thái cổ được trời ưu ái, có thể chinh chiến với Chân Hống, Kim Sí Đại Bàng có huyết mạnh tinh thuần đến hoàn mỹ, Nguyên thủy bảo thuật của nó sẽ danh chấn thiên hạ, được ghi khắc vào lịch sử của Nhân tộc).', 1, 'the-gioi-hoan-my-93804951.jpg', 8, 7, 3, 'the-gioi-hoan-my', 1, 'Wanmei Shijie', 1, 0, 0, '', '2023-11-15 15:51:11', NULL, NULL, 0, NULL, 120),
(12, 'LOKI: THẦN LỪA LỌC', NULL, 'Loki: Thần Lừa Lọc (Phần 2) kể về Khi Steve Rogers, Tony Stark và Scott Lang quay trở về cột mốc 2012, ngay khi trận chiến ở New York kết thúc, để “mượn tạm” quyền trượng của Loki. Nhưng một tai nạn bất ngờ xảy đến, khiến Loki nhặt được khối lặp phương Tesseract và tiện thể tẩu thoát. Cuộc trốn thoát này đã dẫn đến dòng thời gian bị rối loạn. Cục TVA – tổ chức bảo vệ tính nguyên vẹn của dòng chảy thời gian, buộc phải can thiệp, đi gô cổ ông thần này về làm việc. Tại đây, Loki có hai lựa chọn, một là giúp TVA ổn định lại thời gian, không thì bị tiêu hủy. Dĩ nhiên Loki chọn lựa chọn thứ nhất. Nhưng đây là nước đi vô cùng mạo hiểm, vì ông thần này thường lọc lừa, “lươn lẹo”, chuyên đâm lén như bản tính tự nhiên của gã.', 1, 'loki-than-lua-loc-phan-23795.jpg', 5, 5, 4, 'loki-than-lua-loc', 1, 'Loki', 2, 1, 0, '', '2023-11-15 15:50:51', '2022', NULL, 0, NULL, 10),
(13, 'ÁC QUỶ MA SƠ', NULL, 'The Nun 2 - Ác Quỷ Ma Sơ 2 là phần phim tiếp nối câu chuyện năm 2019 của The Nun, phim lấy bối cảnh nước Pháp năm 1956, cùng cái chết bí ẩn của một linh mục, một giai thoại đáng sợ và ám ảnh sẽ mở ra tiếp tục xoay quanh nhân vật chính - Sơ Irene. Liệu Sơ Irene có nhận ra, đây chính là hồn ma nữ tu Valak từng có cuộc chiến “sống còn” với cô không lâu trước đây.', 1, 'ac-quy-ma-so-2845.jpg', 6, 6, 4, 'ac-quy-ma-so', 1, 'The Nun', 4, 1, 0, '', '2023-11-15 09:47:56', '2019', NULL, 2, NULL, 1),
(14, 'AVATAR: DÒNG CHẢY CỦA NƯỚC', NULL, 'Thế Thân: Dòng Chảy Của Nước lấy bối cảnh 10 năm sau những sự kiện xảy ra ở phần đầu tiên. Phim kể câu chuyện về gia đình mới của Jake Sully (Sam Worthington thủ vai) cùng những rắc rối theo sau và bi kịch họ phải chịu đựng khi phe loài người xâm lược hành tinh Pandora.', 1, 'avatar-dong-chay-cua-nuoc-108513714.jpg', 7, 5, 4, 'avatar-dong-chay-cua-nuoc', 1, 'Avatar: The Way of Water', 3, 0, 0, '', '', '2022', NULL, 2, NULL, 1),
(15, 'SÁT THỦ JOHN WICK', '120 Phút', 'Sát Thủ John Wick 4 là câu chuyện với cái giá phải trả ngày càng tăng, John Wick tham gia cuộc chiến chống lại High Table trên toàn cầu khi tìm kiếm những người chơi quyền lực nhất trong thế giới ngầm, từ New York qua Paris, Osaka đến cả Berlin.', 1, 'sat-thu-john-wick-4-111194212.jpg', 7, 8, 4, 'sat-thu-john-wick', 1, 'John Wick: Chapter', 5, 1, 4, '', '2023-11-15 09:47:39', '2022', NULL, 1, 'qEVUtrk8_B4', 1),
(16, 'TRANSFORMERS: QUÁI THÚ TRỖI DẬY', '133 Phút', 'Transformers: Quái Thú Trỗi Dậy dựa trên sự kiện Beast Wars trong loạt phim hoạt hình \"Transformers\", nơi mà các robot có khả năng biến thành động vật khổng lồ cùng chiến đấu chống lại một mối đe dọa tiềm tàng.', 1, 'transformers-quai-thu-troi-day3567.jpg', 7, 8, 4, 'transformers-quai-thu-troi-day', 1, 'Rise Of The Beasts', 4, 0, 0, '', '2023-11-15 09:47:26', '2023', NULL, 1, NULL, 1),
(17, 'TÂN THẦN ĐIÊU ĐẠI HIỆP', '45 Phút / Tập', 'Tân Thần Điêu Đại Hiệp kể vào cuối thời Nam Tống, khi quân Mông Cổ đã lớn mạnh, tiêu diệt hầu hết châu Á, châu Âu, đang trực tiếp uy hiếp an nguy của Nam Tống. Câu chuyện xoay quanh tình yêu của hai nhân vật chính là Dương Quá và Tiểu Long Nữ giữa những cuộc chiến tang thương đẫm máu cả trên giang hồ lẫn chiến trường.', 1, 'tan-than-dieu-dai-hiep-64267751.jpg', 8, 9, 3, 'tan-than-dieu-dai-hiep', 1, 'The Return of the Condor Heroes', 0, 1, 0, '2023-11-11 22:08:04', '2023-11-15 15:50:30', '2022', 'xem phim Tân Thần Điêu Đại Hiệp vietsub, phim The Return of the Condor Heroes vietsub, xem Tân Thần Điêu Đại Hiệp vietsub online tap 1, tap 2, tap 3, tap 4, phim The Return of the Condor Heroes ep 5, ep 6, ep 7, ep 8, ep 9, ep 10, xem Tân Thần Điêu Đại Hiệp tập 11, tập 12, tập 13, tập 14, tập 15, phim Tân Thần Điêu Đại Hiệp tap 16, tap 17, tap 18, tap 19, tap 20, xem phim Tân Thần Điêu Đại Hiệp tập 21, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, Tân Thần Điêu Đại Hiệp tap cuoi, The Return of the Condor Heroes vietsub tron bo, review Tân Thần Điêu Đại Hiệp netflix, Tân Thần Điêu Đại Hiệp wetv, Tân Thần Điêu Đại Hiệp phimmoi, Tân Thần Điêu Đại Hiệp youtube, Tân Thần Điêu Đại Hiệp dongphym, Tân Thần Điêu Đại Hiệp vieon, phim keeng, bilutv, biphim, hdvip, hayghe, motphim, tvhay, zingtv, fptplay, phim1080, luotphim, fimfast, dongphim, fullphim, phephim, vtvgiaitri Tân Thần Điêu Đại Hiệp full, The Return of the Condor Heroes online, Tân Thần Điêu Đại Hiệp Thuyết Minh, Tân Thần Điêu Đại Hiệp Vietsub, Tân Thần Điêu Đại Hiệp Lồng Tiếng', 2, NULL, 45),
(18, 'TIÊN NGHỊCH', '25 Phút / 1 Tập', 'Tiên Nghịch kể về cuộc hành trình của Thiếu Niên Trương Tiểu Phàm, một người bình thường nhưng với khát vọng trở thành một thiên tài tu luyện. Trong thế giới của Tiên Nghịch, các tộc linh, yêu ma và các thế lực siêu nhiên tồn tại song song với nhau. Trương Tiểu Phàm phải vượt qua nhiều thử thách và gian khó để trở thành một Võ Sĩ Tu Luyện thực thụ. Với đồ họa tuyệt đẹp và cốt truyện đầy kịch tính, Tiên Nghịch | Xian Ni (2023) hứa hẹn sẽ mang đến cho khán giả những trải nghiệm tuyệt vời và không thể quên.', 1, 'tien-nghich7332.jpg', 8, 8, 3, 'tien-nghich', 1, 'Xian Ni', 4, 0, 0, '2023-11-14 12:37:28', '2023-11-15 15:50:22', '2023', 'xem phim Tiên Nghịch vietsub, phim Xian Ni vietsub, xem Tiên Nghịch vietsub online tap 1, tap 2, tap 3, tap 4, phim Xian Ni ep 5, ep 6, ep 7, ep 8, ep 9, ep 10, xem Tiên Nghịch tập 11, tập 12, tập 13, tập 14, tập 15, phim Tiên Nghịch tap 16, tap 17, tap 18, tap 19, tap 20, xem phim Tiên Nghịch tập 21, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, Tiên Nghịch tap cuoi, Xian Ni vietsub tron bo, review Tiên Nghịch netflix, Tiên Nghịch wetv, Tiên Nghịch phimmoi, Tiên Nghịch youtube, Tiên Nghịch dongphym, Tiên Nghịch vieon, phim keeng, bilutv, biphim, hdvip, hayghe, motphim, tvhay, zingtv, fptplay, phim1080, luotphim, fimfast, dongphim, fullphim, phephim, vtvgiaitri Tiên Nghịch full, Xian Ni online, Tiên Nghịch Thuyết Minh, Tiên Nghịch Vietsub, Tiên Nghịch Lồng Tiếng', NULL, NULL, 50),
(19, 'Án Mạng Ở Venice', '104 Phút', 'Án Mạng Ở Venice – A Haunting in Venice (2023) lấy bối cảnh năm 1947 tại Venice, khi này thám tử tài ba Hercule Poirot đã lui về ở ẩn và rời xa các vụ án dù liên tục nhận được nhiều lời mời gọi. Tuy nhiên, những án mạng vẫn chẳng thể rời xa ông khi nhà văn và đồng thời là người bạn cũ lâu năm, Ariadne Oliver, bằng cách nào đó đã vượt qua người gác cổng Vitale Portfoglio để gửi đến Poirot một lời đề nghị đặc biệt.\r\n\r\nÔng một lần nữa phải bắt tay vào cuộc giải mã mới và lần này liên quan đến bi kịch một năm trước xoay quanh ca sĩ opera từng rất nổi tiếng có tên Rowena Drake. Bí ẩn từ trong quá khứ trở nên kinh hoàng hơn nữa khi nó không chỉ tạo ra những day dứt và đau khổ kéo dài mà còn chính là động cơ khiến cho hai vụ án mạng liên tiếp được sắp xếp cẩn thận, xảy ra ngay trước mắt Poirot trong chính đêm Halloween.', 1, 'An-Mang-O-Venice7598.jpg', 7, 4, 4, 'an-mang-o-venice', 1, 'A Haunting in Venice 2023', 5, 1, 0, '2023-11-15 09:31:07', '2023-11-15 09:32:23', '2023', NULL, NULL, 'q1Aah6OuEv8', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_genre`
--

CREATE TABLE `movie_genre` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movie_genre`
--

INSERT INTO `movie_genre` (`id`, `movie_id`, `genre_id`) VALUES
(1, 19, 3),
(2, 19, 4),
(3, 18, 2),
(4, 18, 7),
(5, 18, 8),
(6, 17, 2),
(7, 17, 9),
(8, 16, 5),
(9, 16, 8),
(10, 15, 2),
(11, 15, 8),
(12, 13, 3),
(13, 13, 6),
(14, 12, 3),
(15, 12, 5),
(16, 11, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tuan07', 'pvantuan122@gmail.com', NULL, '$2y$10$/ElBxtNhN0pjXs7Gsm76S.JSIDvzkNaNeDCENtJ7mHPgv7SRYVaYm', NULL, '2023-11-06 07:02:41', '2023-11-06 07:02:41'),
(2, 'Duong Nguyen', 'duongnguyen@gmail.com', NULL, '$2y$10$jBbyI4M8BJbLnaDEUSp.neJ4DmxCULzdd/sQyvfCCAkgWANQwWQwa', 'AwgJQ1nVVgORSEhzTnNmXjsDZxMJWZVzIV6cx3IJ8AdesfapVK4PC5WUJrlD', '2023-11-10 23:49:43', '2023-11-10 23:49:43');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Episode_Movie` (`movie_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Movie_Category` (`category_id`),
  ADD KEY `FK_Movie_Country` (`country_id`),
  ADD KEY `FK_Movie_Genre` (`genre_id`);

--
-- Chỉ mục cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_MovieGenre_Movie` (`movie_id`),
  ADD KEY `FK_MovieGenre_Genre` (`genre_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `FK_Episode_Movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Các ràng buộc cho bảng `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `FK_Movie_Category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_Movie_Country` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `FK_Movie_Genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);

--
-- Các ràng buộc cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `FK_MovieGenre_Genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MovieGenre_Movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
