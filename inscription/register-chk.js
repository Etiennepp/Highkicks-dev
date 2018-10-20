function CheckParameters() {
    isValidEmailAddress($("#input-15").val()) ? $("#mail-error").css("display", "none") : $("#mail-error").css("display", "block"), $("#input-13").val() !== $("#input-14").val() ? $("#passsword-error").css("display", "block") : $("#passsword-error").css("display", "none"), $("#input-16").val() ? $("#adresse-error").css("display", "none") : $("#adresse-error").css("display", "block"), $("#input-17").val() ? $("#codezip-error").css("display", "none") : $("#codezip-error").css("display", "block"), $("#input-18").val() ? $("#ville-error").css("display", "none") : $("#ville-error").css("display", "block"), isValidEmailAddress($("#input-15").val()) && $("#input-13").val() === $("#input-14").val() && $("#street_number").val() && $("#route").val() && $("#locality").val() && $("#postal_code").val() && $("#country").val() && $.ajax({
            type: "post",
            url: "inscription-action.php",
            data: $(".content").serialize(),
            success: function(s) {
                "erreur_champs" == $.trim(s) && alert("Veuillez remplir tous les champs ou verifier votre adresse"), "bad_values" == $.trim(s) && alert("Valeurs non conformes, veuillez réessayer dans quelques instants. Si le problème persiste, contactez les administrateurs sur l'adresse suivante : support@highkicks.fr"), "erreur_double" == $.trim(s) && alert("Ce pseudo est déjà utilisé !"), "success" == $.trim(s) && (alert("Inscription réussie, appuyez sur OK pour revenir à l'accueil"), window.location.replace("https://highkicks.fr/"))
            }
        }
    }