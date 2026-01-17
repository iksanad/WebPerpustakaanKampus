window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementsByClassName('table-datatable');
    // iterate
    for (let i = 0; i < datatablesSimple.length; i++) {
        new simpleDatatables.DataTable(datatablesSimple[i]);
    }
});
