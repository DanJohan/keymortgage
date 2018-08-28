      <div class="modal-header orange_header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
        <h3 class="modal-title"><?php  echo $pageTitle; ?></h3>
      </div>
      <div class="modal-body model_view" align="center">&nbsp;
        <div><?php if($userDetail['profile_image']){?>
              <img class="photo_img_round" height="150" width="150" src="<?= base_url() ?>uploads/<?= $userDetail['profile_image']; ?>">
              <?php }else {?>
             <img class="photo_img_round" height="150" width="150" src="<?= base_url() ?>uploads/no-img.jpg"><?php } ?></div>
        <div class="model_title"><b><?php echo $userDetail['name']; ?></b></div>
      </div>
      <div class="modal-body">
        <h3 style="text-decoration:underline;">Details Infromation</h3>
        <div class="row">
          <div class="col-xs-12">

          	<b>Name: </b> <?php echo $userDetail['name']; ?><br>
          	<b>Email Address: </b> <?php echo $userDetail['email']; ?><br>
          	<b>Contact No. </b> <?php echo $userDetail['phone']; ?><br>
           	<b>Address: </b> <?php echo $userDetail['address']; ?><br>
          
          	
          </div>
        </div>
      </div>
    </div>
                    <!-- /.modal-content -->


