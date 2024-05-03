@extends('layouts.admin')

@section('image')
style=" background-image:URL({{asset('/images/maison.jpg')}}); background-attachment:fixed;background-repeat:no-repeat;background-size:cover"

         @endsection

@section('content')
<div class="container mt-0 p-0"style="text-align:center">
<div class="starter-template">
<h1> <span class="glyphicon glyphicon-cog" ></spans class="float-none"> <strong><b>MUTRA-UNB</b></strong></h1>
<!-- <ol class="breadcrumb" style=" background:#ffffff ">
<li><a href="#">accueil</a></li>
<li><a href="#">dashboard</a></li>
<li><a href="#">aller</a></li>
</ol> --></div></div>



<div class="container">
     <div class="row">
        <section class=" card col col-lg-9 " style="border-top:solid 30px blue; height:max-content ">
        <div class="card" style="border-top:solid 15px blue;   margin-bottom:3px">
        <div class="card-columns">
                 <div class="card mt-2 mb-0" style="text-align:center " >
             <h5 class="card-title bg-primary"></h5>
                  <blockquote class="blockquote m-2 p-1 card-body  " style="background:#0077B6">
                      <h2><b>Utilisateurs </b></h2> 
                         <p class="card-text"><h1><b>{{$personnel}}</b></h1></p>
                         </blockquote>
                 </div>

                 <div class="card mt-2 mb-3" style="text-align:center ">
             <h5 class="card-title bg-primary"></h5>
                  <blockquote class="blockquote m-2 p-2 card-body  "style="background:#CECBDA">
                      <h2><b>Patrimoine</b></h2> 
                         <p class="card-text"><h1><b>{{$nbrlogement}}L&{{$nbrparcelle}}P</b></h1></p>
                         </blockquote>
                 </div>



             
        </div>
        </section>
</div>
</div>
             
@endsection