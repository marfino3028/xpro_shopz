
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="<?php echo base_url()."donasi/wakaf_uang"; ?>">Wakaf</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>

<div class="ps-order-tracking">
    <div class="container">
        <div class="ps-section__header">
            <?php
              echo "<h3>$title</h3>";
              echo $this->session->flashdata('message'); 
                   $this->session->unset_userdata('message');
              echo "<p>Cash Endowment Is Productively Managed to Benefit Those Who Truly Deserve It.</p>";
            ?>
          </div>
        <div class="ps-section__content">
            <?php 
              $attributes = array('class'=>'ps-form--order-tracking');
              echo form_open_multipart('donasi/wakaf_uang',$attributes); 

              echo "<div class='form-group'><label>Minimum Endowment Amount Rp. 100.000 *</label> <input type='number' name='nominal' style='font-size:20px' class='form-control form-auth font-weight-bold text-success' value='100000' required></div>
                    <div class='form-group'><label>Full Name *</label>               <input type='text' name='nama_lengkap' class='form-control form-auth text-success' required></div>
                    <div class='form-group'><label>Phone Number *</label>               <input type='number' name='no_handphone' class='form-control form-auth text-success' required></div>
                    <div class='form-group'><label>Email Address *</label>          <input type='email' name='alamat_email' class='form-control form-auth text-success' required></div>
                    <div class='form-group'><label>Add a Payment Method *</label>    <select name='id_rekening' class='form-control form-auth'>";
                      foreach ($record->result_array() as $row){
                          echo "<option value='$row[id_rekening]'>$row[nama_bank] - $row[no_rekening], A/N : $row[pemilik_rekening]</option>";
                      }
                    echo "</select></div>
                    <div class='form-group'><label>Insert Your Best Hopes & Prayers *</label> <textarea class='form-control form-auth' style='height:65px !important' name='doa_terbaik'></textarea></div>
                    <div class='form-group'><label>The Last 2 Digit of Your Phone Number *</label> <input class='form-control form-auth' type='number' name='validasi' required></div>";
            ?>
                    <div class="form-group">
                        <button type='submit' name='submit' class="ps-btn ps-btn--fullwidth">Endow Now</button>
                    </div>
            </form>
        </div>
    </div>
</div>