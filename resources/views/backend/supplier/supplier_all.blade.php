@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Suppliers</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('supplier.add') }}"
                                class="btn btn-primary btn-rounded waves-effect waves-light" style="float: right;">Add
                                Supplier</a>
                            </br>
                            <h4 class="card-title">Suppliers All Data </h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>code</th>
                                        <th>name</th>
                                        <th>address1</th>
                                        <th>address2</th>
                                        <th>town</th>
                                        <th>postalCode</th>
                                        <th>status</th>
                                        <th>created_by</th>
                                        <th>updated_by</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->address1 }}</td>
                                            <td>{{ $item->address2 }}</td>
                                            <td>{{ $item->town }}</td>
                                            <td>{{ $item->postalCode }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_by }}</td>
                                            <td>{{ $item->updated_by }}</td>
                                            <td>
                                                <a href="{{ route('supplier.edit', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"> <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('supplier.delete', $item->id) }}"
                                                    class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                        class="fas fa-trash-alt"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
