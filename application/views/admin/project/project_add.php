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
          <?php //$this->load->view('common/flashmessage'); ?>
           
            <form method="post" action="<?= base_url('admin/projects/add/'); ?>" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-9">
                   <input type="text" name="name" placeholder="name" value="<?php echo set_value('name'); ?>" class="form-control" >
                   <span style="color:#f13005;"><?php echo form_error('name');?></span>
                </div>
              </div>

              <div class="form-group">
                <label for="location" class="col-sm-2 control-label">location</label>

                <div class="col-sm-9">
                  <input type="location" name="location" value="<?php echo set_value('location'); ?>" class="form-control" placeholder="Location" >
                    <span style="color:#f13005;"><?php echo form_error('location');?></span>
                </div>
           	  </div>
          <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Type</label>

                <div class="col-sm-9">
                <span style="color:#f13005;"><?php //echo form_error('type');?></span>
                 <select name="cat_name" id="cat_name" class="form-control">
                  <option value="">Please select</option>
                  <?php
                   if(!empty($projectCats))
                  {
                    foreach($projectCats as $cat)
                    {
                    ?>
                 <option value="<?php echo $cat['cat_id'];?>"><?php echo $cat['cat_name'];?></option>
                 <?php } }?> 
                       
                     

               </select>
                </div>
           
              </div>
        	
       
			<div class="form-group">
                <label for="cost" class="col-sm-2 control-label">Project Cost</label>

                <div class="col-sm-9">
                  <input type="text" name="cost" placeholder="Project cost" value="<?php echo set_value('cost'); ?>" class="form-control" >
                   <span style="color:#f13005;"><?php echo form_error('cost');?></span>

                </div>
              </div>
      <div class="form-group">
                <label for="size" class="col-sm-2 control-label">Project Size</label>

                <div class="col-sm-9">
                  <input type="text" name="size" placeholder="Project size" value="<?php echo set_value('size'); ?>" class="form-control" >
                   <span style="color:#f13005;"><?php echo form_error('size');?></span>

                </div>
              </div>   


         <div class="form-group">
           <label for="description" class="col-sm-2 control-label">Project Description</label>

            <div class="col-sm-9">
            <textarea name="description" placeholder="Project description" class="form-control"></textarea>
                   <span style="color:#f13005;"><?php echo form_error('description');?></span>

                </div>
              </div>            
  
      <div class="form-group">
           <label for="email" class="col-sm-2 control-label">Project image</label>
                <div class="col-sm-9">
                      <input type="file" name="project_image" value="" class="form-control" >
            </div>
        </div>


	   
				 <div class="form-group">
                <div class="col-md-11">
                  <input type="submit" name="addProject" value="addProject" class="btn btn-primary">
				  
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
      </div>
    </div>
  </div>  

</section> 