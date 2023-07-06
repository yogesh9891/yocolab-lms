@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                      
                            <h3>These are the ongoing classes available on the system</h3>
                            @foreach($classes as $key=>$class)
                            @if($class->zoom_url)
                             {{$key + 1}}. {{$class->name}}
                             @if($class->user_id == Auth::user()->id)
                              <a href="{{$class->zoom_url}}" target="_blank" class="btn btn-info">Start Session</a>
                              @else
                                  @php  $array = explode(';',$class->student_id); @endphp 
                                  @if(array_search(Auth::user()->id, $array) != -1 )
                                  <a href="{{$class->zoom_url}}" target="_blank" class="btn btn-success">Join Session</a>

                                  @else
                                     <a href="#" target="_blank" class="btn btn-danger">Not Allowed</a>
                                  @endif
                                @endif
                            @else
                                <a href="{{route('classroom', ['id' => $class->id])}}">{{$key + 1}}. {{$class->name}}</a>
                            @endif
                                <br />
                            @endforeach
                       
                            <h4>Welcome {{$user->name}}. Fill the form below to create a class</h4>
                            <form method="POST" action="{{ route('create_class') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-12 col-form-label">{{ __('Class Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Create Class') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                            @if($user->hasRole('teacher'))
                           <h4>Welcome {{$user->name}}. Fill the form below to create zoom class</h4>
                            <form method="POST" action="{{ route('create_zoom_class') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-12 col-form-label">{{ __('Class Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Create Class') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endif

                       

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
