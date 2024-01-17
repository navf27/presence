@extends('layout.layout')

@section('header')
    <h1 class="h3 mt-2 mx-1 text-gray-800">Presence</h1>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <p class="mb-4">Employee attendance data for admin.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                @if (auth()->user()->role == 'SuperAdmin')
                    <div class="d-flex justify-content-between mb-3">
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#cleanPresenceModal">
                            <span class="icon">
                                <i class="fa fa-trash mr-1"></i>
                            </span>
                            <span class="text">Clean Up</span>
                        </a>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Division</th>
                                <th>Status</th>
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
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->divisi }}</td>
                                    @if ($item->keterlambatan == 0)
                                        <td>{{ 'On Time' }}</td>
                                    @else
                                        <td>{{ 'Late' }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    {{-- Hapus User Modal --}}
    <div class="modal fade" id="cleanPresenceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Clean Presence</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('cleanPresence') }}" method="post"> @csrf
                    <div class="modal-body">
                        Are you sure to clean presence data?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Cancel
                        </button>
                        <button class="btn btn-danger" type="submit">Clean</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Hapus User Modal --}}
@endsection

@section('script')
    @if (session('cleanSuccess'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('cleanSuccess') }}",
                icon: 'success',
            })
        </script>
    @endif
@endsection
