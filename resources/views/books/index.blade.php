<x-app-layout>
  <x-slot name="header">
      
    <div class="row">
      <div class="col-md-8 col-12">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Books') }}
        </h2>
      </div>
      @if (Auth::user()->hasPermissionTo('add books'))
        <div class="col-md-4 col 12">
          <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addBookModal">
            Add book
          </button>
        </div>
      @endif
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
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col" style="width: 30%">Actions</th>
                  </tr>
                </thead>
                <tbody>

                  @if (isset($books) && count($books)>0)
                    @foreach ($books as $book)

                    <tr>
                      <th scope="row">
                        {{ $book->id }}
                      </th>
                      <td>
                        {{ $book->title }}
                      </td>
                      <td>
                        {{ $book->description }}
                      </td>
                      <td>
                        @foreach ($categories as $category)
                          @if($book->category_id==$category->id)
                            {{ $category->name }}
                          @endif
                        @endforeach
                      </td>
                      <td>

                        @if (Auth::user()->hasPermissionTo('add books'))

                          <button onclick="editBook({{ $book->id }},'{{ $book->title }}','{{ $book->description }}',{{ $book->year }},{{ $book->pages }},'{{ $book->isbn }}','{{ $book->editorial }}',{{ $book->edition }},'{{ $book->autor }}','{{ $book->cover }}',{{ $book->category_id }})" class="btn btn-warning mb-1" data-toggle="modal" data-target="#editBookModal">
                            Edit
                          </button>

                          <button onclick="deleteBook({{ $book->id }}, this)" class="btn btn-danger mb-1">
                            Delete
                          </button>

                        @endif

                        <button onclick="viewBook({{ $category->id }}, this)" class="btn btn-success mb-1" data-toggle="modal" data-target="#viewBookModal">
                          View more...
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

  <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('books') }}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Book's title" id="input_title" name="title">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Description</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <textarea class="form-control" placeholder="Book's description" id="input_description" name="description" cols="5"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Year</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="number" class="form-control" placeholder="Book's year of publication" id="input_year" name="year">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Pages</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="number" class="form-control" placeholder="Book's number of pages" id="input_pages" name="pages">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">ISBN</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Book's ISBN" id="input_isbn" name="isbn">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Editorial</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Book's editorial name" id="input_editorial" name="editorial">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Edition</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="number" class="form-control" placeholder="Book's edition number" id="input_edition" name="edition">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Autor</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Book's autor name" id="input_autor" name="autor">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Cover</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="file" class="form-control" id="input_cover" name="cover">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Category</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <select class="form-control" name="category_id">
                  
                  @if (isset($categories) && count($categories)>0)
                    @foreach ($categories as $category)
                      
                    <option value="{{ $category->id }}"> {{ $category->name }} </option>

                    @endforeach
                  @endif

                </select>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save book</button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form method="POST" action="{{ url('books') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="" id="title" name="title">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Description</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <textarea class="form-control" placeholder="" id="description" name="description" cols="5"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Year</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="number" class="form-control" placeholder="" id="year" name="year">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Pages</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="number" class="form-control" placeholder="" id="pages" name="pages">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">ISBN</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="" id="isbn" name="isbn">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Editorial</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="" id="editorial" name="editorial">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Edition</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="number" class="form-control" placeholder="" id="edition" name="edition">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Autor</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" class="form-control" placeholder="" id="autor" name="autor">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Cover</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="file" class="form-control" id="cover" name="cover">
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Category</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <select class="form-control" id="category_id" name="category_id">
                  
                  @if (isset($categories) && count($categories)>0)
                    @foreach ($categories as $category)
                      
                    <option value="{{ $category->id }}"> {{ $category->name }} </option>

                    @endforeach
                  @endif

                </select>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save book</button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <x-slot name="scripts">
    <script type="text/javascript">
      
      function editBook (id,title,description,year,pages,isbn,editorial,edition,autor,cover,category_id) 
      {
        $("#id").val(id)
        $("#title").val(title)
        $("#description").val(description)
        $("#year").val(year)
        $("#pages").val(pages)
        $("#isbn").val(isbn)
        $("#editorial").val(editorial)
        $("#edition").val(edition)
        $("#autor").val(autor)
        $("#cover").val(cover)
        $("#category_id").val(category_id)
      }

      function deleteBook (id,target)
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
            axios.delete('{{ url('books') }}/'+id, {
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
