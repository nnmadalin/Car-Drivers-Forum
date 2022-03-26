<?php
    session_start();
    if (session_id() == '' || !isset($_SESSION['login'])){
        header("Location: ../login.php");
    }
    $_COOKIE["sort"] = "1";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>All for the cars!</title>
		<link rel="icon" href="Image/icon.png" type="icon/png">
		<link rel="stylesheet" href="css/style-myforum.css">
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
                        document.cookie = escape("cautat2") + "=" + escape(input) + "; path=/";
                        document.cookie = escape("sort") + "=" + escape("1") + "; path=/";
                        window.location.href = "../../myforum.php";
                    }
                </script>
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

        <div class="div_show" id = "div_show">
            <?php
            error_reporting(E_ERROR | E_PARSE);
            $name = $_SESSION["login"];
            $val = $_COOKIE["sort"];
            $cautare=$_COOKIE["cautat2"];
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
                    if (!isset($_GET['page'])){
                        $page = 1;
                    }else{
                        $page = $_GET['page'];
                    }
                        $this_page_first_result = ($page-1) * $result_per_page;
                        if($val == 1){
                            $sql = "Select * from forum_stats WHERE title like '%$cautare%' and name_creator = '$name' LIMIT ". $this_page_first_result . ',' . $result_per_page;
                        }
                        else if($val == 2){
                            $sql = "Select * from forum_stats WHERE title like '%$cautare%' and name_creator = '$name' ORDER BY id DESC LIMIT ". $this_page_first_result . ',' . $result_per_page;
                        }
                        else{
                            $sql = "Select * from forum_stats WHERE title like '%$cautare%' and name_creator = '$name' LIMIT ". $this_page_first_result . ',' . $result_per_page;;
                        }
                        
                        $result = mysqli_query($conectare, $sql);
                        for($page = 1; $page<=$number_f_page; $page++){
                            echo '<div class="pagination">';
                                echo '<a href="../../myforum.php?page=' . $page . '">' . $page . '</a>';
                            echo '</div>';
                        }
                        echo '<br> <br>';
                        echo '<p class="aicautat">Ai cautat: <b>'.$cautare.'</b></p>';
                        echo '<br>';
                        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                            $link = $row[1];
                            $color = $row[7];
                            echo "<div class = 'afisare' id = 'afisare'>";
                                echo '<div class = "color" style = "background-color: '.$color.'"> </div>';
                                echo '<div class = "color_down" style = "background-color: '.$color.'"> </div>';
                                echo '<b style = "font-size:22px; font-weight: bold; padding-right:20px;">' . $row[2]  . "</b>";
                                echo "<button id = '$link' class='bt_redirect_form' id='bt_redirect_form' value = '$link'>Acceseaza!</button>";
                                echo '<p class = "descp"">' . mb_strimwidth($row[3], 0, 100 , " ...");  //$row['index'] the index here is a field name
                                echo '<br>';
                            echo "</div>";
                            echo "<hr class = 'space'>";
                        }
                    }
            }   
            else{
                $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
                if($val == 1){
                    $sql = "Select * from forum_stats WHERE name_creator = '$name'";
                }
                else if($val == 2){
                    $sql = "Select * from forum_stats WHERE name_creator = '$name' ORDER BY id DESC";
                }
                else{
                    $sql = "Select * from forum_stats WHERE name_creator = '$name'";
                }
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
                        $sql = "Select * FROM forum_stats WHERE name_creator = '$name' ORDER BY id DESC LIMIT ". $this_page_first_result . ',' . $result_per_page;
                    }
                    else if ($val == 1){
                        $sql = "Select * from forum_stats WHERE name_creator = '$name' LIMIT ". $this_page_first_result . ',' . $result_per_page;;
                    }
                                    
                    $result = mysqli_query($conectare, $sql);

                    for($page = 1; $page<=$number_f_page; $page++){
                        echo '<div class="pagination">';
                            echo '<a href="../../myforum.php?page=' . $page . '">' . $page . '</a>';
                        echo '</div>';
                    }
                    echo '<br> <br> <br>';
                    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                        $color = $row[7];
                        $link = $row[1];
                        echo "<div class = 'afisare' id = 'afisare'>";
                                echo '<div class = "color" style = "background-color: '.$color.'"> </div>';
                                echo '<div class = "color_down" style = "background-color: '.$color.'"> </div>';
                                echo '<b class = "title-show" style = "font-size:20px; font-weight: bold;">' . $row[2]  . "</b>";
                                echo "<button  onclick = 'show_forum_information()' class='bt-info-edit' id='bt-info-edit' name = 'bt-info-edit' value = '$link' style = 'float: right;''>Informatii!</button>"; 
                                echo "<button class='bt_redirect_form' id='bt_redirect_form' value = '$link' style = 'float: right;''>Acceseaza!</button>";
                                echo '<p class = "descp"">' . mb_strimwidth($row[3], 0, 100, " ..."); 
                                echo '<br>';
                        echo "</div>";
                        echo "<hr class = 'space'>";

                        echo "<div class = 'forum-info' id = '$link' style='display:none'>";
                            echo '<p class = "title">   Titlu:</p>';
                            echo '<div class="title_show">';
                                echo $row[2];
                            echo '</div>';
                            
                            echo '<p class = "descriere">Descriere:</p>';
                            echo '<div class="descriere_show">';
                                echo $row[3];
                            echo '</div>';
                
                            echo '<p class = "data">Adaugat in:</p>';
                            echo' <div class="data_show">';
                                echo $row[4];
                            echo '</div>';
                
                            echo '<p class = "privat">Privat:</p>';
                            echo '<div class="privat_show">';
                                if ($row[6] == 0)
                                    echo "Nu";
                                else
                                    echo 'Da';
                            echo '</div>';
                
                            echo '<p class = "change-privat">Schimba?</p>';
                
                        echo '</div>';
                    }
                    
                }
            }
            ?>
        </div>

        <script>
            var link;
            $(".bt-info-edit").click(function() {
                link = $(this).val();
                var x = document.getElementById(link);
                //x.style.display = "block";
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else if (x.style.display === "block") {
                    x.style.display = "none";	
                }
            });
        </script>

           
        
    </body>
</html>