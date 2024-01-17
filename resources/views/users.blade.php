@extends('layout.layout')

@section('header')
    <h1 class="h3 mt-2 mx-1 text-gray-800">Users</h1>
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        @if (auth()->user()->role == 'SuperAdmin')
            <p class="mb-4">There is information about users. As super administrator you can create, edit and delete users
                as you
                like.</p>
        @else
            <p class="mb-4">There is information about users. As an administrator you can create users as needed.</p>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                        <span class="icon">
                            <i class="fa fa-user-plus mr-1"></i>
                        </span>
                        <span class="text">Add User</span>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Divisi</th>
                                <th>Role</th>
                                @if (auth()->user()->role == 'SuperAdmin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Divisi</th>
                                <th>Role</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($userData as $item)
                                @if (auth()->user()->role == 'Admin')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->divisi->nama_divisi }}</td>
                                        <td>{{ $item->role }}</td>
                                    </tr>
                                @elseif(auth()->user()->role == 'SuperAdmin')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->divisi->nama_divisi }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="modal"
                                                data-target="#editUserModal{{ $item->id }}"
                                                {{ auth()->user()->id == $item->id ? 'disabled' : '' }}>
                                                <i class="fa fa-wrench"></i>
                                            </button>

                                            <button class="btn btn-danger btn-circle btn-sm" data-toggle="modal"
                                                data-target="#hapusUserModal{{ $item->id }}"
                                                {{ auth()->user()->id == $item->id ? 'disabled' : '' }}>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    {{-- Add User Modal --}}
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('addUserStore') }}" method="post"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                <input type="text" name="nama" class="form-control form-control-user"
                                    id="exampleFirstName" placeholder="Name" @error('nama') is-invalid @enderror required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                <input type="email" name="email" class="form-control form-control-user"
                                    id="exampleInputEmail" placeholder="Email Address" @error('email') is-invalid @enderror
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="Password" @error('password') is-invalid @enderror
                                    required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group offset-1 col-sm-10 mb-3 mb-sm-0">
                                <label class="input-group-text" for="inputGroupSelect01">Divisi</label>
                                <select class="form-select" name="divisi_id" id="inputGroupSelect01">
                                    <option value="" selected>Choose...</option>
                                    @foreach ($divisiData as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_divisi }}</option>
                                    @endforeach
                                    {{-- <option value="3">Administrator</option>
                                    <option value="2">Hubungan Publik</option>
                                    <option value="1">Riset dan Teknologi</option> --}}
                                </select>
                            </div>
                        </div>
                        @if (auth()->user()->role == 'SuperAdmin')
                            <div class="form-group">
                                <div class="input-group offset-1 col-sm-10 mb-3 mb-sm-0">
                                    <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                    <select class="form-select" name="role" id="inputGroupSelect01">
                                        <option value="" selected>Choose...</option>
                                        <option value="Karyawan">Karyawan</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        @endif
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
    {{-- End Add User Modal --}}

    {{-- Edit User Modal --}}
    @foreach ($userData as $iteme)
        <div class="modal fade" id="editUserModal{{ $iteme->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ url('users/edit', $iteme->id) }}" method="post"> @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                    <input type="text" name="nama" class="form-control form-control-user"
                                        id="exampleFirstName" placeholder="Name" value="{{ $iteme->nama }}"
                                        @error('nama') is-invalid @enderror required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" value="{{ $iteme->email }}" placeholder="Email Address"
                                        @error('email') is-invalid @enderror required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="offset-1 col-sm-10 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="New Password"
                                        @error('password') is-invalid @enderror required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group offset-1 col-sm-10 mb-3 mb-sm-0">
                                    <label class="input-group-text" for="inputGroupSelect01">Divisi</label>
                                    <select class="form-select" name="divisi_id" id="inputGroupSelect01">
                                        @foreach ($divisiData as $data)
                                            @if ($data->id == $iteme->divisi_id)
                                                <option value="{{ $data->id }}" selected>{{ $data->nama_divisi }}
                                                </option>
                                            @endif
                                            <option value="{{ $data->id }}">{{ $data->nama_divisi }}</option>
                                        @endforeach
                                        {{-- <option value="3">Administrator</option>
                                    <option value="2">Hubungan Publik</option>
                                    <option value="1">Riset dan Teknologi</option> --}}
                                    </select>
                                </div>
                            </div>
                            @if (auth()->user()->role == 'SuperAdmin')
                                <div class="form-group">
                                    <div class="input-group offset-1 col-sm-10 mb-3 mb-sm-0">
                                        <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                        <select class="form-select" name="role" id="inputGroupSelect01">
                                            @if ($iteme->role == 'Admin')
                                                <option value="Admin" selected>Admin</option>
                                                <option value="Karyawan">Karyawan</option>
                                            @elseif($iteme->role == 'Karyawan')
                                                <option value="Karyawan" selected>Karyawan</option>
                                                <option value="Admin">Admin</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
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
    {{-- End Edit User Modal --}}

    {{-- Hapus User Modal --}}
    @foreach ($userData as $iteme)
        <div class="modal fade" id="hapusUserModal{{ $iteme->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="{{ url('users/delete', $iteme->id) }}" method="post"> @csrf
                        <div class="modal-body">
                            Are you sure to delete {{ $iteme->nama }}?
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
    {{-- End Hapus User Modal --}}
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault()

            var urlRedirect = ev.currentTarget.getAttribute('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlRedirect
                }
            })
        }
    </script>
@endsection
