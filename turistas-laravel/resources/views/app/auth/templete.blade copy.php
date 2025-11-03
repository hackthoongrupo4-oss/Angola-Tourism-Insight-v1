<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="/dashboard/assets/css/toastr.min.css">
</head>
<body>
    
    @yield('content')

    <!-- Bootstrap 5 JS Bundle with Popper CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoYz1F1LgYxg1QnE7I1R1p4UQ7azj9Fz+W4nUJn1FjptK0M" crossorigin="anonymous"></script>
 <script src="/dashboard/assets/js/toastr.min.js"></script>

        
@if (session('logout'))
<script>
    "use strict";
    var o = "rtl" === $("html").attr("data-textdirection");

        toastr.success("{{ session('logout') }}",
            '', {
                closeButton: !0,
                tapToDismiss: !0,
                progressBar: !0,
                positionClass: "toast-bottom-right",
                rtl: o
            }
        );
   
</script>
 @endif

@if (session('login'))
    <script>
        $(document).ready(function() {
            var o = $("html").attr("data-textdirection") === "rtl";
            toastr.success("{{ session('login') }}", "", {
                closeButton: true,
                tapToDismiss: true,
                progressBar: true,
                positionClass: "toast-bottom-right",
                rtl: o
            });
        });
    </script>
@endif

@if (session('success'))
    <script>
        $(document).ready(function() {
            var o = $("html").attr("data-textdirection") === "rtl";
            toastr.success("{{ session('success') }}", "", {
                closeButton: true,
                tapToDismiss: true,
                progressBar: true,
                positionClass: "toast-bottom-right",
                rtl: o
            });
        });
    </script>
@endif
@if (session('error'))
    <script>
        $(document).ready(function() {
            var o = $("html").attr("data-textdirection") === "rtl";
            toastr.error("{{ session('error') }}", "", {
                closeButton: true,
                tapToDismiss: true,
                progressBar: true,
                positionClass: "toast-bottom-right",
                rtl: o
            });
        });
    </script>
@endif


</body>
</html>
