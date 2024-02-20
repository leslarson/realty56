<x-header :favorites="$favorites"/>
<div id="listing-container">
    <div id="hero">
    <!-- All photos /carousel go here -->
        <div id="carouselContainer" class="carousel slide" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
                @foreach ($details['photos'] as $photo)
                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                    <img src="{{ str_replace('s.jpg', 'od.jpg', $photo['href']) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <p>{{ $loop->index + 1 }} / {{ $details['photo_count'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselContainer" data-slide="prev">
                {{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
                <i class="fa-solid fa-less-than"></i>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselContainer" data-slide="next">
                <i class="fa-solid fa-greater-than"></i>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
    <div id="listing-details">
        <div id="detail-summary">
            <div class="status">
                {!! showListingStatus($details['flags']['is_contingent'], $details['flags']['is_pending']) !!}
            </div>
            <div class="listing-price">
                {{ '$' . number_format($details['list_price']) }}
            </div>
            <div>
                <ul id="description">
                    <li><strong>{{ $details['description']['beds'] }}</strong> bed</li>
                    <li><strong>{{ $details['description']['baths'] }}</strong> bath</li>
                    <li><strong>{{ number_format($details['description']['sqft']) }}</strong> sqft</li>
                    <li>{!! showLotSize($details['description']['lot_sqft']) !!}</li>
                </ul>
            </div>
            <div class="address-details">
                <div style="flex-grow: 1;">
                    {{ $details['location']['address']['line'] }}, {{ $details['location']['address']['city'] }}, {{ $details['location']['address']['state_code'] }}, {{ $details['location']['address']['postal_code'] }}
                </div>
                <div class="btn btn-success email-btn btn-sm">Ask About</div>
            </div>
            <div class="feature-row">
                @foreach ($features as $feature)
                <span class=feature-group>
                    <div class="feature-icon">
                        <i class="{{ $feature[0] }}"></i>
                    </div>
                    <div class="feature-type-var">
                        <div class="feature-var">
                            {{ $feature[1] }}
                        </div>
                        <div class="feature-type">
                            {{ $feature[2] }}
                        </div>
                    </div>
                </span>
                @endforeach
            </div>
            <hr>
            <div id="property-details">
                {{ $details['description']['text'] }}
            </div>
            <hr>
            <div id="prop-bedrooms">
                Developer's Note: This section would normally contain various bits of data about heating and cooling features, electricity and water sources, etc.

                Since this is a portfolio project I decided not to include all of that additional detail.
            </div>
            <hr>
        </div>
    </div>

    <x-copyright /> 
</div>
<x-footer />