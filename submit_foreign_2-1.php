<?php require_once 'includes/conn.php'; ?>

<?php
session_start();
if (isset($_SESSION['stunum']) && isset($_SESSION['name'])) {
} else {
    header('Location: 2-2.html');
    exit();
}

if (isset($_POST['foreign_2-1'])) {
    $selected = $_POST['foreign_2-1'];
    $stunum = $_SESSION['stunum']; 
    
    $resetQuery = "UPDATE course24_2_1 SET 일본어Ⅰ=NULL, 중국어Ⅰ=NULL WHERE stunum=?";
    $resetStmt = $conn->prepare($resetQuery);
    $resetStmt->bind_param("i", $stunum);
    $resetStmt->execute();
    $resetStmt->close();

    $column = $selected;
    $query = "UPDATE course24_2_1 SET $column=1 WHERE stunum=?";
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


<p><button onclick="goBack()">돌아가기</button></p>

<script>
function goBack() {
  window.history.back();
}
</script>
