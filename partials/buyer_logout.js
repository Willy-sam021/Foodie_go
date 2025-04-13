$(document).ready(function(){
    $('.logout').click(function(event){
        event.preventDefault()
        var x = confirm('are you sure you want to log out?')

        if(x==true){
            window.location.href="buyer_process/logout_buyer.php"
    }



    })
})
