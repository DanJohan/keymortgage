<div class="modal-header orange_header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
        <h3 class="modal-title"><?php  echo $pageTitle; ?></h3>
      </div>
      <div class="modal-body model_view" align="center">&nbsp;
        <div><?php if($projectDetail['profile_image']){?>
              <img class="photo_img_round" height="150" width="150" src="<?= base_url() ?>uploads/projects/<?= $projectDetail['project_image']; ?>">
              <?php }else {?>
             <img class="photo_img_round" height="150" width="150" src="<?= base_url() ?>public/images/no-img.jpg"><?php } ?></div>
        <div class="model_title"><b><?php echo $projectDetail['name']; ?></b></div>
      </div>
      <div class="modal-body">
        <h3 style="text-decoration:underline;">Details Infromation</h3>
        <div class="row">
          <div class="col-xs-12">
          	<b>Name: </b> <?php echo $projectDetail['name']; ?><br>
          	<b>Location: </b> <?php echo $projectDetail['location']; ?><br>
          	<b>Cost. </b> <?php echo $projectDetail['cost']; ?><br>
			<b>Size. </b> <?php echo $projectDetail['size']; ?><br>
           	<b>Created at: </b> <?php echo $projectDetail['created_at']; ?><br>
        </div>
        </div>
      </div>
    </div>
                    <!-- /.modal-content -->


