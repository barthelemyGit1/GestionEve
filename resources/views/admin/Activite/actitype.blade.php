@extends(auth()->user()->role_as==1 ? "layouts.admin" : "layouts.appp")


@section('content')

<!-- <fieldset style=" font-size:40px; color:blue; margin-left:100px ; margin-top:30px"><h1>AJOUTER DES ACTIVITES</h1></fieldset>
 -->

<div class="float-none mt-0 mb-2">    
  <fieldset style="font-size:40px; color:blue; margin-left:100px ; margin-top:3px; text-align:center"><h1><b>DONNEZ LES CHAMPS CARACTERISTISUES DE L'ACTIVITE {{strtoupper($type)}}</b></h1></fieldset>     
    </div>
    
    @if(session('success'))
   <p class="alert alert-success" id="script1" style="font-size:30px"> {{ session('success') }}</p>
 @endif


 <form action="{{ route('setactivite', $nombre)}}" method="POST">
    @csrf {{csrf_field()}}
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger 630" style="width: 600px; margin-left:35px"> {{ $err}}</p>
    @endforeach
    @endif
   <?php $i=0; $y='champ_'; ?>
   <div class="col-md m-2">
    <div class="form-control" style="overflow: auto;">
   <label for="floatingInputGrid"><b>Type ou le Nom d'activite</b></label>
   <input type="texte" name="type" class="form-control" placeholder="" value="{{strtoupper($type)}}" style="color:red;width:50%">
     @for($i==0; $i<$nombre; $i++)
     <?php $z=$y.$i ?>
    <label for="floatingInputGrid" style="width:50%"><b>Champ{{$i+1}}</b></label>
    <input type="texte" name="champ.{{$i}}" class=" form-control"  placeholder="Entrez le champs N°{{$i+1}}" style="margin-bottom:5px;width:50%" value="" required>
    <select name="typechamp.{{$i}}" class="d-inline float-end form-select" onchange="this.nextElementSibling.value=this.value" style="overflow: auto ;padding:5px;margin-top:-40px; width:45%" required>
                                        <option value="text">CHOISISSEZ LE TYPE DU CHAMP{{$i+1}}</option>
                                        <option value="text">ALPHABETIQUE</option>
                                        <option value="number">NUMERIQUE</option>
                                        <option value="text">ALPHANUMERIQUE</option> 
                                        <option value="date">DATE</option> 

                                    </select>
     @endfor
    </div>
    </div> 
     <button type="submit" class="btn btn-primary " style="float:right ; margin-top:20px">Ajouter</button>
    </form> 
    <div class="">
 <a class="btn btn-danger" style="margin:0px" onclick="retourner()">Retour</a>
 </div>


 <script>
     function retourner() {
          window.history.back()
       }
       </script>



@endsection