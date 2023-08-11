/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 $("form").submit(function(){
    var form = this.form;
    var form_id= $(this).closest("form").attr('id');
    var url = './includes/conductor_persona.php?formulario='+form_id;
    $.ajax({
      type: $('#'+form_id).attr('method'),
      url: url,
      data: $('#'+form_id).serialize(), 
      success: function(data) {
        if(form_id=='form_perfil')
        {
 
        }
        
    }
     });
     return false;
});
