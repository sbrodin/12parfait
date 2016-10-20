console.log('-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-');
console.log('*  .   __. .__. .__. .__. .__. .__.  _._  ___ *');
console.log('- /|     | |  | |  | |  | |    |  |   |    |  -');
console.log('*  |  .__| |__| |__| |__| |__  |__|   |    |  *');
console.log('-  |  |    |    |  | | \\  |    |  |   |    |  -');
console.log('* _|_ |__. |    |  | |  \\ |    |  |  _|_   |  *');
console.log('-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-');

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

$.datetimepicker.setLocale('fr');
$('.match_date').datetimepicker({
    dayOfWeekStart: 1,
    format:'d/m/Y H:i',
    allowTimes:[
        '15:00', '17:00', '20:00', '20:45'
    ],
});

$('a.del-team').on('click', function() {
    var href = $(this).data('linkdelteam');
    $.ajax({
        type:'POST',
        url:href,
        success:function(data){
            $(this).parents('tr').find('td a').remove();
        }
    });
});

$('.home-table tr, .score-table tr').on('click', function() {
    window.location = $(this).data('href');
});

/**
  * Fonction de gestion du profiler
  */
document.addEventListener("DOMContentLoaded", function(event) {
    if(document.getElementById("profiler_close")) {
        document.getElementById("profiler_close").addEventListener("click", function(event) {
            document.getElementById("codeigniter_profiler").style.display = "none";
        });
    }
});

change_championships_from_fixture($('.form-scores-filter-fixture'));
$('.form-scores-filter-fixture').on('change', function() {
    change_championships_from_fixture($(this));
});

function change_championships_from_fixture(filter) {
    $('.form-scores-filter-championship option').show();
    var selected_fixture = filter.val();
    if (selected_fixture != 0) {
        var selected_fixtures_championship = filter.find('option[value="' + selected_fixture + '"]').data('championship-id');
        $('.form-scores-filter-championship :not(option[value="' + selected_fixtures_championship + '"])').hide();
    }
}

change_fixtures_from_championship($('.form-scores-filter-championship'));
$('.form-scores-filter-championship').on('change', function() {
    change_fixtures_from_championship($(this));
});

function change_fixtures_from_championship(filter) {
    $('.form-scores-filter-fixture option').show();
    var selected_championship = filter.val();
    if (selected_championship != 0) {
        $('.form-scores-filter-fixture :not([data-championship-id="' + selected_championship + '"])').hide();
    }
}