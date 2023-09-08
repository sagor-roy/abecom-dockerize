<!-- JS Global Compulsory -->
<script src="{{ asset('frontend/assets/vendor/jquery/dist/jquery.min.js') }} "></script>
<script src="{{ asset('frontend/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }} "></script>
<script src="{{ asset('frontend/assets/vendor/popper.js/dist/umd/popper.min.js') }} "></script>
<script src="{{ asset('frontend/assets/vendor/bootstrap/bootstrap.min.js') }} "></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('frontend/assets/vendor/hs-megamenu/src/hs.megamenu.js') }} "></script>
<script src="{{ asset('frontend/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }} "></script>

<!-- JS Electro -->
<script src="{{ asset('frontend/assets/js/hs.core.js') }} "></script>
<script src="{{ asset('frontend/assets/js/components/hs.header.js') }} "></script>
<script src="{{ asset('frontend/assets/js/components/hs.unfold.js') }} "></script>
<script src="{{ asset('frontend/assets/js/components/hs.onscroll-animation.js') }} "></script>
<script src="{{ asset('frontend/assets/js/components/hs.go-to.js') }} "></script>

<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="{{ asset('frontend/assets/js/owl-carousel.min.js') }} "></script>
<script src="{{ asset('frontend/assets/js/custom.js') }} "></script>

@yield('per_page_js')

<!-- JS Plugins Init. -->
<script>


    $(document).on('ready', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#header'));

        // initialization of animation
        $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            afterOpen: function () {
                $(this).find('input[type="search"]').focus();
            }
        });

        // initialization of popups
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of countdowns
        var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
            yearsElSelector: '.js-cd-years',
            monthsElSelector: '.js-cd-months',
            daysElSelector: '.js-cd-days',
            hoursElSelector: '.js-cd-hours',
            minutesElSelector: '.js-cd-minutes',
            secondsElSelector: '.js-cd-seconds'
        });


    });
</script>