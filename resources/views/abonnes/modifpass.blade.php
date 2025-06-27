@extends('layouts.appuser')
@section('titre')
Gnonel - Mon compte
@endsection
@section('content')
<section class="section">
    <div class="section-header">
    <h1>Dashboard</h1>
    </div>
    <h2 class="section-title">Modification de mot de passe</h2>
  <br>
        <center>
      <div class="container" >
          <div class="row">
          <div class="col-lg-6" style="background-color:white;padding-bottom: 20px;">
            <br>
        <form action="{{route('postmodifpass')}}" method="post" file="true" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" required class="form-control">
        <label style="float: left;">Ancien mot de passe</label>
        <input class="form-control @error('old') is-invalid @enderror" value="{{ old('old') }}" name="old" required="true" type="password"> 
         @error('old')
                                <span  class="invalid-feedback" role="alert">
                                    <strong style="float: left;">{{ $message }}</strong>
                                </span>
        @enderror
        <br>
        <label  style="float: left;">Nouveau mot de Passe</label>
        <input class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required="true" name="password" type="password"> 
         @error('password')
                                <span  class="invalid-feedback" role="alert">
                                    <strong style="float: left;">{{ $message }}</strong>
                                </span>
        @enderror
        <br>
       <label  style="float: left;">Confirmation du Nouveau Mot de Passe</label>
        <input class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" required="true" name="password_confirmation" type="password"> 
    @error('password_confirmation')
                                <span  class="invalid-feedback" role="alert">
                                    <strong style="float: left;">{{ $message }}</strong>
                                </span>
        @enderror
        <br>
         <button class="btn btn-danger" style="float: right;margin-left:4px;">Annuler</button>
      <input type="submit" class="btn btn-info" style="float: right;" value="Enrégistrer">
</form>
          </div>
          </div>
    </section>
@endsection
@section('script')
    <script>

    </script>
@endsection