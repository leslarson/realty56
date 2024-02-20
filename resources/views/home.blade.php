<x-header :favorites="$favorites" />

        <!-- HEADER ends here -->
        
        <div class="banner mb-4" style="background: url('/images/resized/backdrop.jpg')">
            <div class="site-desc">
                <p>Welcome to <b>Realty56.com</b></p>
                <p>View Arkansas properties</p>
                <p>NOTE: This is a project site ONLY</p>
                <p><b>Do not use for real-time property search or official business.</b></p>
            </div>
            <div class="site-instruct">
                <p><b>Searching:</b></p>
                <p>Use this button for customized searches<br>
                (Beds, baths, house size, etc)</p>
                <button id="searchBtn" class="search-button" type="button" data-toggle="modal" data-target="#searchModal">Search</button>
                <p class="mt-2">or use the input below to search by city or zip code</p>
                
                <!-- Tom Select goes here -->
                <select id="cityzip" placeholder="enter city or zip code" style="display:none">
                    <option value="">Select</option>
                </select>

            </div>
        </div>
        <div id="container">

            @if (session()->has('success'))
            <div>
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            </div>
            @endif
        
            @if (session()->has('failure'))
                <div>
                    <div class="alert alert-danger text-center">
                        {{ session('failure') }}
                    </div>
                </div>
            @endif
            <div class="search-results">
                Listings for:&nbsp;
                <b>
                @if(isset($userfav))
                    <span id="text-favorites">Favorites</span>
                @else
                    {{ implode(", ", $cities) }}
                @endif
                </b>
            </div>
            <div class="search-results">
                <b>
                @if ($listingCount)
                Showing {{ $listingCount }} {{ $listingCount>= 2 ? 'Properties' : 'Property'}}
                </b>
                    @if(!isset($userfav))
                        &nbsp;-&nbsp;
                        <select id="sort-by" class="sort-by" required="">
                        <option disabled="" selected="">Sort Listings</option>
                        <option value="0">Price - low to high</option>
                        <option value="1">Price - high to low</option>
                        <option value="2">Lot - small to large</option>
                        <option value="3">Lot - large to small</option>
                    </select>
                    @endif
                @else
                No properties matching your search
                @endif
                </b>
                @if (session()->has('query'))
                - <a href="/" id="clear-search" class="btn btn-sm btn-warning">Clear Search</a>
                @endif
            </div>
            <div class="main-body">

                {{-- All listings --}}
                <div id="listings">
                    @foreach($listings as $listing)
                        {{-- Individual listing --}}
                        <x-single :listing="$listing" :favorites="$favorites" />
                    @endforeach
                </div>
                {{-- end of listings  --}}

                @guest
                    <div class="access">
                        <div id="register">
                            <form action="/register" method="POST" id="registration-form">
                                @csrf
                                <div>
                                    <p class="newaccount">
                                        Create New Account.
                                    </p>
                                    <p>
                                    Save your favorite listings with a <b>free</b> Realty56 account.
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input value="{{ old('username') }}" name="username" id="username-register" class="form-control" type="text" placeholder="Pick a username" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input value="{{ old('email') }}" name="email" id="email-register" class="form-control" type="text" placeholder="Your email address" autocomplete="off" />
                                </div>
                                <div class="form-group">
                                    <input name="password" id="password-register" class="form-control" type="password" placeholder="Create a password" />
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Confirm password" />
                                </div>
                                <button type="submit" class="mt-3 btn btn-success btn-block">Register</button>
                            </form>
                            @error('username')
                            <span class="m-0 small alert alert-danger">{{ $message }}</span>    
                            @enderror
                            @error('email')
                            <p class="m-0 small alert alert-danger">{{ $message }}</p>  
                            @enderror
                            @error('password')
                            <p class="m-0 small alert alert-danger">{{ $message }}</p>  
                            @enderror
                            @error('password-confirmation')
                            <p class="m-0 small alert alert-danger">{{ $message }}</p>  
                            @enderror
                        </div>
                    </div>
                @endguest
            </div>
            @if(method_exists($listings, 'links'))
                <div class="mt-3">
                    {{ $listings->appends(request()->query())->links() }}
                </div>
            @endif
            <x-copyright />
        </div>

    <!-- Modal begins here -->
    <x-modal />

<x-footer />