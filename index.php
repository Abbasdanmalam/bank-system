<?php

$conn = mysqli_connect("localhost", "root", "");

mysqli_select_db($conn, "bank");

// $First_Name = "AL-FAKI";

// // print $First_Name;
// // print "<br>";
// $Last_Name = "Jubril";
// echo $Last_Name." ".First_Name;
// echo "he said "."he doesn.'t like computer";

if(isset($_POST['depositBtn'])){

    $deposit = $_POST["deposit"];
    $accountNumber = $_POST['accountNumber'];
$getcustomer = mysqli_query($conn, "select * from customers where accountNumber = '$accountNumber'");

$count = mysqli_num_rows($getcustomer);

if($count == 1){
while($row = mysqli_fetch_assoc($getcustomer)) {

    $fullname = $row['fullname'];
    $balance = $row['balance'];

    $newBalance = $balance + $deposit;

    $savedeposit = mysqli_query($conn, "insert into deposits (accountNumber, amount) 
    values('$accountNumber', '$deposit')");

    $updateBalance = mysqli_query($conn, "update customers set balance = '$newBalance' 
    where accountNumber ='$accountNumber'");

    if($updateBalance) {
        echo "Hello ".$fullname." Your Deposit of UGX ".$deposit." on Account Number ".$accountNumber."
         was successful your new balance is ".$newBalance;
    }
}

} else {
    echo "Invalid Account Number";
}





// $CustomersBalance = $CustomersBalance + $deposit;

// print "Your deposit of ".$CustomersBalance." UGX was sucessfully";

}
?>

<form action="" method="post">
<input type="text" name="accountNumber" placeholder="Enter Your Account Number"/>
<input type="text" name="deposit" placeholder="Enter the deposit Ammount"/>
<input type="submit" name="depositBtn" value="Deposit">
</form>