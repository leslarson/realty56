<?php

// I wanted this file to hold small utility functions
// "Full" functions are in functions.php

function showListingStatus($contingent, $pending) {
    if (!($contingent OR $pending)) {
        return "<span class='for-sale'>●</span> Property for sale";
    } else {
        return ($contingent) ? "<span class='not-for-sale'>●</span> Contingent" : "<span class='not-for-sale'>●</span> Pending";
    }
}

function showLotSize($lotSqFt) {
    if ($lotSqFt >= 10000) {
        return "<strong>".number_format($lotSqFt/43560, 2)."</strong> acre lot";
    }
    return "<strong>".number_format($lotSqFt)."</strong> sqft lot";
}