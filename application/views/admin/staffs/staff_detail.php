
<section class="content">
  <?php $this->load->view('common/flashmessage'); ?>
   <div class="box">
    <div class="box-header project-header">
      <h3 class="box-title">Staff Detail</h3>
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
                <td><?php echo $staff['name']; ?></td>
            </tr>
			
			 <tr>
                <td><b>First Name</b></td>
                <td><?php echo $staff['first_name']; ?></td>
            </tr>
			 <tr>
                <td><b>Last Name</b></td>
                <td><?php echo $staff['last_name']; ?></td>
            </tr>
             <tr>
                <td><b>Email</b></td>
                <td><?php echo $staff['email']; ?></td>
            </tr>
             <tr>
                <td><b>Phone</b></td>
                <td><?php echo $staff['phone']; ?></td>
            </tr>
			
        </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->


<!-- uploaded document section -->

<div class="box">
      <div class="box-header project-header">
        <h3 class="box-title">Uploaded Document</h3>
      </div>
      <div class="box-body">
            <div class="row">
          <div class="col-xs-12">
            <?php 
          if(!empty($staffDoc))
          {
          foreach($staffDoc as  $row)
            {
            ?>
           <!--<img class="photo_img_round" height="150" width="150" src="<?= base_url() ?>uploads/documents/<?= $row['file']; ?>">-->
        <a class="example-image-link" href="<?= base_url() ?>uploads/documents/<?= $row['file']; ?>" data-lightbox="example-set" data-title="Click the image to move forward.">
      <img class="photo_img_round img-thumbnail" height="200" width="200" src="<?= base_url() ?>uploads/documents/<?= $row['file']; ?>">
      
      </a>
       
              <?php
            }}
                      ?>
         
          </div>
          
            </div>
     
      </div>
  </div>


<!-- uploaded document section end -->






    <!-- User Document detail start here -->
<div class="box">
      <div class="box-header project-header">
        <h3 class="box-title">Attach Document</h3>
      </div>
      <div class="box-body">
            <div class="row">
          <div class="col-xs-12">
                  <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/staffs/sendDocument" enctype= "multipart/form-data" id="document_attach">
  <input type="hidden" name="user_id" value="<?php echo $staff['id']; ?>">
                 <div class="form-group">
            <label class="control-label col-sm-2" for="email">Document:</label>
            <div class="col-sm-10">
            	<input type="file" name="document_image[]" multiple="">
              
            </div>
          </div>


<div class="form-group">
            <label class="control-label col-sm-2" for="email">Message:</label>
            <div class="col-sm-10">
                          <textarea class="form-control" placeholder="Enter Message" name="message"></textarea>
            </div>
          </div>


          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default" name="Submit" value="save">Submit</button>
            </div>
          </div>
    </form>
           
         
          </div>
          
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
            <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/staffs/sendDocumentNotification" id="notification">
  <input type="hidden" name="user_id" value="<?php echo $staff['id']; ?>">
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


<div class="box">
      <div class="box-header project-header">
        <h3 class="box-title">Discussed Enquiry</h3>
      </div>
       <div class="box-body">
            <div class="row">
          <div class="col-xs-12">
          <table>
            <tr><td>Message Title</td></tr>
           <?php if(!empty($staffEnq)) 
            {
                foreach($staffEnq as $data)
              ?>
                 <tr><td><?php echo $data['message']; ?></td></tr>

         <?php } ?>
         </table>
          </div>
          
            </div>
          
        
        </div>
  </div>

    <tr><td><a href="<?php echo base_url(); ?>admin/staffs" class="btn btn-primary bg-blue pull-right ">Go Back</a></td></tr>

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
  $( "#document_attach" ).validate({
    errorClass: "error",
    rules: {
       message:{
        required: true
      }
     
    }
});
</script>

<script type="text/javascript">
  $( "#notification" ).validate({
    errorClass: "error",
    rules: {
       message:{
        required: true
      }
    }
});
</script>
