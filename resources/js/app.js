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

    const checksum = (isbn) => {
        //isbn have to be number or string (composed only of digits or char "X"):
        isbn = isbn.toString();

        //Remove last digit (control digit):
        let number = isbn.slice(0, -1);

        //Convert number to array (with only digits):
        number = number.split("").map(Number);

        //Save last digit (control digit):
        const last = isbn.slice(-1);
        const lastDigit = last !== "X" ? parseInt(last, 10) : "X";

        //Algorithm for checksum calculation (digit * position):
        number = number.map((digit, index) => {
            return digit * (index + 1);
        });

        //Calculate checksum from array:
        const sum = number.reduce((a, b) => a + b, 0);

        //Validate control digit:
        const controlDigit = sum % 11;
        return lastDigit === (controlDigit !== 10 ? controlDigit : "X");
    };

    window.validateIsbn = (isbn) => {
        const PREFIX = /^ISBN(?:-1[03])?:?\x20+/i;
        const ISBN = /^(?:\d{9}[\dXx]|\d{13})$/;

        isbn = isbn.replace(PREFIX, "");

        if (!ISBN.test(isbn)) {
            return false;
        }

        return checksum(isbn); //true or false
    };

    //     int CheckISBN(int const digits[10])
    // {
    //         int i, s = 0, t = 0;

    //         for (i = 0; i < 10; i++) {
    //                 t += digits[i];
    //                 s += t;
    //         }
    //         return s % 11;
    // }

    jQuery.validator.addMethod(
        "validIsbn",
        function (value, element) {
            return validateIsbn(value);
        },
        "Please enter valid ISBN number."
    );

    $("#book-form").validate();
});
