<div class="wrap">
    <h2>pecific CSS/JS for Posts and Pages</h2>

    <p>
        To use this feature in the bottom of the Write Post and Write Page you
        have a box to introduce the URL or URLs of the specific CSS and JS files,
        also you can add any code in header to specific posts or pages.
    </p>
    <img
        src="<?= plugins_url('assets/images/screenshot-1.png', __DIR__ . '/../../../index.php') ?>"
        alt="Screenshot"
        width="500"
        height="384"
        style="margin: 0 auto; display: block;"
    />

    <form method="post" action="<?= admin_url('options.php') ?>">
        <?php settings_fields($group); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row" colspan="2">
                    <h3>General options</h3>
                </th>
            </tr>

            <?php foreach ($settings as $value) {
                switch ($value['type']) {
                    case 'text':
                        echo \TTSCJ\Helpers::requireWith(__DIR__ . '/_text.php', [
                            'value' => $value,
                        ]);
                        break;
                    case 'textarea':
                        echo \TTSCJ\Helpers::requireWith(__DIR__ . '/_textarea.php', [
                            'value' => $value,
                        ]);
                        break;
                    case 'select':
                        echo \TTSCJ\Helpers::requireWith(__DIR__ . '/_select.php', [
                            'value' => $value,
                        ]);
                        break;

                    case "checkbox":
                        echo \TTSCJ\Helpers::requireWith(__DIR__ . '/_checkbox.php', [
                            'value' => $value,
                        ]);
                        break;
                }
            } ?>
        </table>

        <p class="submit">
            <input type="submit" class="button-primary" value="Save setting" />
        </p>
    </form>
</div>