
<section class="content">
  <?php $this->load->view('common/flashmessage'); ?>
   <div class="box">
    <div class="box-header project-header">
      <h3 class="box-title">User detail</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="text-center">
          <?php //if(!empty($user['profile_image'])) { ?>
            <!--<img class="photo_img_round img-thumbnail" height="150" width="150" src="<?php //echo base_url() ?>uploads/profile/<?php //echo $user['profile_image']; ?>">-->
          <?php //}else{ ?>
            <!--<img class="photo_img_round img-thumbnail" height="150" width="150" src="<?php //echo base_url() ?>public/images/no_image.jpeg">-->
          <?php //} ?>
        </div>
        <table class="table" style="width:100%;">
            <tr>
                <td><b>User Name</b></td>
                <td><?php echo $user['name']; ?></td>
            </tr>
      
       <tr>
                <td><b>First Name</b></td>
                <td><?php echo $user['first_name']; ?></td>
            </tr>
       <tr>
                <td><b>Last Name</b></td>
                <td><?php echo $user['last_name']; ?></td>
            </tr>
             <tr>
                <td><b>Email</b></td>
                <td><?php echo $user['email']; ?></td>
            </tr>
             <tr>
                <td><b>Phone</b></td>
                <td><?php echo $user['phone']; ?></td>
            </tr>
      
        </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  <div class="box">
      <div class="box-header project-header">
        <h3 class="box-title">User Project detail</h3>
      </div>
      <div class="box-body">
            <?php if(!empty($usersProject)) { 
              foreach ($usersProject as $index => $project) {
            ?>
        <div class="row">
          <div class="col-xs-4">
              <?php if(!empty($project['project_image'])) { ?>
            <img class="img-thumbnail" style="height:150px;width: 100%;"  src="<?php echo base_url();?>uploads/projects/<?php echo $project['project_image']; ?>" alt="<?php echo $project['name']; ?>">
            <?php } else {?>
            <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="150px" width="150px">
           
            <?php } ?>
          </div>
          <div class="col-xs-6">
              <table class="table table-bordered table-condensed">
                <!--<tr class="project-header"><td> No.</td><td><?php //echo ($index+1); ?></td></tr>-->
                <tr><td><b>Project Name: </b></td><td><?php echo $project['name']; ?></td></tr>
                <tr><td><b>Location: </b></td><td><?php echo $project['location']; ?></td></tr>
                <tr><td><b>Category name: </b></td><td><?php echo ucfirst($project['cat_name']); ?></td></tr>
                <tr><td><b>Cost: </b> </td><td><?php echo $project['cost']; ?></td></tr>
                <tr><td><b>Size: </b> </td><td><?php echo $project['size']; ?></td></tr>
              </table>
               </div>
            </div>
            <?php } }else{ ?>
                <p>No record found</p>
            <?php } ?>
        
        </div>
  </div>


<!-- User bank Staat here-->

  <div class="box">
      <div class="box-header project-header">
        <h3 class="box-title">User Bank detail</h3>
      </div>
      <div class="box-body">
            <?php if(!empty($usersBank)) { 
              foreach ($usersBank as $index => $bank) {
            ?>
        <div class="row" style="height: 175px;">
          <div class="col-xs-4">
              <?php if(!empty($bank['bank_logo'])) { ?>
            <img class="img-thumbnail" style="height:150px;width: 100%;"  src="<?php echo base_url();?>uploads/banks/<?php echo $bank['bank_logo']; ?>" alt="<?php echo $bank['bank_name']; ?>">
            <?php } else {?>
            <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="150px" width="150px">
           
            <?php } ?>
          </div>
          <div class="col-xs-6">
              <table class="table table-bordered table-condensed">
             
                <tr><td><b>Bank Name: </b></td><td><?php echo $bank['bank_name']; ?></td></tr>
                <tr><td><b>Bank branch: </b></td><td><?php echo $bank['bank_branch']; ?></td></tr>
                <tr><td><b>User Bank Email: </b></td><td><?php echo ucfirst($bank['user_bank_email']); ?></td></tr>
                <tr><td><b>User Bank Branch: </b> </td><td><?php echo $bank['user_bank_branch']; ?></td>
               </tr>

              </table>
               </div>
            </div>
            <?php } }else{ ?>
                <p>No record found</p>
            <?php } ?>
        
         
      </div>
  </div>


  <!-- User Document detail start here -->
<div class="box">
      <div class="box-header project-header">
        <h3 class="box-title">User Document detail</h3>
      </div>
      <div class="box-body">
            <!--<table class="table table-bordered table-condensed">
              <tr>
                 </tr>
         <tr>
            <?php if(!empty($usersDoc)) { 
              foreach ($usersDoc as $index => $doc) {
            ?>     
                <td><?php if(!empty($doc['file'])) { ?>
                  
                  <a class="fancybox" target="_blank" rel="myGallery" href="<?php echo base_url();?>uploads/documents/<?php echo $doc['file']; ?>"><img class="img-thumbnail" style="height:150px;width: 200px;"  src="<?php echo base_url();?>uploads/documents/<?php echo $doc['file']; ?>" alt="<?php echo $doc['file']; ?>" /></a>
            
             <?php } else {?>
                      <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="150px" width="150px">
                     
                      <?php } ?>
                      </td>
                            
               
            <?php } }else{ ?>
                <p>No record found</p>
            <?php } ?>
      </tr>
            </table>-->

       <di  <div class="row">
          <div class="col-xs-12">
            <?php 
          if(!empty($usersDoc))
          {
          foreach($usersDoc as  $doc)
            {
            ?>
            <?php if(!empty($doc['file'])) { ?>
        <a class="example-image-link" href="<?= base_url() ?>uploads/documents/<?= $doc['file']; ?>" data-lightbox="example-set" data-title="Click the image to move forward.">
      <img class="photo_img_round example-image" height="200" width="200" src="<?= base_url() ?>uploads/documents/<?= $doc['file']; ?>">
      
      </a>
       <?php } else {?>
                      <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="150px" width="150px">
                     
                      <?php } ?>
           <?php } }else{ ?>
                <p>No record found</p>
            <?php } ?>
         
          </div>
          

             
     
      </div>
  </div>
  <div class="box">
      <div class="box-header project-header">
        <h3 class="box-title">Send Notification</h3>
      </div>
       <?php //echo $user_id =$this->uri->segment(4); ?>
      <div class="box-body">
            <div class="row">
          <div class="col-xs-12">
                  <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/users/sendDocumentNotification" id="user_notification">
  <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                 <div class="form-group">
            <label class="control-label col-sm-2" for="email">Message:</label>
            <div class="col-sm-10">
              <textarea class="form-control" placeholder="Enter Message" name="message"></textarea>
            </div>
          </div>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Submit</button>
            </div>
          </div>
    </form>
           
         
          </div>
          
            </div>
          
        
        </div>
  </div>
    <tr><td><a href="<?php echo base_url(); ?>admin/users" class="btn btn-primary bg-blue pull-right ">Go Back</a></td></tr>

<!-- Send notification-->
</section>
<?php //$this->load->view('common/modal'); ?>
<script type="text/javascript">
  /*$(document).on('click','.send-message',function(){
      var userId = $(this).data('user-id');
      if(userId){
        $.ajax({
            url:Config.baseUrl+"admin/users/sendMessageView",
            method:"POST",
            data:{'user_id':userId},
            success:function(response){
              if(response.status){
                $('.modal-content').html(response.template);
                $('#basicModal').modal();
              }

            }
        });
      }
  }); */
</script>

<script type="text/javascript">
  /*$(document).on('click','.send-message',function(){
      var userId = $(this).data('user-id');
      if(userId){
        $.ajax({
            url:Config.baseUrl+"admin/users/sendMessageView",
            method:"POST",
            data:{'user_id':userId},
            success:function(response){
              if(response.status){
                $('.modal-content').html(response.template);
                $('#basicModal').modal();
              }

            }
        });
      }
  }); */
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>public/dist/js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $( "#user_notification" ).validate({
    errorClass: "error",
    rules: {
     
      message:{
        required: true
      }
    }
});
</script>