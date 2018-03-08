                </div>
            </div>
        </div>
        <footer>
            <?php if (is_connected()) : ?>
                <!-- <span class="m-r-2"><a href="<?= site_url('contact') ?>"><?= $this->lang->line('contact') ?></a></span> -->
            <?php endif; ?>
            <span class="m-r-2"><a href="https://stanislas-brodin.fr" rel="author"><?= $this->lang->line('copyright') ?></a></span>
            <span class="m-r-2"><?= $this->lang->line('generated_with') ?></span>
            <span><?= $this->lang->line('version') ?></span>
        </footer>

        <script type="text/javascript" src="<?= js_url('script.min') ?>"></script>
    </body>
</html>