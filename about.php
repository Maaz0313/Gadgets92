<?php
$title = "About Us";
session_start();
require('dbcon.php');
require('inc/header.php');
?>

<style>
    body {
        background-color: #e7e7e7;
    }

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        height: 100%;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        color: #007bff;
        display: flex;
        align-items: center;
    }

    .card-text {
        font-size: 1rem;
        display: flex;
        align-items: center;
    }

    .service-icon {
        font-size: 2rem;
        margin-right: 10px;
        color: #6c757d;
    }
</style>

<div class="container py-5">
    <h1 class="display-6">About Gadgets92</h1>
    <p class="lead mb-4">Your one-stop shop for all things tech!</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-mobile-alt service-icon"></i> Mobile Specs</h5>
                    <p class="card-text">Explore detailed specifications of the latest mobile devices.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-laptop service-icon"></i> Laptop Specs</h5>
                    <p class="card-text">Get insights into the features and performance of laptops.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tv service-icon"></i> TV Specs</h5>
                    <p class="card-text">Discover specifications of televisions for an immersive viewing experience.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <svg class="service-icon" fill="#6c757d" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px"
                            viewBox="0 0 85.2 122.88" style="height:2rem;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill-rule: evenodd;
                                    clip-rule: evenodd;
                                }
                            </style>
                            <g>
                                <path class="st0"
                                    d="M79.88,52.56c2.97,0.27,5.31,2.78,5.31,5.81v7.14c0,3.03-2.35,5.54-5.31,5.81v14.37 c0,4.54-1.86,8.67-4.85,11.67c-2.99,2.99-7.12,4.85-11.67,4.85h-1.51H17.69h-1.18c-4.54,0-8.67-1.86-11.67-4.85 C1.86,94.36,0,90.23,0,85.69v-47.5c0-4.54,1.86-8.67,4.85-11.67c2.99-2.99,7.12-4.85,11.67-4.85h1.18V4.12 c0-2.27,1.85-4.12,4.12-4.12h35.92c2.27,0,4.12,1.86,4.12,4.12v17.55h1.51c4.54,0,8.67,1.86,11.67,4.85 c2.99,2.99,4.85,7.12,4.85,11.67V52.56L79.88,52.56z M21.26,40.8h6.46c1.1,0,2,0.9,2,2v6.55c0,1.1-0.9,2-2,2h-6.46 c-1.1,0-2-0.9-2-2V42.8C19.25,41.7,20.15,40.8,21.26,40.8L21.26,40.8z M52.58,72.07h6.46c1.1,0,2,0.9,2,2v6.55c0,1.1-0.9,2-2,2 h-6.46c-1.1,0-2-0.9-2-2v-6.55C50.57,72.97,51.48,72.07,52.58,72.07L52.58,72.07z M36.92,72.07h6.46c1.1,0,2,0.9,2,2v6.55 c0,1.1-0.9,2-2,2h-6.46c-1.1,0-2-0.9-2-2v-6.55C34.91,72.97,35.81,72.07,36.92,72.07L36.92,72.07z M21.26,72.07h6.46 c1.1,0,2,0.9,2,2v6.55c0,1.1-0.9,2-2,2h-6.46c-1.1,0-2-0.9-2-2v-6.55C19.25,72.97,20.15,72.07,21.26,72.07L21.26,72.07z M52.58,56.44h6.46c1.1,0,2,0.9,2,2v6.55c0,1.1-0.9,2-2,2h-6.46c-1.1,0-2-0.9-2-2v-6.55C50.57,57.34,51.48,56.44,52.58,56.44 L52.58,56.44z M36.92,56.44h6.46c1.1,0,2,0.9,2,2v6.55c0,1.1-0.9,2-2,2h-6.46c-1.1,0-2-0.9-2-2v-6.55 C34.91,57.34,35.81,56.44,36.92,56.44L36.92,56.44z M21.26,56.44h6.46c1.1,0,2,0.9,2,2v6.55c0,1.1-0.9,2-2,2h-6.46 c-1.1,0-2-0.9-2-2v-6.55C19.25,57.34,20.15,56.44,21.26,56.44L21.26,56.44z M52.58,40.8h6.46c1.1,0,2,0.9,2,2v6.55c0,1.1-0.9,2-2,2 h-6.46c-1.1,0-2-0.9-2-2V42.8C50.57,41.7,51.48,40.8,52.58,40.8L52.58,40.8z M36.92,40.8h6.46c1.1,0,2,0.9,2,2v6.55 c0,1.1-0.9,2-2,2h-6.46c-1.1,0-2-0.9-2-2V42.8C34.91,41.7,35.81,40.8,36.92,40.8L36.92,40.8z M21.94,32.53h36 c6.14,0,11.16,5.02,11.16,11.16v36.5c0,6.14-5.02,11.16-11.16,11.16h-36c-6.14,0-11.16-5.02-11.16-11.16v-36.5 C10.78,37.55,15.8,32.53,21.94,32.53L21.94,32.53z M63.37,25.65H16.52c-3.44,0-6.58,1.41-8.85,3.68c-2.27,2.27-3.68,5.41-3.68,8.85 v47.5c0,3.44,1.41,6.58,3.68,8.85c2.27,2.27,5.41,3.68,8.85,3.68h46.85c3.44,0,6.58-1.41,8.85-3.68c2.27-2.27,3.68-5.41,3.68-8.85 v-47.5c0-3.44-1.41-6.58-3.68-8.85C69.94,27.07,66.81,25.65,63.37,25.65L63.37,25.65z M61.86,102.2v16.56 c0,2.27-1.86,4.12-4.12,4.12H21.82c-2.27,0-4.12-1.85-4.12-4.12V102.2H61.86L61.86,102.2z" />
                            </g>
                        </svg>
                        Smartwatch Specs
                    </h5>
                    <p class="card-text">Stay informed about smartwatches and their features.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-headphones service-icon"></i> Headset Specs</h5>
                    <p class="card-text">Explore specifications of headsets for an enhanced audio experience.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-md-0 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-balance-scale service-icon"></i> Device Comparison</h5>
                    <p class="card-text">Compare different devices side by side to make informed decisions.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-star service-icon"></i> Write Ratings & Reviews</h5>
                    <p class="card-text">Share your experiences with gadgets by writing reviews and ratings on our
                        platform.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('inc/footer.php');
?>