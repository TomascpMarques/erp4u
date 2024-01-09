@extends('admin.admin_master') @section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Todas as monitorizações</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('monitor.add') }}"
                                class="btn btn-primary btn-rounded waves-effect waves-light" style="float: right;">Nova
                                Monitorização</a>
                            </br>
                            <h4 class="card-title">Vista geral das Monitorizações</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="
                                border-collapse: collapse;
                                border-spacing: 0;
                                width: 100%;
                            ">
                                <thead>
                                    <tr>
                                        <th>Ln</th>
                                        <th>Código Produto</th>
                                        <th>Descrição Produto</th>
                                        <th>Tema</th>
                                        <th>Sujeito</th>
                                        <th>Conteúdo</th>
                                        <th>Ativa</th>
                                        <th>Criada Em</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monitors as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> {{ $item->product->code }} </td>
                                            <td> {{ $item->product->description }} </td>
                                            <td>{{ $item->tema }}</td>
                                            <td>{{ $item->sujeito }}</td>
                                            <td>{{ $item->conteudo != null ? substr($item->conteudo, 0, intval(strlen($item->conteudo) * 0.4)) . '...' : 'Sém Conteúdo!' }}
                                            </td>
                                            <td>{{ $item->ativa == 1 ? 'Sim' : 'Não' }}</td>
                                            <td>
                                                <a href="{{ route('monitor.edit', $item->id) }}" class="btn btn-info sm"
                                                    title="Edit Data"> <i class="fas fa-edit"></i> </a>
                                                <a href="{{ route('monitor.delete', $item->id) }}" class="btn btn-danger sm"
                                                    title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
@endsection
