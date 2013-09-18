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
                SU
            </div>
            <div class="report_legend_value">
                = Studets Usage
            </div>
        </li>
        <li class="report_legend_row">
            <div class="report_legend_title">
                MO
            </div>
            <div class="report_legend_value">
                = Minutes of Instruction
            </div>
        </li>
    </ul>
</div>

<div class="report_header">
    <div class="report_header_cell" style="float:left">Totals</div>
    <div class="report_header_cell" style="margin-right: 4px">MI</div>
    <div class="report_header_cell">SU</div>
    <div class="report_header_cell">TU</div>
    <div class="report_header_cell">ST</div>
</div>
<div style="clear:both"></div>

<div class="accordion">
    <?php foreach($result as $category => $category_data): ?>
        <?php $total = $totals[$category]['total'] ?>
        <h3>
            <div><?= $category ?></div>
            <div class="accordion_header_cell" style="margin-right: -7px"><?= $total->minutesOfInstruction ?></div>
            <div class="accordion_header_cell"><?= $total->studentUsage ?></div>
            <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
            <div class="accordion_header_cell"><?= $total->students ?></div>
        </h3>
        <div class="accordion">
            <?php foreach($category_data as $resource => $resource_data): ?>
                <?php $total = $totals[$category][$resource]['total'] ?>
                <h3>
                    <div><?= $resource ?></div>
                    <div class="accordion_header_cell" style="margin-right: -8px"><?= $total->minutesOfInstruction ?></div>
                    <div class="accordion_header_cell"><?= $total->studentUsage ?></div>
                    <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
                    <div class="accordion_header_cell"><?= $total->students ?></div>
                </h3>
                <div class="accordion">
                    <?php foreach($resource_data as $grade => $grade_data): ?>
                        <?php $total = $totals[$category][$resource][$grade]['total'] ?>
                        <h3>
                            <div><?= $grades[$grade] ?></div>
                            <div class="accordion_header_cell" style="margin-right: -9px"><?= $total->minutesOfInstruction ?></div>
                            <div class="accordion_header_cell"><?= $total->studentUsage ?></div>
                            <div class="accordion_header_cell"><?= $total->teacherUsage ?></div>
                            <div class="accordion_header_cell"><?= $total->students ?></div>
                        </h3>
                        <div>
                            <div class="accordion_row_header">
                                <div class="accordion_cell_header">MI</div>
                                <div class="accordion_cell_header">SU</div>
                                <div class="accordion_cell_header">TU</div>
                                <div class="accordion_cell_header">ST</div>
                                <div class="accordion_cell_header" style="width:150px">Teacher</div>
                            </div>
                            <?php $i = 0 ?>
                            <?php foreach($grade_data as $row): ?>
                                <?php $row_class = $i++%2==0? 'accordion_row_even': 'accordion_row_noon' ?>
                                <div class="<?= $row_class ?>">
                                    <div class="accordion_cell"><?= $row->minutesOfInstruction ?></div>
                                    <div class="accordion_cell"><?= $row->studentUsage ?></div>
                                    <div class="accordion_cell"><?= $row->teacherUsage ?></div>
                                    <div class="accordion_cell"><?= $row->students ?></div>
                                    <div class="accordion_cell" style="width:150px"><?= $row->teacher ?></div>
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