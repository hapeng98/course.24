<?php require_once 'includes/conn.php'; ?>

<?php
session_start();
if (isset($_SESSION['stunum']) && isset($_SESSION['name'])) {
} else {
    header('Location: 2-2.html');
    exit();
}

if (isset($_POST['gen_3-2'])) {
    $selected = $_POST['gen_3-2'];
    $stunum = $_SESSION['stunum']; 
    
    $resetQuery = "UPDATE course24_3_2 SET 철학=NULL, 논리학=NULL WHERE stunum=?";
    $resetStmt = $conn->prepare($resetQuery);
    $resetStmt->bind_param("i", $stunum);
    $resetStmt->execute();
    $resetStmt->close();

    $column = $selected;
    $query = "UPDATE course24_3_2 SET $column=1 WHERE stunum=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $stunum);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "<h3>성공적으로 제출되었습니다. </h3>";

} else {
    echo "제 2 외국어 중 한과목을 선택해주세요.";
}
?>

<p> <a href="3-2_stu.php"><button>다음</button></a></p>
