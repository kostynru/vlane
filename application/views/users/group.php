<div class="row">
    <div class="span12">
        <h1><p align="center"><strong>
            отряд <?php
           echo $group["name"];
                echo " ";
                echo "(";
                echo $group["nickname"];
                echo ")";
?>
        </strong></p></h1>
    </div>
    <div class="span6">
        <ul>
            <?php foreach ($users as $user) : ?>
            <li>
                <?php
                echo" <a href=/users/show/".$user["id"].">".$user["name"]."</a>";
?>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
