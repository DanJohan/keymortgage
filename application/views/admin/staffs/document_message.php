
<div class="modal-header orange_header">
    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
        <h3 class="modal-title">Enter Message</h3>
</div>
<div class="modal-body model_view" align="center">&nbsp;
      <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/users/sendDocumentNotification">
          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
               



