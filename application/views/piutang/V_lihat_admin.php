<div class="main-content">
    <section class="section">
        <div class="section-header shadow">
            <h1 class=""><i class="fa fa-store-alt mr-3"></i>List UMKM</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Bagja</div>
                <div class="breadcrumb-item">List UMKM</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning text-center font-weight-bold" role="alert">
                        <h5 class="mb-0">Total Piutang: <mark style="border-radius: 10px;" class="tot_piutang"></mark></h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                <div class="card card-warning shadow">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabel_umkm" width="100%">
                        <thead>                                 
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama UMKM </th>
                                <th>Piutang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </section>
</div>

<script>
    $(document).ready(function () {

        var tabel_umkm = $('#tabel_umkm').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Piutang/tampil_data_umkm",
                "type"  : "POST",
                "dataSrc": function (json) {
                    $(".tot_piutang").text("Rp. "+json.tot_piutang); 
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,3],
                'className' : 'text-center',
            }]
        })
        
    })
</script>