<?php require 'includes/session.php'; ?>
<?php require 'includes/2024_subj_code.php'; ?>
<?php require 'includes/header.php'; ?>



<body>
    <h1>수강신청 3학년 1학기(택7)</h1>
    
    <h2>Ⅱ. 학생자율선택과목 </h2>
    <strong>1. 다음에서 <u><strong>7과목</strong></u>을 선택해주세요.</strong><br>
        (선택에 대한 도움이 필요하시면 <strong><a href=3-1_help.html><button>여기</button></strong></a>를 클릭하세요.)
    <p>※<strong>(일반)</strong>=>일반선택과목 / 나머지=> 진로선택과목 / <strong>(일반)(교양)</strong>=>일반선택이지만 교양과목</p>

    <?php
echo '<form action="submit_3-1.php" method="post">';
foreach ($subjects as $index => $subject) {
    if ($subject[9] == 1 && $subject[11] == "stu") {
        // 과목명 뒤에 추가할 텍스트를 결정합니다.
        $additionalText = '';
        if ($subject[3] == 2) {
            $additionalText = '<strong>(일반)</strong> ';
        }
        if ($subject[2] == 'gen') {
            $additionalText .= '<strong>(교양)</strong>';
        }

        // 과목명 출력
        echo '<input type="checkbox" id="subject' . $index . '" name="selectedSubjects[]" value="' . htmlspecialchars($subject[0], ENT_QUOTES) . '">';
        echo '<label for="subject' . $index . '">' . $additionalText . ' ' . htmlspecialchars($subject[0], ENT_QUOTES) . '</label><br>';
    }
}
echo '<p><input type="submit" value="제출"></p>';
echo '</form>';
?>

    <?php
    //echo '<form action="submit_2-2.php" method="post">';
    //foreach ($subjects as $index => $subject) {
    //    if ($subject[9] == 1 && $subject[11] == "stu") {
    //        echo '<input type="checkbox" id="subject' . $index . '" name="selectedSubjects[]" value="' . htmlspecialchars($subject[0], ENT_QUOTES) . '">';
    //        if ($subject[3] == 2) {
    //            echo '<label for="subject' . $index . '"><strong>(일반)</strong> ' . htmlspecialchars($subject[0], ENT_QUOTES) . '</label><br>';
    //        } else {
    //            echo '<label for="subject' . $index . '">' . htmlspecialchars($subject[0], ENT_QUOTES) . '</label><br>';
    //        }
    //    }
    //}
    //echo '<input type="submit" value="제출">';
    //echo '</form>';
    ?>

</body>
</html>