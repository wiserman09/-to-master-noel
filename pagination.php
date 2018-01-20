<?php
      $start_loop = 1;
      
      $start_from = 0;
      $query = "SELECT * FROM users ORDER BY id ASC";
      $conn = mysqli_connect("localhost", "root", "", "blog");
      $record_per_page = 4;
      //$total_records = 12;
      $result = mysqli_query($conn, $query);
      $total_records = mysqli_num_rows($result);
      $total_pages = ceil($total_records/$record_per_page);
      //$row =mysqli_fetch_row($conn);
     
      $sql = "SELECT * FROM users LIMIT 0,3 ";
      
      
      
      if(isset($_GET["page"]))
      {
       $page = $_GET["page"];
      }
      else
      {
       $page = 0;
      }
      $difference = $total_pages - $page;
     
      $start_from = ($page-1)*$record_per_page;
      
      $query = "SELECT * FROM users order by id   ASC LIMIT ".$start_from.", ".$record_per_page." ";
      $result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
 <head>
  
  <!DOCTYPE html>
<html>
<head>
  <title>blogsite</title>
  
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <script type=" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
  <script type="text/javascript src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="dist/simplePagination.css">
  <script src="dist/jquery.simplePagination.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
       
 </head>
  <body>
      <br /><br />
        <div class ="container">
          <div class="row">
            <div class="jumbotron text-center">
                <h1>My Blog</h1>
   
            </div>
          </div>
        </div>
        <div class="container">

            <div class="table-responsive">
                <table class="table table-bordered">
                        
                                        <tr>

                                            <td>title</td>
                                            <td>author</td>
                                            <td>content</td>
                                            <td>date_created</td>
                                            <td>date_modified</td>

                                        </tr>
                      <?php
                           
                            while($row = mysqli_fetch_array($result))
                           
                      {
                           
                      ?>
                                          <tr>
                                            <td><?php echo $row["title"]; ?></td>
                                            <td><?php echo $row["author"]; ?></td>
                                            <td><?php echo $row["content"]; ?></td>
                                            <td><?php echo $row["date_created"]; ?></td>
                                            <td><?php echo $row["date_modified"]; ?></td>
                                            <td>
                                                <a class="btn btn-info" href="edit.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                                 <a class="btn btn-danger" onclick="return confirm('Do you want to proceed?')" href="delete.php?id=<?php echo $row['id']; ?>"<a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>                                        
                                          </tr>
                     <?php
                     
                     }
                     
                     ?>
    
                </table>

                <div align="right"><br />
                    
                      <?php
                          

                        if($difference < 0)
                          
                          {
                     
                            $start_loop = $total_pages - 1;
                          
                          }
                    
                            $end_loop = $start_loop  + 5 ;
                            
                            

                            if($page < 1)
                    
                          {
                     
                            echo "<a href='pagination.php?page=1'>prev</a>";
                            
                          }
                            
                            for($i=$start_loop; $i<=$end_loop; $i++)
                            
                          {     
                     
                            echo "<a href='pagination.php?page=".$i."'>".$i."&nbsp &nbsp</a>";
                    
                          }
                          
                            if($page <= $end_loop)
                          
                          {
                            
                          
                          echo "<a href='pagination.php?page=".$end_loop."'>next</a>";
                          
                          }
                    
                    
                      ?>
                    </div>
                    
    
              <br /><br />
          </div>
      </div>
  </body>
</html>
 