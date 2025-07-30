@extends("layouts.default ")
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
     <form> 
        
         <h1 class="h3 mb-3 fw-normal">Please sign in</h1> 
        <div class="form-floating"> <input type="email" name="email"class="form-control" id="floatingInput" placeholder="name@example.com"> 
        <label for="floatingInput">Email address</label> 
    </div> 
        <div class="form-floating"> <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password"> 
        <label for="floatingPassword">Password</label>
    </div> 
    <div class="form-check text-start my-3">
         <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault"> 
         <label class="form-check-label" for="checkDefault">
Remember me
</label> 
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
<button class="btn btn-primary w-100 py-2" type="submit">Sign in</button> 
<p>Don't have an account? <a href="{{ route("register") }}">Create account</a></p>
</form> 
</main>

@endsection