<div onClick="$('#legend').toggle('blind');" style="cursor: pointer; color:blue; font-size: 12px;">Legend</div><br/>

<div id="legend" class="report_legend">
    <ul>
        <li class="report_legend_row">
            <div class="report_legend_title">
                ST
            </div>
            <div class="report_legend_value">
                = Number of Students
            </div>
        </li>
        <li class="report_legend_row">
            <div class="report_legend_title">
                TU
            </div>
            <div class="report_legend_value">
                = Teacher Usage
            </div>
        </li>
        <li class="report_legend_row">
            <div class="report_legend_title">
                MU
            </div>
            <div class="report_legend_value">
                = Minutes Used
            </div>
        </li>
        <li class="report_legend_row">
            <div class="report_legend_title">
                AT
            </div>
            <div class="report_legend_value">
                = Actual Time
            </div>
        </li>
        <li class="report_legend_row">
            <div class="report_legend_title">
                SU
            </div>
            <div class="report_legend_value">
                = Student Usage
            </div>
        </li>
    </ul>
</div>

<div class="report_header">
    <div class="report_header_cell" style="float:left">Totals</div>
    <div class="report_header_cell" style="margin-right: 4px">SU</div>
    <div class="report_header_cell">AT</div>
    <div class="report_header_cell">MU</div>
    <div class="report_header_cell">TU</div>
    <div class="report_header_cell">ST</div>
</div>
<div style="clear:both"></div>
<?php foreach($result as $year => $year_data): ?>
    <?php $total = $totals[$year]['total'] ?>
    <div class="accordion">
        <h3>
            <div><?= $year ?></div>
            <div class="accordion_header_cell" style="margin-right: -4px"><?= $total->studentUsage ?></div>
            <div class="accordion_header_cell"><?= gmdate('H:i', $total->actualTime*3600) ?></div>
            <div class="accordion_header_cell"><?= $total->totalTimeMinutes ?></div>
            <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
            <div class="accordion_header_cell"><?= $total->students ?></div>
        </h3>
        <?php foreach($year_data as $month => $month_data): ?>
            <?php $total = $totals[$year][$month]['total'] ?>
            <div class="accordion">
                <h3>
                    <div><?= Misc_helper::str_month($month) ?></div>
                    <div class="accordion_header_cell" style="margin-right: -5px"><?= $total->studentUsage ?></div>
                    <div class="accordion_header_cell"><?= gmdate('H:i', $total->actualTime*3600) ?></div>
                    <div class="accordion_header_cell"><?= $total->totalTimeMinutes ?></div>
                    <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
                    <div class="accordion_header_cell"><?= $total->students ?></div>
                </h3>
                <?php foreach($month_data as $verified => $verified_data): ?>
                    <?php $total = $totals[$year][$month][$verified]['total'] ?>
                    <div class="accordion">
                        <h3>
                            <div><?= $verified ?></div>
                            <div class="accordion_header_cell" style="margin-right: -6px"><?= $total->studentUsage ?></div>
                            <div class="accordion_header_cell"><?= gmdate('H:i', $total->actualTime*3600) ?></div>
                            <div class="accordion_header_cell"><?= $total->totalTimeMinutes ?></div>
                            <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
                            <div class="accordion_header_cell"><?= $total->students ?></div>
                        </h3>
                        <?php foreach($verified_data as $district => $district_data): ?>
                            <?php $total = $totals[$year][$month][$verified][$district]['total'] ?>
                            <div class="accordion">
                                <h3>
                                    <div><?= $district ?></div>
                                    <div class="accordion_header_cell" style="margin-right: -7px"><?= $total->studentUsage ?></div>
                                    <div class="accordion_header_cell"><?= gmdate('H:i', $total->actualTime*3600) ?></div>
                                    <div class="accordion_header_cell"><?= $total->totalTimeMinutes ?></div>
                                    <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
                                    <div class="accordion_header_cell"><?= $total->students ?></div>
                                </h3>
                                <?php foreach($district_data as $school => $school_data): ?>
                                    <?php $total = $totals[$year][$month][$verified][$district][$school]['total'] ?>
                                    <div class="accordion">
                                        <h3>
                                            <div><?= $school ?></div>
                                            <div class="accordion_header_cell" style="margin-right: -8px"><?= $total->studentUsage ?></div>
                                            <div class="accordion_header_cell"><?= gmdate('H:i', $total->actualTime*3600) ?></div>
                                            <div class="accordion_header_cell"><?= $total->totalTimeMinutes ?></div>
                                            <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
                                            <div class="accordion_header_cell"><?= $total->students ?></div>
                                        </h3>
                                        <?php foreach($school_data as $nutrition => $nutrition_data): ?>
                                            <?php $total = $totals[$year][$month][$verified][$district][$school][$nutrition]['total'] ?>
                                            <div class="accordion">
                                                <h3>
                                                    <div><?= $nutrition? 'Nutrition': 'Physical Activity' ?></div>
                                                    <div class="accordion_header_cell" style="margin-right: -9px"><?= $total->studentUsage ?></div>
                                                    <div class="accordion_header_cell"><?= gmdate('H:i', $total->actualTime*3600) ?></div>
                                                    <div class="accordion_header_cell"><?= $total->totalTimeMinutes ?></div>
                                                    <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
                                                    <div class="accordion_header_cell"><?= $total->students ?></div>
                                                </h3>
                                                <div>
                                                    <div class="accordion_row_header">
                                                        <div class="accordion_cell_header">SU</div>
                                                        <div class="accordion_cell_header">AT</div>
                                                        <div class="accordion_cell_header">MU</div>
                                                        <div class="accordion_cell_header">TU</div>
                                                        <div class="accordion_cell_header">ST</div>
                                                        <div class="accordion_cell_header" style="width:75px;">Cohort</div>
                                                        <div class="accordion_cell_header" style="width:350px;"></div>
                                                    </div>
                                                    <?php $i = 0 ?>
                                                    <?php foreach($nutrition_data as $row): ?>
                                                        <?php $row_class = $i++%2==0? 'accordion_row_even': 'accordion_row_noon' ?>
                                                        <div class="<?= $row_class ?>">
                                                            <div class="accordion_cell"><?= $row->studentUsage ?></div>
                                                            <div class="accordion_cell"><?= gmdate('H:i', $row->actualTime*3600) ?></div>
                                                            <div class="accordion_cell"><?= $row->totalTimeMinutes ?></div>
                                                            <div class="accordion_cell"><?= $row->teacherUsage ?></div>
                                                            <div class="accordion_cell"><?= $row->students ?></div>
                                                            <div class="accordion_cell" style="width:75px;"><?= $row->cohort ?></div>
                                                            <div class="accordion_cell" style="width:350px;"></div>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endforeach ?>

<script>
    $(document).ready(function() {
        $('.accordion').accordion({
            heightStyle: 'content',
            autoHeight: false,
            collapsible: true,
            active: 0
        });
    });
</script>