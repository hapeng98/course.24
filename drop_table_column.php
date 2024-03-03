<?php require 'includes/2024_subj_code.php'; ?>
<?php require 'includes/conn.php'; ?>

<?php
foreach ($subjects as $subject) {
    if ($subject[9] == 1) {
        // 컬럼명이 공백이나 특수문자를 포함할 수 있으므로 백틱으로 감쌉니다.
        $columnName = $subject[0];
        $sql = "ALTER TABLE course24_3_1 DROP COLUMN `$columnName`";
        
        if ($conn->query($sql) === TRUE) {
            echo "컬럼 $columnName 이(가) 성공적으로 삭제되었습니다.\n";
        } else {
            echo "컬럼 삭제 에러: " . $conn->error . "\n";
        }
    }
}

// 데이터베이스 연결 종료
$conn->close();
?>
