 <section class="vh-100 w-100" style="background-color: #eee;">

     <div class="fluid-container py-5 h-100">
         <div class="row d-flex justify-content-center align-items-center h-100 w-100">

             <div class="col col-lg-10 col-xl-11">
                 <div class="card rounded-3">
                     <div class="card-body p-4">


                         <h4 class="text-center my-3 pb-3">View Registered Participants</h4>
                         <h4 class="text-center my-3 pb-3"><?php
                                                            $eventTitle = "";
                                                            if (!empty($result)) {
                                                                echo $result[0]['title'];
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                         </h4>


                         <table class="table mb-4">
                             <thead>
                                 <tr>
                                     <th scope="col">No.</th>
                                     <th scope="col">Name</th>
                                     <th scope="col">Email</th>
                                     <th scope="col">Gender</th>

                                 </tr>
                             </thead>
                             <tbody>


                                 <?php
                                    try {

                                        $i = 0;

                                        // Check if records exist
                                        if ($result) {
                                            $eventTitle = $result[0]['title'];

                                            // Loop through the fetched records
                                            foreach ($result as $row) {
                                                $i++;   ?>
                                             <tr>
                                                 <th scope="row"> <?php echo $i; ?> </th>
                                                 <td> <?php echo htmlspecialchars($row['acc_fname'] . ' ' . $row['acc_lname']) ?> </td>
                                                 <td style="max-width: 300px;"> <?php echo htmlspecialchars($row['acc_mail']) ?> </td>
                                                 <td><?php echo $row['acc_gender']  ?></td>

                                             </tr>
                                 <?php  }
                                        } else {
                                            echo '<tr><td colspan="5">No Participants found.</td></tr>';
                                        }
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                    ?>



                             </tbody>
                         </table>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>