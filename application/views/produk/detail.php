<div class="main-content">
    <section class="section">
        <div class="section-header">
    		<h1><?php echo $title ?></h1>
    		<div class="section-header-breadcrumb">
    			<a href="<?php echo base_url('Produk') ?>" class="btn btn-warning btn-xs"><i class="fas-fa-redo"></i> Kembali</a>
    		</div>
    	</div>
    </section>
    <?php echo $this->session->flashdata('sukses'); ?>
    <div class="row">
    	<div class="col-lg-4 col-md-4 col-xs-4">
    		<?php if($row->image) { ?>
    		<div class="card" style="width: auto;" align="center">
			  	<a href="https://mitrabagja.com/upload/produk/<?= $row->image ?>" data-lightbox="<?php echo $row->nama ?>" data-title="<?php echo $row->nama ?>" class="mt-3"><img src="https://mitrabagja.com/upload/produk/<?= $row->image ?>" alt="<?php echo $row->nama ?>" class="img img-thumbnail" width="auto"></a>
			  	<div class="card-body">
	    			<table class="table-striped table-hover w-100">
	    				<tr>
	    					<td>Nama Produk</td>
	    					<td>: <?php echo $row->nama ?></td>
	    				</tr>
	    				<?php if($row->id_kategori) { 
		    				$this->db->from('mst_kategori')
		    				->where('id', $row->id_kategori);
		    				$query = $this->db->get()->row();
		    			?>
		    			<tr>
	    					<td>Kategori</td>
	    					<td>: <?php echo $query->kategori ?></td>
	    				</tr>
		    			<?php } ?>
	    				<?php if($row->h_stok > 0) { 
	    				$this->db->from('mst_stok')
	    				->where('id_produk', $row->id);
	    				$query = $this->db->get()->row();
	    				$stok = $query->stok;
	    				?>
	    				<tr>
	    					<td>Stok</td>
	    					<td>: <?php echo $stok ?></td>
	    				</tr>
	    				<?php } ?>
	    				<tr>
	    					<td>Harga Dasar</td>
	    					<td>: Rp. <?php echo number_format($row->hpp) ?></td>
	    				</tr>
	    				<tr>
	    					<td>Harga Jual</td>
	    					<td>: Rp. <?php echo number_format($row->harga) ?></td>
	    				</tr>
	    				<?php if($row->discount) { ?>
	    				<tr>
	    					<td>Nilai Diskon</td>
	    					<td>: Rp. <?php echo number_format($row->discount) ?></td>
	    				</tr>
		    			<?php } ?>
	    			</table>
			  	</div>
			</div>
			<?php } else { ?>
			<div class="card" style="width: auto;" align="center">
			  	<div class="card-body">
	    			<table class="table-striped table-hover w-100">
	    				<tr>
	    					<td>Nama Produk</td>
	    					<td>: <?php echo $row->nama ?></td>
	    				</tr>
	    				<?php if($row->id_kategori) { 
		    				$this->db->from('mst_kategori')
		    				->where('id', $row->id_kategori);
		    				$query = $this->db->get()->row();
		    			?>
		    			<tr>
	    					<td>Kategori</td>
	    					<td>: <?php echo $query->kategori ?></td>
	    				</tr>
		    			<?php } ?>
	    				<?php if($row->h_stok > 0) { 
	    				$this->db->from('mst_stok')
	    				->where('id_produk', $row->id);
	    				$query = $this->db->get()->row();
	    				$stok = $query->stok;
	    				?>
	    				<tr>
	    					<td>Stok</td>
	    					<td>: <?php echo $stok ?></td>
	    				</tr>
	    				<?php } ?>
	    				<tr>
	    					<td>Harga Dasar</td>
	    					<td>: Rp. <?php echo number_format($row->hpp) ?></td>
	    				</tr>
	    				<tr>
	    					<td>Harga Jual</td>
	    					<td>: Rp. <?php echo number_format($row->harga) ?></td>
	    				</tr>
	    				<?php if($row->discount) { ?>
	    				<tr>
	    					<td>Nilai Diskon</td>
	    					<td>: Rp. <?php echo number_format($row->discount) ?></td>
	    				</tr>
		    			<?php } ?>
	    			</table>
			  	</div>
			</div>
			<?php } ?>
		</div>
    	<div class="col-lg-8 col-md-8 col-xs-8">
    		<div class="container-fluid">
    			<div class="col-md-12">
    				<div class="card card-shadow" style="width: auto;">
			  			<div class="card-body">
		    				<ul class="nav nav-tabs">
		    					<?php $tab = (isset($tab)) ? $tab : 'detail'; ?>
								<li class="nav-item">
							    	<a class="nav-link <?php echo $tab == 'detail' ? 'active' : ''; ?>" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">Informasi</a>
							  	</li>
							  	<?php if($row->h_topping > 0) { ?>
							  	<li class="nav-item">
							    	<a class="nav-link <?php echo $tab == 'topping' ? 'active' : ''; ?>" id="topping-tab" data-toggle="tab" href="#topping" role="tab" aria-controls="topping" aria-selected="true">Topping</a>
							  	</li>
								<?php } if($row->h_ukuran > 0) { ?>
								<li class="nav-item">
								    <a class="nav-link <?php echo $tab == 'ukuran' ? 'active' : ''; ?>" id="ukuran-tab" data-toggle="tab" href="#ukuran" role="tab" aria-controls="ukuran" aria-selected="false">Ukuran</a>
								</li>
								<?php } if($row->h_split > 0) { ?>
							 	<li class="nav-item">
							    	<a class="nav-link <?php echo $tab == 'split' ? 'active' : ''; ?>" id="split-tab" data-toggle="tab" href="#split" role="tab" aria-controls="split" aria-selected="false">Split</a>
							  	</li>
							  	<?php } if($row->h_status > 0) { ?>
							  	<li class="nav-item">
							    	<a class="nav-link <?php echo $tab == 'status' ? 'active' : ''; ?>" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Status</a>
							  	</li>
							  	<?php } ?>
							</ul>
							<div class="tab-content">
								<!-- Tab Update Produk -->
							 	<div class="tab-pane fade <?php echo $tab == 'detail' ? 'show' : ''; ?> <?php echo $tab == 'detail' ? 'active' : ''; ?>" id="detail" role="tabpanel" aria-labelledby="detail-tab" style="">
                                     <form method="post" enctype="multipart/form-data" id="form_produk">
                                        <input type="hidden" name="id" id="id"> 
							 			<div class="form-group">
							 				<label for="nama" class="control_label">Nama Produk</label>
							 				<input type="hidden" value="<?php echo $row->id ?>" name="id">
							 				<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $row->nama ?>" autocomplete="off">
							 				<span id="nama-error" class="help-block text-danger p-1"></span>
							 			</div>
							 			<div class="row">
							 				<div class="col-lg-4 col-md-4 col-xs-4">
							 					<div class="form-group">
									 				<label for="hpp" class="control_label">Harga Pokok Penjualan</label>
									 				<div class="input-group mb-2">
												        <div class="input-group-prepend">
												         	<div class="input-group-text">Rp.</div>
												        </div>
												        <input type="text" class="form-control" name="hpp" id="hpp" autocomplete="off">
												    </div>
									 				<span id="hpp-error" class="help-block text-danger p-1"></span>
									 			</div>
							 				</div>
							 				<div class="col-lg-4 col-md-4 col-xs-4">
							 					<div class="form-group">
									 				<label for="harga" class="control_label">Harga</label>
									 				<div class="input-group mb-2">
												        <div class="input-group-prepend">
												         	<div class="input-group-text">Rp.</div>
												        </div>
												        <input type="text" class="form-control" name="harga" id="harga" autocomplete="off">
												    </div>
									 				<span id="harga-error" class="help-block text-danger p-1"></span>
									 			</div>
							 				</div>
							 				<div class="col-lg-4 col-md-4 col-xs-4">
							 					<div class="form-group">
									 				<label for="discount" class="control_label">Nilai Diskon</label>
									 				<div class="input-group mb-2">
												        <div class="input-group-prepend">
												         	<div class="input-group-text">Rp.</div>
												        </div>
												        <input type="text" class="form-control" name="discount" id="discount" autocomplete="off">
												    </div>
									 			</div>
							 				</div>
							 			</div>
							 			<div class="row">
							 				<div class="col-lg-2 col-md-2 col-xs-2">
							 					<div class="form-group">
							 						<label for="id_kategori" class="control-label">Kategori</label>
							 						<select name="id_kategori" id="id_kategori" class="form-control">
							 							<?php if($row->id_kategori == null) { ?>
							 							<option selected disabled hidden>--PILIH--</option>
							 							<?php foreach($kategori as $kategori) { ?>
							 							<option value="<?php echo $kategori->id ?>"><?php echo $kategori->kategori ?></option>
							 							<?php }} else { 
							 								foreach($kategori as $kategori) {
							 							?>
							 							<option value="<?php echo $kategori->id ?>" <?php echo $kategori->id == $row->id_kategori ? 'selected' : null ?>><?php echo $kategori->kategori ?></option>
							 							<?php }} ?>
							 						</select>
							 					</div>
							 				</div>
							 				<div class="col-lg-2 col-md-2 col-xs-2">
							 					<div class="form-group">
							 						<label for="h_stok" class="control-label">Stok</label>
							 						<select name="h_stok" id="h_stok" class="form-control">
							 							<option value="1" <?php echo $row->h_stok == 1 ? 'selected' : null ?>>Ada</option>
							 							<option value="0" <?php echo $row->h_stok == 0 ? 'selected' : null ?>>Tidak Ada</option>
							 						</select>
							 					</div>
							 				</div>
							 				<div class="col-lg-2 col-md-2 col-xs-2">
							 					<div class="form-group">
							 						<label for="h_topping" class="control-label">Topping</label>
							 						<select name="h_topping" id="h_topping" class="form-control">
							 							<option value="1" <?php echo $row->h_topping == 1 ? 'selected' : null ?>>Ada</option>
							 							<option value="0" <?php echo $row->h_topping == 0 ? 'selected' : null ?>>Tidak Ada</option>
							 						</select>
							 					</div>
							 				</div>
							 				<div class="col-lg-2 col-md-2 col-xs-2">
							 					<div class="form-group">
							 						<label for="h_ukuran" class="control-label">Ukuran</label>
							 						<select name="h_ukuran" id="h_ukuran" class="form-control">
							 							<option value="1" <?php echo $row->h_ukuran == 1 ? 'selected' : null ?>>Ada</option>
							 							<option value="0" <?php echo $row->h_ukuran == 0 ? 'selected' : null ?>>Tidak Ada</option>
							 						</select>
							 					</div>
							 				</div>
							 				<div class="col-lg-2 col-md-2 col-xs-2">
							 					<div class="form-group">
							 						<label for="h_split" class="control-label">Split</label>
							 						<select name="h_split" id="h_split" class="form-control">
							 							<option value="1" <?php echo $row->h_split == 1 ? 'selected' : null ?>>Ada</option>
							 							<option value="0" <?php echo $row->h_split == 0 ? 'selected' : null ?>>Tidak Ada</option>
							 						</select>
							 					</div>
							 				</div>
							 				<div class="col-lg-2 col-md-2 col-xs-2">
							 					<div class="form-group">
							 						<label for="h_status" class="control-label">Status</label>
							 						<select name="h_status" id="h_status" class="form-control">
							 							<option value="1" <?php echo $row->h_status == 1 ? 'selected' : null ?>>Ada</option>
							 							<option value="0" <?php echo $row->h_status == 0 ? 'selected' : null ?>>Tidak Ada</option>
							 						</select>
							 					</div>
							 				</div>
							 			</div>
							 			<div class="form-group">
							 				<label for="image" class="control_label">Gambar Produk</label>
							 				<?php if($row->image) { ?>
							 				<input name="image" id="image" type="file" class="dropify" data-max-file-size="5M" data-show-errors="true" data-allowed-file-extensions="jpg png jpeg" data-default-file="https://mitrabagja.com/upload/produk/<?= $row->image ?>"/>
							 				<?php } else { ?>
							 					<input name="image" id="image" type="file" class="dropify" data-max-file-size="5M" data-show-errors="true" data-allowed-file-extensions="jpg png jpeg"/>
							 				<?php } ?>
							 			</div>
									 	<div class="form-group" align="right">
									 		<button type="button" class="btn btn-primary btn-xs" id="validasi_produk"><i class="fas fa-exclamation"></i> Validasi</button>
											<button type="button" class="btn btn-success btn-xs" id="submit_update"><i class="fas fa-paper-plane"></i> Update</button>
										</div>
							 		</form>
							 	</div>
							 	<!-- Tab topping -->
							 	<?php if($row->h_topping > 0) { ?>
							 	<div class="tab-pane fade <?php echo $tab == 'topping' ? 'show' : ''; ?> <?php echo $tab == 'topping' ? 'active' : ''; ?>" id="topping" role="tabpanel" aria-labelledby="topping-tab">
							 		<div align="right" class="mb-3">
							 			<button class="btn btn-success btn-xs" type="button" id="btn_trigger_modal_topping"><i class="fas fa-plus"></i> Tambah Topping</button>
							 		</div>
							 		<div class="table-responsive">
								 		<table id="table_topping" class="table table-striped table-hover w-100">
								 			<thead>
								 				<tr>
									 				<th width="5%">No.</th>
									 				<th>Topping</th>
									 				<th>Harga</th>
									 				<th width="12%">Aksi</th>
									 			</tr>
								 			</thead>
								 			<tbody>
								 			</tbody>
								 		</table>
								 	</div>
							 		<!-- modal form topping -->
							 		<div class="modal fade" id="modal_topping" role="dialog" aria-hidden="true">
									  	<div class="modal-dialog modal-lg" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header bg-primary">
									        		<h5 class="modal-title font-weight-bold text-white " id="judul_modal_topping"></h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									         		 <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
									        		</button>
									      		</div>
									        	<form id="form_topping" autocomplete="off">
										            <div class="modal-body">
										            	<div class="form-group">
											 				<label for="topping" class="control-label">Topping</label>
											 				<input type="hidden" id="id_topping" name="id">
											 				<input type="hidden" name="id_produk" value="<?php echo $row->id ?>">
											 				<input type="hidden" id="method_topping">
											 				<input type="text" class="form-control" id="topping_topping" name="topping" autocomplete="off">
											 				<span class="help-block"></span>
											 			</div>
											 			<div class="form-group">
											 				<label for="harga_topping" class="control-label">Harga</label>
											 				<input type="text" class="form-control" id="harga_topping" name="harga" autocomplete="off">
											 				<span class="help-block"></span>
											 			</div>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										                <button type="button" class="btn btn-primary" id="btn_save_topping">Simpan</button>
										            </div>
									        	</form>
									    	</div>
									  	</div>
									</div>
							 	</div>
							 	<!-- tab ukuran -->
							 	<?php } if($row->h_ukuran > 0) { ?>
								<div class="tab-pane fade <?php echo $tab == 'ukuran' ? 'show' : ''; ?> <?php echo $tab == 'ukuran' ? 'active' : ''; ?>" id="ukuran" role="tabpanel" aria-labelledby="ukuran-tab">
									<div align="right" class="mb-3">
							 			<button class="btn btn-success btn-xs" type="button" id="btn_trigger_modal_ukuran"><i class="fas fa-plus"></i> Tambah Ukuran</button>
							 		</div>
							 		<div class="table-responsive">
								 		<table id="table_ukuran" class="table table-striped table-hover w-100">
								 			<thead>
								 				<tr>
									 				<th width="5%">No.</th>
									 				<th>Ukuran</th>
									 				<th>Harga</th>
									 				<th width="12%">Aksi</th>
									 			</tr>
								 			</thead>
								 			<tbody>
								 			</tbody>
								 		</table>
								 	</div>
							 		<!-- modal form topping -->
							 		<div class="modal fade" id="modal_ukuran" role="dialog" aria-hidden="true">
									  	<div class="modal-dialog modal-lg" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header bg-primary">
									        		<h5 class="modal-title font-weight-bold text-white " id="judul_modal_ukuran"></h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									         		 <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
									        		</button>
									      		</div>
									        	<form id="form_ukuran" autocomplete="off">
										            <div class="modal-body">
										            	<div class="form-group">
											 				<label for="ukuran_ukuran" class="control-label">Ukuran</label>
											 				<input type="hidden" id="id_ukuran" name="id">
											 				<input type="hidden" name="id_produk" value="<?php echo $row->id ?>">
											 				<input type="hidden" id="method_ukuran">
											 				<input type="text" class="form-control" id="ukuran_ukuran" name="ukuran" autocomplete="off">
											 				<span class="help-block"></span>
											 			</div>
											 			<div class="form-group">
											 				<label for="harga_ukuran" class="control-label">Harga</label>
											 				<input type="text" class="form-control" id="harga_ukuran" name="harga" autocomplete="off">
											 				<span class="help-block"></span>
											 			</div>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										                <button type="button" class="btn btn-primary" id="btn_save_ukuran">Simpan</button>
										            </div>
									        	</form>
									    	</div>
									  	</div>
									</div>
								</div>
								<!-- tab split -->
							 	<?php } if($row->h_split > 0) { ?>
								<div class="tab-pane fade <?php echo $tab == 'split' ? 'show' : ''; ?> <?php echo $tab == 'split' ? 'active' : ''; ?>" id="split" role="tabpanel" aria-labelledby="split-tab">
									<div align="right" class="mb-3">
							 			<button class="btn btn-success btn-xs" type="button" id="btn_trigger_modal_create_split"><i class="fas fa-plus"></i> Tambah Split</button>
							 		</div>
							 		<div class="table-responsive">
								 		<table id="table_split" class="table table-striped table-hover w-100">
								 			<thead>
								 				<tr>
									 				<th width="5%">No.</th>
									 				<th>Pihak</th>
									 				<th>Bagian</th>
									 				<th width="12%">Aksi</th>
									 			</tr>
								 			</thead>
								 			<tbody>
								 			</tbody>
								 		</table>
								 	</div>
							 		<!-- modal form create split -->
							 		<div class="modal fade" id="modal_create_split" role="dialog" aria-hidden="true">
									  	<div class="modal-dialog modal-lg" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header bg-primary">
									        		<h5 class="modal-title font-weight-bold text-white " id="judul_modal_create_split"></h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									         		 <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
									        		</button>
									      		</div>
									        	<form id="form_create_split" autocomplete="off">
										            <div class="modal-body">
										            	<div class="input_fields_wrap">
											            	<div class="form-group">
											            		<div class="row">
												            		<div align="left" class="col-md-11">
												            			<p class="pihak_split">Pihak 1</p>
												            		</div>
													            	<div align="right" class="col-md-1">
										      							<button type="button" class="btn btn-info btn-xs add_pihak">
																			<i class="fas fa-plus"></i>
																		</button>
																	</div>
																</div>
												            	<hr>
												 				<label class="control-label">Nama Pihak</label>
												 				<input type="hidden" name="harga_asli" value="<?php echo $row->harga ?>">
												 				<input type="hidden" name="id_produk" value="<?php echo $row->id ?>">
												 				<input type="hidden" id="method_split">
												 				<input type="text" class="form-control split_split" name="split[]" autocomplete="off">
												 				<span class="help-block"></span>
												 			</div>
												 			<div class="form-group">
												 				<label class="control-label">harga</label>
												 				<input type="number" class="form-control harga_split" name="harga[]" autocomplete="off">
												 				<span class="help-block"></span>
												 			</div>
												 		</div>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										                <button type="button" class="btn btn-primary" id="btn_create_split">Simpan</button>
										            </div>
									        	</form>
									    	</div>
									  	</div>
									</div>
									<!-- modal form update split -->
							 		<div class="modal fade" id="modal_update_split" role="dialog" aria-hidden="true">
									  	<div class="modal-dialog modal-lg" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header bg-primary">
									        		<h5 class="modal-title font-weight-bold text-white " id="judul_modal_update_split"></h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									         		 <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
									        		</button>
									      		</div>
									        	<form id="form_update_split" autocomplete="off">
										            <div class="modal-body">
										            	<div class="form-group">
											 				<label class="control-label">Nama Pihak</label>
											 				<input type="hidden" name="id" id="id_split">
											 				<input type="hidden" name="id_produk" id="id_produk_split">
											 				<input type="hidden" name="harga_split" id="harga_akumulasi_split">
											 				<input type="hidden" name="harga_asli" value="<?php echo $row->harga ?>">
											 				<input type="text" class="form-control" name="split" id="split_split" autocomplete="off">
											 				<span class="help-block"></span>
											 			</div>
											 			<div class="form-group">
											 				<label class="control-label">harga</label>
											 				<input type="text" class="form-control" name="harga" id="harga_split" autocomplete="off">
											 				<span class="help-block"></span>
											 			</div>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										                <button type="button" class="btn btn-primary" id="btn_update_split">Simpan</button>
										            </div>
									        	</form>
									    	</div>
									  	</div>
									</div>
								</div>
								<!-- tab status -->
								<?php } if($row->h_status > 0) { ?>
								<div class="tab-pane fade <?php echo $tab == 'status' ? 'show' : ''; ?> <?php echo $tab == 'status' ? 'active' : ''; ?>" id="status" role="tabpanel" aria-labelledby="status-tab">
									<div align="right" class="mb-3">
							 			<button class="btn btn-success btn-xs" type="button" id="btn_trigger_modal_status"><i class="fas fa-plus"></i> Tambah Status</button>
							 		</div>
							 		<div class="table-responsive">
								 		<table id="table_status" class="table table-striped table-hover w-100">
								 			<thead>
								 				<tr>
									 				<th width="5%">No.</th>
									 				<th>Status</th>
									 				<th width="12%">Aksi</th>
									 			</tr>
								 			</thead>
								 			<tbody>
								 			</tbody>
								 		</table>
								 	</div>
							 		<!-- modal form topping -->
							 		<div class="modal fade" id="modal_status" role="dialog" aria-hidden="true">
									  	<div class="modal-dialog modal-lg" role="document">
									    	<div class="modal-content">
									      		<div class="modal-header bg-primary">
									        		<h5 class="modal-title font-weight-bold text-white " id="judul_modal_status"></h5>
									        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									         		 <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
									        		</button>
									      		</div>
									        	<form id="form_status" autocomplete="off">
										            <div class="modal-body">
										            	<div class="form-group">
											 				<label for="status_status" class="control-label">Status</label>
											 				<input type="hidden" id="id_status" name="id">
											 				<input type="hidden" name="id_produk" value="<?php echo $row->id ?>">
											 				<input type="hidden" id="method_status">
											 				<input type="text" class="form-control" id="status_status" name="status" autocomplete="off">
											 				<span class="help-block"></span>
											 			</div>
										            </div>
										            <div class="modal-footer">
										                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
										                <button type="button" class="btn btn-primary" id="btn_save_status">Simpan</button>
										            </div>
									        	</form>
									    	</div>
									  	</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<script>
	$(document).ready(function() {
		// ambil id untuk parameter
		var id = $(location).attr('href').split("/").splice(6).join("/");
		// counter
		var x 				= 1;
		// hilangkan button2 penting
		$('#submit_update').hide();
		$('.help-block').hide();
		// clear help block setiap ganti tab
		$('.nav-item').click(function(event) {
			$('.help-block').hide();
		});
		// kondisi munculnya tombol tambah split, kalau nggak ada sisa bagi, ilangin
		$.ajax({
            url : '<?php echo base_url("Split/get_bahan_hitung")?>/'+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
            	if(data.nilai_split != null)
            	{
	            	$('#harga_akumulasi_split').val(data.nilai_split);
	                if(data.nilai_split >= data.harga)
	                {
	                	$('#btn_trigger_modal_create_split').hide();
	                }
	                else
	                {
	                	$('#btn_trigger_modal_create_split').show();
	                }
	            }
	            else                
                {
                	$('#btn_trigger_modal_create_split').show();
                }
            }
        });
		// tabel topping
		var table_topping = $('#table_topping').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Topping/read')?>",
                "type": "POST",
                "data": {id: id},
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });
        // tabel split
        var table_split = $('#table_split').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Split/read')?>",
                "type": "POST",
                "data": {id: id},
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });
        // tabel ukuran
        var table_ukuran = $('#table_ukuran').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Ukuran/read')?>",
                "type": "POST",
                "data": {id: id},
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });
        // tabel status
        var table_status = $('#table_status').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Status/read')?>",
                "type": "POST",
                "data": {id: id},
            },
            "columnDefs": [{
                "targets": [0, 2],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            }
        });

		// untuk simpan produk
		$('#submit_update').on('click', function () {
			
			url     = "<?php echo base_url('Produk/proses_update')?>";
			url_api = "https://mitrabagja.com/be/updateProduk";
			text    = 'Anda Berhasil Data Informasi!';

            var formData = new FormData($('#form_produk')[0]);
            $.ajax({
                url : url,
                beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    console.log(data.id_produk);
                    $('#id').val(data.id_produk);

                        $.ajax({
                            url         : url_api,
                            type        : "POST",
                            data        : new FormData($('#form_produk')[0]),
                            processData : false,
                            contentType : false,
                            cache       : false,
                            async       : false,
                            dataType    : "JSON",
                            success     : function (data2) {

                                swal({
                                    type: 'success',
                                    title: 'Berhasil',
                                    text: text
                                });
                                // $('#modal_produk').modal('hide');
                                // reload_table();\
                                location.reload();
                                
                            }
                        })

                        return false;

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
			
		})

		// number only
        $('#hpp').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        $('#harga').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        $('#discount').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        $('#harga_topping').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        $('#harga_split').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        $('#harga_ukuran').keyup(function(event) {
            if(event.which >= 37 && event.which <= 40) return;
            $(this).val(function(index, value) {
              return value
              .replace(/\D/g, "")
              .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
              ;
            });
        }).keypress(function(e) {
            if (this.value.length == 0 && e.which == 48 ){
                return false;
            }
        }).click(function(event) {
            $(this).select();
        });
        // fungsi numbering
	    function number_format (number, decimals, dec_point, thousands_sep) {
	        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	        var n = !isFinite(+number) ? 0 : +number,
	        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	        s = '',
	        toFixedFix = function (n, prec) {
	            var k = Math.pow(10, prec);
	            return '' + Math.round(n * k) / k;
	        };
	        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	        if (s[0].length > 3) {
	            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	        }
	        if ((s[1] || '').length < prec) {
	            s[1] = s[1] || '';
	            s[1] += new Array(prec - s[1].length + 1).join('0');
	        }
	        return s.join(dec);
	    }
	    // set value untuk form detail
	    $.ajax({
            url: '<?php echo base_url("Produk/get")?>/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data)
            {
                $('#hpp').val(number_format(data.hpp,0,',',','));
                $('#harga').val(number_format(data.harga,0,',',','));
                $('#discount').val(number_format(data.discount,0,',',','));
            }
        });
        // set dropify
        $('.dropify').dropify({
	        messages: 
	        {
	            'default': 'Seret file atau ketik di sini',
	            'replace': 'Seret file atau ketik di sini',
	            'remove':  'Buang',
	            'error':   'Maaf, ada kesalahan.'
	        }
        });
        // validasi untuk update produk
		$('#validasi_produk').click(function(event) {
			$(this).html('<i class="fas fa-clock-o"></i> Memproses..');
            $(this).attr('disabled',true);
			var nama 	= $('#nama').val();
			var hpp 	= $('#hpp').val();
			var harga 	= $('#harga').val();
			if(nama.length < 1 || hpp.length < 1 || harga.length < 0)
			{
				if(nama.length < 1)
				{			
	                $("#nama-error").html("Nama Produk harus Diisi!");
	                $("#nama-error").show().addClass("error");
	                error_nama = true;
	                $("#validasi_produk").html('<i class="fas fa-exclamation"></i> Validasi');
	                $("#validasi_produk").attr('disabled',false);
				}
				else
				{
					$("#nama-error").hide();
				}
				if(hpp.length < 1)
				{			
	                $("#hpp-error").html("HPP harus Diisi!");
	                $("#hpp-error").show().addClass("error");
	                error_hpp = true;
	                $("#validasi_produk").html('<i class="fas fa-exclamation"></i> Validasi');
	                $("#validasi_produk").attr('disabled',false);
				}
				else
				{
					$('#hpp-error').hide();
				}
				if(harga.length < 1)
				{			
	                $("#harga-error").html("HPP harus Diisi!");
	                $("#harga-error").show().addClass("error");
	                error_hpp = true;
	                $("#validasi_produk").html('<i class="fas fa-exclamation"></i> Validasi');
	                $("#validasi_produk").attr('disabled',false);
				}
				else
				{
					$('#harga-error').hide();
				}
			}
			else
			{
				swal({
                    title: "Validasi Berhasil!",
                    text: 'Silahkan Tekan Tombol Submit',
                    type: "success"
                });
                $('.help-block').hide();
				$('#validasi_produk').hide();
				$('#submit_update').show();
			}
		});
		// trigger modal topping
		$('#btn_trigger_modal_topping').click(function(event) {
			$('#method_topping').val('create');
            $('#judul_modal_topping').text('Tambah Data Topping')
            $('#form_topping').trigger('reset');
            $('#modal_topping').modal('show');
            $('.help-block').empty();
		});
		// trigger modal split
		$('#btn_trigger_modal_create_split').click(function(event) {
			$('#method_split').val('create');
            $('#judul_modal_create_split').text('Tambah Data Split')
            $('#form_create_split').trigger('reset');
            $('.token_split').remove();
            $('#modal_create_split').modal('show');
            $('.help-block').empty();
            x = 1;
		});
		// trigger modal ukuran
		$('#btn_trigger_modal_ukuran').click(function(event) {
			$('#method_ukuran').val('create');
            $('#judul_modal_ukuran').text('Tambah Data Ukuran');
            $('#form_ukuran').trigger('reset');
            $('#modal_ukuran').modal('show');
            $('.help-block').empty();
		});
		// trigger modal Status
		$('#btn_trigger_modal_status').click(function(event) {
			$('#method_status').val('create');
            $('#judul_modal_status').text('Tambah Data Status');
            $('#form_status').trigger('reset');
            $('#modal_status').modal('show');
            $('.help-block').empty();
		});
		// save topping
		$('#btn_save_topping').click(function(event) {
			if($('#method_topping').val() == 'create') {
                url = "<?php echo base_url('Topping/create')?>";
                text = 'Anda Berhasil Menambah Data Topping!';
            }
            else
            {
                url = "<?php echo base_url('Topping/update')?>";
                text = 'Anda Berhasil Menyunting Data Topping!';
            }
			$.ajax({
                url : url,
                beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
                type: "POST",
                data: $('#form_topping').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: text
                        });
                        $('#modal_topping').modal('hide');
                        $('.help-block').hide();
                        table_topping.ajax.reload(null,false);
                    }
                    else
                    {
                        swal.close();
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                            $('[name="'+data.inputerror[i]+'"]').next().show();
                        }
                    } 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
		});
		// create split
		$('#btn_create_split').click(function(event) {
			$.ajax({
                url : "<?php echo base_url('Split/create')?>",
                beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
                type: "POST",
                data: $('#form_create_split').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: 'Anda berhasil Menambahkan Data Split!'
                        });
                        $.ajax({
				            url : '<?php echo base_url("Split/get_bahan_hitung")?>/'+id,
				            type: "GET",
				            dataType: "JSON",
				            success: function(data)
				            {
				            	$('#harga_akumulasi_split').val(data.nilai_split);
				                if(data.nilai_split >= data.harga)
				                {
				                	$('#btn_trigger_modal_create_split').hide();
				                }
				                else
				                {
				                	$('#btn_trigger_modal_create_split').show();
				                }
				            }
				        });
                        $('#modal_create_split').modal('hide');
                        $('.help-block').hide();
                        table_split.ajax.reload(null,false);
                    }
                    else
                    {
                        swal.close();
                        swal({
                            type: 'warning',
                            title: 'Error',
                            text: data.message
                        });
                    } 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
		});
		// update split
		$('#btn_update_split').click(function(event) {
			$.ajax({
                url : "<?php echo base_url('Split/update')?>",
                beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
                type: "POST",
                data: $('#form_update_split').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: 'Anda berhasil Menambahkan Data Split!'
                        });
                        $('#modal_update_split').modal('hide');
                        $('.help-block').hide();
                        $.ajax({
				            url : '<?php echo base_url("Split/get_bahan_hitung")?>/'+id,
				            type: "GET",
				            dataType: "JSON",
				            success: function(data)
				            {
				            	$('#harga_akumulasi_split').val(data.nilai_split);
				                if(data.nilai_split >= data.harga)
				                {
				                	$('#btn_trigger_modal_create_split').hide();
				                }
				                else
				                {
				                	$('#btn_trigger_modal_create_split').show();
				                }
				            }
				        });
                        table_split.ajax.reload(null,false);
                    }
                    else
                    {
                        swal.close();
                        swal({
                            type: 'warning',
                            title: 'Error',
                            text: data.message
                        });
                    } 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
		});
		// save ukuran
		$('#btn_save_ukuran').click(function(event) {
			if($('#method_ukuran').val() == 'create') {
                url = "<?php echo base_url('Ukuran/create')?>";
                text = 'Anda Berhasil Menambah Data Ukuran!';
            }
            else
            {
                url = "<?php echo base_url('Ukuran/update')?>";
                text = 'Anda Berhasil Menyunting Data Ukuran!';
            }
			$.ajax({
                url : url,
                beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
                type: "POST",
                data: $('#form_ukuran').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: text
                        });
                        $('#modal_ukuran').modal('hide');
                        $('.help-block').hide();
                        table_ukuran.ajax.reload(null,false);
                    }
                    else
                    {
                        swal.close();
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                            $('[name="'+data.inputerror[i]+'"]').next().show();
                        }
                    } 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
		});
		// save ukuran
		$('#btn_save_status').click(function(event) {
			if($('#method_status').val() == 'create') {
                url = "<?php echo base_url('Status/create')?>";
                text = 'Anda Berhasil Menambah Data Status!';
            }
            else
            {
                url = "<?php echo base_url('Status/update')?>";
                text = 'Anda Berhasil Menyunting Data Status!';
            }
			$.ajax({
                url : url,
                beforeSend :function () {
                swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })      
                },
                type: "POST",
                data: $('#form_status').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        swal({
                            type: 'success',
                            title: 'Berhasil',
                            text: text
                        });
                        $('#modal_status').modal('hide');
                        $('.help-block').hide();
                        table_status.ajax.reload(null,false);
                    }
                    else
                    {
                        swal.close();
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                            $('[name="'+data.inputerror[i]+'"]').next().show();
                        }
                    } 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
		});
		// tombol tambah pihak
		var max_fields      = 10;
		var wrapper   		= $(".input_fields_wrap");
		$('.add_pihak').click(function(event) {
			event.preventDefault();
			if(x < max_fields){
				x++;
				$(wrapper).append(`
					<div class="form-group token_split">
						<div class="row">
							<div align="left" class="col-md-10">
								<p class="pihak_split">Pihak `+x+`</p>
							</div>
							<div align="right" class="col-md-2">
								<button type="button" class="btn btn-info btn-xs add_pihak">
								<i class="fas fa-plus"></i>
								<button type="button" class="btn btn-danger btn-xs remove_pihak">
								<i class="fas fa-times"></i>
								</button>
							</div>
							<hr>
						</div>
						<div class="form-group">
							<label class="control-label">Nama Pihak</label>
							<input type="text" class="form-control split_split" name="split[]" autocomplete="off">
							<span class="help-block"></span>
						</div>
						<div class="form-group">
							<label class="control-label">harga</label>
							<input type="number" class="form-control harga_split" name="harga[]" autocomplete="off">
							<span class="help-block"></span>
						</div>
					</div>
				`); 
			}
		});
		$(wrapper).on("click",".remove_pihak", function(e){ 
			e.preventDefault(); 
			$(this).parent('div').parent('div').parent('div').remove(); x--;
		});
	});
	// fungsi numbering
    function number_format (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
	// trigger modal untuk update topping
	function update_topping(id) {
		$('#method_topping').val('update');
        $('#form_topping').trigger('reset');
        $('#modal_topping').modal('show');
        $('.help-block').empty();
        $.ajax({
            url: '<?php echo base_url("Topping/get")?>/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data)
            {
                $('#judul_modal_topping').text('Sunting Data '+data.topping);
                $('#id_topping').val(data.id);
                $('#topping_topping').val(data.topping);
                $('#harga_topping').val(number_format(data.harga,0,',',','));
            }
        });
	}
	// trigger modal untuk update ukuran
	function update_ukuran(id) {
		$('#method_ukuran').val('update');
        $('#form_ukuran').trigger('reset');
        $('#modal_ukuran').modal('show');
        $('.help-block').empty();
        $.ajax({
            url: '<?php echo base_url("Ukuran/get")?>/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data)
            {
                $('#judul_modal_ukuran').text('Sunting Data '+data.ukuran);
                $('#id_ukuran').val(data.id);
                $('#ukuran_ukuran').val(data.ukuran);
                $('#harga_ukuran').val(number_format(data.harga,0,',',','));
            }
        });
	}
	// trigger modal untuk update split
	function update_split(id) {
		$('#form_update_split').trigger('reset');
        $('#modal_update_split').modal('show');
        $('#judul_modal_update_split').text('Sunting Data Split');
        $('.help-block').empty();
        $.ajax({
            url: '<?php echo base_url("split/get")?>/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data)
            {
                $('#judul_modal_status').text('Sunting Data '+data.split);
                $('#id_split').val(data.id);
                $('#id_produk_split').val(data.id_produk);
                $('#split_split').val(data.split);
                $('#harga_split').val(number_format(data.harga,0,',',','));
            }
        });
	}
	// trigger modal untuk update status
	function update_status(id) {
		$('#method_status').val('update');
		$('#form_status').trigger('reset');
        $('#modal_status').modal('show');
        $('#judul_modal_update_status').text('Sunting Data Status');
        $('.help-block').empty();
        $.ajax({
            url: '<?php echo base_url("Status/get")?>/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data)
            {
                $('#judul_modal_status').text('Sunting Data '+data.status);
                $('#id_status').val(data.id);
                $('#id_produk_status').val(data.id_produk);
                $('#status_status').val(data.status);
            }
        });
	}
	// Hapus Topping
    function delete_topping(id) {
    	var id_produk = $(location).attr('href').split("/").splice(6).join("/");
        var table_topping = $('#table_topping').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Topping/read')?>",
                "type": "POST",
                "data": {id: id_produk},
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            },
            'bDestroy': true,
        });
        swal({
          title: 'Konfirmasi',
          text: "Yakin Ingin Menghapus Data ini?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                  url:"<?= base_url('Topping/delete')?>",  
                  method:"post",
                  beforeSend :function () {
                  swal({
                      title: 'Menunggu',
                      html: 'Memproses data',
                      onOpen: () => {
                        swal.showLoading()
                      }
                    })      
                  },    
                  data:{id:id},
                  success:function(data){
                    swal(
                      'Hapus',
                      'Data Berhasil Terhapus',
                      'success'
                    )
                    table_topping.ajax.reload(null, false);
                  }
                })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal(
                  'Batal',
                  'Anda membatalkan penghapusan',
                  'error'
                )
            }
        })
    }
    // hapus split
    function delete_split(id) {
    	var id_produk = $(location).attr('href').split("/").splice(6).join("/");
        var table_split = $('#table_split').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Split/read')?>",
                "type": "POST",
                "data": {id: id_produk},
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            },
            'bDestroy': true,
        });
        swal({
          title: 'Konfirmasi',
          text: "Yakin Ingin Menghapus Data ini?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                  url:"<?= base_url('Split/delete')?>",  
                  method:"post",
                  beforeSend :function () {
                  swal({
                      title: 'Menunggu',
                      html: 'Memproses data',
                      onOpen: () => {
                        swal.showLoading()
                      }
                    })      
                  },    
                  data:{id:id},
                  success:function(data){
                    swal(
                      'Hapus',
                      'Data Berhasil Terhapus',
                      'success'
                    );
                    $('#btn_trigger_modal_create_split').show();
                    $.ajax({
			            url : '<?php echo base_url("Split/get_bahan_hitung")?>/'+id,
			            type: "GET",
			            dataType: "JSON",
			            success: function(data)
			            {
			            	$('#harga_akumulasi_split').val(data.nilai_split);
			            }
			        });
                    table_split.ajax.reload(null, false);
                  }
                })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal(
                  'Batal',
                  'Anda membatalkan penghapusan',
                  'error'
                )
            }
        })
    }
    // Hapus Ukuran
    function delete_ukuran(id) {
    	var id_produk = $(location).attr('href').split("/").splice(6).join("/");
        var table_ukuran = $('#table_ukuran').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Ukuran/read')?>",
                "type": "POST",
                "data": {id: id_produk},
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            },
            'bDestroy': true,
        });
        swal({
          title: 'Konfirmasi',
          text: "Yakin Ingin Menghapus Data ini?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                  url:"<?= base_url('Ukuran/delete')?>",  
                  method:"post",
                  beforeSend :function () {
                  swal({
                      title: 'Menunggu',
                      html: 'Memproses data',
                      onOpen: () => {
                        swal.showLoading()
                      }
                    })      
                  },    
                  data:{id:id},
                  success:function(data){
                    swal(
                      'Hapus',
                      'Data Berhasil Terhapus',
                      'success'
                    )
                    table_ukuran.ajax.reload(null, false);
                  }
                })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal(
                  'Batal',
                  'Anda membatalkan penghapusan',
                  'error'
                )
            }
        })
    }
    // Hapus Status
    function delete_status(id) {
    	var id_produk = $(location).attr('href').split("/").splice(6).join("/");
        var table_status = $('#table_status').DataTable({
            "processing": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('Status/read')?>",
                "type": "POST",
                "data": {id: id_produk},
            },
            "columnDefs": [{
                "targets": [0, 2],
                "orderable": false
            }],
            "oLanguage": {
                "sEmptyTable": "Tidak Ada Data"
            },
            'bDestroy': true,
        });
        swal({
          title: 'Konfirmasi',
          text: "Yakin Ingin Menghapus Data ini?",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                  url:"<?= base_url('Status/delete')?>",  
                  method:"post",
                  beforeSend :function () {
                  swal({
                      title: 'Menunggu',
                      html: 'Memproses data',
                      onOpen: () => {
                        swal.showLoading()
                      }
                    })      
                  },    
                  data:{id:id},
                  success:function(data){
                    swal(
                      'Hapus',
                      'Data Berhasil Terhapus',
                      'success'
                    )
                    table_status.ajax.reload(null, false);
                  }
                })
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal(
                  'Batal',
                  'Anda membatalkan penghapusan',
                  'error'
                )
            }
        })
    }
</script>