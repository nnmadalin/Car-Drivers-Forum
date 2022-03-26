<?php
session_start();
$val = $_COOKIE["sort"];
error_reporting(E_ERROR | E_PARSE);
$cautare=$_COOKIE["cautat"];;
if (!empty($cautare) && isset($cautare)){
    $conectare = mysqli_connect('localhost', 'root', '', 'platforma_car');
	$sql = "Select * from forum_stats";
    $result = mysqli_query($conectare, $sql);
    $result_per_page = 9;
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
        $result = mysqli_query($conectare, $sql);
        $result_per_page = 9;
        $number_result = mysqli_num_rows($result);
    if ($result == null){
        echo "<div class = 'b1'<b>". "Nu am gasit forumuri!!" . "</b> </div>";
    }else{	
        $number_f_page = ceil($number_result / $result_per_page);
        if (!isset($_POST['page'])){
            $page = 1;
        }else{
            $page = $_POST['page'];
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
            echo "<div class = 'afisare'>";
                echo '<div class = "color" style = "background-color: '.$color.'"> </div>';
                echo '<div class = "color_down" style = "background-color: '.$color.'"> </div>';
                echo '<b class = "title-show" style = "font-size:20px; font-weight: bold;">' . $row[2]  . "</b>";
                echo "<form action = 'forum.php?forumid=".$row[0]."' method='post'>";
                echo "<button class='bt_redirect_form' id='bt_redirect_form' value = '$link' style = 'float: right;''>Acceseaza!</button>";
                echo "</form>";
                echo '<p class = "descp"">' . mb_strimwidth($row[3], 0, 150, " ..."); 
                echo '<br>';
            echo "</div>";
            echo "<hr class = 'space'>";
        }
        
        
    }
}
?>
