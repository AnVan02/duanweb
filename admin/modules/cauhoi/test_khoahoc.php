<?php
// File test đơn giản để kiểm tra routing
echo "<h1>Test Khoahoc Page</h1>";
echo "<p>File này được load thành công!</p>";
echo "<p>Tham số id_khoa: " . (isset($_GET['id_khoa']) ? $_GET['id_khoa'] : 'Không có') . "</p>";
echo "<p>Tham số action: " . (isset($_GET['action']) ? $_GET['action'] : 'Không có') . "</p>";
echo "<p>PHP_SELF: " . $_SERVER['PHP_SELF'] . "</p>";
echo "<p>REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "</p>";
?> 