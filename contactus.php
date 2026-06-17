<!-- <html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>
<body>
<h2>Contact Us</h2>
  
  <form class="form" action="contactform.php" method="POST">
    
    <p class="username">
      <input type="text" name="name" id="name" placeholder="Enter your name" >
      <label for="name">Name</label>
    </p>
    
    <p class="useremail">
      <input type="text" name="email" id="email" placeholder="mail@example.com" >
      <label for="email">Email</label>
    </p>
    
    <p class="usercontact">
      <input type="text" name="contact" id="contact" placeholder="contact no." >
      <label for="contact">Phone number</label>
    </p>    
  
    <p class="usertext">
      <textarea name="text" placeholder="Write something to us" ></textarea>
                        <label for="text">Comments</label>
    </p>
    
    <p class="usersubmit">
      <input type="submit" name="submit" value="Send" >
    </p>
  </form>
</body>
</html> -->

<form method="post" action ="#" bgcolor="blue">
  
<table cellspacing="2">
<tr>
<td> EMP ID : <td> <input type="text" name="eno" >
</tr>
<tr>
<td> EMP Name: <td> <input type="text" name="enm" >
</tr>
<tr>
<td> <input type="submit" name="btnsub" value="Send Feedback">
<td> <input type="submit" name="btnup" value="Update Feedback">
<td> <input type="submit" name="btndel" value="Delete Feedback">
<td> <input type="submit" name="btndis" value="Display Feedback">
<td> <input type="submit" name="btnasc" value="Display Ascending">
<td> <input type="submit" name="btndesc" value="Display Decending">
</tr>
</table>
</form>
<?php
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"jewelry_db");
    
if(isset($_POST["btnsub"]))
{
$eno=$_POST["eno"];
$ename=$_POST["enm"];
$q="insert into contact values($eno,'$ename')";
$t=mysqli_query($con,$q);
if($t)
echo "<br> 1 record inserted";
}
else if(isset($_POST["btnup"]))
{
$eno=$_POST["eno"];
$ename=$_POST["enm"];
$q="update emp set empname='$ename' where empid=$eno";
$t=mysqli_query($con,$q);
if($t)
echo "<br> 1 record updated";
}
else if(isset($_POST["btndel"]))
{
$eno=$_POST["eno"];
$ename=$_POST["enm"];
$q="delete from emp where empid=$eno";
$t=mysqli_query($con,$q);
if($t)
echo "<br> 1 record deleted";
}
else if(isset($_POST["btndis"]))
{
$q="select * from contact";
$res=mysqli_query($con,$q);
//for fetching individual record from a result set
echo "<table border='3'>";
echo "<tr>";
echo "<td> Employee ID";
echo "<td> Employee Name";
echo "</tr>";
while($row=mysqli_fetch_array($res))
{
echo "<tr>";
echo "<td>".$row[0];
echo "<td>".$row[1];
echo "</tr>";
}
echo "</table>";
}
else if(isset($_POST["btnasc"]))
{
$q="select * from emp order by empname";
$res=mysqli_query($con,$q);
//for fetching individual record from a result set
echo "<table border='3'>";
echo "<tr>";
echo "<td> Employee ID";
echo "<td> Employee Name";
echo "</tr>";
while($row=mysqli_fetch_array($res))
{
echo "<tr>";
echo "<td>".$row[0];
echo "<td>".$row[1];
echo "</tr>";
}
echo "</table>";
}
else if(isset($_POST["btndesc"]))
{
$q="select * from emp order by empname desc";
$res=mysqli_query($con,$q);
//for fetching individual record from a result set
echo "<table border='3'>";
echo "<tr>";
echo "<td> Employee ID";
echo "<td> Employee Name";
echo "</tr>";
while($row=mysqli_fetch_array($res))
{
echo "<tr>";
echo "<td>".$row[0];
echo "<td>".$row[1];
echo "</tr>";
}
echo "</table>";
}
?>