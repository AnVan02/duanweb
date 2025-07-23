-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2025 at 05:28 PM
-- Server version: 10.6.22-MariaDB-cll-lve-log
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nvpbgqcv_rosa_courses`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `account_phone` varchar(20) NOT NULL,
  `account_type` int(11) NOT NULL,
  `account_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_password`, `account_email`, `account_phone`, `account_type`, `account_status`) VALUES
(23, 'Admin', '123456', 'admin@gmail.com', '', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chungchi`
--

CREATE TABLE `chungchi` (
  `student_id` int(11) NOT NULL,
  `ten_hs` varchar(255) NOT NULL,
  `khoa_id` varchar(10000) NOT NULL,
  `thanhtich` text DEFAULT NULL,
  `chungchi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ket_qua`
--

CREATE TABLE `ket_qua` (
  `student_id` int(11) NOT NULL,
  `khoa_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `so_lan_thu` int(11) DEFAULT 1,
  `kq_cao_nhat` int(11) DEFAULT 0,
  `test_cao_nhat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Lưu dạng JSON hoặc format thống nhất',
  `test_gan_nhat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Lưu dạng JSON hoặc format thống nhất'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ket_qua`
--

INSERT INTO `ket_qua` (`student_id`, `khoa_id`, `test_id`, `so_lan_thu`, `kq_cao_nhat`, `test_cao_nhat`, `test_gan_nhat`) VALUES
(1, 19, 5, 12, 5, '115:B;116:C;117:D;118:C;119:B', '115:D;116:C;117:B;118:C;119:B'),
(1, 19, 6, 9, 2, '122:B;123:D;125:D;126:A;127:C', '123:A;124:A;126:C;127:B;128:B'),
(1, 19, 7, 4, 3, '130:D;132:B;133:C;135:D;137:B', '130:D;132:B;133:C;135:D;137:B'),
(1, 19, 8, 3, 3, '139:C;140:C;141:A;142:C;143:D', '139:C;140:C;141:A;142:C;143:D'),
(1, 19, 9, 2, 2, '145:A;149:C;150:D;153:D;154:C', '145:A;149:C;150:D;153:D;154:C'),
(1, 19, 10, 6, 2, '155:B;157:C;158:A;159:D;164:B', '155:B;157:C;158:A;159:D;164:B'),
(5, 19, 5, 1, 0, '115:D;116:D;117:B;118:A;119:D', '115:D;116:D;117:B;118:A;119:D');

-- --------------------------------------------------------

--
-- Table structure for table `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id` int(11) NOT NULL,
  `khoa_hoc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id`, `khoa_hoc`, `mo_ta`) VALUES
(2, 'PHP', '<h1 style=\"color: rgb(13,12,134);\">YOLO11 <span style=\"color: rgb(13,12,134);\"></span></h1>\n\n<h2>Chương trình học:</h2>\n<ul>\n  <li><strong>Chương 1:</strong> Giới thiệu về YOLO và Thị giác máy tính</li>\n  <li><strong>Chương 2:</strong> Hướng dẫn cơ bản YOLO và ứng dụng</li>\n  <li><strong>Chương 3:</strong> Chuẩn bị dữ liệu cho mô hình YOLO</li>\n  <li><strong>Chương 4:</strong> Huấn luyện mô hình YOLO với dữ liệu tùy chỉnh</li>\n  <li><strong>Chương 5:</strong> Đánh giá và cải thiện hiệu suất mô hình thông qua các thông số tiêu chuẩn</li>\n  <li><strong>Chương 6:</strong> Xây dựng ứng dụng thực tế với YOLO</li>\n</ul>\n\n<p><strong>Hãy thực hành thật kỹ các ví dụ và bài tập trong mỗi chương để nâng cao kỹ năng vận dụng YOLO của bạn!</strong></p>'),
(10, 'Python cơ bản', '<h1 style=\"color: rgb(13,12,134);\">PYTHON <span style=\"color: rgb(13,12,134);\"></span></h1>\n\n<h2>Chương trình học:</h2>\n<ul>\n  <li><strong>Chương 1:</strong> Giới thiệu chung về PYTHON </li>\n  <li><strong>Chương 2:</strong> Cấu trúc điều kiện, vòng lặp và hàm trong PYTHON</li>\n  <li><strong>Chương 3:</strong> Cấu trúc dữ liệu trong PYTHON </li>\n  <li><strong>Chương 4:</strong> MODULE VÀ PACKAGE</li>\n  <li><strong>Chương 5:</strong> PANDAS</li>\n  <li><strong>Chương 6:</strong> MATPLOTLIB</li>\n</ul>\n\n<p><strong>Hãy thực hành thật kỹ các ví dụ và bài tập trong mỗi chương để nâng cao kỹ năng vận dụng PYTHON của bạn!</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `kiem_tra`
--

CREATE TABLE `kiem_tra` (
  `Student_ID` int(11) NOT NULL,
  `Khoa_ID` int(11) NOT NULL,
  `Test_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Best_Score` int(11) DEFAULT 0,
  `Max_Score` int(11) DEFAULT 0,
  `Pass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Trial` int(11) DEFAULT 0,
  `Max_trial` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kiem_tra`
--

INSERT INTO `kiem_tra` (`Student_ID`, `Khoa_ID`, `Test_ID`, `Best_Score`, `Max_Score`, `Pass`, `Trial`, `Max_trial`) VALUES
(0, 19, '5', 0, 0, '100', 0, 100),
(2, 3, '16', 0, 0, '80', 0, 20),
(2, 4, '23', 0, 0, '80', 0, 30),
(2, 10, '12', 0, 0, '80', 0, 20),
(3, 3, '16', 0, 0, '80', 0, 20),
(3, 5, '22', 0, 0, '100', 0, 20),
(3, 6, '21', 0, 0, '80', 0, 30),
(5, 19, '5', 0, 0, '100', 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `Student_ID` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Id`, `Student_ID`, `Password`) VALUES
(1, 'A', '1'),
(2, 'B', '2'),
(3, 'C', '3'),
(4, '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `Id_cauhoi` int(11) NOT NULL,
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
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`Id_cauhoi`, `id_baitest`, `id_khoa`, `cauhoi`, `hinhanh`, `cau_a`, `hinhanh_a`, `giaithich_a`, `cau_b`, `hinhanh_b`, `giaithich_b`, `cau_c`, `hinhanh_c`, `giaithich_c`, `cau_d`, `hinhanh_d`, `giaithich_d`, `dap_an`) VALUES
(115, '5', '19', 'Đoạn mã nào dưới đây sẽ in ra màn hình dòng chữ \"Hello, Python!\"', NULL, 'Print(Hello, Python!)', NULL, 'Hàm Print viết hoa sai cú pháp (Python phân biệt chữ hoa/thường)', 'print(\"Hello, Python!\")', NULL, 'print() là hàm tích hợp sẵn trong Python để in dữ liệu ra màn hình. Phải dùng dấu ngoặc kép hoặc đơn để bao quanh chuỗi.', 'echo \"Hello, Python!\"', NULL, 'echo là lệnh dùng trong shell, không phải Python', 'printf(\"Hello, Python!\")', NULL, 'printf là của C/C++, không có trong Python', 'B'),
(116, '5', '19', 'Kết quả của đoạn mã sau là gì?\r\nx = 10\r\ny = \"10\"\r\nprint(x + y)', NULL, '20', NULL, 'Nếu cả hai đều là int thì ra 20, nhưng ở đây y là chuỗi', '\"1010\"', NULL, 'Nếu x cũng là chuỗi (x = \"10\"), mới được \"1010\"', 'Lỗi', NULL, 'Python không cho phép cộng số nguyên (int) với chuỗi (str) trực tiếp. Dòng x + y sẽ gây ra lỗi TypeError vì hai kiểu dữ liệu khác nhau', 'None', NULL, 'Không đúng, vì chương trình sẽ bị lỗi chứ không in ra None', 'C'),
(117, '5', '19', 'Kết quả của đoạn code sau là gì?\r\na = 5\r\nb = 2\r\nprint(b ** a)', NULL, '2.5', NULL, '2.5 là phép chia (5 / 2)', '10', NULL, '10 là phép cộng hoặc nhân không đúng ở đây', '25', NULL, '5 ** 2 = 5 mũ 2 = 25', '32', NULL, '32 là 2 mũ 5, ngược lại với đề', 'D'),
(118, '5', '19', 'Biến nào sau đây là tên biến hợp lệ trong Python ?', NULL, '1variable', NULL, '1variable bắt đầu bằng số', '@data', NULL, '@data chứa ký tự không hợp lệ', 'my_var', NULL, 'my_var là tên biến hợp lệ. Trong Python, tên biến phải bắt đầu bằng chữ cái hoặc dấu gạch dưới (_), và không được trùng với từ khóa.', 'class', NULL, 'class là từ khóa của Python, không thể dùng làm tên biến', 'C'),
(119, '5', '19', 'Kết quả của đoạn code sau là gì?\r\nx = 7\r\ny = 3\r\nprint(x // y)', NULL, '2.333', NULL, 'kết quả của phép chia thông thường (/), không phải //.', '2', NULL, '// là toán tử chia lấy phần nguyên trong Python.\r\n7 // 3 = 2 vì 3 * 2 = 6, còn dư 1 → kết quả là số nguyên 2.', '2.0', NULL, 'số thực, // trả về số nguyên nếu hai toán hạng đều là số nguyên', '3', NULL, 'sai vì 7 chia 3 được 2, dư 1', 'B'),
(120, '6', '19', 'Câu lệnh điều kiện nào sau đây là đúng cú pháp trong Python ?', NULL, 'f x > 0 then print(\"Positive\")', NULL, 'Không dùng then trong Python', 'if x > 0: print(\"Positive\")', NULL, 'Trong Python, cú pháp điều kiện đúng là if điều_kiện: theo sau là dấu hai chấm :, và khối lệnh phải thụt dòng.', 'if (x > 0) { print(\"Positive\") }', NULL, '{} là cú pháp của C/Java, không dùng trong Python', 'if x > 0 print(\"Positive\")', NULL, 'Thiếu dấu : sau điều kiện', 'B'),
(122, '6', '19', 'Kết quả của đoạn code sau là gì ?', 'images/q_6875bba752ff3.png', 'In ra 1 dòng duy nhất là 5', NULL, 'Không bao giờ in 5 vì điều kiện là < 5', 'In ra: 1 2 3 4', NULL, 'while i < 5 lặp khi i còn nhỏ hơn 5 → lần lượt in ra 1, 2, 3, 4. Sau đó i = 5 nên dừng.', 'Vòng lặp vô hạn', NULL, 'Không vô hạn vì có i += 1', 'Không in gì', NULL, 'Có print(i) nên chắc chắn in', 'B'),
(123, '6', '19', 'Mục đích chính của try và except trong Python là gì ?', NULL, 'Để tạo vòng lặp', NULL, 'Vòng lặp dùng for, while, không phải try', 'Để xử lý lỗi ngoại lệ', NULL, 'try và except dùng để bắt lỗi khi thực thi đoạn code có khả năng gây lỗi, giúp chương trình không bị dừng đột ngột.', 'Để kiểm tra biến', NULL, 'Không kiểm tra biến', 'Để định nghĩa hàm', NULL, 'def dùng để định nghĩa hàm, không phải try', 'B'),
(124, '6', '19', 'Kết quả của đoạn mã sau là gì?', 'images/q_6875bce934237.png', 'Hello + Alice', NULL, '\"+\" là toán tử nối chuỗi, không in ra dấu cộng', 'Hello,', NULL, 'Không đúng vì có thêm \"Alice\" nữa', 'Hello, Alice', NULL, 'Hàm greet nhận tham số name, nối với chuỗi \"Hello, \" → khi gọi greet(\"Alice\") sẽ trả về \"Hello, Alice\".', 'Lỗi vì thiếu return', NULL, 'Có return rõ ràng, không thiếu', 'C'),
(125, '6', '19', 'Đoạn code nào sau đây là cú pháp đúng khi xử lý ngoại lệ chia cho 0 ?', NULL, 'try :\r\nx=10 / 0\r\nexcept :\r\nprint (\"Error\")', NULL, 'Câu A dùng try...except đúng cú pháp → khi lỗi chia 0 xảy ra, chương trình không dừng mà in \"Error\".', 'if x ==0;\r\n  raise ZeroDivisionError', NULL, 'raise tự tạo lỗi, không phải xử lý', 'try:\r\n   x= 10 // 0\r\nprint (\"Error\")', NULL, 'Thiếu except → sai cú pháp', 'except ZeroDibisionError :\r\n     print(\"Không chia được\")\r\ntry :\r\nx = 10 / 0', NULL, 'except phải đi sau try, không đứng trước', 'A'),
(126, '6', '19', 'Câu lệnh for nào đúng để in ra các số từ 0 đến 4 ?', NULL, 'for i in 0..4: print(i)', NULL, '0..4 không phải cú pháp hợp lệ', 'for i = 0 to 4: print(i)', NULL, 'Cú pháp này giống Pascal, không phải Python', 'for i in range(5): print(i)', NULL, 'Hàm range(5) tạo dãy từ 0 đến 4. Cú pháp for i in range(5): là cách chuẩn để lặp trong Python.', 'for (i=0; i<5; i++): print(i)', NULL, 'Đây là cú pháp của C, không đúng trong Python', 'C'),
(127, '6', '19', 'Câu nào đúng về elif trong Python?', NULL, 'elif dùng để lặp lại điều kiện nhiều lần', NULL, 'elif không dùng cho vòng lặp', 'elif thay thế cho else trong mọi trường hợp', NULL, 'elif không thay hoàn toàn cho else', 'elif là viết tắt của else if và đứng sau if', NULL, 'elif (else if) dùng để kiểm tra thêm điều kiện nếu if không đúng. Nó nằm giữa if và else', 'elif không được dùng kèm với if', NULL, 'elif phải dùng kèm if, không đứng một mình', 'C'),
(128, '6', '19', 'Kết quả đoạn mã sau là gì ?', 'images/q_6875bf6b9c2a5.png', '5', NULL, 'Tham số b có giá trị mặc định là 2, nên test(3) tương đương với test(3, 2) → trả về 3 + 2 = 5.', '2', NULL, 'b là 2, nhưng a là 3 nên kết quả không thể là 2', '3', NULL, 'Sai vì đã cộng thêm b', 'Lỗi vì thiếu tham số', NULL, 'Không lỗi vì đã có giá trị mặc định cho b', 'A'),
(129, '7', '19', 'Phát biểu nào sau đây là đúng về list trong Python ?', NULL, 'List chỉ chứa các số nguyên', NULL, 'List chứa bất kỳ kiểu dữ liệu, không chỉ số nguyên', 'List là bất biến sau khi tạo', NULL, 'List không bất biến, có thể chỉnh sửa', 'List có thể thay đổi, cho phép phần tử trùng lặp', NULL, 'List là cấu trúc có thể thay đổi (mutable) và cho phép phần tử trùng lặp, có thể chứa bất kỳ kiểu dữ liệu.', 'List không thể chứa chuỗi', NULL, 'List hoàn toàn có thể chứa chuỗi', 'C'),
(130, '7', '19', 'Câu lệnh nào dùng để xóa phần tử ở chỉ số 1 trong list my_list = [10, 20, 30, 40] ?', NULL, 'remove(my_list, 1)', NULL, 'Không phải cú pháp hợp lệ', 'my_list.delete(1)', NULL, 'Không phải cú pháp hợp lệ', 'del my_list[1]', NULL, 'del my_list[1] sẽ xóa phần tử tại vị trí index 1 (tức là 20)', 'my_list.remove(1)', NULL, 'remove() xóa theo giá trị, không theo chỉ số', 'C'),
(131, '7', '19', 'Tuple khác list ở điểm nào?', NULL, 'Tuple không thể chứa chuỗi', NULL, 'sai cú pháp hoặc sai về tính chất.', 'Tuple dùng dấu []', NULL, 'sai cú pháp hoặc sai về tính chất', 'Tuple là bất biến, không thể thay đổi sau khi tạo', NULL, 'Tuple là immutable – không thể chỉnh sửa sau khi tạo', 'Tuple chỉ dùng được trong vòng lặp', NULL, 'sai cú pháp hoặc sai về tính chất', 'C'),
(132, '7', '19', 'Đoạn mã sau in ra gì?', 'images/q_6875c18fef5b6.png', '1', NULL, '', '2', NULL, 'Truy cập tuple theo chỉ số → my_tuple[1] là phần tử thứ hai = 2', '3', NULL, '', 'Lỗi', NULL, '', 'B'),
(133, '7', '19', 'Kết quả đoạn code sau là gì?', 'images/q_6875c22492e6c.png', '{\"a\": 1, \"b\": 2}', NULL, 'Sai vì thiếu khóa \"c\" mới được thêm.', '{\"c\": 3}', NULL, 'Sai vì chỉ có \"c\" → không đúng cấu trúc ban đầu.', '{\"a\": 1, \"b\": 2, \"c\": 3}', NULL, 'Ta thêm một khóa mới \"c\" vào từ điển với giá trị là 3. Từ điển hỗ trợ thêm, sửa các cặp key-value dễ dàng.', 'Lỗi vì không thể thêm phần tử vào dict', NULL, 'Sai vì từ điển hoàn toàn cho phép thêm phần tử qua cú pháp dict[key] = value.', 'C'),
(134, '7', '19', 'Cách nào đúng để duyệt qua toàn bộ khóa (key) trong dictionary data ?', NULL, 'for k in data.values()', NULL, 'data.values() duyệt qua giá trị, không phải khóa', 'for k in data', NULL, 'đúng nhưng chưa đầy đủ bằng D', 'for k in data.keys()', NULL, 'đúng nhưng chưa đầy đủ bằng D', 'Cả B và C đúng', NULL, 'for k in data: và for k in data.keys() đều lặp qua các khóa (keys) của từ điển. Đây là 2 cách tương đương nhau.', 'D'),
(135, '7', '19', 'Điểm nào đúng về set trong Python ?', NULL, 'Cho phép trùng lặp', NULL, 'Sai vì set không cho phép trùng lặp', 'Các phần tử có thứ tự', NULL, 'Sai vì set không đảm bảo thứ tự phần tử', 'Các phần tử là duy nhất và không có thứ tự', NULL, 'Set là tập hợp không có phần tử trùng và không có thứ tự xác định', 'Có thể chứa tuple làm khóa', NULL, 'Câu này lạc chủ đề (liên quan đến dictionary)', 'C'),
(136, '7', '19', 'Đoạn mã nào tạo một set rỗng ?', NULL, 'set = {}', NULL, '{} tạo một dictionary rỗng, không phải set', 'set = ()', NULL, '() là tuple rỗng', 'my_set = set()', NULL, 'Dùng set() là cách chính xác để tạo một set rỗng trong Python', 'my_set = []', NULL, '[] là list rỗng', 'C'),
(137, '7', '19', 'Kết quả của đoạn mã sau là gì?', 'images/q_6875c4ecf3a6a.png', '{1, 4}', NULL, '{1, 4} là các phần tử không chung, sai ý nghĩa phép giao', '{2, 3}', NULL, 'a & b là phép giao (intersection) → trả về các phần tử chung của a và b, tức {2, 3}', '{1, 2, 3, 4}', NULL, 'Là phép hợp, không phải giao.', 'Lỗi cú pháp', NULL, 'Cú pháp hoàn toàn hợp lệ, không lỗi', 'B'),
(138, '8', '19', 'Module trong Python là gì ?', NULL, 'Một tập tin văn bản thông thường', NULL, 'Không đủ – file văn bản không nhất thiết là module', 'Một file Python chứa các hàm và biến có thể tái sử dụng', NULL, 'Module là file .py chứa các hàm, lớp, hoặc biến và có thể được import để sử dụng trong chương trình khác.', 'Một thư mục chứa nhiều file', NULL, 'Thư mục chứa nhiều module được gọi là package, không phải module', 'Một phần mềm cài sẵn trong máy tính', NULL, 'Mơ hồ và không chính xác trong ngữ cảnh lập trình', 'B'),
(139, '8', '19', 'Điều gì xảy ra khi bạn gọi một module không tồn tại?', NULL, 'Tạo module mới tự động', NULL, 'Python không tự tạo module', 'Trình thông dịch bỏ qua dòng đó', NULL, 'Python không bỏ qua lỗi', 'Chương trình báo lỗi ModuleNotFoundError', NULL, 'Nếu bạn import một module không tồn tại, Python sẽ báo lỗi: ModuleNotFoundError.', 'Python dừng chương trình mà không thông báo', NULL, 'Python luôn thông báo lỗi, không dừng lặng lẽ', 'C'),
(140, '8', '19', 'Package là gì trong Python?', NULL, 'Một hàm đặc biệt trong module', NULL, 'Đều mô tả không đúng về package', 'Một tập tin .py đơn lẻ', NULL, 'Đều mô tả không đúng về package', 'Một thư mục chứa nhiều module, thường có file __init__.py', NULL, 'Package là thư mục chứa nhiều module. Truyền thống, package cần có file __init__.py để Python nhận diện đó là package (Python 3.3+ không bắt buộc).', 'Một dạng biến đặc biệt', NULL, 'Đều mô tả không đúng về package', 'C'),
(141, '8', '19', 'Giả sử bạn có cấu trúc thư mục sau:\r\nmy_package/\r\n|── __init__.py\r\n|── module1.py', NULL, 'import my_package.module1.func1', NULL, 'Sai cú pháp – không thể import sâu như vậy', 'from my_package.module1 import func1', NULL, 'Cú pháp chính xác để import trực tiếp một hàm từ module trong package là:\r\nfrom my_package.module1 import func1', 'Sai cú pháp Python', NULL, 'import func1 from my_package.module1', 'Không có module func1 trong my_package', NULL, 'import my_package.func1', 'B'),
(142, '8', '19', 'Tệp __init__.py dùng để làm gì ?', NULL, 'Tạo thư mục bình thường', NULL, 'Không cần file để tạo thư mục', 'Khai báo biến toàn cục', NULL, 'Biến toàn cục không liên quan', 'Đánh dấu thư mục là một package', NULL, 'File __init__.py giúp Python nhận biết một thư mục là package. Trong Python 3.3+, file này không còn bắt buộc nhưng vẫn thường được dùng.', 'Tạo hàm main cho chương trình', NULL, 'Hàm main không nằm trong __init__.py theo mặc định', 'C'),
(143, '8', '19', 'Câu lệnh nào là đúng để import và sử dụng lớp Dog từ module animals.py ?', NULL, 'import animals.Dog', NULL, 'animals.Dog không phải module', 'from animals import Dog', NULL, 'Để import lớp Dog trong module animals, dùng from animals import Dog', 'from animals.Dog import *', NULL, 'Sai vì không có module Dog', 'import Dog from animals', NULL, 'Sai cú pháp', 'B'),
(144, '8', '19', 'Sau khi import module, câu nào đúng để xem các thành phần có trong module đó?', NULL, 'show(module)', NULL, 'Không phải cú pháp chuẩn hoặc không tồn tại', 'inspect(module)', NULL, 'Không phải cú pháp chuẩn hoặc không tồn tại', 'dir(module)', NULL, 'Hàm tích hợp dir() hiển thị danh sách các thuộc tính, hàm, lớp... của một module', 'view module', NULL, 'Không phải cú pháp chuẩn hoặc không tồn tại', 'C'),
(145, '9', '19', 'Để sử dụng thư viện pandas, câu lệnh đúng là', NULL, 'include pandas', NULL, 'Không phải cú pháp hợp lệ của Python', 'load pandas', NULL, 'Không phải cú pháp hợp lệ của Python', 'import pandas as pd', NULL, 'Câu lệnh chuẩn để sử dụng Pandas là import pandas as pd – đặt bí danh pd là thông lệ phổ biến.', 'require pandas', NULL, 'Không phải cú pháp hợp lệ của Python', 'C'),
(146, '9', '19', 'Đoạn mã nào sau đây tạo một Series đúng?', NULL, 'pd.Series([1, 2, 3])', NULL, 'pd.Series([1, 2, 3]) tạo một Series với giá trị từ list.', 'pd.DataFrame([1, 2, 3])', NULL, 'Tạo DataFrame, không phải Series', 'Series([1, 2, 3])', NULL, 'Thiếu pd. → lỗi NameError', 'pd.series([1, 2, 3])', NULL, 'Sai cú pháp vì Series phải viết hoa', 'A'),
(147, '9', '19', 'Đoạn mã nào sau đây tạo một Series đúng ?', NULL, 'pd.DataFrame([\"a\", \"b\"])', NULL, 'Tạo DataFrame từ list, không rõ cột', 'pd.DataFrame({\"name\": [\"Alice\", \"Bob\"], \"age\": [25, 30]})', NULL, 'Cú pháp chính xác để tạo DataFrame từ dictionary là pd.DataFrame({\"cột1\": list1, \"cột2\": list2}).', 'DataFrame({\"name\", \"age\"})', NULL, 'Sai cú pháp – dictionary cần có key: value', 'pd.Dataframe([1, 2, 3])', NULL, 'Dataframe viết sai chữ F → Python phân biệt chữ hoa thường', 'B'),
(148, '9', '19', 'Series khác DataFrame ở điểm nào ?', NULL, 'Series là bảng 2 chiều, DataFrame là 1 chiều', NULL, 'Ngược lại mới đúng', 'Series chứa dữ liệu dạng số, DataFrame thì không', NULL, 'Cả hai đều có thể chứa bất kỳ kiểu dữ liệu', 'Series là 1 chiều, DataFrame là 2 chiều', NULL, 'Series là 1 chiều (giống 1 cột dữ liệu), còn DataFrame là 2 chiều (gồm nhiều cột và dòng).', 'Series có thể chứa nhiều cột', NULL, 'Series chỉ có 1 cột', 'C'),
(149, '9', '19', 'Câu lệnh df.head(3) có tác dụng gì ?', NULL, 'In 3 dòng cuối của DataFrame', NULL, 'Đó là df.tail(3)', 'In 3 cột đầu của DataFrame', NULL, 'Pandas không có hàm in cột đầu tiên theo cách này', 'In 3 dòng đầu tiên của DataFrame', NULL, 'df.head(n) in ra n dòng đầu tiên của DataFrame, thường dùng để xem trước dữ liệu.', 'In tên các cột', NULL, 'Tên cột là df.columns', 'C'),
(150, '9', '19', 'Để lấy cột \"age\" từ DataFrame df, cách nào là đúng ?', NULL, 'df.age', NULL, 'Không có sai ở đây – cả 3 cách đều hợp lệ.', 'df[\"age\"]', NULL, 'Không có sai ở đây – cả 3 cách đều hợp lệ.', 'df.get(\"age\")', NULL, 'Không có sai ở đây – cả 3 cách đều hợp lệ.', 'Tất cả các cách trên đều đúng', NULL, 'Cả 3 cách đều có thể dùng để lấy một cột trong DataFrame:\r\n•	Dấu chấm df.age (nếu tên cột không có khoảng trắng)\r\n•	Dấu ngoặc vuông df[\"age\"]\r\n•	df.get(\"age\")', 'D'),
(151, '9', '19', 'Câu nào sau đây dùng để đọc file CSV ?', NULL, 'pd.read_excel(\"data.csv\")', NULL, 'read_excel dùng cho file .xlsx, không phải .csv', 'pd.read(\"data.csv\")', NULL, 'Không có hàm như vậy trong Pandas', 'pd.read_csv(\"data.csv\")', NULL, 'pd.read_csv() là hàm để đọc file .csv và trả về một DataFrame.', 'read.csv(\"data.csv\")', NULL, 'Không có hàm như vậy trong Pandas', 'C'),
(152, '9', '19', 'Lệnh df[\"age\"] > 25 trả về gì?', NULL, 'Một cột mới tên là age > 25', NULL, 'Không tạo cột mới', 'Một Series các giá trị True/False', NULL, 'df[\"age\"] > 25 trả về một Series boolean – dùng để lọc dòng theo điều kiện.', 'Một DataFrame đã lọc', NULL, 'Muốn lọc DataFrame cần viết df[df[\"age\"] > 25]', 'Một danh sách các dòng', NULL, 'Kết quả không phải list', 'B'),
(153, '9', '19', 'Câu lệnh nào sau đây thêm một cột mới vào DataFrame df ?', NULL, 'df.append(\"new_col\")', NULL, 'append() dùng để thêm dòng, không phải cột', 'df.insert(\"new_col\", [1, 2, 3])', NULL, 'insert() yêu cầu vị trí chỉ số và có cú pháp khác', 'df[\"new_col\"] = [1, 2, 3]', NULL, 'Gán trực tiếp qua df[\"tên_cột\"] = danh_sách là cách đơn giản nhất để thêm cột mới', 'df.add_column(\"new_col\", [1, 2, 3])', NULL, 'add_column() không phải hàm có sẵn trong Pandas', 'C'),
(154, '9', '19', 'Lệnh nào in ra thông tin tổng quan về DataFrame ?', NULL, 'df.describe()', NULL, '', 'df.info()', NULL, '', 'df.summary()', NULL, 'summary() không phải là hàm có sẵn trong Pandas', 'Cả A và B', NULL, '•	df.info() hiển thị thông tin tổng quan về số dòng, cột, kiểu dữ liệu, non-null, v.v.\r\n•	df.describe() hiển thị thống kê mô tả (mean, std, min, max...) cho các cột số.', 'D'),
(155, '10', '19', 'Câu lệnh nào dùng để import thư viện Matplotlib (pyplot) đúng chuẩn ?', NULL, 'import matplotlib.pyplot as plot', NULL, 'Không sai cú pháp, nhưng không theo chuẩn phổ biến', 'import matplotlib as plt', NULL, 'Không import được pyplot', 'from matplotlib import pyplot as plt', NULL, 'Không import được pyplot', 'import matplotlib.pyplot as plt', NULL, 'Cách thông dụng và đúng nhất là import matplotlib.pyplot as plt.', 'D'),
(156, '10', '19', 'Đoạn mã nào tạo ra một biểu đồ đường (line chart) đơn giản ?', NULL, 'plt.draw([1, 2, 3])', NULL, 'Không có các hàm draw, graph, line trong Pyplot', 'plt.plot([1, 2, 3])', NULL, 'Không có các hàm draw, graph, line trong Pyplot', 'plt.graph([1, 2, 3])', NULL, 'plt.plot() là hàm dùng để vẽ biểu đồ đường trong Pyplot', 'plt.line([1, 2, 3])', NULL, 'Không có các hàm draw, graph, line trong Pyplot', 'B'),
(157, '10', '19', 'Lệnh nào dùng để hiển thị biểu đồ đã tạo ?', NULL, 'plt.render()', NULL, 'Không có trong Pyplot', 'plt.output()', NULL, 'Không có trong Pyplot', 'plt.display()', NULL, 'Không có trong Pyplot', 'plt.show()', NULL, 'Không có trong Pyplot', 'D'),
(158, '10', '19', 'Để gắn tiêu đề cho biểu đồ, dùng lệnh nào', NULL, 'plt.title(\"Biểu đồ\")', NULL, 'plt.title() dùng để gắn tiêu đề chính cho biểu đồ.', 'plt.head(\"Biểu đồ\")', NULL, 'Không đúng tên hàm của Pyplot', 'plt.label(\"Biểu đồ\")', NULL, 'Không đúng tên hàm của Pyplot', 'plt.header(\"Biểu đồ\")', NULL, 'Không đúng tên hàm của Pyplot', 'A'),
(159, '10', '19', 'Để thêm nhãn cho trục hoành (x-axis), dùng lệnh nào', NULL, 'plt.labelx(\"Nhãn X\")', NULL, 'Không phải hàm hợp lệ của Pyplot', 'plt.xlabel(\"Nhãn X\")', NULL, 'plt.xlabel() dùng để đặt nhãn cho trục x.', 'plt.axisx(\"Nhãn X\")', NULL, 'Không phải hàm hợp lệ của Pyplot', 'plt.xtitle(\"Nhãn X\")', NULL, 'Không phải hàm hợp lệ của Pyplot', 'B'),
(160, '10', '19', 'Câu lệnh nào dùng để vẽ biểu đồ cột (bar chart)', NULL, 'plt.column()', NULL, 'tên hàm, không tồn tại trong Pyplot', 'plt.column()', NULL, 'plt.bar() dùng để vẽ biểu đồ cột', 'plt.bar_chart()', NULL, 'tên hàm, không tồn tại trong Pyplot', 'plt.bars()', NULL, 'tên hàm, không tồn tại trong Pyplot', 'B'),
(161, '10', '19', 'Lệnh nào để thêm lưới (grid) vào biểu đồ', NULL, 'plt.add_grid()', NULL, 'Không tồn tại', 'plt.grid(True)', NULL, 'plt.grid(True) bật chế độ hiển thị lưới', 'plt.show(grid=True)', NULL, 'plt.show() không có đối số grid', 'plt.grid_on()', NULL, 'Không tồn tại', 'B'),
(162, '10', '19', 'Lệnh plt.savefig(\"bieu_do.png\") dùng để làm gì ?', NULL, 'In biểu đồ ra giấy', NULL, 'Không in ra giấy', 'Hiển thị biểu đồ ra màn hình', NULL, 'Hiển thị là plt.show()', 'Lưu biểu đồ dưới dạng hình ảnh', NULL, 'plt.savefig() dùng để lưu biểu đồ ra file (PNG, JPG, PDF...)', 'Xóa biểu đồ khỏi bộ nhớ', NULL, 'Không có tác dụng xóa', 'C'),
(163, '10', '19', 'Sau khi plt.savefig(\"chart.png\"), biểu đồ có được hiển thị không ?', NULL, 'Có, tự động hiện lên', NULL, 'Không bao giờ được lưu', 'Không, trừ khi gọi plt.show()', NULL, 'plt.savefig() chỉ lưu ảnh, không hiển thị. Muốn xem phải gọi thêm plt.show()', 'Có nếu file đã tồn tại', NULL, 'Không liên quan đến việc hiển thị', 'Không bao giờ được lưu', NULL, 'File vẫn được lưu', 'B'),
(164, '10', '19', 'Muốn hiển thị chú thích (legend) cho từng đường biểu diễn, bạn cần', NULL, 'plt.set_label()', NULL, 'Không tồn tại trong Pyplot hoặc không liên quan đến legend', 'plt.legend() sau khi dùng label=', NULL, 'Cần dùng label=\"Tên\" trong plt.plot(), sau đó gọi plt.legend() để hiển thị chú thích', 'plt.describe()', NULL, 'Không tồn tại trong Pyplot hoặc không liên quan đến legend', 'plt.note()', NULL, 'Không tồn tại trong Pyplot hoặc không liên quan đến legend', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `student_id` text NOT NULL,
  `ten_hs` text NOT NULL,
  `pass` text NOT NULL,
  `khoa_hoc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `IMEI` bigint(20) NOT NULL,
  `MB_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `OS_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Student_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Khoahoc` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`IMEI`, `MB_ID`, `OS_ID`, `Student_ID`, `Password`, `Ten`, `Email`, `Khoahoc`) VALUES
(1, '1', '1', '1', '1', 'AN', 'admin1@gmail.com', '19'),
(2, '230926374300040', '812cd865-1353-4e95-95a9-8b30baf52278', '2', '2', 'Ninh', 'a@gmail.com', '2'),
(3, '/BS97PY3/CNCMC0037S0550/', '034fa681-8a46-438c-9b89-694cf55eaabf', '3', '3', '', '', '19,2'),
(4, '4', '4', 'hoasen_admin', 'hoasen@1234', 'Hoa Sen', 'hoasen_admin@gmail.com', '19'),
(5, '5', '5', '5', '5', '5', 'sdahk@gmail.com', '19');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id_test` int(11) NOT NULL,
  `id_khoa` int(11) NOT NULL,
  `ten_test` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lan_thu` int(11) DEFAULT NULL,
  `pass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_cau_hien_thi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id_test`, `id_khoa`, `ten_test`, `lan_thu`, `pass`, `so_cau_hien_thi`) VALUES
(5, 19, 'Bài kiểm tra chương 1', 100, '100', 5),
(6, 19, 'Bài kiểm tra chương 2', 100, '100', 5),
(7, 19, 'Bài kiểm tra chương 3', 100, '100', 5),
(8, 19, 'Bài kiểm tra chương 4', 100, '100', 5),
(9, 19, 'Bài kiểm tra chương 5', 100, '100', 5),
(10, 19, 'Bài kiểm tra chương 6', 100, '100', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `osid` varchar(100) NOT NULL,
  `mbid` varchar(100) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pending_email` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `email_code` varchar(10) DEFAULT NULL,
  `code_sent_at` datetime DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `recovery_code` varchar(255) DEFAULT NULL,
  `status` enum('active','changed password','changed email') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `verify_fail_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `osid`, `mbid`, `student_id`, `full_name`, `email`, `pending_email`, `email_verified`, `email_code`, `code_sent_at`, `password_hash`, `recovery_code`, `status`, `created_at`, `verify_fail_count`) VALUES
(1, 'OSID1234', 'MBID5678', '1', 'Ninh', 'tranninh903@gmail.com', 'tninh3908@gmail.com', 1, '534147', '2025-07-22 17:27:22', '1', NULL, '', '2025-07-19 09:50:07', 0),
(2, 'AN1234', 'AN5678', '2', 'an', 'tvdell789@gmail.com', NULL, 1, '534946', '2025-07-22 17:10:52', '2', NULL, 'active', '2025-07-22 14:34:13', 10),
(3, 'OSID2345', 'MBID6789', '3', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 'active', '2025-07-22 16:18:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fingerprint` varchar(64) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_devices`
--

INSERT INTO `user_devices` (`id`, `user_id`, `fingerprint`, `user_agent`, `ip_address`, `created_at`) VALUES
(1, 123, '3bb6b5c3d7c56ceb694a01459f28172b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '42.117.43.73', '2025-07-16 22:39:11'),
(2, 123, 'ca1c632e2c95bb279f50aed9e55232ec', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_8_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.6.7 Mobile/15E148 Safari/604.1', '42.117.43.73', '2025-07-16 22:40:36'),
(3, 123, '5d688fa831e8598cdab078931f562893', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', '113.22.149.130', '2025-07-17 12:04:00'),
(4, 123, '0375f6fcbca4017828b6650848932b4b', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_8_4 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Zalo iOS/666 ZaloTheme/light ZaloLanguage/vn', '113.22.149.130', '2025-07-17 13:31:59'),
(5, 123, 'fff3191e9b182a8268f31378c2ee381a', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', '42.119.214.191', '2025-07-22 09:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_devices1`
--

CREATE TABLE `user_devices1` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fingerprint` varchar(255) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `login_count` int(11) DEFAULT 1,
  `last_login` datetime DEFAULT current_timestamp(),
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `ket_qua`
--
ALTER TABLE `ket_qua`
  ADD PRIMARY KEY (`student_id`,`khoa_id`,`test_id`);

--
-- Indexes for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kiem_tra`
--
ALTER TABLE `kiem_tra`
  ADD PRIMARY KEY (`Student_ID`,`Khoa_ID`,`Test_ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`Id_cauhoi`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`IMEI`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_devices1`
--
ALTER TABLE `user_devices1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`fingerprint`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `Id_cauhoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_devices1`
--
ALTER TABLE `user_devices1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_devices1`
--
ALTER TABLE `user_devices1`
  ADD CONSTRAINT `user_devices1_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
