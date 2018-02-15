<?php
/**
 * Itinerary footer table template
 */

?>
<div class="b-table style-g">
    <table>
        <tbody>
        <tr>
            <td rowspan="<?php print count($rows); ?>">
                <h4><?php print render($left); ?></h4>
            </td>
            <td>
              <?php print render($rows[0]['title']); ?>
            </td>
            <td>
              <?php print render($rows[0]['price']); ?>
            </td>
        </tr>
        <?php foreach($rows as $delta => $row): ?>
          <?php if($delta != 0): ?>
                <tr>
                    <td>
                      <?php print render($row['title']); ?>
                    </td>
                    <td>
                      <?php print render($row['price']); ?>
                    </td>
                </tr>
          <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>