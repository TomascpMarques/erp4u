@extends('admin.admin_master') @section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Products All</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('product.add') }}"
                                class="btn btn-primary btn-rounded waves-effect waves-light" style="float: right;">Add
                                Product</a>
                            </br>
                            <h4 class="card-title">Product all data</h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="
                                border-collapse: collapse;
                                border-spacing: 0;
                                width: 100%;
                            ">
                                <thead>
                                    <tr>
                                        <th>Ln</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Family</th>
                                        <th>Unit</th>
                                        <th>Tax Rate</th>
                                        <th>Prateleira</th>
                                        <th>Corredor</th>
                                        <th>Quantidade</th>
                                        <th>Codigo de Barras</th>
                                        <th>Created by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>
                                                <img
                                                    srcset="
                                                        {{ asset($item->image) }},
                                                        {{ url('upload/no_image.jpg') }}
                                                    "
                                                    width="60"
                                                    height="50"
                                                >
                                            </td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $item->family }}</td>
                                            <td>{{ $item['codeRateLink']['taxRate'] }}</td>
                                            <td>{{ $item->prateleira }}</td>
                                            <td>{{ $item->corredor }}</td>
                                            <td>{{ $item->quantidade }}</td>
                                            <td>{{ $item->codBarras }}</td>
                                            <td>{{ $item->created_by }}</td>
                                            <td>
                                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info sm"
                                                    title="Edit Data"> <i class="fas fa-edit"></i> </a>
                                                <a href="{{ route('product.delete', $item->id) }}" class="btn btn-danger sm"
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
