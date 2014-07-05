$('#mcr_information_issueDate').datepicker({dateFormat: 'yy-mm-dd'});
$('#mcr_information_returnDate').datepicker({dateFormat: 'yy-mm-dd'});
 
 
  function searchCustomer(searchString)
  {
      $.ajax({
          type:  "get",
          async: "false",
          url:  "mcr_information/searchCustomer",
          data:{searchString:searchString},
          dataTypr: "json",
          success : function(data)
          {
              if(data!='')
                  {
                  	alert(data);
                      $('#customerList').html("");
                      $.each(data, function (index, value) {
                          var eachrow = "<tr>" 
                         + "<td>" + value.parentCustomer + "</td>"
                         + "<td>" + value.parentMcr + "</td>"
                         + "<td>" + value.issueDate + "</td>"
                         + "<td>" + value.status + "</td>"
                         + "<td>" + value.receivedBy + "</td>"
                         + "<td>" + value.returnDate + "</td>"
                         + "<td>" + value.type + "</td>"
                         + "</tr>";
                         $('#customerList').append(eachrow);
                          
                      });
                  }
          },
          error: function()
          {
              alert('Error loading product list');
                return false;
          }
          
      });
  }
  