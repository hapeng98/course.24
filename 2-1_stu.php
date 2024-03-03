<?php require 'includes/session.php'; ?>
<?php require 'includes/2024_subj_code.php'; ?>
<?php require 'includes/header.php'; ?>



<body>
    <h1>수강신청 2학년 1학기(택2)</h1>
    <h2>Ⅰ. 학교지정과목 </h2>
    2. 제 2 외국어 과목 중 <strong>한 과목</strong>을 골라주세요.<br>

    <form action="submit_foreign_2-1.php" method="post">
    <?php
        $selectedOption = isset($_POST['foreign_2-1']) ? $_POST['foreign_2-1'] : '';
        // $subject 배열이 다차원 배열인 경우의 올바른 접근 방식
        $checkedJapanese = ($selectedOption == $subjects[25][0]) ? 'checked' : '';
        $checkedChinese = ($selectedOption == $subjects[27][0]) ? 'checked' : '';
    ?>

        <input type="radio" id="japanese1" name="foreign_2-1" value="<?=$subjects[25][0]?>" <?=$checkedJapanese?>>
        <label for="japanese1"> <?=$subjects[25][0]?> </label><br>
        <input type="radio" id="chinese1" name="foreign_2-1" value="<?=$subjects[27][0]?>" <?=$checkedChinese?>>
        <label for="chinese1"> <?=$subjects[27][0]?> </label><br>
        <input type="submit" value="제출">
    </form>


    <h2>Ⅱ. 학생자율선택과목 </h2>
    <strong>1. 다음에서 <u><strong>2과목</strong></u>을 선택해주세요.</strong><br>
        (선택에 대한 도움이 필요하시면 <strong><a href=2-1_help.html><button>여기</button></strong></a>를 클릭하세요.)
    <p>※<strong>(일반)</strong>=>일반선택과목 / 나머지=> 진로선택과목 </p>

    <?php
    echo '<form action="submit_2-1.php" method="post">';
    foreach ($subjects as $index => $subject) {
        if ($subject[7] == 1 && $subject[11] == "stu" && $subject[2] != "forl") {
            echo '<input type="checkbox" id="subject' . $index . '" name="selectedSubjects[]" value="' . htmlspecialchars($subject[0], ENT_QUOTES) . '">';
            if ($subject[3] == 2) {
                echo '<label for="subject' . $index . '"><strong>(일반)</strong> ' . htmlspecialchars($subject[0], ENT_QUOTES) . '</label><br>';
            } else {
                echo '<label for="subject' . $index . '">' . htmlspecialchars($subject[0], ENT_QUOTES) . '</label><br>';
            }
        }
    }
    echo '<input type="submit" value="제출">';
    echo '</form>';
    ?>

</body>
</html>