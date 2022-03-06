<?php
    function add_row(){
        echo <<<_END
    <form action="forms.php" method=post>
    <div>
        Name <input type="text" name="name">
    </div>
    <div>
        e_id <input type="text" name="e_id">
    </div>
    <div>
        age <input type="number" name="age">
    </div>
    <div>
        email <input type="text" name="email">
    </div>
    <div>
        <input type="submit" value="ADD RECORD">
    </div>
    </form>
    _END;
    }