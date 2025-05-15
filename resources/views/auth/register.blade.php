<x-guest-layout>

    <div class="row">
        <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="user" action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Name">
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                            placeholder="Email Address">
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user"
                                id="exampleInputPassword" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password_confirmation" class="form-control form-control-user"
                                id="exampleRepeatPassword" placeholder="Repeat Password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                    <hr>
                </form>
                <div class="text-center">
                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>