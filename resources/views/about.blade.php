@extends('layouts.frontend')
@section('content')
<!-- breadcrumb__start -->
<div class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb__title">
                    <h1>About Us</h1>
                    <ul>
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="color__blue">
                            About Us
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb__end -->

<!-- about__section__start -->
<div class="about sp_top_80 sp_bottom_80">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                <div class="about__text">
                    <h2><span class="primary__color">Karya Unyil</span> Merchandiser</h2>
                    <p>
                        Karya Unyil Merchandiser hadir untuk kamu yang ingin punya merchandise 
                        unik, custom, dan penuh makna. Kami percaya setiap orang punya cerita, 
                        dan cerita itu bisa dituangkan lewat produk yang kamu gunakan sehari-hari.
                    </p>
                    <p>
                        Mulai dari mug, kaos, totebag, hingga gantungan kunci — semua bisa kamu 
                        desain sesuai keinginan. Dengan bahan berkualitas dan harga ramah, kami 
                        siap membantu mewujudkan ide kreatifmu menjadi nyata.
                    </p>
                    <ul class="mt-3">
                        <li>✔ Custom desain sesuai keinginan</li>
                        <li>✔ Bisa order satuan maupun partai besar</li>
                        <li>✔ Cocok untuk hadiah, komunitas, dan event</li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-12">
                <div class="about__img text-center">
                    <img src="{{ asset('assets/frontend/img/about/karyaunyillogo.jpg') }}" alt="Tentang Kami">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about__section__end -->

<!-- video__banner__section -->
<div class="video sp_bottom_80">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="video__img">
                    <img src="{{ asset('assets/frontend/img/about/video-banner__1.jpg') }}" alt="Video Banner">
                    <div class="video__icon">
                        <a class="video-btn" href="https://www.youtube.com/watch?v=JQpk-DoMn3I"> 
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <h3>Lihat proses kreatif kami</h3>
                    <p>Kenali bagaimana ide-ide custom kamu bisa diwujudkan bersama Karya Unyil.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- video__banner__section -->

<!-- testimonial__section__start -->
<div class="testimonial sp_bottom_80">
    <div class="container testimonial__color testimonial__color__5">
        <div
            class="row testimonial__slider__active slider__default__arrow slider__default__dot slider__default__dot--2">
            
            <div class="col-xl-12">
                <div class="testimonial__inner testimonial__padding text-center">
                    <div class="testimonial__img">
                        <i class="fa fa-quote-right"></i>
                    </div>
                    <div class="testimonial__info">
                        <p>
                            "Pesanan mug custom saya hasilnya bagus banget! Warnanya cerah dan tahan lama. 
                            Temen-temen pada suka."
                        </p>
                        <h4>Sinta – Mahasiswi</h4>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="testimonial__inner testimonial__padding text-center">
                    <div class="testimonial__img">
                        <i class="fa fa-quote-right"></i>
                    </div>
                    <div class="testimonial__info">
                        <p>
                            "Kaos custom untuk komunitas kami jadi lebih keren. Bahannya adem, 
                            desainnya sesuai banget sama request!"
                        </p>
                        <h4>Andi – Ketua Komunitas</h4>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="testimonial__inner testimonial__padding text-center">
                    <div class="testimonial__img">
                        <i class="fa fa-quote-right"></i>
                    </div>
                    <div class="testimonial__info">
                        <p>
                            "Pelayanan ramah, respon cepat, dan bisa custom desain sesuai keinginan. 
                            Recommended banget buat hadiah unik!"
                        </p>
                        <h4>Dewi – Customer</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- testimonial__section__end -->
@endsection
