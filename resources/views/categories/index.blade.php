<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <table class="table table-striped table-bordered">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
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
                    </tr>

                    @endforeach
                    @endif

                  </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
