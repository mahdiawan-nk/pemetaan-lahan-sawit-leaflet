<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?=$page;?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=base_url();?>dashboard"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?=$page;?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
			Add <?=$page;?>
		</button>
		<br><br>
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success">
				<?= $this->session->flashdata('success'); ?>
			</div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger">
				<?= $this->session->flashdata('error'); ?>
			</div>
		<?php endif; ?>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama_Pengguna</th>
                        <th>Email</th>
						<th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
					<?php $i = 1; ?>
                    <?php foreach ($user as $m) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $m->nama_pengguna;?></td>
                        <td><?= $m->email;?></td>
						<?php $status = $m->is_aktif;?>
                        <td>
							<?php if ($status === '1') : ?>
								<span class="badge badge-success">Active</span>
							<?php else : ?>
								<span class="badge badge-danger">Inactive</span>
							<?php endif; ?>
						</td>
						<td>
							<a href="./user/change_status/<?= $m->id; ?>/<?= $m->is_aktif; ?>" class="badge badge-warning">Status</a>
							<a href="" class="badge badge-info" data-bs-toggle="modal" data-bs-target="#edituser<?= $m->id; ?>">Edit</a>
                            <a href="" class="badge badge-danger" data-bs-toggle="modal" data-bs-target="#hapususer<?= $m->id; ?>">Hapus</a>
						</td>
                        
                    </tr>
					<?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                
                </tfoot>
            </table>
        <div class="row">
            
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- Modal structure -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Add <?=$page;?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form id="modalForm" method="POST" action="<?= base_url('user/submit_form'); ?>">
          <div class="mb-3">
            <label for="exampleInput" class="form-label">Nama Pengguna</label>
            <input type="text" name="nama_pengguna" class="form-control" id="exampleInput" placeholder="Enter Nama Pengguna" required>
          </div>
		  <div class="mb-3">
            <label for="exampleInput" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInput" placeholder="Enter Email" required>
          </div>
		  <div class="mb-3">
            <label for="exampleInput" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInput" placeholder="Enter Password" required>
          </div>
      </div>
      <div class="modal-footer">
		 <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<?php foreach ($user as $m) : ?>
<!-- Edit User Modal -->
<div class="modal fade" id="edituser<?= $m->id; ?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">Edit <?=$page;?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Edit Form -->
                <form id="editUserForm" method="POST" action="<?= site_url('user/update/'.$m->id); ?>">
                    <div class="mb-3">
                        <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                        <input type="text" name="nama_pengguna" class="form-control" id="nama_pengguna" value="<?= $m->nama_pengguna; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?= $m->email; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php foreach ($user as $m) : ?>
<!-- Delete User Modal -->
<div class="modal fade" id="hapususer<?= $m->id; ?>" tabindex="-1" aria-labelledby="hapusUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusUserLabel">Hapus <?=$page;?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- Confirmation Message -->
                <p>Apa Yakin Menghapus Data User <b><?=$m->nama_pengguna;?></b></p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="<?= site_url('user/delete/'.$m->id); ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
</body>

</html>
