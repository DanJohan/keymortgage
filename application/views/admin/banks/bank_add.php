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
          <?php if(isset($msg)): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
           
            <form method="post" action="<?= base_url('admin/banks/add/'); ?>" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group">
                <label for="bank_name" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-9">
               <input type="text" name="bank_name" placeholder="Bank name" value="<?php echo set_value('bank_name'); ?>" class="form-control" >
                   <span style="color:#f13005;"><?php echo form_error('bank_name');?></span>
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Bank Url</label>

                <div class="col-sm-9">
                  <input type="text" name="bank_domain" value="<?php echo set_value('bank_domain'); ?>" class="form-control" placeholder="http://example.com" >
                    <span style="color:#f13005;"><?php echo form_error('bank_domain');?></span>

                </div>
           	  </div>
          <div class="form-group">
                <label for="bank_address" class="col-sm-2 control-label">Branch</label>

                <div class="col-sm-9">
                  <input type="text" name="bank_branch" placeholder="Bank Branch"  value="<?php echo set_value('bank_branch'); ?>" class="form-control" >
                 <span style="color:#f13005;"><?php echo form_error('bank_branch');?></span>
                </div>
           
              </div>
        	<div class="form-group">
				   <label for="email" class="col-sm-2 control-label">Bank Logo</label>
                <div class="col-sm-9">
                      <input type="file" name="bank_logo" value="" class="form-control" >
       			</div>
			</div>
       <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="addBank" value="addBank" class="btn btn-primary">
				  
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 