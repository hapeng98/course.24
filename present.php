<?php require_once 'includes/conn.php'; ?>
<?php require 'includes/2024_subj_code.php'; ?>

<?php
session_start();
if (isset($_SESSION['stunum']) && isset($_SESSION['name'])) {
} else {
    echo "학번과 이름을 확인해주세요.";
    exit();
}
?>



<?php
$stunum = $_SESSION['stunum']; // 학생 번호를 세션에서 가져옵니다.
$tables = [
    'course24_2_1' => '2-1학기',
    'course24_2_2' => '2-2학기',
    'course24_3_1' => '3-1학기',
    'course24_3_2' => '3-2학기'
];

echo "<strong>학번</strong>: " . $_SESSION['stunum']. "  <strong>이름</strong>: " . $_SESSION['name']. "<br>";

foreach ($tables as $table => $semester) {
    $semesterSubjects = []; // 학기별 과목 정보를 저장할 배열
    
    echo "<h3><$semester></h3>"; // 각 학기별 제목 출력

    $sql = "SELECT * FROM $table WHERE stunum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $stunum);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            foreach ($subjects as $subject) {
                $subjectName = $subject[0];
                $subjectCredit = $subject[4];

                if (isset($row[$subjectName]) && $row[$subjectName] == 1) {
                    // 중복 제거를 위해 과목명을 키로 사용
                    $semesterSubjects[$subjectName] = $subjectCredit;
                }
            }
        }

        if (!empty($semesterSubjects)) {
            // 테이블 헤더 출력
            echo "<table border='1'><tr><th>과목명</th><th>학점</th></tr>";
            foreach ($semesterSubjects as $name => $credit) {
                // 과목명과 학점을 테이블에 출력
                echo "<tr><td>" . htmlspecialchars($name) . "</td><td>" . htmlspecialchars($credit) . "</td></tr>";
            }
            echo "</table><br>"; // 각 학기별 테이블 종료
        } else {
            echo "선택된 과목이 없습니다.<br>";
        }
    } else {
        echo "해당 학생의 $table 테이블 정보를 찾을 수 없습니다.<br>";
    }
}
?>



<?php
 $stunum = $_SESSION['stunum'];
 $sql = "SELECT * FROM course24_2_1 WHERE stunum = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("i", $stunum); // 'i'는 변수 타입이 정수임을 나타냅니다.
 $stmt->execute();
 $result = $stmt->get_result();

 // 쿼리 결과를 체크하고 출력
// 
//  
// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc(); // 사용자 선택 과목 정보
// 
//     echo "<strong>학번</strong>: " . $row["stunum"]. "  <strong>이름</strong>: " . $row["name"]. "<br>";
//     echo "<2-1학기>";
//     // 선택된 과목과 학점을 중복 없이 표시하는 테이블을 위한 준비
//     $displaySubjects = []; // 중복을 제거한 과목 정보를 저장할 배열
// 
//     foreach ($subjects as $subject) {
//         $subjectName = $subject[0]; // 과목명
//         $subjectCredit = $subject[4]; // 과목 학점
// 
//         // 사용자가 해당 과목을 선택했는지 확인
//         if (isset($row[$subjectName]) && $row[$subjectName] == 1) {
//             // 과목명을 키로, 학점을 값으로 하여 중복 제거
//             $displaySubjects[$subjectName] = $subjectCredit;
//         }
//     }
// 
//     // 중복이 제거된 과목 정보를 테이블 형태로 출력
//     echo "<table border='1'><tr><th>과목명</th><th>학점</th></tr>";
//     foreach ($displaySubjects as $name => $credit) {
//         echo "<tr><td>" . htmlspecialchars($name) . "</td><td>" . htmlspecialchars($credit) . "</td></tr>";
//     }
//     echo "</table>";
//     echo "<hr>"; 
// } else {
//     echo "해당 학생의 정보를 찾을 수 없습니다.";
// }
// 
// 


 $stmt->close();
 $conn->close();

?>
신청과목에 대한 오류 검증을 위해 다음을 클릭해주세요. <br>
<a href="errorcheck.php"><button> 오류검증 </button></a>