jQuery(document).ready(function($) {


        getContatos();

        var pathname = window.location.pathname;
        if(pathname != "/sobre"){
            $(".page-footer").show();
        }


        function getContatos() {

            $("#contacts").empty();

            var getData = $.ajax({
                method : "GET",
                url: '/contact/get',
                dataType:"json",
            });

            getData.done(function (e) {

                var table = "<thead><tr><th style='text-align: center'>ID</th><th style='text-align: center'  >Nome</th><th style='text-align: center' >Sobrenome</th><th style='text-align: center' >Endereço</th><th style='text-align: center' style='text-align: center'>Açoes</th></tr></thead>";

                for(var k in e) {

                    table += '<tr>' +
                             '<td scope="row" style="text-align: center">'+e[k].id+'</td>';
                    table += '<td style="text-align: center" id="nome_'+e[k].id+'">'+e[k].nome+'</td>';
                    table += '<td style="text-align: center" id="sobre_nome_'+e[k].id+'">'+e[k].sobre_nome+'</td>';
                    table += '<td style="text-align: center" id="endereco_'+e[k].id+'">'+e[k].endereco+'</td>';
                    table += '<td style="text-align: center" >' +
                             '<button class="btn waves-effect waves-light  blue darken-1 edit-class" id="'+e[k].id+'">Editar<i class="material-icons right">edit</i></button>' +
                             '<button class="btn waves-effect waves-light red delete_class" id="'+e[k].id+'">Excluir<i class="material-icons right">delete</i></button>' +
                                                            '</td></tr>';
                }

                table +='</tbody>';
                $('#contacts').html(table);



                $(".edit-class").click(function () {

                    var id = $(this).attr('id');

                    var objectEdit = {
                        id : $(this).attr('id'),
                        nome :  $("#nome_"+id).html(),
                        sobre_nome :  $("#sobre_nome_"+id).html(),
                        endereco :  $("#endereco_"+id).html()
                    };

                    $('#form_id').val(objectEdit.id);
                    $('#form_nome').val(objectEdit.nome);
                    $("#form_sobre_nome").val(objectEdit.sobre_nome);
                    $("#form_endereco").val(objectEdit.endereco);
                });

                $(".delete_class").click(function () {

                    var id = $(this).attr('id');
                    $.ajax({
                        type:'POST',
                        url : '/contact/delete',
                        data:'delete_id='+id,
                        success:function() {
                                $('#modal').openModal();
                                $("#mensagem").empty();
                                $("#mensagem").html("Contato excluido com sucesso.");
                                getContatos();
                        }
                    });

                });
            })

        }




        $( "#form_create" ).submit(function( event ) {

            event.preventDefault();

            if(!validateForm()){
                return;
            }


            if(!$("#form_id").val()){

                var request =  $.ajax({
                    method : "POST",
                    url: '/contact/create',
                    data : $(this).serialize(),
                });

                request.done(function(e){

                    $( "#form_create" ).each(function () {
                        this.reset();
                    });
                    $('#modal').openModal();

                    $("#mensagem").empty();
                    $("#mensagem").html("Contato inserido com sucess");
                    getContatos();

                });
                request.fail(function(e){
                    console.log("fail");
                });

            } else {

                var request =  $.ajax({
                    method : "POST",
                    url: '/contact/update',
                    data : $(this).serialize(),

                });

                request.success(function(data){
                    $( "#form_create" ).each(function () {
                        this.reset();
                    });

                    console.log(data);
                    $('#modal').openModal();
                    $("#mensagem").empty();
                    $("#mensagem").html(data);

                    getContatos();

                });
                request.fail(function(data){
                    console.log("fail",data);
                });
            }

        });


        function  validateForm() {

            var validate = true;

            var msg = "";

            if(!$("#form_nome").val()){
                console.log($("#form_nome").val());
                validate  = false;
                msg += "*Informe o nome.<br>";
            }


            if(!$("#form_sobre_nome").val()){
                validate  = false;
                msg += "*Informe o sobrenome.<br>";
            }


            if(!$("#form_endereco").val()){
                validate  = false;
                msg += "*Informe o endereço.";
            }

            if(!validate) {
                $('#modal').openModal();
                $("#mensagem").empty();
                $("#mensagem").html(msg);
                msg = null;
                return;
            }

            return validate;

        }


});


