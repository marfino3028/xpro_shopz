<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
	  	$('.dropdown-menu a').click(function(e){
	  		e.preventDefault();
	        if($(this).next('.submenu').length){
	        	$(this).next('.submenu').toggle();
	        }
	        $('.dropdown').on('hide.bs.dropdown', function () {
			   $(this).find('.submenu').hide();
			})
	  	});
	}
	
}); // jquery end
</script>
<style type="text/css">
        .dropdown-menu li{
			position: relative;
		}
		.nav-item .submenu{ 
			display: none;
			position: absolute;
			left:100%; 
            top:-1px;
		}
		.nav-item .submenu-left{ 
			right:100%; left:auto;
		}

		.dropdown-menu > li:hover{ background-color: #f1f1f1 }
		.dropdown-menu > li:hover > .submenu{
			display: block;
		}
</style>



    <nav class="navigation">
    <div class="ps-container">
        <div class="navigation__left">
            <div class="menu--product-categories">
                <a class=" menu__toggle nav-link" href="#" data-toggle="dropdown"><i class="icon-menu"></i><span> Product Category</span></a>
                    <div class="menu__content">
                        <ul class="menu--dropdown">
                            <li class="nav-item dropdown">
                                <!--<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Product Category</a>-->
                                <ul class="dropdown-menu" style="font-size: 10pt; margin-top: -40px;">
                                    <?php 
                                    $kategori = $this->model_app->view_ordering('rb_kategori_produk','nama_kategori','ASC');
                                    foreach ($kategori as $rows) {
                                        if ($rows['icon_kode']!=''){
                                            $icon = "<i class='$rows[icon_kode]'></i>";
                                        }elseif ($rows['icon_image']!=''){
                                            $icon = "<img style='width:18px; height:18px; margin-right:10px' src='".base_url()."asset/foto_produk/$rows[icon_image]'>";
                                        }else{
                                            $icon = "";
                                        }

                                        $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                                        if ($sub_kategori->num_rows()>=1) {
                                            echo "<li><a class='dropdown-item' href='".base_url()."produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori] <span class='caret caret-right'></span></a>";
                                            if ($sub_kategori->num_rows()>=30){
                                                $total1 = ceil($sub_kategori->num_rows()/2);
                                                $total2 = floor($sub_kategori->num_rows()/2);
                                                $sub_kategori1 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT 0,$total1");
                                                $sub_kategori2 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT $total1,$total2");
                                                echo "<ul class='submenu dropdown-menu' style='font-size: 10pt;'>";
                                                        foreach ($sub_kategori1->result_array() as $row) { 
                                                            if ($row['icon_kode']!=''){
                                                                $icons = "<i class='$row[icon_kode]'></i>";
                                                            }elseif ($row['icon_image']!=''){
                                                                $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";
                                                            }else{
                                                                $icons = "";
                                                            }
                                                            echo "<li><a class='dropdown-item' href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";
                                                        }
                                                echo "</ul>";

                                                echo "<ul class='submenu dropdown-menu' style='font-size: 10pt;'>";
                                                        foreach ($sub_kategori2->result_array() as $row) { 
                                                            if ($row['icon_kode']!=''){
                                                                $icons = "<i class='$row[icon_kode]'></i>";
                                                            }elseif ($row['icon_image']!=''){
                                                                $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";
                                                            }else{
                                                                $icons = "";
                                                            }
                                                            echo "<li><a class='dropdown-item' href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub] </a></li>";
                                                        }
                                                echo "</ul>";
                                            }else{
                                                echo "<ul class='submenu dropdown-menu' style='font-size: 10pt;'>";
                                                foreach ($sub_kategori->result_array() as $row) { 
                                                    if ($row['icon_kode']!=''){
                                                        $icons = "<i class='$row[icon_kode]'></i>";
                                                    }elseif ($row['icon_image']!=''){
                                                        $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";
                                                    }else{
                                                        $icons = "";
                                                    }

                                                    $sub_kategori_third = $this->db->query("SELECT * FROM rb_kategori_produk_sub_third where id_kategori_produk_sub='$row[id_kategori_produk_sub]' ORDER BY nama_kategori_sub_third ASC");
                                                    if($sub_kategori_third->num_rows()>=1){
                                                        $icon_panah = "&raquo";
                                                    } else {
                                                        $icon_panah = "";
                                                    }
                                                    echo "<li><a class='dropdown-item' href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub] $icon_panah</a>";
                                                    if ($sub_kategori_third->num_rows()>=1) {
                                                        echo "<ul class='submenu dropdown-menu' style='font-size: 10pt;'>";
                                                        foreach ($sub_kategori_third->result_array() as $row_third) {
                                                            if ($row_third['icon_kode']!='') {
                                                                $icons = "<i class='$row_third[icon_kode]'></i>";
                                                            } elseif ($row_third['icon_image']!='') {
                                                                $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row_third[icon_image]'>";
                                                            } else {
                                                                $icons = "";
                                                            }
                                                            echo "<li><a class='dropdown-item' href='".base_url()."produk/thirdsubkategori/$row_third[kategori_seo_sub]'>$icons $row_third[nama_kategori_sub_third]</a></li>";
                                                        }
                                                        echo "</ul>";
                                                    }
                                                    
                                                }
                                                echo "</li></ul>";
                                            }
                                        }else{
                                            echo "<li><a class='dropdown-item' href='".base_url()."produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori]</a></li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>

                            <?php /*
                            $kategori = $this->model_app->view_ordering('rb_kategori_produk','nama_kategori','ASC');
                            foreach ($kategori as $rows) {
                                if ($rows['icon_kode']!=''){
                                    $icon = "<i class='$rows[icon_kode]'></i>";
                                }elseif ($rows['icon_image']!=''){
                                    $icon = "<img style='width:18px; height:18px; margin-right:10px' src='".base_url()."asset/foto_produk/$rows[icon_image]'>";
                                }else{
                                    $icon = "";
                                }
                                $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                                if ($sub_kategori->num_rows()>=1){
                                    echo "<li class='current-menu-item menu-item-has-children has-mega-menu'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori] <span class='caret caret-right'></span></a>
                                            <div class='mega-menu'>";
                                            if ($sub_kategori->num_rows()>=30){
                                                $total1 = ceil($sub_kategori->num_rows()/2);
                                                $total2 = floor($sub_kategori->num_rows()/2);
                                                $sub_kategori1 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT 0,$total1");
                                                $sub_kategori2 = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY id_kategori_produk_sub ASC LIMIT $total1,$total2");
                                                echo "<div class='mega-menu__column'>
                                                        <ul class='mega-menu__list'>";
                                                        foreach ($sub_kategori1->result_array() as $row) { 
                                                            if ($row['icon_kode']!=''){
                                                                $icons = "<i class='$row[icon_kode]'></i>";
                                                            }elseif ($row['icon_image']!=''){
                                                                $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";
                                                            }else{
                                                                $icons = "";
                                                            }
                                                            echo "<li class='current-menu-item'><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";
                                                        }
                                                echo "</ul>
                                                </div>";

                                                echo "<div class='mega-menu__column'>
                                                        <ul class='mega-menu__list'>";
                                                        foreach ($sub_kategori2->result_array() as $row) { 
                                                            if ($row['icon_kode']!=''){
                                                                $icons = "<i class='$row[icon_kode]'></i>";
                                                            }elseif ($row['icon_image']!=''){
                                                                $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row[icon_image]'>";
                                                            }else{
                                                                $icons = "";
                                                            }
                                                            echo "<li class='current-menu-item'><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$icons $row[nama_kategori_sub]</a></li>";
                                                        }
                                                echo "</ul>
                                                </div>";
                                            }else{
                                                echo "<ul class='mega-menu__list'>";
                                                        foreach ($sub_kategori->result_array() as $row_sub) { 
                                                            if ($row_sub['icon_kode']!=''){
                                                                $icons = "<i class='$row_sub[icon_kode]'></i>";
                                                            }elseif ($row_sub['icon_image']!=''){
                                                                $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row_sub[icon_image]'>";
                                                            }else{
                                                                $icons = "";
                                                            }
                                                            echo "<li class='current-menu-item '><a href='".base_url()."produk/subkategori/$row_sub[kategori_seo_sub]'>$icons $row_sub[nama_kategori_sub]</a></li>";
                                                            
                                                            echo "<div class='mega-menu'>
                                                                    <div class='mega-menu__column'>
                                                                        <ul class='mega-menu__list'>";
                                                                            $sub_kategori_third = $this->db->query("SELECT * FROM rb_kategori_produk_sub_third where id_kategori_produk_sub='$row_sub[id_kategori_produk_sub]' ORDER BY nama_kategori_sub_third ASC");
                                                                            foreach ($sub_kategori_third->result_array() as $row_st) { 
                                                                                if ($row_st['icon_kode']!=''){
                                                                                    $icons = "<i class='$row_st[icon_kode]'></i>";
                                                                                }elseif ($row_st['icon_image']!=''){
                                                                                    $icons = "<img style='width:18px; height:18px' src='".base_url()."asset/foto_produk/$row_st[icon_image]'>";
                                                                                }else{
                                                                                    $icons = "";
                                                                                }
                                                                                echo "<li class='current-menu-item'><a href='".base_url()."produk/subkategori/$row_st[kategori_seo_sub_third]'>$icons $row_st[nama_kategori_sub_third]</a></li>";
                                                                            }
                                                                    echo "</ul>
                                                                    </div>
                                                                </div>";
                                                        }
                                                    echo "</ul>";
                                            }
                                            echo "</div>
                                        </li>";
                                }else{
                                    echo "<li class='current-menu-item'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'> $icon $rows[nama_kategori]</a></li>";
                                }
                            }
                        */?>
                        </ul>
                    </div>
            </div>
        </div>
        <div class="navigation__right">
        <?php 
                function main_menu() {
                    $ci = & get_instance();
                    $query = $ci->db->query("SELECT id_menu, nama_menu, link, id_parent FROM menu where aktif='Ya' AND position='Bottom' order by urutan");
                    $menu = array('items' => array(),'parents' => array());
                    foreach ($query->result() as $menus) {
                        $menu['items'][$menus->id_menu] = $menus;
                        $menu['parents'][$menus->id_parent][] = $menus->id_menu;
                    }
                    if ($menu) {
                        $result = build_main_menu(0, $menu);
                        return $result;
                    }else{
                        return FALSE;
                    }
                }
        
                function build_main_menu($parent, $menu) {
                    $html = "";
                    if (isset($menu['parents'][$parent])) {
                        if ($parent=='0'){
                            $html .= "<ul class='menu'>";
                        }else{
                            $html .= "<ul class='sub-menu'>";
                        }
                        foreach ($menu['parents'][$parent] as $itemId) {
                            if (!isset($menu['parents'][$itemId])) {
                                if(preg_match("/^http/", $menu['items'][$itemId]->link)) {
                                    $html .= "<li class='current-menu-item'><a target='_BLANK' href='".$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a><span class='sub-toggle'></span></li>";
                                }else{
                                    $html .= "<li class='current-menu-item'><a href='".base_url().''.$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a><span class='sub-toggle'></span></li>";
                                }
                            }
                            if (isset($menu['parents'][$itemId])) {
                                if(preg_match("/^http/", $menu['items'][$itemId]->link)) {
                                    $html .= "<li class='menu-item-has-children'><a target='_BLANK' href='".$menu['items'][$itemId]->link."'><span>".$menu['items'][$itemId]->nama_menu."</span></a>";
                                }else{
                                    $html .= "<li class='menu-item-has-children'><a href='".base_url().''.$menu['items'][$itemId]->link."'><span>".$menu['items'][$itemId]->nama_menu."</span></a>";
                                }
                                $html .= build_main_menu($itemId, $menu);
                                $html .= "</li>";
                            }
                        }
                        $html .= "</ul>";
                    }
                    return $html;
                }
                echo main_menu();
            ?>
            <ul class="navigation__extra">
                <?php 
                    $topmenu = $this->model_utama->view_where_ordering_limit('menu',array('position' => 'Top','aktif' => 'Ya'),'urutan','ASC',0,5);
                    foreach ($topmenu->result_array() as $row) {
                        if(preg_match("/^http/", $row['link'])) {
                            echo "<li><a href='$row[link]'>$row[nama_menu]</a></li>";
                        }else{
                            echo "<li><a href='".base_url()."$row[link]'>$row[nama_menu]</a></li>";
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>