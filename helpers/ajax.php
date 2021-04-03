<?php
include("../app/Classes/User.php");
$user  = new User;
?>
<?php
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if ($action == "loginnameavailability") {

    $loginname = isset($_REQUEST['loginname']) ? $_REQUEST['loginname'] : '';
    $checkfield = isset($_REQUEST['checkfield']) ? $_REQUEST['checkfield'] : '';


    $checkloginname = $user->checkAvailability($loginname, $checkfield);
    echo json_encode(['success' => true, 'status' => $checkloginname, 'checkfield' => $checkfield]);
}

if ($action == "server_processing") {

    // DB table to use
    $table = 'users';

    // Table's primary key
    $primaryKey = 'id';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes
    $columns = array(
        array('db' => 'id', 'dt' => 0),
        array('db' => 'fullname',  'dt' => 1),
        array('db' => 'loginame',   'dt' => 2),
        array('db' => 'password',     'dt' => 3),
        array('db' => 'email',     'dt' => 4),
        array(
            'db'        => 'created_at',
            'dt'        => 5,
            'formatter' => function ($d, $row) {
                return date('jS M y', strtotime($d));
            }
        )
    );

    // SQL server connection information
    // $sql_details = array(
    //     'user' => '',
    //     'pass' => '',
    //     'db'   => '',
    //     'host' => ''
    // );



    $sql_details = $user->getConnection();

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

    require('../app/Classes/ssp.class.php');

    echo json_encode(
        SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
    );
}

exit;
