<?php require_once 'includes/conn.php'; ?>
<?php require 'includes/2024_subj_code.php'; ?>

<?php
session_start();
if (isset($_SESSION['stunum']) && isset($_SESSION['name'])) {
} else {
    header('Location: 2-2.html');
    exit();
}
?>

<?php
if (isset($_POST['selectedSubjects'])) {
    $selectedSubjects = $_POST['selectedSubjects'];

    // 데이터베이스 연결 확인
    if ($conn->connect_error) {
        die("연결 실패: " . $conn->connect_error);
    }

    // 학생 식별자 설정
    $stunum = $_SESSION['stunum'];

    if (count($selectedSubjects) == 2) {
        // 모든 과목 선택을 NULL로 리셋
        $resetQuery = "UPDATE course24_2_1 SET 
            `고전문학 감상`=NULL,
            `수학Ⅱ`=NULL,
            `영어권 문화`=NULL,
            `여행지리`=NULL,
            `사회문제 탐구`=NULL,
            `고전과 윤리`=NULL,
            `한국 사회의 이해`=NULL,
            `물리학Ⅰ`=NULL,
            `화학Ⅰ`=NULL,
            `생명과학Ⅰ`=NULL,
            `지구과학Ⅰ`=NULL,
            `생활과 과학`=NULL, 
            `스포츠 경기 체력`=NULL,
            `음악 이론`=NULL,
            `드로잉`=NULL,
            `정보과학`=NULL,
            `한문Ⅰ`=NULL
            WHERE stunum=?";
        
        if ($stmt = $conn->prepare($resetQuery)) {
            $stmt->bind_param("i", $stunum);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "쿼리 준비에 실패했습니다: " . $conn->error;
        }

        // 선택된 과목 업데이트
        foreach ($selectedSubjects as $subjectName) {
            $updateQuery = "UPDATE course24_2_1 SET `$subjectName`=1 WHERE stunum=?";
            
            if ($updateStmt = $conn->prepare($updateQuery)) {
                $updateStmt->bind_param("i", $stunum);
                $updateStmt->execute();
                $updateStmt->close();
            } else {
                echo "쿼리 준비 오류: " . $conn->error;
            }
        }
        
        echo "과목 선택이 성공적으로 업데이트되었습니다.";
        ?> <p><a href="2-2_sch.php"><button>2-2학기</button></a>로 넘어가기
        <?php
    } else {
        echo "2개의 과목을 선택해야 합니다.";
        echo '<p><button onclick="goBack()">돌아가기</button> 
        <script>
        function goBack() {
        window.history.back();
        }
        </script></p>';
    }

    // 데이터베이스 연결 닫기
    $conn->close();
} else {
    echo "선택된 과목이 없습니다.";
    echo '<p><button onclick="goBack()">돌아가기</button> 
        <script>
        function goBack() {
        window.history.back();
        }
        </script></p>';
}
?>


