-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2025 lúc 07:53 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `database`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_password` varchar(100) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `account_phone` varchar(20) NOT NULL,
  `account_type` int(11) NOT NULL,
  `account_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_password`, `account_email`, `account_phone`, `account_type`, `account_status`) VALUES
(23, 'Admin', '123456', 'admin@gmail.com', '', 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `article_link` varchar(255) NOT NULL,
  `article_tag` varchar(100) NOT NULL,
  `article_author` varchar(100) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_summary` text NOT NULL,
  `article_content` text NOT NULL,
  `article_image` varchar(255) NOT NULL,
  `article_video` varchar(255) DEFAULT NULL,
  `article_date` date NOT NULL,
  `article_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `article`
--

INSERT INTO `article` (`article_id`, `article_link`, `article_tag`, `article_author`, `article_title`, `article_summary`, `article_content`, `article_image`, `article_video`, `article_date`, `article_status`) VALUES
(85, 'abc', 'maytinhvanphong,pcvanphong, maytinhcongty,chonpcvanphong,maytinhdoanhnghiep, rosaoffice,maytinhvanph', 'Admin', 'Chàng trai Việt \"bá đạo\" đứng sau bài thi \"hack não\" nhất cho AI: Khiến Elon Musk cũng phải \"tròn mắt\"!', '<p>diugidgfidygisdgsidgodg</p>\r\n', '<p>dgsagsagdsag</p>\r\n', '1743348977_BODY MIST ĐỎ 11.png', NULL, '2025-03-30', 1),
(87, 'chang-trai-Viet-ba-dao-dung-sau-bai-thi-hack-nao-nhat-cho-ai-khien-Elon-Musk-cung-phai-tron-mat.php', 'maytinhvanphong,pcvanphong, maytinhcongty,chonpcvanphong,maytinhdoanhnghiep, rosaoffice,maytinhvanph', 'Admin', 'Tổng thống Donald Trump gặp CEO Nvidia để bàn về DeepSeek', '<p>WWWWWWWWWWWWWWWWWWWW</p>', '<p>EEEEEEEEEEEEEEEEEEEEEE</p><video controls><source src=\"uploads/videos/1743352012_6216017917664413242.mp4\" type=\"video/mp4\">Your browser does not support the video tag.</video>', '1743352012_75.jpg', '1743352012_6216017917664413242.mp4', '2025-03-30', 1),
(40, 'Multiple%20Object%20Tracking%20(MOT).php', '', 'Admin', 'Multiple Object Tracking (MOT): Công nghệ theo dõi đa đối tượng trong tầm nhìn máy tính', '<h1>Multiple Object Tracking (MOT): C&ocirc;ng nghệ theo d&otilde;i đa đối tượng trong tầm nh&igrave;n m&aacute;y t&iacute;nh</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>I. Giới Thiệu</strong></h2>\r\n\r\n<p>Theo d&otilde;i đa đối tượng (Multiple Object Tracking - MOT) l&agrave; một lĩnh vực quan trọng trong tr&iacute; tuệ nh&acirc;n tạo v&agrave; thị gi&aacute;c m&aacute;y t&iacute;nh, nơi hệ thống cần x&aacute;c định v&agrave; theo d&otilde;i vị tr&iacute; của nhiều đối tượng c&ugrave;ng l&uacute;c trong một video hoặc chuỗi h&igrave;nh ảnh. C&ocirc;ng nghệ n&agrave;y ng&agrave;y c&agrave;ng trở n&ecirc;n phổ biến v&agrave; cần thiết trong c&aacute;c ứng dụng thực tiễn như gi&aacute;m s&aacute;t an ninh, xe tự h&agrave;nh, ph&acirc;n t&iacute;ch thể thao, v&agrave; robot.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>II. Cơ chế hoạt động</strong></h2>\r\n\r\n<p>Một hệ thống MOT thường bao gồm c&aacute;c bước ch&iacute;nh:</p>\r\n\r\n<p><strong>1. Ph&aacute;t hiện đối tượng (Object Detection)</strong></p>\r\n\r\n<ul>\r\n	<li>Đ&acirc;y l&agrave; bước đầu ti&ecirc;n, nơi c&aacute;c đối tượng cần theo d&otilde;i được nhận diện trong từng khung h&igrave;nh. C&aacute;c thuật to&aacute;n phổ biến bao gồm:</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>???? YOLO (You Only Look Once)</li>\r\n	<li>???? Faster R-CNN</li>\r\n	<li>???? SSD (Single Shot MultiBox Detector)</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>2. Li&ecirc;n kết dữ liệu (Data Association)</strong></p>\r\n\r\n<p>Sau khi ph&aacute;t hiện đối tượng, hệ thống cần li&ecirc;n kết c&aacute;c đối tượng n&agrave;y qua c&aacute;c khung h&igrave;nh để duy tr&igrave; nhận diện nhất qu&aacute;n. Đ&acirc;y l&agrave; một th&aacute;ch thức lớn v&igrave; c&aacute;c đối tượng c&oacute; thể bị che khuất, thay đổi vị tr&iacute; nhanh ch&oacute;ng hoặc c&oacute; ngoại h&igrave;nh tương tự nhau.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>3. Theo d&otilde;i đối tượng (Tracking)</strong></p>\r\n\r\n<p>C&aacute;c thuật to&aacute;n như Kalman Filter hoặc Particle Filter được sử dụng để dự đo&aacute;n vị tr&iacute; tiếp theo của c&aacute;c đối tượng dựa tr&ecirc;n quỹ đạo di chuyển của ch&uacute;ng.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>4. Tr&iacute;ch xuất đặc trưng (Feature Extraction)</strong></p>\r\n\r\n<p>Để ph&acirc;n biệt c&aacute;c đối tượng, hệ thống sử dụng c&aacute;c đặc trưng như m&agrave;u sắc, h&igrave;nh dạng hoặc c&aacute;c đặc trưng phức tạp hơn do mạng nơ-ron s&acirc;u (CNN) tr&iacute;ch xuất.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>5. T&aacute;i định danh (Re-identification - Re-ID)</strong></p>\r\n\r\n<p>Khi c&aacute;c đối tượng biến mất v&agrave; xuất hiện lại (do che khuất hoặc rời khỏi khung h&igrave;nh), hệ thống cần t&aacute;i định danh ch&iacute;nh x&aacute;c để tiếp tục theo d&otilde;i.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>III. C&aacute;c thuật to&aacute;n nổi bật</strong></h2>\r\n\r\n<p><strong>1. DeepSORT</strong></p>\r\n\r\n<p>DeepSORT kết hợp thuật to&aacute;n theo d&otilde;i với mạng học s&acirc;u để cải thiện khả năng ph&acirc;n biệt c&aacute;c đối tượng dựa tr&ecirc;n đặc trưng.</p>\r\n\r\n<p><strong>2. ByteTrack</strong></p>\r\n\r\n<p>Một thuật to&aacute;n hiện đại tập trung v&agrave;o việc li&ecirc;n kết cả những ph&aacute;t hiện c&oacute; độ tin cậy cao v&agrave; thấp, gi&uacute;p theo d&otilde;i ch&iacute;nh x&aacute;c hơn trong c&aacute;c t&igrave;nh huống phức tạp.</p>\r\n\r\n<p><strong>3. FairMOT</strong></p>\r\n\r\n<p>FairMOT t&iacute;ch hợp việc ph&aacute;t hiện v&agrave; t&aacute;i định danh đối tượng trong c&ugrave;ng một m&ocirc; h&igrave;nh, mang lại hiệu quả cao v&agrave; thời gian xử l&yacute; nhanh.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>IV. Ứng dụng thực tiễn</strong></h2>\r\n\r\n<p>????Gi&aacute;m s&aacute;t an ninh: Theo d&otilde;i người v&agrave; phương tiện trong khu vực c&ocirc;ng cộng hoặc tư nh&acirc;n.</p>\r\n\r\n<p>????Xe tự h&agrave;nh: Nhận diện v&agrave; theo d&otilde;i c&aacute;c phương tiện, người đi bộ tr&ecirc;n đường để đưa ra quyết định điều hướng an to&agrave;n.</p>\r\n\r\n<p>????Ph&acirc;n t&iacute;ch thể thao: Theo d&otilde;i c&aacute;c vận động vi&ecirc;n trong trận đấu để ph&acirc;n t&iacute;ch chiến thuật hoặc hiệu suất.</p>\r\n\r\n<p>????Robot v&agrave; tự động h&oacute;a: Gi&uacute;p robot nhận diện v&agrave; tương t&aacute;c với c&aacute;c đối tượng xung quanh.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>V. Th&aacute;ch thức trong MOT</strong></h2>\r\n\r\n<p>????Sự che khuất: C&aacute;c đối tượng bị chặn bởi c&aacute;c vật thể kh&aacute;c hoặc ch&iacute;nh c&aacute;c đối tượng kh&aacute;c.</p>\r\n\r\n<p>????Độ phức tạp trong m&ocirc;i trường đ&ocirc;ng đ&uacute;c: Khi c&oacute; nhiều đối tượng trong một kh&ocirc;ng gian nhỏ, việc theo d&otilde;i ch&iacute;nh x&aacute;c trở n&ecirc;n kh&oacute; khăn.</p>\r\n\r\n<p>????Thay đổi ngoại h&igrave;nh: &Aacute;nh s&aacute;ng, g&oacute;c quay hoặc trạng th&aacute;i của đối tượng thay đổi c&oacute; thể g&acirc;y nhiễu</p>\r\n\r\n<p>????Tốc độ di chuyển nhanh: Đối tượng di chuyển nhanh c&oacute; thể tạo ra hiện tượng nh&ograve;e ảnh, g&acirc;y kh&oacute; khăn cho hệ thống.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>VI. Kết Luận</strong></h2>\r\n\r\n<p>MOT l&agrave; một lĩnh vực đang ph&aacute;t triển mạnh mẽ v&agrave; c&oacute; tiềm năng ứng dụng lớn trong nhiều ng&agrave;nh c&ocirc;ng nghiệp. Với sự tiến bộ của c&ocirc;ng nghệ học s&acirc;u v&agrave; khả năng t&iacute;nh to&aacute;n, c&aacute;c thuật to&aacute;n MOT ng&agrave;y c&agrave;ng đạt được độ ch&iacute;nh x&aacute;c cao hơn, đ&aacute;p ứng tốt hơn c&aacute;c y&ecirc;u cầu thực tiễn.</p>\r\n\r\n<p>Nếu bạn quan t&acirc;m đến việc triển khai MOT, c&aacute;c c&ocirc;ng cụ như OpenCV hoặc c&aacute;c thư viện học s&acirc;u như PyTorch, TensorFlow l&agrave; những lựa chọn tuyệt vời để bắt đầu.</p>\r\n\r\n<p>Hiện tại khi mua m&aacute;y bộ ROSA AI sẽ được sở hữu miễn ph&iacute; kh&oacute;a YOLO , l&agrave; một bước khởi đầu rất tốt cho việc t&igrave;m hiểu Multiple Object Tracking (MOT) .</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>#ROSA</p>\r\n\r\n<p>#ROSAAI</p>\r\n\r\n<p>#MAYBOROSA</p>\r\n', '<p>Theo d&otilde;i đa đối tượng (Multiple Object Tracking - MOT) l&agrave; một lĩnh vực quan trọng trong tr&iacute; tuệ nh&acirc;n tạo v&agrave; thị gi&aacute;c m&aacute;y t&iacute;nh, nơi hệ thống cần x&aacute;c định v&agrave; theo d&otilde;i vị tr&iacute; của nhiều đối tượng c&ugrave;ng l&uacute;c trong một video hoặc chuỗi h&igrave;nh ảnh. C&ocirc;ng nghệ n&agrave;y ng&agrave;y c&agrave;ng trở n&ecirc;n phổ biến v&agrave; cần thiết trong c&aacute;c ứng dụng thực tiễn như gi&aacute;m s&aacute;t an ninh, xe tự h&agrave;nh, ph&acirc;n t&iacute;ch thể thao, v&agrave; robot.</p>\r\n', '1739497303_Multiple Object Tracking (MOT).jpg', NULL, '2024-12-30', 1);
INSERT INTO `article` (`article_id`, `article_link`, `article_tag`, `article_author`, `article_title`, `article_summary`, `article_content`, `article_image`, `article_video`, `article_date`, `article_status`) VALUES
(84, 'thu-thuat-giai-dap-kiem-tra-toc-do-mang', 'maytinhvanphong,pcvanphong, maytinhcongty,chonpcvanphong,maytinhdoanhnghiep, rosaoffice,maytinhvanph', 'Admin', 'Tổng hợp 7 cách kiểm tra tốc độ mạng tại nhà nhanh chóng', '<h2 data-index=\"1\" style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 10px; padding: 0px; font-weight: 600; line-height: 1.2; font-size: 2rem; color: var(--titlecolor); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\' id=\"isPasted\"><strong style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-weight: bolder;\'><span style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-size: 22px;\'>Tại sao cần kiểm tra tốc độ mạng tại nh&agrave;?</span></strong></h2><p style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 1rem; padding: 0px; color: rgb(17, 17, 17); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: justify;\'><span style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-size: 18px;\'>Trước khi đi v&agrave;o chi tiết c&aacute;c phương ph&aacute;p kiểm tra, h&atilde;y c&ugrave;ng điểm qua những l&yacute; do tại sao việc n&agrave;y lại quan trọng:</span></p><ul style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px 0px 0px 20px; list-style: initial; color: rgb(17, 17, 17); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'><li style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; text-align: justify;\'><p style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 1rem; padding: 0px;\'><span style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-size: 18px;\'><strong style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-weight: bolder;\'>Đảm bảo tốc độ đ&uacute;ng với cam kết của nh&agrave; mạng:&nbsp;</strong>C&aacute;c nh&agrave; cung cấp dịch vụ Internet (ISP) thường quảng c&aacute;o c&aacute;c g&oacute;i cước với tốc độ Download v&agrave; Upload cụ thể. Việc kiểm tra gi&uacute;p bạn x&aacute;c minh xem tốc độ thực tế c&oacute; đ&uacute;ng với những g&igrave; đ&atilde; cam kết hay kh&ocirc;ng.</span></p></li><li style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; text-align: justify;\'><p style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 1rem; padding: 0px;\'><span style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-size: 18px;\'><strong style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-weight: bolder;\'>Ph&aacute;t hiện c&aacute;c vấn đề về kết nối:</strong> Tốc độ mạng chậm bất thường c&oacute; thể l&agrave; dấu hiệu của c&aacute;c vấn đề kỹ thuật như lỗi modem, router, đường truyền hoặc qu&aacute; nhiều thiết bị c&ugrave;ng truy cập mạng.</span></p></li><li style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; text-align: justify;\'><p style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 1rem; padding: 0px;\'><span style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-size: 18px;\'><strong style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-weight: bolder;\'>Tối ưu h&oacute;a trải nghiệm trực tuyến:</strong> Khi biết được tốc độ mạng thực tế, bạn c&oacute; thể điều chỉnh th&oacute;i quen sử dụng Internet, chẳng hạn như hạn chế tải c&aacute;c file lớn c&ugrave;ng l&uacute;c hoặc n&acirc;ng cấp g&oacute;i cước nếu cần thiết để c&oacute; trải nghiệm tốt hơn khi xem phim, chơi&nbsp;<a href=\"https://gearvn.com/blogs/thu-thuat-giai-dap/tong-hop-game-online-pc-duoc-ua-chuong\" style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; color: rgb(66, 139, 202); text-decoration: none; background-color: transparent; outline: none; transition: 0.2s ease-in-out;\'>game trực tuyến</a> hay thực hiện c&aacute;c cuộc gọi video.</span></p></li><li style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; text-align: justify;\'><p style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 1rem; padding: 0px;\'><span style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-size: 18px;\'><strong style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-weight: bolder;\'>Giải quyết c&aacute;c sự cố kỹ thuật:</strong> Khi li&ecirc;n hệ với nh&agrave; mạng để b&aacute;o c&aacute;o sự cố về tốc độ, việc cung cấp kết quả kiểm tra sẽ gi&uacute;p họ chẩn đo&aacute;n v&agrave; giải quyết vấn đề nhanh ch&oacute;ng hơn.</span></p></li><li style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; text-align: justify;\'><p style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 1rem; padding: 0px;\'><span style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-size: 18px;\'><strong style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-weight: bolder;\'>So s&aacute;nh v&agrave; lựa chọn g&oacute;i cước ph&ugrave; hợp:</strong> Nếu bạn đang c&oacute; &yacute; định thay đổi g&oacute;i cước Internet, việc kiểm tra tốc độ hiện tại sẽ gi&uacute;p bạn c&oacute; cơ sở để so s&aacute;nh v&agrave; lựa chọn g&oacute;i mới ph&ugrave; hợp với nhu cầu sử dụng của gia đ&igrave;nh.</span></p></li></ul><p style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px 0px 1rem; padding: 0px; color: rgb(17, 17, 17); font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; text-align: center;\'><img data-fr-image-pasted=\"true\" alt=\"kiểm tra tốc độ mạng\" src=\"data:image/png;base64,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', '<p><span style=\'color: rgb(17, 17, 17); font-family: \"SF Pro Display\", Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\' id=\"isPasted\">Chắc hẳn bạn đ&atilde; kh&ocirc;ng &iacute;t lần cảm thấy kh&oacute; chịu khi mạng &quot;r&ugrave;a b&ograve;&quot;, tải trang m&atilde;i kh&ocirc;ng xong hay video cứ giật lag li&ecirc;n tục. Vậy l&agrave;m thế n&agrave;o để biết ch&iacute;nh x&aacute;c tốc độ mạng nh&agrave; m&igrave;nh đang ở mức n&agrave;o? B&agrave;i viết n&agrave;y, GEARVN sẽ tổng hợp 10&nbsp;</span><strong style=\'box-sizing: border-box; font-family: \"SF Pro Display\", Arial, sans-serif; margin: 0px; padding: 0px; font-weight: bolder; color: rgb(17, 17, 17); font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\'>c&aacute;ch kiểm tra tốc độ mạng</strong><span style=\'color: rgb(17, 17, 17); font-family: \"SF Pro Display\", Arial, sans-serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: justify; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\'>&nbsp;tại nh&agrave; v&ocirc; c&ugrave;ng đơn giản, nhanh ch&oacute;ng v&agrave; hiệu quả, gi&uacute;p bạn dễ d&agrave;ng nắm bắt t&igrave;n</span></p><video controls><source src=\"uploads/videos/6216017917664413242.mp4\" type=\"video/mp4\">Your browser does not support the video tag.</video>', '1743345525_BODY MIST XANH 8.png', NULL, '2025-03-30', 1);
INSERT INTO `article` (`article_id`, `article_link`, `article_tag`, `article_author`, `article_title`, `article_summary`, `article_content`, `article_image`, `article_video`, `article_date`, `article_status`) VALUES
(86, 'Windows-11-Pro-&-Rosa-Office:-Nền-Tảng-Công-Nghệ-Đột-Phá-Cho-Doanh-Nghiệp-Hiện-Đại', 'maytinhvanphong,pcvanphong, maytinhcongty,chonpcvanphong,maytinhdoanhnghiep, rosaoffice,maytinhvanph', 'Admin', 'Windows 11 Pro & Rosa Office: Nền Tảng Công Nghệ Đột Phá Cho Doanh Nghiệp Hiện Đại', '<p>shosdhahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p>', '<p>dbsgsgisagsa</p><video controls><source src=\"uploads/videos/6216017917664413242.mp4\" type=\"video/mp4\">Your browser does not support the video tag.</video>', '1743350308_BODY MIST TÍM 6.png', NULL, '2025-03-30', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baohanh`
--

CREATE TABLE `baohanh` (
  `SOSERI_SP` varchar(50) NOT NULL,
  `SOSERI_PC` varchar(50) DEFAULT NULL,
  `LOAI` varchar(100) NOT NULL,
  `TENSP` varchar(255) NOT NULL,
  `NGAYXUAT` date NOT NULL,
  `THOIHANBH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baohanh`
--

INSERT INTO `baohanh` (`SOSERI_SP`, `SOSERI_PC`, `LOAI`, `TENSP`, `NGAYXUAT`, `THOIHANBH`) VALUES
('', NULL, '', '', '0000-00-00', 0),
('040325-A325208256-01', '040325-A325208256-01', 'PC', 'ROSA OFFICE I A32520-8-256', '2025-04-03', 36),
('040325-A325208256-02', '040325-A325208256-02', 'PC', 'ROSA OFFICE I A32520-8-256', '2025-04-03', 36),
('040325-A325208256-03', '040325-A325208256-03', 'PC', ' ROSA OFFICE I A32520-8-256', '2025-04-03', 36),
('040325-A325208256-04', '040325-A325208256-04', 'PC', 'ROSA OFFICE I A32520-8-256', '2025-04-03', 36),
('040325-A325208256-05', '040325-A325208256-05', 'PC', 'ROSA OFFICE I A32520-8-256', '2025-04-03', 36),
('070325-N12I58256-01', '070325-N12I58256-01', 'PC', ' ROSA MINI NUC12-WSHI5-8-256', '2025-03-07', 36),
('100325-A324508256-01', '100325-A324508256-01', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-03-10', 36),
('100325-A434508256-02', '100325-A434508256-02', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-10', 36),
('100325-A434508256-03', '100325-A434508256-03', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-10', 36),
('100325-A464508256-04', '100325-A464508256-04', 'PC', 'ROSA OFFICE I A46450-8-256', '2025-03-10', 36),
('100325-A464508256-05', '100325-A464508256-05', 'PC', 'ROSA OFFICE I A46450-8-256', '2025-03-10', 36),
('120325-A324508256-01', '120325-A324508256-01', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-12-03', 36),
('140325-I14476016500-01', '140325-I14476016500-01', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-02', '140325-I14476016500-02', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-03', '140325-I14476016500-03', 'PC', ' ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-04', '140325-I14476016500-04', 'PC', ' ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-05', '140325-I14476016500-05', 'PC', ' ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-06', '140325-I14476016500-06', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-07', '140325-I14476016500-07', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-08', '140325-I14476016500-08', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-09', '140325-I14476016500-09', 'PC', '', '2025-03-14', 36),
('140325-I14476016500-10', '140325-I14476016500-10', 'PC', '', '2025-03-14', 36),
('140325-I14476016500-11', '140325-I14476016500-11', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-12', '140325-I14476016500-12', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-13', '140325-I14476016500-13', 'PC', ' ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-14', '140325-I14476016500-14', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-15', '140325-I14476016500-15', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-16', '140325-I14476016500-16', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-17', '140325-I14476016500-17', 'PC', ' ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-18', '140325-I14476016500-18', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-19', '140325-I14476016500-19', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-20', '140325-I14476016500-20', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-21', '140325-I14476016500-21', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-22', '140325-I14476016500-22', 'PC', ' ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-23', '140325-I14476016500-23', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-24', '140325-I14476016500-24', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-25', '140325-I14476016500-25', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-26', '140325-I14476016500-26', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-27', '140325-I14476016500-27', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-28', '140325-I14476016500-28', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-29', '140325-I14476016500-29', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-30', '140325-I14476016500-30', 'PC', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('140325-I14476016500-31', '140325-I14476016500-31', 'PSU', 'ROSA OFFICE I144760-16-500', '2025-03-14', 36),
('150325-RSN12I38256-01', '150325-RSN12I38256-01', 'PC', 'ROSA MINI NUC12-WSHI3-8-256', '2025-03-14', 36),
('180325-A324508256-01', '180325-A324508256-01', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-03-18', 36),
('180325-A434508256-01', '180325-A434508256-01', 'PC', ' ROSA OFFICE I A43450-8-256', '2025-03-18', 36),
('1803252-A324508256-01', '1803252-A324508256-01', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-03-18', 36),
('1803252-A324508256-02', '1803252-A324508256-02', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-03-18', 36),
('1803252-A324508256-04', '1803252-A324508256-04', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-03-18', 36),
('1803252-A434508256-01', '1803252-A434508256-01', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-18', 36),
('1803252-A434508256-02', '1803252-A434508256-02', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-18', 36),
('1803252-A434508256-03', '1803252-A324508256-03', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-18', 36),
('1803252-A464508256-01', '1803252-A464508256-01', 'PC', 'ROSA OFFICE I A46450-8-256', '2025-03-18', 36),
('1803253-A434508256-01', '1803253-A434508256-02', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-18', 36),
('1803253-A434508256-02', '1803253-A434508256-02', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-18', 36),
('2003251-A324508256-01', '2003251-A324508256-01', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-03-20', 36),
('2003251-A434508256-01', '2003251-A434508256-01', 'PC', 'ROSA OFFICE I A43450-8-256', '2025-03-20', 36),
('2003251-A464508256-01', '2003251-A464508256-01', 'PC', 'ROSA OFFICE I A46450-8-256', '2025-03-20', 36),
('2203251-A324508256-01', '2203251-A324508256-01', 'PC', 'ROSA OFFICE I A32450-8-256', '2025-03-22', 36),
('2203251-A324508256-02', '2203251-A324508256-02', 'PC', ' ROSA OFFICE I A32450-8-256', '2025-03-22', 36),
('2203251-A434508256-01', '2203251-A434508256-01', 'PC', ' ROSA OFFICE I A43450-8-256', '2025-03-22', 36),
('2203251-A464508256-01', '2203251-A464508256-01', 'PC', 'ROSA OFFICE I A46450-8-256', '2025-03-22', 36),
('2403251-A434508256-01', '2403251-A434508256-01', 'PC', ' ROSA OFFICE I A43450-8-256', '0000-00-00', 36),
('2438 010537967X003-K000809', '140325-I14476016500-30', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X003-K000810', '140325-I14476016500-15', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X003-K000816', '140325-I14476016500-08', 'RAM', 'RAM Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X003-K000830', '140325-I14476016500-01', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X003-K000841', '140325-I14476016500-03', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X003-K000842', '140325-I14476016500-26', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X003-K000843', '140325-I14476016500-02', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X003-K000908', '140325-I14476016500-17', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000133', '140325-I14476016500-05', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000134', '140325-I14476016500-04', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000135', '140325-I14476016500-22', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000136', '140325-I14476016500-27', 'RAM', 'RAM Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000140', '140325-I14476016500-19', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000141', '140325-I14476016500-11', 'RAM', 'RAM Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000145', '140325-I14476016500-20', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000146', '140325-I14476016500-28', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000148', '140325-I14476016500-23', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000156', '140325-I14476016500-31', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000162', '140325-I14476016500-21', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000169', '140325-I14476016500-24', 'RAM', 'RAM Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000175', '140325-I14476016500-16', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000181', '140325-I14476016500-29', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000188', '140325-I14476016500-06', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000190', '140325-I14476016500-09', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000198', '140325-I14476016500-10', 'RAM', 'RAM Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000204', '140325-I14476016500-13', 'RAM', 'Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000206', '140325-I14476016500-12', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000207', '140325-I14476016500-18', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('2438 010537967X005-K000221', '140325-I14476016500-07', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('260225-A325208240-01', '260225-A325208240-01', 'pc', 'ROSA OFFICE I A32520-8-240', '2025-02-26', 36),
('260225-A325208240-02', '260225-A325208240-02', 'pc', 'ROSA OFFICE I A32520-8-240', '2025-02-26', 36),
('270225-A324508240-01', '270225-A324508240-01', 'PC', ' ROSA OFFICE I A32450-8-240', '2025-02-27', 36),
('270225-A324508240-02', '270225-A324508240-02', 'PC', ' ROSA OFFICE I A32450-8-240', '2025-02-27', 36),
('318107072434', '270225-A324508240-02', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-02-27', 36),
('31810AC52434', '270225-A324508240-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-02-27', 36),
('31810AC62434', '100325-A464508256-05', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31810ACB2434', '100325-A434508256-02', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31810ACC2434', '120325-A324508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31810AD22434', '120325-A324508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31810AD32434', '120325-A324508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31810ADE2434', '120325-A324508256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('3181149E2434', '120325-A324508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-12-03', 36),
('318114AA2434', '260225-A325208240-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4', '2025-02-26', 36),
('3181151E2434', '260225-A325208240-02', 'RAM', ' Lexar 8G/3200 Udimm DDR4', '2025-02-26', 36),
('31811B872434', '100325-A434508256-03', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31811B8B2434', '040325-A325208256-03', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-04-03', 36),
('31811B8D2434', '040325-A325208256-05', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-04-03', 36),
('31811B962434', '040325-A325208256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-04-03', 36),
('31811BAE2434', '120325-A324508256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31811BB02434', '120325-A324508256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31811BB12434', '100325-A464508256-04', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('31811BB22434', '100325-A324508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-10', 36),
('3556071735250', '2403251-A434508256-01', 'CASE', 'ROSA R101 ', '0000-00-00', 36),
('40791F3HPMFSW750EV1401010231', '140325-I14476016500-27', 'PSU', 'PSU Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010232', '140325-I14476016500-28', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010233', '140325-I14476016500-20', 'PSU', 'Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010234', '140325-I14476016500-26', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010235', '140325-I14476016500-29', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010346', '140325-I14476016500-03', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010347', '140325-I14476016500-02', 'PSD', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010348', '140325-I14476016500-06', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010349', '140325-I14476016500-04', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010350', '140325-I14476016500-05', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010351', '140325-I14476016500-22', 'PSU', 'Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010352', '140325-I14476016500-23', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010353', '140325-I14476016500-30', 'SSD', 'Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010355', '140325-I14476016500-31', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010371', '140325-I14476016500-08', 'PSU', 'PSU Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010372', '140325-I14476016500-11', 'PSU', 'PSU Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010373', '140325-I14476016500-10', 'PSU', 'PSU Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010374', '140325-I14476016500-09', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010375', '140325-I14476016500-07', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010381', '140325-I14476016500-16', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010382', '140325-I14476016500-13', 'PSU', 'PSU Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010383', '140325-I14476016500-15', 'PSU', 'Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010385', '140325-I14476016500-12', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010666', '140325-I14476016500-19', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010667', '140325-I14476016500-17', 'PSU', 'Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010668', '140325-I14476016500-24', 'PSU', 'PSU Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010669', '140325-I14476016500-18', 'PSU', 'Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010670', '140325-I14476016500-21', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('40791F3HPMFSW750EV1401010680', '140325-I14476016500-01', 'PSU', ' Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('50026B73835E7930', '260225-A325208240-02', 'SSD', ' Kingston 2.5\" 240G', '2025-02-26', 36),
('50026B73835E837A', '270225-A324508240-02', 'SSD', 'Kingston 2.5” 240G (SA400S37/240G) ', '2025-02-27', 36),
('50026B73835E87A3', '270225-A324508240-01', 'SSD', 'Kingston 2.5” 240G (SA400S37/240G) ', '2025-02-27', 36),
('50026B73835E8F59', '260225-A325208240-01', 'SSD', ' Kingston 2.5\" 240G', '2025-02-26', 36),
('50026B76870FFBA1', '140325-I14476016500-19', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFD6F', '140325-I14476016500-16', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFD87', '140325-I14476016500-27', 'SSD', 'SSD Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFDA6', '140325-I14476016500-31', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFDA7', '140325-I14476016500-28', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFDDA', '140325-I14476016500-18', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFEAD', '140325-I14476016500-15', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFEEE', '140325-I14476016500-21', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76870FFFF0', '140325-I14476016500-30', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871001AA', '140325-I14476016500-05', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871001AD', '140325-I14476016500-10', 'SSD', 'SSD Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871008D5', '140325-I14476016500-17', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871008E4', '140325-I14476016500-04', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871008F0', '140325-I14476016500-01', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B768710092F', '140325-I14476016500-09', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871009BE', '140325-I14476016500-03', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871009CB', '140325-I14476016500-24', 'SSD', 'SSD Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B76871009CE', '140325-I14476016500-29', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687100A89', '140325-I14476016500-02', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687100A8A', '140325-I14476016500-23', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687100A95', '140325-I14476016500-20', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687100AFA', '140325-I14476016500-22', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687100AFB', '140325-I14476016500-26', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687100B55', '140325-I14476016500-06', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687101588', '140325-I14476016500-12', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687101703', '140325-I14476016500-08', 'SSD', 'SSD Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687101C0C', '140325-I14476016500-13', 'SSD', 'Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687101F99', '140325-I14476016500-07', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('50026B7687101FD1', '140325-I14476016500-11', 'SSD', 'SSD Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('9ACS695O40028', '100325-A464508256-04', 'PSU', ' AMD Ryzen 5 PRO 4650G', '2025-03-10', 36),
('9ACS695O40030', '100325-A464508256-05', 'CPU', 'AMD Ryzen 5 PRO 4650G', '2025-03-10', 36),
('9ACS991O40366', '100325-A434508256-02', 'CPU', 'AMD Ryzen 3 PRO 4350G', '2025-03-10', 36),
('9ACS991O40373', '180325-A324508256-01', 'CPU', ' AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('9ACT010O40015', '1803252-A434508256-03', 'CPU', 'CPU AMD Ryzen 5 PRO 4650G', '2025-03-18', 36),
('9ACT010O40466', '2003251-A464508256-01', 'CPU', 'CPU AMD Ryzen 5 PRO 4650G', '2025-03-20', 36),
('9ACT010O40468_100-000000143', '2203251-A464508256-01', 'CPU', 'AMD Ryzen 5 PRO 4650G', '2025-03-22', 36),
('9ACT010O40469', '1803252-A464508256-01', 'CPU', ' AMD Ryzen 5 PRO 4650G', '2025-03-18', 36),
('9ACT010O40470', '1803252-A434508256-02', 'CPU', 'AMD Ryzen 5 PRO 4650G', '2025-03-18', 36),
('9ADH124Q40443_YD3200C5M4MFH', '260225-A325208240-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-02-26', 36),
('9ADH124Q40447', '270225-A324508240-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-02-27', 36),
('9ADH124Q40460_YD3200C5M4MFH', '260225-A325208240-02', 'CPU', 'AMD Ryzen 3 3200G', '2025-02-26', 36),
('9ADH124Q40461', '040325-A325208256-05', 'PSU', ' AMD Ryzen 3 3200G', '2025-04-03', 36),
('9ADH124Q40465', '120325-A324508256-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-12-03', 36),
('9ADH124Q40466', '040325-A325208256-03', 'CPU', 'AMD Ryzen 3 3200G', '2025-04-03', 36),
('9ADH124Q40467', '040325-A325208256-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-04-03', 36),
('9ADH124Q40468', '120325-A324508256-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-03-10', 36),
('9ADH124Q40469', '100325-A324508256-01', 'CPU', 'CPU AMD Ryzen 3 3200G', '2025-03-10', 36),
('9ADH124Q40470', '270225-A324508240-02', 'CPU', 'AMD Ryzen 3 3200G', '2025-02-27', 36),
('9ADH125Q40831', '120325-A324508256-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-03-10', 36),
('9ADH125Q40837', '1803252-A324508256-02', 'CPU', 'AMD Ryzen 3 3200G', '2025-03-18', 36),
('9ADH125Q40838', '2003251-A324508256-02', 'CPU', ' AMD Ryzen 3 3200G', '2025-03-20', 36),
('9ADH125Q40839', '1803252-A324508256-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-03-18', 36),
('9ADH125Q40840', '2203251-A324508256-01', 'CPU', ' AMD Ryzen 3 3200G', '2025-03-22', 36),
('9ADH125Q40841', '1803252-A324508256-04', 'CPU', ' AMD Ryzen 3 3200G', '2025-03-18', 36),
('9ADH125Q40842', '2203251-A324508256-02', 'CPU', 'CPU AMD Ryzen 3 3200G', '2025-03-22', 36),
('9ADH125Q40851', '120325-A324508256-01', 'CPU', ' AMD Ryzen 3 3200G', '2025-03-10', 36),
('9ADH125Q40853', '120325-A324508256-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-03-10', 36),
('9ADH125Q40854', '1803252-A324508256-03', 'CPU', 'AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('9ADH863Q40246', '120325-A324508256-01', 'CPU', 'AMD Ryzen 3 3200G', '2025-03-10', 36),
('9LQ7260Q40001', '120325-A324508256-01', 'CPU', ' AMD Ryzen 3 3200G', '2025-03-10', 36),
('9LS1902W20296', '100325-A434508256-03', 'CPU', 'AMD Ryzen 3 PRO 4350G', '2025-03-10', 36),
('9LS1902W20424_100-000000148', '1803252-A434508256-02', 'CPU', ' AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('9LS1902W20545', '2403251-A434508256-01', 'CPU', 'AMD Ryzen 3 PRO 4350G', '0000-00-00', 36),
('9LS1902W20547', '1803252-A434508256-01', 'CPU', ' AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('9LS1902W20548', '2203251-A434508256-01', 'CPU', ' AMD Ryzen 3 PRO 4350G', '2025-03-22', 36),
('9LS1902W20549_100-000000148', '9LS1902W20549_100-000000148', 'CPU', ' AMD Ryzen 3 PRO 4350G', '2025-03-20', 36),
('9LS1902W20550', '1803252-A434508256-03', 'CPU', ' AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('9LS1902W20553', '1803253-A434508256-02', 'CPU', ' AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('9LS1902W20554', '1803253-A434508256-02', 'CPU', 'AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('ATX650240600011', '120325-A324508256-01', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600012', '120325-A324508256-01', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600013', 'ATX650240600013', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-20', 36),
('ATX650240600014', '2003251-A464508256-01', 'PSU', 'PSU ROSA ATX650 (450W) ', '2025-03-20', 36),
('ATX650240600015', '1803252-A434508256-01', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600018', '2003251-A324508256-07', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-20', 36),
('ATX650240600019', '1803252-A434508256-02', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600020', '180325-A324508256-01', 'PSU ', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600051', '260225-A325208240-02', 'PSU', ' ROSA ATX650 (450W)', '2025-02-26', 36),
('ATX650240600058', '260225-A325208240-01', 'PSU', ' ROSA ATX650 (450W)', '2025-02-26', 36),
('ATX650240600101', '1803252-A324508256-01', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600102', '1803252-A464508256-01', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600103', '1803252-A324508256-03', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('ATX650240600104', '1803252-A324508256-04', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600105', '1803253-A434508256-02', 'PSU', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('ATX650240600106', '1803252-A434508256-02', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600107', '1803252-A434508256-03', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600108', '1803253-A434508256-02', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600109', '1803252-A324508256-02', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600110', '1803252-A434508256-03', 'PSU', 'PSU ROSA ATX650 (450W) ', '2025-03-18', 36),
('ATX650240600321', '120325-A324508256-01', 'CASE', ' ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600322', '120325-A324508256-01', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600324', '120325-A324508256-01', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600325', '120325-A324508256-01', 'PSU', 'ROSA ATX650 (450W) ', '2025-12-03', 36),
('ATX650240600327', '120325-A324508256-01', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600329', '100325-A434508256-02', 'PSU', ' ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600330', '100325-A324508256-01', 'PSU', 'PSU ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600331', '2203251-A464508256-01', 'PCU', ' ROSA ATX650 (450W) ', '2025-03-22', 36),
('ATX650240600334', '2403251-A434508256-01', 'PSU', 'ROSA ATX650 (450W) ', '0000-00-00', 36),
('ATX650240600337', '2203251-A434508256-01', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-22', 36),
('ATX650240600338', '2203251-A324508256-02', 'PSU', 'PSU ROSA ATX650 (450W) ', '2025-03-22', 36),
('ATX650240600339', '2203251-A324508256-01', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-22', 36),
('ATX650240600431', '100325-A464508256-05', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600433', '100325-A464508256-04', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600434', '270225-A324508240-02', 'PSU', ' ROSA ATX650 (450W) ', '2025-02-27', 36),
('ATX650240600435', '040325-A325208256-01', 'PCU', ' ROSA ATX650 (450W) ', '2025-04-03', 36),
('ATX650240600436', '040325-A325208256-05', 'PCU', ' ROSA ATX650 (450W) ', '2025-04-03', 36),
('ATX650240600437', '040325-A325208256-03', 'PSU', ' ROSA ATX650 (450W) ', '2025-04-03', 36),
('ATX650240600438', '100325-A434508256-03', 'PSU', 'ROSA ATX650 (450W) ', '2025-03-10', 36),
('ATX650240600439', '270225-A324508240-01', 'PCU', 'ROSA ATX650 (450W) ', '2025-02-27', 36),
('CPU Intel Core I5-14400', '140325-I14476016500-25', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('D236E90D2452', '2003251-A464508256-01', 'RAM', 'RAM Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-20', 36),
('D236E90E2452', '1803253-A434508256-02', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E9122452', '2203251-A324508256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-22', 36),
('D236E9142452', '1803252-A434508256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E9152452', 'D236E9152452', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-20', 36),
('D236E9162452', '2403251-A434508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST)', '0000-00-00', 36),
('D236E9172452', '1803252-A434508256-03', 'RAM ', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E91A2452', '2203251-A324508256-02', 'RAM', 'RAM Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-22', 36),
('D236E91B2452', '2003251-A324508256-05', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-20', 36),
('D236E91C2452', '1803252-A434508256-02', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E91E2452', '1803252-A324508256-02', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E91F2452', '2203251-A434508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-22', 36),
('D236E9202452', '2203251-A464508256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-22', 36),
('D236E9492452', '180325-A324508256-01', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E94C2452', '1803253-A434508256-02', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E94E2452', '1803252-A324508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E94F2452', '1803252-A324508256-03', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('D236E9522452', '1803252-A324508256-04', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E9582452', '1803252-A464508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E9592452', '1803252-A434508256-03', 'RAM', 'RAM Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D236E95C2452', '1803252-A434508256-02', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('D3544E832403', '150325-RSN12I38256-01', 'SSD', 'Lexar 256G M2 PCIe Gen3 (LNM620X256G-RNNNG)', '2025-03-14', 36),
('D3544E8A2403', '070325-N12I58256-01', 'RAM', 'Lexar 8G/3200 Sodimm DDR4 (LD4AS008G-B3200GSST)', '2025-03-07', 36),
('HBM0XB186411', '100325-A324508256-01', 'MB', 'MB ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186412', '100325-A464508256-05', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186413', '100325-A434508256-03', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186414', '100325-A434508256-02', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186418', '270225-A324508240-02', 'MB', ' Asrock B450M-HDV R4.0', '2025-02-27', 36),
('HBM0XB186419', '270225-A324508240-01', 'MB', ' Asrock B450M-HDV R4.0', '2025-02-27', 36),
('HBM0XB186491', '120325-A324508256-01', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186492', '120325-A324508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186493', '120325-A324508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186494', '120325-A324508256-01', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186495', '120325-A324508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186500', '120325-A324508256-01', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('HBM0XB186503', '120325-A324508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-12-03', 36),
('HBM0XB186505', '100325-A464508256-04', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-10', 36),
('INF', '120325-A324508256-01', 'RAM', 'Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-12-03', 36),
('J2M0XB083961', '1803252-A324508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB083962', '1803252-A434508256-02', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB083964', '180325-A324508256-01', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB083965', '1803252-A464508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB083966', '1803252-A434508256-03', 'MB', 'MB ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB083967', '1803253-A434508256-02', 'MB', 'AMD Ryzen 3 PRO 4350G', '2025-03-18', 36),
('J2M0XB083968', '1803253-A434508256-02', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB083969', '1803252-A434508256-03', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB084071', '1803252-A324508256-02', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB084073', '1803252-A324508256-04', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB084074', '1803252-A434508256-01', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB084075', '1803252-A434508256-02', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-18', 36),
('J2M0XB084076', 'J2M0XB084076', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-20', 36),
('J2M0XB084077', '2003251-A464508256-01', 'MB', 'MB ASROCK B450M-HDV R4.0', '2025-03-20', 36),
('J2M0XB084078', '2003251-A324508256-03', 'MB', 'ASROCK B450M-HDV R4.0', '2025-03-20', 36),
('J2M0XB084080', '2403251-A434508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '0000-00-00', 36),
('J2M0XB084081', '2203251-A434508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-22', 36),
('J2M0XB084082', '2203251-A464508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-22', 36),
('J2M0XB084083', '2203251-A324508256-02', 'MB', 'MB ASROCK B450M-HDV R4.0', '2025-03-22', 36),
('J2M0XB084085', '2203251-A324508256-01', 'MB', ' ASROCK B450M-HDV R4.0', '2025-03-22', 36),
('KV10024060068', 'KV10024060068', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060091', 'KV10024060091', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060121', 'KV10024060121', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-20', 12),
('KV10024060122', 'KV10024060122', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-20', 12),
('KV10024060123', 'KV10024060123', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-19', 12),
('KV10024060124', 'KV10024060124', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060125', 'KV10024060125', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060126', 'KV10024060126', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060127', 'KV10024060127', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-20', 12),
('KV10024060128', 'KV10024060128', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-19', 12),
('KV10024060129', 'KV10024060129', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060131', 'KV10024060131', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060132', 'KV10024060132', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060133', 'KV10024060133', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060134', 'KV10024060134', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060135', 'KV10024060135', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-24', 12),
('KV10024060137', 'KV10024060137', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-24', 12),
('KV10024060138', 'KV10024060138', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060139', 'KV10024060139', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060401', 'KV10024060401', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-24', 12),
('KV10024060402', 'KV10024060402', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-24', 12),
('KV10024060403', 'KV10024060403', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-24', 12),
('KV10024060446', 'KV10024060446', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-18', 12),
('KV10024060447', 'KV10024060447', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060451', 'KV10024060451', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060452', 'KV10024060452', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060453', 'KV10024060453', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060454', 'KV10024060454', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060455', 'KV10024060455', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060456', 'KV10024060456', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-10', 12),
('KV10024060457', 'KV10024060457', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060458', 'KV10024060458', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060459', 'KV10024060459', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060460', 'KV10024060460', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-12', 12),
('KV10024060741', 'KV10024060741', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-02-07', 12),
('KV10024060742', 'KV10024060742', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-02-27', 12),
('KV10024060743', 'KV10024060743', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-04', 12),
('KV10024060744', 'KV10024060744', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-04', 12),
('KV10024060745', 'KV10024060745', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-04', 12),
('KV10024060746', 'KV10024060746', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-04', 12),
('KV10024060747', 'KV10024060747', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-10', 12),
('KV10024060748', 'KV10024060748', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-10', 12),
('KV10024060749', 'KV10024060749', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-10', 12),
('KV10024060750', 'KV10024060750', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-10', 12),
('KV10024060755', 'KV10024060755', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-02-26', 12),
('KV10024060756', 'KV10024060756', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-02-26', 12),
('KV10024060757', 'KV10024060757', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-02-27', 12),
('KV10024060760', 'KV10024060760', 'KEYBOARD', 'Bàn phím máy vi tính ROSA IR V100', '2025-03-04', 12),
('MAIN Asus B760M AYW Wifi D4', '140325-I14476016500-25', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('MV10024060566', 'MV10024060566', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-20', 12),
('MV10024060567', 'MV10024060567', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060568', 'MV10024060568', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060569', 'MV10024060569', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060570', 'MV10024060570', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060573', 'MV10024060573', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060574', 'MV10024060574', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060575', 'MV10024060575', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060576', 'MV10024060576', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060577', 'MV10024060577', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060578', 'MV10024060578', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060579', 'MV10024060579', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060580', 'MV10024060580', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-19', 12),
('MV10024060581', 'MV10024060581', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-24', 12),
('MV10024060583', 'MV10024060583', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-24', 12),
('MV10024060584', 'MV10024060584', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-24', 12),
('MV10024060586', 'MV10024060586', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-24', 12),
('MV10024060859', 'MV10024060859', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-04', 12),
('MV10024060863', 'MV10024060863', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-02-07', 12),
('MV10024060864', 'MV10024060864', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-02-26', 12),
('MV10024060867', 'MV10024060867', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-02-26', 12),
('MV10024060871', 'MV10024060871', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-04', 12),
('MV10024060872', 'MV10024060872', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-10', 12),
('MV10024060874', 'MV10024060874', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-04', 12),
('MV10024060875', 'MV10024060875', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-10', 12),
('MV10024060876', 'MV10024060876', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-04', 12),
('MV10024060877', 'MV10024060877', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-02-27', 12),
('MV10024060878', 'MV10024060878', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060879', 'MV10024060879', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-04', 12),
('MV10024060880', 'MV10024060880', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060881', 'MV10024060881', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060882', 'MV10024060882', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-10', 12),
('MV10024060883', 'MV10024060883', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-02-27', 12),
('MV10024060884', 'MV10024060884', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060885', 'MV10024060885', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060886', 'MV10024060886', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060887', 'MV10024060887', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-10', 12),
('MV10024060888', 'MV10024060888', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060889', 'MV10024060889', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-20', 12),
('MV10024060890', 'MV10024060890', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-10', 12),
('MV10024060891', 'MV10024060891', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060894', 'MV10024060894', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-18', 12),
('MV10024060895', 'MV10024060895', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-20', 12),
('MV10024060896', 'MV10024060896', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060897', 'MV10024060897', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060898', 'MV10024060898', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-12', 12),
('MV10024060899', 'MV10024060899', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-24', 12),
('MV10024060900', 'MV10024060900', 'MOUSE', 'Chuột máy vi tính ROSA IR V100', '2025-03-19', 12),
('NM5379R010897P111D', '070325-N12I58256-01', 'SSD', 'Lexar 256G M2 PCIe Gen3 (LNM620X256G-RNNNG)', '2025-03-07', 36),
('PA4403R0215790S30L', '120325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-12-03', 36),
('PA4403R0219710S30L', '100325-A464508256-05', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0219740S30L', '1803252-A434508256-02', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0219750S30L', '100325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0256410S30L', '040325-A325208256-03', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-04-03', 36),
('PA4403R0256420S30L', '2203251-A434508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-22', 36),
('PA4403R0256480S30L', '040325-A325208256-05', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-04-03', 36),
('PA4403R0256570S30L', '2203251-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-22', 36),
('PA4403R0256940S30L', '1803252-A324508256-03', 'RAM', ' Lexar 8G/3200 Udimm DDR4 (LD4AU008G-B3200GSST) ', '2025-03-18', 36),
('PA4403R0256950S30L', '100325-A434508256-02', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0256960S30L', '120325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0257230S30L', '1803252-A324508256-02', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0261810S30L', '040325-A325208256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-04-03', 36),
('PA4403R0261860S30L', '2203251-A324508256-02', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-22', 36),
('PA4403R0261870S30L', '2403251-A434508256-01', 'SSD', ' 256G 2.5\" (LNS100-256RB)', '0000-00-00', 36),
('PA4403R0261910S30L', '120325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0261960S30L', '100325-A464508256-04', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0261990S30L', '120325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0312120S30L', '1803252-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0312130S30L', '1803252-A464508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0312150S30L', '1803252-A434508256-03', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0343610S30L', '1803253-A434508256-02', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0343650S30L', '1803252-A434508256-03', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0343720S30L', '1803253-A434508256-02', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PA4403R0343790S30L', '120325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0345780S30L', '100325-A434508256-03', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0348720S30L', '120325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0348740S30L', '120325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-10', 36),
('PA4403R0487840S30L', '1803252-A324508256-04', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PLM4334103074P1109', '150325-RSN12I38256-01', 'RAM', ' Lexar 8G/3200 Sodimm DDR4 (LD4AS008G-B3200GSST)', '2025-03-14', 36),
('PMH382R0334850S30N', '1803252-A434508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PMH382R0335640S30N', '2003251-A324508256-06', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-20', 36),
('PMH382R0335680S30N', '1803252-A434508256-02', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PMH382R0335770S30N', '2003251-A464508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-20', 36),
('PMH382R0338210S30N', 'PMH382R0338210S30N', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-20', 36),
('PMH382R0338230S30N', '2203251-A464508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-22', 36),
('PMH382R0338500S30N', '180325-A324508256-01', 'SSD', 'Lexar 256G 2.5\" (LNS100-256RB)', '2025-03-18', 36),
('PSU Jetek model SWAT750 E5.0/ Bronze', '140325-I14476016500-25', 'PSU', 'Jetek model SWAT750 E5.0/ Bronze', '2025-03-14', 36),
('RAM Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C1', '140325-I14476016500-25', 'RAM', ' Kingston FURY Beast RGB 16G/3200 DDR4 (KF432C16BB2A/16)', '2025-03-14', 36),
('RRS4NA17PAR11244500487', '140325-I14476016500-01', '', 'HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501182', '140325-I14476016500-08', 'cooling', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501183', '140325-I14476016500-10', 'COOLER', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501184', '140325-I14476016500-03', '', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501185', '140325-I14476016500-04', 'TẢN', 'HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501186', '140325-I14476016500-07', 'TAN', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501187', '140325-I14476016500-09', 'cooling', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501188', '140325-I14476016500-11', 'COOLER', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501189', '140325-I14476016500-06', 'TAN', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501190', '140325-I14476016500-05', 'TẢN', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501191', '140325-I14476016500-02', '', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501612', '140325-I14476016500-26', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501614', '140325-I14476016500-29', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501615', '140325-I14476016500-28', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501616', '140325-I14476016500-27', 'COOLOR', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501617', '140325-I14476016500-30', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501618', '140325-I14476016500-23', 'COOLOR', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36);
INSERT INTO `baohanh` (`SOSERI_SP`, `SOSERI_PC`, `LOAI`, `TENSP`, `NGAYXUAT`, `THOIHANBH`) VALUES
('RRS4NA17PAR11244501619', '140325-I14476016500-24', 'COOLOR', 'TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501620', '140325-I14476016500-22', 'COOLOR', 'HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501621', '140325-I14476016500-31', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501953', '140325-I14476016500-13', 'COOLER', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501955', '140325-I14476016500-21', 'COOLOR', 'HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501956', '140325-I14476016500-17', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501957', '140325-I14476016500-15', 'COOLER', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501958', '140325-I14476016500-12', 'COOLER', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501959', '140325-I14476016500-18', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501960', '140325-I14476016500-19', '', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501961', '140325-I14476016500-20', 'COOLOR', 'HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('RRS4NA17PAR11244501962', '140325-I14476016500-16', 'COOLER', 'HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('S8ARAC00F714EZF', '070325-N12I58256-01', 'NUC', 'ASUS- RNUC12WSHI500000I', '2025-03-07', 36),
('S8ARAC00H691LXW', '150325-RSN12I38256-01', 'NUC', 'ASUS RNUC12WSHI300000I', '2025-03-14', 36),
('SCM0CS06T858DT6', '040325-A325208256-05', 'MB', ' ASUS PRIME A520M-K ', '2025-04-03', 36),
('SCM0CS06T859YMV', '040325-A325208256-03', 'MB', 'ASUS PRIME A520M-K ', '2025-04-03', 36),
('SCM0CS06T918YXZ', '260225-A325208240-02', 'MB', 'ASUS PRIME A520M-K', '2025-02-26', 36),
('SCM0CS06T919WYL', '260225-A325208240-01', 'MB', ' ASUS PRIME A520M-K', '2025-02-26', 36),
('SSD Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '140325-I14476016500-25', 'SSD', ' Kingston 500G Gen 4x4 NVMe PCIe (SNV3S/500G)', '2025-03-14', 36),
('T1M0CS018794WGY', '040325-A325208256-01', 'MB', ' ASUS PRIME A520M-K ', '2025-04-03', 36),
('T2M0KC068463CN4', '140325-I14476016500-13', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068465H4P', '140325-I14476016500-15', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068466K2L', '140325-I14476016500-16', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068467M8X', '140325-I14476016500-17', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068468PDF', '140325-I14476016500-04', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068469RJC', '140325-I14476016500-03', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC0684707JA', '140325-I14476016500-02', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068471CX7', '140325-I14476016500-05', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068472HA3', '140325-I14476016500-06', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068486PVC', '140325-I14476016500-01', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068493D3J', '140325-I14476016500-23', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068494MKF', '140325-I14476016500-24', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068496DF8', '140325-I14476016500-26', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068497NY4', '140325-I14476016500-22', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC06849849Z', '140325-I14476016500-28', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068499EVN', '140325-I14476016500-31', 'CPU', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068500DN3', '140325-I14476016500-30', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC0685013VY', '140325-I14476016500-29', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068502MTV', '140325-I14476016500-27', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068513VMK', '140325-I14476016500-19', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068514JLX', '140325-I14476016500-08', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068515BKG', '140325-I14476016500-21', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC0685164BD', '140325-I14476016500-20', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068517VAB', '140325-I14476016500-18', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068518X99', '140325-I14476016500-10', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068519B87', '140325-I14476016500-09', 'MAIN', 'Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068520P4N', '140325-I14476016500-12', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068521LUK', '140325-I14476016500-11', 'MAIN', 'MAIN Asus B760M AYW Wifi D4', '2025-03-14', 36),
('T2M0KC068522GPX', '140325-I14476016500-07', 'MAIN', ' Asus B760M AYW Wifi D4', '2025-03-14', 36),
('TẢN NHIỆT HYPER 212 SPECTRUM V3 ARGB', '140325-I14476016500-25', 'COOLOR', ' HYPER 212 SPECTRUM V3 ARGB', '2025-03-14', 36),
('U437KG6200020', '140325-I14476016500-21', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U437KG6200248', '140325-I14476016500-01', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U437KG6200598', '140325-I14476016500-27', 'CPU', 'CPU Intel Core I5-14400', '2025-03-14', 36),
('U437KG6200600', '140325-I14476016500-19', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U437KG6200686', '140325-I14476016500-30', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U437KG6200886', '140325-I14476016500-28', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U437KG6200978', '140325-I14476016500-09', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U437KG6201559', '140325-I14476016500-18', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U437KG6201806', '140325-I14476016500-10', 'CPU', 'CPU Intel Core I5-14400', '2025-03-14', 36),
('U437KG6203176', '140325-I14476016500-11', 'CPU', 'CPU Intel Core I5-14400', '2025-03-14', 36),
('U47S45N200128', '140325-I14476016500-20', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U47S45N200853', '140325-I14476016500-02', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U47S45N202256', '140325-I14476016500-04', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U47S45N203459', '140325-I14476016500-06', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2700059', '140325-I14476016500-24', 'CPU', 'CPU Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2700172', '140325-I14476016500-12', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2700623', '140325-I14476016500-23', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2700769', '140325-I14476016500-22', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2702432', '140325-I14476016500-16', 'CPU', 'Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2702465', '140325-I14476016500-13', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2702495', '140325-I14476016500-26', 'CPU', 'CPU Intel Core I5-14400', '2025-03-14', 36),
('U48E3G2702527', '140325-I14476016500-15', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U4BM741601676', '140325-I14476016500-31', 'PC', 'Intel Core I5-14400', '2025-03-14', 36),
('U4BM741602023', '140325-I14476016500-17', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U4BM741602088', '140325-I14476016500-05', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U4BM741602289', '140325-I14476016500-03', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U4BM741603077', '140325-I14476016500-07', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36),
('U4BM741603097', '140325-I14476016500-08', 'CPU', 'CPU Intel Core I5-14400', '2025-03-14', 36),
('U4BM741603427', '140325-I14476016500-29', 'CPU', ' Intel Core I5-14400', '2025-03-14', 36);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order` text NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `shipping_method` varchar(255) NOT NULL,
  `delivery_address` varchar(500) DEFAULT NULL,
  `customer_note` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT NULL,
  `formatted_order_id` text DEFAULT NULL,
  `order_date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `order`, `customer_name`, `customer_phone`, `customer_email`, `shipping_method`, `delivery_address`, `customer_note`, `status`, `formatted_order_id`, `order_date`) VALUES
(81, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA OFFICE â… </b></big><br>CPU: AMD Ryzen 3 Pro 4350G<br>MAIN: ASUS PRIME A520M-K D4<br>RAM: LEXAR 8G 3200MHz DDR4<br>SSD: LEXAR 256G SATA<br>CASE: ROSA CPC-C09 MATX<br>PSU: ROSA ATX650 (450W)<br>Há»‡ Äiá»u HÃ nh: Windows 11 Pro<br>Phá»¥ Kiá»‡n: ROSA V100 PhÃ­m & Chuá»™t<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr><tr><td style=\"text-align: left;width: 50%;\"><big><b>AOC 22â€ (22B30HM23/74)<br>Pháº³ng - FHD - VA - 120Hz - 1ms - 1xDsub - 1x HDMI </b></big></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr><tr><td style=\"text-align: left;width: 50%;\"><big><b>Voucher GOT IT trá»‹ giÃ¡ 400K!</b></big></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 7,490,000Ä‘ x 1<br>= 7,490,000Ä‘</b></big></span></div>', 'hinhbui', '0913920316', 'hinhbui@hotmail.com', 'store', 'CÃ”NG TY TNHH TMDV TIN Há»ŒC LONG BÃŒNH<br>50 Ä. Nguyá»…n CÆ° Trinh, PhÆ°á»ng Pháº¡m NgÅ© LÃ£o, Quáº­n 1, Há»“ ChÃ­ Minh', '', 'Äang xá»­ lÃ½', '28122408505381', '28-12-2024 08:50:53'),
(102, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA GAMING X3D</b></big><br>CPU: AMD Ryzen 7 7800X3D<br>MAIN: ASUS TUF GAMING B650M-E WIFI<br>VGA: ASUS TUF RTX4070TI SUPER O16G<br>RAM: GSKILLS 32G(2x16G) 6400MHz DDR5<br>SSD: LEXAR 2T M.2 NVMe PCIe<br>CASE: MORAX 3FA MATX<br>PSU: ASUS TUF GAMING-850G (850W)<br>Táº£n Nhiá»‡t: Prime LC 360 ARGB<br>Há»‡ Äiá»u HÃ nh: Free DOS<br>Phá»¥ Kiá»‡n: Coolerplus PhÃ­m CÆ¡ HERO G88 & Chuá»™t Gaming G63<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 2</big></b></font></td></tr><tr><td style=\"text-align: left;width: 50%;\"><big><b>AOC 24â€ (24B20JH2/74)<br>Pháº³ng - FHD - IPS - 100Hz - 1xDsub - 1x HDMI</b></big></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 2</big></b></font></td></tr><tr><td style=\"text-align: left;width: 50%;\"><big><b>Voucher GOT IT trá»‹ giÃ¡ 300K!</b></big></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 2</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 57,154,000Ä‘ x 2<br>= 114,308,000Ä‘</b></big></span></div>', 'Äinh Tiáº¿n Thuáº§n', '0975686868', 'ThuanDT7@gmail.com', 'store', 'CÃ”NG TY TNHH TMDV TIN Há»ŒC LONG BÃŒNH<br>50 Ä. Nguyá»…n CÆ° Trinh, PhÆ°á»ng Pháº¡m NgÅ© LÃ£o, Quáº­n 1, Há»“ ChÃ­ Minh', 'Test chÆ¡i khÃ´ng mua', 'HoÃ n táº¥t Ä‘Ã³ng gÃ³i', '210125164214102', '21-01-2025 16:42:14'),
(104, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA AI</b></big><br>CPU: AMD Ryzen 5 PRO 4650G<br>MAIN: ASUS PRIME B550M-A D4<br>VGA: ASUS DUAL RTX4060 O8G V2<br>RAM: LEXAR 16G 3200MHz DDR4<br>SSD: LEXAR 256G SATA<br>CASE: InWin EFS063 MATX<br>PSU: 450W<br>Há»‡ Äiá»u HÃ nh: Windows 11 Pro<br>Phá»¥ Kiá»‡n: ROSA V100 PhÃ­m & Chuá»™t<br>ðŸ”§ CÃ i sáºµn CUDA, Python, VSCode<br>ðŸŽ Táº·ng giÃ¡o trÃ¬nh Python & Demo láº­p trÃ¬nh á»©ng dá»¥ng AI<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr><tr><td style=\"text-align: left;width: 50%;\"><big><b>Voucher GOT IT trá»‹ giÃ¡ 300K!</b></big></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 17,709,000Ä‘ x 1<br>= 17,709,000Ä‘</b></big></span></div>', 'Tuan', '023423424', '', 'store', 'CÃ”NG TY TNHH MTV THáº¾ GIá»šI MÃY TÃNH Báº¢NG<br>233 Ä. LÃ½ ThÆ°á»ng Kiá»‡t, DÄ© An, BÃ¬nh DÆ°Æ¡ng', 'test', 'Äang xá»­ lÃ½', '310125080444104', '31-01-2025 08:04:44'),
(106, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA OFFICE N100</b></big><br>CPU: Intel N100<br>MAIN: ASUS PRIME N100I-D D4<br>RAM: LEXAR 8G 3200MHz DDR4<br>SSD: LEXAR 256G SATA<br>CASE: ROSA R101 MATX<br>PSU: ROSA ATX650 (450W)<br>Há»‡ Äiá»u HÃ nh: Windows 11 Pro<br>Phá»¥ Kiá»‡n: ROSA V100 PhÃ­m & Chuá»™t<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 5.199.000Ä‘ x 1<br>= 5.199.000Ä‘</b></big></span></div>', 'Anh Long', '1234556', 'along@gamil.com', 'store', 'CÃ”NG TY TNHH TIN Há»ŒC ÃNH DÆ¯Æ NG<br>20 Quang Trung, Tháº¯ng Lá»£i, BuÃ´n Ma Thuá»™t, Äáº¯k Láº¯k', '', 'Äang xá»­ lÃ½', '110225143042106', '11-02-2025 14:30:42'),
(107, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA MINI â… </b></big><br>MINIPC: I3-1220P <br>ASUS NUC12 PRO Tall RNUC12WSHI300000I<br>RAM: LEXAR 8G 3200MHz DDR4<br>SSD: LEXAR 256G M.2 NVMe PCIe<br>Há»‡ Äiá»u HÃ nh: Windows 11 Pro<br>Phá»¥ Kiá»‡n: ROSA V100 PhÃ­m & Chuá»™t<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr><tr><td style=\"text-align: left;width: 50%;\"><big><b>Voucher GOT IT trá»‹ giÃ¡ 300K!</b></big></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 10.199.000Ä‘ x 1<br>= 10.199.000Ä‘</b></big></span></div>', 'An', '123456', 'an@gmail.com', 'store', 'CÃ”NG TY TNHH MTV THáº¾ GIá»šI MÃY TÃNH Báº¢NG<br>233 Ä. LÃ½ ThÆ°á»ng Kiá»‡t, DÄ© An, BÃ¬nh DÆ°Æ¡ng', '', 'Äang rÃ¡p mÃ¡y', '110225153341107', '11-02-2025 15:33:41'),
(108, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA OFFICE â… </b></big><br>CPU: AMD Ryzen 3 3200G<br>MAIN: ASUS PRIME A520M-K D4<br>RAM: LEXAR 8G 3200MHz DDR4<br>SSD: KINGSTON 240G SATA<br>CASE: ROSA CPC-C09 MATX<br>PSU: ROSA ATX650 (450W)<br>Há»‡ Äiá»u HÃ nh: Windows 11 Pro<br>Phá»¥ Kiá»‡n: ROSA V100 PhÃ­m & Chuá»™t<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 5.999.000Ä‘ x 1<br>= 5.999.000Ä‘</b></big></span></div>', ' Ninh', '123456', 'ninh@gmail.com', 'store', 'CÃ”NG TY TNHH Tin Há»c TH Nha Trang<br>216-218 Thá»‘ng Nháº¥t, PhÆ°Æ¡ng SÃ i, Nha Trang, KhÃ¡nh HÃ²a', '', 'Äang rÃ¡p mÃ¡y', '110225173234108', '11-02-2025 17:32:34'),
(119, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA OFFICE â… </b></big><br>CPU: AMD Ryzen 3 3200G<br>MAIN: ASUS PRIME A520M-K D4<br>RAM: LEXAR 8G 3200MHz DDR4<br>SSD: KINGSTON 240G SATA<br>CASE: ROSA CPC-C09 MATX<br>PSU: ROSA ATX650 (450W)<br>Há»‡ Äiá»u HÃ nh: Windows 11 Pro<br>Phá»¥ Kiá»‡n: ROSA V100 PhÃ­m & Chuá»™t<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 5.999.000Ä‘ x 1<br>= 5.999.000Ä‘</b></big></span></div>', 'xdrdtd', '23434w354', '', 'home', 'tdrdrtfdt', '', 'Äang xá»­ lÃ½', '190225105146119', '19-02-2025 10:51:46'),
(120, '<table style=\"width: 100%;border-collapse: separate;border-spacing: 0 20px;\"><tr><td style=\"text-align: left;width: 50%;\"><big><b>ROSA OFFICE â… </b></big><br>CPU: AMD Ryzen 3 3200G<br>MAIN: ASUS PRIME A520M-K D4<br>RAM: LEXAR 8G 3200MHz DDR4<br>SSD: KINGSTON 240G SATA<br>CASE: ROSA CPC-C09 MATX<br>PSU: ROSA ATX650 (450W)<br>Há»‡ Äiá»u HÃ nh: Windows 11 Pro<br>Phá»¥ Kiá»‡n: ROSA V100 PhÃ­m & Chuá»™t<br></td><td style=\"text-align: right;width: 50%;\"><font color=\"red\"><b><big>x 1</big></b></font></td></tr></table><div style=\"text-align: right;\"><span style=\"color: red;\"><big><b>Tá»•ng Cá»™ng: 5.999.000Ä‘ x 1<br>= 5.999.000Ä‘</b></big></span></div>', 'rfsdrtfxdtd', '23423423', '', 'store', 'CÃ”NG TY TNHH TIN Há»ŒC VÃ€ CHUYá»‚N GIAO CÃ”NG NGHá»† CIVIP<br>750 Ä. Quang Trung, ChÃ¡nh Lá»™, Quáº£ng NgÃ£i', '', 'Äang xá»­ lÃ½', '190225105219120', '19-02-2025 10:52:19');

--
-- Bẫy `order`
--
DELIMITER $$
CREATE TRIGGER `before_insert_order` BEFORE INSERT ON `order` FOR EACH ROW BEGIN
    DECLARE order_increment INT;
    DECLARE random_string CHAR(6);

    -- Lấy giá trị AUTO_INCREMENT từ bảng 'order'
    SELECT AUTO_INCREMENT
    INTO order_increment
    FROM information_schema.TABLES
    WHERE TABLE_NAME = 'order'
    AND TABLE_SCHEMA = DATABASE();
    -- SET random_string = SUBSTRING(CONCAT(
    --     CHAR(FLOOR(65 + (RAND() * 26))), -- Chữ cái viết hoa ngẫu nhiên
    --     CHAR(FLOOR(97 + (RAND() * 26))), -- Chữ cái viết thường ngẫu nhiên
    --     CHAR(FLOOR(48 + (RAND() * 10))), -- Số ngẫu nhiên
    --     CHAR(FLOOR(65 + (RAND() * 26))),
    --     CHAR(FLOOR(97 + (RAND() * 26))),
    --     CHAR(FLOOR(48 + (RAND() * 10)))
    -- ), 1, 6);
    -- Định dạng 'formatted_order_id' với ngày tháng hiện tại và order_id
    SET NEW.formatted_order_id = CONCAT(
        DATE_FORMAT(NOW(), '%d%m%y%H%i%S'), 
        order_increment
    );
END
$$
DELIMITER ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_link`),
  ADD UNIQUE KEY `article_id` (`article_id`);

--
-- Chỉ mục cho bảng `baohanh`
--
ALTER TABLE `baohanh`
  ADD PRIMARY KEY (`SOSERI_SP`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
