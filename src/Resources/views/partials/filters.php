<?php
function filterIsSet($field, $filter, $filterData)
{
    return isset($filterData) && array_key_exists($field, $filterData) && in_array($filter, $filterData[$field]);
}

?>

<div class="col-xs-3 col-sm-3">
    <div id="accordion" class="panel panel-primary behclick-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Filter de cautare</h3>
        </div>

        <form action="" method="post">
            <div class="panel-body">
                <div class="panel-heading ">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse0">
                            <i class="indicator fa fa-caret-down" aria-hidden="true"></i> Pret
                        </a>
                    </h4>
                </div>
                <div id="collapse0" class="panel-collapse collapse in">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="price[]"
                                        <?php if (filterIsSet('price', '0-100', $filterDates)) { ?>
                                            checked
                                        <?php } ?>
                                           value="0-100">
                                    0-100
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                        <?php if (filterIsSet('price', '100-200', $filterDates)) { ?>
                                            checked
                                        <?php } ?>
                                           name="price[]" value="100-200">
                                    100-200
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="price[]"
                                        <?php if (filterIsSet('price', '200-500', $filterDates)) { ?>
                                            checked
                                        <?php } ?>
                                           value="200-500">
                                    200-500
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="price[]"
                                        <?php if (filterIsSet('price', '500-1000', $filterDates)) { ?>
                                            checked
                                        <?php } ?>
                                           value="500-1000">
                                    500-1000
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="price[]"
                                        <?php if (filterIsSet('price', '1000-2000', $filterDates)) { ?>
                                            checked
                                        <?php } ?>
                                           value="1000-2000">
                                    1000-2000
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="panel-heading ">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">
                            <i class="indicator fa fa-caret-down" aria-hidden="true"></i>Alimentare plita
                        </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <ul class="list-group">
                        <?php foreach ($characteristics as $characteristic) { ?>
                            <?php if (strcasecmp($characteristic['name'], 'Alimentare plita') == 0) { ?>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="alimentarePlita[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (filterIsSet('alimentarePlita', $characteristic['value'], $filterDates)) { ?>
                                                    checked
                                                <?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse2">
                            <i class="indicator fa fa-caret-down" aria-hidden="true"></i>
                            Culoare
                        </a>
                    </h4>
                </div>

                <div id="collapse2" class="panel-collapse collapse in">
                    <ul class="list-group">
                        <?php foreach ($characteristics as $characteristic) { ?>
                            <?php if (strcasecmp($characteristic['name'], 'Culoare') == 0) { ?>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="culoare[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (filterIsSet('culoare', $characteristic['value'], $filterDates)) { ?>
                                                    checked
                                                <?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse3">
                            <i class="indicator fa fa-caret-down" aria-hidden="true"></i>
                            Numar arzatoare
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse in">
                    <ul class="list-group">
                        <?php foreach ($characteristics as $characteristic) { ?>
                            <?php if (strcasecmp($characteristic['name'], 'Numar arzatoare') == 0) { ?>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="nrArzatoare[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (filterIsSet('nrArzatoare', $characteristic['value'], $filterDates)) { ?>
                                                    checked
                                                <?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse4">
                            <i class="indicator fa fa-caret-down"
                               aria-hidden="true"></i> Aprindere electrica arzatoare</a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse in">
                    <ul class="list-group">
                        <?php foreach ($characteristics as $characteristic) { ?>
                            <?php if (strcasecmp($characteristic['name'], 'Aprindere electrica arzatoare') == 0) { ?>
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="aprindereElectrica[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (filterIsSet('aprindereElectrica', $characteristic['value'], $filterDates)) { ?>
                                                    checked
                                                <?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <input type="submit" name="submit" class="btn btn-default" value="Submit"/>
        </form>
    </div>
</div>


