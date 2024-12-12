<!-- <script>
    $(document).on("change", "#make", function() {
    var make = document.getElementById("make").value;
    // console.log(make);
    $("#model").empty();
    $("#vehicle_type1").empty();
    $("#submodel").val("");
    $("#year").val("");
    // $("#no_of_pass").val("");
    $("#amount").val("");
    $.ajax({
        url: "/api/v1/insurance/getCarModel",
        type: "post",
        data: {
        make: make
        },
        dataType: "json",
        success: function(response) {
        var len = response.length;
        $("#model").empty();
        $("#model").append("<option value=''>Please select</option>");
        for (var i = 0; i < len; i++) {
            var model = response[i]["model"];
            $("#model").append(
            "<option  value='" + model + "'>" + model + "</option>"
            );
        }
        }
    });
    });

    $(document).on("change", "#model", function() {
    var model = document.getElementById("model").value;
    $("#vehicle_type1").empty();
    $("#submodel").val("");
    $("#year").val("");
    // $("#no_of_pass").val("");
    $("#amount").val("");

    $.ajax({
        url: "/api/v1/insurance/getBodyType",
        type: "post",
        data: {
        model: model
        },
        dataType: "json",
        success: function(response) {
        var len = response.length;
        $("#vehicle_type1").empty();
        $("#vehicle_type1").append("<option value=''>Please select</option>");
        for (var i = 0; i < len; i++) {
            var bodytype = response[i]["bodytype_name"];
            $("#vehicle_type1").append(
            "<option value='" + bodytype + "'>" + bodytype + "</option>"
            );
        }
        },
        error: function(xhr, ajaxOptions, thrownError) {}
    });
    });

    $("#year")
    .autocomplete({
        minLength: 0,
        source: function(request, response) {
        var model = document.getElementById("model").value;
        var vehicle_type = document.getElementById("vehicle_type1").value;
        // $("#no_of_pass").val(0);
        $("#amount").val(0);
        $("#submodel").val('')
        $.ajax({
            url: "/api/v1/insurance/getYearModel",
            type: "post",
            data: {
            model: model,
            vehicle_type: vehicle_type
            },
            dataType: "json",
            success: function(data) {
            response(data);
            }
        });
        },
        focus: function(event, ui) {
        $("#year").val(ui.item.year);
        return false;
        },
        select: function(event, ui) {
        $("#year").val(ui.item.year);
        return false;
        }
    })
    .bind("focus", function() {
        $(this).autocomplete("search");
    })
    // ORIGINAL
    // .data("ui-autocomplete")._renderItem = function(ul, item) {
    // return $("<li>")
    //     .data("ui-autocomplete-item", item)
    //     .append("<a> " + item.year + "</a>")
    //     .appendTo(ul);
    // };
    $("#year").data("ui-autocomplete")._renderMenu = function(ul, items) {
        var that = this;
        ul.addClass("custom-menu");
        $.each(items, function(index, item) {
            that._renderItemData(ul, item);
        });
    };

    $("#year").data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
            .addClass("custom-menu-item")
            .data("ui-autocomplete-item", item)
            .append("<div>" + item.year + "</div>")
            .appendTo(ul);
    };

    $("#submodel")
    .autocomplete({
        minLength: 0,
        source: function(request, response) {
        var model = document.getElementById("model").value;
        var year = document.getElementById("year").value;

        // $("#no_of_pass").val(0);
        // $("#amount").val(0);

        $.ajax({
            url: "/api/v1/insurance/getSubModel",
            type: "post",
            data: {
            model: model,
            year: year
            },
            dataType: "json",
            success: function(data) {
            response(data);
            //document.getElementById('agreement').checked = false;
            }
        });
        },
        focus: function(event, ui) {
        $("#submodel").val(ui.item.submodel_name);
        $("#car_details_btn").prop("disabled", false);
        return false;
        },
        select: function(event, ui) {
        $("#submodel").val(ui.item.submodel_name);
       // $("#no_of_pass").val(ui.item.no_of_pass);
        $("#amount").val(ui.item.amount);
        return false;
        }
    })
    .bind("focus", function() {
        $(this).autocomplete("search");
    })
    // ORIGINAL
    // .data("ui-autocomplete")._renderItem = function(ul, item) {
    // return $("<li>")
    //     .data("ui-autocomplete-item", item)
    //     .append("<a> " + item.submodel_name + "</a>")
    //     .appendTo(ul);
    // };
    $("#submodel").data("ui-autocomplete")._renderMenu = function(ul, items) {
        var that = this;
        ul.addClass("custom-menu");
        $.each(items, function(index, item) {
            that._renderItemData(ul, item);
        });
    };
    $("#submodel").data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
            .addClass("custom-menu-item")
            .data("ui-autocomplete-item", item)
            .append("<div>" + item.submodel_name + "</div>")
            .appendTo(ul);
    };


</script> -->
