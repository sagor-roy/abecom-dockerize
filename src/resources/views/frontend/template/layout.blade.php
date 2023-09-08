<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-225553934-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-225553934-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, height=device-height"/>
    @include('frontend.includes.meta')

    @include('frontend.includes.css')
    
</head>

<body id="body">

      @include('frontend.includes.header')

       <!-- ========== MAIN CONTENT ========== -->
        <main id="content" role="main">
            @yield('body-content')
        </main>
        <!-- ========== MAIN CONTENT ========== -->

      @include('frontend.includes.footer')

    <!-- Go to Top -->
    <a class="js-go-to u-go-to" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed"
        data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
        <span class="fas fa-arrow-up u-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    @include('frontend.includes.script')
    
</body>

</html>