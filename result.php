<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['username'])&&!empty($_POST['username'])){
        $username=$_POST['username'];
        $url="https://uhunt.onlinejudge.org/api/uname2uid/$username";
        $result=json_decode(file_get_contents($url),true);
        if(isset($result)&&!empty($result)){
            $userIdURL="https://uhunt.onlinejudge.org/api/subs-user/$result";
            $data=json_decode(file_get_contents($userIdURL),true);
            $name=$data['name'];
        }
        else{
            echo "<h1>Sorry, This user name is not exist.</h1>>"."<br>";
            echo "<a href='search.php'>Go Back</a>";
        }
    }
    else{
        echo "<h1>Please, Enter a valid user name.</h1>>";
        echo "<a href='search.php'>Go Back</a>";
    }
}
else{

    echo "<h1>Sorry, You are not allowed to open this page directly.</h1>>";
    echo "<a href='search.php'>Go Back</a>";
}

function VerdictId($id){
    switch ($id){
        case 10:
            return "Submission error";
            break;
        case 30:
            return "Compile error";
            break;
        case 40:
            return "Runtime error";
            break;
        case 45:
            return "Output limit";
            break;
        case 50:
            return "Time limit";
            break;
        case 60:
            return "Memory limit";
            break;
        case 70:
            return "Wrong answer";
            break;
        case 90:
            return "Accepted";
            break;
        default:
            return $id;
            break;
    }
}
function langID($id){
    switch ($id){
        case 1:
            return "ANSI C";
            break;
        case 2:
            return "Java";
            break;
        case 3:
            return "C++";
            break;
        case 4:
            return "Pascal";
            break;
        case 5:
            return "C++11";
            break;
        default:
            return "error";
            break;
    }
}
?>

<html>
<head>
    <meta charset="x-UTF-16LE-BOM">
    <title>UVA APP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/CodeEliteStyle.css">

</head>
<body>
    <section class="data">
            <div class="desc">
                <h3>Subs of <?php echo $name;?></h3>
            </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <?php

                    foreach ($data['subs'] as $key=>$value){
                        $verdict = VerdictId($value[2]);
                        $lang=langID($value[5]);
                        $date = gmdate("d/m/Y H:i", $value[4]);
                        echo"
                            <div class=\"card text-center col-md-4 data\">
                                <div class=\"card-header\">
                                    <h5>SubId: $value[0]</h5>
                                </div>
                                <div class=\"card-body\">
                                    <h3 class=\"card-title\">Problem Id: $value[1]</h3>
                                    <h5>Verdict: $verdict</h5>
                                    <h5>Runtime: $value[3] ms</h5>
                                    <h5>Date: $date</h5>
                                    <h5>Language: $lang</h5>
                                </div>
                                <div class=\"card-footer text-muted\">
                                    <h5>Rank: $value[6]</h5>
                                </div>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </section>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>


