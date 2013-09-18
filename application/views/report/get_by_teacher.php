<div onClick="$('#legend').toggle('blind');" style="cursor: pointer; color:blue; font-size: 12px;">Legend</div><br/>

<div id="legend" class="report_legend">
    <ul>
        <li class="report_legend_row">
            <div class="report_legend_title">
                MPU
            </div>
            <div class="report_legend_value">
                = Minutes Per Use
            </div>
        </li>
        <li class="report_legend_row">
            <div class="report_legend_title">
                TU
            </div>
            <div class="report_legend_value">
                = Times Used
            </div>
        </li>
        <li class="report_legend_row">
            <div class="report_legend_title">
                MXU
            </div>
            <div class="report_legend_value">
                = Maximum Uses Per Month
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
                TT
            </div>
            <div class="report_legend_value">
                = Total Possible Time
            </div>
        </li>
    </ul>
</div>

<div class="report_header">
    <div class="report_header_cell" style="float:left">Totals</div>
    <div class="report_header_cell" style="margin-right: 4px">TT</div>
    <div class="report_header_cell">MU</div>
    <div class="report_header_cell">MXU</div>
    <div class="report_header_cell">TU</div>
    <div class="report_header_cell">MPU</div>
</div>
<div style="clear:both"></div>

<div class="accordion">
    <?php foreach($result as $year => $year_data): ?>
        <?php $total = $totals[$year]['total'] ?>
        <h3>
            <div><?= $year ?></div>
            <div class="accordion_header_cell" style="margin-right: -4px"><?= $total->totalPossibleTime ?></div>
            <div class="accordion_header_cell"><?= $total->minutesUsed ?></div>
            <div class="accordion_header_cell"><?= $total->maximumUsesPerMonth ?></div>
            <div class="accordion_header_cell"><?= $total->timesUsed ?></div>
            <div class="accordion_header_cell"><?= $total->minutesPerUse ?></div>
        </h3>
        <div class="accordion">
            <?php foreach($year_data as $month => $month_data): ?>
                <?php $total = $totals[$year][$month]['total'] ?>
                <h3>
                    <div><?= Misc_helper::str_month($month) ?></div>
                    <div class="accordion_header_cell" style="margin-right: -5px"><?= $total->totalPossibleTime ?></div>
                    <div class="accordion_header_cell"><?= $total->minutesUsed ?></div>
                    <div class="accordion_header_cell"><?= $total->maximumUsesPerMonth ?></div>
                    <div class="accordion_header_cell"><?= $total->timesUsed ?></div>
                    <div class="accordion_header_cell"><?= $total->minutesPerUse ?></div>
                </h3>
                <div class="accordion">
                    <?php foreach($month_data as $district => $district_data): ?>
                        <?php $total = $totals[$year][$month][$district]['total'] ?>
                        <h3>
                            <div><?= $district ?></div>
                            <div class="accordion_header_cell" style="margin-right: -6px"><?= $total->totalPossibleTime ?></div>
                            <div class="accordion_header_cell"><?= $total->minutesUsed ?></div>
                            <div class="accordion_header_cell"><?= $total->maximumUsesPerMonth ?></div>
                            <div class="accordion_header_cell"><?= $total->timesUsed ?></div>
                            <div class="accordion_header_cell"><?= $total->minutesPerUse ?></div>
                        </h3>
                        <div class="accordion">
                            <?php foreach($district_data as $school => $school_data): ?>
                                <?php $total = $totals[$year][$month][$district][$school]['total'] ?>
                                <h3>
                                    <div><?= $school ?></div>
                                    <div class="accordion_header_cell" style="margin-right: -7px"><?= $total->totalPossibleTime ?></div>
                                    <div class="accordion_header_cell"><?= $total->minutesUsed ?></div>
                                    <div class="accordion_header_cell"><?= $total->maximumUsesPerMonth ?></div>
                                    <div class="accordion_header_cell"><?= $total->timesUsed ?></div>
                                    <div class="accordion_header_cell"><?= $total->minutesPerUse ?></div>
                                </h3>
                                <div class="accordion">
                                    <?php foreach($school_data as $grade => $grade_data): ?>
                                        <?php $total = $totals[$year][$month][$district][$school][$grade]['total'] ?>
                                        <h3>
                                            <div><?= $grades[$grade] ?></div>
                                            <div class="accordion_header_cell" style="margin-right: -8px"><?= $total->totalPossibleTime ?></div>
                                            <div class="accordion_header_cell"><?= $total->minutesUsed ?></div>
                                            <div class="accordion_header_cell"><?= $total->maximumUsesPerMonth ?></div>
                                            <div class="accordion_header_cell"><?= $total->timesUsed ?></div>
                                            <div class="accordion_header_cell"><?= $total->minutesPerUse ?></div>
                                        </h3>
                                        <div class="accordion">
                                            <?php foreach($grade_data as $teacher => $teacher_data): ?>
                                                <?php $total = $totals[$year][$month][$district][$school][$grade][$teacher]['total'] ?>
                                                <h3>
                                                    <div><?= $teacher ?></div>
                                                    <div class="accordion_header_cell" style="margin-right: -9px"><?= $total->totalPossibleTime ?></div>
                                                    <div class="accordion_header_cell"><?= $total->minutesUsed ?></div>
                                                    <div class="accordion_header_cell"><?= $total->maximumUsesPerMonth ?></div>
                                                    <div class="accordion_header_cell"><?= $total->timesUsed ?></div>
                                                    <div class="accordion_header_cell"><?= $total->minutesPerUse ?></div>
                                                </h3>
                                                <div>
                                                    <div class="accordion_row_header">
                                                        <div class="accordion_cell_header">TT</div>
                                                        <div class="accordion_cell_header">MU</div>
                                                        <div class="accordion_cell_header">MXU</div>
                                                        <div class="accordion_cell_header">TU</div>
                                                        <div class="accordion_cell_header">MPU</div>
                                                        <div class="accordion_cell_header" style="width:350px">Resource</div>
                                                        <div class="accordion_cell_header" style="width:150px;">Category</div>
                                                    </div>
                                                    <?php $i = 0 ?>
                                                    <?php foreach($teacher_data as $row): ?>
                                                        <?php $row_class = $i++%2==0? 'accordion_row_even': 'accordion_row_noon' ?>
                                                        <div class="<?= $row_class ?>">
                                                            <div class="accordion_cell"><?= $row->totalPossibleTime ?></div>
                                                            <div class="accordion_cell"><?= $row->minutesUsed ?></div>
                                                            <div class="accordion_cell"><?= $row->maximumUsesPerMonth ?></div>
                                                            <div class="accordion_cell"><?= $row->timesUsed ?></div>
                                                            <div class="accordion_cell"><?= $row->minutesPerUse ?></div>
                                                            <div class="accordion_cell" style="width:350px"><?= $row->resource ?></div>
                                                            <div class="accordion_cell" style="width:150px;"><?= $row->category ?></div>
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
        </div>
    <?php endforeach ?>
</div>

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