<?php
    function dis_tables($result){
          // Fetching Columns
        $col = [];
        $res = $result->fetch_field()->name;
        while($res){
            $col[] = $res;
            $res = @$result->fetch_field()->name;
        }

        //Making SQL Table Output
        echo '<table border="1">';
        // Heading
        echo '<tr>';
            foreach($col as $val){
                echo  '<th>'.$val.'</th>';
            }
            echo '<th> Functions</th>';
        echo '</tr>';

        //Rows
        while($res = $result->fetch_row()){
            echo '<tr>';
                foreach($res as $val){
                    echo '<td>'. htmlspecialchars($val).'</td>';
                }
                // echo '<td><button>Delete</button></td>';
                echo <<<_END
                <td><form action="forms.php" method='post'>
                    <input type='hidden' name='delete' value='yes'>
                    <input type='hidden' name='e_id' value='$res[0]'>
                    <input type="submit" value="DELETE">
                </form>

                <form action="update-row.php" method='post'>
                    <input type='hidden' name='e_id_' value='$res[0]'>
                    <input type="submit" value="UPDATE">
                </form>
                </td>
                _END;
            echo '</tr>';
        }
        echo '</table>';
    }
?>