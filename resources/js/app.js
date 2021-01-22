const { default: axios } = require("axios");

require("./bootstrap");
require("bootstrap");
require("datatables");
require("jquery-validation");
var AutoComplete = require("autocomplete-js");

// require("bootstrap-table");

$(function () {
    $("#table").DataTable({
        info: false,
        paging: false,
        ordering: true,
        columnDefs: [
            {
                orderable: false,
                targets: "no-sort",
            },
        ],
        aaSorting: [], // prevent auto sort
        language: {
            search: "Vyhľadávať v tabuľke:",
        },
    });

    AutoComplete({
        QueryArg: "term",
        MinChars: 3,
        // EmptyMessage: "",
        _Post: function (response) {
            let authors = [];

            JSON.parse(response).forEach((value) => {
                authors.push({
                    Value: value.name,
                    Label: this._Highlight(value.name),
                });
            });
            return authors;
        },
    });

    $("#isbn").on("input", function () {
        let isbn = $(this).val();

        $(this).val(isbn.replace(/-/g, ""));
    });

    // isbn soft format validation
    const validateIsbn = (isbn) => {
        const PREFIX = /^ISBN(?:-1[03])?:?\x20+/i;
        const ISBN = /^(?:\d{9}[\dXx]|\d{13})$/;

        isbn = isbn.replace(PREFIX, "");

        return ISBN.test(isbn);
    };

    jQuery.validator.addMethod(
        "validIsbn",
        function (value, element) {
            return validateIsbn(value);
        },
        "Please enter valid ISBN number."
    );

    jQuery.extend(jQuery.validator.messages, {
        required: "Prosím, zadajte tento údaj.",
        validIsbn: "Prosím, zadajte správny formát ISBN.",
        step: "Prosím, zadajte násobok " + $("#price").attr("step") + ".",
        min: "Prosím, zadajte kladné číslo.",
        number: "Prosím, zadajte číslo.",
    });

    $("#book-form").validate({
        // messages: {
        //     required: "Názov knihy je povinný údaj.",
        //     // postcode: {
        //     //     required: "Field PostCode is required",
        //     //     minlength: "Field PostCode must contain at least 3 characters",
        //     // },
        // },
    });
});
