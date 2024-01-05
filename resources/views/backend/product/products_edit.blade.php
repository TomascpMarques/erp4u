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
                        <h4 class="card-title">Adicionar familia de produto</h4>
                        <br />
                        <form
                            method="post"
                            action="{{ route('product.update') }}"
                            id="myForm"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            <input
                                type="hidden"
                                name="id"
                                value="{{ $product->id }}"
                            />
                            <div>
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
                                        value="{{$product->id}}"
                                    />
                                </div>
                                <!-- Product Description -->
                                <div
                                    class="form-group"
                                    style="
                                        display: flex;
                                        flex-direction: column;
                                        flex-wrap: nowrap;
                                        gap: 0.25rem;
                                        width: max-content;
                                        align-items: start;
                                        margin: 1rem 0 1rem 0;
                                    "
                                >
                                    <label for="example-text-input"
                                        >Description</label
                                    >
                                    <textarea
                                        id="description"
                                        name="description"
                                        class="form-control"
                                        type="text"
                                        style="min-width: 480px"
                                        >{{$product->description}}</textarea
                                    >
                                </div>
                                <div
                                    style="
                                        display: flex;
                                        flex-direction: row;
                                        gap: 2rem;
                                        align-items: center;
                                    "
                                >
                                    <!-- Product Family -->
                                    <div
                                        class="form-group"
                                        style="
                                            display: flex;
                                            flex-direction: row;
                                            flex-wrap: nowrap;
                                            gap: 1rem;
                                            align-items: center;
                                            margin: 1rem 0 1rem 0;
                                        "
                                    >
                                        <label for="example-text-input">
                                            Family
                                        </label>
                                        <div class="form-group">
                                            <select
                                                id="product_family"
                                                name="product_family"
                                                aria-label="Default select example"
                                                class="form-select select2"
                                            >
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
                                    </div>
                                    <!-- Product Unit -->
                                    <div
                                        class="form-group"
                                        style="
                                            display: flex;
                                            flex-direction: row;
                                            flex-wrap: nowrap;
                                            gap: 1rem;
                                            width: max-content;
                                            align-items: center;
                                            margin: 1rem 0 1rem 0;
                                        "
                                    >
                                        <label for="example-text-input"
                                            >Unit</label
                                        >
                                        <div class="form-group">
                                            <select
                                                id="product_unit"
                                                name="product_unit"
                                                class="form-select select2"
                                                aria-label="Default select example"
                                            >
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

                                            align-items: center;
                                            margin: 1rem 0 1rem 0;
                                        "
                                    >
                                        <label for="example-text-input"
                                            >Tax Rate</label
                                        >
                                        <select
                                            id="product_taxRateCode"
                                            name="product_taxRateCode"
                                            class="form-select select2"
                                            aria-label="Default select example"
                                        >
                                            @foreach($taxRates as $prod)
                                            <option
                                                itaxdescription="{{ $prod->descriptionTextRate && '-' }}  {{ $prod->taxRate }}%"
                                                value="{{ $prod->taxRateCode }}"
                                            >
                                                {{ $prod->taxRateCode }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <label
                                            style="
                                                height: fit-content;
                                                margin: 0;
                                            "
                                            id="1bTaxDescription"
                                        ></label>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Image File-->
                            <div class="form-group row mb-4">
                                <label
                                    for="example-text-input"
                                    class="col-form-label"
                                >
                                    Img Product</label
                                >
                                <div style="width: 25rem">
                                    <input
                                        name="image"
                                        class="form-control"
                                        type="file"
                                        id="image"
                                    />
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <!-- Product Image Foto-->
                                <img
                                    width="auto"
                                    height="auto"
                                    id="showImage"
                                    class="rounded avatar-lg"
                                    srcset="
                                        {{ asset($product->image) }},
                                        {{ url('upload/no_image.jpg') }}
                                    "
                                    alt="Card image cap"
                                />
                            </div>

                            <!-- end row -->
                            <div
                                style="
                                    width: fit-content;
                                    display: inline-flex;
                                    gap: 1rem;
                                    align-items: center;
                                "
                            >
                                <input
                                    type="submit"
                                    class="btn btn-info waves-effect waves-light"
                                    value="Salvar Produto"
                                    style="width: fit-content; height: 100%"
                                />
                                <a
                                    href="{{ route('product.all') }}"
                                    class="btn btn-secondary btn-rounded waves-effect waves-light"
                                    style="
                                        float: right;
                                        border-radius: 0.25rem;
                                        width: fit-content;
                                        height: 100%;
                                    "
                                    >Cancelar</a
                                >
                            </div>
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
        $("#image").change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#showImage").attr("srcset", "");
                $("#showImage").attr("src", e.target.result);
            };
            reader.readAsDataURL(e.target.files["0"]);
        });
        $("#product_taxRateCode").change(function () {
            $("#1bTaxDescription").text("");
            $("#1bTaxDescription").text(
                $("#product_taxRateCode option:selected").attr(
                    "itaxdescription"
                )
            );
        });

        $("#myForm").validate({
            rules: {
                code: {
                    required: true,
                },
                descritpion: {
                    required: true,
                },
                product_family: {
                    required: true,
                },
                product_unit: {
                    required: true,
                },
                taxRateCode_Product: {
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
                taxRateCode_Product: {
                    required: "Please Enter Product Tax Rate.",
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
