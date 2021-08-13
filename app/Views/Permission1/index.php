<?= $this->extend('layout/layout') ?>
<?= $this->section('content') ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permission Modules</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
              <li class="breadcrumb-item active">Permission Modules</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Permission Modules</h3>
                <button type="button" class="btn btn-success float-sm-right" data-toggle="modal" data-target="#modal-default">
                  Add Permisson
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr. No.</th>
                    <th>Permission</th>
                    <th>Added</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if( !empty($permission) ){ 
                    		$i = 1;
                    		foreach ($permission as $key => $value) { ?>
                    			<tr>
                    				<td><?= $i; ?></td>
                    				<td><?= $value['name']; ?></td>
                    				<td><?= $value['created_at']; ?></td>
                    				<td>
                    					<a class="btn editPerModule" data-toggle="modal" data-target="#modal-default"  href="javscript:;" data-name="<?= $value['name']; ?>" data-id="<?= $value['pmodules_id'] ?>">
                                       		<i class="fas fa-edit"></i>
                                    	</a>
                                    	<a class="btn userDelete" href="" onclick="return confirm('Are you sure you want to delete this item?');">
                                      		<i class="fas fa-trash"></i>
                                    	</a>
                                    </td>
                    			</tr>
                    <?php $i++; } } ?>
                  </tbody>
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
  <?= $this->include('modals/addPermissionsModules'); ?>
<?= $this->endSection('content') ?>