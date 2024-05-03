@extends('layouts.admin')

@section('content')


@if(session('success'))
   <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
 @endif


<div class=" card float-none mt-2 mb-2">    
  <fieldset style="font-size:40px; margin-left:100px ; margin-top:0px; text-align:center"><h1>Gestion Des Notifications</h1></fieldset>     
    </div>


    <div class="b-example-divider b-example-vr " style=" overflow:auto; margin-right:170px; margin-left:170px; margin-top:25px; margin-bottom:25px; ">  


    <div class="container " >
           
        @foreach($users as $user)
              @if($user->unreadnotifications)
        
                   @foreach($user->unreadnotifications as $notification) 
                       @if($notification->type=='App\Notifications\paiementnotification')
                             <div class="alert alert-success" role="alert" style="overflow:auto">
                                 <h3>{{ $notification->data['name']}}</h3>  a ajouté un paiement le {{$notification->created_at}}<br>
                                 <a href="{{ route('markasred',$notification)}}" class=" btn btn-sm btn-warning float-end" data-id="{{$notification->id}}" style="margin-left:15px">Valider </a>
                                 <a href="{{ route('markonly',$notification)}}" class=" btn btn-sm btn-danger float-end" data-id="{{$notification->id}}">Annuler</a>

                              </div> 
                        @else    
                           <div class="alert alert-warning" role="alert" style="overflow:auto">
                                 <h3>{{ $notification->data['name']}}</h3>  a demande a participer a une activite le {{$notification->created_at}} <br>
                                 <a href="{{ route('accepter',$notification)}}" class=" btn btn-sm btn-warning float-end" data-id="">Approuver</a>

                                 <a href="{{ route('refuser',$notification)}}" class=" btn btn-sm btn-danger float-end" style="margin-right:14px" data-id="">Refuser </a>
                              </div> 
                        @endif
       
                    
                    @endforeach
              
              @endif
        @endforeach
    </div>
     
     
     <div class="b-example-divider b-example-vr " style="height: 5px; background-color:red; margin-top:25px; margin-bottom:25px "></div>  
     
     <div class="container">
     @foreach($users as $user)
         @foreach($user->readnotifications as $notification)
             <div class="col">
                  <div class="card-header" style="margin:10px">
                      <div class=" text-muted " role="alert" style="height:50px">
                          {{ $notification->data['name']}}  a ajouté un paiement le  [{{ $notification->created_at}}]
                     </div>
                 </div>
             </div>
            @endforeach    
     @endforeach 
     </div>


@endsection