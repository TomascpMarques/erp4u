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

  .twoColumDisplay {
    display: flex;
    width: 100%;
    height: 100vh;
    border-radius: 0.25rem;
    background: white;
    margin-bottom: 2rem;
    padding: 1.25rem;
  }

  .left,
  .right {
    padding: 0.1rem 1rem;
    flex: 1;
  }

  .left>h3,
  .right>h3 {
    text-align: center;
    border-bottom: 1px solid gainsboro;
    padding: 0.5rem;
    padding-bottom: 0.7rem;
  }
</style>

<div class="page-content">
  <div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0">Leitor de Código de Barras</h4>
  </div>
  <div class="card">
    <div class="card-body">
      <h4>Ações</h4>
      <p></p>
      <button id="startScanButton" onclick="startScan()" class="btn btn-primary waves-effect waves-light">
        Iniciar Scan
      </button>
      <button id="stopScanButton" onclick="stopScan()" class="btn btn-danger waves-effect waves-light">
        Parar Scan
      </button>
      <div id="camera">
        <div id="scan-line"></div>
      </div>
      <div id="resultado"></div>
    </div>
  </div>
  <section class="twoColumDisplay">
    <section class="left" id="secProduto">
      <h3>Produto</h3>
      <table id="prodTable" class="table table-bordered nowrap" style="
                    border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                ">
        <thead>
          <tr>
            <th>Code</th>
            <th>Description</th>
            <th>Image</th>
            <th>Family</th>
            <th>Unit</th>
            <th>Tax Rate</th>
            <th>Prateleira</th>
            <th>Corredor</th>
            <th>Quantidade</th>
          </tr>
        </thead>
      </table>
    </section>
    <hr style="height: 100%; width: 1px; margin: auto; border-radius: 999px" />
    <section class="right">
      <h3>Mapa</h3>
      <iframe src="" id="idMapLink" height="900px" width="450px" frameborder="0"></iframe>
    </section>
  </section>
</div>

<audio id="beepAudio" src="{{ asset('backend/assets/sounds/beep3.mp3') }}"></audio>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
  integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            readers: ["i2of5_reader"],
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
          document.getElementById("camera").style.display = "block";
        }
      );

      Quagga.onDetected(function (result) {
        var code;


        code = result.codeResult.code;
        if (code.length === 14) {
          document.querySelector("#resultado").innerHTML =
            "Código de Barras ITF: " + code;
          Quagga.stop();
          scanning = false;
          document.getElementById("camera").style.display = "none";
          var beepAudio = document.getElementById("beepAudio");
          beepAudio.play();
          fetch("/products/getOne/" + code)
            .then((response) => {
              if (!response.ok) {
                throw new Error("Network response was not ok");
              }
              return response.json();
            })
            .then((data) => {
              console.log(data);

              const retrievedCode = data[0].code;
              const description = data[0].description;
              const image = data[0].image;
              const family = data[0].family;
              const unit = data[0].unit;
              const taxRateCode = data[0].taxRateCode;
              const prateleira = data[0].prateleira;
              const corredor = data[0].corredor;
              const quantidade = data[0].quantidade;

              var mapLink = `https://armazem-minimap.vercel.app/?cords=${corredor}, ${prateleira}`

              document.getElementById("idMapLink").setAttribute("src", mapLink);

              // Preencher os campos da tabela
              document.getElementById("prodTable").innerHTML = `
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Family</th>
                                        <th>Unit</th>
                                        <th>Tax Rate</th>
                                        <th>Prateleira</th>
                                        <th>Corredor</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>${retrievedCode}</td>
                                        <td>${description}</td>
                                        <td><img src=" http://127.0.0.1:8000/${image}" style="max-width: 50px;"></td>
                                        <td>${family}</td>
                                        <td>${unit}</td>
                                        <td>${taxRateCode}</td>
                                        <td>${prateleira - 1}</td>
                                        <td>${corredor / 2}</td>
                                        <td>${quantidade}</td>
                                    </tr>
                                </tbody>
                            `;

            })
            .catch((error) => {
              console.error("There was a problem with the fetch operation:", error);
            });
        }
      });
    }
  }

  function stopScan() {
    if (scanning) {
      Quagga.stop();
      scanning = false;
      document.getElementById("camera").style.display = "none";
    }
  }
</script>
@endsection