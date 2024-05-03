@extends('layouts.admin')
@section('content')
<form action="{{route('Activite.update',$activitedetail)}}" method="POST">
    @csrf {{csrf_field()}}
    @method('PUT')
    <fieldset style=" font-size:40px; color:blue; margin-left:100px ; margin-top:30px"><h1>MODIFIER L' ACTIVITE</h1></fieldset>
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger 630" style="width: 600px; margin-left:35px"> {{ $err}}</p>
    @endforeach
    @endif
  <div class="form-floating mb-3 float-none " style="margin:35px; margin-top:5px; width:600px; border: solid 1px blue; border-radius:15px" >
   

  <div class="col-md m-2">
    <div class="form-floating">  
      <input type="texte" class="form-control" name="type" id="floatingInputGrid" placeholder="" value="{{$activitedetail->type_activite}}">
      <label class="form-control-label">Type Activite</label>
    </div>
  </div>

                      <?php $j=0; $tablong=count($activitedetail->champvalues); ?>
                      @for($j==0; $j < count($activityp->caracteristic);$j++)
         <div class="col-md m-2">
    <div class="form-floating">  
      <input type="texte" class="form-control" name="donne.{{$j}}" id="floatingInputGrid" placeholder="" value="{{$activitedetail->champvalues[$j]}}">
      <label class="form-control-label">{{ strtoupper($activityp->caracteristic[$j] )}}</label>
    </div>
  </div>
                          
                            @endfor



  <!-- <div class="col-md m-2">
    <div class="form-floating">
      <input type="texte" class="form-control" name="objet" id="floatingInputGrid" placeholder="OBJET" value="i">
      <label for="floatingInputGrid">OBJET</label>
    </div>
  </div>

  <div class="col-md m-2">
    <div class="form-floating">
      <input type="texte" class="form-control" name="resultattendu" id="floatingInputGrid" placeholder="RESULTATS ATTENDUS" value="">
      <label for="floatingInputGrid">RESULTATS ATTENDUS</label>
    </div>
  </div> -->




  


   <button type="submit" value="submit" class="btn btn-success " style="float:right ; margin-top:20px">MODIFIER</button>
</form>
</div>
@endsection
