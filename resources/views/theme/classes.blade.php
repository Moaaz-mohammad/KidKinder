@extends('layouts.theme')
@section('page-title', 'Classes')

@section('content')
    
    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
      <div
        class="d-flex flex-column align-items-center justify-content-center"
        style="min-height: 400px"
      >
        <h3 class="display-3 font-weight-bold text-white">Our Classes</h3>
        <div class="d-inline-flex text-white">
          <p class="m-0"><a class="text-white" href="{{route('store')}}">Home</a></p>
          <p class="m-0 px-2">/</p>
          <p class="m-0">Our Classes</p>
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Class Start -->
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Popular Classes</span>
          </p>
          <h1 class="mb-4">Classes for Your Kids</h1>
        </div>
        <div class="row">
          @if (count($clsses) > 0)
            @foreach ($clsses->take(6) as $class)
            @php
              $existsRequest = auth()->user()?->classRequests()->where('class_id', $class->id)->whereIn('status', ['pending', 'approved'])->first();
            @endphp
              <div class="col-lg-4 mb-5">
                <div class="card border-0 bg-light shadow-sm pb-2">
                  <img class="card-img-top mb-2" src="img/class-1.jpg" alt="" />
                  <div class="card-body text-center">
                    <h4 class="card-title">{{$class->class_content_name}}</h4>
                    <p class="card-text">
                      {{$class->description}}
                    </p>
                  </div>
                  <div class="card-footer bg-transparent py-4 px-5">
                    <div class="row border-bottom">
                      <div class="col-6 py-1 text-right border-right">
                        <strong>Age of Kids</strong>
                      </div>
                      <div class="col-6 py-1">{{$class->from_age}} - {{$class->to_age}} Years</div>
                    </div>
                    <div class="row border-bottom">
                      <div class="col-6 py-1 text-right border-right">
                        <strong>Total Seats</strong>
                      </div>
                      <div class="col-6 py-1">{{$class->total_seats}} Seats</div>
                    </div>
                    <div class="row border-bottom justify-content-center align-items-center">
                      <div class="col-4 py-0 text-right border-right">
                        <strong>Class Time</strong>
                      </div>
                      <div class="col-8 py-1">{{$class->from_time}} - {{$class->to}}</div>
                    </div>
                    <div class="row">
                      <div class="col-6 py-1 text-right border-right">
                        <strong>Tution Fee</strong>
                      </div>
                      <div class="col-6 py-1">${{$class->tution_fee}} / Month</div>
                    </div>
                  </div>
                  @hasrole('admin')
                    <a href="{{route('admin.requests.index')}}" class="btn btn-secondary px-4 mx-auto mb-4">You are an Admin</a>
                  @else 
                    <a 
                      href="{{$existsRequest ? route('requests.index') : route('join.class', $class->id)}}" 
                      class="btn {{$existsRequest ? 'btn-secondary disabled' : "btn-primary"}} px-4 mx-auto mb-4" 
                      @if ($existsRequest) aria-disabled="true" @endif>
                      {{$existsRequest ? 'Already Requested' : 'Join Class'}}
                    </a>
                  @endhasrole
                </div>
              </div>
              {{-- <div class="col-lg-4 mb-5">
                <div class="card border-0 bg-light shadow-sm pb-2">
                  <img class="card-img-top mb-2" src="img/class-1.jpg" alt="" />
                  <div class="card-body text-center">
                    <h4 class="card-title">{{$class->class_content_name}}</h4>
                    <p class="card-text">
                      {{$class->description}}
                    </p>
                  </div>
                  <div class="card-footer bg-transparent py-4 px-5">
                    <div class="row border-bottom">
                      <div class="col-6 py-1 text-right border-right">
                        <strong>Age of Kids</strong>
                      </div>
                      <div class="col-6 py-1">{{$class->from_age}} - {{$class->to_age}} Years</div>
                    </div>
                    <div class="row border-bottom">
                      <div class="col-6 py-1 text-right border-right">
                        <strong>Total Seats</strong>
                      </div>
                      <div class="col-6 py-1">{{$class->total_seats}} Seats</div>
                    </div>
                    <div class="row border-bottom justify-content-center align-items-center">
                      <div class="col-4 py-0 text-right border-right">
                        <strong>Class Time</strong>
                      </div>
                      <div class="col-8 py-1">{{$class->from_time}} - {{$class->to}}</div>
                    </div>
                    <div class="row">
                      <div class="col-6 py-1 text-right border-right">
                        <strong>Tution Fee</strong>
                      </div>
                      <div class="col-6 py-1">${{$class->tution_fee}} / Month</div>
                    </div>
                  </div>
                  <a href="{{route('join.class', $class->id)}}" class="btn btn-primary px-4 mx-auto mb-4">Join Now</a>
                </div>
              </div> --}}
            @endforeach
          @endif
        </div>
      </div>
    </div>
    <!-- Class End -->

    <!-- Registration Start -->
    <div class="container-fluid py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-5 mb-lg-0">
            <p class="section-title pr-5">
              <span class="pr-2">Book A Seat</span>
            </p>
            <h1 class="mb-4">Book A Seat For Your Kid</h1>
            <p>
              Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo
              dolor lorem ipsum ut sed eos, ipsum et dolor kasd sit ea justo.
              Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est
              dolor
            </p>
            <ul class="list-inline m-0">
              <li class="py-2">
                <i class="fa fa-check text-success mr-3"></i>Labore eos amet
                dolor amet diam
              </li>
              <li class="py-2">
                <i class="fa fa-check text-success mr-3"></i>Etsea et sit dolor
                amet ipsum
              </li>
              <li class="py-2">
                <i class="fa fa-check text-success mr-3"></i>Diam dolor diam
                elitripsum vero.
              </li>
            </ul>
            <a href="" class="btn btn-primary mt-4 py-2 px-4">Book Now</a>
          </div>
          <div class="col-lg-5">
            <div class="card border-0">
              <div class="card-header bg-secondary text-center p-4">
                <h1 class="text-white m-0">Book A Seat</h1>
              </div>
              <div class="card-body rounded-bottom bg-primary p-5">
                <form>
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control border-0 p-4"
                      placeholder="Your Name"
                      required="required"
                    />
                  </div>
                  <div class="form-group">
                    <input
                      type="email"
                      class="form-control border-0 p-4"
                      placeholder="Your Email"
                      required="required"
                    />
                  </div>
                  <div class="form-group">
                    <select
                      class="custom-select border-0 px-4"
                      style="height: 47px"
                    >
                      <option selected>Select A Class</option>
                      <option value="1">Class 1</option>
                      <option value="2">Class 1</option>
                      <option value="3">Class 1</option>
                    </select>
                  </div>
                  <div>
                    <button
                      class="btn btn-secondary btn-block border-0 py-3"
                      type="submit"
                    >
                      Book Now
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Registration End -->
@endsection