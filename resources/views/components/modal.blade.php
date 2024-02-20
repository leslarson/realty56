<div class="modal" id="searchModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Realty56 - Custom search</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        
        {{-- Modal content here --}}
            <div class="mdl-search-item mb-2">
                <p class="mdl-desc">Price:</p>
                <div>
                    <select name="mdl-price-0" id="mdl-price-0">
                        <option value="0">No Min</option>
                        <option value="100000">$100K</option>
                        <option value="125000">$125K</option>
                        <option value="150000">$150K</option>
                        <option value="250000">$250K</option>
                        <option value="350000">$350K</option>
                        <option value="450000">$450K</option>
                        <option value="600000">$600K</option>
                        <option value="700000">$700K</option>
                        <option value="800000">$800K</option>
                    </select>
                    <select name="mdl-price-1" id="mdl-price-1">
                        <option value="0">No Max</option>
                        <option value="100000">$100K</option>
                        <option value="200000">$200K</option>
                        <option value="400000">$400K</option>
                        <option value="600000">$600K</option>
                        <option value="800000">$800K</option>
                        <option value="1000000">$1M</option>
                        <option value="1200000">$1.2M</option>
                        <option value="1400000">$1.4M</option>
                    </select>
               </div>
            </div>
            <div class="mdl-search-item mb-2">
                <p class="mdl-desc">Beds:</p>
                <div>
                    <select name="mdl-beds-0" id="mdl-beds-0">
                        <option value="0">No Min</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <select name="mdl-beds-1" id="mdl-beds-1">
                        <option value="0">No Max</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="mdl-search-item mb-2">
                <p class="mdl-desc">Baths:</p>
                <div>
                    <select name="mdl-baths-0" id="mdl-baths-0">
                        <option value="0">No Min</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <select name="mdl-baths-1" id="mdl-baths-1">
                        <option value="0">No Max</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="mdl-search-item mb-2">
                <p class="mdl-desc">House:</p>
                <div>
                    <select name="mdl-sqft-0" id="mdl-sqft-0">
                        <option value="0">Any SqFt</option>
                        <option value="500">500 sqft</option>
                        <option value="750">750 sqft</option>
                        <option value="1000">1000 sqft</option>
                        <option value="1250">1250 sqft</option>
                        <option value="1500">1500 sqft</option>
                        <option value="1750">1750 sqft</option>
                        <option value="2000">2000 sqft</option>
                        <option value="2250">2250 sqft</option>
                        <option value="2500">2500 sqft</option>
                        <option value="2750">2750 sqft</option>
                    </select>
                    <select name="mdl-sqft-1" id="mdl-sqft-1">
                        <option value="0">Any SqFt</option>
                        <option value="1500">1500 sqft</option>
                        <option value="2250">2250 sqft</option>
                        <option value="2500">2500 sqft</option>
                        <option value="2750">2750 sqft</option>
                        <option value="3000">3000 sqft</option>
                        <option value="3250">3250 sqft</option>
                        <option value="3500">3500 sqft</option>
                        <option value="3750">3750 sqft</option>
                        <option value="5000">5000 sqft</option>
                        <option value="7500">7500 sqft</option>
                        <option value="10000">10000 sqft</option>
                    </select>
                </div>
            </div>
            <div class="mdl-search-item">
                <p class="mdl-desc">Lot:</p>
                <div>
                    <select name="mdl-lot-0" id="mdl-lot-0">
                        <option value="0">No Min</option>
                        <option value="2000">2,000 sqft</option>
                        <option value="3000">3,000 sqft</option>
                        <option value="4000">4,000 sqft</option>
                        <option value="5000">5,000 sqft</option>
                        <option value="7500">7,500 sqft</option>
                        <option value="10890">0.25 acre</option>
                        <option value="21780">0.50 acre</option>
                        <option value="43560">1 acre</option>
                        <option value="87120">2 acres</option>
                        <option value="217800">5 acres</option>
                        <option value="435600">10 acres</option>
                        <option value="653400">15 acres</option>
                        <option value="871200">20 acres</option>
                        <option value="2178000">50 acres</option>
                        <option value="4356000">100 acres</option>
                    </select>
                    <select name="mdl-lot-1" id="mdl-lot-1">
                        <option value="0">No Max</option>
                        <option value="2000">2,000 sqft</option>
                        <option value="3000">3,000 sqft</option>
                        <option value="4000">4,000 sqft</option>
                        <option value="5000">5,000 sqft</option>
                        <option value="7500">7,500 sqft</option>
                        <option value="10890">0.25 acre</option>
                        <option value="21780">0.50 acre</option>
                        <option value="43560">1 acre</option>
                        <option value="87120">2 acres</option>
                        <option value="217800">5 acres</option>
                        <option value="435600">10 acres</option>
                        <option value="653400">15 acres</option>
                        <option value="871200">20 acres</option>
                        <option value="2178000">50 acres</option>
                        <option value="4356000">100 acres</option>
                    </select>
                </div>
            </div>
        {{-- Modal content end --}}

        </div>
        <div class="modal-footer">
            <section>
            @if(session()->has('thisRegion'))
                <span class="this-region"><label id="only-in" for="include-region">Only in <b id="current-region">{{ session('thisRegion') }}</b></label>
                <input id="include-region" type="checkbox" checked></span>
            @else
            <span class="this-region">(Will select from all listings)</span>
            @endif
            </section>
          <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal">Get Listings</button>
        </div>
      </div>
    </div>
</div>