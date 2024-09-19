<style>
/* The switch - the box around the slider */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    margin-top: 4px;
    margin-bottom: 4px;
}

/* Hide default HTML checkbox */
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* The slider */
.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider {
    background-color: #6a73fa;
}

input:focus+.slider {
    box-shadow: 0 0 1px #6a73fa;
}

input:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}

table td {
    vertical-align: middle !important;
    padding-top: 2px !important;
    padding-bottom: 2px !important;
}
</style>

<input type="text" class="form-control" id="myInput" onkeyup="filterPermissionsTable()"
    placeholder="Search Pages">
    <br>

<table class="table table-bordered table-hover" id="permissions_table">

    <tbody>
        <?php foreach ($permissionsLabels as $label => $permissions) {
        ?>
        <tr style="background: #6a73fa;color: #fff;height:40px;" class="permission-label" id="<?php echo $label; ?>">
            <th style="color: #fff;"><?php echo $label; ?></th>
        </tr>

        <tr class="permission-route permission-<?php echo $label; ?>">
            <td style="padding: 0px;">
                <table style="width: 100%;">
                    <?php foreach ($permissions as $permission) { ?>
                    <tr>
                    <td style="width: 50%;"><?php echo ($permission->title)?$permission->title:$permission->route_name; ?></td>
                        <td style="text-align: right;">
                            <label class="switch">
                                <input class="permission-button" data-id="<?php echo $permission->id; ?>"
                                    type="checkbox"
                                    <?php if ($permission->user_permission_count > 0) {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>

        <?php } ?>
    </tbody>
</table>


<script>
$(document).ready(function() {
    $('.permission-button').change(function() {
        var id = $(this).attr('data-id');
        $.post("{{route('permission.updateUserPermission')}}",
            '_token={{ csrf_token() }}&user_id=<?= $id; ?>&permission_id=' + id,
            function(data, status) {});

    });
});


function filterPermissionsTable() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("permissions_table");
    //tr = table.getElementsByTagName("tr");
    tr = table.getElementsByClassName("permission-label");


    $('.permission-route').hide();
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {

        td = tr[i].getElementsByTagName("th")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "block";
                $('.permission-' + $(tr[i]).attr('id')).show();
            } else {
                tr[i].style.display = "none";

            }
        }
    }
}
</script>