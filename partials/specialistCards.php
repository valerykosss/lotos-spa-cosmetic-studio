<?php
    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
    if ($result) {
        $rows = mysqli_num_rows($result); 
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_row($result); 
            echo "<div class=\"card-specialist__body\">";
                echo "<img class=\"specialist-img\" src=\".." .$row[3]. "\" alt=\"\">";
                echo "<p class=\"specialist-name\">".$row[1]." ".$row[2]."</p>";
                echo "<p class=\"specialist-description\">".$row[4]."</p>";
                echo "<a style='display: flex; justify-content: center;'href='specialist-page.php?spec_id=".$row[0]."'>";
                    echo "<div class=\"specialist-button button\" id=\"".$row[0]."\">";
                        echo "<span class=\"details\">ПОДРОБНЕЕ</span>";
                    echo "</div>";
                echo "</a>";
            echo "</div>";
        }
        mysqli_free_result($result);
    }
?>