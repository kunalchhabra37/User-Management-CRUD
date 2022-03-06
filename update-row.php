<?php
    $e_id = $_POST['e_id_'];
    echo <<<_END
        <form action="forms.php" method="post">
        <div>
            Name <input type="text" name="name_up">
        </div>
        <div>
            e_id <input type="text" name="e_id_up">
        </div>
        <div>
            age <input type="text" name="age_up">
        </div>
        <div>
            email <input type="text" name="email_up">
        </div>
        <div>   
            <input type="hidden" name="e_id_old" value=$e_id>
            <input type='hidden' name='update' value='yes'>
            <input type="submit" value="UPDATE RECORD">
        </div>
    _END;
?>