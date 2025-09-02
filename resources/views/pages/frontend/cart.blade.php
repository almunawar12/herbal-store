@extends('layouts.frontend')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
      <div class="container mx-auto">
        <ul class="breadcrumb">
          <li>
            <a href="{{ route('index') }}">Home</a>
          </li>
          <li>
            <a href="#" aria-label="current-page">Shopping Cart</a>
          </li>
        </ul>
      </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: COMPLETE YOUR ROOM -->
    <section class="md:py-16">
      <div class="container mx-auto px-4">
        <div class="flex -mx-4 flex-wrap">
          <div class="w-full px-4 mb-4 md:w-8/12 md:mb-0" id="shopping-cart">
            <div
              class="flex flex-start mb-4 mt-8 pb-3 border-b border-gray-200 md:border-b-0"
            >
              <h3 class="text-2xl">Shopping Cart</h3>
            </div>

            <div class="border-b border-gray-200 mb-4 hidden md:block">
              <div class="flex flex-start items-center pb-2 -mx-4">
                <div class="px-4 flex-none">
                  <div class="" style="width: 90px">
                    <h6>Photo</h6>
                  </div>
                </div>
                <div class="px-4 w-5/12">
                  <div class="">
                    <h6>Product</h6>
                  </div>
                </div>
                <div class="px-4 w-5/12">
                  <div class="">
                    <h6>Price</h6>
                  </div>
                </div>
                <div class="px-4 w-2/12">
                  <div class="text-center">
                    <h6>Action</h6>
                  </div>
                </div>
              </div>
            </div>

            <!-- START: ROW 1 -->
            @forelse ($carts as $item)
               <div
                  class="flex flex-start flex-wrap items-center mb-4 -mx-4"
                  data-row="1"
                >
                  <div class="px-4 flex-none">
                    <div class="" style="width: 90px; height: 90px">
                      <img
                        src="{{ $item->product->galleries()->exists() ? Storage::url($item->product->galleries->first()->url) : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN88B8AAsUB4ZtvXtIAAAAASUVORK5CYII=' }}"
                        alt="chair-1"
                        class="object-cover rounded-xl w-full h-full"
                      />
                    </div>
                  </div>
                  <div class="px-4 w-auto flex-1 md:w-5/12">
                    <div class="">
                      <h6 class="font-semibold text-lg md:text-xl leading-8">
                        {{ $item->product->name }}
                      </h6>
                      <span class="text-sm md:text-lg">Product</span>
                      <h6
                        class="font-semibold text-base md:text-lg block md:hidden"
                      >
                        IDR {{ number_format($item->product->price) }}
                      </h6>
                      <div class="flex items-center mt-2">
                        <button type="button" class="qty-btn bg-gray-200 px-2 rounded-l" data-action="decrement">-</button>
                          <input type="number" name="qty[]" min="1" value="{{ $item->qty ?? 1 }}" class="qty-input w-12 text-center border border-gray-300 bg-gray-50 cursor-not-allowed" data-cart-id="{{ $item->id }}" data-price="{{ $item->product->price }}" readonly />
                        <button type="button" class="qty-btn bg-gray-200 px-2 rounded-r" data-action="increment">+</button>
                        <input type="hidden" name="cart_id[]" value="{{ $item->id }}" />
                        </div>
                        <div class="mt-2 text-sm text-gray-700">
                          Total: <span class="product-total" id="product-total-{{ $item->id }}">IDR {{ number_format(($item->qty ?? 1) * $item->product->price) }}</span>
                      </div>
                    </div>
                  </div>
                  <div
                    class="px-4 w-auto flex-none md:flex-1 md:w-5/12 hidden md:block"
                  >
                    <div class="">
                      <h6 class="font-semibold text-lg">IDR {{ number_format($item->product->price) }}</h6>
                    </div>
                  </div>
                  <div class="px-4 w-2/12">
                    <div class="text-center">
                      <form action="{{ route('cart-delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 border-none focus:outline-none px-3 py-1">
                          X
                        </button>
                      </form>
                    </div>
                  </div>
                </div> 
            @empty
              <p id="cart-empty" class="text-center py-8">
                Ooops... Cart is empty
                <a href="{{ route('index') }}" class="underline">Shop Now</a>
              </p>
            @endforelse
              <div class="flex justify-end mt-6">
                <div class="bg-gray-100 rounded-xl p-4 w-full md:w-1/2 text-right">
                  <span class="font-semibold">Total: </span>
                  <span class="text-xl font-bold" id="cart-grand-total">IDR 0</span>
                </div>
              </div>
            
            <!-- END: ROW 1 -->

          </div>
          <div class="w-full md:px-4 md:w-4/12" id="shipping-detail">
            <div class="bg-gray-100 px-4 py-6 md:p-8 md:rounded-3xl">
              <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <!-- Hidden input untuk qty dan cart_id akan diisi otomatis oleh JS saat submit -->
                <div class="flex flex-start mb-6">
                  <h3 class="text-2xl">Shipping Details</h3>
                </div>

                <div class="flex flex-col mb-4">
                  <label for="complete-name" class="text-sm mb-2"
                    >Complete Name
                    {{-- @if(Auth::check())
                    @endif --}}
                  </label>
                  <input
                    data-input
                    name="name"
                    type="text"
                    id="complete-name"
                    class="border-gray-200 border rounded-lg px-4 py-2 text-sm focus:border-blue-200 focus:outline-none {{ Auth::check() ? 'bg-gray-50 cursor-not-allowed' : 'bg-white' }}"
                    placeholder="Input your name"
                    value="{{ Auth::check() ? Auth::user()->name : '' }}"
                    {{ Auth::check() ? 'readonly' : '' }}
                  />
                </div>

                <div class="flex flex-col mb-4">
                  <label for="email" class="text-sm mb-2">Email Address
                    {{-- @if(Auth::check())
                      <span class="text-green-600 text-xs">(Auto-filled from your account)</span>
                    @endif --}}
                  </label>
                  <input
                    data-input
                    name="email"
                    type="email"
                    id="email"
                    class="border-gray-200 border rounded-lg px-4 py-2 text-sm focus:border-blue-200 focus:outline-none {{ Auth::check() ? 'bg-gray-50 cursor-not-allowed' : 'bg-white' }}"
                    placeholder="Input your email address"
                    value="{{ Auth::check() ? Auth::user()->email : '' }}"
                    {{ Auth::check() ? 'readonly' : '' }}
                  />
                </div>

                <div class="flex flex-col mb-4">
                  <label for="address" class="text-sm mb-2">Address</label>
                  @error('address')
                    <span class="text-red-500 text-xs font-semibold mb-1">{{ $message }}</span>
                  @enderror
                  <input
                    data-input
                    type="text"
                    name="address"
                    id="address"
                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                    placeholder="Input your address"
                  />
                </div>

                <div class="flex flex-col mb-4">
                  <label for="phone-number" class="text-sm mb-2"
                    >Phone Number</label
                  >
                  <input
                    data-input
                    type="tel"
                    name="phone"
                    id="phone-number"
                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                    placeholder="Input your phone number"
                  />
                </div>

                <div class="flex flex-col mb-4">
                  <label for="complete-name" class="text-sm mb-2"
                    >Choose Courier</label
                  >
                  <div class="flex -mx-2 flex-wrap">
                    <div class="px-2 w-6/12 h-24 mb-4">
                      <button
                        type="button"
                        data-value="j&t"
                        data-name="courier"
                        class="border border-gray-200 focus:border-red-200 flex items-center justify-center rounded-xl bg-white w-full h-full focus:outline-none"
                      >
                        <img
                          src="/frontend/images/content/jnt.png"
                          alt="Logo J&T"
                          class="object-contain max-h-full"
                        />
                      </button>
                    </div>
                    <div class="px-2 w-6/12 h-24 mb-4">
                      <button
                        type="button"
                        data-value="jne"
                        data-name="courier"
                        class="border border-gray-200 focus:border-red-200 flex items-center justify-center rounded-xl bg-white w-full h-full focus:outline-none"
                      >
                        <img
                          src="/frontend/images/content/jne.png"
                          alt="Logo JNE"
                          class="object-contain max-h-full"
                        />
                      </button>
                    </div>
                  </div>
                </div>

                <div class="flex flex-col mb-4">
                  <label for="complete-name" class="text-sm mb-2"
                    >Choose Payment</label
                  >
                  <div class="flex -mx-2 flex-wrap">
                    <div class="px-2 w-6/12 h-24 mb-4">
                      <button
                        type="button"
                        data-value="midtrans"
                        data-name="payment"
                        class="border border-gray-200 focus:border-red-200 flex items-center justify-center rounded-xl bg-white w-full h-full focus:outline-none"
                      >
                        <img
                          src="/frontend/images/content/logo-midtrans.png"
                          alt="Logo midtrans"
                          class="object-contain max-h-full"
                        />
                      </button>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button
                    type="submit"
                    id="checkout-btn"
                    class="bg-pink-400 text-black hover:bg-black hover:text-pink-400 focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-6 disabled:opacity-50 disabled:cursor-not-allowed"
                  >
                    Checkout Now
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Qty plus minus logic
          document.querySelectorAll('.qty-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
              const input = this.parentElement.querySelector('.qty-input');
              let value = parseInt(input.value);
              if (this.dataset.action === 'increment') {
                value++;
              } else if (this.dataset.action === 'decrement' && value > 1) {
                value--;
              }
              input.value = value;
              updateProductTotal(input);
              updateGrandTotal();
            });
          });

          // Update total per product
          function updateProductTotal(input) {
            const price = parseInt(input.dataset.price);
            const qty = parseInt(input.value);
            const total = price * qty;
            const id = input.dataset.cartId;
            const totalEl = document.getElementById('product-total-' + id);
            if (totalEl) {
              totalEl.textContent = 'IDR ' + total.toLocaleString('id-ID');
            }
          }

          // Update grand total
          function updateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll('.qty-input').forEach(function(input) {
              const price = parseInt(input.dataset.price);
              const qty = parseInt(input.value);
              grandTotal += price * qty;
            });
            document.getElementById('cart-grand-total').textContent = 'IDR ' + grandTotal.toLocaleString('id-ID');
          }

          // Inisialisasi total saat load
          document.querySelectorAll('.qty-input').forEach(function(input) {
            updateProductTotal(input);
          });
          updateGrandTotal();

          // Saat submit checkout, pastikan qty dan cart_id ikut terkirim
          const checkoutForm = document.querySelector('form[action="{{ route('checkout') }}"]');
          checkoutForm.addEventListener('submit', function(e) {
            // Hapus input qty/cart_id lama jika ada
            checkoutForm.querySelectorAll('input[name="qty[]"], input[name="cart_id[]"]').forEach(el => el.remove());
            // Ambil semua qty input di cart
            document.querySelectorAll('.qty-input').forEach(function(input) {
              const qty = input.value;
              const cartId = input.dataset.cartId;
              // Buat input hidden baru
              const qtyInput = document.createElement('input');
              qtyInput.type = 'hidden';
              qtyInput.name = 'qty[]';
              qtyInput.value = qty;
              checkoutForm.appendChild(qtyInput);
              const idInput = document.createElement('input');
              idInput.type = 'hidden';
              idInput.name = 'cart_id[]';
              idInput.value = cartId;
              checkoutForm.appendChild(idInput);
            });
          });
        const checkoutBtn = document.getElementById('checkout-btn');
        const form = document.querySelector('form[action="{{ route('checkout') }}"]');
        const inputs = form.querySelectorAll('input[data-input]');
        const courierButtons = form.querySelectorAll('button[data-name="courier"]');
        const paymentButtons = form.querySelectorAll('button[data-name="payment"]');
        
        let selectedCourier = '';
        let selectedPayment = '';

        // Function to check form validity
        function checkFormValidity() {
          let allFieldsFilled = true;
          
          // Check all required inputs
          inputs.forEach(input => {
            if (input.value.trim() === '') {
              allFieldsFilled = false;
            }
          });
          
          // Check if courier and payment are selected
          if (!selectedCourier || !selectedPayment) {
            allFieldsFilled = false;
          }
          
          // Enable/disable checkout button
          checkoutBtn.disabled = !allFieldsFilled;
          
          if (allFieldsFilled) {
            checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
          } else {
            checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
          }
        }

        // Add event listeners to all inputs
        inputs.forEach(input => {
          input.addEventListener('input', checkFormValidity);
          input.addEventListener('change', checkFormValidity);
        });

        // Handle courier selection
        courierButtons.forEach(button => {
          button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all courier buttons
            courierButtons.forEach(btn => {
              btn.classList.remove('border-red-500', 'bg-red-50');
              btn.classList.add('border-gray-200');
            });
            
            // Add active class to clicked button
            this.classList.remove('border-gray-200');
            this.classList.add('border-red-500', 'bg-red-50');
            
            selectedCourier = this.getAttribute('data-value');
            
            // Add hidden input for courier
            let existingCourierInput = form.querySelector('input[name="courier"]');
            if (existingCourierInput) {
              existingCourierInput.remove();
            }
            
            const courierInput = document.createElement('input');
            courierInput.type = 'hidden';
            courierInput.name = 'courier';
            courierInput.value = selectedCourier;
            form.appendChild(courierInput);
            
            checkFormValidity();
          });
        });

        // Handle payment selection
        paymentButtons.forEach(button => {
          button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all payment buttons
            paymentButtons.forEach(btn => {
              btn.classList.remove('border-red-500', 'bg-red-50');
              btn.classList.add('border-gray-200');
            });
            
            // Add active class to clicked button
            this.classList.remove('border-gray-200');
            this.classList.add('border-red-500', 'bg-red-50');
            
            selectedPayment = this.getAttribute('data-value');
            
            // Add hidden input for payment
            let existingPaymentInput = form.querySelector('input[name="payment"]');
            if (existingPaymentInput) {
              existingPaymentInput.remove();
            }
            
            const paymentInput = document.createElement('input');
            paymentInput.type = 'hidden';
            paymentInput.name = 'payment';
            paymentInput.value = selectedPayment;
            form.appendChild(paymentInput);
            
            checkFormValidity();
          });
        });

        // Initial check
        checkFormValidity();
      });
    </script>
    <!-- END: COMPLETE YOUR ROOM -->
@endsection