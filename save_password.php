<?php require 'includes/conn.php'; ?>

<?php
if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
    if ($_POST['password'] === $_POST['confirm_password'] && strlen($_POST['password']) === 4) {
        // 비밀번호 해시 생성
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // course24_2_1 테이블의 password 컬럼에 비밀번호 저장
        $stmt = $conn->prepare("UPDATE course24_2_1 SET password = ? WHERE stunum = ?");
        $stmt->bind_param("ss", $hashedPassword, $_POST['stunum']);
        
        if ($stmt->execute()) { // execute()의 결과로 성공 여부를 직접 확인
            echo "비밀번호가 성공적으로 저장되었습니다.<br>";
            echo '<a href="index.php"><button>처음으로</button></a>';
        } else {
            echo "오류: <br>" . $conn->error;
        }
    } else {
        echo "비밀번호가 일치하지 않거나 4자리가 아닙니다.";
    }
}

// 연결 종료
$conn->close();
?>