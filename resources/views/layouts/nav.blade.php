<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta name="_token" content="{{ csrf_token() }}">

</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
  <a class="navbar-brand" href="#"><img src="{{URL::to('/')}}/img/logo.png" style="max-height:75px;">Jim's Offroad Service</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ URL::to('/') }}">Current Tickets</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Create a Ticket</a>
      
  <!-- Button to Open the Modal -->
  <span class="pull-right"> @include('flash-message')</span>


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="{{URL::to('/') }}/store" method="post">
              @csrf
            <div class="row">
              <?php $Vehicle= DB::table('vehicle_makes')->get(); ?>
                    <div class="col-md-4">Select Vehicle</div>
                    <div class="col-md-8">
                        <select class="form-control @error('VehicleType') is-invalid @enderror" name="VehicleType" required  id="Vehicle">
                            <option value="" disabled selected>-- SELECT --</option>
                            @foreach($Vehicle as $data)
                            <option value="{{$data->id}}">{{$data->title}}</option>
                            @endforeach
                           
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">Select Model</div>
                    <div class="col-md-8">
                        <select id="model"  class="form-control  @error('model') is-invalid @enderror" name="model">
                        
                    </select>
                    </div>
                </div><br>
                 <div class="row">
                    <div class="col-md-4">Owner Name</div>
                    <div class="col-md-8">
                       <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Owner name">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">Owner Number</div>
                    <div class="col-md-8">
                       <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="Owner Number">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">Owner Email</div>
                    <div class="col-md-8">
                       <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Owner Email">
                    </div>
                </div><br>
        
        <div class="row">
                    <div class="col-md-4"> Description(optinal)</div>
                    <div class="col-md-8"> 
                       <textarea  name="desc" class="form-control @error('desc') is-invalid @enderror"></textarea>
                    </div>
                </div><br>
                <center><button type="submit" class="btn btn-sm btn-success">Submit</button></center>
        </div>
         </form>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

      </li>
      
    </ul>
  </div>
</nav>
</body>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
         jQuery(document).ready(function(){
            jQuery('#Vehicle').change(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               var e = document.getElementById('Vehicle');
               var Vehicle = e.options[e.selectedIndex].value;
               jQuery.ajax({
                  url: "{{URL::to('/')}}/getmodels",
                  method: 'post',
                  data: {
                     name: Vehicle
                     
                  },
                  success: function(response){
              var ans = "<option value=''>--Select--</option>";
                for(var i=0;i<response.length;i++)
                {
                    ans += "<option value='"+response[i].id+"'>"+response[i].title+"</option>";
                }
                document.getElementById('model').innerHTML = ans;
                  },
             error: function (error) {
                     
                      console.log(error);
                    
                    }


                });
               });
            });
</script>

</html>