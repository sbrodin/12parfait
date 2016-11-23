console.log('-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-');
console.log('*  .   __. .__. .__. .__. .__. .__.  _._  ___ *');
console.log('- /|     | |  | |  | |  | |    |  |   |    |  -');
console.log('*  |  .__| |__| |__| |__| |__  |__|   |    |  *');
console.log('-  |  |    |    |  | | \\  |    |  |   |    |  -');
console.log('* _|_ |__. |    |  | |  \\ |    |  |  _|_   |  *');
console.log('-                                             -');
console.log('*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*');
console.log('%c 12parfait ', 'background: #0275D8; color: #FFFFFF; font-size: 40px; font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;');

$('.alert').alert();

$('#teams').multiSelect({
    selectableFooter: "<div class='custom-header'>Nombre : <span class='nb-equipes'>0</span></div>",
    selectionFooter: "<div class='custom-header'>Nombre : <span class='nb-equipes'>0</span></div>",
    afterSelect: function(values){
        update_nb_equipes();
    },
    afterDeselect: function(values){
        update_nb_equipes();
    }
});
update_nb_equipes();
function update_nb_equipes() {
    $('.ms-selectable .nb-equipes').html($('.ms-selectable li:not(.ms-selected)').length);
    $('.ms-selection .nb-equipes').html($('.ms-selection .ms-selected').length);
}

$('.form-players-filter-users').multiSelect();

$.datetimepicker.setLocale('fr');
$('.match_date').datetimepicker({
    dayOfWeekStart: 1,
    format:'d/m/Y H:i',
    allowTimes:[
        '15:00', '17:00', '20:00', '20:45'
    ],
});

$('a.del-team').on('click', function() {
    $this = $(this);
    var href = $this.data('linkdelteam');
    $.ajax({
        type:'POST',
        url:href,
        success:function(data){
            $this.parents('tr').find('td a').remove();
        }
    });
});

$('.home-table tr, .score-table tr, .message-table tr').on('click', function() {
    window.location = $(this).data('href');
});

/**
  * Fonction de gestion du profiler
  */
document.addEventListener("DOMContentLoaded", function(event) {
    if(document.getElementById("profiler-close")) {
        document.getElementById("profiler-close").addEventListener("click", function(event) {
            document.getElementById("codeigniter-profiler").style.display = "none";
        });
    }
});


// Gestion des filtres
change_championships_from_fixture($('.form-bets-filter-fixture'), 'bets');
change_championships_from_fixture($('.form-scores-filter-fixture'), 'scores');
$('.form-bets-filter-fixture, .form-scores-filter-fixture').on('change', function() {
    console.log('page');
    change_championships_from_fixture($(this), $(this).data('filter-page'));
});

function change_championships_from_fixture(filter, page) {
    $('.form-scores-filter-championship option, .form-bets-filter-championship option').show();
    var selected_fixture = filter.val();
    if (selected_fixture != 0) {
        var selected_fixtures_championship = filter.find('option[value="' + selected_fixture + '"]').data('championship-id');
        if (page == 'bets') {
            $('.form-bets-filter-championship :not(option[value="' + selected_fixtures_championship + '"])').hide();
            $('.form-bets-filter-championship option[value="0"]').show();
        } else if (page == 'scores') {
            $('.form-scores-filter-championship :not(option[value="' + selected_fixtures_championship + '"])').hide();
            $('.form-scores-filter-championship option[value="0"]').show();
        }
    }
}

change_fixtures_from_championship($('.form-bets-filter-championship'), 'bets');
change_fixtures_from_championship($('.form-scores-filter-championship'), 'scores');
$('.form-bets-filter-championship, .form-scores-filter-championship').on('change', function() {
    change_fixtures_from_championship($(this), $(this).data('filter-page'));
});

function change_fixtures_from_championship(filter, page) {
    $('.form-scores-filter-fixture option, .form-bets-filter-fixture option').show();
    var selected_championship = filter.val();
    if (selected_championship != 0) {
        if (page == 'bets') {
            $('.form-bets-filter-fixture :not(option[data-championship-id="' + selected_championship + '"])').hide();
            $('.form-bets-filter-fixture option[value="0"]').show();
        } else if (page == 'scores') {
            $('.form-scores-filter-fixture :not(option[data-championship-id="' + selected_championship + '"])').hide();
            $('.form-scores-filter-fixture option[value="0"]').show();
        }
    }
}