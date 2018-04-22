$(document).ready(function () {

    /*
            $('#keyboardText').mlKeyboard({
                layout: 'en_US',
                active_shift: true,
                active_caps: false,
                trigger: '#keyforinput',
                is_hidden: true,
            });
    */
    $('[data-toggle="tooltip"]').tooltip();

    $("#keyboardText").prop("disabled", true);

    $("input[name='optradio']").click(function () {

        $("#keyboardText").prop("disabled", false);
        var val = $(this).val();

        var textval = $("#keyboardText").val().trim();

        $("#keyboardText").val("");
        $("#keyboardText").val(val + " " + $("#keyboardText").val().trim());

        if (textval.trim() != null) {
            suggest();
        }


    });

    if ($("#keyboardText").length > 0) {
        $("#keyboardText").bind("keypress", suggest);

        function suggest(e) {
            if ($("#keyboardText").val().trim().length > 1) {
                var allSuggs = [];
                var words = $("#keyboardText").val().trim().split(" ");
                $.each(words, function (index, value) {
                    $.ajax({
                        url: "/suggestions", data: {"word": value}, success: function (result) {
                            allSuggs.push(result);
                            if (index == words.length - 1) {
                                $("#suggestions").html("");
                                for (i = 0; i < 5; i++) {
                                    var kelime = "";
                                    var link = "";
                                    for (j = 0; j <= words.length - 1; j++) {
                                        kelime = kelime + " " + allSuggs[j][i];
                                    }
                                    kelime = kelime.trim();
                                    if (kelime.search("undefined") < 0) {
                                        $("#suggestions").append('<li><a href="/result?soru=' + kelime + '">' + kelime + '</a><li>');
                                    }
                                }
                                $("#suggestions a").click(sendToInput);
                            }
                        }
                    });
                });
            } else {
                $("#suggestions").html("");
            }
        }

        function sendToInput(e) {
            e.preventDefault();
            $("#keyboardText").val($(this).text());
            return false;
        }
    }


});

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

function openModal(title,body) {
    $(".modal-body").html("");
    $("#modalLabel").html("");

    $(".modal-body").html(body);
    $("#modalLabel").html(title);
    $("#Modal").modal();

}

function sendQuestion() {

    var text = $("#keyboardText").val().trim();
    text = text.toUpperCase();

    if (text != "") {

        if(checkIsQuestion(text) === true){

            var data = {
                question : text,
                token : params.token
            };

            var dataString = "data="+encodeURIComponent(JSON.stringify(data));


            $.ajax({
                type: "post",
                dataType: 'json',
                url: params.site + "test-tools/nlu-connection-tool/test_nlu_model.php",
                data: dataString,
                success: function (data) {
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