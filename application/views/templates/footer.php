                </div>
            </div>
        </div>
        <footer>
            <?php if (is_connected()) : ?>
                <span class="m-r-2"><a href="<?= site_url('contact') ?>"><?= $this->lang->line('contact') ?></a></span>
            <?php endif; ?>
            <span class="m-r-2"><?= $this->lang->line('copyright') ?></span>
            <span class="m-r-2"><?= $this->lang->line('generated_with') ?></span>
            <span><?= $this->lang->line('version') ?></span>
        </footer>
        <script type="text/javascript" src="<?= js_url('jquery-3.1.0.min') ?>"></script>
        <script type="text/javascript" src="<?= js_url('tether-1.3.3.min') ?>"></script>

        <script type="text/javascript" src="<?= js_url('bootstrap.4.0.0-alpha.4.min') ?>"></script>
        <script type="text/javascript">
            $('.alert').alert();
        </script>

        <script type="text/javascript" src="<?= js_url('jquery.multi-select') ?>"></script>
        <script type="text/javascript">
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
        </script>

        <!-- code js pour calendrier -->
        <script type="text/javascript" src="<?= js_url('jquery.datetimepicker.full.min') ?>"></script>
        <script type="text/javascript">
            $.datetimepicker.setLocale('fr');
            $('.match_date').datetimepicker({
                dayOfWeekStart: 1,
                format:'d/m/Y H:i',
                allowTimes:[
                    '15:00', '17:00', '20:00', '20:45'
                ],
            });
        </script>

        <script type="text/javascript">
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
        </script>
    </body>
</html>

