foreach ($q['choices'] as $key => $val) {
    $li_class = '';
    if ($user_ans !== null && $key === $user_ans) {
        $li_class = $is_correct ? 'correct' : 'incorrect';
    }

    echo "<li class='$li_class'>";
    echo "$key. " . htmlspecialchars($val);

    // Thêm icon đúng/sai bên phải
    if ($user_ans !== null && $key === $user_ans) {
        echo $is_correct ? $icon_correct : $icon_wrong;
    }

    // Hiển thị hình ảnh đáp án nếu có
    if (!empty($q['images'][$key])) {
        echo "<br><img src='/rosa_courses/login/admin/" . htmlspecialchars($q['images'][$key]) . "' alt='Hình ảnh đáp án $key' class='answer-image' onerror='this.style.display=\"none\"'>";
    }

    echo "</li>";
}
