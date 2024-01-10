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
                            <div
                                class="form-group"
                                style="
                                    display: flex;
                                    flex-direction: row;
                                    flex-wrap: nowrap;
                                    gap: 1rem;
                                    width: fit-content;
                                    align-items: center;
                                    margin: 1rem 0 1rem 0;
                                "
                            >
                                <label
                                    for="example-text-input"
                                    class="col-form-label"
                                    >Tax Rate</label
                                >
                                <select
                                    id="product_taxRateCode"
                                    name="product_taxRateCode"
                                    class="form-select select2"
                                    aria-label="Default select example"
                                >
                                    <option selected=""></option>
                                    @foreach($taxRates as $prod)
                                    <option
                                        itaxdescription="{{ $prod->descriptionTextRate }} - {{ $prod->taxRate }}%"
                                        value="{{ $prod->taxRateCode }}"
                                    >
                                        {{ $prod->taxRate }}
                                    </option>
                                    @endforeach
                                </select>
                                <label
                                    style="height: fit-content; margin: 0"
                                    id="1bTaxDescription"
                                ></label>
                            </div>
                            <div
                                class="form-group"
                                style="
                                    display: flex;
                                    flex-direction: row;
                                    flex-wrap: nowrap;
                                    gap: 1rem;
                                    width: fit-content;
                                    align-items: center;
                                    margin: 1rem 0 1rem 0;
                                "
                            >
                                <div
                                    class="form-group"
                                    style="
                                        display: flex;
                                        flex-direction: row;
                                        flex-wrap: nowrap;
                                        gap: 1rem;
                                        width: fit-content;
                                        align-items: center;
                                        margin: 1rem 0 1rem 0;
                                    "
                                >
                                    <label
                                        for="prateleira"
                                        class="col-form-label"
                                        >Prateleira</label
                                    >
                                    <input
                                        id="prateleira"
                                        name="prateleira"
                                        class="form-control"
                                        type="number"
                                        value="1"
                                        step="1"
                                        min="1"
                                        max="7"
                                    />
                                </div>
                                <div
                                    class="form-group"
                                    style="
                                        display: flex;
                                        flex-direction: row;
                                        flex-wrap: nowrap;
                                        gap: 1rem;
                                        width: fit-content;
                                        align-items: center;
                                        margin: 1rem 0 1rem 0;
                                    "
                                >
                                    <label for="corredor" class="col-form-label"
                                        >Corredor</label
                                    >
                                    <input
                                        id="corredor"
                                        name="corredor"
                                        class="form-control"
                                        type="number"
                                        min="1"
                                        step="1"
                                        max="4"
                                        value="1"
                                    />
                                    
                                </div>
                                <div
                                    class="form-group"
                                    style="
                                        display: flex;
                                        flex-direction: row;
                                        flex-wrap: nowrap;
                                        gap: 1rem;
                                        width: fit-content;
                                        align-items: center;
                                        margin: 1rem 0 1rem 0;
                                    "
                                >
                                    <label class="col-form-label"
                                        >Quantidade</label
                                    >
                                    <input
                                        id="quantidade"
                                        name="quantidade"
                                        class="form-control"
                                        type="number"
                                        min="1"
                                    />
                                    
                                </div>
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
                $("#product_taxRateCode option:selected").attr(
                    "itaxdescription"
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
                code: {
                    required: true,
                },
                description: {
                    required: true,
                },
                product_family: {
                    required: true,
                },
                product_unit: {
                    required: true,
                },
                product_taxRateCode: {
                    required: true,
                },
                profile_image: {
                    required: true,
                },
                prateleira: {
                    required: true,
                },
                corredor: {
                    required: true,
                },
                quantidade: {
                    required: true,
                },
            },
            messages: {
                code: {
                    required: "Please Enter Code.",
                },
                description: {
                    required: "Please Enter Description.",
                },
                product_family: {
                    required: "Please Enter Product Family.",
                },
                product_unit: {
                    required: "Please Enter Product Unit.",
                },
                product_taxRateCode: {
                    required: "Please Enter Product Tax Rate.",
                },
                profile_image: {
                    required: "Please Enter Product Image.",
                },
                prateleira: {
                    required: "Please Enter Product Prateleira.",
                },
                corredor: {
                    required: "Please Enter Product Corredor.",
                },
                quiantidade: {
                    required: "Please Enter Product Quantidade.",
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
