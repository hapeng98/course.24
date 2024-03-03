<?php require 'includes/header.php'; ?>

<body>
    <form action="save_password.php" method="post">
        <label for="stunum">학번:</label>
        <input type="text" id="stunum" name="stunum" required><br>
        <label for="name">이름:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="password">비밀번호 입력:</label>
        <input type="password" id="password" name="password" maxlength="4" placeholder="(4자리)" pattern="\d{4}" required><br>
        <label for="confirm_password">비밀번호 확인:</label>
        <input type="password" id="confirm_password" name="confirm_password" maxlength="4" placeholder="(4자리)" pattern="\d{4}" required><br>
        <button type="submit">저장</button>
    </form>
</body>
</html>


 <?php
// $stunum = $_SESSION['stunum'];
// $name = $_SESSION['name'];
// 
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $password = $_POST['password']; // 사용자가 입력한 비밀번호
//     $confirm_password = $_POST['confirm_password']; // 사용자가 입력한 비밀번호 확인
// 
//     // 비밀번호와 비밀번호 확인이 일치하는지 검사
//     if ($password === $confirm_password) {
//         // 비밀번호 해싱
//         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
// 
//         // 데이터베이스에 비밀번호 업데이트
//         $stmt = $conn->prepare("UPDATE course24_2_1 SET password = ? WHERE stunum = ? AND name = ?");
//         $stmt->bind_param("sss", $hashed_password, $stunum, $name);
//         $stmt->execute();
// 
//         if ($stmt->affected_rows > 0) {
//             echo "비밀번호가 성공적으로 설정되었습니다.";
//             // 비밀번호 설정 후 처리할 작업을 여기에 추가할 수 있습니다.
//             // 예를 들어, 수강신청 페이지로 리디렉션할 수 있습니다.
//             header('Location: index.php'); // 수강신청 페이지로 이동
//             exit();
//         } else {
//             echo "비밀번호 설정에 실패하였습니다. 정보를 다시 확인해주세요.";
//         }
// 
//         $stmt->close();
//     } else {
//         echo "입력하신 비밀번호가 일치하지 않습니다. 다시 시도해주세요.";
//     }
// } else {
//     // 폼이 제출되지 않았을 때 비밀번호 설정 폼을 표시합니다.

// }
// 
// $conn->close();
// ?>