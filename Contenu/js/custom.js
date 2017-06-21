// SmoothScrooling
$(document).ready(function() {
    $('.js-scrollTo').on('click', function() {
        var page = $(this).attr('href');
        var speed = 750; // Durée de l'animation (en ms)
        $('html, body').animate( { scrollTop: $(page).offset().top-100 }, speed ); // Go

        if($("#menu_icon").is(":visible")){
            $("#menu_icon").click();
        }
        return false;
    });
});

// Affichage du formulaire de contact après clic sur répondre (details articles)
$('button.repondre').click(function(){
    $(".formRepondre[data-to='"+$(this).data('to')+"']").show(0);
});

// Affichage tinymce

// fix tinymce bug
tinymce.init({
    selector: 'textarea.tinyMCE',
    setup: function (editor) {
        editor.on('change', function (e) {
            editor.save();
        });
    }
});

