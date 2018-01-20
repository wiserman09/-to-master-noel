    <?php
        
            include("config.php");

            //$limit = $_GET['limit'];
            $search = $_GET['search'];

            $query = "SELECT * FROM users WHERE id='".$search."' OR title LIKE '%".$search."%' OR author LIKE '%".$search."%' OR content LIKE '%".$search."'";
            $result = $conn->query($query);
            // echo "<pre>";
            // var_dump($result->fetch_assoc());
            // echo "</pre>"; 
            // exit;

            //$total_pages = mysql_fetch_array(mysql_query($result));
            //header("Location:index.php");
    ?>
            
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

                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
                <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
                <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
               
            </head>
        <body>     
        
            <div class ="container">
                <div class="jumbotron text-center">
                    <h1>My Blog</h1>
                </div>
                            
                <table class="table table-bordered">
                        <thead>
                              
                            <tr>
                                <th>ID</th>
                                <th>TITLE</th>
                                <th>AUTHOR</th>
                                <th>CONTENT</th>
                                <th>DATE_CREATED</th>
                                <th>DATE_MODIFIED</th>
                                <th colspan="2">Action</th>
                            </tr>
                            
                        </thead>
                    <tbody>

                    <?php
                                
                        $row = $result->fetch_assoc();
                        $count=0;

                            if(count($row) > 0) {

                                do {
                                      
                                $id = $row['id'];
                                $title = $row['title'];
                                $author = $row['author'];
                                $content = $row['content'];
                                $date_created = $row['date_created'];
                                $date_modified = $row['date_modified'];
                    ?>
                    
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $author; ?></td>
                                <td><?php echo $content; ?></td>
                                <td><?php echo $date_created; ?></td>
                                <td><?php echo $date_modified; ?></td>
                                          
                                <td>
                                    <a class="btn btn-info" href="edit.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="btn btn-danger" onclick="return confirm('Do you want to proceed?')" href="delete.php?id=<?php echo $row['id']; ?>"<a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                                  
                    <?php
                            $count++;
                        } 
                            while(count($row) < $count);
                    
                        }
                    
                    ?>
                    </tbody> 
                </table>
                            
                    <div class="col-lg-2"></div>

            </div>
        </body>
    </html>

    <?php

        exit;

        $total_pages = $total_pages['num'];

        $stages = 3;
        $page = mysql_escape_string($_GET['page']);

            if($page) {
            
                $start = ($page - 1) * $limit; 
            
            } 
                else {
            
                $start = 0; 

            }

                // Get page data
                    $query1 = "SELECT * FROM $title WHERE jobtitle LIKE '%$id%' LIMIT $start, $limit";
                        $result = mysql_query($query1);

                        // Initial page num setup
                            
                            if ($page == 0){$page = 1;}
                                $prev = $page - 1;  
                                $next = $page + 1;  
                                $lastpage = ceil($total_pages/$limit);  
                                $LastPagem1 = $lastpage - 1;    
                                $paginate = '';
                    
                            if($lastpage > 1)
                    
                            {       
                    
                                $paginate .= "<div class='paginate'>";
                            // Previous

                            if ($page > 1){
                    
                            $paginate.= "<a href='$targetpage?page=$prev'>Previous</a>";
                            
                            } else {
                            $paginate.= "<span class='disabled'>Previous</span>";   

                            }
                            // Pages    
                            if ($lastpage < 7 + ($stages * 2))  // Not enough pages to breaking it up
                            
                            {   

                            for ($counter = 1; $counter <= $lastpage; $counter++)
                            
                            {

                            if ($counter == $page){
                            $paginate.= "<span class='current'>$counter</span>";
                            
                            } else {
                            
                            $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}    
                            
                            }
                            
                            }
                    
                            else if ($lastpage > 5 + ($stages * 2))   // Enough pages to hide a few?
                            
                            {
                                // Beginning only hide later pages
                            if ($page < 1 + ($stages * 2))   
                            
                            {

                            for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
                            
                            {

                            if ($counter == $page) {
                            $paginate.= "<span class='current'>$counter</span>";
                    
                            } else {
                            $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}    
                            
                            }
                                $paginate.= "...";
                                $paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
                                $paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
                            }
                                // Middle hide some front and some back
                            else if ($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
                            
                            {

                            $paginate.= "<a href='$targetpage?page=1'>1</a>";
                            $paginate.= "<a href='$targetpage?page=2'>2</a>";
                            $paginate.= "...";
                            for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
                            
                            {
                    
                            if ($counter == $page) {
                            $paginate.= "<span class='current'>$counter</span>";
                            
                            } else {
                            $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}    
                            
                            }
                            $paginate.= "...";
                            $paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
                            $paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
                            }
                                        // End only hide early pages
                            else
                            {

                            $paginate.= "<a href='$targetpage?page=1'>1</a>";
                            $paginate.= "<a href='$targetpage?page=2'>2</a>";
                            $paginate.= "...";
                                            
                            for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
                            {
                            
                            if ($counter == $page){
                            $paginate.= "<span class='current'>$counter</span>";
                            
                            } else {
                            $paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}
                            
                            }
                            
                            }       
                            
                            }       
                                            // Next
                            if ($page < $counter - 1){ 
                            $paginate.= "<a href='$targetpage?page=$next'>Next</a>";
                            } else {
                            
                            $paginate.= "<span class='disabled'>Next</span>";
                            
                            }
                            
                            $paginate.= "</div>";   
                            }

                            if(mysqli_num_rows($result) >0){
                            while($row = mysqli_fetch_array($result)) {
                                        /*echo "<table>";
                                echo "<tr > <td>Job Title:</td> <td>{$row['jobtitle']} </td>     
                            </tr>".
                                    "<tr > <td>Job Description: </td> <td>        
                            {$row['jobdescription']}</td> </tr> ".
                                    "<br>";
                                echo "</table>"; */
                            }
                            
                            }

    ?>