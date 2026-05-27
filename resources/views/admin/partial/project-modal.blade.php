<!-- Modal tambah -->
<div class="modal fade" id="exampleModalTambah2" tabindex="-1" role="dialog" aria-labelledby="exampleModalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTambahLabel">
                    Tambah
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" action="{{ route('project.addProject') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Project Name</label>
                        <input type="hidden" class="form-control" id="id_project" name="id_project" />
                        <input type="hidden" class="form-control" id="no_order" name="no_order" />
                        <input type="text" class="form-control" id="project_name" name="project_name"
                            placeholder="cth : Project batu bara" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Project Location</label>
                        <input type="text" class="form-control" id="project_location" name="project_location"
                            placeholder="cth : jl ganesa 10 A" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">PIC</label>
                        <input type="text" class="form-control" id="pic" name="pic"
                            placeholder="cth : Riki Ahmad" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name"
                            placeholder="cth : PT. Astra" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Company Address</label>
                        <input type="text" class="form-control" id="company_address" name="company_address"
                            placeholder="cth : Ganesha 10 A Bandung" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">File (max 4Mb)</label>
                        <input type="file" class="form-control" id="file" name="file"
                            placeholder="pdf, jpg, png" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sample -->
<div class="modal fade" id="exampleModalSample" tabindex="-1" role="dialog" aria-labelledby="exampleModalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTambahLabel">
                    Ganti Status Order
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" action="{{ route('project.changeStatus') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Estimasi Sample Dibuka</label>
                        <input type="hidden" class="form-control" id="id_project_status" name="id_project" />
                        <input type="date" class="form-control" id="project_name" name="estimated_opened"
                            placeholder="cth : Project batu bara" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Invoicing Modal -->
<div class="modal fade" id="invoicingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTambahLabel">
                    Sample Document
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">File</label>
                        <input type="file" class="form-control" id="file" name="file" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="simpan-invoicing">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Invoicing Modal2 -->
<div class="modal fade" id="invoicingModal2" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTambahLabel">
                    Invoice Document
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-bukti" method="POST" enctype="multipart/form-data">
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="button-completed">
                    Completed
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Preparasi Sample -->
<div class="modal fade" id="preparingModalSample" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTambahLabel">
                    Ganti Status Order
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Start Test Modal -->
<div class="modal fade" id="startTestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTambahLabel">
                    Apakah test siap dimulai ?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="start-test">
                    Mulai
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Document -->
<div class="modal fade" id="modalDocument" tabindex="-1" role="dialog" aria-labelledby="modalDocument"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDocument">
                    Document Hasil Test
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-document" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Document A" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">File</label>
                                <input id="image_document-0" name="image_document-0" type="file"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button id="add-document" class="btn btn-info btn-block">Add Document</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="submit-document" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preparasi -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-big" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 justify-content-between align-items-center">
                    <div class="col">
                        <b><span class="mb-2">Notes : </span></b>
                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                    </div>
                    <div class="col" id="image-modal">
                        <span>
                            <input type="file" id="image" name="image" id="image" />
                        </span>
                    </div>
                </div>
                <table class="table table-bordered" id="notice-table">
                    <tbody id="notice-body">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger mr-auto" id="clear-delete">Clear Table</button>
                <button type="button" class="btn btn-outline-secondary" id="add-sample-code">Add Sample Code</button>
                <button type="button" class="btn btn-outline-primary" id="button-simpan">Simpan</button>
                <button type="button" class="btn btn-primary" id="button-proceed">Proceed</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal  -->

<!-- Modal Testing -->
<div class="modal fade" id="testingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-big" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Testing Sample</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="notice-table">
                    <tbody id="notice-body2">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary mr-auto" id="simpan-testing">Simpan</button>
                <button type="button" class="btn btn-primary" id="button-proceed2">Proceed</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal testing  -->

<!-- Invoicing Proof -->
<div class="modal fade" id="invoicingproofModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalTambahLabel">
                    Invoice Document
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-invoice-body" class="modal-body">
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">File Invoice</label>
                        <input id="file_invoice" name="file_invoice" type="file" class="form-control" />
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Proof Of Payment</label>
                        <input type="text" class="form-control" id="proof_payment" name="proof_payment"
                            readonly />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submit-invoice">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
