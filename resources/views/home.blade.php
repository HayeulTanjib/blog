@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    Welcome!
                    <strong>{{ Auth::user()->name }}</strong><br><br>

                    <table class="table table-bordered">

                        <thead>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </thead>

                        @foreach($all_users as $users)

                        <tbody>
                           <td>{{ $users-> name }}</td>
                           <td>{{ $users-> email }}</td>
                           <td>{{ $users-> created_at }}</td>
                           <td>{{ $users-> updated_at }}</td>
                       </tbody>

                       @endforeach


                   </table>



               </div>
           </div>
       </div>
   </div>
</div>
@endsection
