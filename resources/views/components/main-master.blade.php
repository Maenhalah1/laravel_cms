<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @hasSection("header-top")
        @yield("header-top")
    @endif


    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
{{--    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/blog-home.css")}}">
    @hasSection("header-css-links")
        @yield("header-css-links")
    @endif

    @hasSection("header-scripts")
        @yield("header-scripts")
    @endif
    <!-- Custom styles for this template -->

</head>

<body>

<!-- Navigation -->
@hasSection("navbar")

    @yield("navbar")

@endif

<!-- Page Content -->
    <div class="container">
        <div class="row">
            @yield("content")

            @hasSection("slidebar")

                @yield("slidebar")

            @endif
        </div>
    </div>
    <!-- /.container -->


<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
</footer>
<!-- Bootstrap core JavaScript -->
<script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("css/app.js")}}"></script>
@hasSection("footer-scripts")
    @yield("footer-scripts")
@endif

</body>

</html>
