<section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Notification</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body my-form-body">
              <form id="notification_form" class="form-horizontal" method="post" action="<?php echo base_url()?>admin/notification/create">

                  <div class="form-group">
                    <label class="control-label col-sm-2" for="message">Message:</label>
                    <div class="col-sm-10"> 
                      <textarea type="text" class="form-control" name="message" id="message" placeholder="Enter message"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="">Send to:</label>
                    <div class="col-sm-10"> 
                      <select class="form-control" id="send_to" name="send_to" />
                          <option value="">Please select</option>
                          <option value="0">All users</option>
                          <?php
                            if(!empty($userRoles)) {
                              foreach ($userRoles as $index => $role) {
                          ?>
                            <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']?></option>
                          <?php
                              }
                            }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" name="submit" value="save">Submit</button>
                    </div>
                  </div>
              </form>
        </div>
          <!-- /.box-body -->
  </div>  

</section> 
<script type="text/javascript" src="<?php echo base_url(); ?>public/dist/js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $( "#notification_form" ).validate({
    debug:true,
    errorClass: "error",
    rules: {
      message:{
        required: true,
        min:50,
        max:200
      },
      send_to:{
        required:true
      }
    }
});
</script>