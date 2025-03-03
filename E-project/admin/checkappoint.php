<?php

include('header.php');
include('../users/config.php');

?>


<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Check Appoint</h6>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Stylist Name</th>
                    <th scope="col">Service</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                   
                </tr>
            </thead>
            <tbody id="checkappoint">
                <?php
                if($_SESSION['r']=='3'){
                    $select = "SELECT 
    confirmappoint.*, 
    client_users.name AS client_name, 
    stylist_users.name AS stylist_name, 
    services.servicesname,
    stylist_slots.slot_date,stylist_slots.start_time,stylist_slots.end_time
FROM 
    confirmappoint 
JOIN 
    users AS client_users ON confirmappoint.client_id = client_users.id 
JOIN 
    stylists ON confirmappoint.stylist_id = stylists.id 
JOIN 
    users AS stylist_users ON stylists.user_id = stylist_users.id 
JOIN 
    services ON confirmappoint.service_id = services.id 
JOIN 
    stylist_slots ON confirmappoint.time_id = stylist_slots.id;
";
                }
                else{

                    $select = "SELECT 
    confirmappoint.*, 
    client_users.name AS client_name, 
    stylist_users.name AS stylist_name, 
    services.servicesname,
    stylist_slots.slot_date,stylist_slots.start_time,stylist_slots.end_time
FROM 
    confirmappoint 
JOIN 
    users AS client_users ON confirmappoint.client_id = client_users.id 
JOIN 
    stylists ON confirmappoint.stylist_id = stylists.id 
JOIN 
    users AS stylist_users ON stylists.user_id = stylist_users.id 
JOIN 
    services ON confirmappoint.service_id = services.id 
JOIN 
    stylist_slots ON confirmappoint.time_id = stylist_slots.id where confirmappoint.stylist_id={$_SESSION['stylist_id']};
";
                }

                $result = mysqli_query($db, $select);

                while ($row = mysqli_fetch_assoc($result)) {

                ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['client_name'] ?></td>
                        <td><?php echo $row['stylist_name'] ?></td>
                        <td><?php echo $row['servicesname'] ?></td>
                        <td><?php echo $row['slot_date'] ?></td>
                        <td><?php echo $row['start_time'] . ' - ' . $row['end_time'] ?></td>

                        <td><a href="stylisttask.php"><button class="btn btn-warning">View</button></a>
                       <button class="btn btn-success"  style="cursor: not-allowed;">Booked</button></td>

                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>











<?php

include('footer.php');

?>