<x-app-layout>
  <x-slot name="header">
    <div class="row">
      <div class="col-md-8 col-12">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
      </div>
      <div class="col-md-4 col 12">
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addCategoryModal">
          Add category
        </button>
      </div>
    </div>
  </x-slot>

  <section>
    <div class="container">
      <div class="row">
        <div class="col">
          @if (session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>
                {{ session('status') }}
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
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>

                  @if (isset($categories) && count($categories)>0)
                  @foreach ($categories as $category)

                  <tr>
                    <th scope="row">
                      {{ $category->id }}
                    </th>
                    <td>
                      {{ $category->name }}
                    </td>
                    <td>
                      <button onclick="editCategory({{ $category->id }},'{{ $category->name }}')" class="btn btn-warning" data-toggle="modal" data-target="#editCategoryModal">
                        Edit category
                      </button>

                      <button onclick="deleteCategory({{ $category->id }}, this)" class="btn btn-danger">
                        Delete category
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

  <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('categories') }}">
          @csrf
          <div class="modal-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Category name" id="input_name" name="name" aria-label="category" aria-describedby="basic-addon1">
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save category</button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('categories') }}">
          @csrf
          @method('PUT')
          <div class="modal-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Category name" id="name" name="name" aria-label="category" aria-describedby="basic-addon1">
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              Save category
            </button>
            <input type="hidden" name="id" id="id">
          </div>

        </form>

      </div>
    </div>
  </div>

  <x-slot name="scripts">
    <script type="text/javascript">
      
      function editCategory (id,name) 
      {
        $("#id").val(id)
        $("#name").val(name)
      }

      function deleteCategory (id,target)
      {
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            axios.delete('{{ url('categories') }}/'+id, {
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
