<?php include('includes/header.php') ?>

<section class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
                    <?php
                        if(isset($_SESSION['adminlogin']))
                        {
                            $today = date("Y-m-d");
                            $all_bookings_query = " SELECT * FROM bookings";
                            $all_bookings_query_run =  mysqli_query($con, $all_bookings_query);
                            
                            if(mysqli_num_rows($all_bookings_query_run) > 0)
                            {
                                $new_bookings_query = "SELECT b.id as omid, b.checkin,b.checkout,b.price, b.created_at, r.id, r.room_name, u.id, u.fname, u.lname FROM bookings b, rooms r, users u WHERE b.room_id= r.id AND u.id=b.user_id AND b.checkout >= '$today' ";
                                $new_bookings_query_run = mysqli_query($con, $new_bookings_query);
                                if(mysqli_num_rows($new_bookings_query_run) > 0)
                                {
                                    ?>  
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="heading">Upcoming Bookings</h4>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table" id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>User Name</th>
                                                                <th>Room Name</th>
                                                                <th>Check In</th>
                                                                <th>Check Out</th>
                                                                <th>No of Days</th>
                                                                <th>Price</th>
                                                                <th>Booked On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                    foreach($new_bookings_query_run as $newroom)
                                                    {
                                                        $chkin = date('Y-m-d',strtotime($newroom['checkin']));
                                                        $chkout = date('Y-m-d',strtotime($newroom['checkout']));
                                                        $date1=date_create($chkin);
                                                        $date2=date_create($chkout);
                                                        $difference=date_diff($date1,$date2);
                                                        $sub_diff = $difference->format("%a");
                                                        $diff = $sub_diff + 1;
                                                        ?>  

                                                        <tr>
                                                            <td><?= $newroom['omid']; ?></td>
                                                            <td><?= $newroom['fname'].' '.$newroom['lname']; ?></td>
                                                            <td><?= $newroom['room_name']; ?></td>
                                                            <td> <?= date("d-m-Y", strtotime($newroom['checkin'])); ?></td>
                                                            <td> <?= date("d-m-Y", strtotime($newroom['checkout'])); ?></td>
                                                            <td><?= $diff; ?></td>
                                                            <td><?= $newroom['price']; ?></td>
                                                            <td><?= $newroom['created_at']; ?></td>
                                                        </tr>
                                                        
                                                        <?php
                                                    }
                                                    ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <div class="col-md-12 py-3 text-center">
                                            <div class="card shadow-sm">
                                                <div class="card-body py-5">
                                                    <h2 class="heading">No Upcoming bookings</h2>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <div class="col-md-6 text-center">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h2 class="heading">No bookings</h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                        else
                        {
                            redirect("login.php","Login to view bookings");
                        }
                    ?>

        </div>    
    </div>
</section>

<?php include('includes/footer.php'); ?>

