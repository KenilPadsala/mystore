<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-12">
                    <div class="card-body">
                        <h2 class="mb-4 text-center">Forgot Password</h2>

                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" required class="form-control">
                            </div>
                            @error('email')
                                <div class="alert alert-danger py-2">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary w-90" href="{{ route('login') }}">Send Reset Link</button>
                        </form>
                    </div>
                
            </div>
        </div>
    </div>
</x-guest-layout>
