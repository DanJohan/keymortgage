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
          <th>Bank Logo</th>
          <th>Bank Name</th>
          <th>Bank Url</th>
          <th>Created At</th>
          <th style="width: 150px;" class="text-right">Option</th>
        </tr>
        </thead>
        <tbody>
          <?php 
		  if(!empty($BankData))
		  {
		  foreach($BankData as $row) {?>
		  
          <tr>
            <th>
              <?php if(!empty($row['bank_logo']))
                      {
                        ?>
                         <img height="30px" width="30px"  src="<?php echo base_url();?>uploads/banks/<?php echo $row['bank_logo']; ?>" alt="<?php echo $row['bank_name']; ?>">
                      <?php } else {
                    ?>
                     <img src="<?php echo base_url();?>public/images/no-img.jpg" alt="No image" height="30px" width="30px">
                     <?php   } ?>
             
                


              </th>
            <td><?= $row['bank_name']; ?></td>
            <td><?= $row['bank_domain']; ?></td>
            <td><?= $row['created_at']; ?></td>
          	<td class="text-right">
			 <!--<a data-toggle="modal" id="view-detail" class="btn btn-success" data-toggle="tooltip" data-link="<?= base_url('admin/banks/detail/'.$row['bank_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>-->
			 <a data-toggle="tooltip" href="<?= base_url('admin/banks/edit/'.$row['bank_id']); ?>"><i class="fa fa-edit"></i></a>
			&nbsp;&nbsp;<a  data-toggle="tooltip" onclick="return confirm('Are you sure to delete this record?')" href="<?= base_url('admin/banks/del/'.$row['bank_id']); ?>"><i class="fa fa-trash-o"></i></a>
			
			
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



