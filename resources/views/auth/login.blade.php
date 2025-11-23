@extends('backend.layout.guest')
@section('mainSection')
    <div class="auth-page-wrapper pt-5">
        <div class="auth-page-content">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Visobotics.</p>
                                </div>

                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                required placeholder="Enter email" aria-describedby="emailHelp"
                                                value="{{ old('email') }}">
                                            <div id="emailHelp" class="form-text">We'll never share your email with
                                                anyone else.</div>
                                            <x-input-error style="color: red;" :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="text-muted">Forgot
                                                        password?</a>
                                                @endif
                                            </div>
                                            <label for="password-input" class="form-label">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input id="password-input" type="password" name="password"
                                                    class="form-control pe-5 password-input"
                                                    placeholder="Enter password" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <x-input-error style="color: red;" :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="remember_me" type="checkbox"
                                                name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember_me">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}"
                                    class="fw-semibold text-primary text-decoration-underline"> Signup </a></p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Visobotics. Crafted with <i class="mdi mdi-heart text-danger"></i>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->


    </div>

    <script>
        (function() {
            const pwdInput = document.querySelector('#password-input');
            const pwdBtn = document.querySelector('#password-addon');
            if (pwdBtn && pwdInput) {
                pwdBtn.addEventListener('click', function() {
                    const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    pwdInput.setAttribute('type', type);
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('ri-eye-fill');
                        icon.classList.toggle('ri-eye-off-fill');
                    }
                });
            }
            // Hide spinner once page fully loaded or after a small delay
            window.addEventListener('load', function() {
                const spinner = document.getElementById('spinner');
                if (spinner) {
                    spinner.classList.remove('show');
                    spinner.style.display = 'none';
                }
            });
        })();
    </script>

@endsection
