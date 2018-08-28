<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);
$cur_tab_link =   $this->uri->segment(3)==''?'index': $this->uri->segment(3);
if($cur_tab=='banks'){
  $cur_tab_link="b_".$cur_tab_link;
}
if($cur_tab=='users'){
  $cur_tab_link="u_".$cur_tab_link;
}
if($cur_tab=='projects'){
  $cur_tab_link="p_".$cur_tab_link;
}

?>  

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- <img src="<?= base_url() ?>public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
        </div>
        <div class="pull-left info">
         <!--  <p><?= ucwords($this->session->userdata('name')); ?></p> -->
         <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
        <li id="dashboard" class="treeview ">
          <a href="<?= base_url('admin/dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
           </a>
        </li>

        <li id="" class="treeview users">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
                <ul class="treeview-menu">
                  <li id="u_index" class=""><a href="<?= base_url('admin/users'); ?>"><i class="fa fa-circle-o"></i>View User</a></li>
            <li id="u_index" class=""><a href="<?= base_url('admin/staffs'); ?>"><i class="fa fa-circle-o"></i>View Staff</a></li>
    		<li id="u_add" class=""><a href="<?= base_url('admin/users/add'); ?>"><i class="fa fa-circle-o"></i> Add User</a></li>

                 </ul>
          </li>

       <!-- <li id="" class="treeview projects">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>projects</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
              <ul class="treeview-menu">
                <li id="project_list" class=""><a href="<?= base_url('admin/projects/project_list'); ?>"><i class="fa fa-circle-o"></i> View project</a></li>
                 <li id="projectadd" class=""><a href="<?= base_url('admin/projects/projectadd'); ?>"><i class="fa fa-circle-o"></i> Add project</a></li>
               </ul>
          </li>-->

       <li id="" class="treeview projects">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Projects</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="p_index" class=""><a href="<?= base_url('admin/projects'); ?>"><i class="fa fa-circle-o"></i> View project</a></li>
               <li id="p_add" class=""><a href="<?= base_url('admin/projects/add'); ?>"><i class="fa fa-circle-o"></i> Add project</a></li>
             </ul>
          </li>





        <li id="" class="treeview banks">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Banks</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="b_index" class=""><a href="<?= base_url('admin/banks'); ?>"><i class="fa fa-circle-o"></i> View Banks</a></li>
               <li id="b_add" class=""><a href="<?= base_url('admin/banks/add'); ?>"><i class="fa fa-circle-o"></i> Add Banks</a></li>
             </ul>
          </li>
    </ul>



     
    </section>
    <!-- /.sidebar -->
  </aside>

  
<script>
  $(".<?php echo $cur_tab; ?>").addClass('active');
  $("#<?php echo $cur_tab_link; ?>").addClass('active');
</script>
