<tr>
    <!-- Cột 1: Dấu tích hoặc phần trăm -->
    <td style="text-align: center;">
        <?php if ($course['hoan_thanh']): ?>
            <img src="icon.png" alt="Hoàn thành" class="checkmark" style="width: 24px; height: 24px;">
        <?php else: ?>
            <span class="percent"><?= $course['phan_tram'] ?>%</span>
        <?php endif; ?>
    </td>

    <!-- Cột 2: Tên khoá học + mô tả -->
    <td>
        <div style="display: flex; align-items: center; gap: 10px;">
            <div>
                <strong><?= htmlspecialchars($course['ten_khoa']) ?></strong>
                <small><?= strip_tags($course['mo_ta']) ?></small>
            </div>
        </div>
    </td>

    <!-- Cột 3: Danh sách chương -->
    <td>
        <div class="chapter-list">
            <?php if (!empty($course['chi_tiet_chuong'])): ?>
                <?php 
                $chapters_available = array_keys($course['chi_tiet_chuong']);
                sort($chapters_available);
                foreach ($chapters_available as $chapter_num): 
                    $chuong = $course['chi_tiet_chuong'][$chapter_num];
                    $ten_hien_thi = htmlspecialchars($chuong['ten_test']);
                ?>
                    <p>
                        <span>
                            <?= $chuong['trang_thai'] == 1
                                ? "<strong style='color: #28a745;'>$ten_hien_thi</strong>"
                                : $ten_hien_thi ?>
                        </span>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có bài kiểm tra nào</p>
            <?php endif; ?>
        </div>
    </td>

    <!-- Cột 4 & 5: Desktop view -->
    <td class="desktop-only">
        <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
    </td>
    <td class="desktop-only">
        <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
    </td>

    <!-- Cột gộp 4 & 5: Mobile view -->
    <td class="mobile-only" colspan="2">
        <div class="mobile-row-bottom">
            <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
            <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
        </div>
    </td>
</tr>
<tr>
    <!-- Cột 1: ✅ nếu hoàn thành, % nếu chưa -->
    <td style="text-align: center;">
        <?php if ($course['hoan_thanh']): ?>
            <span style="font-size: 20px; color: green;">✅</span>
        <?php else: ?>
            <span style="font-weight: bold;"><?= $course['phan_tram'] ?>%</span>
        <?php endif; ?>
    </td>

    <!-- Cột 2: Tên khoá học + mô tả -->
    <td>
        <strong><?= htmlspecialchars($course['ten_khoa']) ?></strong>
        <br>
        <small><?= strip_tags($course['mo_ta']) ?></small>
    </td>

    <!-- Cột 3: Danh sách chương -->
    <td>
        <div class="chapter-list">
            <?php if (!empty($course['chi_tiet_chuong'])): ?>
                <?php 
                $chapters_available = array_keys($course['chi_tiet_chuong']);
                sort($chapters_available);
                ?>
                <?php foreach ($chapters_available as $chapter_num): ?>
                    <?php $chuong = $course['chi_tiet_chuong'][$chapter_num]; ?>
                    <p>
                        <span>
                            <?php $ten_hien_thi = htmlspecialchars($chuong['ten_test']); ?>
                            <?php if ($chuong['trang_thai'] == 1): ?>
                                <strong style="color: #28a745;"><?= $ten_hien_thi ?></strong>
                            <?php else: ?>
                                <?= $ten_hien_thi ?>
                            <?php endif; ?>
                        </span>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có bài kiểm tra nào</p>
            <?php endif; ?>
        </div>
    </td>

    <!-- Máy tính: trạng thái và nút -->
    <td class="desktop-only">
        <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
    </td>
    <td class="desktop-only">
        <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
    </td>

    <!-- Điện thoại: Gộp trạng thái + nút -->
    <td colspan="2" class="mobile-only">
        <div class="mobile-row-bottom" style="display: flex; justify-content: space-between; align-items: center;">
            <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
            <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
        </div>
    </td>
</tr>

<!--  -->

<tr>
    <!-- Cột 1: ✅ nếu hoàn thành, % nếu chưa -->
    <td style="text-align: center;">
        <?php if ($course['hoan_thanh']): ?>
            <span style="font-size: 20px; color: green;">✅</span>
        <?php else: ?>
            <span style="font-weight: bold;"><?= $course['phan_tram'] ?>%</span>
        <?php endif; ?>
    </td>

    <!-- Cột 2: Tên khoá học + mô tả -->
    <td>
        <strong><?= htmlspecialchars($course['ten_khoa']) ?></strong>
        <br>
        <small><?= strip_tags($course['mo_ta']) ?></small>
    </td>

    <!-- Cột 3: Danh sách chương -->
    <td>
        <div class="chapter-list">
            <?php if (!empty($course['chi_tiet_chuong'])): ?>
                <?php 
                $chapters_available = array_keys($course['chi_tiet_chuong']);
                sort($chapters_available);
                ?>
                <?php foreach ($chapters_available as $chapter_num): ?>
                    <?php $chuong = $course['chi_tiet_chuong'][$chapter_num]; ?>
                    <p>
                        <span>
                            <?php $ten_hien_thi = htmlspecialchars($chuong['ten_test']); ?>
                            <?php if ($chuong['trang_thai'] == 1): ?>
                                <strong style="color: #28a745;"><?= $ten_hien_thi ?></strong>
                            <?php else: ?>
                                <?= $ten_hien_thi ?>
                            <?php endif; ?>
                        </span>
                    </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có bài kiểm tra nào</p>
            <?php endif; ?>
        </div>
    </td>

    <!-- Máy tính: trạng thái và nút -->
    <td class="desktop-only">
        <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
    </td>
    <td class="desktop-only">
        <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
    </td>

    <!-- Điện thoại: Gộp trạng thái + nút -->
    <td colspan="2" class="mobile-only">
        <div class="mobile-row-bottom" style="display: flex; justify-content: space-between; align-items: center;">
            <span class="<?= $course['class'] ?>"><?= $course['trang_thai'] ?></span>
            <a href="templates/chapter1.php?khoa=<?= $course['id_khoa'] ?>" class="btn">Bắt đầu</a>
        </div>
    </td>
</tr>

