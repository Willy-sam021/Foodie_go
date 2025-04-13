$(document).ready(function(){
    $('.logout').click(function(event){
        event.preventDefault()
        var x = confirm('are you sure you want to log out?')

        if(x==true){
            window.location.href="seller_process/logout_seller.php"
    }

    })
})
