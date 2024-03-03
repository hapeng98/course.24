<?php require_once 'includes/conn.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stunum = $_POST['stunum']; // 학생 번호
    $name = $_POST['name']; // 학생 이름
    $password = $_POST['password']; // 사용자가 입력한 비밀번호

    // 데이터베이스에서 학생 정보 조회
    $stmt = $conn->prepare("SELECT password FROM course24_2_1 WHERE stunum = ? AND name = ?");
    $stmt->bind_param("ss", $stunum, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password']; // 데이터베이스에 저장된 해시된 비밀번호

    // 입력된 비밀번호가 데이터베이스에 있는 해시와 일치하는지 검사
    if (password_verify($password, $hashed_password)) {
        // 비밀번호가 일치하면 세션 시작 및 세션 변수 설정
        session_start();
        $_SESSION['stunum'] = $stunum;
        $_SESSION['name'] = $name;

        // 여기에 수강신청 페이지로 리디렉션하는 코드 추가
        header('Location: 2-1_sch.php'); // 수강신청 페이지로 이동
        exit();
    } else {
        echo "잘못된 비밀번호입니다. 다시 시도해주세요.";
        ?> <p> <button onclick="goBack()">돌아가기</button> 
        <script>
        function goBack() {
        window.history.back();
        }
        </script></p> <?php

    }
} else {
    // 학생 정보가 데이터베이스에 없는 경우
    echo "학번과 이름을 다시 확인해 주세요.";
}

$stmt->close();
} else {
// POST 요청이 아닐 경우
echo "비밀번호를 입력해주세요.";
}

$conn->close();
?>

