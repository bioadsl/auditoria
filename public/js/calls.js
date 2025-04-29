$(document).ready(function() {
    $('#table').bootstrapTable({
        locale: 'pt-BR',
        search: true,
        showRefresh: true,
        showToggle: true,
        showFullscreen: true,
        showColumns: true,
        detailView: true,
        showExport: true,
        pagination: true,
        pageList: [10, 25, 50, 100, 'all'],
        sortName: 'ticket',
        sortOrder: 'asc'
    });
});