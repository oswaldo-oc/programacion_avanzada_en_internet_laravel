<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

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
                        {{ $book->category_id }}
                      </td>
                    </tr>

                    @endforeach
                    @endif

                  </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
