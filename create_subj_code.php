<?php require 'includes/2024_subj_code.php'; ?>

<?php

foreach ($subjects as $key => $subject) {
    // $subject[7], $subject[8], $subject[9], $subject[10] 중에서 1이 체크된 개수를 세기
    $count = 0;
    for ($i = 7; $i <= 10; $i++) {
        if ($subject[$i] == 1) {
            $count++;
        }
    }

    // 2개 이상 1로 체크되어 있으면, 조건에 맞게 과목명 수정
    if ($count >= 2) {
        if ($subject[7] == 1) {
            $subjects[$key][0] .= '(2-1학기)';
        }
        if ($subject[8] == 1) {
            $subjects[$key][0] .= '(2-2학기)';
        }
        if ($subject[9] == 1) {
            $subjects[$key][0] .= '(3-1학기)';
        }
        if ($subject[10] == 1) {
            $subjects[$key][0] .= '(3-2학기)';
        }
    }
}

// 결과 출력
foreach ($subjects as $subject) {
    echo $subject[0] . "<br>";
}
?>