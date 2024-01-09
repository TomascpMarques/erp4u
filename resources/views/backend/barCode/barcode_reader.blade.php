<!-- resources/views/leitor_codigo_barras.blade.php -->

@extends('admin.admin_master') @section('admin')

<style>
    #camera {
        top: 20px;
        margin-bottom: 20px;
        position: relative;
        width: 640px;
        height: 480px;
        display: none;
        border: 0px;
        overflow: hidden;
        border-radius: 30px;
    }

    #scan-line {
        position: absolute;
        width: 640px;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background-color: red;
        transform: translateY(-50%);
    }

    #startScanButton,
    #stopScanButton {
        margin-top: 10px;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
    }
</style>

<div class="page-content">
    <div
        class="page-title-box d-sm-flex align-items-center justify-content-between"
    >
        <h4 class="mb-sm-0">Leitor de Código de Barras</h4>
    </div>
    <div class="card">
        <div class="card-body">
            <button
                id="startScanButton"
                onclick="startScan()"
                class="btn btn-primary btn-rounded waves-effect waves-light"
            >
                Iniciar Scan
            </button>
            <button
                id="stopScanButton"
                onclick="stopScan()"
                class="btn btn-danger btn-rounded waves-effect waves-light"
            >
                Parar Scan
            </button>
            <div id="camera">
                <div id="scan-line"></div>
            </div>
            <br />
            <br />
            <div id="resultado"></div>
        </div>
    </div>
    <section class="twoColumDisplay">
        <section class="left"></section>
        <section class="right"></section>
    </section>
</div>

<audio
    id="beepAudio"
    src="{{ asset('backend/assets/sounds/beep3.mp3') }}"
></audio>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
<script src="https://cdn.rawgit.com/serratus/quaggaJS/0.12.1/dist/quagga.min.js"></script>

<script>
    var scanning = false;

    function startScan() {
        if (!scanning) {
            Quagga.init(
                {
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: document.querySelector("#camera"),
                        constraints: {
                            width: 640,
                            height: 480,
                            facingMode: "environment",
                        },
                    },
                    decoder: {
                        readers: ["i2of5_reader"], // Definindo o leitor específico para ITF (Interleaved 2 of 5)
                    },
                    locator: {
                        patchSize: "medium",
                        halfSample: true,
                    },
                },
                function (err) {
                    if (err) {
                        console.error(err);
                        return;
                    }
                    Quagga.start();
                    scanning = true;
                    document.getElementById("camera").style.display = "block"; // Mostra a câmera ao iniciar o escaneamento
                }
            );

            Quagga.onDetected(function (result) {
                var code = result.codeResult.code;
                if (code.length === 14) {
                    // Verifica se o código possui 14 dígitos
                    document.querySelector("#resultado").innerHTML =
                        "Código de Barras ITF: " + code;
                    Quagga.stop();
                    scanning = false;
                    document.getElementById("camera").style.display = "none"; // Esconde a câmera ao parar o escaneamento

                    // Reproduz o som de beep
                    var beepAudio = document.getElementById("beepAudio");
                    beepAudio.play();

                    handleBarCodeRead();
                }
            });
        }
    }

    function stopScan() {
        if (scanning) {
            Quagga.stop();
            scanning = false;
            document.getElementById("camera").style.display = "none"; // Esconde a câmera ao parar o escaneamento
        }
    }

    function handleBarCodeRead() {}
</script>
@endsection
