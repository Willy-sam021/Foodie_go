$('#myform').submit(function(event){
        
    event.preventDefault()

    var text=$("#search").val()
    var filter=$('#filter').val()

    

    $.ajax({
      url:"process/process_search.php",
      method:"get",
      dataType:'text',
      data:{
        message:text,
        filter:filter,
        xyz:true
      },
      success:function(response){
       
        $('#searchshow').empty()
        $('#searchshow').append(response)
     },
      error:function(error){
        alert(error)
      }
      
    })

    
  })
