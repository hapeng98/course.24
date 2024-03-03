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

    if (count($selectedSubjects) == 5) {
        
$resetQuery = "UPDATE course24_3_2 SET 
                `실용 국어`=NULL,
                `심화 국어`=NULL,
                `고전 읽기`=NULL,
                `문학과 매체`=NULL,
                `실용 수학`=NULL,
                `경제 수학`=NULL,
                `수학과제탐구`=NULL,
                `수학적 사고와 통계`=NULL,
                `인공지능 수학`=NULL,
                `영어 회화`=NULL,
                `영어 독해와 작문`=NULL,
                `실용 영어`=NULL,
                `진로 영어`=NULL,
                `영미문학 읽기`=NULL,
                `심화 영어Ⅰ`=NULL,
                `심화 영어Ⅱ`=NULL,
                `여행지리`=NULL,
                `사회문제 탐구`=NULL,
                `고전과 윤리`=NULL,
                `현대 세계의 변화`=NULL,
                `사회과제 연구`=NULL,
                `물리학Ⅱ`=NULL,
                `화학Ⅱ`=NULL,
                `생명과학Ⅱ`=NULL,
                `지구과학Ⅱ`=NULL,
                `과학사`=NULL,
                `융합과학`=NULL,
                `물리학 실험`=NULL,
                `화학 실험`=NULL,
                `생명과학 실험`=NULL,
                `지구과학 실험`=NULL,
                `체육 전공 실기 응용`=NULL,
                `음악 연주`=NULL,
                `미술 감상과 비평`=NULL,
                `연극`=NULL,
                `농업 생명 과학`=NULL,
                `공학 일반`=NULL,
                `창의 경영`=NULL,
                `해양 문화와 기술`=NULL,
                `가정과학`=NULL,
                `지식 재산 일반`=NULL,
                `정보 처리와 관리`=NULL,
                `사물인터넷`=NULL,
                `중국어 회화Ⅰ`=NULL,
                `일본어 회화Ⅰ`=NULL,
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
            $updateQuery = "UPDATE course24_3_2 SET `$subjectName`=1 WHERE stunum=?";
            
            if ($updateStmt = $conn->prepare($updateQuery)) {
                $updateStmt->bind_param("i", $stunum);
                $updateStmt->execute();
                $updateStmt->close();
            } else {
                echo "쿼리 준비 오류: " . $conn->error;
            }
        }
        
        echo "<p>과목 선택이 성공적으로 업데이트되었습니다.</p>";
        echo "선택한 과목 확인을 확인하려면 다음의 결과 확인을 눌러주세요.";
        ?> <p><a href="present.php"><button>결과 확인</button></a></p>
        <?php
    } else {
        echo "5개의 과목을 선택해야 합니다.";
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


