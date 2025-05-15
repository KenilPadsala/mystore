<!-- Reset Password Form -->
<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-12">
                        <h2 class="mb-4 text-center">Reset Password</h2>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ request('email') }}">

                            <div class="mb-3">
                                <label class="form-label">New Password:</label>
                                <input type="password" name="password" required class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm Password:</label>
                                <input type="password" name="password_confirmation" required class="form-control">
                            </div>

                            @error('password')
                                <div class="alert alert-danger py-2">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary w-90">Reset Password</button>
                        </form>
                    
                
            </div>
        </div>
    </div>
</x-guest-layout>
