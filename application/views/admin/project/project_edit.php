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
           
            <form method="post" action="<?= base_url('admin/projects/edit/'.$project['id']); ?>" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group">
                <label for="project" class="col-sm-2 control-label">Project Name</label>

                <div class="col-sm-9">
                  <input type="text" name="name" value="<?= $project['name']; ?>" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label for="location" class="col-sm-2 control-label">location</label>

                <div class="col-sm-9">
                  <input type="location" name="location" value="<?= $project['location']; ?>" class="form-control" >
                </div>
				</div>
         <div class="form-group">
           <label for="location" class="col-sm-2 control-label">Type</label>
        <div class="col-sm-9">
                <select name="cat_name" id="cat_name" class="form-control">
                  <option value="">Please select</option>
                   <?php
                        if(!empty($projectCats))
                        {
                          foreach($projectCats as $cat)
                          {
                        ?> 
              <!--<option value="<?php echo $cat['cat_id']; ?>"<?php if($project['cat_id']==$cat['cat_id']) echo"selected"; ?> 
                         ><?php echo $cat['cat_name'];?></option>-->
                  <option value="<?php echo $cat['cat_id']; ?>"<?php echo ($project['cat_id']==$cat['cat_id'])? 'selected':''; ?> 
                         ><?php echo $cat['cat_name'];?></option>
                      
                    <?php }
                    } ?>

               </select>
                </div>
           
              </div>
				
             <div class="form-group">
                <label for="cost" class="col-sm-2 control-label">Project Cost</label>

                <div class="col-sm-9">
                  <input type="text" name="cost" placeholder="Project cost" value="<?= $project['cost']; ?>" class="form-control" >
                   <span style="color:#f13005;"><?php echo form_error('cost');?></span>

                </div>
              </div>

          <div class="form-group">
           <label for="size" class="col-sm-2 control-label">Project Size</label>

            <div class="col-sm-9">
            <input type="text" name="size" placeholder="Project size" value="<?= $project['size']; ?>" class="form-control" >
                   <span style="color:#f13005;"><?php echo form_error('size');?></span>

                </div>
              </div>

           <div class="form-group">
           <label for="description" class="col-sm-2 control-label">Project Description</label>

            <div class="col-sm-9">
            <textarea name="description" placeholder="Project description" class="form-control"><?= $project['description']; ?></textarea>
                   <span style="color:#f13005;"><?php echo form_error('description');?></span>

                </div>
              </div>    
            
          

			   	<div class="form-group">
				   <label for="email" class="col-sm-2 control-label">Project image</label>
                <div class="col-sm-9">
            <?php if(!empty($project['project_image'])) { ?>
            <img height="150px" width="150px"  src="<?php echo base_url();?>uploads/projects/<?php echo $project['project_image']; ?>" alt="<?php echo $project['name']; ?>">
             <input type="file" name="project_image" value="" class="form-control" >
              <input type="hidden" name="old_image" value="<?php echo $project['project_image']; ?>" class="form-control"  >
            <?php } else {?>
            <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="150px" width="150px">
            <input type="file" name="project_image" value="<?php echo $project['project_image']; ?>" class="form-control"  >
            <?php } ?>
			</div>
			</div>
       
			 <div class="form-group">
                <div class="col-md-offset-4 col-md-8">
                  <input type="submit" name="submit" value="updateProject" class="btn btn-primary">
				  
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 