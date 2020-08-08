<?php
$columns_counter = $status_order = 0;
$columns = [];

$sum = count($cfg["registration"]->columns) + count($cfg["committee"]->columns);
?>
<table width="100%">
    <thead>
        <tr>
            <?php foreach($cfg as $section): ?>
            <th colspan="<?php echo count($section->columns) ?>" bgcolor="<?php echo $section->color ?>">
                <h3><?php echo $section->label ?></h3>
            </th>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach($cfg as $section):
                foreach($section->columns as $column):
                    if ("Status" == $column->label) { $status_order = $columns_counter; } ?>
                    <th bgcolor="<?php echo $section->color ?>"> <?php echo $column->label; ?> </th>
                <?php
                    $columns_counter++;
                endforeach;
            endforeach;
            $total = $columns_counter - $sum;
            ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($evaluations as $evaluation): ?>
            <tr>
            <?php foreach($cfg as $section): ?>
                <?php foreach($section->columns as $column): $getter = $column->getValue; ?>
                    <td style="text-align: center;"> <?php echo $getter($evaluation); ?> </td>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tr>
        <?php endforeach;

        foreach ($pending_evaluations as $valuer_pending):
            echo '<tr>';
            if (is_array($valuer_pending) && is_null($valuer_pending["evaluation"])) {
                foreach ($valuer_pending["valuer"] as $key => $v) {
                    if ($key === "name") {
                        ?>
                        <td style="text-align: center;"> <?php echo $valuer_pending["registration"]["owner"]["name"] ?> </td>
                        <td style="text-align: center;"> <?php echo $valuer_pending["registration"]["number"] ?> </td>
                        <td style="text-align: center;"> <?php echo $valuer_pending["valuer"][$key]; ?> </td>

                        <?php for($i=0; $i < $total; $i++) { ?>
                            <td style="text-align: center; font-style: italic;">
                                <?php
                                if ($i + $sum === $status_order) {
                                    echo "Não avaliado";
                                } else {
                                    echo "--";
                                } ?>
                            </td>
                    <?php
                        } // for
                    }
                }
            }
            echo '</tr>';
        endforeach;
        ?>
    </tbody>
</table>