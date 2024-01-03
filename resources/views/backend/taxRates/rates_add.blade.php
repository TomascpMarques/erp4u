@extends('admin.admin_master') @section('admin')

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/js/pages/form-advanced.init.js"></script>
<link
    href="assets/libs/select2/css/select2.min.css"
    rel="stylesheet"
    type="text/css"
/>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Adicionar Tax rate</h4>
                        <br />

                        <!--
                        @if(count($errors))
                        @foreach ($errors->all() as $error)
                        <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                        @endforeach

                        @endif -->

                        <form
                            method="post"
                            action="{{ route('taxRates.store') }}"
                            id="myForm"
                        >
                            @csrf
                            <div class="row mb-3">
                                <label
                                    for="taxRateCode"
                                    class="col-sm-2 col-form-label"
                                    >Code</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="text"
                                        name="taxRateCode"
                                        id="taxRateCode"
                                        placeholder="1"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="description"
                                    class="col-sm-2 col-form-label"
                                    >Description</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="text"
                                        name="descriptionTextRate"
                                        id="descriptionTextRate"
                                        placeholder="Iva"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="taxRate"
                                    class="col-sm-2 col-form-label"
                                    >Rate</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="number"
                                        min="0"
                                        max="100"
                                        step="0.1"
                                        name="taxRate"
                                        id="taxRate"
                                        placeholder="23"
                                        style="width: 7%"
                                    />
                                </div>
                            </div>
                            <input
                                type="submit"
                                class="btn btn-info waves-effect waves-light"
                                value="Salvar código"
                            />
                            <a
                                href="{{ route('taxRates.all') }}"
                                class="btn btn-secondary btn-rounded waves-effect waves-light"
                                style="
                                    float: right;
                                    width: fit-content;
                                    margin: 1rem;
                                    margin-bottom: 0.5rem;
                                    border-radius: 0.25rem;
                                "
                                >Cancelar</a
                            >
                        </form>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#postalCode").change(function () {
            $("#lbLocation").text("");
            $("#lbLocation").text(
                $("#postalCode option:selected").attr("iLocation")
            );
        });
    });

    /* $(document).ready(function () {
        $("#myForm").validate({
            rules: {
                postalCode: {
                    required: true,
                },
                location: {
                    required: true,
                },
            },
            messages: {
                postalCode: {
                    required: "Please Enter postalCode.",
                },
                location: {
                    required: "Please Enter location.",
                },
            },
            errorElement: "span",
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
        });
    }); */
</script>

@endsection
