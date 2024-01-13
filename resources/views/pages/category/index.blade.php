@extends('pages.layout.index')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Category</h1>
    </div>
    <div class="w-full p-10">
        <div class="my-2">
            <a href="{{ route('category.create') }}" class="btn btn-success"> Create</a>
        </div>
        <table class="table ">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Category</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $c)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $c->nama_category }}</td>
                  </tr>
                @endforeach
            </tbody>
          </table>
      </div>
  </section>
@endsection