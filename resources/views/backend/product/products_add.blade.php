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
                        <h4 class="card-title">Adicionar Produto</h4>
                        <br />

                        <!--
                        @if(count($errors))
                        @foreach ($errors->all() as $error)
                        <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
                        @endforeach

                        @endif -->

                        <form
                            method="post"
                            action="{{ route('product.store') }}"
                            id="myForm"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            <div class="form-group row mb-3">
                                <!-- Product Code -->
                                <label
                                    for="example-text-input"
                                    class="col-sm-1 col-form-label"
                                    >Code</label
                                >
                                <div class="form-group col-sm-2">
                                    <input
                                        id="code"
                                        name="code"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                                <!-- Product Description -->
                                <label
                                    for="example-text-input"
                                    class="col-sm-1 col-form-label"
                                    >Description</label
                                >
                                <div class="form-group col-sm-8">
                                    <input
                                        id="description"
                                        name="description"
                                        class="form-control"
                                        type="text"
                                    />
                                </div>
                                <!-- Product Family -->
                                <label
                                    for="example-text-input"
                                    class="col-sm-1 col-form-label"
                                >
                                    Family</label
                                >
                                <div class="col-sm-2 form-group">
                                    <select
                                        id="product_family"
                                        name="product_family"
                                        aria-label="Default select example"
                                        class="form-select select2"
                                    >
                                        <option selected=""></option>
                                        @foreach($families as $prod)
                                        <option
                                            iOption=""
                                            value="{{$prod-> family}}"
                                        >
                                            {{$prod-> family}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Product Unit -->
                                <label
                                    for="example-text-input"
                                    class="col-sm-1 col-form-label"
                                    >Unit</label
                                >
                                <div class="col-sm-2 form-group">
                                    <select
                                        id="product_unit"
                                        name="product_unit"
                                        class="form-select select2"
                                        aria-label="Default select example"
                                    >
                                        <option selected=""></option>
                                        @foreach($unitMeasures as $prod)
                                        <option
                                            iOption1=""
                                            value="{{$prod->unit}}"
                                        >
                                            {{$prod->unit}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Tax Rate -->
                            <label
                                for="example-text-input"
                                class="col-sm-1 col-form-label"
                                >Tax Rate</label
                            >
                            <div class="form-group col-sm-1">
                                <select
                                    id="product_taxRateCode"
                                    name="taxRateCode_Product"
                                    class="form-select select2"
                                    aria-label="Default select example"
                                >
                                    <option selected=""></option>
                                    @foreach($taxRates as $prod)
                                    <option
                                        iTaxDescription="{{ $prod->descriptionTextRate }} - {{ $prod->taxRate }}%"
                                        value="{{ $prod->taxRateCode }}"
                                    >
                                        {{ $prod->taxRate }}%
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                             <!-- Product Image File-->
                            <div class="form-group row mb-3">
                                <label
                                    for="example-text-input"
                                    class="col-sm-1 col-form-label"
                                >
                                    Img Product</label
                                >
                                <div class="col-sm-11">
                                    <input
                                        name="profile_image"
                                        class="form-control"
                                        type="file"
                                        id="image"
                                    />
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <!-- Product Image Foto-->
                                <div class="col-sm-11">
                                    <img
                                        id="showImage"
                                        class="rounded avatar-lg"
                                        src="{{ (!empty($editData->profile_image))?url('upload/admin_images/'.$editData->profile_image): url('upload/no_image.jpg') }}"
                                        alt="Card image cap"
                                    />
                                </div>
                            </div>
                            <label
                                for="example-text-input"
                                id="lbTaxDescription"
                                name="1bTaxDescription"
                                class="col-sm-4 col-form-label"
                            ></label>
                            <input
                                type="submit"
                                class="btn btn-info waves-effect waves-light"
                                value="Salvar Product"
                            />
                            <a
                                href="{{ route('product.all') }}"
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
        $("#showImage").click(function () {
            $("#image").click();
        });
        $("#product_taxRateCode").change(function () {
            $("#1bTaxDescription").text("");
            $("#1bTaxDescription").text(
                $("#product_taxRateCode option: selected").attr(
                    "iTaxDescription"
                )
            );
        });
        $("#image").change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#showImage").attr("src", e.target.result);
            };
            reader.readAsDataURL(e.target.files["0"]);
        });

        $("#myForm").validate({
            rules: {
                family: {
                    required: true,
                },
            },
            messages: {
                family: {
                    required: "Please Enter postalCode.",
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
