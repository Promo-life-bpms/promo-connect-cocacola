@extends('layouts.cotizador')

@section('content')
   {{--  <div style="margin-top: -65px;">
        <embed src="{{asset('img/HHGGLOBALPRESENTATION.pdf')}}" width="100%" height="1000px" />

    </div> --}}


    <style>
        
        .swiper {
          width: 100%;
          max-height: 700px;
        }
    
        .swiper-slide {
          text-align: center;
          font-size: 18px;
          background: #fff;
          display: flex;
          justify-content: center;
          align-items: center;
        }
    
        .swiper-slide img {
          display: block;
          width: 100%;
          max-height: 700px;
          object-fit: cover;
        }

        .swiper-pagination {
            display: none;
       
        }

        @media (max-width: 768px) {
            .swiper {
                max-height: 340px; 
            }
        }

        @media (max-width: 480px) {
            .swiper {
                max-height: 200px; 
            }
        }

      </style>

    <div class="swiper mySwiper mb-2">
        <div class="swiper-wrapper">
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-01.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-02.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-03.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-04.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-05.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-06.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-07.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-08.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-09.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-10.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-11.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-12.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-13.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-14.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-15.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-16.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-17.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-18.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-19.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-20.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-17.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-18.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-19.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-20.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-21.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-22.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-23.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-23.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-24.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-25.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-26.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-27.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-28.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-29.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-30.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-31.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-32.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-33.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-34.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-35.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-36.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-37.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-38.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-39.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-40.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-41.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-42.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-43.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-44.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-45.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-46.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-47.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-48.png') }}" alt="menu" style="object-fit: fit"></div>
          <div class="swiper-slide"><img src="{{asset('img/HHGGLOBALPRESENTATION-49.png') }}" alt="menu" style="object-fit: fit"></div>
        </div>
        <div class="swiper-pagination"></div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
          direction: "vertical",
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
        });
      </script>
@endsection
