function checkIsQuestion(query) {
    var status = false;
    var question = query.trim().split(" ");
    var qlen = question.length;
    var questions = ["WHAT","WHERE","WHICH","WHY","WHO","HOW"];
    var i = 0; var k;
    while(i<questions.length){
        for(k=0;k<question.length;k++){
            if(questions[i] == question[k]){
                status = true;
            }
        }
        i++;
    }

    return status;
}

function sendQuestion() {
    var text = $("#keyboardText").val().trim();
    text1 = text.toUpperCase();

    if (text != "") {

        if(checkIsQuestion(text1) === true){
            $(".loadergif").toggle("slow");

            var data = {
                question : text,
                token : params.token
            };

            var dataString = "data="+encodeURIComponent(JSON.stringify(data));


            $.ajax({
                type: "post",
                dataType: 'json',
                url: params.site + "controllers/ProcessController.php",
                data: dataString,
                success: function (data) {
                    $(".loadergif").hide("slow");
                    console.log(data);

                }
            });
        }else{
            openModal("Warning","Please choose a question type!");
        }

    } else {
        openModal("Warning","Please enter a question!");
    }


}