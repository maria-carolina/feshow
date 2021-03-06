<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<!-- Adicionando Javascript -->
<script type="text/javascript" >

    //Script CEP
    $(document).ready(function() {
        'use strict';
        function limpa_formulario_cep() {
// Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
        }

//Quando o campo cep perde o foco.
        $("#cep").blur(function () {
//Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
            if (cep != "") {

//Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

//Valida o formato do CEP.
                if (validacep.test(cep)) {

//Preenche os campos com "..." enquanto consulta webservice.
                    $("#cidade").val("...");
                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
//Atualiza os campos com os valores da consulta.
                            $("#cidade").prop('readonly', true);
                            $("#cidade").val(dados.localidade);

                            if(dados.logradouro == ""){
                                alert("Por favor preencha o formulário");
                                $("#cidade").prop('readonly', false);
                            }
                        }
                        else {
//CEP pesquisado não foi encontrado.
                            limpa_formulario_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                }
                else {
//cep é inválido.
                    limpa_formulario_cep();
                    alert("Formato de CEP inválido.");
                }
            }
            else {
//cep sem valor, limpa formulário.
                limpa_formulario_cep();
            }
        });
    });


</script>
