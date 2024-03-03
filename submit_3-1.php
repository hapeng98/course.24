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

    if (count($selectedSubjects) == 7) {
        
        // 아래 과목들 수정 필요
$resetQuery = "UPDATE course24_3_1 SET 
                `화법과 작문`=NULL,
                `언어와 매체`=NULL,
                `심화 국어`=NULL,
                `문학과 매체`=NULL,
                `현대문학 감상`=NULL,
                `미적분`=NULL,
                `확률과 통계`=NULL,
                `기하`=NULL,
                `경제 수학`=NULL,
                `수학과제탐구`=NULL,
                `통합수학Ⅰ`=NULL,
                `통합수학Ⅱ`=NULL,
                `인공지능 수학`=NULL,
                `수학적 사고와 적분`=NULL,
                `영어 회화`=NULL,
                `영어 독해와 작문`=NULL,
                `진로 영어`=NULL,
                `영미문학 읽기`=NULL,
                `심화 영어Ⅰ`=NULL,
                `한국지리`=NULL,
                `세계지리`=NULL,
                `세계사`=NULL,
                `동아시아사`=NULL,
                `경제`=NULL,
                `정치와 법`=NULL,
                `사회·문화`=NULL,
                `생활과 윤리`=NULL,
                `윤리와 사상`=NULL,
                `세계 문제와 미래 사회`=NULL,
                `물리학Ⅱ`=NULL,
                `화학Ⅱ`=NULL,
                `생명과학Ⅱ`=NULL,
                `지구과학Ⅱ`=NULL,
                `과학사`=NULL,
                `융합과학`=NULL,
                `체육 전공 실기 심화`=NULL,
                `음악사`=NULL,
                `미술 창작`=NULL,
                `농업 생명 과학`=NULL,
                `공학 일반`=NULL,
                `창의 경영`=NULL,
                `해양 문화와 기술`=NULL,
                `가정과학`=NULL,
                `지식 재산 일반`=NULL,
                `정보 처리와 관리`=NULL,
                `프로그래밍`=NULL,
                `일본어Ⅱ`=NULL,
                `중국어Ⅱ`=NULL,
                `한문Ⅱ`=NULL,
                `심리학`=NULL,
                `교육학`=NULL,
                `보건`=NULL,
                `환경`=NULL,
                `실용 경제`=NULL
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
            $updateQuery = "UPDATE course24_3_1 SET `$subjectName`=1 WHERE stunum=?";
            
            if ($updateStmt = $conn->prepare($updateQuery)) {
                $updateStmt->bind_param("i", $stunum);
                $updateStmt->execute();
                $updateStmt->close();
            } else {
                echo "쿼리 준비 오류: " . $conn->error;
            }
        }
        
        echo "과목 선택이 성공적으로 업데이트되었습니다.";
        ?> <p><a href="3-2_sch.php"><button>3-2학기</button></a>로 넘어가기
        <?php
    } else {
        echo "7개의 과목을 선택해야 합니다.";
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


