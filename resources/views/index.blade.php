@extends('layouts.main')
@section('content')
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Let's get your vehicle back on the trail!</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- List Tickets -->
  <section class="bg-light">
  <span class="pull-right"> @include('flash-message')</span>

    <div class="container">
      <div class="row">
          <table class="table table-striped">
            <thead>
              <th>Ticket #</th>
              <th>Client Name</th>
              <th>Vehicle</th>
              <th>vehicle Model</th>
              <th>Status</th>
              <th>Last Update</th>
              <th>Action</th>
            </thead>
            <tbody>
              @foreach($requests AS $request)
              <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->client_name }}</td>
                <td>{{$request->vehicle->title ?? ''}}</td>
                <td>{{$request->model->title ?? ''}}</td>
                
                <td>{{ $request->status }}</td>
                <td>{{ $request->updated_at->format('m/d/Y h:i a') }}</td>
                <td><a data-toggle="modal" data-target="#myModal1{{$request->id}}"><i class="fa fa-edit"></i></a>
                    <i class="fa fa-eye" data-toggle="modal" data-target="#myModal{{$request->id}}"></i>
                   

                    <a href="{{URL::to('/')}}/deleteticket?ids={{$request->id}}"><i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                       </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        {{ $requests->links() }}
      </div>
    </div>
  </section>
 @foreach($requests AS $request)

<div class="modal" id="myModal{{$request->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <!-- Modal body -->
        <div class="modal-body">
          
            <div class="row">
              
                    <div class="col-md-4"> Vehicle</div>
                    <div class="col-md-8">
                        {{$request->vehicle->title ?? ''}}
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4"> Model</div>
                    <div class="col-md-8">
                        {{$request->model->title ?? ''}}
                    </div>
                </div><br>
                 <div class="row">
                    <div class="col-md-4">Owner Name</div>
                    <div class="col-md-8">
                     {{$request->client_name}}
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">Owner Number</div>
                    <div class="col-md-8">
                      {{$request->client_phone}}
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">Owner Email</div>
                    <div class="col-md-8">
                       {{$request->client_email}}
                    </div>
                </div><br>
        
              <div class="row">
                    <div class="col-md-4"> Description</div>
                    <div class="col-md-8"> 
                      {{$request->description}}
                    </div>
                </div><br>
        </div>
        
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
  @endforeach
   @foreach($requests AS $request)
<div class="modal" id="myModal1{{$request->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Service</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  <div class="modal-body">
          <form action="{{ route('edit',[$request->id]) }}" method="get">
              @csrf
            <div class="row">
              <?php $Vehicle= DB::table('vehicle_makes')->get(); ?>
                    <div class="col-md-4">Select Vehicle</div>
                    <div class="col-md-8">
                        <select class="form-control @error('VehicleType') is-invalid @enderror" name="VehicleType" required  id="Vehicle">
                            <option value="" disabled selected>-- SELECT --</option>
                            @foreach($Vehicle as $data)
                            <option {{$request->Vehicaltype = $data->id ?'selected':""}} value="{{$data->id}}">{{$data->title}}</option>
                            @endforeach
                           
                        </select>
                    </div>
                </div><br>
                 <div class="row">
                    <div class="col-md-4">Owner Name</div>
                    <div class="col-md-8">
                       <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Owner name" value="{{$request->client_name}}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">Owner Number</div>
                    <div class="col-md-8">
                       <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="Owner Number" value="{{$request->client_phone}}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-4">Owner Email</div>
                    <div class="col-md-8">
                       <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Owner Email" value="{{$request->client_email}}">
                    </div>
                </div><br>
        
        <div class="row">
                    <div class="col-md-4"> Description(optinal)</div>
                    <div class="col-md-8"> 
                       <textarea  name="desc" class="form-control @error('desc') is-invalid @enderror">{{$request->description}}</textarea>
                    </div>
                </div><br>
                <center><button type="submit" class="btn btn-sm btn-success">Update</button></center>
        </div>
         </form>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  @endforeach
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
               alert();
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
@endsection