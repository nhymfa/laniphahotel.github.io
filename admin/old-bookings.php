<?php include('includes/header.php') ?>

<section class="mt-2">
    <div class="container">
        <div class="row justify-content-center">
                    <?php
                        if(isset($_SESSION['adminlogin']))
                        {
                            $today = date("Y-m-d");
                            $all_bookings_query = " SELECT * FROM bookings ";
                            $all_bookings_query_run =  mysqli_query($con, $all_bookings_query);

                            
                            if(mysqli_num_rows($all_bookings_query_run) > 0)
                            {
                                $old_bookings_query = " SELECT b.id as omid, b.checkin,b.checkout,b.price, b.created_at, r.id, r.room_name, u.id, u.fname, u.lname FROM bookings b, rooms r, users u WHERE b.room_id= r.id AND u.id=b.user_id AND b.checkout < '$today' ";
                                $old_bookings_query_run = mysqli_query($con, $old_bookings_query);
                                if(mysqli_num_rows($old_bookings_query_run) > 0)
                                {
                                    ?>  
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="heading">Older Bookings</h4>
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
                                                                <th>Price</th>
                                                                <th>Booked On</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                    foreach($old_bookings_query_run as $oldroom)
                                                    {
                                                        ?>  
                                                        <tr>
                                                            <td><?= $oldroom['omid']; ?></td>
                                                            <td><?= $oldroom['fname'].' '.$oldroom['lname']; ?></td>
                                                            <td><?= $oldroom['room_name']; ?></td>
                                                            <td> <?= date("d-m-Y", strtotime($oldroom['checkin'])); ?></td>
                                                            <td> <?= date("d-m-Y", strtotime($oldroom['checkout'])); ?></td>
                                                            <td><?= $oldroom['price']; ?></td>
                                                            <td><?= $oldroom['created_at']; ?></td>
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
                                                    <h2 class="heading">No Older bookings</h2>
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

