@extends('admin.admin_master') @section('admin')

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css"
/>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Editar Monitorização</h4>
                        <br />

                        <form
                            method="post"
                            action="{{ route('monitor.update') }}"
                            id="myForm"
                        >
                            @csrf
                            <input
                                type="hidden"
                                name="id"
                                value="{{$monitor->id}}"
                            />
                            <div class="row mb-3">
                                <label
                                    for="ativa"
                                    class="col-sm-2 col-form-label"
                                    >Ativa</label
                                >
                                <div class="form-group col-sm-10">
                                    <select
                                        style="width: fit-content"
                                        name="ativa"
                                        id="ativa"
                                        class="form-select select1"
                                    >
                                        <option
                                            value="{{
                                            $monitor->ativa == 1 ? 1 : 0
                                        }}"
                                        >
                                            {{$monitor->ativa == 1 ? "Ativa" : "Inativa"}}
                                        </option>
                                        <option
                                            value="{{
                                            $monitor->ativa == 1 ? 0 : 1
                                        }}"
                                        >
                                            {{$monitor->ativa == 1 ? "Inativa" : "Ativa"}}
                                        </option>
                                    </select>
                                </div>
                                <p></p>
                                <label
                                    for="ativa"
                                    class="col-sm-2 col-form-label"
                                    >Produto Associado</label
                                >
                                <div class="form-group col-sm-2">
                                    <select
                                        class="form-select select2"
                                        type="number"
                                        value="{{ $monitor->code }}"
                                        name="code"
                                        id="code"
                                        style="width: 50%"
                                    >
                                        @foreach ($productIdsArray as $key =>
                                        $id )
                                        <option value="{{ $id->code }}">
                                            {{ $id->code }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="sujeito"
                                    class="col-sm-2 col-form-label"
                                    >Sujeito</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="text"
                                        value="{{ $monitor->sujeito }}"
                                        name="sujeito"
                                        id="sujeito"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="tema"
                                    class="col-sm-2 col-form-label"
                                    >Tema</label
                                >
                                <div class="form-group col-sm-10">
                                    <input
                                        class="form-control"
                                        type="text"
                                        value="{{ $monitor->tema }}"
                                        name="tema"
                                        id="tema"
                                        style="width: 50%"
                                    />
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label
                                    for="conteudo"
                                    class="col-sm-2 col-form-label"
                                    >Conteúdo</label
                                >
                                <div class="form-group col-sm-10">
                                    <pre
                                        hidden
                                        id="conteudoMonitor"
                                        >{{$monitor->conteudo}}</pre
                                    >
                                    <textarea
                                        class="form-control"
                                        type="text"
                                        name="conteudo"
                                        id="conteudo"
                                        style="width: 50%"
                                    ></textarea>
                                </div>
                            </div>
                            <input
                                type="submit"
                                class="btn btn-info waves-effect waves-light"
                                value="Salvar Regra"
                            />
                            <a
                                href="{{ route('monitor.all') }}"
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
        /* let productAvailableIds = {!! json_encode($productIdsArray, JSON_HEX_TAG) !!};
        productAvailableIds = productAvailableIds.map(x => x.code); */

        var simplemde = new SimpleMDE();
        simplemde.value($("#conteudoMonitor").text());

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
