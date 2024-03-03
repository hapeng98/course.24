<?php require 'includes/session.php'; ?>
<?php require 'includes/2024_subj_code.php'; ?>
<?php require 'includes/header.php'; ?>


<body>
    <h1>수강신청 3학년 2학기(택5)</h1>
    <h2>Ⅰ. 학교지정과목 </h2>
    1. 다음은 학교지정과목으로 <strong>자동으로 수강등록되는 과목들</strong>입니다.

<h3> <학교지정과목 목록> </h3>

<?php
function getSubjectNamesWithCredits($subjects) {
    $subjectsInfo = []; // 배열을 초기화합니다.
    
    foreach ($subjects as $subject) {
        if ($subject[10] == 1 && $subject[11] == 'sch' && $subject[2] != 'gen') {
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
<br>
<p>2. 다음 교양과목 중 <strong>한 과목</strong>을 골라주세요.</p>

    <form action="submit_gen_3-2.php" method="post">
    <?php
        $selectedOption = isset($_POST['gen_3-2']) ? $_POST['gen_3-2'] : '';
        // $subject 배열이 다차원 배열인 경우의 올바른 접근 방식
        $checkedPhil = ($selectedOption == $subjects[29][0]) ? 'checked' : '';
        $checkedLogic = ($selectedOption == $subjects[30][0]) ? 'checked' : '';
    ?>

        <input type="radio" id="phil" name="gen_3-2" value="<?=$subjects[29][0]?>" <?=$checkedPhil?>>
        <label for="phil"> <?=$subjects[29][0]?> </label><br>
        <input type="radio" id="logic" name="gen_3-2" value="<?=$subjects[30][0]?>" <?=$checkedLogic?>>
        <label for="logic"> <?=$subjects[30][0]?> </label><br>
        <p><input type="submit" value="제출"></p>
    </form>

</body>
</html>
