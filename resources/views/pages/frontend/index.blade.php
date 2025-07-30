@extends('layouts.frontend')

@section('content')
    <!-- START: HERO -->
    <section class="flex items-center hero">
      <div
        class="w-full absolute z-20 inset-0 md:relative md:w-1/2 text-center flex flex-col justify-center hero-caption"
      >
      <h1 class="text-3xl md:text-5xl leading-tight font-semibold">
        Product Herbal <br class="" />Alami & Terpercaya
      </h1>
      <h2 class="px-8 text-base md:px-0 md:text-lg my-6 tracking-wide">
        Menyediakan solusi kesehatan herbal <br class="hidden lg:block" />alami dan terpercaya untuk Anda & keluarga
      </h2>
        <div>
          <a
            href="#browse-the-room"
            class="bg-pink-400 text-black hover:bg-black hover:text-pink-400 rounded-full px-8 py-3 mt-4 inline-block flex-none transition duration-200"
            >Explore Now</a
          >
        </div>
      </div>
      <div class="w-full inset-0 md:relative md:w-1/2">
        <div class="relative hero-image">
          <div class="overlay inset-0 bg-black opacity-35 z-10"></div>
          <div class="overlay right-0 bottom-0 md:inset-0">
            {{-- <button
              class="video hero-cta focus:outline-none z-30 modal-trigger" data-content= <div class="w-screen pb-56 md:w-88 md:pb-56 relative z-50">
              <div class="absolute w-full h-full">
                <iframe
                  width="100%"
                  height="100%"
                  src="https://www.youtube.com/embed/3h0_v1cdUIA"
                  frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </div>
            </div>
            </button> --}}
          </div>
          <img
            src="{{'/frontend/images/content/image-section.jpg'}}"
            alt="hero 1"
            class="absolute inset-0 md:relative w-full h-full object-cover object-center"
          />
        </div>
      </div>
    </section>
    <!-- END: HERO -->

    <!-- START: BROWSE THE ROOM -->
    <section class="flex bg-gray-100 py-16 px-4" id="browse-the-room">
      <div class="container mx-auto">
        <div class="flex flex-start mb-4">
          <h3 class="text-2xl capitalize font-semibold">
            Jelajahi Produk <br />Product Herbal untuk Kesehatan Anda
          </h3>
        </div>
        <div class="grid grid-rows-2 grid-cols-9 gap-4">
          <div
            class="relative col-span-9 row-span-1 md:col-span-4 card"
            style="height: 180px"
          >
            <div class="card-shadow rounded-xl">
              <img
                src="{{'/frontend/images/content/catalog-1.jpg'}}"
                alt=""
                class="w-full h-full object-cover object-center overlay overflow-hidden rounded-xl"
              />
            </div>
            <div
              class="overlay left-0 top-0 bottom-0 flex justify-center flex-col pl-48 md:pl-72"
            >
              {{-- <h5 class="text-lg font-semibold">Living Room</h5>
              <span class="">18.309 items</span> --}}
            </div>
            <a href="#" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
          <div
            class="relative col-span-9 row-span-1 md:col-span-2 md:row-span-2 card"
          >
            <div class="card-shadow rounded-xl">
              <img
                src="{{'/frontend/images/content/catalog-2.jpg'}}"
                alt=""
                class="w-full h-full object-cover object-center overlay overflow-hidden rounded-xl"
              />
            </div>
            <div
              class="overlay right-0 left-0 top-0 bottom-0 md:bottom-auto flex justify-center md:items-center flex-col pl-48 md:pl-0 pt-0 md:pt-12"
            >
              {{-- <h5 class="text-lg font-semibold">Decoration</h5>
              <span class="">77.392 items</span> --}}
            </div>
            <a href="#" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
          <div
            class="relative col-span-9 row-span-1 md:col-span-3 md:row-span-2 card"
          >
            <div class="card-shadow rounded-xl">
              <img
                src="{{'/frontend/images/content/catalog-3.jpg'}}"
                alt=""
                class="w-full h-full object-cover object-center overlay overflow-hidden rounded-xl"
              />
            </div>
            <div
              class="overlay right-0 left-0 top-0 bottom-0 md:bottom-auto flex justify-center md:items-center flex-col pl-48 md:pl-0 pt-0 md:pt-12"
            >
              {{-- <h5 class="text-lg font-semibold">Living Room</h5>
              <span class="">22.094 items</span> --}}
            </div>
            <a href="#" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
          <div class="relative col-span-9 row-span-1 md:col-span-4 card">
            <div class="card-shadow rounded-xl">
              <img
                src="{{'/frontend/images/content/catalog-4.jpg'}}"
                alt=""
                class="w-full h-full object-cover object-center overlay overflow-hidden rounded-xl"
              />
            </div>
            <div
              class="overlay left-0 top-0 bottom-0 flex justify-center flex-col pl-48 md:pl-72"
            >
              {{-- <h5 class="text-lg font-semibold">Children Room</h5>
              <span class="">837 items</span> --}}
            </div>
            <a href="#" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- END: BROWSE THE ROOM -->

    <!-- START: JUST ARRIVED -->
    <section class="flex flex-col py-16">
      <div class="container mx-auto mb-4">
        <div class="flex justify-center text-center mb-4">
          <h3 class="text-2xl capitalize font-semibold">
            Produk <br class="" />Kami
          </h3>
        </div>
      </div>
      <div class="overflow-x-hidden px-4" id="carousel">
        <div class="container mx-auto"></div>
        <!-- <div class="overflow-hidden z-10"> -->
        <div class="flex -mx-4 flex-row relative">
          <!-- START: JUST ARRIVED ROW 1 -->
          @foreach ($products as $product)
          <div class="px-4 relative card group">
            <div
              class="rounded-xl overflow-hidden card-shadow relative"
              style="width: 287px; height: 386px"
            >
              <div
                class="absolute opacity-0 group-hover:opacity-100 transition duration-200 flex items-center justify-center w-full h-full bg-black bg-opacity-35"
              >
                <div
                  class="bg-white text-black rounded-full w-16 h-16 flex items-center justify-center"
                >
                  <svg
                    class="fill-current"
                    width="43"
                    height="24"
                    viewBox="0 0 43 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M41.6557 10.0065C39.2794 6.95958 36.2012 4.43931 32.7542 2.71834C29.2355 0.961548 25.4501 0.0500333 21.4985 0.00223289C21.3896 -0.000744296 20.9526 -0.000744296 20.8438 0.00223289C16.8923 0.050116 13.1068 0.961548 9.58807 2.71834C6.14106 4.43931 3.06307 6.9595 0.686613 10.0065C-0.228871 11.1802 -0.228871 12.8198 0.686613 13.9935C3.06299 17.0404 6.14106 19.5607 9.58807 21.2817C13.1068 23.0385 16.8922 23.95 20.8438 23.9978C20.9526 24.0007 21.3896 24.0007 21.4985 23.9978C25.45 23.9499 29.2355 23.0385 32.7542 21.2817C36.2012 19.5607 39.2793 17.0405 41.6557 13.9935C42.5712 12.8196 42.5712 11.1802 41.6557 10.0065ZM10.3576 19.7406C7.13892 18.1335 4.26445 15.7799 2.04487 12.9341C1.61591 12.3841 1.61591 11.6159 2.04487 11.0659C4.26436 8.22009 7.13883 5.86646 10.3576 4.25944C11.2717 3.80311 12.2053 3.40846 13.1561 3.07436C10.71 5.27317 9.16886 8.45975 9.16886 12C9.16886 15.5403 10.7101 18.7272 13.1564 20.9259C12.2056 20.5918 11.2718 20.197 10.3576 19.7406ZM21.1712 22.2798C15.5028 22.2798 10.8913 17.6683 10.8913 11.9999C10.8913 6.33148 15.5028 1.72007 21.1712 1.72007C26.8396 1.72007 31.4511 6.33156 31.4511 12C31.4511 17.6684 26.8396 22.2798 21.1712 22.2798ZM40.2976 12.9341C38.0781 15.7798 35.2036 18.1335 31.9849 19.7405C31.0718 20.1963 30.1388 20.5892 29.1892 20.923C31.6336 18.7243 33.1736 15.5387 33.1736 11.9999C33.1736 8.45918 31.6321 5.27218 29.1856 3.07336C30.1366 3.40755 31.0705 3.80269 31.9849 4.25928C35.2036 5.86629 38.0781 8.21993 40.2976 11.0657C40.7265 11.6158 40.7265 12.384 40.2976 12.9341Z"
                    />
                    <path
                      d="M21.1712 7.60071C18.7454 7.60071 16.772 9.57417 16.772 11.9999C16.772 14.4257 18.7454 16.3991 21.1712 16.3991C23.5969 16.3991 25.5704 14.4257 25.5704 11.9999C25.5705 9.57417 23.597 7.60071 21.1712 7.60071ZM21.1712 14.6767C19.6952 14.6767 18.4944 13.476 18.4944 11.9999C18.4944 10.5239 19.6951 9.32318 21.1712 9.32318C22.6471 9.32318 23.8479 10.5239 23.8479 11.9999C23.848 13.476 22.6471 14.6767 21.1712 14.6767Z"
                    />
                  </svg>
                </div>
              </div>
              <img
                src="{{ $product->galleries()->exists() ? Storage::url($product->galleries->first()->url) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}"
                alt=""
                class="w-full h-full object-cover object-center"
              />
            </div>
            <h5 class="text-lg font-semibold mt-4">{{ $product->name }}</h5>
            <span class="">IDR {{ number_format($product->price) }}</span>
            <a href="{{ route('details', $product->slug) }}" class="stretched-link">
              <!-- fake children -->
            </a>
          </div>
              
          @endforeach
          <!-- END: JUST ARRIVED ROW 1 -->
        </div>
        <!-- </div> -->
      </div>
    </section>
    <!-- END: JUST ARRIVED -->

    <!-- START: CLIENTS -->
    {{-- <section class="container mx-auto">
      <div class="flex justify-center flex-wrap">
        <div
          class="w-full flex-auto md:w-auto md:flex-initial px-4 md:px-6 my-4 md:my-0"
        >
          <img src="/frontend/images/content/logo-adobe.svg" alt="" class="mx-auto" />
        </div>
        <div
          class="w-full flex-auto md:w-auto md:flex-initial px-4 md:px-6 my-4 md:my-0"
        >
          <img src="/frontend/images/content/logo-ikea.svg" alt="" class="mx-auto" />
        </div>
        <div
          class="w-full flex-auto md:w-auto md:flex-initial px-4 md:px-6 my-4 md:my-0"
        >
          <img
            src="{{'/frontend/images/content/logo-hermanmiller.svg'}}"
            alt=""
            class="mx-auto"
          />
        </div>
        <div
          class="w-full flex-auto md:w-auto md:flex-initial px-4 md:px-6 my-4 md:my-0"
        >
          <img src="{{'/frontend/images/content/logo-miele.svg'}}" alt="" class="mx-auto" />
        </div>
      </div>
    </section> --}}
    <!-- END: CLIENTS -->

    <!-- START: WhatsApp Floating Button -->
    <div style="position: fixed; bottom: 24px; right: 24px; z-index: 9999;">
      <a 
        href="https://wa.me/6281312931133?text=Halo,%20saya%20tertarik%20dengan%20produk%20herbal%20Anda" 
        target="_blank"
        style="
          display: flex;
          align-items: center;
          justify-content: center;
          width: 60px;
          height: 60px;
          background-color: #25D366;
          color: white;
          border-radius: 50%;
          text-decoration: none;
          box-shadow: 0 4px 12px rgba(0,0,0,0.3);
          transition: all 0.3s ease;
          animation: pulse 2s infinite;
        "
        title="Chat dengan Customer Service"
        onmouseover="this.style.backgroundColor='#128C7E'; this.style.transform='scale(1.1)'"
        onmouseout="this.style.backgroundColor='#25D366'; this.style.transform='scale(1)'"
      >
        <svg 
          width="32" 
          height="32" 
          viewBox="0 0 24 24" 
          fill="currentColor"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.464 3.488"/>
        </svg>
      </a>
    </div>

    <style>
      @keyframes pulse {
        0% {
          box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
        }
        70% {
          box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
        }
        100% {
          box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
        }
      }
    </style>
    <!-- END: WhatsApp Floating Button -->
@endsection