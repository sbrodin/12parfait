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
        <script type="text/javascript" src="<?= js_url('jquery.multi-select') ?>"></script>
        <script type="text/javascript" src="<?= js_url('jquery.datetimepicker.full.min') ?>"></script>
        <script type="text/javascript" src="<?= js_url('tether-1.3.3.min') ?>"></script>
        <script type="text/javascript" src="<?= js_url('bootstrap.4.0.0-alpha.4.min') ?>"></script>

        <script type="text/javascript" src="<?= js_url('script') ?>"></script>
    </body>
</html>

