<?php
    $nav_selected = "ADMIN";
    $left_selected = "USERS";
    $tabTitle = "SBOM - Admin (Users)";

    include("../../../../index.php");
    include("admin_left_menu.php");

    $query = "SELECT * FROM users";
    $GLOBALS['data'] = mysqli_query( $db, $query );
?>

<div class="wrap">
    <h3 style="color: #01B0F1;"> Admin --> Users </h3>

    <div id="customerTableView" class="table-container">
        <table id="info" class="datatable table table-striped table-bordered datatable-style table-hover">
            <thead>
                <tr id="table-first-row">
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Hash</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Modified Time</th>
                    <th>Created Time</th>
                    <th>Active</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    // fetch the data from $_GLOBALS
                    if ( $data -> num_rows > 0 ) {
                        while( $row = $data -> fetch_assoc() ) {
                            echo '<tr>
                                    <td>'.$row["id"].'</td>
                                    <td>'.$row["first_name"].' </span> </td>
                                    <td>'.$row["last_name"].'</td>
                                    <td>'.$row["hash"].'</td>
                                    <td>'.$row["email"].' </span> </td>
                                    <td>'.$row["role"].'</td>
                                    <td>'.$row["created_time"].' </span> </td>
                                    <td>'.$row["modified_time"].' </span> </td>
                                    <td>'.$row["active"].' </span> </td>
                                </tr>';
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
