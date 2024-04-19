<table class="table__to-update-delete">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Фото</th>
        <th>Курсы</th>
        <th>Опыт работы</th>
        <th>Специализация</th>
    </tr>
    <?php

    $query = 'SELECT * from master';

    $trBlock = '';

    $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));

    if ($result) {
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_row($result);

            $trBlock .= "
                                                <tr>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[1] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[2] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[3] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[4] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[5] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[6] . "</textarea></td>
                                                    
                                                    <td>
                                                        <button class='change-master__button' id='" . $row[0] . "'></button>
                                                        <button class='delete-master__button' id='" . $row[0] . "'></button>
                                                    </td>
                                                </tr>";
        }
    }
    echo $trBlock;
    ?>
    
</table>