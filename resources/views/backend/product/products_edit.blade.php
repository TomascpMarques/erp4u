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
                            <h4 class="card-title">Adicionar familia de produto</h4>
                            <br />

                            <!--
                            @if (count($errors))
    @foreach ($errors->all() as $error)
    <p class="alert alert-danger alert-dismissible fade show"> {{ $error }} </p>
    @endforeach
    @endif -->

                            <form method="post" action="{{ route('product.update') }}" id="myForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}" />
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Code</label>
                                    <div class="form-group col-sm-10">
                                        <input name="code" class="form-control" type="text" id="code"
                                             style="width: 50%" value="{{ $product->code }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="form-group col-sm-10">
                                        <input name="description" class="form-control" type="text" id="description "
                                             style="width: 50%" value="{{ $product->description }}" />
                                    </div>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <select id="product_family" name="product_family" aria-label="Default select example" class="form-select select2">
                                        <option selected=""></option>
                                        @foreach($families as $prod)
                                        <option iOption="" value="{{$prod-> family}}">
                                            {{$prod-> family == $product->family ? 'selected' : ''}} > {{$prod->family}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <select id="product_unit" name="product_unit" aria-label="Default select example" class="form-select select2">
                                        <option selected=""></option>
                                        @foreach($unitMeasures as $prod)
                                        <option iOption="" value="{{$prod-> unit}}">
                                            {{$prod->unit == $product->unit ? 'selected' : ''}} > {{$prod->unit}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2 form-group">
                                    <select id="product_taxRateCode" name="taxRateCode_product" aria-label="Default select example" class="form-select select2">
                                        <option selected=""></option>
                                        @foreach($taxrates as $prod)
                                        <option iOption="" value="{{$prod-> unit}}">
                                            {{$prod->taxRateCode == $product->taxRateCode ? 'selected' : ''}} > {{$prod->taxRateCode}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Product Image File-->
                                <div class="form-group row mb-3">
                                    <label for="example-text-input" 
                                        class="col-sm-1 col-form-label">Img Product</label>
                                    <div class="col-sm-11">
                                    
                                    <input name="profile_image" class="form-control" type="file" id="image"/>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <!-- Product Image Foto-->
                                <label for="example-text-input" 
                                        class="col-sm-1 col-form-label"></label>
                                <div class="col-sm-11">
                                    <img id="showImage" class="rounded avatar-lg" src="{{asset($product->image)}}" 
                                    alt="Card image cap"/>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <!-- end row -->
                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Salvar Produto" />
                            </div>
                                <a href="{{ route('product.all') }}"
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
            $("#showImage").click(function () {
            $("#image").click();
        });
        $("#image").change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#showImage").attr("src", e.target.result);
            };
            reader.readAsDataURL(e.target.files["0"]);
        });
        $("#product_taxRateCode").change(function () {
            $("#1bTaxDescription").text("");
            $("#1bTaxDescription").text(
                $("#product_taxRateCode option: selected").attr(
                    "iTaxDescription"
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
