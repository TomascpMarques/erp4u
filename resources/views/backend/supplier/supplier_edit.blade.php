@extends('admin.admin_master') @section('admin')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Adicionar supplier</h4>
                            <br />

                            <!--
                            @if (count($errors))
    @foreach ($errors->all() as $error)
    <p class="alert alert-danger alert-dismissible fade show"> {{ $error }} </p>
    @endforeach
    @endif -->

                            <form method="post" action="{{ route('supplier.update') }}" id="myForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Code</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" value="{{ $supplier->code }}"
                                            name="code" id="code" placeholder="2005-279" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" value="{{ $supplier->name }}"
                                            name="name" id="name" placeholder="Pernes" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="address1" class="col-sm-2 col-form-label">Address</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" value="{{ $supplier->address1 }}"
                                            name="address1" id="address1" placeholder="Pernes" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="address2" class="col-sm-2 col-form-label">Address Secondary</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" value="{{ $supplier->address2 }}"
                                            name="address2" id="address2" placeholder="Pernes" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="town" class="col-sm-2 col-form-label">town</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" value="{{ $supplier->town }}"
                                            name="town" id="town" placeholder="Pernes" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" value="{{ $supplier->postalCode }}"
                                            name="postalCode" id="postalCode" placeholder="Pernes" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="stauts" class="col-sm-2 col-form-label">Status</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" value="{{ $supplier->status }}"
                                            name="status" id="status" placeholder="Pernes" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="nif" class="col-sm-2 col-form-label">NIF</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" type="text" name="nif" id="nif"
                                            placeholder="957842631" style="width: 50%" />
                                    </div>
                                </div>
                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Salvar código" />
                                <a href="{{ route('postalCodes.all') }}"
                                    class="btn btn-secondary btn-rounded waves-effect waves-light"
                                    style="
                                    float: right;
                                    width: fit-content;
                                    margin: 1rem;
                                    margin-bottom: 0.5rem;
                                    border-radius: 0.25rem;
                                ">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#myForm").validate({
                rules: {
                code: {
                    required: true,
                },
                name: {
                    required: true,
                },
                address1: {
                    required: true,
                },
                town: {
                    required: true,
                },
                postalCode: {
                    required: true,
                },
                nif: {
                    required: true,
                },
            },
            messages: {
                code: {
                    required: "Please Enter code.",,
                },
                name: {
                    required: "Please Enter name.",
                },
                address1: {
                    required: "Please Enter address1.",
                },
                town: {
                    required: "Please Enter address1.",
                },
                postalCode: {
                    required: "Please Enter postalCode.",
                },
                nif: {
                    required: "Please Enter NIF.",
                },
            },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
            });
        });
    </script>

@endsection
