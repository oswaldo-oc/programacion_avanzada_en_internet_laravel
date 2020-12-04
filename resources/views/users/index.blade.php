<x-app-layout>
  <x-slot name="header">
    <div class="row">
      <div class="col-md-8 col-12">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
      </div>
      <div class="col-md-4 col 12">
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addUserModal">
          Add user
        </button>
      </div>
    </div>
  </x-slot>

  <section>
    <div class="container">
      <div class="row">
        <div class="col">
          @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>
                {{ session('status') }}
              </strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>
                {{ session('error') }}
              </strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

              <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  @if (isset($users) && count($users)>0)
                  @foreach ($users as $user)

                  <tr>
                    <th scope="row">
                      {{ $user->id }}
                    </th>
                    <td>
                      {{ $user->name }}
                    </td>
                    <td>
                      {{ $user->email }}
                    </td>
                    <td>
                      @if ($user->role_id==1)
                        <span class="badge badge-success">Admin</span>
                      @endif
                      @if ($user->role_id==2)
                        <span class="badge badge-primary">User</span>
                      @endif
                    </td>
                    <td>
                      <button onclick="editUser({{ $user->id }},'{{ $user->name }}','{{ $user->email }}',{{ $user->role_id }})" class="btn btn-warning" data-toggle="modal" data-target="#editUserModal">
                        Edit user
                      </button>

                      <button onclick="deleteUser({{ $user->id }}, this)" class="btn btn-danger">
                        Delete user
                      </button>
                    </td>
                  </tr>

                  @endforeach
                  @endif

                </tbody>
              </table>
          </div>
      </div>
  </div>

  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('users') }}" onsubmit="return validatePassword()">
          @csrf
          <div class="modal-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Samwise Gamgee" id="input_name" name="name" aria-label="category" aria-describedby="basic-addon1" required="">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="email" class="form-control" placeholder="Example@domain.com" id="input_email" name="email" aria-label="email" aria-describedby="basic-addon1" required="">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Password</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="password" class="form-control" placeholder="Secret123" id="input_pw1" name="password" aria-label="password1" aria-describedby="basic-addon1" required="">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Confirm Password</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="password" class="form-control" placeholder="Secret123" id="input_pw2" name="password2" aria-label="password1" aria-describedby="basic-addon1" required="">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Role</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <select class="form-control" id="input_role" name="role_id" required="">
                      
                    <option value="2">User</option>
                    <option value="1">Admin</option>

                </select>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save user</button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('users') }}">
          @csrf
          @method('PUT')
          <div class="modal-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Samwise Gamgee" id="name" name="name" aria-label="category" aria-describedby="basic-addon1" required="">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="email" class="form-control" placeholder="Example@domain.com" id="email" name="email" aria-label="email" aria-describedby="basic-addon1" required="">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Role</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <select class="form-control" id="role" name="role_id" required="">
                      
                    <option value="2">User</option>
                    <option value="1">Admin</option>
                    
                </select>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              Save user
            </button>
            <input type="hidden" name="id" id="id">
          </div>

        </form>

      </div>
    </div>
  </div>

  <x-slot name="scripts">
    <script type="text/javascript">

      function validatePassword() {
      
      if($("#input_pw1").val() == $("#input_pw2").val()) {
        return true;
      }else {
        $("#input_pw1").addClass("is-invalid")
        $("#input_pw2").addClass("is-invalid")

        swal("", "Las contraseñas no coinciden", "error")
        return false;
      }
    }
      
      function editUser (id,name,email,role) 
      {
        $("#id").val(id)
        $("#name").val(name)
        $("#email").val(email)
        $("#role").val(role);
      }

      function deleteUser (id,target)
      {
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this entry!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.delete('{{ url('users') }}/'+id, {
              id: id,
              _token: '{{ csrf_token() }}' 
            })
            .then(function (response) {
              
              if (response.data.code==200) 
              {
                swal( response.data.message , {
                  icon: "success",
                });

                $(target).parent().parent().remove()
              }else
              {
                swal( response.data.message , {
                  icon: "error",
                });
              }
            })
            .catch(function (error) {
              swal( 'Error ocurred' , {
                icon: "error",
              });
            })
            .then(function () {
              // always executed
            });  
          }
        });
      }
    </script>
  </x-slot>  

</x-app-layout>
