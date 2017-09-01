<div class="col-xs-3 col-sm-3">
    <div id="accordion" class="panel panel-primary behclick-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Filter de cautare</h3>
        </div>

        <form action="filters" method="post">
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
                                    <input type="checkbox" name="price[]" value="0-100"
                                        <?php if (array_key_exists('price', $filterDates) && in_array("0-100", $filterDates['price'])) { ?> checked<?php } ?>>
                                    0-100
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="price[]" value="100-200"
                                        <?php if (array_key_exists('price', $filterDates) && in_array("100-200", $filterDates['price'])) { ?> checked<?php } ?>>
                                    100-200
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="price[]" value="200-500"
                                        <?php if (array_key_exists('price', $filterDates) && in_array("200-500", $filterDates['price'])) { ?> checked<?php } ?>>
                                    200-500
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="price[]" value="500-1000"
                                        <?php if (array_key_exists('price', $filterDates) && in_array("500-1000", $filterDates['price'])) { ?> checked<?php } ?>>
                                    500-1000
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="price[]" value="1000-2000"
                                        <?php if (array_key_exists('price', $filterDates) && in_array("1000-2000", $filterDates['price'])) { ?> checked<?php } ?>>
                                    1000-2000
                                </label>
                            </div>
                        </li>
                        <!--                        <li class="list-group-item">-->
                        <!--                            <div class="checkbox">-->
                        <!--                                <label>-->
                        <!--                                    <input type="checkbox" name="price[]" value=">2000">-->
                        <!--                                    >2000-->
                        <!--                                </label>-->
                        <!--                            </div>-->
                        <!--                        </li>-->
                    </ul>
                </div>

                <div class="panel-heading ">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse1">
                            <i class="indicator fa fa-caret-down" aria-hidden="true"></i>Alimentare plita
                        </a>
                    </h4>
                </div>
                <?php foreach ($characteristics as $characteristic) { ?>
                    <?php if (strcasecmp($characteristic['name'], 'Alimentare plita') == 0) { ?>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="alimentarePlita[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (array_key_exists('alimentarePlita', $filterDates) &&
                                                    in_array($characteristic['value'], $filterDates['alimentarePlita'])
                                                ) { ?> checked<?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php }
                } ?>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse3"><i class="indicator fa fa-caret-down"
                                                                       aria-hidden="true"></i> Culoare</a>
                    </h4>
                </div>
                <?php foreach ($characteristics as $characteristic) { ?>
                    <?php if (strcasecmp($characteristic['name'], 'Culoare') == 0) { ?>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="culoare[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (array_key_exists('culoare', $filterDates) &&
                                                    in_array($characteristic['value'], $filterDates['culoare'])
                                                ) { ?> checked<?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php }
                } ?>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse3"><i class="indicator fa fa-caret-down"
                                                                       aria-hidden="true"></i> Numar arzatoare</a>
                    </h4>
                </div>
                <?php foreach ($characteristics as $characteristic) { ?>
                    <?php if (strcasecmp($characteristic['name'], 'Numar arzatoare') == 0) { ?>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="nrArzatoare[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (array_key_exists('nrArzatoare', $filterDates) &&
                                                    in_array($characteristic['value'], $filterDates['nrArzatoare'])
                                                ) { ?> checked<?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php }
                } ?>

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#collapse3">
                            <i class="indicator fa fa-caret-down"
                               aria-hidden="true"></i> Aprindere electrica arzatoare</a>
                    </h4>
                </div>
                <?php foreach ($characteristics as $characteristic) { ?>

                    <?php if (strcasecmp($characteristic['name'], 'Aprindere electrica arzatoare') == 0) { ?>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="aprindereElectrica[]"
                                                   value="<?php echo $characteristic['value'] ?>"
                                                <?php if (array_key_exists('aprindereElectrica', $filterDates) &&
                                                    in_array($characteristic['value'], $filterDates['aprindereElectrica'])
                                                ) { ?> checked<?php } ?>>
                                            <?php echo $characteristic['value'] ?>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php }
                } ?>

            </div>
    </div>

    <input type="submit" name="submit" value="Submit"/>
    </form>
</div>


