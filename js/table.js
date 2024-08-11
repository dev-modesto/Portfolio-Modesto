new DataTable('#myTable', {
    pagingType: 'simple_numbers',
    language: {
        url: '//cdn.datatables.net/plug-ins/2.0.8/i18n/pt-BR.json',
    },

});

$(document).ready( function () {
    $('#myTable').DataTable();
} );

