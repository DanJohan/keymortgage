 <style type="text/css">
.btn{
  padding: 3px 6px !important;
}
 </style>
 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <?php if($this->session->flashdata('msg') != ''): ?>
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
           
            <?= $this->session->flashdata('msg'); ?> 
          </div>
        <?php endif; ?>
   <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?php  echo $pageTitle; ?></h3>
		 
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
           <th>User Type</th>
          <th>Created At</th>
          <th style="width: 150px;" class="text-right">Option</th>
        </tr>
        </thead>
        <tbody>
          <?php if(!empty($all_staff)){
			  
			  foreach($all_staff as $row){ ?>
          <tr>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['role_name']; ?></td>
            <td><?= $row['created_at']; ?></td>
           <!--<td class="text-right">
		   
            <a class="btn btn-primary" data-toggle="tooltip" href="<?= base_url('admin/users/edit/'.$row['id']); ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
            <a class="btn btn-danger" data-toggle="tooltip" href="<?= base_url('admin/users/del/'.$row['id']); ?>" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
            
            </td>-->
			<td class="text-right">
			 <!--<a data-toggle="modal" id="view-detail" class="btn btn-success" data-toggle="tooltip" data-link="<?= base_url('admin/staffs/detail/'.$row['id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>-->
			 <a data-toggle="tooltip" href="<?= base_url('admin/staffs/detail/'.$row['id']); ?>"><i class="fa fa-eye"></i></a>
			 <a data-toggle="tooltip" href="<?= base_url('admin/staffs/edit/'.$row['id']); ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a  data-toggle="tooltip" onclick="return confirm('Are you sure to delete this record?')" href="<?= base_url('admin/staffs/del/'.$row['id']); ?>"><i class="fa fa-trash-o"></i></a>
			
			
			</td>
          </tr>
		  <?php }} ?>
        </tbody>
       
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$("#view_users").addClass('active');
</script>        

<?php $this->load->view('common/modal'); ?>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script> 
<script>
$(document).on('click','#view-detail',function(){
  $.ajax({
    url:$(this).data('link'),
    method:"POST",
    success:function(response){
        if(response) {
          $('.modal-content').html(response);
          $('#basicModal').modal();
        }
    }
  });
});
</script>        



