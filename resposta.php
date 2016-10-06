<?php
$con  = new PDO("mysql:host=localhost;dbname=chat","root","root");
$stmt = $con->query("SELECT * FROM msg");
?>
<?php
    while($row = $stmt->fetch()):
?>
        <table style="width:100%">
            <tr>
                <td><?=$row['msg']?></td>
            </tr>
        </table>
<?php endwhile; ?>