<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bookingstyle.css">
</head>

<body>
    <h1>Customer Booking System</h1>
    <div class="y">
    <form name="form" >
        <br> Name:<input type="text" name="cname" id="1" class="1"><br />
        <br>Phone Number:<input type="text" name="phone" maxlength="12" minlength="10" id="2" class="1"><br />
        <br>Unit Number:<input type="number" name="unnumber" id="3" class="1"><br />
        <br>Street Number:<input type="number" name="snumber" id="4" class="1" ><br />
        <br>Street Name:<input type="text" name="stname" id="5" class="1" required="required"><br />
        <br>Suburb:<input type="text" name="sbname" id="6" class="1"><br />
        <br>Destination Suburb:<input type="text" name="dsbname" id="7" class="1"><br />

        <br>Pick-up Date:<input type="text" name="PickDate" id="today" class="1"><br />

        <br>Pick-up Time:<input type="text" name="PickTime" id="today1" class="1"> <br />
        <td width="100"><input type="submit" value="Post" id="submit" onclick="myFunction();return false;"></td>
    <td width="100"><input type="reset" value="Reset" id="pp"></td>
    </form>
    </div>
    <div>
        <p name='reference'></p>
    </div>
    <script type="text/javascript">
    // There we get the current date function which is today();
        function today() {
            var today = new Date();
            var y = today.getFullYear();
            var m = today.getMonth() + 1;
            var d = today.getDate();
            if (m < 10) {
                m = "0" + m;
            }
            if (d < 10) {
                d = "0" + d;
            }
            return d + "-" + m + "-" + y;
        }
        //There we get the current time function which is today1();
        function today1() {
            var today = new Date();
            var H = today.getHours();
            var M = today.getMinutes();
            if (H < 10) {
                H = "0" + H;
            }
            if (M < 10) {
                M = "0" + M;
            }
            return H + ":" + M;
        }
        document.getElementById("today").value = today().toLocaleString();
         document.getElementById("today1").value = today1().toLocaleString();

    
        // this function is to send all form data use xhr.
        function myFunction() {
            const p = document.querySelector('p');
        // We use this regular expression to limit length of phone number between 10-12.
            var reg = /^[0-9]{10,12}$/;
            var cc = document.getElementById("2").value;
            var qqq = today1().toLocaleString();
            var date1 = today();
            var date2 = document.getElementById("today").value;
            var regg = new RegExp("-","g");
            var a = date1.replace(regg,"");
            var b = date2.replace(regg,"");
            var c = Number(a);
            var d = Number(b);
        // the following is alert when something does not meet the requirements,
        //  if so, your form data will not be able to posted.
            if ( document.getElementById("1").value=="")
            {
            alert('Please input client name');
        }
            else if(document.getElementById("2").value=="" || reg.test(cc)==false){
                alert('Please input phone number with length between 10-12');
            }
            else if(document.getElementById("4").value==""){
                alert('Please input street number');
            }
            else if(document.getElementById("5").value==""){
                alert('Please input street name');
            }
            else if(document.getElementById("today").value==""){
                alert('Please input pick-up date');
            }
            // else if((parseInt(timet.value)*10000) < (parseInt(today())*10000)){
            //     alert('You can not input earlier date!');
            // }
            else if(c>d){
                alert('You can not input earlier date!');
            }
            else if(document.getElementById("today").value==""){
                alert('Please input pick-up date');
            }
            else if(document.getElementById("today1").value=="" ){
                alert('Please input pick-up time');
            }
            else if(document.getElementById("today1").value<qqq){
                alert('You can not input previous time!');
            }

else{
    // Here we marked all the class label which class name is 1.
    var elements = document.getElementsByClassName("1");
            
            var formData = new FormData();
            // There we use for loop to get all values of what we have marked.
            for (var i = 0; i < elements.length; i++) {
                formData.append(elements[i].name, elements[i].value);
            }
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (xmlHttp.readyState == 4 && xmlHttp.status >= 200) {
                    p.innerHTML = xmlHttp.responseText;
                }
            }
            xmlHttp.open("POST", "bookingSystem.php");
            xmlHttp.send(formData);
}  
        }

    </script>

    

 



</body>

</html>

<?php
$sql_host = "cmslamp14.aut.ac.nz";
$sql_user = "yxn9194";
$sql_pass = "mr.liu1009.";
$sql_db = "yxn9194";


$q = $_POST['cname'];
$w = $_POST['phone'];
$e = $_POST['unnumber'];
$r = $_POST['snumber'];
$t = $_POST['stname'];
$y = $_POST['sbname'];
$u = $_POST['dsbname'];
$i = $_POST['PickDate'];
$o = $_POST['PickTime'];

	// Here we get the current day and time as booking day and booking time, 
	// for each posted booking from the users, the current booking day and
	// current booking will be recorded automatically in the database.    

$currentDateTime = date('d-m-Y');
date_default_timezone_set('Pacific/Auckland');
$currentDateTime1 = date_default_timezone_get();
$currentDateTime1 = date('H:i');

$conn = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
if ($conn->connect_error) {
    die("connection fail:" . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS assign2(
			bookingNumber int(30) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			cname VARCHAR(30) NOT NULL,
			phoneNumber VARCHAR(30) NOT NULL,
			unitNumber int(20) NOT NULL,
			streetNumber int(20) NOT NULL,
			streetName VARCHAR(30) NOT NULL,
			suburb VARCHAR(30) NOT NULL,
			destinationSuburb VARCHAR(30) NOT NULL,
			pickUpDate VARCHAR(30) NOT NULL,
			pickUpTime VARCHAR(30) NOT NULL,
			status1 VARCHAR(30) NOT NULL,
			bookingDate VARCHAR(30) NOT NULL,
			bookingTime VARCHAR(30) NOT NULL
			)ENGINE=InnoDB DEFAULT CHARSET=utf8";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Create table failed: " . $conn->error;
}


$sql = "INSERT INTO assign2 (cname,phoneNumber,unitNumber,streetNumber,streetName,suburb,destinationSuburb,pickUpDate,pickUpTime,status1,bookingDate,bookingTime ) VALUES ('$q','$w','$e','$r','$t','$y','$u','$i','$o','unassigned','$currentDateTime','$currentDateTime1')";
mysqli_query($conn, $sql);
$sql1 = "SELECT bookingNumber FROM assign2 WHERE cname = '$q'";
$data1 = mysqli_query($conn, $sql1);

if (isset($data1)) {
    // $result = mysqli_query($con, $query) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($data1, MYSQLI_BOTH)) {
        $id['bookingNumber'] = $row['bookingNumber'];
       
    }

    echo 'Thank you! Your booking reference number is ' . $id['bookingNumber'] . '. You will be picked up in front of your provided address at ' . $o . ' on ' . $i . '.';
} else {
    echo "error";
}

?>
