const { default: axios } = require("axios");

require("./bootstrap");
require("bootstrap");
require("datatables");
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

    $("#inputAuthor").on("input", async function () {
        let input = $(this).val();

        if (input.length < 3) return;

        const res = await axios.get($(this).data("autocomplete-url"), {
            params: { term: input },
        });

        res.data;
    });
});
