@extends('layouts.admin')
@section('content')


<div class="modal fade" id="ajoutparticipant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Title" style="color:blue"><b>AJOUTER DES PARTICIPANTS</b></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form action="" method="POST" class="col">
            @csrf {{csrf_field()}}
            
            <input type="text" id="inp1"  />
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="background-color:red">Annuler</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
       <button class="btn btn-primary btn-lg text-white float-end" >Ajouter</button>
       </form>
       
      </div>
    </div>
  </div>
</div>





<button id="button1" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#ajoutparticipant" data-bs-backdrop="false" data-bs-acti="bonjour" ><b>Add</b></button>
<button id="button2" class="btn btn-primary" data-acti="bonjour"><b>yes</b></button>

<button id="button3" class="btn btn-primary" data-acti="bonjour"><b>yes</b></button>





<script>
      $(document).on("click","#button1",function(){
        var monvar=$(this).data('acti');
        $("#inp1").val('bonjour');
        //document.getElementById('inp1').value='hello';
      })
    </script>
    <script>
         var monvar= document.getElementById("button2").data('acti');
         document.getElementById("button3").innerHTML='vrefrf'

       // document.getElementById('inp1').innerHTML('hey')
        //document.onclick(alert('bonjour'))
    </script>


@endsection