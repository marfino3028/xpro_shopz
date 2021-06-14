<?php 
if (trim($row['foto'])=='' OR !file_exists("asset/foto_user/".$row['foto'])){
    echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/blank.png'>";
}else{
    echo "<img class='img-thumbnail' style='width:100%' src='".base_url()."asset/foto_user/$row[foto]'>";
}
?>