$(function () {
    'use strict';
    if ($("#sample-data-table").length) {
        $("#sample-data-table").DataTable({});
    }

    if ($("#vast-data-table").length) {
        $("#vast-data-table").DataTable({
            "order": [[ 2, "asc" ]]
        });
    }

    if ($("#json-sample-data-table").length) {
        $("#json-sample-data-table").DataTable({});
    }

    if ($("#complex-header-table").length) {
        $("#complex-header-table").DataTable({
            stateSave: true
        });
    }

    if ($("#horizontal-scroll-table").length) {
        $("#horizontal-scroll-table").DataTable({
            stateSave: true,
            "scrollY": "50vh",
            "scrollX": true,
            "scrollCollapse": true,
        });
    }
});