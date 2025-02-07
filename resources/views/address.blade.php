<script>
            $(document).ready(function () {
            var towns = @json($towns);
            $("#town").autocomplete({
                minLength: 1,
                source: function (request, response) {
                    var term = request.term;
                    var filteredTowns = towns.filter(function (town) {
                        return town.az_barangay.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                    });
                    var limitedTowns = filteredTowns.slice(0, 10); // Limiting to first 10 items
                    response(limitedTowns.map(function (town) {
                        return {
                            label: town.az_barangay + " - " + town.city_name + ", " + town.district_name,
                            value: town.az_barangay
                        };
                    }));
                },
                select: function (event, ui) {
                    var selectedTown = towns.find(function (town) {
                        return town.az_barangay === ui.item.value;
                    });
                    $("#town").val(decodeHtml(selectedTown.az_barangay));
                    $("#city").val(decodeHtml(selectedTown.city_name));
                    $("#province").val(decodeHtml(selectedTown.district_name));
                    $("#zcode").val(decodeHtml(selectedTown.az_zipcode));
                    return false;
                }
            })
                .autocomplete("instance")._renderItem = function (ul, item) {
                    return $("<li>")
                        .attr("data-value", item.value)
                        .append(item.label)
                        .appendTo(ul);
                };
        });

        var citys = @json($citys);

        // AutoComplete Home Address (City)
        $("#city").autocomplete({
            minLength: 1,
            source: function (request, response) {
                var term = request.term;
                var filteredCity = citys.filter(function (city) {
                    return city.city_name.toLowerCase().indexOf(term.toLowerCase()) !== -1;
                });
                var limitedCity = filteredCity.slice(0, 10); // Limiting to first 10 items
                response(limitedCity.map(function (city) {
                    return {
                        label: city.city_name + " - " + city.district_name,
                        value: city.city_name
                    };
                }));
            },
            select: function (event, ui) {
                var selectedCity = citys.find(function (city) {
                    return city.city_name === ui.item.value;
                });
                if (selectedCity) {
                    $("#city").val(decodeHtml(selectedCity.city_name));
                    $("#province").val(decodeHtml(selectedCity.district_name));
                    $("#zcode").val(decodeHtml(selectedCity.az_zipcode));
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .attr("data-value", item.value)
                .append(item.label)
                .appendTo(ul);
        };

        function decodeHtml(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        }
    </script>
    <!-- AutoComplete Office Address(Brg/Town) -->
<script>
var towns = @json($towns);

$("#town1").autocomplete({
    minLength: 1,
    source: function(request, response) {
        var term = request.term;
        var filteredTowns = towns.filter(function(town) {
            return town.az_barangay.toLowerCase().indexOf(term.toLowerCase()) !== -1;
        });
        var limitedTowns = filteredTowns.slice(0, 10); // Limiting to first 10 items
        response(limitedTowns.map(function(town) {
            return {
                label: town.az_barangay + " - " + town.city_name + ", " + town.district_name,
                value: town.az_barangay
            };
        }));
    },
    select: function(event, ui) {
        var selectedTown = towns.find(function(town) {
            return town.az_barangay === ui.item.value;
        });
        if (selectedTown) {
            $("#town1").val(decodeHtml(selectedTown.az_barangay));
            $("#city1").val(decodeHtml(selectedTown.city_name));
            $("#province1").val(decodeHtml(selectedTown.district_name));
            $("#zcode1").val(decodeHtml(selectedTown.az_zipcode));
        }
        return false;
    }
}).autocomplete("instance")._renderItem = function(ul, item) {
    return $("<li>")
        .attr("data-value", item.value)
        .append(item.label)
        .appendTo(ul);
};

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}

// AutoComplete Home Address (Municipality/City)
$("#city1").autocomplete({
    minLength: 1,
    source: function(request, response) {
        var term = request.term;
        var filteredCity = citys.filter(function(city) {
            return city.city_name.toLowerCase().indexOf(term.toLowerCase()) !== -1;
        });
        var limitedCity = filteredCity.slice(0, 10); // Limiting to first 10 items
        response(limitedCity.map(function(city) {
            return {
                label: city.city_name + " - " + city.district_name,
                value: city.city_name
            };
        }));
    },
    select: function(event, ui) {
        var selectedCity = citys.find(function(city) {
            return city.city_name === ui.item.value;
        });
        if (selectedCity) {
            $("#city1").val(decodeHtml(selectedCity.city_name));
            $("#province1").val(decodeHtml(selectedCity.district_name));
            $("#zcode1").val(decodeHtml(selectedCity.az_zipcode));
        }
        return false;
    }
}).autocomplete("instance")._renderItem = function(ul, item) {
    return $("<li>")
        .attr("data-value", item.value)
        .append(item.label)
        .appendTo(ul);
};

function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}
</script>