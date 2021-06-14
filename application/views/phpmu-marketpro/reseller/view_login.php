<style>
.ps-footer {
    padding-top: 0px;
}
.ps-footer__copyright p {
    margin: 0 auto;
}
.ps-form--account .ps-tab {
    border-radius: 10px 10px 0px 0px;
}
.ps-form--account .ps-tab-list li.active a{
    color:#000;

}
</style>
<!--<div class="ps-breadcrumb">
<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php //echo base_url(); ?>">Home</a></li>
        <li>Autentikasi</li>
    </ul>
</div>
</div>-->
<div class="ps-my-account">
    <div class="container">
        <div class="ps-form--account ps-tab-root">
            <ul class="ps-tab-list">
                <li><a href="#sign-in">Sign in</a></li>
                <li class="active"><a href="#register">Sign up</a></li>
            </ul>
            <div class="ps-tabs">
                <div style='margin:0px 10px'>
                <?php 
                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');
                ?>
                </div>
                <div class="ps-tab" id="sign-in">
                <form action="<?php echo base_url(); ?>auth/login" method="POST">
                    <div class="ps-form__content">
                        <h5><center>Please Login</center></h5>
                        <div class="form-group">
                            <input class="form-control" name='a' type="text" placeholder="Username, Email or Phone Number" onkeyup="nospaces(this)" autocomplete='off' autofocus required>
                        </div>
                        <div class="form-group form-forgot">
                            <input class="form-control" name='b' type="password" placeholder="Password" onkeyup="nospaces(this)" required>
                            <ul class="ps-tab-list"><li><a style='font-size:14px; padding-top:10px' href="#lupapassword">Forgot Password?</a></li></ul>
                        </div>
                        <div class="form-group">
                            <div class="ps-checkbox">
                                <input class="form-control" type="checkbox" id="remember-me" name="remember-me">
                                 <label for="remember-me">Remember me</label>
                            </div>
                        </div><br>
                        <div class="form-group submit">
                            <button type='submit' name='login' class="ps-btn ps-btn--fullwidth">Sign In</button>
                        </div><br>
                    </div>
                </form>
                </div>
                <div class="ps-tab active" id="register">
                <form action="<?php echo base_url(); ?>auth/register" class='auth' method="POST">
                    <div class="ps-form__content">
                        <h5><center>Register and Join Us Now!</center></h5>
                        <div class="form-group" style='margin-bottom:10px'>
                            <input class="form-control form-auth" name='username' value='<?php if (isset($first_name)){ echo strtolower($first_name); } ?><?php if (isset($last_name)){ echo strtolower($last_name); } ?>' type="text" placeholder="Username" onkeyup="nospaces(this)" autocomplete='off' autofocus required>
                        </div>
                        <div class="form-group" style='margin-bottom:10px'>
                            <input class="form-control form-auth" name='a' value='<?php if (isset($email)){ echo $email; } ?>' type="email" onkeyup="nospaces(this)" placeholder="E-mail" autocomplete='off' required>
                        </div>
                        <div class="form-group" style='margin-bottom:10px'>
                            <input class="form-control form-auth" name='b' type="number" placeholder="Phone Number" onkeyup="nospaces(this)" autocomplete='off' required>
                        </div>
                        <div class="form-group" style='margin-bottom:10px'>
                            <input name='jenis_kelamin' type="radio" value='Laki-laki' checked> Male
                            <input name='jenis_kelamin' type="radio" value='Perempuan'> Female
                        </div>
                        <div class='form-group row'>
                            <div class='col-sm-12'>
                              <div class='row'>
                                <div class='col'>
                                    <input class="form-control form-auth" name='password' type="password" placeholder="Password" onkeyup="nospaces(this)" required>
                                </div>
                                <div class='col'>
                                    <input class="form-control form-auth" name='repassword' type="password" placeholder="Confirm your password" onkeyup="nospaces(this)" required>
                                </div>
                              </div>
                            </div>
                        </div>
                        <?php
                            $row1 = $this->db->query("SELECT * FROM halamanstatis where id_halaman='1'")->row_array();
                            $row2 = $this->db->query("SELECT * FROM halamanstatis where id_halaman='2'")->row_array();
                        ?>
                        <p>By creating an account you agree to our <a target='_BLANK' style='color:#000' href='<?php echo base_url()."halaman/detail/$row1[judul_seo]"; ?>'> User Agreement </a> & <a target='_BLANK' style='color:#000' href='<?php echo base_url()."halaman/detail/$row2[judul_seo]"; ?>'>Privacy Policy</a></p>
                        <div class="form-group submit">
                            <button type='submit' name='submit2' class="ps-btn ps-btn--fullwidth gray-btn custom-btn">Sign In</button>
                            <?php 
                                $ci = & get_instance();
                                $ci->load->library('facebook');
                                $ci->load->library('google');
                                echo "<a href='".$ci->google->loginURL()."' class='ps-btn ps-btn--fullwidth red-btn custom-btn' style='margin: 4px 0px'>Google</a>
                                      <a href='".$ci->facebook->login_url()."' class='ps-btn ps-btn--fullwidth blue-btn custom-btn'>Facebook</a>";
                            ?>
                        </div><br>
                    </div>
                </form>
                </div>

                <div class="ps-tab" id="lupapassword">
                <form action="<?php echo base_url(); ?>auth/lupass" method="POST">
                    <div class="ps-form__content">
                        <h5>Reset Your Password</h5>
                        <div class="form-group">
                            <input class="form-control" name='a' type="email" placeholder="Username, Email" onkeyup="nospaces(this)" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name='b' type="number" placeholder="Phone Number">
                        </div><br>
                        <div class="form-group submit">
                            <button type='submit' name='submit3' class="ps-btn ps-btn--fullwidth">Submit</button>
                        </div><br>
                    </div>
                </form>
                </div><br>
                <p class='text-center'>Back to <a style='color:#000' href='<?php echo base_url(); ?>'>Home page</a></p>
            </div>
        </div>
    </div>
</div>

