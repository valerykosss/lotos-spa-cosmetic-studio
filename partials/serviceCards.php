<?php
    $result = mysqli_query($link, $query) or die("Ошибка" . mysqli_error($link));
    if ($result) {
        $rows = mysqli_num_rows($result); 
        for ($i = 0; $i < $rows; ++$i) {
            $row = mysqli_fetch_row($result); 
            //
            echo "<div class=\"card-service__body\">";
            echo "<div class=\"service-img-block\">";
                echo "<img class=\"service-img\" src=\"" .$row[3]. "\" alt=\"\">"; echo "</div>";
                echo "<p class=\"service-name\">".$row[2]."</p>";
                echo "<p class=\"service-description\">".$row[4]."</p>";
                echo "<a href='service-page.php?service_id=".$row[0]."'>";
                    echo "<div class=\"service-button button\" id=\"".$row[0]."\">";
                        echo "<span class=\"details\">ПОДРОБНЕЕ</span>";
                    echo "</div>";
                echo "</a>";
            echo "</div>";
        }
        mysqli_free_result($result);
    }
?>