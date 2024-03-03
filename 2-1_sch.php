<?php require 'includes/session.php'; ?>
<?php require 'includes/2024_subj_code.php'; ?>
<?php require 'includes/header.php'; ?>


<body>
    <h1>수강신청 2학년 1학기(택2)</h1>
    <h2>Ⅰ. 학교지정과목 </h2>
    1. 다음은 학교지정과목으로 <strong>자동으로 수강등록되는 과목들</strong>입니다.

<h3> <학교지정과목 목록> </h3>
<?php
function getSubjectNamesWithCredits($subjects) {
    $subjectsInfo = []; // 이 부분을 추가하여 배열을 초기화합니다.
    
    foreach ($subjects as $subject) {
        if ($subject[7] == 1 && $subject[11] == 'sch' && $subject[2] != 'forl') {
            $subjectsInfo[] = ['name' => $subject[0], 'credits' => $subject[4]];
        }
    }
    
    return $subjectsInfo;
}

$filteredSubjectsInfo = getSubjectNamesWithCredits($subjects);

?>

    <table>
        <tr>
            <th>과목명</th>
            <th>학점</th>
        </tr>
        <?php foreach ($filteredSubjectsInfo as $info): ?>
        <tr>
            <td><?= htmlspecialchars($info['name']) ?></td>
            <td><?= htmlspecialchars($info['credits']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p> <a href="2-1_stu.php"><button>다음</button></a></p>
</body>
</html>
