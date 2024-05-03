<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
            <a class="navbar-brand brand-logo" >
               <strong><b>GEST-EVENTS</b></strong>   
              </a>
<!--           <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
 -->          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="mdi mdi-magnify"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        
        <ul class="navbar-nav navbar-nav-right">

         <!-- <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-message-text mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                  <h6 class="ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>-->


        <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="#messageDropdown" href="#" data-bs-toggle="dropdown" data-bs-target="#notifi">
            <i class="mdi mdi-bell mx-0"></i>
            <?php
            
            $nombre=count(\App\Models\User::All());       
            $i=1;
            $compte=0;
            for($i==0; $i<$nombre; $i++){
                 $users=App\Models\User::find($i);
                 if(count($users->unreadNotifications)>0){
                    $compte+= count($users->unreadNotifications);
                 } 
            }
            ?>
            @if($compte >=1)
               <span class=""><p style="color:red"> {{ $compte }}</p></span>
            @else
                <span class=""></span>
            @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown" id="notifi">
              <p class="mb-0 font-weight-normal float-left dropdown-header">NOTIFICATIONS</p>
                @if($compte >=1)
                <?php $user=\App\Models\User::All() ?>
                   @foreach($user as $user)                   
                       @foreach($user->unreadnotifications as $notification)

                         <a class="dropdown-item" href="{{ route('operatnotify.index')}}" style="text-decoration:none">
                           <div class="item-icon bg-info">
                               <i class="mdi mdi-account-box mx-0"></i>
                           </div>
                
                            <div class="item-content flex-grow">
                               @if($notification->type=='App\Notifications\paiementnotification')
                                     <h6 class="ellipsis font-weight-normal">{{ $notification->data['name']}}</h6>
                                     <p class="font-weight-light small-text text-muted mb-0">
                                        a ajouté un paiement </p>
                                @else
                                   <h6 class="ellipsis font-weight-normal">{{ $notification->data['name']}}</h6>
                                     <p class="font-weight-light small-text text-muted mb-0">
                                        a demande a participer a une activite </p>
                                @endif
                            </div>
                         </a>             
                       @endforeach  
                  @endforeach
                @else
                          <a href="{{ route('operatnotify.index')}}" style="text-decoration:none">
                         <div class="item-content flex-grow">
                             <p class="font-weight-light small-text text-muted mb-0">
                                Pas de nouvelles notifications
                              </p>
                         </div>                         
                @endif
                             </a>            
            </div>
          </li>


              <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="navbar-nav me-auto"> 

                    </ul>   -->

                    <!-- Right Side Of Navbar -->
                   <!--  <ul class="navbar-nav ms-auto"> -->
                        <!-- Authentication Links -->
                      <!--  @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest-->
                    </ul>
                </div>
                <!--<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        
    </div>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>  
      </div>-->
    </nav>