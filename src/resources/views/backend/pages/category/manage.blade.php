@extends('backend.template.layout')

@section('body-content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!-- title row start -->
    <div class="row">
        <div class="col-md-12">
            <!--begin:: Widgets/Application Sales-->
            <div class="kt-portlet kt-portlet--height-fluid">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            All Category
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">
                                    Add Category
                                </button>

                                <!-- Modal -->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('category.add') }}" class="ajax-form"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Category Name</label>
                                                        <input type="text" class="form-control" name="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Position</label>
                                                        <input type="number" class="form-control" min="1"
                                                            name="position">
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="icon" class="form-control" id="chosen">
                                                            <option value="fa-align-left">&#xf036; fa-align-left
                                                            </option>
                                                            <option value="fa-align-right">&#xf038; fa-align-right
                                                            </option>
                                                            <option value="fa-amazon">&#xf270; fa-amazon</option>
                                                            <option value="fa-ambulance">&#xf0f9; fa-ambulance</option>
                                                            <option value="fa-anchor">&#xf13d; fa-anchor</option>
                                                            <option value="fa-android">&#xf17b; fa-android</option>
                                                            <option value="fa-angellist">&#xf209; fa-angellist</option>
                                                            <option value="fa-angle-double-down">&#xf103;
                                                                fa-angle-double-down</option>
                                                            <option value="fa-angle-double-left">&#xf100;
                                                                fa-angle-double-left</option>
                                                            <option value="fa-angle-double-right">&#xf101;
                                                                fa-angle-double-right</option>
                                                            <option value="fa-angle-double-up">&#xf102;
                                                                fa-angle-double-up</option>
                                                            <option value="fa-angle-left">&#xf104; fa-angle-left
                                                            </option>
                                                            <option value="fa-angle-right">&#xf105; fa-angle-right
                                                            </option>
                                                            <option value="fa-angle-up">&#xf106; fa-angle-up</option>
                                                            <option value="fa-apple">&#xf179; fa-apple</option>
                                                            <option value="fa-archive">&#xf187; fa-archive</option>
                                                            <option value="fa-area-chart">&#xf1fe; fa-area-chart
                                                            </option>
                                                            <option value="fa-arrow-circle-down">&#xf0ab;
                                                                fa-arrow-circle-down</option>
                                                            <option value="fa-arrow-circle-left">&#xf0a8;
                                                                fa-arrow-circle-left</option>
                                                            <option value="fa-arrow-circle-o-down">&#xf01a;
                                                                fa-arrow-circle-o-down</option>
                                                            <option value="fa-arrow-circle-o-left">&#xf190;
                                                                fa-arrow-circle-o-left</option>
                                                            <option value="fa-arrow-circle-o-right">&#xf18e;
                                                                fa-arrow-circle-o-right</option>
                                                            <option value="fa-arrow-circle-o-up">&#xf01b;
                                                                fa-arrow-circle-o-up</option>
                                                            <option value="fa-arrow-circle-right">&#xf0a9;
                                                                fa-arrow-circle-right</option>
                                                            <option value="fa-arrow-circle-up">&#xf0aa;
                                                                fa-arrow-circle-up</option>
                                                            <option value="fa-arrow-down">&#xf063; fa-arrow-down
                                                            </option>
                                                            <option value="fa-arrow-left">&#xf060; fa-arrow-left
                                                            </option>
                                                            <option value="fa-arrow-right">&#xf061; fa-arrow-right
                                                            </option>
                                                            <option value="fa-arrow-up">&#xf062; fa-arrow-up</option>
                                                            <option value="fa-arrows">&#xf047; fa-arrows</option>
                                                            <option value="fa-arrows-alt">&#xf0b2; fa-arrows-alt
                                                            </option>
                                                            <option value="fa-arrows-h">&#xf07e; fa-arrows-h</option>
                                                            <option value="fa-arrows-v">&#xf07d; fa-arrows-v</option>
                                                            <option value="fa-asterisk">&#xf069; fa-asterisk</option>
                                                            <option value="fa-at">&#xf1fa; fa-at</option>
                                                            <option value="fa-automobile">&#xf1b9; fa-automobile
                                                            </option>
                                                            <option value="fa-backward">&#xf04a; fa-backward</option>
                                                            <option value="fa-balance-scale">&#xf24e; fa-balance-scale
                                                            </option>
                                                            <option value="fa-ban">&#xf05e; fa-ban</option>
                                                            <option value="fa-bank">&#xf19c; fa-bank</option>
                                                            <option value="fa-bar-chart">&#xf080; fa-bar-chart</option>
                                                            <option value="fa-bar-chart-o">&#xf080; fa-bar-chart-o
                                                            </option>
                                                            <option value="fa-battery-full">&#xf240; fa-battery-full
                                                            </option>
                                                            n value="fa-beer">&#xf0fc; fa-beer</option>
                                                            <option value="fa-behance">&#xf1b4; fa-behance</option>
                                                            <option value="fa-behance-square">&#xf1b5; fa-behance-square
                                                            </option>
                                                            <option value="fa-bell">&#xf0f3; fa-bell</option>
                                                            <option value="fa-bell-o">&#xf0a2; fa-bell-o</option>
                                                            <option value="fa-bell-slash">&#xf1f6; fa-bell-slash
                                                            </option>
                                                            <option value="fa-bell-slash-o">&#xf1f7; fa-bell-slash-o
                                                            </option>
                                                            <option value="fa-bicycle">&#xf206; fa-bicycle</option>
                                                            <option value="fa-binoculars">&#xf1e5; fa-binoculars
                                                            </option>
                                                            <option value="fa-birthday-cake">&#xf1fd; fa-birthday-cake
                                                            </option>
                                                            <option value="fa-bitbucket">&#xf171; fa-bitbucket</option>
                                                            <option value="fa-bitbucket-square">&#xf172;
                                                                fa-bitbucket-square</option>
                                                            <option value="fa-bitcoin">&#xf15a; fa-bitcoin</option>
                                                            <option value="fa-black-tie">&#xf27e; fa-black-tie</option>
                                                            <option value="fa-bold">&#xf032; fa-bold</option>
                                                            <option value="fa-bolt">&#xf0e7; fa-bolt</option>
                                                            <option value="fa-bomb">&#xf1e2; fa-bomb</option>
                                                            <option value="fa-book">&#xf02d; fa-book</option>
                                                            <option value="fa-bookmark">&#xf02e; fa-bookmark</option>
                                                            <option value="fa-bookmark-o">&#xf097; fa-bookmark-o
                                                            </option>
                                                            <option value="fa-briefcase">&#xf0b1; fa-briefcase</option>
                                                            <option value="fa-btc">&#xf15a; fa-btc</option>
                                                            <option value="fa-bug">&#xf188; fa-bug</option>
                                                            <option value="fa-building">&#xf1ad; fa-building</option>
                                                            <option value="fa-building-o">&#xf0f7; fa-building-o
                                                            </option>
                                                            <option value="fa-bullhorn">&#xf0a1; fa-bullhorn</option>
                                                            <option value="fa-bullseye">&#xf140; fa-bullseye</option>
                                                            <option value="fa-bus">&#xf207; fa-bus</option>
                                                            <option value="fa-cab">&#xf1ba; fa-cab</option>
                                                            <option value="fa-calendar">&#xf073; fa-calendar</option>
                                                            <option value="fa-camera">&#xf030; fa-camera</option>
                                                            <option value="fa-car">&#xf1b9; fa-car</option>
                                                            <option value="fa-caret-up">&#xf0d8; fa-caret-up</option>
                                                            <option value="fa-cart-plus">&#xf217; fa-cart-plus</option>
                                                            <option value="fa-cc">&#xf20a; fa-cc</option>
                                                            <option value="fa-cc-amex">&#xf1f3; fa-cc-amex</option>
                                                            <option value="fa-cc-jcb">&#xf24b; fa-cc-jcb</option>
                                                            <option value="fa-cc-paypal">&#xf1f4; fa-cc-paypal</option>
                                                            <option value="fa-cc-stripe">&#xf1f5; fa-cc-stripe</option>
                                                            <option value="fa-cc-visa">&#xf1f0; fa-cc-visa</option>
                                                            <option value="fa-chain">&#xf0c1; fa-chain</option>
                                                            <option value="fa-check">&#xf00c; fa-check</option>
                                                            <option value="fa-chevron-left">&#xf053; fa-chevron-left
                                                            </option>
                                                            <option value="fa-chevron-right">&#xf054; fa-chevron-right
                                                            </option>
                                                            <option value="fa-chevron-up">&#xf077; fa-chevron-up
                                                            </option>
                                                            <option value="fa-child">&#xf1ae; fa-child</option>
                                                            <option value="fa-chrome">&#xf268; fa-chrome</option>
                                                            <option value="fa-circle">&#xf111; fa-circle</option>
                                                            <option value="fa-circle-o">&#xf10c; fa-circle-o</option>
                                                            <option value="fa-circle-o-notch">&#xf1ce; fa-circle-o-notch
                                                            </option>
                                                            <option value="fa-circle-thin">&#xf1db; fa-circle-thin
                                                            </option>
                                                            <option value="fa-clipboard">&#xf0ea; fa-clipboard</option>
                                                            <option value="fa-clock-o">&#xf017; fa-clock-o</option>
                                                            <option value="fa-clone">&#xf24d; fa-clone</option>
                                                            <option value="fa-close">&#xf00d; fa-close</option>
                                                            <option value="fa-cloud">&#xf0c2; fa-cloud</option>
                                                            <option value="fa-cloud-download">&#xf0ed; fa-cloud-download
                                                            </option>
                                                            <option value="fa-cloud-upload">&#xf0ee; fa-cloud-upload
                                                            </option>
                                                            <option value="fa-cny">&#xf157; fa-cny</option>
                                                            <option value="fa-code">&#xf121; fa-code</option>
                                                            <option value="fa-code-fork">&#xf126; fa-code-fork</option>
                                                            <option value="fa-codepen">&#xf1cb; fa-codepen</option>
                                                            <option value="fa-coffee">&#xf0f4; fa-coffee</option>
                                                            <option value="fa-cog">&#xf013; fa-cog</option>
                                                            <option value="fa-cogs">&#xf085; fa-cogs</option>
                                                            <option value="fa-columns">&#xf0db; fa-columns</option>
                                                            <option value="fa-comment">&#xf075; fa-comment</option>
                                                            <option value="fa-comment-o">&#xf0e5; fa-comment-o</option>
                                                            <option value="fa-commenting">&#xf27a; fa-commenting
                                                            </option>
                                                            <option value="fa-commenting-o">&#xf27b; fa-commenting-o
                                                            </option>
                                                            <option value="fa-comments">&#xf086; fa-comments</option>
                                                            <option value="fa-comments-o">&#xf0e6; fa-comments-o
                                                            </option>
                                                            <option value="fa-compass">&#xf14e; fa-compass</option>
                                                            <option value="fa-compress">&#xf066; fa-compress</option>
                                                            <option value="fa-connectdevelop">&#xf20e; fa-connectdevelop
                                                            </option>
                                                            <option value="fa-contao">&#xf26d; fa-contao</option>
                                                            <option value="fa-copy">&#xf0c5; fa-copy</option>
                                                            <option value="fa-copyright">&#xf1f9; fa-copyright</option>
                                                            <option value="fa-creative-commons">&#xf25e;
                                                                fa-creative-commons</option>
                                                            <option value="fa-credit-card">&#xf09d; fa-credit-card
                                                            </option>
                                                            <option value="fa-crop">&#xf125; fa-crop</option>
                                                            <option value="fa-crosshairs">&#xf05b; fa-crosshairs
                                                            </option>
                                                            <option value="fa-css3">&#xf13c; fa-css3</option>
                                                            <option value="fa-cube">&#xf1b2; fa-cube</option>
                                                            <option value="fa-cubes">&#xf1b3; fa-cubes</option>
                                                            <option value="fa-cut">&#xf0c4; fa-cut</option>
                                                            <option value="fa-cutlery">&#xf0f5; fa-cutlery</option>
                                                            <option value="fa-dashboard">&#xf0e4; fa-dashboard</option>
                                                            <option value="fa-dashcube">&#xf210; fa-dashcube</option>
                                                            <option value="fa-database">&#xf1c0; fa-database</option>
                                                            <option value="fa-dedent">&#xf03b; fa-dedent</option>
                                                            <option value="fa-delicious">&#xf1a5; fa-delicious</option>
                                                            <option value="fa-desktop">&#xf108; fa-desktop</option>
                                                            <option value="fa-deviantart">&#xf1bd; fa-deviantart
                                                            </option>
                                                            <option value="fa-diamond">&#xf219; fa-diamond</option>
                                                            <option value="fa-digg">&#xf1a6; fa-digg</option>
                                                            <option value="fa-dollar">&#xf155; fa-dollar</option>
                                                            <option value="fa-download">&#xf019; fa-download</option>
                                                            <option value="fa-dribbble">&#xf17d; fa-dribbble</option>
                                                            <option value="fa-dropbox">&#xf16b; fa-dropbox</option>
                                                            <option value="fa-drupal">&#xf1a9; fa-drupal</option>
                                                            <option value="fa-edit">&#xf044; fa-edit</option>
                                                            <option value="fa-eject">&#xf052; fa-eject</option>
                                                            <option value="fa-ellipsis-h">&#xf141; fa-ellipsis-h
                                                            </option>
                                                            <option value="fa-ellipsis-v">&#xf142; fa-ellipsis-v
                                                            </option>
                                                            <option value="fa-empire">&#xf1d1; fa-empire</option>
                                                            <option value="fa-envelope">&#xf0e0; fa-envelope</option>
                                                            <option value="fa-envelope-o">&#xf003; fa-envelope-o
                                                            </option>
                                                            <option value="fa-eur">&#xf153; fa-eur</option>
                                                            <option value="fa-euro">&#xf153; fa-euro</option>
                                                            <option value="fa-exchange">&#xf0ec; fa-exchange</option>
                                                            <option value="fa-exclamation">&#xf12a; fa-exclamation
                                                            </option>
                                                            <option value="fa-exclamation-circle">&#xf06a;
                                                                fa-exclamation-circle</option>
                                                            <option value="fa-exclamation-triangle">&#xf071;
                                                                fa-exclamation-triangle</option>
                                                            <option value="fa-expand">&#xf065; fa-expand</option>
                                                            <option value="fa-expeditedssl">&#xf23e; fa-expeditedssl
                                                            </option>
                                                            <option value="fa-external-link">&#xf08e; fa-external-link
                                                            </option>
                                                            <option value="fa-external-link-square">&#xf14c;
                                                                fa-external-link-square</option>
                                                            <option value="fa-eye">&#xf06e; fa-eye</option>
                                                            <option value="fa-eye-slash">&#xf070; fa-eye-slash</option>
                                                            <option value="fa-eyedropper">&#xf1fb; fa-eyedropper
                                                            </option>
                                                            <option value="fa-facebook">&#xf09a; fa-facebook</option>
                                                            <option value="fa-facebook-f">&#xf09a; fa-facebook-f
                                                            </option>
                                                            <option value="fa-facebook-official">&#xf230;
                                                                fa-facebook-official</option>
                                                            <option value="fa-facebook-square">&#xf082;
                                                                fa-facebook-square</option>
                                                            <option value="fa-fast-backward">&#xf049; fa-fast-backward
                                                            </option>
                                                            <option value="fa-fast-forward">&#xf050; fa-fast-forward
                                                            </option>
                                                            <option value="fa-fax">&#xf1ac; fa-fax</option>
                                                            <option value="fa-feed">&#xf09e; fa-feed</option>
                                                            <option value="fa-female">&#xf182; fa-female</option>
                                                            <option value="fa-fighter-jet">&#xf0fb; fa-fighter-jet
                                                            </option>
                                                            <option value="fa-file">&#xf15b; fa-file</option>
                                                            <option value="fa-file-archive-o">&#xf1c6; fa-file-archive-o
                                                            </option>
                                                            <option value="fa-file-audio-o">&#xf1c7; fa-file-audio-o
                                                            </option>
                                                            <option value="fa-file-code-o">&#xf1c9; fa-file-code-o
                                                            </option>
                                                            <option value="fa-file-excel-o">&#xf1c3; fa-file-excel-o
                                                            </option>
                                                            <option value="fa-file-image-o">&#xf1c5; fa-file-image-o
                                                            </option>
                                                            <option value="fa-file-movie-o">&#xf1c8; fa-file-movie-o
                                                            </option>
                                                            <option value="fa-file-o">&#xf016; fa-file-o</option>
                                                            <option value="fa-file-pdf-o">&#xf1c1; fa-file-pdf-o
                                                            </option>
                                                            <option value="fa-file-photo-o">&#xf1c5; fa-file-photo-o
                                                            </option>
                                                            <option value="fa-file-picture-o">&#xf1c5; fa-file-picture-o
                                                            </option>
                                                            <option value="fa-file-powerpoint-o">&#xf1c4;
                                                                fa-file-powerpoint-o</option>
                                                            <option value="fa-file-sound-o">&#xf1c7; fa-file-sound-o
                                                            </option>
                                                            <option value="fa-file-text">&#xf15c; fa-file-text</option>
                                                            <option value="fa-file-text-o">&#xf0f6; fa-file-text-o
                                                            </option>
                                                            <option value="fa-file-video-o">&#xf1c8; fa-file-video-o
                                                            </option>
                                                            <option value="fa-file-word-o">&#xf1c2; fa-file-word-o
                                                            </option>
                                                            <option value="fa-file-zip-o">&#xf1c6; fa-file-zip-o
                                                            </option>
                                                            <option value="fa-files-o">&#xf0c5; fa-files-o</option>
                                                            <option value="fa-film">&#xf008; fa-film</option>
                                                            <option value="fa-filter">&#xf0b0; fa-filter</option>
                                                            <option value="fa-fire">&#xf06d; fa-fire</option>
                                                            <option value="fa-fire-extinguisher">&#xf134;
                                                                fa-fire-extinguisher</option>
                                                            <option value="fa-firefox">&#xf269; fa-firefox</option>
                                                            <option value="fa-flag">&#xf024; fa-flag</option>
                                                            <option value="fa-flag-checkered">&#xf11e; fa-flag-checkered
                                                            </option>
                                                            <option value="fa-flag-o">&#xf11d; fa-flag-o</option>
                                                            <option value="fa-flash">&#xf0e7; fa-flash</option>
                                                            <option value="fa-flask">&#xf0c3; fa-flask</option>
                                                            <option value="fa-flickr">&#xf16e; fa-flickr</option>
                                                            <option value="fa-floppy-o">&#xf0c7; fa-floppy-o</option>
                                                            <option value="fa-folder">&#xf07b; fa-folder</option>
                                                            <option value="fa-folder-o">&#xf114; fa-folder-o</option>
                                                            <option value="fa-folder-open">&#xf07c; fa-folder-open
                                                            </option>
                                                            <option value="fa-folder-open-o">&#xf115; fa-folder-open-o
                                                            </option>
                                                            <option value="fa-font">&#xf031; fa-font</option>
                                                            <option value="fa-fonticons">&#xf280; fa-fonticons</option>
                                                            <option value="fa-forumbee">&#xf211; fa-forumbee</option>
                                                            <option value="fa-forward">&#xf04e; fa-forward</option>
                                                            <option value="fa-foursquare">&#xf180; fa-foursquare
                                                            </option>
                                                            <option value="fa-frown-o">&#xf119; fa-frown-o</option>
                                                            <option value="fa-futbol-o">&#xf1e3; fa-futbol-o</option>
                                                            <option value="fa-gamepad">&#xf11b; fa-gamepad</option>
                                                            <option value="fa-gavel">&#xf0e3; fa-gavel</option>
                                                            <option value="fa-gbp">&#xf154; fa-gbp</option>
                                                            <option value="fa-ge">&#xf1d1; fa-ge</option>
                                                            <option value="fa-gear">&#xf013; fa-gear</option>
                                                            <option value="fa-gears">&#xf085; fa-gears</option>
                                                            <option value="fa-genderless">&#xf22d; fa-genderless
                                                            </option>
                                                            <option value="fa-get-pocket">&#xf265; fa-get-pocket
                                                            </option>
                                                            <option value="fa-gg">&#xf260; fa-gg</option>
                                                            <option value="fa-gg-circle">&#xf261; fa-gg-circle</option>
                                                            <option value="fa-gift">&#xf06b; fa-gift</option>
                                                            <option value="fa-git">&#xf1d3; fa-git</option>
                                                            <option value="fa-git-square">&#xf1d2; fa-git-square
                                                            </option>
                                                            <option value="fa-github">&#xf09b; fa-github</option>
                                                            <option value="fa-github-alt">&#xf113; fa-github-alt
                                                            </option>
                                                            <option value="fa-github-square">&#xf092; fa-github-square
                                                            </option>
                                                            <option value="fa-gittip">&#xf184; fa-gittip</option>
                                                            <option value="fa-glass">&#xf000; fa-glass</option>
                                                            <option value="fa-globe">&#xf0ac; fa-globe</option>
                                                            <option value="fa-google">&#xf1a0; fa-google</option>
                                                            <option value="fa-google-plus">&#xf0d5; fa-google-plus
                                                            </option>
                                                            <option value="fa-google-plus-square">&#xf0d4;
                                                                fa-google-plus-square</option>
                                                            <option value="fa-google-wallet">&#xf1ee; fa-google-wallet
                                                            </option>
                                                            <option value="fa-graduation-cap">&#xf19d; fa-graduation-cap
                                                            </option>
                                                            <option value="fa-gratipay">&#xf184; fa-gratipay</option>
                                                            <option value="fa-group">&#xf0c0; fa-group</option>
                                                            <option value="fa-h-square">&#xf0fd; fa-h-square</option>
                                                            <option value="fa-hacker-news">&#xf1d4; fa-hacker-news
                                                            </option>
                                                            <option value="fa-hand-grab-o">&#xf255; fa-hand-grab-o
                                                            </option>
                                                            <option value="fa-hand-lizard-o">&#xf258; fa-hand-lizard-o
                                                            </option>
                                                            <option value="fa-hand-o-down">&#xf0a7; fa-hand-o-down
                                                            </option>
                                                            <option value="fa-hand-o-left">&#xf0a5; fa-hand-o-left
                                                            </option>
                                                            <option value="fa-hand-o-right">&#xf0a4; fa-hand-o-right
                                                            </option>
                                                            <option value="fa-hand-o-up">&#xf0a6; fa-hand-o-up</option>
                                                            <option value="fa-hand-paper-o">&#xf256; fa-hand-paper-o
                                                            </option>
                                                            <option value="fa-hand-peace-o">&#xf25b; fa-hand-peace-o
                                                            </option>
                                                            <option value="fa-hand-pointer-o">&#xf25a; fa-hand-pointer-o
                                                            </option>
                                                            <option value="fa-hand-rock-o">&#xf255; fa-hand-rock-o
                                                            </option>
                                                            <option value="fa-hand-scissors-o">&#xf257;
                                                                fa-hand-scissors-o</option>
                                                            <option value="fa-hand-spock-o">&#xf259; fa-hand-spock-o
                                                            </option>
                                                            <option value="fa-hand-stop-o">&#xf256; fa-hand-stop-o
                                                            </option>
                                                            <option value="fa-hdd-o">&#xf0a0; fa-hdd-o</option>
                                                            <option value="fa-header">&#xf1dc; fa-header</option>
                                                            <option value="fa-headphones">&#xf025; fa-headphones
                                                            </option>
                                                            <option value="fa-heart">&#xf004; fa-heart</option>
                                                            <option value="fa-heart-o">&#xf08a; fa-heart-o</option>
                                                            <option value="fa-heartbeat">&#xf21e; fa-heartbeat</option>
                                                            <option value="fa-history">&#xf1da; fa-history</option>
                                                            <option value="fa-home">&#xf015; fa-home</option>
                                                            <option value="fa-hospital-o">&#xf0f8; fa-hospital-o
                                                            </option>
                                                            <option value="fa-hotel">&#xf236; fa-hotel</option>
                                                            <option value="fa-hourglass">&#xf254; fa-hourglass</option>
                                                            <option value="fa-hourglass-1">&#xf251; fa-hourglass-1
                                                            </option>
                                                            <option value="fa-hourglass-2">&#xf252; fa-hourglass-2
                                                            </option>
                                                            <option value="fa-hourglass-3">&#xf253; fa-hourglass-3
                                                            </option>
                                                            <option value="fa-hourglass-end">&#xf253; fa-hourglass-end
                                                            </option>
                                                            <option value="fa-hourglass-half">&#xf252; fa-hourglass-half
                                                            </option>
                                                            <option value="fa-hourglass-o">&#xf250; fa-hourglass-o
                                                            </option>
                                                            <option value="fa-hourglass-start">&#xf251;
                                                                fa-hourglass-start</option>
                                                            <option value="fa-houzz">&#xf27c; fa-houzz</option>
                                                            <option value="fa-html5">&#xf13b; fa-html5</option>
                                                            <option value="fa-i-cursor">&#xf246; fa-i-cursor</option>
                                                            <option value="fa-ils">&#xf20b; fa-ils</option>
                                                            <option value="fa-image">&#xf03e; fa-image</option>
                                                            <option value="fa-inbox">&#xf01c; fa-inbox</option>
                                                            <option value="fa-indent">&#xf03c; fa-indent</option>
                                                            <option value="fa-industry">&#xf275; fa-industry</option>
                                                            <option value="fa-info">&#xf129; fa-info</option>
                                                            <option value="fa-info-circle">&#xf05a; fa-info-circle
                                                            </option>
                                                            <option value="fa-inr">&#xf156; fa-inr</option>
                                                            <option value="fa-instagram">&#xf16d; fa-instagram</option>
                                                            <option value="fa-institution">&#xf19c; fa-institution
                                                            </option>
                                                            <option value="fa-internet-explorer">&#xf26b;
                                                                fa-internet-explorer</option>
                                                            <option value="fa-intersex">&#xf224; fa-intersex</option>
                                                            <option value="fa-ioxhost">&#xf208; fa-ioxhost</option>
                                                            <option value="fa-italic">&#xf033; fa-italic</option>
                                                            <option value="fa-joomla">&#xf1aa; fa-joomla</option>
                                                            <option value="fa-jpy">&#xf157; fa-jpy</option>
                                                            <option value="fa-jsfiddle">&#xf1cc; fa-jsfiddle</option>
                                                            <option value="fa-key">&#xf084; fa-key</option>
                                                            <option value="fa-keyboard-o">&#xf11c; fa-keyboard-o
                                                            </option>
                                                            <option value="fa-krw">&#xf159; fa-krw</option>
                                                            <option value="fa-language">&#xf1ab; fa-language</option>
                                                            <option value="fa-laptop">&#xf109; fa-laptop</option>
                                                            <option value="fa-lastfm">&#xf202; fa-lastfm</option>
                                                            <option value="fa-lastfm-square">&#xf203; fa-lastfm-square
                                                            </option>
                                                            <option value="fa-leaf">&#xf06c; fa-leaf</option>
                                                            <option value="fa-leanpub">&#xf212; fa-leanpub</option>
                                                            <option value="fa-legal">&#xf0e3; fa-legal</option>
                                                            <option value="fa-lemon-o">&#xf094; fa-lemon-o</option>
                                                            <option value="fa-level-down">&#xf149; fa-level-down
                                                            </option>
                                                            <option value="fa-level-up">&#xf148; fa-level-up</option>
                                                            <option value="fa-life-bouy">&#xf1cd; fa-life-bouy</option>
                                                            <option value="fa-life-buoy">&#xf1cd; fa-life-buoy</option>
                                                            <option value="fa-life-ring">&#xf1cd; fa-life-ring</option>
                                                            <option value="fa-life-saver">&#xf1cd; fa-life-saver
                                                            </option>
                                                            <option value="fa-lightbulb-o">&#xf0eb; fa-lightbulb-o
                                                            </option>
                                                            <option value="fa-line-chart">&#xf201; fa-line-chart
                                                            </option>
                                                            <option value="fa-link">&#xf0c1; fa-link</option>
                                                            <option value="fa-linkedin">&#xf0e1; fa-linkedin</option>
                                                            <option value="fa-linkedin-square">&#xf08c;
                                                                fa-linkedin-square</option>
                                                            <option value="fa-linux">&#xf17c; fa-linux</option>
                                                            <option value="fa-list">&#xf03a; fa-list</option>
                                                            <option value="fa-list-alt">&#xf022; fa-list-alt</option>
                                                            <option value="fa-list-ol">&#xf0cb; fa-list-ol</option>
                                                            <option value="fa-list-ul">&#xf0ca; fa-list-ul</option>
                                                            <option value="fa-location-arrow">&#xf124; fa-location-arrow
                                                            </option>
                                                            <option value="fa-lock">&#xf023; fa-lock</option>
                                                            <option value="fa-long-arrow-down">&#xf175;
                                                                fa-long-arrow-down</option>
                                                            <option value="fa-long-arrow-left">&#xf177;
                                                                fa-long-arrow-left</option>
                                                            <option value="fa-long-arrow-right">&#xf178;
                                                                fa-long-arrow-right</option>
                                                            <option value="fa-long-arrow-up">&#xf176; fa-long-arrow-up
                                                            </option>
                                                            <option value="fa-magic">&#xf0d0; fa-magic</option>
                                                            <option value="fa-magnet">&#xf076; fa-magnet</option>
                                                            <option value="fa-mars-stroke-v">&#xf22a; fa-mars-stroke-v
                                                            </option>
                                                            <option value="fa-maxcdn">&#xf136; fa-maxcdn</option>
                                                            <option value="fa-meanpath">&#xf20c; fa-meanpath</option>
                                                            <option value="fa-medium">&#xf23a; fa-medium</option>
                                                            <option value="fa-medkit">&#xf0fa; fa-medkit</option>
                                                            <option value="fa-meh-o">&#xf11a; fa-meh-o</option>
                                                            <option value="fa-mercury">&#xf223; fa-mercury</option>
                                                            <option value="fa-microphone">&#xf130; fa-microphone
                                                            </option>
                                                            <option value="fa-mobile">&#xf10b; fa-mobile</option>
                                                            <option value="fa-motorcycle">&#xf21c; fa-motorcycle
                                                            </option>
                                                            <option value="fa-mouse-pointer">&#xf245; fa-mouse-pointer
                                                            </option>
                                                            <option value="fa-music">&#xf001; fa-music</option>
                                                            <option value="fa-navicon">&#xf0c9; fa-navicon</option>
                                                            <option value="fa-neuter">&#xf22c; fa-neuter</option>
                                                            <option value="fa-newspaper-o">&#xf1ea; fa-newspaper-o
                                                            </option>
                                                            <option value="fa-opencart">&#xf23d; fa-opencart</option>
                                                            <option value="fa-openid">&#xf19b; fa-openid</option>
                                                            <option value="fa-opera">&#xf26a; fa-opera</option>
                                                            <option value="fa-outdent">&#xf03b; fa-outdent</option>
                                                            <option value="fa-pagelines">&#xf18c; fa-pagelines</option>
                                                            <option value="fa-paper-plane-o">&#xf1d9; fa-paper-plane-o
                                                            </option>
                                                            <option value="fa-paperclip">&#xf0c6; fa-paperclip</option>
                                                            <option value="fa-paragraph">&#xf1dd; fa-paragraph</option>
                                                            <option value="fa-paste">&#xf0ea; fa-paste</option>
                                                            <option value="fa-pause">&#xf04c; fa-pause</option>
                                                            <option value="fa-paw">&#xf1b0; fa-paw</option>
                                                            <option value="fa-paypal">&#xf1ed; fa-paypal</option>
                                                            <option value="fa-pencil">&#xf040; fa-pencil</option>
                                                            <option value="fa-pencil-square-o">&#xf044;
                                                                fa-pencil-square-o</option>
                                                            <option value="fa-phone">&#xf095; fa-phone</option>
                                                            <option value="fa-photo">&#xf03e; fa-photo</option>
                                                            <option value="fa-picture-o">&#xf03e; fa-picture-o</option>
                                                            <option value="fa-pie-chart">&#xf200; fa-pie-chart</option>
                                                            <option value="fa-pied-piper">&#xf1a7; fa-pied-piper
                                                            </option>
                                                            <option value="fa-pied-piper-alt">&#xf1a8; fa-pied-piper-alt
                                                            </option>
                                                            <option value="fa-pinterest">&#xf0d2; fa-pinterest</option>
                                                            <option value="fa-pinterest-p">&#xf231; fa-pinterest-p
                                                            </option>
                                                            <option value="fa-pinterest-square">&#xf0d3;
                                                                fa-pinterest-square</option>
                                                            <option value="fa-plane">&#xf072; fa-plane</option>
                                                            <option value="fa-play">&#xf04b; fa-play</option>
                                                            <option value="fa-play-circle">&#xf144; fa-play-circle
                                                            </option>
                                                            <option value="fa-play-circle-o">&#xf01d; fa-play-circle-o
                                                            </option>
                                                            <option value="fa-plug">&#xf1e6; fa-plug</option>
                                                            <option value="fa-plus">&#xf067; fa-plus</option>
                                                            <option value="fa-plus-circle">&#xf055; fa-plus-circle
                                                            </option>
                                                            <option value="fa-plus-square">&#xf0fe; fa-plus-square
                                                            </option>
                                                            <option value="fa-plus-square-o">&#xf196; fa-plus-square-o
                                                            </option>
                                                            <option value="fa-power-off">&#xf011; fa-power-off</option>
                                                            <option value="fa-print">&#xf02f; fa-print</option>
                                                            <option value="fa-puzzle-piece">&#xf12e; fa-puzzle-piece
                                                            </option>
                                                            <option value="fa-qq">&#xf1d6; fa-qq</option>
                                                            <option value="fa-qrcode">&#xf029; fa-qrcode</option>
                                                            <option value="fa-question">&#xf128; fa-question</option>
                                                            <option value="fa-question-circle">&#xf059;
                                                                fa-question-circle</option>
                                                            <option value="fa-quote-left">&#xf10d; fa-quote-left
                                                            </option>
                                                            <option value="fa-quote-right">&#xf10e; fa-quote-right
                                                            </option>
                                                            <option value="fa-ra">&#xf1d0; fa-ra</option>
                                                            <option value="fa-random">&#xf074; fa-random</option>
                                                            <option value="fa-rebel">&#xf1d0; fa-rebel</option>
                                                            <option value="fa-recycle">&#xf1b8; fa-recycle</option>
                                                            <option value="fa-reddit">&#xf1a1; fa-reddit</option>
                                                            <option value="fa-reddit-square">&#xf1a2; fa-reddit-square
                                                            </option>
                                                            <option value="fa-refresh">&#xf021; fa-refresh</option>
                                                            <option value="fa-registered">&#xf25d; fa-registered
                                                            </option>
                                                            <option value="fa-remove">&#xf00d; fa-remove</option>
                                                            <option value="fa-renren">&#xf18b; fa-renren</option>
                                                            <option value="fa-reorder">&#xf0c9; fa-reorder</option>
                                                            <option value="fa-repeat">&#xf01e; fa-repeat</option>
                                                            <option value="fa-reply">&#xf112; fa-reply</option>
                                                            <option value="fa-reply-all">&#xf122; fa-reply-all</option>
                                                            <option value="fa-retweet">&#xf079; fa-retweet</option>
                                                            <option value="fa-rmb">&#xf157; fa-rmb</option>
                                                            <option value="fa-road">&#xf018; fa-road</option>
                                                            <option value="fa-rocket">&#xf135; fa-rocket</option>
                                                            <option value="fa-rotate-left">&#xf0e2; fa-rotate-left
                                                            </option>
                                                            <option value="fa-rotate-right">&#xf01e; fa-rotate-right
                                                            </option>
                                                            <option value="fa-rouble">&#xf158; fa-rouble</option>
                                                            <option value="fa-rss">&#xf09e; fa-rss</option>
                                                            <option value="fa-rss-square">&#xf143; fa-rss-square
                                                            </option>
                                                            <option value="fa-rub">&#xf158; fa-rub</option>
                                                            <option value="fa-ruble">&#xf158; fa-ruble</option>
                                                            <option value="fa-rupee">&#xf156; fa-rupee</option>
                                                            <option value="fa-safari">&#xf267; fa-safari</option>
                                                            <option value="fa-sliders">&#xf1de; fa-sliders</option>
                                                            <option value="fa-slideshare">&#xf1e7; fa-slideshare
                                                            </option>
                                                            <option value="fa-smile-o">&#xf118; fa-smile-o</option>
                                                            <option value="fa-sort-asc">&#xf0de; fa-sort-asc</option>
                                                            <option value="fa-sort-desc">&#xf0dd; fa-sort-desc</option>
                                                            <option value="fa-sort-down">&#xf0dd; fa-sort-down</option>
                                                            <option value="fa-spinner">&#xf110; fa-spinner</option>
                                                            <option value="fa-spoon">&#xf1b1; fa-spoon</option>
                                                            <option value="fa-spotify">&#xf1bc; fa-spotify</option>
                                                            <option value="fa-square">&#xf0c8; fa-square</option>
                                                            <option value="fa-square-o">&#xf096; fa-square-o</option>
                                                            <option value="fa-star">&#xf005; fa-star</option>
                                                            <option value="fa-star-half">&#xf089; fa-star-half</option>
                                                            <option value="fa-stop">&#xf04d; fa-stop</option>
                                                            <option value="fa-subscript">&#xf12c; fa-subscript</option>
                                                            <option value="fa-tablet">&#xf10a; fa-tablet</option>
                                                            <option value="fa-tachometer">&#xf0e4; fa-tachometer
                                                            </option>
                                                            <option value="fa-tag">&#xf02b; fa-tag</option>
                                                            <option value="fa-tags">&#xf02c; fa-tags</option>
                                                            <option value="address-book">&#xf2b9; address-book</option>
                                                            <option value="address-card">&#xf2bb; address-card</option>
                                                            <option value="angry">&#xf556; angry</option>
                                                            <option value="arrow-alt-circle-down">&#xf358;
                                                                arrow-alt-circle-down</option>
                                                            <option value="arrow-alt-circle-left">&#xf359;
                                                                arrow-alt-circle-left</option>
                                                            <option value="arrow-alt-circle-right">&#xf35a;
                                                                arrow-alt-circle-right</option>
                                                            <option value="arrow-alt-circle-up">&#xf35b;
                                                                arrow-alt-circle-up</option>
                                                            <option value="bell">&#xf0f3; bell</option>
                                                            <option value="bell-slash">&#xf1f6; bell-slash</option>
                                                            <option value="bookmark">&#xf02e; bookmark</option>
                                                            <option value="building">&#xf1ad; building</option>
                                                            <option value="calendar">&#xf133; calendar</option>
                                                            <option value="calendar-alt">&#xf073; calendar-alt</option>
                                                            <option value="calendar-check">&#xf274; calendar-check
                                                            </option>
                                                            <option value="calendar-minus">&#xf272; calendar-minus
                                                            </option>
                                                            <option value="calendar-plus">&#xf271; calendar-plus
                                                            </option>
                                                            <option value="calendar-times">&#xf273; calendar-times
                                                            </option>
                                                            <option value="caret-square-down">&#xf150; caret-square-down
                                                            </option>
                                                            <option value="caret-square-left">&#xf191; caret-square-left
                                                            </option>
                                                            <option value="caret-square-right">&#xf152;
                                                                caret-square-right</option>
                                                            <option value="caret-square-up">&#xf151; caret-square-up
                                                            </option>
                                                            <option value="chart-bar">&#xf080; chart-bar</option>
                                                            <option value="check-circle">&#xf058; check-circle</option>
                                                            <option value="check-square">&#xf14a; check-square</option>
                                                            <option value="circle">&#xf111; circle</option>
                                                            <option value="clipboard">&#xf328; clipboard</option>
                                                            <option value="clock">&#xf017; clock</option>
                                                            <option value="clone">&#xf24d; clone</option>
                                                            <option value="closed-captioning">&#xf20a; closed-captioning
                                                            </option>
                                                            <option value="comment">&#xf075; comment</option>
                                                            <option value="comment-alt">&#xf27a; comment-alt</option>
                                                            <option value="comment-dots">&#xf4ad; comment-dots</option>
                                                            <option value="comments">&#xf086; comments</option>
                                                            <option value="compass">&#xf14e; compass</option>
                                                            <option value="copy">&#xf0c5; copy</option>
                                                            <option value="copyright">&#xf1f9; copyright</option>
                                                            <option value="credit-card">&#xf09d; credit-card</option>
                                                            <option value="dizzy">&#xf567; dizzy</option>
                                                            <option value="dot-circle">&#xf192; dot-circle</option>
                                                            <option value="edit">&#xf044; edit</option>
                                                            <option value="envelope">&#xf40e0 envelope </option>
                                                            <option value="envelope-open">&#xf2b6; envelope-open
                                                            </option>
                                                            <option value="eye">&#xf06e; eye</option>
                                                            <option value="eye-slash">&#xf070; eye-slash</option>
                                                            <option value="file">&#xf15b; file</option>
                                                            <option value="file-alt">&#xf15c; file-alt</option>
                                                            <option value="file-archive">&#xf1c6; file-archive</option>
                                                            <option value="file-audio">&#xf1c7; file-audio</option>
                                                            <option value="file-code">&#xf1c9; file-code</option>
                                                            <option value="file-excel">&#xf1c3; file-excel </option>
                                                            <option value="file-image">&#xf1c5; file-image</option>
                                                            <option value="file-pdf">&#xf1c1; file-pdf</option>
                                                            <option value="file-powerpoint">&#xf1c4; file-powerpoint
                                                            </option>
                                                            <option value="file-video">&#xf1c8; file-video</option>
                                                            <option value="file-word">&#xf1c2; file-word</option>
                                                            <option value="flag">&#xf024; flag</option>
                                                            <option value="flushed">&#xf579; flushed</option>
                                                            <option value="folder">&#xf07b; folder</option>
                                                            <option value="folder-open">&#xf07c; folder-open </option>
                                                            <option value="frown">&#xf119; frown</option>
                                                            <option value="frown-open">&#xf57a; frown-open</option>
                                                            <option value="futbol">&#xf1e3; futbol</option>
                                                            <option value="gem">&#xf3a5; gem</option>
                                                            <option value="grimace">&#xf57f; grimace</option>
                                                            <option value="grin">&#xf580; grin</option>
                                                            <option value="grin-alt">&#xf581; grin-alt</option>
                                                            <option value="grin-beam">&#xf582; grin-beam</option>
                                                            <option value="grin-beam-sweet">&#xf583; grin-beam-sweet
                                                            </option>
                                                            <option value="grin-hearts">&#xf584; grin-hearts</option>
                                                            <option value="grin-squint">&#xf585; grin-squint</option>
                                                            <option value="grin-squint-tears">&#xf586; grin-squint-tears
                                                            </option>
                                                            <option value="grin-stars">&#xf587; grin-stars</option>
                                                            <option value="grin-tears">&#xf588; grin-tears</option>
                                                            <option value="grin-tongue">&#xf589; grin-tongue</option>
                                                            <option value="grin-tongue-squint">&#xf58a;
                                                                grin-tongue-squint</option>
                                                            <option value="grin-tongue-wink">&#xf58b; grin-tongue-wink
                                                            </option>
                                                            <option value="grin-wink">&#xf58c; grin-wink </option>
                                                            <option value="hand-lizard">&#xf258; hand-lizard</option>
                                                            <option value="hand-paper">&#xf256; hand-paper</option>
                                                            <option value="hand-peace">&#xf25b; hand-peace</option>
                                                            <option value="hand-point-down">&#xf0a7; hand-point-down
                                                            </option>
                                                            <option value="hand-point-left">&#xf0a5; hand-point-left
                                                            </option>
                                                            <option value="hand-point-right">&#xf0a4; hand-point-right
                                                            </option>
                                                            <option value="hand-point-up">&#xf0a6; hand-point-up
                                                            </option>
                                                            <option value="hand-pointer">&#xf25a; hand-pointer</option>
                                                            <option value="hand-rock">&#xf255; hand-rock </option>
                                                            <option value="hand-scissors">&#xf257; hand-scissors
                                                            </option>
                                                            <option value="hand-spock">&#xf259; hand-spock</option>
                                                            <option value="handshake">&#xf2b5; handshake</option>
                                                            <option value="hdd">&#xf0a0; hdd</option>
                                                            <option value="heart">&#xf004; heart</option>
                                                            <option value="home">&#xf015; home</option>
                                                            <option value="hospital">&#xf0f8; hospital</option>
                                                            <option value="hourglass">&#xf254; hourglass</option>
                                                            <option value="id-badge">&#xf2c1; id-badge</option>
                                                            <option value="id-card">&#xf2c2; id-card </option>
                                                            <option value="image">&#xf03e; image</option>
                                                            <option value="images">&#xf302; images</option>
                                                            <option value="keyboard">&#xf11c; keyboard</option>
                                                            <option value="kiss">&#xf596; kiss</option>
                                                            <option value="kiss-beam">&#xf597; kiss-beam</option>
                                                            <option value="kiss-wink-heart">&#xf598; kiss-wink-heart
                                                            </option>
                                                            <option value="laugh">&#xf599; laugh</option>
                                                            <option value="laugh-beam">&#xf59a; laugh-beam</option>
                                                            <option value="laugh-squint">&#xf59b; laugh-squint </option>
                                                            <option value="laugh-wink">&#xf59c; laugh-wink</option>
                                                            <option value="lemon">&#xf094; lemon</option>
                                                            <option value="life-ring">&#xf1cd; life-ring</option>
                                                            <option value="lightbulb">&#xf0eb; lightbulb</option>
                                                            <option value="list-alt">&#xf022; list-alt</option>
                                                            <option value="map">&#xf279; map</option>
                                                            <option value="meh">&#xf11a; meh</option>
                                                            <option value="meh-blank">&#xf5a4; meh-blank</option>
                                                            <option value="meh-rolling-eyes">&#xf5a5; meh-rolling-eyes
                                                            </option>
                                                            <option value="minus-square">&#xf146; minus-square</option>
                                                            <option value="money-bill-alt">&#xf3d1; money-bill-alt
                                                            </option>
                                                            <option value="moon">&#xf186; moon</option>
                                                            <option value="newspaper">&#xf1ea; newspaper</option>
                                                            <option value="object-group">&#xf247; object-group</option>
                                                            <option value="object-upgroup">&#xf248; object-upgroup
                                                            </option>
                                                            <option value="paper-plane">&#xf1d8; paper-plane</option>
                                                            <option value="pause-circle">&#xf28b; pause-circle</option>
                                                            <option value="play-circle">&#xf144; play-circle </option>
                                                            <option value="plus-square">&#xf0fe; plus-square</option>
                                                            <option value="question-circle">&#xf059; question-circle
                                                            </option>
                                                            <option value="registered">&#xf25d; registered</option>
                                                            <option value="sad-cry">&#xf5b3; sad-cry</option>
                                                            <option value="sad-tear">&#xf5b4; sad-tear</option>
                                                            <option value="save">&#xf0c7; save</option>
                                                            <option value="share-square">&#xf14d; share-square</option>
                                                            <option value="smile">&#xf118; smile</option>
                                                            <option value="smile-beam">&#xf5b8; smile-beam </option>
                                                            <option value="smile-wink">&#xf4da; smile-wink</option>
                                                            <option value="snowflake">&#xf2dc; snowflake</option>
                                                            <option value="square">&#xf0c8; square</option>
                                                            <option value="star">&#xf005; star</option>
                                                            <option value="star-half">&#xf089; star-half</option>
                                                            <option value="sticky-note">&#xf249; sticky-note</option>
                                                            <option value="stop-circle">&#xf28d; stop-circle</option>
                                                            <option value="sun">&#xf185; sun</option>
                                                            <option value="surprise">&#xf5c2; surprise </option>
                                                            <option value="thumbs-down">&#xf165; thumbs-down</option>
                                                            <option value="thumbs-up">&#xf1164; thumbs-up</option>
                                                            <option value="times-circle">&#xf057; times-circle</option>
                                                            <option value="tired">&#xf5c8; tired</option>
                                                            <option value="trash-alt">&#xf2ed; trash-alt</option>
                                                            <option value="user">&#xf007; user</option>
                                                            <option value="user-circle">&#xf2bd; user-circle</option>
                                                            <option value="window-close">&#xf410; window-close</option>
                                                            <option value="window-maximize">&#xf2d0; window-maximize
                                                            </option>
                                                            <option value="window-minimize">&#xf2d1; window-minimize
                                                            </option>
                                                            <option value="window-restore">&#xf2d2; window-restore
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Select Varient</label>
                                                        <select name="attribute[]" class="form-control chosen2"
                                                            multiple>
                                                            @foreach (\App\Models\Attribute::orderBy('id',
                                                            'desc')->get() as $attribute)
                                                            <option value="{{ $attribute->id }}">
                                                                {{ $attribute->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="checkbox" name="is_attribute"
                                                            class="form-control-check" id="is_attribute">
                                                        <label for="is_attribute">No attribute in category</label>
                                                    </div>

                                                    <div class="form-group" id="attribute_block">
                                                        <div class="varient_wrapper">
                                                            <div class="row varient-row">
                                                                <div class="col-xs-5 col-sm-5 col-md-5">
                                                                    <div class="form-group">
                                                                        <label>Attribute name* (required)</label>
                                                                        <select name="varients[]" class="form-control">
                                                                            @foreach (App\Models\Varient::orderBy('id',
                                                                            'desc')->get() as $varient)
                                                                            <option value="{{ $varient->id }}">
                                                                                {{ $varient->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Value* (required)</label>
                                                                        <input autocomplete="off" name="varient_value[]"
                                                                            type="text" placeholder="Ex. 1 Ton"
                                                                            class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-1 col-sm-1 col-md-1">
                                                                    <br>
                                                                    <button class="btn btn-primary add_varient"
                                                                        type="button">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Category Image ( Width: 800px, Height : 600px
                                                            ) </label> <br>
                                                        <img src="{{ asset('backend/images/thumbnail.png') }}"
                                                            id="image_preview_container" class="default-thhumbnail"
                                                            width="100px" alt="">
                                                        <br><br>
                                                        <input type="file" class="form-control-file" name="image"
                                                            id="image">
                                                    </div>
                                                    <div class="form-group" id="banner_block">
                                                        <div class="varient_wrapper">
                                                            <div class="row varient-row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Category Banner ( Width: 1150px, Height :
                                                                            400px )</label> <br>
                                                                        <input type="file" class="form-control-file image"
                                                                            name="banner_image[0]" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Position</label>
                                                                        <input type="number" class="form-control" name="banner_position[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Button</label>
                                                                        <input type="text" class="form-control" name="banner_button[]">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <br>
                                                                    <button class="btn btn-primary add_banner"
                                                                        type="button">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-outline-dark">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-dark"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget11_tab1_content">
                            <!--begin::Widget 11-->
                            <div class="kt-widget11">
                                <div class="table-responsive">
                                    <table class="table category-datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Banner Image</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!--end::Widget 11-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Application Sales-->
        </div>
    </div>
    <!-- title row end -->

</div>
<!-- end:: Content -->
@endsection

@section('per_page_js')

<script>
    $("#is_attribute").click(function (e) {
        if (e.target.checked == true) {
            $("#attribute_block").hide();
        } else {
            $("#attribute_block").css({
                "display": "block"
            });
        }
    })

    $(".chosen").chosen()
    $("#chosen").chosen()
    $(".chosen2").chosen()
    $("#chosen2").chosen()
    $(".chosen3").chosen()

</script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(function () {
        $('.category-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('category.data') }}",
            columns: [{
                    data: 'position',
                    name: 'position'
                },
                {
                    data: 'banner_image',
                    name: 'banner_image'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'cat_name',
                    name: 'cat_name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },
            ]
        });
    });



    $('#image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

    $('#image2').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

    $('#image3').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container3').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

    $(".varient-row").on('change','.image', function(){
        

            let reader = new FileReader();
            reader.onload = (e) => {
            $('.image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        
    })

    

    $(".add_varient").click(function () {
        let varient = `<div class="row varient-row">
                                  <div class="col-xs-5 col-sm-5 col-md-5">
                                        <div class="form-group">
                                              <label>Attribute name*</label>
                                              <select name="varients[]" class="form-control" >
                                                    @foreach (App\Models\Varient::orderBy('id', 'desc')->get() as $varient)
                                                    <option value="{{ $varient->id }}">{{ $varient->name }}</option>
                                                    @endforeach
                                              </select>  
                                        </div>
                                  </div>
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                              <label>Value*</label>
                                              <input autocomplete="off" name="varient_value[]" type="text" placeholder="Ex. 1 Ton" class="form-control "/>
                                        </div>
                                  </div> 
                                  <div class="col-xs-1 col-sm-1 col-md-1">
                                  <br>
                                  <a href="javascript:void(0);" class="remove_varient_button btn btn-danger">-</a>
                                  </div>
                            </div>`;
        $("#attribute_block .varient_wrapper").append(varient)
    })

    //Once remove button is clicked
    $('#attribute_block .varient_wrapper').on('click', '.remove_varient_button', function () {
        $(this).closest('div.row.varient-row').remove();
    });

    $(".add_banner").click(function () {
        let varient =       `<div class="row varient-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category Banner ( Width: 1150px, Height :
                                            300px )</label> <br>
                                        <input type="file" class="form-control-file image"
                                            name="banner_image[0]" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <input type="number" class="form-control" name="banner_position[]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Button</label>
                                        <input type="text" class="form-control" name="banner_button[]">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <a href="javascript:void(0);" class="remove_banner_button btn btn-danger">-</a>
                                </div>
                            </div>`;
        $("#banner_block .varient_wrapper").append(varient)
    })

    //Once remove button is clicked
    $('#banner_block .varient_wrapper').on('click', '.remove_banner_button', function () {
        $(this).closest('div.row.varient-row').remove();
    });

</script>
@endsection
