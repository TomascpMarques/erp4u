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
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css"
/>
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
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
                        <h4 class="card-title">
                            Adicionar Regra Monitorização
                        </h4>
                        <br />
                        <form
                            method="post"
                            action="{{ route('monitor.store') }}"
                            id="myForm"
                        >
                            @csrf
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
                                        <option value=""></option>
                                        <option value="1">Ativa</option>
                                        <option value="0">Inativa</option>
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
                                        name="code"
                                        id="code"
                                        style="width: 50%"
                                    >
                                        <option value=""></option>
                                        @foreach ($productIdsArray as $key =>
                                        $id)
                                        <option value="{{ $id->code }}">
                                            {{ $id->code }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label
                                    for="Regra"
                                    class="col-sm-2 col-form-label"
                                    >Regras</label
                                >
                                <div
                                    class="form-group col-md-10"
                                    style="
                                        display: flex;
                                        flex-direction: column;
                                        gap: 1rem;
                                        align-items: start;
                                    "
                                >
                                    <div
                                        style="
                                            display: flex;
                                            flex-direction: row;
                                            gap: 1rem;
                                            align-items: center;
                                            width: 100%;
                                            padding: 0.5rem 0rem 0.5rem 0rem;
                                        "
                                    >
                                        <p
                                            style="
                                                margin: 0;
                                                font-size: 1rem;
                                                color: #102115;
                                                border: 1px solid;
                                                border-color: gainsboro;
                                                border-radius: 0.5rem;
                                                padding: 0.3rem 1rem;
                                                font-weight: bolder;
                                            "
                                        >
                                            Quando
                                        </p>
                                        <select
                                            style="width: fit-content"
                                            name="condicaoAlvo"
                                            id="condicaoAlvo"
                                            class="form-select select1"
                                        >
                                            <option value="stock">
                                                Quantidade
                                            </option>
                                            <option value="corredor">
                                                Corredor
                                            </option>
                                            <option value="prateleira">
                                                Prateleira
                                            </option>
                                            <option value="descricao">
                                                Descrição
                                            </option>
                                            <option value="unit">
                                                Unidade
                                            </option>
                                            <option value="familia">
                                                Familia
                                            </option>
                                        </select>
                                        <p
                                            style="
                                                margin: 0;
                                                font-size: 0.95rem;
                                                color: #303030;
                                            "
                                        >
                                            for
                                        </p>
                                        <select
                                            style="width: fit-content"
                                            name="condicaoRegra"
                                            id="condicaoRegra"
                                            class="form-select select1"
                                        >
                                            <option value=">">Maior</option>
                                            <option value="<">Menor</option>
                                            <option value="=">Igual</option>
                                            <option value="!">Diferente</option>
                                        </select>
                                        <p
                                            style="
                                                margin: 0;
                                                font-size: 0.95rem;
                                                color: #303030;
                                            "
                                        >
                                            que
                                        </p>
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="valorRegra"
                                            id="valorRegra"
                                            placeholder="20"
                                            maxlength="10"
                                            style="
                                                max-width: 15rem;
                                                width: fit-content;
                                            "
                                        />
                                        <p
                                            style="
                                                margin: 0;
                                                font-size: 0.95rem;
                                                color: #303030;
                                                min-width: fit-content;
                                            "
                                        >
                                            envia a mensagem.
                                        </p>
                                    </div>
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
                                        name="sujeito"
                                        id="sujeito"
                                        style="width: 50%"
                                        placeholder="test@gmail.com"
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
    let simplemde = new SimpleMDE();

    $(document).ready(function () {
        $("#postalCode").change(function () {
            $("#lbLocation").text("");
            $("#lbLocation").text(
                $("#postalCode option:selected").attr("iLocation")
            );
        });
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
