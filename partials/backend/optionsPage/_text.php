<tr valign="top">
    <th scope="row"><?= $value['name']; ?></th>
    <td>
        <label>
            <input name="<?= $value['id']; ?>" id="<?= $value['id']; ?>" type="<?= $value['type']; ?>" value="<?= stripslashes(get_option($value['id'])); ?>" class="regular-text" />
            <span class="description"><?= $value['desc']; ?></span>
        </label>
    </td>
</tr>