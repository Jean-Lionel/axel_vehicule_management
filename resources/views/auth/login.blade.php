<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="CodeHim" />
        <title>Authentification</title>
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('template/css/style.css') }}" />
        <!-- Demo CSS (No need to include it into your project) -->
        <link rel="stylesheet" href="{{ asset('template/css/demo.css') }}" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"
        />
    </head>
    <body>
        <!--$%adsense%$-->
        <main class="cd__main " style="margin:20px auto">
            <!-- Start DEMO HTML (Use the following code into your project)-->
            <div class="container ">
                <div class="row content shadow p-3 mb-5 bg-white rounded p-4">
                    <div class="col-md-6 mb-3 ">
  <img class="img-fluid" src="{{ asset('template/css/undraw_electric_car_b-7-hl.svg') }}" />
                    </div>
                    <div class="col-md-6">
                        <h3 class="signin-text mb-3">Sign In</h3>
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                focus
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    style="text-indent:20px"
                                />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    style="text-indent:20px"
                                    />
                            </div>
                            <div class="form-group form-check">
                                <input
                                    type="checkbox"
                                    name="checkbox"
                                    class="form-check-input"
                                    id="checkbox"
                                />
                                <label class="form-check-label" for="checkbox"
                                    >Remember Me</label
                                >
                            </div>
                            <button class="btn btn-class">Login</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END EDMO HTML (Happy Coding!)-->
        </main>

        <!-- Script JS -->
        <script src="./js/script.js"></script>
        <!--$%analytics%$-->
    </body>
</html>
