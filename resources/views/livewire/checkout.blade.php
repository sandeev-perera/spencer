<div class="bg-white sm:px-8 px-4 py-6">
  <div class="max-w-screen-xl max-md:max-w-xl mx-auto">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 lg:gap-x-12">
      
      <!-- Delivery Details + Payment Form -->
      <div class="lg:col-span-2">
        @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <strong>Whoops! Something went wrong:</strong>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display Success Message -->
            @if (session('message'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif
        <form action="{{route('Confirm.checkout')}}" method="post">
          <!-- Delivery Details -->
          @csrf
          <div>
            <h2 class="text-xl text-slate-900 font-semibold mb-6">Delivery Details</h2>
            <div class="grid lg:grid-cols-2 gap-y-6 gap-x-6">
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-900" for="first_name">First Name</label>
                <input id="first_name" type="text" placeholder="Enter First Name" name="first_name"
                  class="w-full px-4 py-2.5 border border-gray-400 rounded-md bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required/>
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-900" for="last_name">Last Name</label>
                <input id="last_name" type="text" placeholder="Enter Last Name" name='last_name'
                  class="w-full px-4 py-2.5 border border-gray-400 rounded-md bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required/>
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-900" for="phone">Phone No.</label>
                <input id="phone" type="tel" placeholder="Enter Phone No." name="phone"
                  class="w-full px-4 py-2.5 border border-gray-400 rounded-md bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required />
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-900" for="address">Address Line</label>
                <input id="address" type="text" placeholder="Enter Address Line" name="address"
                  class="w-full px-4 py-2.5 border border-gray-400 rounded-md bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required/>
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-900" for="city">City</label>
                <input id="city" type="text" placeholder="Enter City" name="city"
                  class="w-full px-4 py-2.5 border border-gray-400 rounded-md bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required />
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-900" for="district">District</label>
                <input id="district" type="text" placeholder="Enter District" name="district"
                  class="w-full px-4 py-2.5 border border-gray-400 rounded-md bg-white text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required/>
              </div>
            </div>
          </div>

          <!-- Payment -->
          <div class="mt-12">
            <h2 class="text-xl text-slate-900 font-semibold mb-6">Payment</h2>
            <div class="w-full bg-gray-100 p-6 rounded-md border border-gray-300">
              <div class="space-y-4">
                <div>
                  <input type="text" placeholder="Cardholder's Name" name="cardholder_name"
                    class="w-full px-4 py-3.5 border border-gray-200 rounded-md bg-gray-100 text-slate-900 text-sm focus:outline-none focus:ring-2" required/>
                </div>

                <div class="flex items-center border border-gray-200 rounded-md bg-gray-100 overflow-hidden">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 ml-3 flex-shrink-0" viewBox="0 0 32 20" aria-hidden="true">
                    <circle cx="10" cy="10" r="10" fill="#f93232" />
                    <path fill="#fed049"
                      d="M22 0c-2.246 0-4.312.75-5.98 2H16v.014c-.396.298-.76.634-1.107.986h2.214c.308.313.592.648.855 1H14.03a9.932 9.932 0 0 0-.667 1h5.264c.188.324.365.654.518 1h-6.291a9.833 9.833 0 0 0-.377 1h7.044c.104.326.186.661.258 1h-7.563c-.067.328-.123.66-.157 1h7.881c.039.328.06.661.06 1h-8c0 .339.027.67.06 1h7.882c-.038.339-.093.672-.162 1h-7.563c.069.341.158.673.261 1h7.044a9.833 9.833 0 0 1-.377 1h-6.291c.151.344.321.678.509 1h5.264a9.783 9.783 0 0 1-.669 1H14.03c.266.352.553.687.862 1h2.215a10.05 10.05 0 0 1-1.107.986A9.937 9.937 0 0 0 22 20c5.523 0 10-4.478 10-10S27.523 0 22 0z" />
                  </svg>
                  <input type="number" placeholder="Card Number" name="card_number"
                    class="ml-2 flex-grow px-4 py-3.5 bg-transparent text-slate-900 text-sm focus:outline-none" required/>
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <input type="text" placeholder="EXP." aria-label="Expiration date" name="exp_date"
                    class="w-full px-4 py-3.5 border border-gray-200 rounded-md bg-gray-100 text-slate-900 text-sm focus:outline-none focus:ring-2" required/>
                  <input type="number" placeholder="CVV" aria-label="CVV" name="cvv"
                    class="w-full px-4 py-3.5 border border-gray-200 rounded-md bg-gray-100 text-slate-900 text-sm focus:outline-none focus:ring-2" required/>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="relative">
        <h2 class="text-xl text-slate-900 font-semibold mb-6">Order Summary</h2>
        <ul class="text-slate-500 font-medium space-y-4">
          <li class="flex justify-between gap-4 text-sm">Subtotal <span class="font-semibold text-slate-900">{{$price}}</span></li>
          <li class="flex justify-between gap-4 text-sm">Discount <span class="font-semibold text-slate-900">$0.00</span></li>
          <hr class="border-slate-300" />
          <li class="flex justify-between gap-4 text-[15px] font-semibold text-slate-900">Total <span>{{$price}}</span></li>
        </ul>
        <div class="space-y-4 mt-8">
          <button type="submit"
            class="w-full rounded-md bg-blue-600 px-4 py-2.5 text-sm font-medium tracking-wide text-white hover:bg-blue-700 cursor-pointer">
            Complete Purchase
          </button>
          <button href="{{route('products')}}"
            class="w-full rounded-md border border-gray-300 bg-gray-100 px-4 py-2.5 text-sm font-medium tracking-wide text-slate-900 hover:bg-gray-200 cursor-pointer">
            Continue Shopping
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
