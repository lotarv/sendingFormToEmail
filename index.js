function sendData(){
    let fullname = $("#fullname").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    $.ajax({
        url: 'mail.php',
        type: "POST",
        data: {
            fullname: fullname,
            email: email,
            phone: phone
        },
        success: function(response){
            $('.response').html("Спасибо! Мы обязательно сважемся с вами!"); 
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.error(textStatus, errorThrown);
        }
    })
}

$(document).ready(function() {
    $(".submitBtn").click(function(e) {
        e.preventDefault();
        sendData();
        console.log('clicked');
    })
})