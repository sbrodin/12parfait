<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back') ?></a><br/>
<?php if (!empty($info)) : ?>
    <span><?= $info ?></span>
<?php else : ?>
    <div class="card card-block card-scores col-md-6">
        <h1 class="card-title">
            <span><?= $scores[0]->first_name ?></span> <span><?= $scores[0]->last_name ?></span>
        </h1>
        <h2 class="card-title">
            <span><?= $scores[0]->user_name ?></span> - <span><?= $scores[0]->total_score.$this->lang->line('points_short') ?></span>
        </h2>
        <hr/>
        <?php if ($required_user_id === $my_user_id) : ?>
            <div class="scores-chart-legend"><?= sprintf($this->lang->line('stats_on_x_bets'), $total_bets) ?></div>
        <?php else : ?>
            <div class="scores-chart-legend"><?= sprintf($this->lang->line('stats_on_x_bets_player'), $total_bets) ?></div>
        <?php endif; ?>
        <canvas id="scores-chart" width="200" height="200"></canvas>
        <hr/>
        <?php if ($required_user_id === $my_user_id) : ?>
            <div class="scores-chart-legend"><?= sprintf($this->lang->line('stats_on_x_points'), $scores[0]->total_score) ?></div>
        <?php else : ?>
            <div class="scores-chart-legend"><?= sprintf($this->lang->line('stats_on_x_points_player'), $scores[0]->total_score) ?></div>
        <?php endif; ?>
        <canvas id="scores-chart2" width="200" height="200"></canvas>
    </div>
<?php endif; ?>

<script type="text/javascript" src="<?= js_url('chart.2.3.0.min') ?>"></script>
<script type="text/javascript">
    var ctx = document.getElementById('scores-chart');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                "<?= $this->lang->line('scores_0_points') ?>",
                "<?= $this->lang->line('scores_3_points') ?>",
                "<?= $this->lang->line('scores_4_points') ?>",
                "<?= $this->lang->line('scores_6_points') ?>",
                "<?= $this->lang->line('scores_7_points') ?>",
                "<?= $this->lang->line('scores_12parfait') ?>",
            ],
            datasets: [{
                data: [
                    <?= $scores_0 ?>,
                    <?= $scores_3 ?>,
                    <?= $scores_4 ?>,
                    <?= $scores_6 ?>,
                    <?= $scores_7 ?>,
                    <?= $scores_12 ?>,
                ],
                backgroundColor: [
                    '#FF0000',
                    '#FF4000',
                    '#FF8000',
                    '#FFBF00',
                    '#99FF33',
                    '#339933',
                ],
                // hoverBackgroundColor: [
                //     '#FF6384',
                //     '#36A2EB',
                //     '#FFCE56',
                // ],
            }],
        },
    });
    var ctx2 = document.getElementById('scores-chart2');
    var myChart2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: [
                "<?= $this->lang->line('scores_3_points') ?>",
                "<?= $this->lang->line('scores_4_points') ?>",
                "<?= $this->lang->line('scores_6_points') ?>",
                "<?= $this->lang->line('scores_7_points') ?>",
                "<?= $this->lang->line('scores_12parfait') ?>",
            ],
            datasets: [{
                data: [
                    <?= $scores_3 ?>*3,
                    <?= $scores_4 ?>*4,
                    <?= $scores_6 ?>*6,
                    <?= $scores_7 ?>*7,
                    <?= $scores_12 ?>*12,
                ],
                backgroundColor: [
                    '#FF4000',
                    '#FF8000',
                    '#FFBF00',
                    '#99FF33',
                    '#339933',
                ],
                // hoverBackgroundColor: [
                //     '#FF6384',
                //     '#36A2EB',
                //     '#FFCE56',
                // ],
            }],
        },
    });
</script>

<div class="clearfix"></div>