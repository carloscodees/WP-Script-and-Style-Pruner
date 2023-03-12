<?
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }
?>
<div>
    <button
    class="click-all"
        >
        All
    </button>
    <button
    class="click-scripts"
    >
        View Scripts
    </button>
    <button
    class="click-styles"
    >
        View Styles
    </button>
</div>
<div>
    <div>
    <table style="width:100%" class="items-scripts pe-items">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Handle</th>
                    <th>Src</th>
                    <th>Preloader</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['scripts'] as $key => $items) :

                ?>
                    <tr class="preloader-tr-comulms">
                        <td><?= $key + 1 ?></td>
                        <?php
                        foreach ($items as  $keyy => $yy) {
                            if($keyy == 'active'){
                                printf("
                                <td>
                                <li class='tg-list-item'>
                                <input name='ite[%s]' type='hidden'  value='off'><input class='tgl tgl-ios'  style='display: none;' id='cb2_%s' type='checkbox' name='ite[%s]'  %s onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <label class='tgl-btn' for='cb2_%s'></label>
                            </li>
                            </td>", $items['handle'], $key, $items['handle'], $items['active'] ? 'checked': '', $key);
                            }else {
                                printf("<td>%s</td>", $yy);
                            }
                        }
                        ?>
                    </tr>

                <?php

                endforeach;
                ?>
            </tbody>

        </table>
    </div>
    <div>
    <table style="width:100%" class="items-styles pe-items">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Handle</th>
                    <th>Src</th>
                    <th>Preloader</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data['styles'] as $key => $items) :

                ?>
                    <tr class="preloader-tr-comulms">
                        <td><?= $key + 1 ?></td>
                        <?php
                        foreach ($items as  $keyy => $yy) {
                            if($keyy == 'active'){
                                printf("
                                <td>
                                <li class='tg-list-item'>
                                <input name='ite_2[%s]' type='hidden'  value='off'><input class='tgl tgl-ios'  style='display: none;' id='cb22_%s' type='checkbox' name='ite_2[%s]'  %s onclick='this.previousSibling.value=1-this.previousSibling.value'>
                                <label class='tgl-btn' for='cb22_%s'></label>
                            </li>
                            </td>", $items['handle'], $key, $items['handle'], $items['active'] ? 'checked': '', $key);
                            }else {
                                printf("<td>%s</td>", $yy);
                            }
                        }
                        ?>
                    </tr>

                <?php

                endforeach;
                ?>
            </tbody>

        </table> 
    </div>
</div>