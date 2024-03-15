$(document).ready(function () {

    carregarDesenvolvedores();
    carregarNiveis();

    $('#form-novo-desenvolvedor').submit(function (event) {
        event.preventDefault();
        var nome = $('#nome').val();
        var sexo = $('#sexo').val();
        var datanascimento = $('#datanascimento').val();
        var hobby = $('#hobby').val();
        var nivel_id = $('#nivel_id').val();
        var desenvolvedor_id = $('#desenvolvedor_id').val();
        if (desenvolvedor_id) {
            editarDesenvolvedor(desenvolvedor_id, nome, sexo, datanascimento, hobby, nivel_id);
        } else {
            adicionarDesenvolvedor(nome, sexo, datanascimento, hobby, nivel_id);
        }
        $('#desenvolvedor_id').val('');
        $('#nome').val('');
        $('#sexo').val('');
        $('#datanascimento').val('');
        $('#hobby').val('');
        $('#nivel_id').val('');
    });

    function carregarDesenvolvedores() {
        showLoadingModal();
        $.get('/api/desenvolvedores', function (data) {
            $('#lista-desenvolvedores').empty();
            data.forEach(function (desenvolvedor) {
                var nivel = desenvolvedor.nivel ? desenvolvedor.nivel.nivel : 'N/A';
                var dataFormatada = new Date(desenvolvedor.datanascimento).toLocaleDateString('pt-BR');
                $('#lista-desenvolvedores').append(`
                    <tr>
                        <td>${desenvolvedor.nome}</td>
                        <td>${desenvolvedor.sexo}</td>
                        <td>${dataFormatada}</td>
                        <td>${desenvolvedor.hobby}</td>
                        <td>${nivel}</td>
                        <td>
                            <button class="btn btn-primary editar" data-id="${desenvolvedor.id}">Editar</button>
                            <button class="btn btn-danger excluir" data-id="${desenvolvedor.id}">Excluir</button>
                        </td>
                    </tr>
                `);
            });
            hideLoadingModal();
        });
    }

    function carregarNiveis() {
        showLoadingModal();
        $.get('/api/niveis', function (data) {
            data.forEach(function (nivel) {
                $('#nivel_id').append(`<option value="${nivel.id}">${nivel.nivel}</option>`);
            });
            hideLoadingModal();
        });
    }

    $(document).on('click', '.editar', function () {
        var id = $(this).data('id');
        showLoadingModal();
        $.get(`/api/desenvolvedores/${id}`, function (desenvolvedor) {
            $('#desenvolvedor_id').val(desenvolvedor.id);
            $('#nome').val(desenvolvedor.nome);
            $('#sexo').val(desenvolvedor.sexo);
            $('#datanascimento').val(desenvolvedor.datanascimento);
            $('#hobby').val(desenvolvedor.hobby);
            $('#nivel_id').val(desenvolvedor.nivel_id);
            $('#submit-btn').addClass('d-none');
            $('#alterar-btn').removeClass('d-none');
            $('#cancel-btn').removeClass('d-none');
            hideLoadingModal();
        });
    });

    $('#cancel-btn').click(function () {
        $('#desenvolvedor_id').val('');
        $('#nome').val('');
        $('#sexo').val('');
        $('#datanascimento').val('');
        $('#hobby').val('');
        $('#nivel_id').val('');
        $('#submit-btn').removeClass('d-none');
        $('#alterar-btn').addClass('d-none');
        $('#cancel-btn').addClass('d-none');
    });

    $('#alterar-btn').click(function () {
        var nome = $('#nome').val();
        var sexo = $('#sexo').val();
        var datanascimento = $('#datanascimento').val();
        var hobby = $('#hobby').val();
        var nivel_id = $('#nivel_id').val();
        var desenvolvedor_id = $('#desenvolvedor_id').val();
        editarDesenvolvedor(desenvolvedor_id, nome, sexo, datanascimento, hobby, nivel_id);
    });

    function editarDesenvolvedor(id, nome, sexo, datanascimento, hobby, nivel_id) {
        showLoadingModal();
        $.ajax({
            url: `/api/desenvolvedores/${id}`,
            method: 'PUT',
            data: {nome: nome, sexo: sexo, datanascimento: datanascimento, hobby: hobby, nivel_id: nivel_id},
            success: function () {
                carregarDesenvolvedores();
                $('#cancel-btn').trigger('click');
                hideLoadingModal();
            }
        });
    }

    $(document).on('click', '.excluir', function () {
        var id = $(this).data('id');
        if (confirm('Tem certeza que deseja excluir este desenvolvedor?')) {
            excluirDesenvolvedor(id);
        }
    });

    function excluirDesenvolvedor(id) {
        showLoadingModal();
        $.ajax({
            url: `/api/desenvolvedores/${id}`,
            method: 'DELETE',
            success: function (response) {
                carregarDesenvolvedores();
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

    function mostrarMensagem(mensagem, tipo = 'success', tempo = 5000) {
        $('#alert').removeClass().addClass(`alert alert-${tipo}`).text(mensagem).show();
        setTimeout(function () {
            $('#alert').fadeOut('slow');
        }, tempo);
    }

    function showLoadingModal() {
        $('#loadingModal').modal('show');
    }

    function hideLoadingModal() {
        $('#loadingModal').modal('hide');
    }

    function handleErrors(errors) {
        var errorMessage = '';
        for (var key in errors) {
            errorMessage += errors[key][0] + "\n";
        }
        mostrarMensagem(errorMessage, 'danger');
    }

    function adicionarDesenvolvedor(nome, sexo, datanascimento, hobby, nivel_id) {
        showLoadingModal();
        $.post('/api/desenvolvedores', {
            nome: nome,
            sexo: sexo,
            datanascimento: datanascimento,
            hobby: hobby,
            nivel_id: nivel_id
        })
            .done(function () {
                $('#nome').val('');
                $('#hobby').val('');
                carregarDesenvolvedores();
                hideLoadingModal();
            })
            .fail(function (jqXHR) {
                var response = jqXHR.responseJSON;
                if (response && response.errors) {
                    handleErrors(response.errors);
                } else {
                    mostrarMensagem('Erro ao adicionar desenvolvedor. Por favor, tente novamente.', 'danger');
                }
                hideLoadingModal();
            });
    }
});
