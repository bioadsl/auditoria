$(document).ready(function() {
    // Evento de input para busca em tempo real
    $('#serverSearchInput').on('input', function() {
        const query = $(this).val();
        
        if (query.length >= 2) {
            $.ajax({
                url: '/servers/search',
                method: 'GET',
                data: { query: query },
                success: function(response) {
                    const tbody = $('#serversTable tbody');
                    tbody.empty();
                    
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(server) {
                            tbody.append(`
                                <tr>
                                    <td>${server.name}</td>
                                    <td>${server.client_name}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary select-server" 
                                                data-server-name="${server.name}">
                                            Selecionar
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        tbody.append('<tr><td colspan="3" class="text-center">Nenhum servidor encontrado</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na busca:', error);
                    $('#serversTable tbody').html(
                        '<tr><td colspan="3" class="text-center text-danger">Erro ao buscar servidores</td></tr>'
                    );
                }
            });
        }
    });

    // Evento para selecionar um servidor
    // Selecionar servidor
    $(document).on('click', '.select-server', function() {
        let serverName = $(this).data('server-name');
        let serverId = $(this).data('server-id');
        
        $('#server_input').val(serverName);
        $('#server_id').val(serverId);
        $('#searchServerModal').modal('hide');
    });
});