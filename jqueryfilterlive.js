$(document).ready(function(){  
    
      $(function(){  
          $('#txtstartdate').datepicker();  
          $('#txtenddate').datepicker();
      });  
      $('#search').click(function(){  
            
           var txtstartdate = $('#txtstartdate').val();  
           var txtenddate = $('#txtenddate').val();  
           if(txtstartdate != '' && txtenddate != '')  
           {  
                    $.ajax({  
                         type:"POST",  
                         url:"filter.php",  
                         data:{txtstartdate,
                              txtenddate},  
                         success:function(data)  
                         {  
                              $('#order_table').html(data);  
                         }  
                    });  
           }  
           else  
           {  
                alert("Please Select Date");  
           }  
      });  
 });  
 