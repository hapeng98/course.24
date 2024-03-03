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

    if (count($selectedSubjects) == 3) {
        
    $resetQuery = "UPDATE course24_2_2 SET 
                    `화법과 작문`=NULL,
                    `언어와 매체`=NULL,
                    `고전문학 감상`=NULL,
                    `수학Ⅱ`=NULL,
                    `미적분`=NULL,
                    `확률과 통계`=NULL,
                    `기하`=NULL,
                    `영어권 문화`=NULL,
                    `한국지리`=NULL,
                    `세계지리`=NULL,
                    `세계사`=NULL,
                    `동아시아사`=NULL,
                    `경제`=NULL,
                    `정치와 법`=NULL,
                    `사회·문화`=NULL,
                    `생활과 윤리`=NULL,
                    `윤리와 사상`=NULL,
                    `사회 탐구 방법`=NULL,
                    `물리학Ⅰ`=NULL,
                    `화학Ⅰ`=NULL,
                    `생명과학Ⅰ`=NULL,
                    `지구과학Ⅰ`=NULL,
                    `생활과 과학`=NULL,
                    `체육 전공 실기 기초`=NULL,
                    `음악 전공 실기`=NULL,
                    `미술사`=NULL,
                    `인공지능 기초`=NULL,
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
            $updateQuery = "UPDATE course24_2_2 SET `$subjectName`=1 WHERE stunum=?";
            
            if ($updateStmt = $conn->prepare($updateQuery)) {
                $updateStmt->bind_param("i", $stunum);
                $updateStmt->execute();
                $updateStmt->close();
            } else {
                echo "쿼리 준비 오류: " . $conn->error;
            }
        }
        
        echo "과목 선택이 성공적으로 업데이트되었습니다.";
        ?> <p><a href="3-1_sch.php"><button>3-1학기</button></a>로 넘어가기
        <?php
    } else {
        echo "3개의 과목을 선택해야 합니다.";
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


