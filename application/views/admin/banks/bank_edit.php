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
           
            <form method="post" action="<?= base_url('admin/banks/edit/'.$Bank['bank_id']); ?>" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">Bank Name</label>

                <div class="col-sm-9">
                  <input type="text" name="bank_name" value="<?= $Bank['bank_name']; ?>" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Bank Url</label>

                <div class="col-sm-9">
                  <input type="text" name="bank_domain" value="<?= $Bank['bank_domain']; ?>" class="form-control" >
                </div>
				   </div>

           <div class="form-group">
                <label for="bank_address" class="col-sm-2 control-label">Branch</label>

                <div class="col-sm-9">
                  <input type="text" name="bank_branch" placeholder="Bank Branch"  value="<?= $Bank['bank_branch']; ?>" class="form-control" >
                 <span style="color:#f13005;"><?php echo form_error('bank_branch');?></span>
                </div>
           </div>

				<div class="form-group">
				   <label for="email" class="col-sm-2 control-label">Bank Logo</label>
                <div class="col-sm-9">
            <?php if(!empty($Bank['bank_logo'])) { ?>
      <img height="150px" width="150px"  src="<?php echo base_url();?>uploads/banks/<?php echo $Bank['bank_logo']; ?>" alt="<?php echo $Bank['bank_name']; ?>">
             <input type="file" name="bank_logo" value="" class="form-control" >
              <input type="hidden" name="old_image" value="<?php echo $Bank['bank_logo']; ?>" class="form-control"  >
            <?php } else {?>
            <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="150px" width="150px">
            <input type="file" name="bank_logo" value="<?php echo $Bank['bank_logo']; ?>" class="form-control"  >
            <?php } ?>
			</div>
			</div>
       
			 <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="submit" value="updateBank" class="btn btn-primary">
				  
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 