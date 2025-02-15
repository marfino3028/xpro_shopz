<header class="header header--Motore" data-sticky="true"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="navigation--Motore">
        <div class="navigation__left">
        <?php 
        $logo = $this->model_utama->view_ordering_limit('logo','id_logo','DESC',0,1);
        foreach ($logo->result_array() as $row) {
            echo "<a class='ps-logo' href='".base_url()."'><img src='".base_url()."asset/logo/$row[gambar]'/></a>";
        }
        ?>
        </div>
        <div class="navigation__right">
            <div class="header__actions">
                <?php 
                $cek_keranjang = $this->db->query("SELECT a.*, b.*, c.nama_reseller FROM rb_penjualan_temp a JOIN rb_produk b ON a.id_produk=b.id_produk JOIN rb_reseller c ON b.id_reseller=c.id_reseller where a.session='".$this->session->idp."' ORDER BY id_penjualan_detail ASC");
                $total = $this->db->query("SELECT sum((a.harga_jual-a.diskon)*a.jumlah) as total, sum(b.berat*a.jumlah) as total_berat FROM `rb_penjualan_temp` a JOIN rb_produk b ON a.id_produk=b.id_produk where a.session='".$this->session->idp."'")->row_array();
                echo "<div class='ps-cart--mini'><a class='header__extra' href='#'><i class='icon-bag2'></i><span><i class='show_cart_count'></i></span></a>
                        <div class='ps-cart__content'>
                            <div class='ps-cart__items'>
                                <div class='show_cart'></div>
                            </div>
                            <div class='ps-cart__footer'>
                                <div class='show_cart_button'></div>
                            </div>
                        </div>
                    </div>";
                ?>

                <div class="ps-block--user-header">
                    <?php if ($this->session->level == 'konsumen') { ?>
                        <div class="ps-block__left">
                            <a class='ps-toggle--sidebar' href='#search-sidebar'><i class="icon-user"></i></a>
                        </div>
                        <div class="ps-block__right">
                            <a href="<?php echo base_url(); ?>members/profile">Akun</a> 
                            <a href="<?php echo base_url(); ?>auth/logout">Logout</a>
                        </div>
                    <?php }else{ ?>
                        <div class="ps-block__left">
                            <a href='<?php echo base_url(); ?>auth/login'><i class="icon-user"></i></a>
                        </div>
                        <div class="ps-block__right">
                            <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">Login</a> 
                            <a href="<?php echo base_url(); ?>auth/login">Register</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-search--Motore">
        <form class="ps-form--search-Motore" action="<?php echo base_url() ?>produk" method="GET">
            <div class="form-group--nest">
                <input class="form-control" name='s' type="text" placeholder="Aku Mau Belanja..." required>
                <button type='submit'><i class="icon-magnifier"></i></button>
            </div>
        </form>
    </div>
</header>

<div class="navigation--list">
    <div class="navigation__content">
        <a class="navigation__item ps-toggle--sidebar" href="#menu-Motore"><i class="icon-menu"></i><span> Menu</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#navigation-Motore"><i class="icon-list4"></i><span> Kategori</span></a>
        <a class="navigation__item ps-toggle--sidebar" href="#cart-Motore"><i class="icon-bag2"></i><span> Keranjang</span></a>
        <?php 
            if ($this->session->id_konsumen!=''){
                echo "<a class='navigation__item ps-toggle--sidebar' href='#search-sidebar'><i class='icon-user'></i><span> Akun</span></a>";
            }else{
                echo "<a class='navigation__item ps-toggle--sidebar' href='#' data-toggle='modal' data-target='.bd-example-modal-lg'><i class='icon-user'></i><span> Akun</span></a>";
            }
        ?>
    </div>
</div>


<div class="ps-panel--sidebar" id="cart-Motore">
    <div class="ps-panel__header">
        <h3>Keranjang Belanja</h3>
    </div>
    <div class="navigation__content">
        <div class="ps-cart--Motore">
            <div class="ps-cart__content"><span class='m1keranjangx'>
                <?php 
                    $no = 1;
                    if ($cek_keranjang->num_rows() > 0) {
                        echo "<a style='padding:5px 10px; margin-bottom:10px' class='ps-btn ps-btn--outline ps-btn--fullwidth' href='".base_url()."produk/keranjang'>Lihat Keranjang</a>";
                    }
                    foreach ($cek_keranjang->result_array() as $row){
                    $sub_total = (($row['harga_jual']-$row['diskon'])*$row['jumlah']);
                    $ex = explode(';', $row['gambar']);
                    if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                        echo "<div class='ps-product--cart-Motore'>
                            <div class='ps-product__thumbnail'><a href='".base_url()."produk/detail/$row[produk_seo]'><img src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a></div>
                            <div class='ps-product__content'>
                            
                            <a class='ps-product__remove remove-produk-cart' style='cursor:pointer' id='remove-$row[id_penjualan_detail]' onclick=\"removecart('$row[id_penjualan_detail]',this.id)\"><i class='icon-cross'></i></a>
                            
                            <a href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>
                            <p style='border-bottom:1px dotted #cecece'><b>Qty.</b> <small>$row[jumlah] x <b>" . rupiah($row['harga_jual'] - $row['diskon']) . "</b></small></p>
                            
                            </div>
                        </div>";
                    }

                    if ($cek_keranjang->num_rows() <= 0) {
                        echo "<center style='padding:10px 15px'>
                        <img style='width:90px' src='".base_url()."asset/images/shopping-empty.png'><hr>
                        <h4>Wah keranjang belanjaanmu kosong!</h4>
                        Daripada dianggurin, mending isi dengan barang-barang impianmu. Yuk, cek sekarang!<br>
                        <a style='padding:5px 10px; margin-top:10px' class='ps-btn ps-btn--outline ps-btn--fullwidth' href='".base_url()."produk'>Mulai Belanja</a>
                        </center>";
                    }
                ?>
            </span></div>

        </div>
    </div>
</div>

<div class="ps-panel--sidebar" id="navigation-Motore">
    <div class="ps-panel__header">
        <h3>Product Category</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--Motore">
            <?php 
                $kategori =$this->db->query("SELECT * FROM rb_kategori_produk ORDER BY nama_kategori ASC");
                foreach ($kategori->result_array() as $rows) {
                    $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                    if ($sub_kategori->num_rows()>=1){
                        echo "<li class='current-menu-item menu-item-has-children has-mega-menu'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'>$rows[nama_kategori]</a> <span class='sub-toggle'></span> ";
                    }else{
                        echo "<li class='current-menu-item '><a href='".base_url()."produk/kategori/$rows[kategori_seo]'>$rows[nama_kategori]</a></li> ";
                    }

                    if ($sub_kategori->num_rows()>=1){
                        echo "<div class='mega-menu'>
                                <div class='mega-menu__column'>
                                    <ul class='menu--Motore'>";
                                        foreach ($sub_kategori->result_array() as $row) {
                                            
                                            $sub_kategori_third = $this->db->query("SELECT * FROM rb_kategori_produk_sub_third where id_kategori_produk_sub='$row[id_kategori_produk_sub]' ORDER BY nama_kategori_sub_third ASC");
                                            if ($sub_kategori_third->num_rows() >= 1){
                                                echo "<li class='current-menu-item menu-item-has-children has-mega-menu'><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$row[nama_kategori_sub]</a> <span class='sub-toggle'></span>";
                                                
                                                if ($sub_kategori_third->num_rows() >= 1){
                                                    echo "<div class='mega-menu'>
                                                            <div class='mega-menu__column'>
                                                                <ul class='menu--Motore'>";
                                                                    foreach ($sub_kategori_third->result_array() as $row_third) {
                                                                        echo "<li class='current-menu-item '><a href='".base_url()."produk/thirdsubkategori/$row_third[kategori_seo_sub_third]'>$row_third[nama_kategori_sub_third]</a></li>";
                                                                    }
                                                            echo "</ul>
                                                            </div>
                                                        </div>
                                                    </li>";
                                                }

                                            } else {
                                                echo "<li class='current-menu-item '><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$row[nama_kategori_sub]</a></li>";
                                            }

                                        }
                                echo "</ul>
                                </div>
                            </div>";
                    }
                    echo "</li>";
                }
            ?>
        </ul>
    </div>
</div>

<?php 
if ($this->session->id_konsumen!=''){ ?>
<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
        <h3>Menu Konsumen</h3>
    </div>
    <div class="navigation__content"></div>
    <div class="ps-panel__content">
    <ul class="menu--Motore">
        <?php 
            $data = array('Profile','Sosmed','Data Bank','Keuangan','Wishlist','Pembelian','PPOB','Jadi Kurir '.$pesanan_sopir.'');
            $link = array('profile','sosial_media','rekening_bank','withdraw','wishlist','orders_report','trx_pulsa','sopir');
            for ($i=0; $i < count($data); $i++) { 
                echo "<li class='current-menu-item'><a href='".base_url()."members/".$link[$i]."'>".$data[$i]."</a></li>";
            }
        echo "<li class='current-menu-item'><a href='" . base_url() . "komplain?s=pelapor'>Komplain <span class='badge badge-secondary' style='font-size:85%; background-color: #cecece; color:#000'>".$komplain_beli->num_rows()."</span></a></li>
              <li class='current-menu-item'><a style='color:red' href='".base_url()."auth/logout'>Logout</a></li>";
        ?>
    </ul>
    </div>
</div>
<?php } ?>

<div class="ps-panel--sidebar" id="menu-Motore">
    <div class="ps-panel__header">
        <h3>Menu Utama</h3>
    </div>
    <div class="ps-panel__content">
    <?php 
        function main_menu1() {
            $ci = & get_instance();
            $query = $ci->db->query("SELECT id_menu, nama_menu, link, id_parent FROM menu where aktif='Ya' AND position='Bottom' order by urutan");
            $menu = array('items' => array(),'parents' => array());
            foreach ($query->result() as $menus) {
                $menu['items'][$menus->id_menu] = $menus;
                $menu['parents'][$menus->id_parent][] = $menus->id_menu;
            }
            if ($menu) {
                $result = build_main_menu1(0, $menu);
                return $result;
            }else{
                return FALSE;
            }
        }

        function build_main_menu1($parent, $menu) {
            $ci = & get_instance();
            $html = "";
            if (isset($menu['parents'][$parent])) {
                if ($parent=='0'){
                    $html .= "<ul class='menu--Motore'>";
                }else{
                    $html .= "<ul class='sub-menu'>";
                }
                foreach ($menu['parents'][$parent] as $itemId) {
                    if (!isset($menu['parents'][$itemId])) {
                        if(preg_match("/^http/", $menu['items'][$itemId]->link)) {
                            $html .= "<li class='current-menu-item'><a target='_BLANK' href='".$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a></li>";
                        }else{
                            $html .= "<li class='current-menu-item'><a href='".base_url().''.$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a></li>";
                        }
                    }
                    if (isset($menu['parents'][$itemId])) {
                        if(preg_match("/^http/", $menu['items'][$itemId]->link)) {
                            $html .= "<li class='menu-item-has-children has-mega-menu'><a target='_BLANK' href='".$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a> <span class='sub-toggle'></span>";
                        }else{
                            $html .= "<li class='menu-item-has-children'><a href='".base_url().''.$menu['items'][$itemId]->link."'>".$menu['items'][$itemId]->nama_menu."</a> <span class='sub-toggle'></span>";
                        }
                        $html .= build_main_menu1($itemId, $menu);
                        $html .= "</li>";
                    }
                }

                if ($parent=='0'){
                    if ($ci->session->level=='konsumen'){ 
                        if (reseller($ci->session->id_konsumen)!=''){
                            $html .= "<li class='menu-item-has-children'><a href='#'> Menu Toko</a> <span class='sub-toggle'></span>
                                    <ul class='sub-menu'>
                                        <li class='current-menu-item'><a href='".base_url()."members/profil_toko'><i class='fa fa-gears'></i> Pengaturan</a></li>
                                        <li class='current-menu-item'><a href='".base_url()."members/produk'><i class='fa fa-th'></i> Daftar Produk</a></li>
                                        <li class='current-menu-item'><a href='".base_url()."members/alamat_cod'><i class='fa fa-map-marker'></i> Alamat COD</a></li>
                                        <li class='current-menu-item'><a href='".base_url()."members/pembelian'><i class='fa fa-reorder'></i> Orders Pusat</a></li>
                                        <li class='current-menu-item'><a href='".base_url()."members/pembelian'><i class='fa fa-warning'></i> Komplain</a></li>
                                        <li class='current-menu-item'><a href='".base_url()."members/penjualan'><i class='fa fa-list-alt'></i> Orders Masuk</a></li>
                                        <li class='current-menu-item'><a href='".base_url()."members/upgrade'><i class='fa fa-star text-yellow'></i> <span class='blink_me'>Upgrade Toko</span></a></li>
                                    </ul>
                            </li>";
                        }else{
                            $html .= "<li class='current-menu-item'><a href='".base_url()."members/buat_toko'>Buat Toko</a></li>";
                        }
                    } 
                }
                $html .= "</ul>";
            }
            return $html;
        }
        echo main_menu1();
    ?>

    </div>
</div>