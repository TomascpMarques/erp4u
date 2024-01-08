@extends('admin.admin_master') @section('admin')

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Adicionar Tax Rate</h4>
                        <br />

                        <!--
                            @if (count($errors))
    @foreach ($errors->all() as $error)
    <p class="alert alert-danger alert-dismissible fade show"> {{ $error }} </p>
    @endforeach
    @endif -->

                        <form
                            method="post"
                            action="{{ route('taxRates.update') }}"
                            id="myForm"
                        >
                            @csrf
                            <input
                                type="hidden"
                                name="id"
                                value="{{$taxRates->id}}"
                            />
                            <div class="row mb-3">
                                <label
                                    for="example-text-input"
                                    class="col-sm-2 col-form-label"
                                    >Code</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="text"
                                        value="{{ $taxRates->taxRateCode }}"
                                        name="taxRateCode"
                                        id="taxRateCode"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="name"
                                    class="col-sm-2 col-form-label"
                                    >Name</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="text"
                                        value="{{ $taxRates->descriptionTextRate }}"
                                        name="descriptionTextRate"
                                        id="descriptionTextRate"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="address1"
                                    class="col-sm-2 col-form-label"
                                    >Address</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="text"
                                        value="{{ $taxRates->taxRate }}"
                                        name="taxRate"
                                        id="taxRate"
                                        style="width: 50%"
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
        $("#myForm").validate({
            rules: {
                taxRateCode: {
                    required: true,
                },
                taxRate: {
                    required: true,
                },
                descriptionTextRate: {
                    required: true,
                },
            },
            messages: {
                taxRateCode: {
                    required: "Please Enter Tax Rate Code.",
                },
                taxRate: {
                    required: "Please Enter Rate.",
                },
                descriptionTextRate: {
                    required: "Please Enter Description.",
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
    });
</script>

@endsection
