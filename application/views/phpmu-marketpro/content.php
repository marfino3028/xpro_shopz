<div id="homepage-1">
    <div class="ps-container d-none d-sm-block" style='margin-top:10px'>
    <?php 
        echo $this->session->flashdata('message'); 
              $this->session->unset_userdata('message');

        if ($maps!=''){
        echo "<div class='ps-block--site-features' style='margin-top:10px; background-color:#fff; border: none; padding: 10px 0px;'>";
        if ($this->uri->segment(1)=='' OR $this->uri->segment(1)=='main'){
            echo "<form class='col-md-12' style='padding-right:0px; padding-left:0px' method='POST' action='".base_url()."main/proses'>
            <div class='form-row'>
            <div style='margin-bottom:0px' class='col-md-4 form-group'>
              <input type='number' name='tujuan' class='form-control' placeholder='Masukkan Nomor Handphone,..' required>
            </div>
            
            <div style='margin-bottom:0px' class='col-md-3 form-group'>
              <select name='operator' class='form-control' id='operator' required>
              <option value=''>- Pilih Operator -</option>";
              foreach($operator->data as $item){
                if ($item->pembeliankategori_id=='1'){
                  if ($item->status=='0'){ $status = 'disabled'; }else{ $status = ''; }
                  echo "<option value='".$item->id."' $status>".$item->product_name."</option>";
                }
              }
              echo "</select>
            </div>
            
            <div style='margin-bottom:0px' class='col-md-3 form-group'>
              <select name='produk' class='form-control' id='produk' required>
                <option value=''>- Pilih Produk -</option>
              </select>
            </div>
            
            <div style='margin-bottom:0px' class='col-md-2 form-group'>
              <button type='submit' name='submit' style='padding:9px 12px' class='ps-btn ps-btn--fullwidth spinnerButton'>Beli Pulsa</button>
            </div>
            </form>
            </div>
            <div style='clear:both'></div>";
        }
    echo "</div>";
    }
    ?>
    </div>

    <div class="ps-home-banner ps-home-banner--1" style='padding-top:20px'>
        <div class="ps-container">
            <div class="ps-section__left">
                <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php 
                        $slide1 = $this->db->query("SELECT * FROM slide ORDER BY id_slide ASC");
                        foreach ($slide1->result_array() as $row) {
                            if ($row['gambar'] ==''){ $foto_slide = base_url()."asset/foto_berita/no-image.jpg"; }else{ $foto_slide = base_url()."asset/foto_slide/$row[gambar]"; }
                            $judul = $row['keterangan'];
                            echo "<div class='ps-banner'><a title='$judul' href='".base_url()."auth/login'><img class='preview' loading='lazy' src='$foto_slide' alt='$row[gambar]'></a></div>"; 
                            $no++;
                        }
                    ?>
                </div>
            </div>
            <div class="ps-section__right d-none d-sm-block">
            <?php
            $pasangiklan2 = $this->model_utama->view_ordering_limit('pasangiklan','id_pasangiklan','ASC',0,2);
            foreach ($pasangiklan2->result_array() as $b) {
                $string = $b['gambar'];
                if ($b['gambar'] != ''){
                    if(preg_match("/swf\z/i", $string)) {
                        echo "<embed class='ps-collection preview' loading='lazy' src='".base_url()."asset/foto_pasangiklan/$b[gambar]' quality='high' type='application/x-shockwave-flash'>";
                    } else {
                        echo "<a class='ps-collection' href='$b[url]' target='_blank'><img class='preview' loading='lazy' src='".base_url()."asset/foto_pasangiklan/$b[gambar]' alt='$b[judul]' /></a>";
                    }
                }
            }
            ?>
            </div>
        </div>
    </div>

    <div class="ps-top-categories d-block d-sm-none" style='margin-top:20px'>
        <div class="ps-container">
            <div class="row" style='margin-right:10px; margin-left:10px;'>
                <?php 
                    $top_kategori = $this->db->query("SELECT * FROM (SELECT a.*, b.jumlah FROM
                                        (SELECT * FROM rb_kategori_produk) as a LEFT JOIN
                                        (SELECT z.id_kategori_produk, COUNT(*) jumlah FROM rb_penjualan_detail y JOIN rb_produk z ON y.id_produk=z.id_produk GROUP BY z.id_kategori_produk HAVING COUNT(z.id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk) as x ORDER BY x.jumlah DESC LIMIT 8");
                    foreach($top_kategori->result_array() as $row){
                        $icon = "<i style='font-size:36px' class='$row[icon_kode]'></i>";
                        echo "<div class='col-xl-2 col-lg-3 col-md-4 col-sm-4 col-3' style='padding-right:10px; padding-left:10px;'>
                                <div class='ps-block--category' style='padding:30px 10px; border-radius:20px; border:1px solid #d2d2d2; color:#000; margin-bottom:60px;'>
                                    <a style='margin-top:15px; height:80%                                    ' class='ps-block__overlay' href='".base_url()."produk/kategori/$row[kategori_seo]'>
                                        $icon <p style='font-size:11px; padding-top:15px'>$row[nama_kategori]</p>
                                    </a>
                                </div>
                              </div>";
                    }
                ?>
            </div>
        </div><center><a class="ps-toggle--sidebar btn-custom" href="#navigation-Motore"><i class="icon-list4"></i><span> Tampilkan Semua Kategori</span></a></center><br>
        
    </div>

    <div class="ps-site-features d-none d-sm-block">
        <div class="ps-container">
            <div class="ps-block--site-features ps-block--site-features-2">
            <?php 
                $banner = $this->model_app->view_where_ordering_limit('banner',array('posisi'=>'top'),'id_banner','DESC',0,4);
                foreach ($banner->result_array() as $row) {
                    echo "<div class='ps-block__item'>
                            <div class='ps-block__left'><i class='$row[icon]'></i></div>
                            <div class='ps-block__right'>
                                <h4>$row[judul]</h4>
                                <p>$row[keterangan]</p>
                            </div>
                          </div>";
                }
            ?>
            </div>
        </div>
    </div>
    <?php 
        /* Aktifkan Flash Deal Tiap Hari
        $idn = $this->db->query("SELECT flash_deal FROM identitas where id_identitas='1'")->row_array();
        $kini = new DateTime('now');  
        $besok = date('Y-m-d', strtotime('+1 days'));
        $kemarin = new DateTime($besok.' 00:00:00');
        $tanggal = $kemarin->diff($kini)->format('%a:%h:%i:%s'); 
        $date1 = date('Y-m-d');
        $date2 = $besok;
        if(selisih_waktu_run($date1,$date2)>='1'){ */

        $idn = $this->db->query("SELECT flash_deal FROM identitas where id_identitas='1'")->row_array();
        $kini = new DateTime('now');  
        $kemarin = new DateTime($idn['flash_deal'].' 00:00:00');
        $tanggal = $kemarin->diff($kini)->format('%a:%h:%i:%s'); 

        $date1 = date('Y-m-d');
        $date2 = $idn['flash_deal'];
        if(selisih_waktu_run($date1,$date2)>='1'){
    ?>
    <div class="ps-deal-of-day">
        <div class="ps-container">
            <div class="ps-section__header">
                <div class="ps-block--countdown-deal">
                    <div class="ps-block__left">
                        <h3 class='penawaran'>Penawaran Berakhir</h3>
                    </div>
                    <div class="ps-block__right">
                        <figure>
                            <figcaption></figcaption>
                            <span style='display:none' id='berakhir'><?php echo $tanggal; ?></span>
                            
                            <ul class="ps-countdown d-none d-sm-block" data-time="">
                                <li><span class="days"></span> Hari</li>
                                <li><span class="hours"></span> Jam</li>
                                <li><span class="minutes"></span> Menit</li>
                                <li><span class="seconds"></span> Detik</li>
                            </ul>
                            
                            <ul class="ps-countdown d-block d-sm-none" data-time="">
                                <li><span class="days"></span> Hari </li>
                                <li><span class="hours"></span> Jam </li>
                                <li><span class="minutes"></span> Menit </li>
                                <li><span class="seconds"></span> </li>
                            </ul>
                            
                        </figure>
                    </div>
                </div><a class='d-none d-sm-block' href="<?php echo base_url(); ?>produk">All</a>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="5" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                    <?php 
                        $produk = $this->model_reseller->produk_flashdeal(0,0,10);
                        foreach ($produk->result_array() as $row){
                            $ex = explode(';', $row['gambar']);
                            if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                            if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }
                            $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                            $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();

                            $disk = $this->model_app->view_where("rb_produk_diskon",array('id_produk'=>$row['id_produk']))->row_array();
                            $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)." %";

                            if ($beli['beli']-$jual['jual']<=0){ 
                                $stok = "<div class='ps-product__badge out-stock'>Habis Terjual</div>"; 
                                $diskon_persen = ''; 
                                $persentase = 0;
                            }else{ 
                                $stok = ""; 
                                if ($diskon>0){ 
                                    $diskon_persen = "<div class='ps-product__badge'>$diskon</div>"; 
                                }else{
                                    $diskon_persen = ''; 
                                }
                                $persentase = ($jual['jual']/$beli['beli'])*100;
                            }
                
                            if ($diskon>=1){ 
                                $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del>".rupiah($row['harga_konsumen'])."</del>";
                            }else{
                                $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                            }
                            $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                            echo "<div class='ps-product ps-product--inner'>
                                    <div class='ps-product__thumbnail'>
                                    <a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                                        $diskon_persen
                                        $stok
                                        <ul class='ps-product__actions produk-$row[id_produk]'>
                                            <li><a href='".base_url()."produk/detail/$row[produk_seo]' data-toggle='tooltip' data-placement='top' title='Read More'><i class='icon-bag2'></i></a></li>
                                            <li><a href='#' data-toggle='tooltip' data-placement='top' title='Quick View' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i></a></li>";
                                            if ($cek_save>='1'){
                                                echo "<li><a data-toggle='tooltip' data-placement='top' title='Add to Whishlist'><i style='color:red' class='icon-heart'></i></a></li>";
                                            }else{
                                                echo "<li><a data-toggle='tooltip' data-placement='top' id='save-$row[id_produk]' title='Add to Whishlist'><i class='icon-heart' onclick=\"save('$row[id_produk]',this.id)\"></i></a></li>";
                                            }
                                        echo "</ul>
                                    </div>
                                    <div class='ps-product__container'>
                                        
                                        <p class='ps-product__price sale'>$harga_produk</p>
                                        <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                            <div class='ps-product__rating'>
                                            <select class='ps-rating' data-read-only='true'>".rate_bintang($row['id_produk'])."</select>
                                            </div>
                                            <div class='ps-product__progress-bar ps-progress' data-value='$persentase'>
                                                <div class='ps-progress__value'><span></span></div>
                                                <p>Terjual : ".rupiah($jual['jual'])." / ".rupiah($beli['beli'])."</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                
                          
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ echo "<span style='display:none' id='berakhir'></span>"; } ?>
    
    <div class="ps-home-ads d-none d-sm-block">
        <div class="ps-container">
            <div class="row">
                <?php
                $iklantengah = $this->db->query("SELECT * FROM iklantengah where judul like 'home%'");
                foreach ($iklantengah->result_array() as $b) {
                    $string = $b['gambar'];
                    if ($b['gambar'] != ''){
                        if(preg_match("/swf\z/i", $string)) {
                            echo "<div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 '><embed loading='lazy' class='ps-collection preview' src='".base_url()."asset/foto_iklantengah/$b[gambar]' quality='high' type='application/x-shockwave-flash'></div>";
                        } else {
                            echo "<div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 '><a loading='lazy' class='ps-collection preview' href='$b[url]' target='_blank'><img class='preview' loading='lazy' src='".base_url()."asset/foto_iklantengah/$b[gambar]' alt='$b[judul]' /></a></div>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="ps-top-categories d-none d-sm-block">
        <div class="ps-container">
            <h3>Most Popular Categories</h3>
            <div class="row">
                <?php 
                    $top_kategori = $this->db->query("SELECT * FROM (SELECT a.*, b.jumlah FROM
                                        (SELECT * FROM rb_kategori_produk) as a LEFT JOIN
                                        (SELECT z.id_kategori_produk, COUNT(*) jumlah FROM rb_penjualan_detail y JOIN rb_produk z ON y.id_produk=z.id_produk GROUP BY z.id_kategori_produk HAVING COUNT(z.id_kategori_produk)) as b on a.id_kategori_produk=b.id_kategori_produk) as x ORDER BY x.jumlah DESC LIMIT 8");
                    foreach($top_kategori->result_array() as $row){
                        echo "<div class='col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 '>
                                <div class='ps-block--category'><a class='ps-block__overlay' href='".base_url()."produk/kategori/$row[kategori_seo]'></a>";
                                    if ($row['gambar'] == ''){
                                        echo "<img class='preview' loading='lazy' style='width:210px;height:120px;' src='".base_url()."asset/foto_produk/no-image.jpg' alt='no-image.jpg' />";
                                    }else{
                                        echo "<img class='preview' loading='lazy' style='width:210px;height:120px;' src='".base_url()."asset/foto_produk/$row[gambar]' alt='$row[gambar]' />";
                                    }
                                    echo "<p style='height:60px;'>$row[nama_kategori]</p>
                                </div>
                              </div>";
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- <div class="ps-product-list ps-clothings">
        <div class="ps-container">
            <div class="ps-section__header">
                <?php 
                    $ku1 = $this->model_app->view_where("rb_kategori_produk",array('urutan'=>'1'))->row_array();
                    
                    echo "<h3>$ku1[nama_kategori]</h3>
                          <ul class='ps-section__links'>
                            <li><a href='".base_url()."produk/kategori/$ku1[kategori_seo]'>All</a></li>
                          </ul>";
                    
                ?>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                    
                <?php 
                $produk = $this->model_reseller->produk_perkategori(0,0,$ku1['id_kategori_produk'],10);
                foreach ($produk->result_array() as $row){
                    $ex = explode(';', $row['gambar']);
                    if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                    if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }
                    $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                    $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();

                    $disk = $this->model_app->view_where("rb_produk_diskon",array('id_produk'=>$row['id_produk']))->row_array();
                    $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)." %";

                    if ($beli['beli']-$jual['jual']<=0){ 
                        $stok = "<div class='ps-product__badge out-stock'>Habis Terjual</div>"; 
                        $diskon_persen = ''; 
                    }else{ 
                        $stok = ""; 
                        if ($diskon>0){ 
                            $diskon_persen = "<div class='ps-product__badge'>$diskon</div>"; 
                        }else{
                            $diskon_persen = ''; 
                        }
                    }
        
                    if ($diskon>=1){ 
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon']);
                        $base_price = $row['harga_konsumen'] - $disk['diskon'];
                    }else{
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                        $base_price = $row['harga_konsumen'];
                    }
                    
                    if(cekmatauang() == "hkd"){
                        $harga_produk = "HK$ ". idr2hkd($base_price,$row['harga_dollar']);
                    }

                    $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                    $persentase = ($sold->num_rows()/$beli['beli'])*100;
                    $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                    echo "<div class='ps-product'>
                            <div class='ps-product__thumbnail'><a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                                $diskon_persen
                                $stok
                                <ul class='ps-product__actions produk-$row[id_produk]'>
                                    <li><a href='".base_url()."produk/detail/$row[produk_seo]' data-toggle='tooltip' data-placement='top' title='Read More'><i class='icon-bag2'></i></a></li>
                                    <li><a href='#' data-toggle='tooltip' data-placement='top' title='Quick View' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i></a></li>";
                                    if ($cek_save>='1'){
                                        echo "<li><a data-toggle='tooltip' data-placement='top' title='Add to Whishlist'><i style='color:red' class='icon-heart'></i></a></li>";
                                    }else{
                                        echo "<li><a data-toggle='tooltip' data-placement='top' id='save-$row[id_produk]' title='Add to Whishlist'><i class='icon-heart' onclick=\"save('$row[id_produk]',this.id)\"></i></a></li>";
                                    }
                                echo "</ul>
                            </div>
                            <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a>
                                <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                    <div class='ps-product__rating'>
                                    <select class='ps-rating' data-read-only='true'>".rate_bintang($row['id_produk'])."</select><span>".rate_jumlah($row['id_produk'])."</span>
                                    </div>
                                    <p class='ps-product__price sale'>$harga_produk</p>
                                </div>
                                <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>";
                                if (stok($row['id_reseller'],$row['id_produk'])<=0){ 
                                    echo "<a style='margin-top:10px; color:#a7a7a7; background-color:#e2e2e2' class='ps-btn ps-btn--fullwidth add-to-cart-empty'>Add to Cart</a>";
                                }else{
                                    echo "<a style='margin-top:10px' id='$row[id_produk]' class='ps-btn ps-btn--fullwidth add-to-cart'>Add to Cart</a>";
                                }
                                echo "</div>
                            </div>
                        </div>";
                }
                ?>
                </div>
            </div>
        </div>
    </div> -->
    
    <div class="ps-product-list ps-clothings">
        <div class="ps-container">
            <div class="ps-section__header">
                <?php 
                    $ku2 = $this->model_app->view_where("rb_kategori_produk",array('urutan'=>'2'))->row_array();
                    echo "<h3>$ku2[nama_kategori]</h3>
                          <ul class='ps-section__links'>
                            <li><a href='".base_url()."produk/kategori/$ku2[kategori_seo]'>All</a></li>
                          </ul>";
                ?>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                    
                <?php 
                $produk2 = $this->model_reseller->produk_perkategori(0,0,$ku2['id_kategori_produk'],10);
                foreach ($produk2->result_array() as $row){
                    $ex = explode(';', $row['gambar']);
                    if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                    if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }
                    $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                    $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();

                    $disk = $this->model_app->view_where("rb_produk_diskon",array('id_produk'=>$row['id_produk']))->row_array();
                    $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)." %";

                    if ($beli['beli']-$jual['jual']<=0){ 
                        $stok = "<div class='ps-product__badge out-stock'>Habis Terjual</div>"; 
                        $diskon_persen = ''; 
                    }else{ 
                        $stok = ""; 
                        if ($diskon>0){ 
                            $diskon_persen = "<div class='ps-product__badge'>$diskon</div>";
                        }else{
                            $diskon_persen = ''; 
                        }
                    }
        
                    if ($diskon>=1){ 
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del>".rupiah($row['harga_konsumen'])."</del>";
                        $base_price = $row['harga_konsumen'] - $disk['diskon'];
                        //$del = " <del>".idr2hkd($row['harga_konsumen'],0)."</del>";
                        $del = "";
                    }else{
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                        $base_price = $row['harga_konsumen'];
                    }

                    if(cekmatauang() == "hkd"){
                        $harga_produk = "HK$ ". idr2hkd($base_price,$row['harga_dollar']);
                    }


                    $harga_produk .= $del;

                    $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                    $persentase = ($sold->num_rows()/$beli['beli'])*100;
                    $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                    echo "<div class='ps-product'>
                            <div class='ps-product__thumbnail'><a href='".base_url()."produk/detail/$row[produk_seo]'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                                $diskon_persen
                                $stok
                                <ul class='ps-product__actions produk-$row[id_produk]'>
                                    <li><a href='".base_url()."produk/detail/$row[produk_seo]' data-toggle='tooltip' data-placement='top' title='Read More'><i class='icon-bag2'></i></a></li>
                                    <li><a href='#' data-toggle='tooltip' data-placement='top' title='Quick View' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i></a></li>";
                                    if ($cek_save>='1'){
                                        echo "<li><a data-toggle='tooltip' data-placement='top' title='Add to Whishlist'><i style='color:red' class='icon-heart'></i></a></li>";
                                    }else{
                                        echo "<li><a data-toggle='tooltip' data-placement='top' id='save-$row[id_produk]' title='Add to Whishlist'><i class='icon-heart' onclick=\"save('$row[id_produk]',this.id)\"></i></a></li>";
                                    }
                                echo "</ul>
                            </div>
                            <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a>
                                <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                    <div class='ps-product__rating'>
                                    <select class='ps-rating' data-read-only='true'>".rate_bintang($row['id_produk'])."</select><span>".rate_jumlah($row['id_produk'])."</span>
                                    </div>
                                    <p class='ps-product__price sale'>$harga_produk</p>
                                </div>
                                <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>";
                                if (stok($row['id_reseller'],$row['id_produk'])<=0){ 
                                    echo "<a style='margin-top:10px; color:#a7a7a7; background-color:#e2e2e2' class='ps-btn ps-btn--fullwidth add-to-cart-empty'>Add to Cart</a>";
                                }else{
                                    echo "<a style='margin-top:10px' id='$row[id_produk]' class='ps-btn ps-btn--fullwidth add-to-cart'>Add to Cart</a>";
                                }
                                echo "</div>
                            </div>
                        </div>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="ps-product-list ps-clothings">
        <div class="ps-container">
            <div class="ps-section__header">
                <?php 
                    $ku3 = $this->model_app->view_where("rb_kategori_produk",array('urutan'=>'3'))->row_array();
                    echo "<h3>$ku3[nama_kategori]</h3>
                          <ul class='ps-section__links'>
                            <li><a href='".base_url()."produk/kategori/$ku3[kategori_seo]'>All</a></li>
                          </ul>";
                ?>
            </div>
            <div class="ps-section__content">
                <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                    
                <?php 
                $produk3 = $this->model_reseller->produk_perkategori(0,0,$ku3['id_kategori_produk'],10);
                foreach ($produk3->result_array() as $row){
                    $ex = explode(';', $row['gambar']);
                    if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                    if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }
                    
                    $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                    $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();

                    $disk = $this->model_app->view_where("rb_produk_diskon",array('id_produk'=>$row['id_produk']))->row_array();
                    $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)." %";

                    if (stok($row['id_reseller'],$row['id_produk'])<=0){ 
                        $stok = "<div class='ps-product__badge out-stock'>Habis Terjual</div>"; 
                        $diskon_persen = ''; 
                    }else{ 
                        $stok = ""; 
                        if ($diskon>0){ 
                            $diskon_persen = "<div class='ps-product__badge'>$diskon</div>"; 
                        }else{
                            $diskon_persen = ''; 
                        }
                    }
        
                    if ($diskon>=1){ 
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del>".rupiah($row['harga_konsumen'])."</del>";
                        $base_price = $row['harga_konsumen'] - $disk['diskon'];
                        //$del = " <del>".idr2hkd($row['harga_konsumen'],0)."</del>";
                        $del = "";
                    }else{
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                        $base_price = $row['harga_konsumen'];
                    }

                    if(cekmatauang() == "hkd"){
                        $harga_produk = "HK$ ". idr2hkd($base_price,$row['harga_dollar']);
                    }

                    $harga_produk .= $del;

                    $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                    $persentase = ($sold->num_rows()/$beli['beli'])*100;
                    $cek_save = $this->db->query("SELECT * FROM rb_konsumen_simpan where id_konsumen='".$this->session->id_konsumen."' AND id_produk='$row[id_produk]'")->num_rows();
                    
                    echo "<div class='ps-product'>
                            <div class='ps-product__thumbnail'><a href='".base_url()."produk/detail/$row[produk_seo]'><img class='preview' loading='lazy' src='".base_url()."asset/foto_produk/$foto_produk' alt='$row[nama_produk]'></a>
                                $diskon_persen
                                $stok
                                <ul class='ps-product__actions produk-$row[id_produk]'>
                                    <li><a href='".base_url()."produk/detail/$row[produk_seo]' data-toggle='tooltip' data-placement='top' title='Read More'><i class='icon-bag2'></i></a></li>
                                    <li><a href='#' data-toggle='tooltip' data-placement='top' title='Quick View' class='quick_view' data-id='$row[id_produk]'><i class='icon-eye'></i></a></li>";
                                    if ($cek_save>='1'){
                                        echo "<li><a data-toggle='tooltip' data-placement='top' title='Add to Whishlist'><i style='color:red' class='icon-heart'></i></a></li>";
                                    }else{
                                        echo "<li><a data-toggle='tooltip' data-placement='top' id='save-$row[id_produk]' title='Add to Whishlist'><i class='icon-heart' onclick=\"save('$row[id_produk]',this.id)\"></i></a></li>";
                                    }
                                echo "</ul>
                            </div>
                            <div class='ps-product__container'><a class='ps-product__vendor' href='".base_url()."u/".user_reseller($row['id_reseller'])."'>".cek_paket_icon($row['id_reseller'])." $row[nama_reseller]</a>
                                <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                    <div class='ps-product__rating'>
                                    <select class='ps-rating' data-read-only='true'>".rate_bintang($row['id_produk'])."</select><span>".rate_jumlah($row['id_produk'])."</span>
                                    </div>
                                    <p class='ps-product__price sale'>$harga_produk</p>
                                </div>
                                <div class='ps-product__content hover'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$row[nama_produk]</a>";
                                if (stok($row['id_reseller'],$row['id_produk'])<=0){ 
                                    echo "<a style='margin-top:10px; color:#a7a7a7; background-color:#e2e2e2' class='ps-btn ps-btn--fullwidth add-to-cart-empty'>Add to Cart</a>";
                                }else{
                                    echo "<a style='margin-top:10px' id='$row[id_produk]' class='ps-btn ps-btn--fullwidth add-to-cart'>Add to Cart</a>";
                                }
                                echo "</div>
                            </div>
                        </div>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>

    <div class="ps-home-ads">
        <div class="ps-container">
            <div class="row">
                <?php
                $no = 1;
                $iklantengah = $this->db->query("SELECT * FROM iklantengah where judul like 'footer%'");
                foreach ($iklantengah->result_array() as $b) {
                    if ($no=='1'){ $class = 'col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12'; }else{ $class = 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12'; }
                    $string = $b['gambar'];
                    if ($b['gambar'] != ''){
                        if(preg_match("/swf\z/i", $string)) {
                            echo "<div class='$class '><embed class='ps-collection' src='".base_url()."asset/foto_iklantengah/$b[gambar]' quality='high' type='application/x-shockwave-flash'></div>";
                        } else {
                            echo "<div class='$class '><a class='ps-collection' href='$b[url]' target='_blank'><img class='preview' loading='lazy' src='".base_url()."asset/foto_iklantengah/$b[gambar]' alt='$b[judul]' /></a></div>";
                        }
                    }
                    $no++;
                }
                ?>
            </div>
        </div>
    </div>

    <div style='clear:both'><br></div>
    <div class="ps-product-list ps-new-arrivals">
        <div class="ps-container">
            <div class="ps-section__header">
                <h3>New Arrivals</h3>
                <ul class="ps-section__links d-none d-sm-block">
                    <?php 
                        $kategori = $this->db->query("SELECT * FROM rb_kategori_produk ORDER BY RAND() LIMIT 3");
                        foreach ($kategori->result_array() as $row) {
                            echo "<li><a href='".base_url()."produk/kategori/$row[kategori_seo]'>$row[nama_kategori]</a></li>";
                        }
                    ?>
                    <li><a href="<?php echo  base_url(); ?>produk">All</a></li>
                </ul>
            </div>
            <div class="ps-section__content">
                   <div class="ps-carousel--nav owl-slider" data-owl-auto="false" data-owl-loop="false" data-owl-speed="10000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="7" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="6" data-owl-duration="1000" data-owl-mousedrag="on">
                <?php
                $terbaru = $this->model_reseller->produk_terbaru(0,0,8);
                foreach ($terbaru->result_array() as $row){
                    $ex = explode(';', $row['gambar']);
                    
                    if (trim($ex[0])=='' OR !file_exists("asset/foto_produk/".$ex[0])){ $foto_produk = 'no-image.png'; }else{ if (!file_exists("asset/foto_produk/thumb_".$ex[0])){ $foto_produk = $ex[0]; }else{ $foto_produk = "thumb_".$ex[0]; }}
                    
                    if (strlen($row['nama_produk']) > 38){ $judul = substr($row['nama_produk'],0,38).',..';  }else{ $judul = $row['nama_produk']; }
                    $jual = $this->model_reseller->jual_reseller($row['id_reseller'],$row['id_produk'])->row_array();
                    $beli = $this->model_reseller->beli_reseller($row['id_reseller'],$row['id_produk'])->row_array();

                    $disk = $this->model_app->view_where("rb_produk_diskon",array('id_produk'=>$row['id_produk']))->row_array();
                    $diskon = rupiah(($disk['diskon']/$row['harga_konsumen'])*100,0)." %";

                    if ($beli['beli']-$jual['jual']<=0){ 
                        $stok = "<div class='ps-product__badge out-stock'>Habis Terjual</div>"; 
                        $diskon_persen = ''; 
                    }else{ 
                        $stok = ""; 
                        if ($diskon>0){ 
                            $diskon_persen = "<div class='ps-product__badge'>$diskon</div>"; 
                        }else{
                            $diskon_persen = ''; 
                        }
                    }
        
                    if ($diskon>=1){ 
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']-$disk['diskon'])." <del>".rupiah($row['harga_konsumen'])."</del>";
                        $base_price = $row['harga_konsumen'] - $disk['diskon'];
                        //$del = " <del>".idr2hkd($row['harga_konsumen'],0)."</del>";
                        $del = "";
                    }else{
                        $harga_produk =  "Rp ".rupiah($row['harga_konsumen']);
                        $base_price = $row['harga_konsumen'];
                    }

                    if(cekmatauang() == "hkd"){
                        $harga_produk = "HK$ ". idr2hkd($base_price,$row['harga_dollar']);
                    }

                    $harga_produk .= $del;

                    $sold = $this->model_reseller->produk_terjual($row['id_produk'],2);
                    $persentase = ($sold->num_rows()/$beli['beli'])*100;

                    // echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 '>
                    //         <div class='ps-product--horizontal'>
                    //             <div class='ps-product__thumbnail'><a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' style='border:1px solid #e3e3e3' src='".base_url()."asset/foto_produk/$foto_produk' alt='$foto_produk'></a></div>
                    //             <div class='ps-product__content'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                    
                    //                 <p class='ps-product__price'>$harga_produk</p>
                    //             </div>
                    //         </div>
                    //     </div>";

                    echo "<div class='ps-product'>
                            <div class='ps-product__thumbnail'><a href='".base_url()."asset/foto_produk/$foto_produk' class='progressive replace'><img class='preview' loading='lazy' style='border:1px solid #e3e3e3' src='".base_url()."asset/foto_produk/$foto_produk' alt='$foto_produk'></a></div>
                            <div class='ps-product__conten'><a class='ps-product__title' href='".base_url()."produk/detail/$row[produk_seo]'>$judul</a>
                                <p class='ps-product__price'>$harga_produk</p>
                            </div>
                        </div>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    
    <?php if (config('apps_aktif')=='Y'){ ?>
    <div class="ps-download-app" style='margin:30px 0px;'>
        <div class="container">
            <div class="ps-block--download-app" style='border:1px solid #e8e8e8'>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block__thumbnail"><a href='<?php echo base_url(); ?>asset/images/<?= config('apps_image'); ?>' class='progressive replace'><img class='preview' loading='lazy' src="<?php echo base_url(); ?>asset/images/<?= config('apps_image'); ?>" alt=""></a></div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-block__content">
                            <h3><?= config('apps_title'); ?></h3>
                            <p><?= config('apps_deskripsi'); ?></p>
                            <form class="ps-form--download-app" action="<?php echo base_url() ?>main/subscribe" method="post">
                                <div class="form-group--nest">
                                    <input class="form-control" type="email" name='email' placeholder="Email Address" autocomplete='off' required>
                                    <button type='submit' name='submit' class="ps-btn">Subscribe</button>
                                </div>
                            </form>
                            <p class="download-link"><a href="<?= config('apps_google_play'); ?>"><img class='preview' loading='lazy' src="<?php echo base_url(); ?>asset/images/google-play.png" alt="google-play.png"></a><a href="<?= config('apps_app_store'); ?>"><img class='preview' loading='lazy' src="<?php echo base_url(); ?>asset/images/app-store.png" alt="app-store.png"></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>


    <!--<div class="ps-newsletter">
        <div class="ps-container">
            <form class="ps-form--newsletter" action="do_action" method="post">
                <div class="row">
                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-form__left">
                            <h3>Newsletter</h3>
                            <p>Subcribe to get information about products and coupons</p>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-form__right">
                            <div class="form-group--nest">
                                <input class="form-control" type="email" placeholder="Email address">
                                <button class="ps-btn">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>-->
</div>