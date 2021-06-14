        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
            <?php $usr = $this->model_app->view_where('users', array('username'=> $this->session->username))->row_array();
                  if (trim($usr['foto'])==''){ $foto = 'blank.png'; }else{ $foto = $usr['foto']; } ?>
            <img src="<?php echo base_url(); ?>/asset/foto_user/<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <?php echo "<p>$usr[nama_lengkap]</p>"; ?>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header" style='text-transform:uppercase;'>MENU <span class='uppercase'><?php echo $this->session->level; ?></span></li>
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/home"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Main Menu</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("identitaswebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/identitaswebsite'><i class='fa fa-circle-o'></i> Website Identity</a></li>";
                }

                $cek=$this->model_app->umenu_akses("logowebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/logowebsite'><i class='fa fa-circle-o'></i> Website Logo</a></li>";
                }

                $cek=$this->model_app->umenu_akses("templatewebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/templatewebsite'><i class='fa fa-circle-o'></i> Website Template</a></li>";
                }

                $cek=$this->model_app->umenu_akses("background",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/background'><i class='fa fa-circle-o'></i> Website Background Images</a></li>";
                }

                $cek=$this->model_app->umenu_akses("menuwebsite",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/menuwebsite'><i class='fa fa-circle-o'></i> Website Menus</a></li>";
                }

                $cek=$this->model_app->umenu_akses("halamanbaru",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/halamanbaru'><i class='fa fa-circle-o'></i> New Page</a></li>";
                }

                $cek=$this->model_app->umenu_akses("donasi",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/donasi'><i class='fa fa-circle-o'></i> Donation Data</a></li>";
                }
                
                $cek=$this->model_app->umenu_akses("subscribe",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/subscribe'><i class='fa fa-circle-o'></i> E-mail Subscription</a></li>";
                }
              ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-th-large"></i> <span>Market Master</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php 
                  $cek=$this->model_app->umenu_akses("konsumen",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/konsumen'><i class='fa fa-circle-o'></i> Consumer</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("reseller",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/reseller'><i class='fa fa-circle-o'></i> Reseller</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("sopir",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/sopir'><i class='fa fa-circle-o'></i> Driver/Internal Courier</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("paket",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/paket'><i class='fa fa-circle-o'></i> Reseller Packages</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("supplier",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/supplier'><i class='fa fa-circle-o'></i> Supplier</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("kategori_produk",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/kategori_produk'><i class='fa fa-circle-o'></i> Product Category</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("kategori_produk",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/kategori_produk_sub'><i class='fa fa-circle-o'></i> Product Sub-Categories</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("kategori_produk",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/kategori_produk_sub_third'><i class='fa fa-circle-o'></i> Specific Product Category</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("tagpro",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/tagpro'><i class='fa fa-circle-o'></i> Product Brand</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("produk",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/produk'><i class='fa fa-circle-o'></i> Product</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("rekening",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/rekening'><i class='fa fa-circle-o'></i> Company Bank Account</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("imagesslider",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/imagesslider'><i class='fa fa-circle-o'></i> Image Slider</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("ppob_margin",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/ppob_margin'><i class='fa fa-circle-o'></i> Margin PPOB</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("ongkir_driver",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/ongkir_driver'><i class='fa fa-circle-o'></i> Internal Courier Service Charges</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("kurir_rajaongkir",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/kurir_rajaongkir'><i class='fa fa-circle-o'></i> Kurir Rajaongkir</a></li>";
                  }

                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-shopping-cart"></i> <span>Market Transaction</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php 
                  $cek=$this->model_app->umenu_akses("penawaran",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/penawaran'><i class='fa fa-circle-o'></i> Flash Sales</a></li>";
                  }
                  
                  $cek=$this->model_app->umenu_akses("pembelian",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/pembelian'><i class='fa fa-circle-o'></i> Company to Supplier</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("penjualan",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/penjualan'><i class='fa fa-circle-o'></i> Business-to-Reseller Sells</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("pembayaran_reseller",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/pembayaran_reseller'><i class='fa fa-circle-o'></i> Reseller Payment</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("penjualan_konsumen",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/penjualan_konsumen'><i class='fa fa-circle-o'></i> Business-to-Consumer Sells</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("komplain",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/komplain'><i class='fa fa-circle-o'></i> Order Complaints</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("pembayaran_konsumen",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/pembayaran_konsumen'><i class='fa fa-circle-o'></i> Consumer Order Confirmation</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("mutasi",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/mutasi'><i class='fa fa-circle-o'></i> Bank Transaction History</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("withdraw",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/withdraw'><i class='fa fa-circle-o'></i> Reseller Withdrawal Trans. History</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("reseller_paket",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/reseller_paket'><i class='fa fa-circle-o'></i> Reseller Package Trans. History</a></li>";
                  }

                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-book"></i> <span>Market Report</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <?php 
                  $cek=$this->model_app->umenu_akses("reseller_transaksi",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/reseller_transaksi'><i class='fa fa-circle-o'></i> Rekap Transaksi Reseller</a></li>";
                  }

                  $cek=$this->model_app->umenu_akses("testimoni",$this->session->id_session);
                  if($cek==1 OR $this->session->level=='admin'){
                    echo "<li><a href='".base_url().$this->uri->segment(1)."/testimoni'><i class='fa fa-circle-o'></i> Buyer Testimonials</a></li>";
                  }
                ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-pencil"></i> <span>News Module</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("listberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/listberita'><i class='fa fa-circle-o'></i> News</a></li>";
                }

                $cek=$this->model_app->umenu_akses("kategoriberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/kategoriberita'><i class='fa fa-circle-o'></i> Category News</a></li>";
                }

                $cek=$this->model_app->umenu_akses("tagberita",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/tagberita'><i class='fa fa-circle-o'></i> News Tag</a></li>";
                }
              ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="glyphicon glyphicon-blackboard"></i> <span>Ads Module</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("iklanatas",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/edit_iklanatas'><i class='fa fa-circle-o'></i> Pop Up Ads</a></li>";
                }

                $cek=$this->model_app->umenu_akses("iklanhome",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/iklanhome'><i class='fa fa-circle-o'></i> Homepage Ads</a></li>";
                }

                $cek=$this->model_app->umenu_akses("iklansidebar",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/iklansidebar'><i class='fa fa-circle-o'></i> Sidebar Ads</a></li>";
                }

                $cek=$this->model_app->umenu_akses("banner",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/banner'><i class='fa fa-circle-o'></i> Link Ads</a></li>";
                }
              ?>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>User Module</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              <?php
                $cek=$this->model_app->umenu_akses("manajemenuser",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/manajemenuser'><i class='fa fa-circle-o'></i> User Management</a></li>";
                }

                $cek=$this->model_app->umenu_akses("manajemenmodul",$this->session->id_session);
                if($cek==1 OR $this->session->level=='admin'){
                  echo "<li><a href='".base_url().$this->uri->segment(1)."/manajemenmodul'><i class='fa fa-circle-o'></i> Module Management</a></li>";
                }
              ?>
              </ul>
            </li>
            
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/edit_manajemenuser/<?php echo $this->session->username; ?>"><i class="fa fa-edit"></i> <span>Edit Profile Page</span></a></li>
            <li><a href="<?php echo base_url().$this->uri->segment(1); ?>/logout"><i class="fa fa-power-off"></i> <span>Log Out</span></a></li>
          </ul>
        </section>