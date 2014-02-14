(function( $ ) {
    /** Datepicker + Mask */
    $.widget( "ui.dp", {
            _create: function() {
                var el = this.element.hide();
                this.options.altField = el;
                var input = this.input = $('<input type="text">').insertBefore( el )
                input.addClass( el.attr('class') );
                input.focusout(function(){
                    if(input.val() == ''){
                        el.val('');
                    } else if (!validateDate(input.val())) {
                        input.val('');
                        el.val('');
                    }
                });
                input.datepicker(this.options).mask('99/99/9999');
                if(convertDate(el.val()) != null){
                    this.input.datepicker('setDate', convertDate(el.val()));
                }
            },
            destroy: function() {
                this.input.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
    });
    
    var convertDate = function(date){
      if(typeof(date) != 'undefined' && date != null && date != ''){
        var parts = date.match(/(\d+)/g);
        return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
      } else {
        return null;
      }
    }
    
    var validateDate = function(date){
        var comp = date.split('/');
        var d = parseInt(comp[0], 10);
        var m = parseInt(comp[1], 10);
        var y = parseInt(comp[2], 10);
        var date = new Date(y,m-1,d);        
        return (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d);
    }
    
    // Valida extensão
    $.fn.hasExtension = function(exts) {
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test( $(this).val().toLowerCase() );
    }
})( jQuery );