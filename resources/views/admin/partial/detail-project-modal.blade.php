<!-- Modal Preparasi -->
<div class="modal fade" id="exampleModalPreparasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        </div>
    </div>
</div>

<!-- Modal Order -->
<div class="modal fade" id="exampleModalOrder" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalOrderLabel">
                    Modal Order
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-order" action="{{ route('order.edit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Sample Name</label>
                        <input type="hidden" class="form-control" id="id_project2" name="id_project" />
                        <input type="hidden" class="form-control" id="id_order" name="id_order" />
                        <select id="id_sample" name="id_sample" class="custom-select">
                            @foreach ($sample as $row)
                                <option value="{{ $row->id_sample }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Price Rates</label>
                        <input type="number" class="form-control" id="price_rates" name="price_rates" readonly />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" />
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Total</label>
                        <input type="number" class="form-control" id="total" name="total"
                            placeholder="cth : Project batu bara" readonly />
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
