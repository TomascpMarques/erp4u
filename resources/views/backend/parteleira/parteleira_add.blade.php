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
                        <h4 class="card-title">Adicionar Parteleira</h4>
                        <br />

                        <!--
                        @if(count($errors))
                        @foreach ($errors->all() as $error)
                        <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                        @endforeach

                        @endif -->

                        <form
                            method="post"
                            action="{{ route('parteleira.store') }}"
                            id="myForm"
                        >
                            @csrf
                            <div class="row mb-3">
                                <label
                                    for="example-text-input"
                                    class="col-sm-2 col-form-label"
                                    >Codigo Parteleira</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        name="codParteleira"
                                        class="form-control"
                                        type="text"
                                        id="codParteleira"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="example-text-input"
                                    class="col-sm-2 col-form-label"
                                    >Corredor</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        name="corredor"
                                        class="form-control"
                                        type="text"
                                        id="corredor"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="example-text-input"
                                    class="col-sm-2 col-form-label"
                                    >Maximo de Items</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        name="maxItems"
                                        class="form-control"
                                        type="text"
                                        id="maxItems"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="example-text-input"
                                    class="col-sm-2 col-form-label"
                                    >Items na Parteleira</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        name="items"
                                        class="form-control"
                                        type="text"
                                        id="items"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <input
                                type="submit"
                                class="btn btn-info waves-effect waves-light"
                                value="Salvar Parteleira"
                            />
                            <a
                                href="{{ route('parteleira.all') }}"
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
                codParteleira: {
                    required: true,
                },
                corredor: {
                    required: true,
                },
                maxItems: {
                    required: true,
                },
                items: {
                    required: true,
                },
            },
            messages: {
                codParteleira: {
                    required: "Please Enter Code.",
                },
                corredor: {
                    required: "Please Enter Corredor.",
                },
                maxItems: {
                    required: "Please Enter Max Items.",
                },
                items: {
                    required: "Please Enter Current Items.",
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
