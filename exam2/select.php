<?php
 $con=mysqli_connect("localhost","holaspot_student","student","holaspot_helloworld");
 // Check connection
 if (mysqli_connect_errno())
   {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

 $result = mysqli_query($con,"SELECT * FROM Persons");

 echo "<table border='1'>
 <tr>
 <th>Firstname</th>
 <th>Lastname</th>
 </tr>";

 while($row = mysqli_fetch_array($result))
   {
   echo "<tr>";
   echo "<td>" . $row['FirstName'] . "</td>";
   echo "<td>" . $row['LastName'] . "</td>";
   echo "</tr>";
   }
 echo "</table>";

 mysqli_close($con);
 ?> 
