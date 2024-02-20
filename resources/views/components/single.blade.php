{{-- Single property listing on home page --}}

<div id="{{ $listing->property_id }}" class="single-listing">
    <a href="/listing/{{ $listing->property_id }}">
        <div class="brokered-by">
            Brokered by<br>
            {{ $listing->branding_name }}
        </div>
        <div class="listing-image" style="background-image: url('{{ str_replace("s.jpg", "od.jpg", $listing->primary_photo) }}')">
            @auth
            <div class="favorite">
                <span id="fav-{{ $listing->property_id }}" class="
                    @if(count($favorites) and in_array($listing->property_id, $favorites))
                        fa-solid
                    @else
                        fa-regular
                    @endif
                    fa-heart favback">
                </span>
            </div>
            @endauth
        </div>
        <div class="status">
            {!! showListingStatus($listing->flags_is_contingent, $listing->flags_is_pending) !!}
        </div>
        <div class="listing-price">
            {{ '$' . number_format($listing->list_price) }}
        </div>
        <div>
            <ul id="description">
                <li><strong>{{ $listing->description_beds }}</strong> bed</li>
                <li><strong>{{ $listing->description_baths }}</strong> bath</li>
                <li><strong>{{ number_format($listing->description_sqft) }}</strong> sqft</li>
                @if(!is_null($listing->description_lot_sqft))
                    <li>{!! showLotSize($listing->description_lot_sqft) !!}</li>
                @endif
            </ul>
        </div>
        <div class="address-details">
            <div style="flex-grow: 1;">
                {{ $listing->address_line }}<br>{{ $listing->address_city }}, {{ $listing->address_state_code }}, {{ $listing->address_postal_code }}
            </div>
            <div class="btn btn-success email-btn btn-sm">Ask About</div>
        </div>
    </a>
</div>