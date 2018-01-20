<?php

require_once('config.php');


$id=$_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM users where id = '$id'" );
      while($row = mysqli_fetch_assoc($result)){

  if (isset($_POST['update'])){

    $title =$_POST['title']; 
    $author = $_POST['author'];
    $content = $_POST['content'];

    $sql = "UPDATE users SET title='$title', author='$author', content='$content' WHERE id= '$id'";

    if ($conn->query($sql) === TRUE) {
    
    } 
    else {
      echo "Error updating record: " . $conn->error;
    }


  }



?>

<html>
<head>
                <title>blogsite</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
               
</head>
            <div class="container-fluid">
                <form class="form-inline" method="post" action="edit.php<?php echo '?id='.$id; ?>" enctype="multipart/form-data" style="text-align: center;">
                    
                  <table class="table table-bordered"> 
                        <div class="control-group">
                            <label class="control-label">title:</label>
                                <div class="controls">
                                    <input type="text" name="title" value="<?php echo $row['title']; ?>">
                                </div>
                        </div>
                            
                        <div class="control-group">
                            <label class="control-label">author:</label>
                                <div class="controls">
                                    <input type="text" name="author" value="<?php echo $row['author']; ?>"> 
                                </div>
                        </div>
                                                        
                        <div class="control-group">
                            <label class="control-label">content:</label>
                                <div class="controls">
                                    <input type="text" name="content"  value="<?php echo $row['content']; ?>">
                                </div>
                        </div>
                                                        
                                                        
                        <div class="control-group"><br>
                            <div class="controls">
                                <button type="submit" name="update" class="btn btn-success" style="text-align: left; 100px;">Save</button>
                                        <a href="index.php" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </table>
                </form>
             </div>

 
 </html>
<?php } ?>