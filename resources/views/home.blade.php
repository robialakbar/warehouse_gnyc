@extends('layouts.main')
@section('title', __('Dashboard'))
@section('custom-css')
    <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <a href="#" data-toggle="modal" data-target="#stock-form" onclick="stockForm(1)">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <p>Stock</p>
                            <h3>In</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="#" data-toggle="modal" data-target="#stock-form" onclick="stockForm(0)">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <p>Stock</p>
                            <h3>Out</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="#" data-toggle="modal" data-target="#stock-form" onclick="stockForm(2)">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <p>Product</p>
                            <h3>Retur</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-undo"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-6">
                <a href="{{ route('products.stock.history') }}">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <p>Stock</p>
                            <h3>History</h3>
                        </div>
                        <div class="icon">
                            <i class="fas fa-history"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="stock-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal-title" class="modal-title">{{ __('Stock In') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="reader" width="600px"></div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <img width="150px" src="/img/barcode_scanner.png"/>
                        
                        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"> </script>

                        <script>
                            function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
 // console.log(`Code matched = ${decodedText}`, decodedResult);
 $("#pcode").val(decodedText)
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                        </script>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" id="pcode" name="pcode" min="0" placeholder="Product Code">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="button-check" onclick="productCheck()">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="loader" class="card">
                        <div class="card-body text-center">
                            <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="form" class="card">
                        <div class="card-body">
                            <form role="form" id="stock-update" method="post">
                                @csrf
                                <input type="hidden" id="pid" name="pid">
                                <input type="hidden" id="type" name="type">
                                <div class="form-group row">
                                    <label for="pname" class="col-sm-4 col-form-label">{{ __('Product Name') }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pname" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pamount" class="col-sm-4 col-form-label">{{ __('Amount') }}</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="pamount" name="pamount" min="1" value="1">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="button-update" type="button" class="btn btn-primary" onclick="stockUpdate()">{{ __('Stock In') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('custom-js')
    <script src="/plugins/toastr/toastr.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $(function () {
            $('#form').hide();
            loader(0);
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $('#stock_date').datetimepicker({
                viewMode: 'years',
                format: 'MM/DD/YYYY HH:mm:ss'
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $('#pcode').on('input', function() {
            $("#form").hide();
            $("#button-update").hide();
        });

        function resetForm(){
            $('#form').trigger("reset");
            $('#pcode').val('');
            $('#pid').val('');
            $("#button-update").hide();
            $('#pcode').prop("disabled", false);
            $('#button-check').prop("disabled", false);
        }

        function stockForm(type=1){
            $("#form").hide();
            resetForm();
            $("#type").val(type);
            if(type == 0){
                $('#modal-title').text("Stock Out");
                $('#button-update').text("Stock Out");
            } else if(type == 1){
                $('#modal-title').text("Stock In");
                $('#button-update').text("Stock In");
            } else {
                $('#modal-title').text("Retur");
                $('#button-update').text("Retur");
            }
        }

        function enableStockInput(){
            $('#button-update').prop("disabled", false);
            $("#button-update").show();
            $('#form').show();
        }

        function disableStockInput(){
            $('#button-update').prop("disabled", true);
            $("#button-update").hide();
            $('#form').hide();
        }

        function loader(status=1){
            if(status == 1){
                $('#loader').show();
            } else {
                $('#loader').hide();
            }
        }

        function productCheck(){
            var pcode   = $('#pcode').val();
            var type    = $('#type').val()
            if(pcode.length > 0){
                loader();
                $('#form').hide();
                $('#pcode').prop("disabled", true);
                $('#button-check').prop("disabled", true);
                $.ajax({
                    url: '/products/check/'+pcode,
                    type: "GET",
                    data: {"format": "json"},
                    dataType: "json",
                    success:function(data) {
                        loader(0);
                        if(data.status == 1){
                            $('#pid').val(data.data.product_id);
                            $('#pcode').val(data.data.product_code);
                            $('#pname').val(data.data.product_name);
                            if(type != 0 && type != 2){
                                $('#pid').val(data.data.product_id);
                                $('#pcode').val(data.data.product_code);
                                $('#pname').val(data.data.product_name);
                                enableStockInput();
                            } else {
                                disableStockInput();
                                stockUpdate();
                            }
                        } else {
                            disableStockInput();
                            toastr.error("Product Code tidak dikenal!");
                        }
                        $('#pcode').prop("disabled", false);
                        $('#button-check').prop("disabled", false);
                    }, error:function(){
                        $('#pcode').prop("disabled", false);
                        $('#button-check').prop("disabled", false);
                    }
                });
            } else {
                toastr.error("Product Code belum diisi!");
            }
        }

        function stockUpdate(){
            loader();
            var type = $('#type').val();

            $('#pcode').prop("disabled", true);
            $('#button-check').prop("disabled", true);
            $('#button-update').prop("disabled", true);
            disableStockInput();
            var data = {
                product_id:$('#pid').val(),
                amount:$('#pamount').val(),
                type:$('#type').val(),
            }

            if(type == 0 && type == 2){
                data["amount"] = 1;
            }
            
            $.ajax({
                url: '/products/stockUpdate',
                type: "post",
                data: JSON.stringify(data),
                dataType: "json",
                contentType: 'application/json',
                success:function(data) {
                    loader(0);
                    if(data.status == 1){
                        toastr.success(data.message);
                        resetForm();
                    } else {
                        toastr.error(data.message);
                        enableStockInput();
                        $('#pcode').prop("disabled", false);
                        $('#button-check').prop("disabled", false);
                    }
                }, error:function(){
                    loader(0);
                    toastr.error("Unknown error! Please try again later!");
                    resetForm();
                }
            });
        }
    </script>
    @if(Session::has('success'))
        <script>toastr.success('{!! Session::get("success") !!}');</script>
    @endif
    @if(Session::has('error'))
        <script>toastr.error('{!! Session::get("error") !!}');</script>
    @endif
    @if(!empty($errors->all()))
        <script>toastr.error('{!! implode("", $errors->all("<li>:message</li>")) !!}');</script>
    @endif
@endsection