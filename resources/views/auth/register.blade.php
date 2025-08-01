@extends("layouts.default")
@section("style")
<style>
    html,
body {
  height: 100%;
}

.form-signin {
  max-width: 330px;
  padding: 1rem;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
@endsection
@section("content")
</div>  
<main class=" form-signin w-40 m-auto">
     <form method="POST" action="{{ route("register.post") }}"> 
        @csrf
        
         <h1 class="h3 mb-3 fw-normal">Create account</h1> 
         <div class="form-floating"> 
        <input name="name" type="text" class="form-control" id="floatingInput" placeholder="full name"> 
        <label for="floatingInput">Full Name</label> 
        @error('fullname')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div> 
        
        <div class="form-floating"> <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com"> 
        <label for="floatingInput">Email address</label> 
         @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div> 
   
        <div class="form-floating"> <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"> 
        <label for="floatingPassword">Password</label>
         @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div> 
    @if(session()->has("success"))
    <div class="alert alert-success">
        {{ session()->get("success") }}
    </div>
    @endif
     @if(session()->has("error"))
    <div class="alert alert-danger">
        {{ session()->get("error") }}
    </div>
    @endif
    <a href="{{ route("login.post") }}" > Already have an account?login</a>
<button class="btn btn-primary w-100 py-2" type="submit">Register</button> 

</form> 
</main>

@endsection