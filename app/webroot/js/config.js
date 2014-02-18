$(document).ready(function(){
    abreMenu();
    
    $('input[required="required"]').prev('label').addClass('required');
    
    /** Botões */
    $( 'a#bt_atualizar' ).click(function(){
       window.location = window.location;
    });
    $( 'a.bt_voltar' ).click(function(){
        if ($(this).attr('location')=='') {
            window.history.back();
        } else {
            window.location = $(this).attr('location');
        }
    });
    $( 'a.bt_salvar' ).click(function(){
        $('#after_action').val( $(this).attr('id') );
        $(this).closest('form').submit();
    });
    
    /** Formulário */
    $('form').submit(function() {
        var validate = true;
        $(this).find('input[required="required"]').each(function() {
            if ($(this).val()==''){
                validaCampo( $(this), false );
                validate = false;
            } else {
                validaCampo( $(this), true  );
            }
        });
        
        $(this).find('div.required').find('select').each(function() {
            if ($(this).val()=='') {
                validaCampo( $(this), false  );
                validate = false;
            } else {
                validaCampo( $(this), true  );
            }
        });
        
        if (!validate) { dialog('Erro', 'Favor verificar os campos inválidos.'); };
        return validate;
    });
            
    $( 'input.datepicker' ).dp({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd/mm/yy', 
        altFormat: 'yy-mm-dd'
    });
    
    $( 'input[required="required"]' ).change(function() {
        if ($(this).val()==''){
            validaCampo( $(this), false );
        } else {
            validaCampo( $(this), true );
        }
    });
    $('div.required').find('select').change(function() {
        if ($(this).val()=='') {
            validaCampo( $(this), false  );
            validate = false;
        } else {
            validaCampo( $(this), true  );
        }
    });
    $( 'input.email' ).change(function() {
        if (!validaEmail($(this).val())){
            validaCampo( $(this), false, 'E-mail inválido.' );
            $(this).val('');
        } else {
            validaCampo( $(this), true );
        }
    });
    
    
    $( 'input[type="number"]' ).keypress(function(evt){
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        var arr_allow = new Array(8, 13, 27, 35, 36, 37, 39, 46);
        if ( jQuery.inArray( key, arr_allow ) < 0  ) {
            key = String.fromCharCode( key );
            var regex = /[0-9]/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    });
    $( "input.cpf" )
        .mask("999.999.999-99")
        .change(function(){
          if (!validaCPF( $(this).val() )) {
            validaCampo( $(this), false, 'CPF inválido.' );
          } else {
            validaCampo( $(this), true );
          }
    });
    $( "input.cnpj" ).mask("99.999.999/9999-99");
    $( "input.cep" )
        .mask("99999-999")
        .change(function(){
            if ($(this).val() != "") {
                var name_search = $(this).attr('name').replace('[cep]','');
    			endereco = buscaEndereco( $(this).val() );
                if (endereco) {                    
                    $(this).closest('form').find( 'input[name="'+ name_search + '[endereco]"]' ).val( endereco.logradouro );
                    $(this).closest('form').find( 'input[name="'+ name_search + '[bairro]"]' ).val( endereco.bairro );
                    $(this).closest('form').find( 'input[name="'+ name_search + '[cidade]"]' ).val( endereco.cidade );
                    $(this).closest('form').find( 'select[name="'+ name_search + '[estado]"]' ).val( endereco.uf );
                } else {
                    dialog('Erro', 'Não foi possível localizar este CEP em nosso sistema.');
                }	
    		}	
        });
	$( "input.telefone" ).mask("(99) 9999-9999");
    
    $('a.confirmLink').click(function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        
        $('#dialog_system_confirm').html( 'Deseja confirmar esta operação?' );
    	$('#dialog_system_confirm').dialog({
    		autoOpen: false,
    		title: "Atenção",
    		bgiframe: true,
    		modal: true,
    		resizable: false,
    		draggable: false,
            open: function(event,ui){
                $(this).closest('div.ui-dialog').find('button').addClass('btn');
                $(this).closest('div.ui-dialog').find('button.ui-dialog-titlebar-close').addClass('entypo-icon-cancel ');
            },
    		buttons: {
    			'Ok': function() {
    			     window.location = url;
    				$(this).dialog('close');
    			},
                'Cancelar': function() {
    				$(this).dialog('close');
    			}
    		}
    	 });
    	 $('#dialog_system_confirm').dialog('open');
    });
    
        
    $('dl').find('#marcar_todos').click(function(){
        if ($(this).is(':checked')) {
            $(this).parents('dl').find('input[type="checkbox"]').attr('checked', true);
        } else {
            $(this).parents('dl').find('input[type="checkbox"]').attr('checked', false);
        }
        $.uniform.update();
    });
    $('dl').find('.marcar_todos').click(function(){
        if ($(this).is(':checked')) {
            $(this).parents('dd').next('div').find('input[type="checkbox"]').not(':checked').each(function(){
                $(this).trigger('click');
            });
        } else {
            $(this).parents('dd').next('div').find('input[type="checkbox"]:checked').each(function(){
                $(this).trigger('click');
            });
        }
        $.uniform.update();
    });
    
    
	$("div.dialog button").addClass("btn");
    
});