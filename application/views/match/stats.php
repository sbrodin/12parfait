<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url() ?>"><?= $this->lang->line('back_to_home') ?></a><br/>
<a class="btn btn-sm btn-secondary m-b-2" href="<?= site_url('bets') ?>"><?= $this->lang->line('back_to_bets_index') ?></a><br/>

<h4><?= $match_infos['team1'].' - '.$match_infos['team2'] ?></h4>
<h5 class="m-b-1"><?= $match_infos['championship_name'] ?></h5>
<h6 class="m-b-1"><?= $match_infos['fixture_name'] ?></h6>

<?php if (isset($info) && !empty($info)) : ?>
    <span class="alert alert-success d-inline-block" role="alert"><?= $info ?></span>
    <?php if (isset($bets_info) && !empty($bets_info)) : ?>
        <div><?= $bets_info ?></div>
    <?php endif ?>
<?php else : ?>
    <hr/>
    <h5 class="chart-legend d-inline-block"><?= $this->lang->line('result_distribution').' :' ?></h5>
    <canvas id="result-chart"></canvas>
    <hr/>
    <h5 class="chart-legend d-inline-block"><?= $this->lang->line('goals_bet_count').' :' ?></h5>
    <canvas id="goals-chart"></canvas>
    <hr/>
    <h5 class="chart-legend d-inline-block"><?= $this->lang->line('average_goals_bet').' :' ?></h5>
    <canvas id="average-goals-chart"></canvas>

    <script type="text/javascript" src="<?= js_url('chart.2.3.0.min') ?>"></script>
    <script type="text/javascript">
        var resultContext = document.getElementById('result-chart');
        var resultChart = new Chart(resultContext, {
            type: 'bar',
            data: {
                labels: [
                    "<?= $this->lang->line('home_victory_count') ?>",
                    "<?= $this->lang->line('draw_count') ?>",
                    "<?= $this->lang->line('away_victory_count') ?>",
                ],
                datasets: [{
                    data: [
                        <?= $result_stats['1'] ?>,
                        <?= $result_stats['N'] ?>,
                        <?= $result_stats['2'] ?>,
                    ],
                    backgroundColor: [
                        '#5FC44A',
                        '#FBF037',
                        '#60A8D3',
                    ],
                }],
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                       label: function(tooltipItem) {
                              return tooltipItem.yLabel;
                       }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        });
        var goalsContext = document.getElementById('goals-chart');
        var goalsChart = new Chart(goalsContext, {
            type: 'bar',
            data: {
                labels: [
                    "<?= $this->lang->line('home_goals_count') ?>",
                    "<?= $this->lang->line('away_goals_count') ?>",
                ],
                datasets: [{
                    data: [
                        <?= ($goals_for_stats) ?>,
                        <?= ($goals_against_stats) ?>,
                    ],
                    backgroundColor: [
                        '#7FE46A',
                        '#80C8F3',
                    ],
                }],
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                       label: function(tooltipItem) {
                              return tooltipItem.yLabel;
                       }
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        });
        var averageGoalsContext = document.getElementById('average-goals-chart');
        var averageGoalsChart = new Chart(averageGoalsContext, {
            type: 'bar',
            data: {
                labels: [
                    "<?= $this->lang->line('average_home_goals_count') ?>",
                    "<?= $this->lang->line('average_away_goals_count') ?>",
                ],
                datasets: [{
                    data: [
                        Math.round(<?= $goals_for_stats/$bets_number?> * 100) / 100,
                        Math.round(<?= $goals_against_stats/$bets_number?> * 100) / 100,
                    ],
                    backgroundColor: [
                        '#7FE46A',
                        '#80C8F3',
                    ],
                }],
            },
            options: {
                legend: {
                    display: false,
                },
                tooltips: {
                    callbacks: {
                       label: function(tooltipItem) {
                              return tooltipItem.yLabel;
                       },
                    },
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            beginAtZero: true,
                        },
                    }]
                }
            }
        });
    </script>
<?php endif ?>