<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>iDiscuss</title>
</head>

<body>
    <?php
    include 'partials/_header.php';
    include 'partials/_dbconnect.php'
    ?>

    <?php 
     $id = $_GET['catid'];
     $sql = "SELECT * FROM `categories` WHERE category_id=$id ";
     $result = mysqli_query($conn, $sql);
     while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }

    ?>

    <?php 
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //insert thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
         VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Your Question is submitted || </strong> You can check question/answer below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }

    }
    ?>


    <!-- Category container starts here  -->
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums.</li>
                <li>Do not post copyright-infringing material.
                </li>
                <li>Do not post “offensive” posts, links or images.</li>
            </ul>

            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Lets Start!</a>
            </p>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
        echo '<div class="container">
        <h1 class="py-2">Ask your Question?</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title"
                    aria-describedby="emailHelp">
            </div>
            <input type="hidden" name="sno" value="'. $_SESSION['sno']. '">
                     
            <label for="floatingTextarea">Ellaborate your Concern</label>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }
    
  

    else{
        echo '  <div class="container">
        <p class="lead">You are not logged in Please login to start discussion.</p>
        </div>';
    }
    ?>

    <div class="container" id="ques">
        <h1 class="py-2">Browse Question Answer</h1>
    
    <?php 
     $id = $_GET['catid'];
     $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id ";
     $result = mysqli_query($conn, $sql);
     $noResult = true;
     while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $id =  $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 =  "SELECT  user_email FROM `users` WHERE sno='thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        

        echo '<div class="media my-3">
            <img src="img/pic.png" width="34px" align="left" alt="...">
            <div class="media-body my-3">'.
            '<h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' .$id. '">' .$title. '</a></h5>
            '. $desc . ' </div>'.'<p class="font-weight-bold my-0">' .$row2['user_email'] . ' at ' . $thread_time.
            '</p>'.
        '</div>';
    }
   // echo var_dump($noResult);

    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Result Found</p>
          <p class="lead">Be the First person to ask question</p>
        </div>
      </div>';
    }
    ?>

        <?php
    include 'partials/_footer.php';
    ?>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
            integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
            integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
        </script>

</body>

</html>