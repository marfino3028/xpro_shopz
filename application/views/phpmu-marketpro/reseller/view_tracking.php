<div class="ps-order-tracking">
    <div class="container">
        <div class="ps-section__header">
            <h3><?php echo $title; ?></h3>
            <p>To Track Your Orders, Please Enter Your Order Number and Email Address. You Can Find Your Order Number In The Order Confirmation Email.</p>
        </div>
        <div class="ps-section__content">
            <?php 
              $attributes = array('class'=>'ps-form--order-tracking');
              echo form_open_multipart('konfirmasi/tracking',$attributes); 
            ?>
                <div class="form-group">
                    <label>Order ID</label>
                    <input class="form-control" type="text" name='a' placeholder="Insert Order Id, Example : TRX- - - - - - " required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input class="form-control" type="text" placeholder="Email Address Your Order,..">
                </div>
                <div class="form-group">
                    <button type='submit' name='submit1' class="ps-btn ps-btn--fullwidth">Track My Orders</button>
                </div>
            </form>
        </div>
    </div>
</div>
