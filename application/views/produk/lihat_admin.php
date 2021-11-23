<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1><i class="fa fa-landmark mr-3"></i>List UMKM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Bagja</div>
                <div class="breadcrumb-item">List UMKM</div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning text-center font-weight-bold" role="alert">
                <h5 class="mb-0">Total: <mark style="border-radius: 10px;" class="jml_produk">0 Produk</mark></h5>
            </div>
        </div>
    </div>
    <div class="row f_list">
        <div class="col-lg-12 col-md-12 col-xs-12 mt-2">
          <div class="card card-warning shadow">
            <div class="card-body">
              <div class="table-responsive">
                  <table id="table_umkm" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr class="text-center">
                              <th width="5%">No.</th>
                              <th>Nama UMKM</th>
                              <th>Jumlah Produk</th>
                              <th width="15%">Aksi</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        var tabel_umkm = $('#table_umkm').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "Produk/tampil_data_umkm",
                "type"  : "POST",
                "dataSrc": function (json) {
                    $(".jml_produk").text(json.jml_produk+" Produk"); 
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,2,3],
                'className' : 'text-center',
            }]
        })
        
    })
</script>