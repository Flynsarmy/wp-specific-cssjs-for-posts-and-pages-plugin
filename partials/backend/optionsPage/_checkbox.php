<tr valign="top">
    <th scope="row"><?= $value['name']; ?></th>
    <td>
        <label><?php if (get_option($value['id'])) {
            $checked = "checked=\"checked\"";
               } else {
                   $checked = "";
               } ?>
        <input type="checkbox" name="<?= $value['id']; ?>" id="<?= $value['id']; ?>" value="true" <?= $checked; ?> />
        <span class="description"><?= $value['desc']; ?></span>
        </label>
    </td>
</tr>