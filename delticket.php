<?php
include "config.php";

include "sep.php";

$ticket_no=$_GET['ticket_no'];

$ticket="SELECT * FROM tickets WHERE ticket_no=$ticket_no";

$show=mysqli_query($conn,$ticket);

$res=mysqli_fetch_array($show);

$tn=$res['train_no'];

$select="UPDATE trains set avlbl_seats=avlbl_seats+1 WHERE train_no=$tn";

$func=mysqli_query($conn,$select);


$delete = "DELETE FROM tickets WHERE ticket_no=$ticket_no";

$delete1="DELETE FROM payment WHERE ticket_no=$ticket_no";

$query=mysqli_query($conn,$delete);

$query1=mysqli_query($conn,$delete1);
// the ticket has been deleted 
//redirecting to welcome page

$alert="<script>
        Swal.fire({
                    title: 'Good Job!',
                    text: 'Deleted ticket successfully!',
                    icon: 'success',
                    button: 'OK',
                });
        </script>";
echo $alert;

if($query&&$query1)
{ 
    header('location:welcome.php');
}
?>
