<?php
    session_start();
    if (session_id() == '' || !isset($_SESSION['login'])){
        header("Location: ../login.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>All for the cars!</title>
		<link rel="icon" href="Image/icon.png" type="icon/png">
		<link rel="stylesheet" href="css/style-main.css">
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="../../js/script.js"></script>
		
	</head>
	<body>
        

        <div class="meniu" id="meniu">
            <div class = "submeniu">
                <input type="text" class = "input_txt" id = "input_txt" name="cautare" placeholder="Cautare">
                <button type="submit" class ="fa fa-search" onclick="vale()"></button>
                <script>
                    function vale(){
                        var input = document.getElementById("input_txt").value;
                        document.cookie = escape("cautat") + "=" + escape(input) + "; path=/";
                        document.cookie = escape("sort") + "=" + escape("1") + "; path=/";
                        window.location.href = "../../main.php";
                    }
                </script>
                <button class ="newfrm" onclick="show_forum_creator()">Creaza un topic nou!</button>
                <image src = "../../Image/ico-acc.png" class = "account" id = "account" >
            </div>
                
            <div class = "actiuni" id = "actiuni" style="display:none">
                <hr class = "despartitor">
                <div class="main" onclick="window.location.href='/main.php'">Meniu Principal</div>
                <hr class = "despartitor">
                <div class="profil" onclick="window.location.href='/main.php?#'">Profil</div>
                <hr class = "despartitor1">
                <div class="youform" onclick="window.location.href='/myforum.php'">Forumurile tale</div>
                <hr class = "despartitor1">
                <div class="logout" onclick="window.location.href='../../script/logout.php'">Deconectare</div>
                <hr class = "despartitor2">
            </div>
            <script>
                $(document).ready(function(){
                    $("#account").click(function(){
                        $("#actiuni").slideToggle("medium");;
                    });
                });
            </script>
        </div>

        <div id="forum-create" style="display:none">
            <form class="form" method="POST" action="script/newforum.php">
                <div class="div_titlu">
                    <image class = "iconn" onclick="show_forum_creator()" src="../../Image/ico-x.png"></image>
                    <p class="text-in">Titlu:<p>
                    <input type="text" class="titlu" id="titlu" placeholder="Titlu" name="titlu">
                </div>

                <div class="div_descriere">
                    <p class="text-inin">Descriere:<p>
                    <textarea  type="text" class="descriere" id="descriere" placeholder="Descriere" name="descriere"></textarea >
                </div>

                <div class="div_public">
                    <p class="text-in">Articolul va fi public pentru toata lumea?<p>
                    <label class="container">Da
                        <input type="radio" checked="checked" name="radio" value="1">
                        <span class="checkmark"></span>
                    </label>
                                    
                    <label class="container">Nu
                        <input type="radio" name="radio" value="2">
                        <span class="checkmark"></span>
                    </label>
                </div>


                <div class="div_button">
                    <button type="submit" class="text-subb" value="Submit">Creaza forum</button>
                </div>
            </form>
        </div>

        <div class="div_show" id = "div_show">
            <?php
            error_reporting(E_ERROR | E_PARSE);
            $val = $_COOKIE["sort"];
            if (empty($val) && !isset($val))
                $val = 1;
            $cautare=$_COOKIE["cautat"];
            if (!empty($cautare) && isset($cautare)){
                $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
                $sql = "Select * from forum_stats";
                $result = mysqli_query($conectare, $sql);
                $result_per_page = 8;
                $number_result = mysqli_num_rows($result);
                if ($result == null){
                    echo "<div class = 'b1'<b>". "Nu am gasit forumul cautat!!" . "</b> </div>";
                }else{
                    $number_f_page = ceil($number_result / $result_per_page);
                    if (!isset($_POST['page'])){
                        $page = 1;
                    }else{
                        $page = $_POST['page'];
                    }
                        $this_page_first_result = ($page-1) * $result_per_page;
                        if($val == 1){
                            $sql = "Select * from forum_stats WHERE title like '%$cautare%' LIMIT ". $this_page_first_result . ',' . $result_per_page;
                        }
                        else if($val == 2){
                            $sql = "Select * from forum_stats WHERE title like '%$cautare%' ORDER BY id DESC LIMIT ". $this_page_first_result . ',' . $result_per_page;
                        }
                        else{
                            $sql = "Select * from forum_stats WHERE title like '%$cautare%' LIMIT ". $this_page_first_result . ',' . $result_per_page;;
                        }
                        
                        $result = mysqli_query($conectare, $sql);
                        for($page = 1; $page<=$number_f_page; $page++){
                            echo '<div class="pagination">';
                                echo '<a href="../../main.php?page=' . $page . '">' . $page . '</a>';
                            echo '</div>';
                        }
                        echo '<br> <br>';
                        echo '<p class="aicautat">Ai cautat: <b>'.$cautare.'</b></p>';
                        echo '<br>';
                        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                            $link = $row[1];
                            $color = $row[7];
                            echo "<div class = 'afisare'>";
                                echo '<div class = "color" style = "background-color: '.$color.'"> </div>';
                                echo '<div class = "color_down" style = "background-color: '.$color.'"> </div>';
                                echo '<b style = "font-size:22px; font-weight: bold; padding-right:20px;">' . $row[2]  . "</b>";
                                echo "<button id = '$link' class='bt_redirect_form' id='bt_redirect_form' value = '$link'>Acceseaza!</button>";
                                echo '<p class = "descp"">' . mb_strimwidth($row[3], 0, 200 , " ...");  //$row['index'] the index here is a field name
                                echo '<br>';
                            echo "</div>";
                            echo "<hr class = 'space'>";
                        }
                    }
            }   
            else{
                $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
                if($val == 1){
                    $sql = "Select * from forum_stats";
                }
                else if($val == 2){
                    $sql = "Select * from forum_stats ORDER BY id DESC";
                }
                else{
                    $sql = "Select * from forum_stats";
                }
                $sql = "Select * from forum_stats";
                $result = mysqli_query($conectare, $sql);
                $result_per_page = 8;
                $number_result = mysqli_num_rows($result);

                if ($result == null){
                    echo "<div class = 'b1'<b>". "Nu am gasit forumuri!!" . "</b> </div>";
                }else{	
                    $number_f_page = ceil($number_result / $result_per_page);
                    if (!isset($_GET['page'])){
                        $page = 1;
                    }else{
                        $page = $_GET['page'];
                    }
                    $this_page_first_result = ($page-1) * $result_per_page;           
                    if ($val == 2){
                        $sql = "SELECT * FROM forum_stats ORDER BY id DESC LIMIT ". $this_page_first_result . ',' . $result_per_page;
                    }
                    else if ($val == 1){
                        $sql = "SELECT * FROM forum_stats LIMIT ". $this_page_first_result . ',' . $result_per_page;
                    }
                    

                    $result = mysqli_query($conectare, $sql);

                    for($page = 1; $page<=$number_f_page; $page++){
                        echo '<div class="pagination">';
                            echo '<a href="../../main.php?page=' . $page . '">' . $page . '</a>';
                        echo '</div>';
                    }
                    echo '<br> <br> <br>';
                    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                        $color = $row[7];
                        $link = $row[1];
                        echo "<div class = 'afisare'>";
                            echo '<div class = "color" style = "background-color: '.$color.'"> </div>';
                            echo '<div class = "color_down" style = "background-color: '.$color.'"> </div>';
                            echo '<b class = "title-show" style = "font-size:20px; font-weight: bold;">' . $row[2]  . "</b>";
                            echo "<button class='bt_redirect_form' id='bt_redirect_form' value = '$link' style = 'float: right;''>Acceseaza!</button>"; 
                            echo '<p class = "descp"">' . mb_strimwidth($row[3], 0, 150, " ..."); 
                            echo '<br>';
                        echo "</div>";
                        echo "<hr class = 'space'>";
                    }
                    
                    
                }
            }
            ?>
        </div>

        <div class = "stats" id="stats">
            <p class = "stats-txt">Ordonare dupa:</p>
            <div class = "ordonare">
                    <label class="container2">Cele mai recente
                        <input id = "radio" class = "radio" type="radio" name="radio2" checked="checked" onclick="val1()" <?php if($_COOKIE["sort"] == 1) {echo "checked='checked'";}?>>
                        <span class="checkmark2"></span>
                    </label>
                    <label class="container2">Cele mai vechi
                        <input id = "radio"  class = "radio" type="radio"  name="radio2" value="2" onclick="val2()" <?php if($_COOKIE["sort"] == 2) {echo "checked='checked'";} ?>>
                        <span class="checkmark2"></span>
                    </label>
                    <label class="container2">Cele mai populare
                        <input id = "radio" class = "radio" type="radio" name="radio2" value="3" onclick="val3()" <?php if($_COOKIE["sort"] == 3) {echo "checked='checked'";}?>>
                        <span class="checkmark2"></span>
                    </label>
                    <button class ="resetare" onclick="val4()">Reseteaza</button>
                    <script>
                        var value;
                        function val1(){
                            document.cookie = escape("sort") + "=" + escape('1') + "; path=/";
                            window.location.href = "../../main.php";
                        }
                        function val2(){
                            document.cookie = escape("sort") + "=" + escape('2') + "; path=/";
                            window.location.href = "../../main.php";
                        }
                        function val3(){
                            document.cookie = escape("sort") + "=" + escape('3') + "; path=/";
                            window.location.href = "../../main.php";
                        }
                        function val4(){
                            document.cookie = escape("sort") + "=" + escape('1') + "; path=/";
                            document.cookie = escape("cautat") + "=" + escape('') + "; path=/";
                            window.location.href = "../../main.php";
                        }
                        //document.cookie = escape("sort") + "=" + escape(check) + "; path=/";
                            
                    </script>
            </div>
            <p class = "stats-txt">Statistici:</p>
            <p class = "stats-txt-info">Forumuri create: 
                <?php
                    $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
				    $sql = "Select * from forum_stats";
                    $result = mysqli_query($conectare, $sql);
                    $number_result = mysqli_num_rows($result);
                    echo '<b>'.$number_result.'</b>';
                ?>
            </p>
            <p class = "stats-txt-info">Conturi create:
                <?php
                    $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
				    $sql = "Select * from users";
                    $result = mysqli_query($conectare, $sql);
                    $number_result_user = mysqli_num_rows($result);
                    echo '<b>'.$number_result_user.'</b>';
                ?>
            </p>

            <script>
                var link;
                $(".bt_redirect_form").click(function() {
                    link = $(this).val();
                    document.cookie = escape("forumid") + "=" + escape(link) + "; path=/";
                    window.location.href = "../../forum.php";
                });
            </script>                
        </div>
    </body>
</html>