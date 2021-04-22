<tr valign="top">
    <th scope="row"><?= $value['name']; ?></th>
    <td>
        <span class="description"><?= $value['desc']; ?></span><br />
        <textarea name="<?= $value['id']; ?>" cols="50" rows="6" class="large-text code"><?= stripslashes(get_option($value['id'])); ?></textarea>
        </td>
</tr>