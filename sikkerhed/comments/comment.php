<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
//load comments from database?
//put comments in a list
//display comments in a table?
//?
//profit
$querycomment = "SELECT * from Comments";
$result = mysqli_query($conn, $querycomment);
?>
<!DOCTYPE html>
<html>
<head>
 <title>comment page</title>
 <link href="style.css" rel="stylesheet" type="text/css">
 <style media="screen">
   th,
   td {
     border-bottom: 1px solid #ddd;
   }
   tr:hover {background-color: #f5f5f5;}
 </style>
</head>
<body>
  <!-- insert comment-->
  <form class="" action="addcomment.php" method="post">
    <input name="comment" type="text" onfocus="this.value=''" value="Write your comment here...">
    <input type="submit" value ="add comment"></input>
  </form>

  <table>
    <tbody>
      <tr>
        <th>
          username
        </th>
        <th>
          comment
        </th>
        <?php
        if ($userprivilege=='admin') {
            echo "<th>
          delete
        </th>";
        } else {
            echo "<th>
            report
          </th>";
        }
        ?>
      <th>
        Edit own comment
      </th>
      </tr>
      <?php
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            if ($userprivilege=='admin') {
              echo "<form action='deletecomment.php' method='post'>
              <input type='hidden' name='id' value=".$row['Id']."></input>
              <input type='hidden' name='author' value=".$row['author']."></input>
              <tr>
                <td>
                  ".$row['author']."
                </td>
                <td>
                  ".$row['comment']."
                </td>
                </form>
                <form action='editcomment.php' method='post'>
              <input type='hidden' name='id' value=".$row['Id']."></input>
              <td>
              <input type='text' value=".$row['comment']." name='newcomment'><input type='submit' value='submit'>
              </td>
              </tr>
              </form>";
            }else if($row['author']==$user_check) {
                echo
                "<form action='reportcomment.php' method='post'>
                <input type='hidden' name='id' value=".$row['Id']."></input
                <tr>
                <td>
                ".$row['author']."
                </td>
                <td>
                ".$row['comment']."
                </td>
                <td>
                <input type='submit' value='report'></input>
                </td>
                </tr>
                </form>";
              }else {
                  echo
          "<form action='reportcomment.php' method='post'>
          <input type='hidden' name='id' value=".$row['Id']."></input
          <tr>
            <td>
              ".$row['author']."
            </td>
            <td>
              ".$row['comment']."
            </td>

            <td>
              <input type='submit' value='report'></input>
            </td>
            </form>
            <form action='editcomment.php' method='post'>
          <input type='hidden' name='id' value=".$row['Id']."></input>
          <input type='hidden' name='oldcomment' value=".$row['comment']."></input>
          <td>
          <input type='text' value=".$row['comment']." name='newcomment'><input type='submit' value='submit'>
          </td>
          </tr>
          </form>";
              }
          }
      }
      ?>
    </tbody>
  </table>
 </div>
</body>
</html>
