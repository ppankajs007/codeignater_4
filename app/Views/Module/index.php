<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Module List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item active">Module List</li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Modules</h3>
              <?php //if( permissionUsers(currentUserId(),'user_add') ): ?>
              <!--<a class="btn btn-success float-sm-right" href="<?= base_url('modules/add') ?>">Add Module</a>-->
              <?php //endif; ?>
              <button type="button" class="btn btn-success float-sm-right" data-toggle="modal" data-target="#modal-Module"> <i class="fa fa-plus"></i> Add Module </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="datatable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Permission Module</th>
                    <th>Added On</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<div class="modal fade" id="modal-Module">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Permission Module</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <form action="<?= base_url('modules/add') ?>" method="post">
        <input type="hidden" name="modules_id" class="modules_id" id="modules_id" value="">
        <div class="modal-body">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-12 col-form-label">Permission Module Name</label>
            <div class="col-sm-12">
              <input type="text" class="form-control pmodule_name" id="name" placeholder="Permission Module Name" name="name" autocomplete="off" >
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection('content') ?>
<?= $this->section('scripts') ?>
<script>
function editFunc(id)
{
var data = {id: id};
$.ajax({
type: "POST",
url: "<?php echo base_url('/modules/fetch');?>",
data: data,
success: function(data)
{
var res = JSON.parse(data);
$('#modal-Module .modal-title').text('Edit Permission Module');
$('#modules_id').val(res.id);
$('#name').val(res.name);
$('#modal-Module').modal('show');
},
error: function(err)
{
alert(JSON.stringify(err));
}
});
}
function delfunc()
{
if(!confirm('Are you sure?')) return false;
}
</script>
<script>
$('#datatable').DataTable({
  processing: true,
  serverSide: true,
  autoWidth: false,
  order: [[1, "desc"]],   
  ajax:{
    url: '<?php echo base_url('/modules/getjson');?>'
  },
  columns: [
	  {data: 'name', name: 'name'},
	  {data: 'created_at', name: 'created_at'},
	  {data: 'action', name: 'action'}
  ]
});
</script>
<?= $this->endSection('scripts') ?>
