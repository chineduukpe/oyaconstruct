@extends('../adminlayout')
@section('title')
 {{Session::get('name')}} -home
@endsection

@section('style')
<style type="text/css">
  
  
</style>
 
@endsection

@section('content')

<h2>Welcome Admin!</h2>
<hr>  
@endsection
