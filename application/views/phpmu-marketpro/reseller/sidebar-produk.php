<div class="ps-layout__left">
    <aside class="widget widget_shop">
        <h4 class="widget-title">Filter Items</h4>
        <form style='margin-bottom:0px' class="ps-form--widget-search" action="<?php echo base_url(); ?>produk" method="GET">
        <?php 
                echo "<input type='text' style='padding-left:25px' class='form-control' placeholder='Keyword...' name='s' value='$_GET[s]' autocomplete='off'>
                <select class='form-control' style='background:#fff' name='f'>
                    <option value='0' selected='selected'>All Categories</option>";
                    $kategori = $this->model_app->view_ordering('rb_kategori_produk', 'nama_kategori', 'ASC');
                    foreach ($kategori as $rows) {
                        $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                        if (cetak($_GET['f']=="kategori|$rows[id_kategori_produk]")){
                            echo "<option class='level-0' value='kategori|$rows[id_kategori_produk]' selected>$rows[nama_kategori]</option>";
                        }else{
                            echo "<option class='level-0' value='kategori|$rows[id_kategori_produk]'>$rows[nama_kategori]</option>";
                        }
                        if ($sub_kategori->num_rows() >= 1) {
                            foreach ($sub_kategori->result_array() as $row) {
                                if (cetak($_GET['f']=="subkategori|$row[id_kategori_produk_sub]")){
                                    echo "<option class='level-1' value='subkategori|$row[id_kategori_produk_sub]' selected> &nbsp;&nbsp; $row[nama_kategori_sub]</option>";
                                }else{
                                    echo "<option class='level-1' value='subkategori|$row[id_kategori_produk_sub]'> &nbsp;&nbsp; $row[nama_kategori_sub]</option>";
                                }

                                $sub_kategori_third = $this->db->query("SELECT * FROM rb_kategori_produk_sub_third where id_kategori_produk_sub='$row[id_kategori_produk_sub]' ORDER BY nama_kategori_sub_third ASC");
                                if ($sub_kategori_third->num_rows() >= 1) {
                                    foreach ($sub_kategori_third->result_array() as $row_third) {
                                        if (cetak($_GET['f']=="thirdsubkategori|$row_third[id_kategori_produk_sub_third]")){
                                            echo "<option class='level-1' value='thirdsubkategori|$row_third[id_kategori_produk_sub_third]' selected> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; $row_third[nama_kategori_sub_third]</option>";
                                        }else{
                                            echo "<option class='level-1' value='thirdsubkategori|$row_third[id_kategori_produk_sub_third]'> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; $row_third[nama_kategori_sub_third]</option>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                /*echo "</select>

                <select class='form-control' name='provinsi' style='background:#fff' id='list_provinsi'>";
                echo "<option value=0>Provinsi</option>";
                  $provinsi = $this->db->query("SELECT * FROM tb_ro_provinces ORDER BY province_name ASC");
                  foreach ($provinsi->result_array() as $row) {
                    if ($this->input->get('provinsi')==$row['province_id']){
                      echo "<option value='$row[province_id]' selected>$row[province_name]</option>";
                    }else{
                      echo "<option value='$row[province_id]'>$row[province_name]</option>";
                    }
                  }
                echo "</select>

                <select class='form-control' name='kota' style='background:#fff' id='list_kotakab'>";
                echo "<option value=0>Kota / Kabupaten</option>";
                  
                  $kota = $this->db->query("SELECT * FROM tb_ro_cities where province_id='".cetak($this->input->get('provinsi'))."' ORDER BY city_name ASC");
                  foreach ($kota->result_array() as $row) {
                    if ($this->input->get('kota')==$row['city_id']){
                      echo "<option value='$row[city_id]' selected>$row[city_name]</option>";
                    }else{
                      echo "<option value='$row[city_id]'>$row[city_name]</option>";
                    }
                  }
                echo "</select>

                <select class='form-control' name='kecamatan' style='background:#fff' id='list_kecamatan'>";
                echo "<option value=0>Kecamatan</option>";
                  $subdistrict = $this->db->query("SELECT * FROM tb_ro_subdistricts where city_id='".cetak($this->input->get('kota'))."' ORDER BY subdistrict_name ASC");
                  foreach ($subdistrict->result_array() as $row) {
                    if ($this->input->get('kecamatan')==$row['subdistrict_id']){
                      echo "<option value='$row[subdistrict_id]' selected>$row[subdistrict_name]</option>";
                    }else{
                      echo "<option value='$row[subdistrict_id]'>$row[subdistrict_name]</option>";
                    }
                  }*/
                echo "</select>";
            ?><br>
            <select class='form-control' name='urut' style='background:#fff'>
              <?php 
                  $data_urut = array('Sort By Price','High to Low','Low to High');
                  $data_val = array('','asc','desc');
                  for ($i=0; $i < count($data_urut); $i++) { 
                    if ($data_val[$i]==$this->input->get('urut')){
                      echo "<option value='".$data_val[$i]."' selected>".$data_urut[$i]."</option>";
                    }else{
                      echo "<option value='".$data_val[$i]."'>".$data_urut[$i]."</option>";
                    }
                  }
              ?>
            </select>
            <br>
            <input class="form-control formatNumber" type="text" name='dari' value='<?php echo cetak($this->input->get('dari')); ?>' placeholder="From..." autocomplete='off'>
            <input class="form-control formatNumber" type="text" name='sampai' value='<?php echo cetak($this->input->get('sampai')); ?>' placeholder="To..." autocomplete='off'>
            
            <button type='submit' class='ps-btn ps-btn--black ml-3' style='width:100%; position: inherit; margin-top: 25px; color: #fff;'>Show Result</button>
        </form>
    </aside>
    <aside class="widget widget_shop">
        <h4 class="widget-title">Category</h4>
        <ul class="ps-list--categories">
            <?php 
                $kategori = $this->model_app->view_ordering('rb_kategori_produk','nama_kategori','ASC');
                foreach ($kategori as $rows) {
                    $sub_kategori = $this->db->query("SELECT * FROM rb_kategori_produk_sub where id_kategori_produk='$rows[id_kategori_produk]' ORDER BY nama_kategori_sub ASC");
                    echo "<li class='current-menu-item menu-item-has-children'><a href='".base_url()."produk/kategori/$rows[kategori_seo]'>$rows[nama_kategori]</a><span class='sub-toggle'><i class='fa fa-angle-down'></i></span>
                            <ul class='sub-menu'>";
                              if ($sub_kategori->num_rows()>=1){
                                foreach ($sub_kategori->result_array() as $row) {
                                echo "<li class='current-menu-item '><a href='".base_url()."produk/subkategori/$row[kategori_seo_sub]'>$row[nama_kategori_sub]</a></li>";
                                }
                            }
                      echo "</ul>
                          </li>";
                }
            ?>
        </ul>
    </aside>
    <aside class="widget widget_shop">
        <h4 class="widget-title">Filter Brand</h4>
        <div class="widget__content">
        <ul>
        <?php 
            $tag = $this->model_utama->view_ordering_limit('tagpro','nama_tag','ASC',0,20);
            foreach ($tag->result_array() as $row) {
                $total = $this->db->query("SELECT * FROM rb_produk where tag LIKE '%$row[tag_seo]%'")->num_rows();
                echo "<li><a style='border-bottom:1px dotted #cecece; display:block' href='".base_url()."tag/produk/$row[tag_seo]'>$row[nama_tag] <span class='pull-right'>($total)</span></a></li>";
            }
        ?>
        </ul>
        </div>
    </aside>
</div>

