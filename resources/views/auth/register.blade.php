@extends('backend.layout.guest')
@section('mainSection')
    <div class="auth-page-wrapper pt-5">
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="{{ url('/') }}" class="d-inline-block auth-logo">
                                <img src="{{ asset('img/logo-light.png') }}" alt="logo" height="20">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Visobotics — Create your account</p>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 card-bg-fill">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Get Started</h5>
                                    <p class="text-muted">Create your Visobotics account, quick and secure.</p>
                                </div>

                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                required placeholder="Enter your name" value="{{ old('name') }}">
                                            <x-input-error style="color: red;" :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input id="email" name="email" type="email" class="form-control"
                                                required placeholder="Enter email" value="{{ old('email') }}"
                                                aria-describedby="emailHelp">
                                            <div id="emailHelp" class="form-text">We'll never share your email with
                                                anyone else.</div>
                                            <x-input-error style="color: red;" :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="password-input" class="form-label">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input id="password-input" name="password" type="password"
                                                    class="form-control pe-5 password-input" placeholder="Enter password"
                                                    required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <x-input-error style="color: red;" :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm
                                                Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input id="password_confirmation" name="password_confirmation"
                                                    type="password" class="form-control pe-5 password-input-confirm"
                                                    placeholder="Confirm password" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon-confirm"
                                                    type="button" id="password-addon-confirm"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                            <x-input-error style="color: red;" :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="terms_check" type="checkbox" name="terms"
                                                {{ old('terms') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="terms_check">I agree to the <a
                                                    href="#" class="text-decoration-underline">Terms &
                                                    Conditions</a></label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Create
                                                Account</button>
                                        </div>

                                    </form>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                                class="fw-semibold text-primary text-decoration-underline"> Log In </a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

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
            const toggle = (btnSel, inputSel) => {
                const btn = document.querySelector(btnSel);
                const input = document.querySelector(inputSel);
                if (!btn || !input) return;
                btn.addEventListener('click', function() {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('ri-eye-fill');
                        icon.classList.toggle('ri-eye-off-fill');
                    }
                });
            };
            toggle('#password-addon', '#password-input');
            toggle('#password-addon-confirm', '#password_confirmation');

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
