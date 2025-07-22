<?php
function verifyEmailCode($conn, $user_id, $verify_code, $config)
{
    $max_attempts = $config['max_attempts'];
    $timeout_minutes = $config['timeout_minutes'];

    // So lan dang nhap sai
    $check_fail = $conn->prepare("SELECT verify_fail_count FROM users WHERE id = :id");
    $check_fail->execute([':id' => $user_id]);
    $result = $check_fail->fetch(PDO::FETCH_ASSOC);

    $fail_count = $result['verify_fail_count']  ?? 0;

    if ($fail_count >= $max_attempts) {
        $check_timeout = $conn->prepare("SELECT TIMESTAMPDIFF(MINUTE, code_sent_at, NOW()) AS minutes_passed 
                                         FROM users WHERE id = :id");
        $check_timeout->execute([':id' => $user_id]);
        $timeout = $check_timeout->fetch(PDO::FETCH_ASSOC);

        if ($timeout['minutes_passed'] <= $timeout_minutes) {
            $wait_time = $timeout_minutes - $timeout['minutes_passed'];
            return [
                'status' => 'error',
                'code' => 1,
                'timeout_remaining' => $wait_time
            ];
        }
        //..... Reset

    }
    // Kiem tra xac minh dung & con hieu luc
    $checkCode = $conn->prepare("
        SELECT * FROM users
        WHERE id = :id
        AND email_code = :code
        AND code_sent_at >= (NOW() - INTERVAL $timeout_minutes MINUTE)
    ");
    $checkCode->execute([
        ':id' => $user_id,
        ':code' => $verify_code
    ]);

    if ($checkCode->rowCount() > 0) {
        $update = $conn->prepare("
            UPDATE users SET
                email_verified = 1,
                email_code = NULL,
                code_sent_at = NULL,
                verify_fail_count = 0
            WHERE id = :id
        ");
        $update->execute([':id' => $user_id]);
        return [
            'status' => 'success',
            'code' => 1
        ];
    }

    // Neu sai ma
    $update_fail = $conn->prepare("
        UPDATE users
        SET verify_fail_count = verify_fail_count + 1
        WHERE id = :id
    ");
    $update_fail->execute([':id' => $user_id]);

    $remaining_attempts = max(0, $max_attempts - $fail_count - 1);

    return [
        'status' => 'error', 
        'remaining_attempts' => $remaining_attempts,
        'code' => 2
    ];


}
?>