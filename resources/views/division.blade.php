@extends('layout.layout')

@section('header')
    <h1 class="h3 mt-2 mx-1 text-gray-800">Divisions</h1>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <p class="mb-4">There is information about divisions. As an administrator you can create, edit and delete divisions
            as you
            like.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addDivisionModal">
                        <span class="icon">
                            <i class="fa fa-plus-square mr-1"></i>
                        </span>
                        <span class="text">Add Division</span>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($divisiData as $divisi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $divisi->nama_divisi }}</td>
                                    <td>{{ $divisi->status }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="modal"
                                            data-target="#editDivisionModal{{ $divisi->id }}">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal"
                                            data-target="#deleteDivisionModal{{ $divisi->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    {{-- Add Division Modal --}}
    <div class="modal fade" id="addDivisionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Division</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('addDivisionStore') }}" method="post"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                <input type="text" name="nama_divisi" class="form-control form-control-user"
                                    id="exampleFirstName" placeholder="Division Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group offset-1 col-sm-10 mb-3 mb-sm-0">
                                <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                <select class="form-select" name="status" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Cancel
                        </button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Add Division Modal --}}

    {{-- Delete Division Modal --}}
    @foreach ($divisiData as $iteme)
        <div class="modal fade" id="deleteDivisionModal{{ $iteme->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Division</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="/divisions/delete/{{ $iteme->id }}" method="post"> @csrf @method('delete')
                        <div class="modal-body">
                            Are you sure to delete {{ $iteme->nama_divisi }} division ?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                Cancel
                            </button>
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End Delete Division Modal --}}

    {{-- Edit Division Modal --}}
    @foreach ($divisiData as $iteme)
        <div class="modal fade" id="editDivisionModal{{ $iteme->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Division</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="/divisions/edit/{{ $iteme->id }}" method="post"> @csrf @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                    <input type="text" name="nama_divisi" class="form-control form-control-user"
                                        id="exampleFirstName" value="{{ $iteme->nama_divisi }}"
                                        placeholder="Division Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group offset-1 col-sm-10 mb-3 mb-sm-0">
                                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                    <select class="form-select" name="status" id="inputGroupSelect01">
                                        @if ($iteme->status == 'Aktif')
                                            <option value="Aktif" selected>Aktif</option>
                                            <option value="Nonaktif">Nonaktif</option>
                                        @elseif($iteme->status == 'Nonaktif')
                                            <option value="Aktif">Aktif</option>
                                            <option value="Nonaktif" selected>Nonaktif</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                Cancel
                            </button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End Edit Division Modal --}}
@endsection
