<?php
    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
    if ($result) {
        $rows = mysqli_num_rows($result); 
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_row($result); 
            echo "<div class=\"card-service__body\">";
                echo "<img class=\"service-img\" src=\".." .$row[3]. "\" alt=\"\">";
                echo "<p class=\"service-name\">".$row[2]."</p>";
                echo "<p class=\"service-description\">".$row[4]."</p>";
                echo "<div class=\"service-button green-button\" id=\"".$row[0]."\">";
                    echo "<span class=\"details\">ПОДРОБНЕЕ</span>";
                echo "</div>";
            echo "</div>";
        }
        mysqli_free_result($result);
    }
?>