<a href="<?php echo site_url('admin') ?>"><?php echo $this->lang->line('back_to_site_admin') ?></a><br/>
<a href="<?php echo site_url('admin/championships') ?>"><?php echo $this->lang->line('back_to_championships_admin') ?></a><br/>
<?php echo validation_errors(); ?>

<?php
// var_dump($championship_teams);
foreach ($teams as $key => $team) :
    // var_dump($team->team_id);
    // var_dump(array_search($team->team_id, $championship_teams)) ? 'selected' : '';
endforeach;
?>

<?php echo form_open('admin/championships/edit/'.$championship->championship_id); ?>
    <label for="championship_name"><?php echo $this->lang->line('championship_name') ?> : </label><input type="text" id="championship_name" name="championship_name" value="<?php echo $championship->name ?>" required="required">
    <label for="sport"><?php echo $this->lang->line('sport') ?> : </label>
    <select id="sport" name="sport" required="required">
        <option value="<?php echo strtolower($this->lang->line('football')) ?>"><?php echo $this->lang->line('football') ?></option>
    </select>
    <label for="country"><?php echo $this->lang->line('country') ?> : </label>
    <select id="country" name="country" required="required">
        <option value="<?php echo strtolower($this->lang->line('france')) ?>"><?php echo $this->lang->line('france') ?></option>
    </select>
    <label for="level"><?php echo $this->lang->line('level') ?> : </label>
    <select id="level" name="level" required="required">
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
    <label for="year"><?php echo $this->lang->line('year') ?> : </label><input type="number" id="year" name="year" value="<?php echo $championship->year ?>" required="required" min="2015"><br/>
    <select id="teams" name="teams[]" multiple>
        <?php
        foreach ($teams as $key => $team) :
        ?>
            <option value="<?php echo $team->team_id ?>" <?php echo (array_search($team->team_id, $championship_teams)) ? 'selected' : '' ?> ><?php echo $team->name ?></option>
        <?php
        endforeach;
        ?>
    </select><br/>
    <input type="submit" value="<?php echo $this->lang->line('confirm') ?>">
</form>

<script type="text/javascript" src="<?php echo js_url('jquery-3.1.0.min') ?>"></script>
<script type="text/javascript" src="<?php echo js_url('jquery.multi-select') ?>"></script>
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
