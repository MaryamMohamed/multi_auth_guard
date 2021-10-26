@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 45px">
             <h4>Admin Dashboard</h4><hr>
             <table class="table table-striped table-inverse table-responsive">
                 <thead class="thead-inverse">
                     <tr>
                         <th>Name</th>
                         <th>Email</th>
                     </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>{{ Auth::guard('admin')->user()->name }}</td>
                             <td>{{ Auth::guard('admin')->user()->email }}</td>
                         </tr>
                     </tbody>
             </table>
        </div>
    </div>
</div>
@endsection