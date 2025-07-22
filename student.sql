-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 22, 2025 lúc 03:34 AM
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
-- Cơ sở dữ liệu: `student`
--

DELIMITER $$
--
-- Thủ tục
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertKetQuaWithIdCauhoi` (IN `p_student_id` INT, IN `p_khoa_id` INT, IN `p_test_id` VARCHAR(255), IN `p_kq_cao_nhat` INT, IN `p_dap_an_list` VARCHAR(1000))   BEGIN
    DECLARE v_id_cauhoi INT;
    DECLARE v_new_tt_bai_test VARCHAR(1000) DEFAULT '';
    DECLARE v_dap_an VARCHAR(255);
    DECLARE v_counter INT DEFAULT 1;
    DECLARE done INT DEFAULT FALSE;
    DECLARE cur_quiz CURSOR FOR 
        SELECT Id_cauhoi 
        FROM quiz 
        WHERE id_baitest = p_test_id 
        ORDER BY Id_cauhoi;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Tách danh sách đáp án
    SET @dap_an_1 = TRIM(SUBSTRING_INDEX(p_dap_an_list, ',', 1));
    SET @dap_an_2 = IF(LOCATE(',', p_dap_an_list) > 0, TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_dap_an_list, ',', 2), ',', -1)), '');
    SET @dap_an_3 = IF(LOCATE(',', SUBSTRING_INDEX(p_dap_an_list, ',', -1)) > 0, TRIM(SUBSTRING_INDEX(p_dap_an_list, ',', -1)), '');

    -- Xây dựng tt_bai_test
    OPEN cur_quiz;
    read_quiz: LOOP
        FETCH cur_quiz INTO v_id_cauhoi;
        IF done THEN
            LEAVE read_quiz;
        END IF;
        IF v_counter = 1 THEN
            SET v_new_tt_bai_test = CONCAT('id', v_id_cauhoi, ': ', @dap_an_1);
        ELSEIF v_counter = 2 AND @dap_an_2 != '' THEN
            SET v_new_tt_bai_test = CONCAT(v_new_tt_bai_test, ', id', v_id_cauhoi, ': ', @dap_an_2);
        ELSEIF v_counter = 3 AND @dap_an_3 != '' THEN
            SET v_new_tt_bai_test = CONCAT(v_new_tt_bai_test, ', id', v_id_cauhoi, ': ', @dap_an_3);
        END IF;
        SET v_counter = v_counter + 1;
    END LOOP;
    CLOSE cur_quiz;

    -- Thêm bản ghi vào ket_qua
    INSERT INTO `ket_qua` (`student_id`, `khoa_id`, `test_id`, `kq_cao_nhat`, `tt_bai_test`)
    VALUES (p_student_id, p_khoa_id, p_test_id, p_kq_cao_nhat, v_new_tt_bai_test);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_password` varchar(100) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `account_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_password`, `account_email`, `account_type`) VALUES
(1, 'Admin', '123456', 'admin@gmail.com', 2),
(2, 'Ad', '$2y$10$6niXOEGeDuvAbW8KC1x9EOUj1JPCtGxUCZGvhs2hDbAwj/6ZJkdce', 'admin2@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chungchi`
--

CREATE TABLE `chungchi` (
  `student_id` int(11) NOT NULL,
  `ten_hs` varchar(255) NOT NULL,
  `khoa_id` varchar(10000) NOT NULL,
  `thanhtich` text DEFAULT NULL,
  `chungchi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chungchi`
--

INSERT INTO `chungchi` (`student_id`, `ten_hs`, `khoa_id`, `thanhtich`, `chungchi`) VALUES
(2, 'abc', '2,10', '0', '0001-01-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ket_qua`
--

CREATE TABLE `ket_qua` (
  `student_id` int(11) NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `test_id` varchar(255) NOT NULL,
  `so_lan_thu` varchar(255) NOT NULL,
  `kq_cao_nhat` int(255) NOT NULL,
  `test_cao_nhat` varchar(1000) NOT NULL,
  `test_gan_nhat` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ket_qua`
--

INSERT INTO `ket_qua` (`student_id`, `khoa_id`, `test_id`, `so_lan_thu`, `kq_cao_nhat`, `test_cao_nhat`, `test_gan_nhat`) VALUES
(2, 2, '22', '1', 5, '7:B;8:B;9:B;10:B;11:B', '7:B;8:B;9:B;10:B;11:B'),
(2, 2, '23', '1', 5, '13:A;14:A;15:A;16:A;17:A', '13:A;14:A;15:A;16:A;17:A'),
(2, 10, '71', '1', 4, '21:C;22:C;23:C;24:C', '21:C;22:C;23:C;24:C');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id` int(11) NOT NULL,
  `khoa_hoc` varchar(255) NOT NULL,
  `mo_ta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id`, `khoa_hoc`, `mo_ta`) VALUES
(2, 'PHP', 'aaaaaa'),
(10, 'Python cơ bản', ''),
(28, 'Yolo', ''),
(29, 'C ++', ''),
(30, 'C', ''),
(31, 'Toán', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kiem_tra`
--

CREATE TABLE `kiem_tra` (
  `Student_ID` int(11) NOT NULL,
  `Khoa_ID` int(11) NOT NULL,
  `Test_ID` varchar(255) NOT NULL,
  `Best_Score` int(11) DEFAULT 0,
  `Max_Score` int(11) DEFAULT 0,
  `Pass` varchar(10) DEFAULT '',
  `Trial` int(11) DEFAULT 0,
  `Max_trial` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `kiem_tra`
--

INSERT INTO `kiem_tra` (`Student_ID`, `Khoa_ID`, `Test_ID`, `Best_Score`, `Max_Score`, `Pass`, `Trial`, `Max_trial`) VALUES
(1, 10, '71', 0, 0, '80', 0, 3),
(3, 1, '1', 0, 0, '100', 0, 100),
(3, 10, '53', 0, 0, '50', 0, 3),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 2, '22', 0, 0, '100', 0, 100),
(1, 10, '71', 0, 0, '100', 0, 100),
(2, 2, '22', 0, 0, '100', 0, 100),
(2, 10, '71', 0, 0, '100', 0, 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `Student_ID` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`Id`, `Student_ID`, `Password`) VALUES
(1, 'A', '1'),
(2, 'B', '2'),
(3, 'C', '3'),
(4, '4', '4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `id` int(11) NOT NULL,
  `ten_mon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mon_hoc`
--

INSERT INTO `mon_hoc` (`id`, `ten_mon`) VALUES
(1, 'Toán'),
(2, 'Văn'),
(3, 'Tiếng Anh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quiz`
--

CREATE TABLE `quiz` (
  `Id_cauhoi` int(250) NOT NULL,
  `id_baitest` varchar(50) NOT NULL COMMENT 'Lưu Giữa kỳ hoặc Cuối kỳ',
  `id_khoa` varchar(100) NOT NULL COMMENT 'Tên môn học, ví dụ: Lập trình',
  `cauhoi` varchar(255) NOT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `cau_a` varchar(255) NOT NULL,
  `hinhanh_a` varchar(255) DEFAULT NULL,
  `giaithich_a` varchar(250) NOT NULL,
  `cau_b` varchar(255) NOT NULL,
  `hinhanh_b` varchar(255) DEFAULT NULL,
  `giaithich_b` varchar(255) NOT NULL,
  `cau_c` varchar(255) NOT NULL,
  `hinhanh_c` varchar(255) DEFAULT NULL,
  `giaithich_c` varchar(255) NOT NULL,
  `cau_d` varchar(255) NOT NULL,
  `hinhanh_d` varchar(255) DEFAULT NULL,
  `giaithich_d` varchar(255) NOT NULL,
  `dap_an` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `quiz`
--

INSERT INTO `quiz` (`Id_cauhoi`, `id_baitest`, `id_khoa`, `cauhoi`, `hinhanh`, `cau_a`, `hinhanh_a`, `giaithich_a`, `cau_b`, `hinhanh_b`, `giaithich_b`, `cau_c`, `hinhanh_c`, `giaithich_c`, `cau_d`, `hinhanh_d`, `giaithich_d`, `dap_an`) VALUES
(7, '22', '2', 'PHP là viết tắt của cụm từ nào?', NULL, 'Personal Home Page', NULL, '', 'Private Home Page', NULL, '', 'PHP: Hypertext Preprocessor', NULL, '', 'Programming HTML Processor', NULL, '', 'B'),
(8, '22', '2', 'Câu lệnh nào để xuất văn bản ra trình duyệt?', NULL, 'echo', NULL, '', 'print()', NULL, '', 'printf', NULL, '', 'write()', NULL, '', 'B'),
(9, '22', '2', 'Biến trong PHP được bắt đầu bằng ký tự nào?', NULL, '$', NULL, '', '#', NULL, '', '&', NULL, '', '@', NULL, '', 'B'),
(10, '22', '2', 'Hàm nào dùng để đếm số phần tử trong một mảng?', NULL, 'count()', NULL, '', 'sizeof()', NULL, '', 'length()', NULL, '', 'elements()', NULL, '', 'B'),
(11, '22', '2', 'Lệnh nào dùng để kiểm tra một biến đã được khai báo hay chưa?', NULL, 'isset()', NULL, '', 'empty()', NULL, '', 'isnull()', NULL, '', 'defined()', NULL, '', 'B'),
(13, '23', '2', '1111', NULL, '1', NULL, 'Giải thích A', '2', NULL, 'Giải thích B', '3', NULL, 'Giải thích C', '4', NULL, 'Giải thích D', 'A'),
(14, '23', '2', '2222', NULL, '1', NULL, 'Giải thích A', '2', NULL, 'Giải thích B', '3', NULL, 'Giải thích C', '4', NULL, 'Giải thích D', 'A'),
(15, '23', '2', '3333', NULL, '1', NULL, 'Giải thích A', '2', NULL, 'Giải thích B', '3', NULL, 'Giải thích C', '4', NULL, 'Giải thích D', 'A'),
(16, '23', '2', '4444', NULL, '1', NULL, 'Giải thích A', '2', NULL, 'Giải thích B', '3', NULL, 'Giải thích C', '4', NULL, 'Giải thích D', 'A'),
(17, '23', '2', '5555', NULL, '1', NULL, 'Giải thích A', '2', NULL, 'Giải thích B', '3', NULL, 'Giải thích C', '4', NULL, 'Giải thích D', 'A'),
(20, '71', '1', 'Đoạn mã nào dưới đây sẽ in ra màn hình dòng chữ Hello, Python!?', NULL, 'Print(Hello, Python!)', NULL, '', 'print(\"Hello, Python!\")', NULL, '', 'echo \"Hello, Python!\"', NULL, '', 'printf(\"Hello, Python!\")', NULL, '', 'C'),
(21, '71', '10', 'Kết quả của đoạn mã sau là gì?\r\nx = 10\r\ny = \"10\"\r\nprint(x + y)', NULL, '20', NULL, 'Nếu cả hai đều là int thì ra 20, nhưng ở đây y là chuỗi.', '\"1010\"', NULL, 'Nếu x cũng là chuỗi (x = \"10\"), mới được \"1010\"', 'Lỗi', NULL, 'Python không cho phép cộng số nguyên (int) với chuỗi (str) trực tiếp. Dòng x + y sẽ gây ra lỗi TypeError vì hai kiểu dữ liệu khác nhau.', 'None', NULL, 'Không đúng, vì chương trình sẽ bị lỗi chứ không in ra None.', 'C'),
(22, '71', '10', 'Kết quả của đoạn code sau là gì?\r\na = 5\r\nb = 2\r\nprint(a ** b)', NULL, '2.5', NULL, '2.5 là phép chia (5 / 2)', '10', NULL, '10 là phép cộng hoặc nhân không đúng ở đây', '25', NULL, 'Toán tử ** trong Python là lũy thừa. a ** b nghĩa là 5 mũ 2 → 5² = 25.', '32', NULL, '32 là 2 mũ 5, ngược lại với đề', 'C'),
(23, '71', '10', 'Biến nào sau đây là tên biến hợp lệ trong Python?', NULL, '1variable', NULL, '1variable bắt đầu bằng số', '@data', NULL, '@data chứa ký tự không hợp lệ.', 'my_var', NULL, 'my_var là tên biến hợp lệ. Trong Python, tên biến phải bắt đầu bằng chữ cái hoặc dấu gạch dưới (_), và không được trùng với từ khóa.', 'class', NULL, 'class là từ khóa của Python, không thể dùng làm tên biến.', 'C'),
(24, '71', '10', 'Kết quả của đoạn code sau là gì?\r\nx = 7\r\ny = 3\r\nprint(x // y)', NULL, '2.333', NULL, '', '2', NULL, '', '2.0', NULL, '', '3', NULL, '', 'C');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `student_id` text NOT NULL,
  `ten_hs` text NOT NULL,
  `pass` text NOT NULL,
  `khoa_hoc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

CREATE TABLE `students` (
  `IMEI` bigint(20) NOT NULL,
  `MB_ID` int(11) NOT NULL,
  `OS_ID` int(11) NOT NULL,
  `Student_ID` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Ten` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Khoahoc` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`IMEI`, `MB_ID`, `OS_ID`, `Student_ID`, `Password`, `Ten`, `Email`, `Khoahoc`) VALUES
(2, 2, 2, '2', '2', 'abc3', 'aa3@gmail.com', '2,10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `id_khoa` int(11) NOT NULL,
  `ten_test` varchar(255) NOT NULL,
  `lan_thu` int(11) DEFAULT 1,
  `Pass` varchar(255) NOT NULL,
  `so_cau_hien_thi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `test`
--

INSERT INTO `test` (`id_test`, `id_khoa`, `ten_test`, `lan_thu`, `Pass`, `so_cau_hien_thi`) VALUES
(22, 2, 'Test PHP', 100, '100', 5),
(23, 2, 'PHP', 100, '100', 5),
(71, 10, 'Bài kiểm tra chương 1', 100, '100', 4),
(72, 31, 'Giữa kỳ', 1, '80', 5);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Chỉ mục cho bảng `chungchi`
--
ALTER TABLE `chungchi`
  ADD PRIMARY KEY (`student_id`);

--
-- Chỉ mục cho bảng `ket_qua`
--
ALTER TABLE `ket_qua`
  ADD PRIMARY KEY (`student_id`,`khoa_id`,`test_id`);

--
-- Chỉ mục cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`Id_cauhoi`);

--
-- Chỉ mục cho bảng `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`IMEI`);

--
-- Chỉ mục cho bảng `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `quiz`
--
ALTER TABLE `quiz`
  MODIFY `Id_cauhoi` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
