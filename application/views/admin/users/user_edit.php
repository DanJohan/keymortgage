<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $pageTitle;?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <form method="post" action="<?= base_url('admin/users/edit/'.$user['id']); ?>" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name</label>

                <div class="col-sm-9">
                  <input type="text" name="name" value="<?= $user['name']; ?>" class="form-control" pattern="[A-Za-z]+" title="only letters" required>
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-9">
                  <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address" required>
                </div>
				
				
              </div>
			  	<div class="form-group">
				   <label for="email" class="col-sm-2 control-label">Profile image</label>
                <div class="col-sm-9">
            <?php if(!empty($user['profile_image'])) { ?>
            <img height="100px" width="100px"  src="<?php echo base_url();?>uploads/admin/<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" >
             <input type="file" name="profile_image" value="" class="form-control" >
              <input type="hidden" name="old_image" value="<?php echo $user['profile_image']; ?>" class="form-control"  >
            <?php } else {?>
            <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="100px" width="100px">
            <input type="file" name="profile_image" value="<?= $user['profile_image']; ?>" class="form-control"  >
            <?php } ?>
      </div>
    </div>
       
			 <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="updateUser" class="btn btn-primary">
				  
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 