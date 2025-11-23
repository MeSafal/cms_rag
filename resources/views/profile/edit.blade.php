{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@php

        use App\Models\Setting;
        use Illuminate\Support\Facades\Auth;

        $setting = Setting::where('createdby', Auth::id())->first();
        if ($setting) {
            $settingArray = $setting->toArray();
        } else {
            return redirect()->route('dashboard');
        }
    @endphp
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('backend.layout.sidebar')

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('backend.layout.header')
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            <h3>Welcome!!</h3> <h5 class="text-icon-welcome">{{Auth::user()->name}}!! </h5>
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!-- Hidden Form -->
                            <form id="imageForm" action="{{ route('settings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" id="hiddenImageUrl" name="profile_image" value="">
                                <input type="hidden" name="image" value="true">
                            </form>

                            <div class="image-container text-center position-relative">
                                <img id="previewImage" class="rounded-circle" src="{{ asset($settingArray['profile_image'] ?? 'img/user.jpg') }}"  alt="" style="width: 90px; height: 90px; object-fit: cover; border: 5px solid white;">
                                <div class="camera-icon-wrapper position-absolute">
                                    <!-- Camera Icon -->
                                    <a id="lfm" data-input="thumbnail" data-preview="holder">
                                        <i id="cameraIcon" class="fa fa-camera camera-icon"></i>
                                    </a>
                                    <!-- Tick Icon (Hidden Initially) -->
                                    <i id="tickIcon" class="fa fa-check tick-icon" style="display: none;"></i>
                                </div>
                            </div>
                        </div>

                        <style>
                        .image-container {
                            display: inline-block;
                            position: relative;
                            width: 90px;
                            height: 90px;
                        }

                        .image-container img {
                            border: 5px solid white;
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                        }

                        .camera-icon-wrapper {
                            bottom: 0;
                            right: 0;
                            position: absolute;
                            background-color: white;
                            width: 24px;
                            height: 24px;
                            border-radius: 50%;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            cursor: pointer;
                        }

                        .tick-icon {
                            font-size: 14px;
                            color: green;
                            cursor: pointer;
                        }
                        </style>

                        <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const cameraIcon = document.getElementById('cameraIcon');
                            const tickIcon = document.getElementById('tickIcon');
                            const previewImage = document.getElementById('previewImage');
                            const hiddenImageUrl = document.getElementById('hiddenImageUrl');
                            const imageForm = document.getElementById('imageForm');

                            // Initialize Laravel File Manager
                            document.getElementById('lfm').addEventListener('click', () => {
                                window.open('/laravel-filemanager?type=image', 'FileManager', 'width=900,height=600');
                                window.SetUrl = function (result) {
                                    if (Array.isArray(result) && result.length > 0) {
                                        const url = result[0].url; // Extract the URL from the first object
                                        previewImage.src = url;
                                        hiddenImageUrl.value = url; // Set the hidden input value

                                        // Hide camera icon and show tick icon
                                        cameraIcon.style.display = 'none';
                                        tickIcon.style.display = 'block';
                                    }
                                };
                            });

                            // Handle the tick icon click to submit the hidden form
                            tickIcon.addEventListener('click', () => {
                                imageForm.style.display = 'block'; // Reveal the form to allow submission (optional visual feedback)
                                imageForm.submit(); // Submit the form when the tick icon is clicked
                            });
                        });
                        </script>

                    </div>
                </div>
            </div>
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Update profile</h6>
                            <p>Update your account's profile information and email address.</p>
                            <form method="post" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Name</label>
                                    <input type="text" class="form-control" value="{{ old('name', $user->name) }}"
                                        required autofocus autocomplete="name" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required autocomplete="username"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" style="color:white;">Save</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Update Password</h6>
                            <p>Ensure your account is using a long, random password to stay secure</p>
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="update_password_current_password" class="form-label">Current
                                        Password</label>
                                    <input class="form-control" id="update_password_current_password"
                                        name="current_password" type="password">
                                </div>
                                <div class="mb-3">
                                    <label for="update_password_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="update_password_password"
                                        name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="update_password_password_confirmation" class="form-label">Confirm
                                        Password</label>
                                    <input type="password" class="form-control"
                                        id="update_password_password_confirmation" name="password_confirmation">
                                </div>
                                <button type="submit" class="btn btn-primary" style="color: white;">Save </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Account Start -->
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-secondary rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                <h6>Delete Account</h6>
                                <p>Once your account is deleted, all of its resources and data will be permanently
                                    deleted.
                                    Before deleting your account, please download any data or information that you wish
                                    to
                                    retain.</p>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end">
                                <button type="button" class="btn btn-outline-primary m-2">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Account End -->
            @include('backend.layout.footer')
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

</body>

</html>


