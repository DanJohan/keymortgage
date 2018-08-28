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
           
            <form method="post" action="<?= base_url('admin/users/add/'); ?>" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">User Name</label>

                <div class="col-sm-9">
                  <!--<input type="text" name="name" value="" class="form-control" pattern="[A-Za-z]+" title="only letters" required>-->
                  <input type="text" name="name" placeholder="User name" value="<?php echo set_value('name'); ?>" class="form-control" >
                   <span style="color:#f13005;"><?php echo form_error('name');?></span>

                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-9">
                  <!--<input type="email" name="email" value="" class="form-control" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address" required>-->

                   <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="User Email" >
                    <span style="color:#f13005;"><?php echo form_error('email');?></span>

                </div>
           	  </div>
          <div class="form-group">
                <label for="Password" class="col-sm-2 control-label">Password</label>

                <div class="col-sm-9">
                  <input type="password" name="password" value="" class="form-control" >
                 <span style="color:#f13005;"><?php echo form_error('password');?></span>
                </div>

           
              </div>


             <div class="form-group">
                <label for="Password" class="col-sm-2 control-label">Phone</label>

                <div class="col-sm-9">
                  <input type="text" name="phone" value="" class="form-control" >
                 <span style="color:#f13005;"><?php echo form_error('phone');?></span>
                </div>
            </div>   
            
        	<div class="form-group">
				   <label for="email" class="col-sm-2 control-label">Profile image</label>
                <div class="col-sm-9">
                      <input type="file" name="profile_image" value="" class="form-control" >
       			</div>
        </div>
		
		  <div class="form-group">
                <label for="user_type" class="col-sm-2 control-label">User Type</label>

                <div class="col-sm-9">
                <!-- <input type="text" name="user_type" placeholder="User Type" value="<?php echo set_value('user_type'); ?>" class="form-control" >-->
				<select name="role_name" id="role_name" class="form-control">
				 <option value="">Please select</option>
                  <?php
                   if(!empty($userRoles))
                  {
                    foreach($userRoles as $roles)
                    {
                    ?>
                 <option value="<?php echo $roles['role_id'];?>"><?php echo $roles['role_name'];?></option>
                 <?php } }?> 
                       
				</select>
                   <span style="color:#f13005;"><?php echo form_error('role_name');?></span>

                </div>
              </div>
	
       
				 <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="addUser" value="addUser" class="btn btn-primary">
				  
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 