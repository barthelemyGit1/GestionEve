
@extends("layouts.appp")
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            <h2>
                Accueil
            </h2>
        </div>
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
                 
      <br>
        <div class="card">
        <div class="container">
    <div class="row justify-content-center">
        
            <div class="card">
                <div class="card-header">{{ __('Acceuil') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{ __('User Page!') }}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>




@endsection