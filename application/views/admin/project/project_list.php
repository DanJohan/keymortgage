 <style type="text/css">
.btn{
  padding: 3px 6px !important;
}
 </style>
 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">  

 <section class="content">
  <?php $this->load->view('common/flashmessage'); ?>
   <div class="box">
    <div class="box-header">
      <h3 class="box-title"><?php  echo $pageTitle; ?></h3>
		 
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>Project Name</th>
          <th>Location</th>
		      <th>Cost</th>
           <th>Size</th>
		      <th>Type</th>
          <!--<th>Description</th>-->
          <th>Created At</th>
          <th>Updated At</th>
          <th style="width: 80px;" class="text-right">Option</th>
        </tr>
        </thead>
        <tbody>
          <?php 
		  if(!empty($all_Project))
		  {
		  foreach($all_Project as $row) {?>
		  
        <tr>
          <td><?= $row['name']; ?></td>
          <td><?= $row['location']; ?></td>
          <td><?= $row['cost']; ?></td>
          <td><?= $row['size']; ?></td>
	  <td><?= $row['cat_name']; ?></td>
        <!--<td><?= $row['description']; ?></td>-->
	  <td><?= $row['created_at']; ?></td>
          <td><?= $row['updated_at']; ?></td>
          
          <td class="text-right">
			 <a data-toggle="modal" id="view-detail" class="btn btn-success" data-toggle="tooltip" data-link="<?= base_url('admin/projects/detail/'.$row['id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
			 <a data-toggle="tooltip" href="<?= base_url('admin/projects/edit/'.$row['id']); ?>"><i class="fa fa-edit"></i></a>
			&nbsp;&nbsp;<a  data-toggle="tooltip" onclick="return confirm('Are you sure to delete this record?')" href="<?= base_url('admin/projects/del/'.$row['id']); ?>"><i class="fa fa-trash-o"></i></a>
			
			
			</td>
          </tr>
          <?php }
		  }		  ?>
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



