$(document).ready(function () {

    carregarNiveis();

    $('#form-novo-nivel').submit(function (event) {
        event.preventDefault();
        var nivel = $('#nivel').val();
        var nivel_id = $('#nivel_id').val();
        if (nivel_id) {
            editarNivel(nivel_id, nivel);
        } else {
            adicionarNivel(nivel);
        }
        $('#nivel').val('');
        $('#nivel_id').val('');
    });

    function carregarNiveis() {
        showLoadingModal();
        $.get('/api/niveis', function (data) {
            $('#lista-niveis').empty();
            data.forEach(function (nivel) {
                $('#lista-niveis').append(`
                    <tr>
                        <td>${nivel.id}</td>
                        <td>${nivel.nivel}</td>
                        <td>
                            <button class="btn btn-primary editar" data-id="${nivel.id}">Editar</button>
                            <button class="btn btn-danger excluir" data-id="${nivel.id}">Excluir</button>
                        </td>
                    </tr>
                `);
            });
            hideLoadingModal();
        });
    }

    $(document).on('click', '.editar', function () {
        var id = $(this).data('id');
        showLoadingModal();
        $.get(`/api/niveis/${id}`, function (nivel) {
            $('#nivel_id').val(nivel.id);
            $('#nivel').val(nivel.nivel);
            $('#submit-btn').addClass('d-none');
            $('#alterar-btn').removeClass('d-none');
            $('#cancel-btn').removeClass('d-none');
            hideLoadingModal();
        });
    });

    $('#alterar-btn').click(function () {
        var id = $('#nivel_id').val();
        var novoNivel = $('#nivel').val();
        editarNivel(id, novoNivel);
    });

    $('#cancel-btn').click(function () {
        $('#nivel').val('');
        $('#nivel_id').val('');
        $('#submit-btn').removeClass('d-none');
        $('#alterar-btn').addClass('d-none');
        $('#cancel-btn').addClass('d-none');
    });

    function editarNivel(id, novoNivel) {
        showLoadingModal();
        $.ajax({
            url: `/api/niveis/${id}`,
            method: 'PUT',
            data: {nivel: novoNivel},
            success: function () {
                carregarNiveis();
                $('#cancel-btn').trigger('click');
                hideLoadingModal();
            }
        });
    };

    $(document).on('click', '.excluir', function () {
        var id = $(this).data('id');
        if (confirm('Tem certeza que deseja excluir este nível?')) {
            excluirNivel(id);
        }
    });

    function excluirNivel(id) {
        showLoadingModal();
        $.ajax({
            url: `/api/niveis/${id}`,
            method: 'DELETE',
            success: function (response) {
                carregarNiveis();
                mostrarMensagem(response.message);
                hideLoadingModal();
            },
            error: function (xhr, status, error) {
                var mensagem = xhr.responseJSON.message;
                mostrarMensagem(mensagem, 'danger');
                hideLoadingModal();
            }
        });
    }

    function adicionarNivel(nivel) {
        showLoadingModal();
        $.post('/api/niveis', {nivel: nivel})
            .done(function () {
                carregarNiveis();
                hideLoadingModal();
            })
            .fail(function (jqXHR) {
                var response = jqXHR.responseJSON;
                if (response && response.errors) {
                    handleErrors(response.errors);
                } else {
                    mostrarMensagem('Erro ao adicionar nível. Por favor, tente novamente.', 'danger');
                }
                hideLoadingModal();
            });
    }

    function showLoadingModal() {
        $('#loadingModal').modal('show');
    }

    function hideLoadingModal() {
        $('#loadingModal').modal('hide');
    }

    function mostrarMensagem(mensagem, tipo = 'success', tempo = 5000) {
        $('#alert').removeClass().addClass(`alert alert-${tipo}`).text(mensagem).show();
        setTimeout(function () {
            $('#alert').fadeOut('slow');
        }, tempo);
    }

    function handleErrors(errors) {
        var errorMessage = '';
        for (var key in errors) {
            errorMessage += errors[key][0] + "\n";
        }
        mostrarMensagem(errorMessage, 'danger');
    }

});
