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
		<link rel="stylesheet" href="css/style-test.css">
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="../../js/script.js"></script>
		
	</head>
	<body>
        <div class="meniu" id="meniu">
            <div class = "submeniu">
                <form method="get">
                    <input type="text" class = "input_txt" name="cautare" placeholder="Cautare">
                    <button type="submit" class ="fa fa-search"></button>

                </form>
                <button class ="newfrm" onclick="show_forum_creator()">Creaza un topic nou!</button>
                <image src = "../../Image/ico-acc.png" class = "account" onclick="show_actiuni()">
            </div>
                
            <div class = "actiuni" id = "actiuni" style="display:none">
                <hr class = "despartitor">
                <div class="profil" onclick="window.location.href='/main.php?#'">Profil</div>
                <hr class = "despartitor1">
                <div class="youform" onclick="window.location.href='/main.php?#'">Forumurile tale</div>
                <hr class = "despartitor1">
                <div class="logout" onclick="window.location.href='../../script/logout.php'">Deconectare</div>
                <hr class = "despartitor2">
            </div>
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
                $cautare=$_GET['cautare'];
                if (!empty($_GET['cautare']) && isset($_GET['cautare'])){
                    $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
				    $sql = "Select * from forum_stats";
                    $result = mysqli_query($conectare, $sql);
                    $result_per_page = 9;
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
                        
                        $sql = "SELECT * FROM forum_stats WHERE title like '%$cautare%' LIMIT ". $this_page_first_result . ',' . $result_per_page;
                        
                        $result = mysqli_query($conectare, $sql);

                        for($page = 1; $page<=$number_f_page; $page++){
                            echo '<div class="pagination">';
                            echo '<a href="../../test.php?page=' . $page . '">' . $page . '</a>';
                            echo '</div>';
                        }
                        echo '<br> <br> <br>';
                        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                            $link = $row[1];
                            $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                            echo "<div class = 'afisare'>";
                                echo '<div class = "color" style = "background-color: '.$color.'"> </div>';
                                echo '<div class = "color_down" style = "background-color: '.$color.'"> </div>';
                                echo '<b style = "font-size:22px; font-weight: bold; padding-right:20px;">' . $row[2]  . "</b>";
                                echo "<button id = '$link' class='bt_redirect_form' value = '$link'>Acceseaza!</button>";
                                echo '<p class = "descp"">' . mb_strimwidth($row[3], 0, 200 , " ...");  //$row['index'] the index here is a field name
                                echo '<br>';
                            echo "</div>";
                            echo "<hr class = 'space'>";
                        }
                    }
                }   

                else{
                    $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
                    $sql = "Select * from forum_stats";
                    $result = mysqli_query($conectare, $sql);
                    $result_per_page = 9;
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
                        
                        $sql = "SELECT * FROM forum_stats LIMIT ". $this_page_first_result . ',' . $result_per_page;
                        
                        $result = mysqli_query($conectare, $sql);

                        for($page = 1; $page<=$number_f_page; $page++){
                            echo '<div class="pagination">';
                            echo '<a href="../../test.php?page=' . $page . '">' . $page . '</a>';
                            echo '</div>';
                        }
                        echo '<br> <br> <br>';
                        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                            $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                            $link = $row[1];
                            echo "<div class = 'afisare'>";
                                echo '<div class = "color" style = "background-color: '.$color.'"> </div>';
                                echo '<div class = "color_down" style = "background-color: '.$color.'"> </div>';
                                echo '<b class = "title-show" style = "font-size:20px; font-weight: bold;">' . $row[2]  . "</b>";
                                echo "<button id = '$link' class='bt_redirect_form' value = '$link' style = 'float: right;''>Acceseaza!</button>";
                                echo '<p class = "descp"">' . mb_strimwidth($row[3], 0, 200, " ..."); 
                                echo '<br>';
                            echo "</div>";
                            echo "<hr class = 'space'>";
                        }
            
                    }
                }
			?>
		</div>

        <div class = "stats">
            <div class = "ordonare">
            
            </div>
        </div>
        
        <script>
            var link;
            $(".bt_redirect_form").click(function() {
                link = $(this).val();
                sessionStorage['forumid'] = link;
                $(document).ready(function () {
                    createCookie("forumid", "forumid", "0");
                });
                document.cookie = escape("forumid") + "=" + escape(link) + "; path=/";
                //console.log(sessionStorage['forumid']);
                window.location.href = "../../forum.php";
            });
            
        </script>
    </body>
</html>