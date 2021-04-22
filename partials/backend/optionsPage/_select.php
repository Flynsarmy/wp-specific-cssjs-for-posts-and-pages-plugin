<tr valign="top">
    <th scope="row"><?php echo $value['name']; ?></th>
    <td>
        <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
        <?php foreach ($value['options'] as $option) { ?>
            <option<?php if (get_option($value['id']) == $option[1]) {
                echo ' selected="selected"';
                   } ?> value="<?php echo $option[1]; ?>"><?php echo $option[0]; ?></option>
        <?php } ?>
        </select>
        <br /><span class="description"><?php echo $value['desc']; ?></span>
    </td>
</tr>