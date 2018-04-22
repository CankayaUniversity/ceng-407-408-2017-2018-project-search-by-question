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

    $("#keyboardText").prop("disabled",true);

    $("input[name='optradio']").click(function () {

        $("#keyboardText").prop("disabled", false);
        var val = $(this).val();

        var textval = $("#keyboardText").val();

        $("#keyboardText").val(" ");
        $("#keyboardText").val(val + " " + $("#keyboardText").val());

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