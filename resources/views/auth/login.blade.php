@extends('layouts.auth')

@section('content')
<div>
    <h5 class="text-primary">Welcome Back !</h5>
    <p class="text-muted">Sign in to continue</p>
</div>

<div class="mt-4">

    @include('partials.errors')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="{{old('username')}}" placeholder="Enter username" required>
        </div>

        <div class="mb-3">
            <div class="float-end" >
                <a href="{{ route('password.request') }}" class="text-muted" tabindex="-1">Forgot password?</a>
            </div>
            <label class="form-label">Password</label>
            <div class="input-group auth-pass-inputgroup">
                <input type="password" class="form-control" name="password" minlength="6" placeholder="Enter password" required>
            </div>
        </div>

        <div class="mt-3 d-grid">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
        </div>

    </form>
</div>
@endsection

@push('scripts')

@endpush
