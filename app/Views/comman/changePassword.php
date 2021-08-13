<?= $this->extend('layout/layout') ?>

<?= $this->section('content') ?>

<div class="content-wrapper"> 

  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <!-- left column -->

        <div class="col-md-12">

          <!-- general form elements -->

          <div class="card card-primary">

            <div class="card-header">

              <h3 class="card-title">Change Password</h3>

            </div>

            <!-- /.card-header -->

            <!-- form start -->

            <form role="form" action='<?= base_url("users/change-password") ?>' method="post" enctype="multipart/form-data">

              <div class="card-body">

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">



                      <label for="exampleInputEmail1">Old Password</label>

                      <input type="password" class="form-control" value="" required  name="old_password" id="exampleText" placeholder="Old Password">

                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="exampleInputlastname">New Password</label>

                      <input type="password" class="form-control" required id="exampleInputlastname" value="" placeholder="New Password" name="new_password">

                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Confirm Password</label>

                      <input type="password" class="form-control" required id="exampleInputEmail1" placeholder="Confirm Password" name="confirm_password">

                    </div>

                  </div>

                </div>

              <!-- /.card-body -->

	              <div class="card-footer">

	                <button type="submit" class="btn btn-primary">Submit</button>

	              </div>

            </form>

          </div>

          <!-- /.card -->  

        </div>

        <!--/.col (right) -->

      </div>

      <!-- /.row -->

    </div><!-- /.container-fluid -->

  </section>

</div>





<?= $this->endSection('content') ?>